<?php

namespace App\Http\Controllers;

use App\Models\Otp;

use App\Util\AppUtil;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;


abstract class Controller
{
    //
    use AuthorizesRequests, ValidatesRequests;


    public function sendOtp(Request $request)
    {
//        dd($request);
        $data=$this->validate($request, [
            'contact'=>['required','digits:10'],
            'type'=>['required']
        ]);

        $otp=env('APP_DEBUG')?1111:rand(1000, 9999);

        Otp::query()->create([
            'recipient' => $data['contact'],
            'type' => $data['type'],
            'otp' => $otp
        ]);

        return AppUtil::sendOtp($otp, $data['contact']);
    }

}
