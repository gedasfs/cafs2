<?php

namespace Services\Messengers;

use Interfaces\Messenger;

class SmsMessengerService implements Messenger
{
    public function __construct()
    {
        
    }

    public function send(string $sendTo, string $body)
    {
        // check $sendTo --> if is valid phone number
        // if OK, send

        // if send OK
        // return true or result

        var_dump(__METHOD__, func_get_args());
    }
}