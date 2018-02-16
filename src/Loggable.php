<?php

namespace Sevavietl\LoggableSoap;

trait Loggable
{
    private $logger;

    protected function log(
        $request,
        $location,
        $action,
        $version,
        $response
    ) {
        $this->logger->log(
            $request,
            $location,
            $action,
            $version,
            $response
        );
    }
}
