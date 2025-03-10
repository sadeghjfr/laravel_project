<?php

namespace App\Http\Services\Message\SMS;

use Illuminate\Support\Facades\Config;

class RayganSmsService
{
    public $userName;
    public $password;

    function __construct(){

        $this->userName = Config::get('sms.username');
        $this->password = Config::get('sms.password');
    }

    function sendCode($to, $text){

        $Url="http://smspanel.Trez.ir/AutoSendCode.ashx";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query(
                array(
                    'Username' => $this->userName,
                    'Password'=>$this->password,
                    'Mobile'=>$to,
                    'Footer'=>$text
                )
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return $server_output;

    }

    function isCodeValid($to, $code){

        $Url="http://smspanel.Trez.ir/CheckSendCode.ashx";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query(array('Username' => $this->userName,
                'Password'=>$this->password,
                'Mobile'=>$to,
                'Code'=>$code)));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        return $server_output;
    }

    function sendCustomMessage($to, $text)
    {
        $Url="http://smspanel.Trez.ir/SendMessageWithCode.ashx";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query(
                array(
                    'Username' => $this->userName,
                    'Password'=>$this->password,
                    'Mobile'=>$to,
                    'Message'=>$text
                )
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        return $server_output;
    }

}
