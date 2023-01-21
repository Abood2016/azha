<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __invoke(ContactUsRequest $contactUsRequest)
    {
        ContactUs::create($contactUsRequest->validated());

        return response()->json([
            'status' => true,
            'message' => 'Send Done'
        ]);
    }
}
