<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\App\Api\AuthenticateUser;
use App\Actions\App\Api\CreateUser;
use App\Actions\App\Api\VerifyFirebaseToken;
use App\Classes\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendCodeRestPassword;
use App\Models\Provider;
use App\Models\ResetPasswordUser;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Socialite;
use Laravel\Socialite\Two\User as ProviderUser;

class AuthenticationController extends Controller
{
    public function create(Request $request, CreateUser $createUser, AuthenticateUser $authenticateUser, VerifyFirebaseToken $verifyFirebaseToken)
    {
        return $authenticateUser->authenticate($request, $createUser, $verifyFirebaseToken);
    }

    public function register(RegisterUserRequest $registerUserRequest , UserRequest $userRequest , CreateUser $createdUser)
    {
        $imageName = time() . '.' . $registerUserRequest->image->getClientOriginalName();
        $registerUserRequest->file('image')->storeAs('profile-photos', $imageName);

        $registerUserRequest->merge([
            'password' => bcrypt($registerUserRequest->password),
            'role' => 5,
            'profile_photo_path' => $imageName,
        ]);

        // $user = User::create($registerUserRequest->all());
        $user = $createUser->create($userRequest, 5);
        $user->recruiter()->create(['user_id' => $user->id]);
        $data['user'] = new UserResource($user);
        return returnData('data', $data, 'Register-Successfully');
    }

    public function login(LoginUserRequest $loginUserRequest , Request $request)
    {

        $getUser  = User::where('email' , $loginUserRequest->email)->first();

        if($request->type =='freelancer' && $getUser->role == '5'){
            return response()->json([
                'status' => 403 ,
                'message' => 'you cant login , this app for freelancer'
            ], 203);
        }

        if($request->type =='recruiter' && $getUser->role == '2'){
            return response()->json([
                'status' => 403 ,
                'message' => 'you cant login , this app for recruiter'
            ] , 203);
        }

        $credentials = $loginUserRequest->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('token')->plainTextToken;

            return returnData('user', $data, 'Login-Successfully');

        } else {

            return returnError(404, 'البيانات المدخلة غير مسجلة لدينا ');

        } //end of else
    }

    public function socialite()
    {

        $providerUser = null;
        $accessToken = request()->get('access_token');
        $provider = request()->get('provider');
        $fcm_token = request()->get('fcm_token');

        try {
            $providerUser = \Laravel\Socialite\Facades\Socialite::driver($provider)->userFromToken($accessToken);

        } catch (Exception $exception) {
            return $exception;
        }

        if ($providerUser) {
            return $this->findOrCreate($providerUser, $provider);
        }

        return $providerUser;

    }

    protected function findOrCreate(ProviderUser $providerUser, string $provider)
    {
        $linkedSocialAccount = Provider::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();


        if ($linkedSocialAccount) {

            $str = $linkedSocialAccount->user;
            $token = $str->createToken('test-token')->plainTextToken;
            $result = (explode(" ", $str));
            $sss = '';
            foreach ($result as $res) {
                $sss .= $res;
            }
            $sss = json_decode($sss, true);
            $sss = json_decode(json_encode($sss), true);

            return [
                'status' => true,
                'data' => [
                    'token' => $token,
                    'user' => $sss,
                ],
            ];

        } else {
            $user = null;
            $data = null;
            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->getName() ?: strtok($providerUser->getEmail(), '@'),
                    'email' => $providerUser->getEmail(),
                    'role' => 2,
                    'password' => mt_rand(000000, 999999),
                    'fcm_token' => request()->get('fcm_token'),
                    'is_from_socialite' => true

                ]);
                $data['user'] = new UserResource($user);
                $token = $user->createToken('token')->plainTextToken;
                // $token = $user->createToken('test-token')->plainTextToken;
            }

            $user->providers()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);
            $user = User::where('email', $providerUser->getEmail())->first();
            return response()->json([
                'status' => true,
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ]);


        }
    }

    public function forgetPassword(Request $request)
    {

        $data = ([
            'email' => 'required|email|exists:users',
        ]);

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails())

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);

        $getUser = User::where('email', $request->email)->first();
        if($getUser->is_from_socialite == 1 ){
            return response()->json([
                'status' => false,
                'message' => 'This is account From socialite'
            ]);
        }

            DB::table('password_resets')->where('email', $request->email)->delete();
            $code = mt_rand(1111, 9999);
            $data = [
                'email' => $request->email,
                'code' => $code,
                'created_at' => Carbon::now()
            ];

            $codeData = DB::table('password_resets')->insert($data);
            Mail::to($request->email)->send(new SendCodeRestPassword($code));

            return response()->json([
                'status' => true,
                'message' => 'Send Code To Your Email To Reset Password'
            ]);


        ////
    }

    public function CheckCodeResetPassword(Request $request)
    {
        $data = ([
            'code' => 'required|exists:password_resets',
            'email' => 'required|email|exists:users'
        ]);

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails())

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);


        $codeReset = DB::table('password_resets')->where('code', $request->code)->first();

        $getUser = User::where('email', $request->email)->first();
        $accessToken = $getUser->createToken('reset-password-token')->plainTextToken;

        if ($codeReset->created_at > now()->addHour()) {
            $codeReset->delete();
            return response()->json([
                'status' => false,
                'message' => 'Expired token'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => ['token' => $accessToken],
            'message' => 'valid token'
        ]);

    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:password_resets',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);

        $new_password = $request->input('password');
        $passwordReset = DB::table('password_resets')->where('code', $request->code)->first();

        if ($passwordReset->created_at > now()->addHour()) {
            // $passwordReset->delete();
            DB::table('password_resets')->where('code', $request->code)
                ->Limit(1)->delete();
            return response()->json([
                'status' => false,
                'message' => 'Expired token'
            ]);
        }

        $user = User::firstWhere('email', $passwordReset->email);
        $user->password = bcrypt($new_password);
        $user->save();
        DB::table('password_resets')->where('code', $request->code)
            ->Limit(1)->delete();
        $getUser = User::where('email', $request->email)->first();
        $plainTextToken = $getUser->createToken($request->ip())->plainTextToken;
        return response()->json([
            'status' => true,
            'data' => ['token' => $plainTextToken, 'user' => $getUser],
            'message' => 'Reset Success'
        ]);

    }


}
