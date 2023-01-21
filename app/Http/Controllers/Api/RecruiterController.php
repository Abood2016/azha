<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\ChangeStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Models\Recruiter;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {
            if ($request['query']) {
                if (isset($request['query']['filter.status']))
                    session(['offline' => false]);
            }
            $recruiters = Recruiter::search();
            return PaginateController::paginate($recruiters, $request, 'App\Http\Resources\RecruiterResource');
        }

    }

    public function update(Recruiter $recruiter)
    {

        $changeStatus = new ChangeStatus($recruiter);

        $changeStatus->update();

    }


}
