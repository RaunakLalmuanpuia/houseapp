<?php

namespace App\Http\Controllers;

use App\Models\Application;
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

    function generateApplicationId(): string
    {
        do {
            $id = str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT);
        } while (Application::where('application_id', $id)->exists());

        return $id;
    }

}
