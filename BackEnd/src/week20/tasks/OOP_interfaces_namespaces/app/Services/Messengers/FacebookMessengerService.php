<?php

namespace Services\Messengers;

use Interfaces\Messenger;
use Connectors\FacebookConnector;

class FacebookMessengerService implements Messenger
{
    public function __construct(private FacebookConnector $facebookConnector)
    {
        
    }

    public function send(string $sendTo, string $body)
    {
        // connect to FacebookConnector
        // $this->facebookConnector->connect

        // if connection OK, send

        // if send OK
        // return true of result
        
        var_dump(__METHOD__, func_get_args());
    }
}