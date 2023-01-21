<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\PaginateController;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $qeury = $request['query']?$request['query']['contact']:null;
            $contact_us = ContactUs::search($qeury)->paginate($request['pagination']['perpage']??10);
            return PaginateController::paginate($contact_us,$request);
        }

        return view('pages.contact.index', [
            'page_title' => __('طلبات التواصل')
        ]);
    }
    public function destroy(Request $request){
        $contact = ContactUs::find($request->id);
        if($contact){
            $contact->delete();
            return response()->json([
                'message' => 'Delete Done'
            ]);
        }
    }
}
