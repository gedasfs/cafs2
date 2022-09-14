<?php

namespace Connectors;

class FacebookConnector 
{
    public function __construct(protected string $appName, private string $appKey)
    {
        
    }
}