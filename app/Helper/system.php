<?php

function respondWithSuccess($data)
{

    http_response_code(200);
    return response()->json(['mainCode' => 1, 'code' => http_response_code(), 'data' => $data, 'error' => null])
        ->setStatusCode(200);

}

function responseWithErrorArray($errors)
{
    http_response_code(422);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(422);


}

function respondWithErrorObject($errors)
{
    http_response_code(422);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(422);
}

function respondWithErrorNOTFoundObject($errors)
{
    http_response_code(404);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(404);
}

function respondWithErrorNOTFoundArray($errors)
{
    http_response_code(404);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(404);
}

function respondWithErrorClient($errors)
{
    http_response_code(400);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(400);
}

function respondWithErrorAuthObject($errors)
{
    http_response_code(401);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(401);
}

function respondWithErrorAuthArray($errors)
{
    http_response_code(401);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(401);
}


function respondWithServerErrorArray()
{
    $errors = 'Sorry something went wrong, please try again';
    http_response_code(500);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(500);
}

function respondWithServerErrorObject()
{
    $errors = 'Sorry something went wrong, please try again';
    http_response_code(500);
    return response()->json(['mainCode' => 0, 'code' => http_response_code(), 'data' => null, 'error' => $errors])->setStatusCode(500);
}


function returnSuccessMessage($msg = "", $successNumber = "200")
{
    return [
        'status' => true,
        'successNumber' => $successNumber,
        'message' => $msg
    ];
}



function returnError($errNum, $msg)
{
    return response()->json([
        'status' => false,
        'errNum' => $errNum,
        'msg' => $msg
    ]);
}



function returnData($key, $value, $msg = "")
{
    return response()->json([
        'status' => true,
        'errNum' => "",
        'msg' => $msg,
        $key => $value
    ]);
}
