<?php

namespace Sevavietl\LoggableSoap;

final class NullLogger implements LoggerInterface
{
    public function log($request, $location, $action, $version, $response)
    {
        
    }
}
