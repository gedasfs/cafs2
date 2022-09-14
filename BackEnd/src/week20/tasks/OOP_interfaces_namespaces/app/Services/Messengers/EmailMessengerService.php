<?php

namespace Services\Messengers;

use Interfaces\Messenger;

class EmailMessengerService implements Messenger
{
    public function __construct(private string $host, private string $username, private string $password)
    {
        
    }

    public function send(string $sendTo, string $body)
    {
        // get host, username, password. 
        // if OK, send

        // if send OK
        // return true or result

        var_dump(__METHOD__, func_get_args());
    }
}