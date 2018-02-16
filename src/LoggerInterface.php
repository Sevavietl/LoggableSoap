<?php

namespace Sevavietl\LoggableSoap;

interface LoggerInterface
{
    public function log($request, $location, $action, $version, $response);
}
