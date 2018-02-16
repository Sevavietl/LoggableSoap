<?php

namespace Sevavietl\LoggableSoap;

class SoapClient extends \SoapClient
{
    use Loggable;

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        $response = parent::__doRequest(
            $request,
            $location,
            $action,
            $version,
            $one_way
        );
        
        $this->log(
            $request,
            $location,
            $action,
            $version,
            $response
        );

        return $response;
    }
}
