<?php

namespace Sevavietl\LoggableSoap;

class SoapClient extends \SoapClient
{
    use Loggable;

    public function __construct($wsdl, array $options = [], LoggerInterface $logger = null)
    {
        $this->logger = $logger ?: new NullLogger;

        parent::__construct($wsdl, $options);
    }

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
