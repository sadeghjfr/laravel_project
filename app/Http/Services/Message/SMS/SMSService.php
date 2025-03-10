<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;

class SMSService implements MessageInterface
{

    private $from;
    private $to;
    private $text;
    private $isFlash = true;

    public function fire()
    {
        //$meliPayamak = new MeliPayamakService();
        //$meliPayamak->sendSmsSoapClient($this->from, $this->to, $this->text, $this->isFlash);
        $rayganSms = new RayganSmsService();
        $rayganSms->sendCode($this->to, $this->text);
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }


    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }


    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getIsFlash()
    {
        return $this->isFlash;
    }

    public function setIsFlash($isFlash)
    {
        $this->isFlash = $isFlash;
    }

}
