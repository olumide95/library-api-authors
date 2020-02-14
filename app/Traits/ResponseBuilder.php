<?php 

namespace App\Traits;
use Illuminate\Http\JsonResponse;

trait ResponseBuilder
{

    public function successResponse ($data, $code = JsonResponse::HTTP_OK)
    {
        return response()->json(is_array($data) ? $data : ['message' => $data], $code);
    }



    public function errorResponse ($message, $code)
    {
        return response()->json(['error' => $message,'code' => $code], $code);
    }

}