<?php

namespace Sevavietl\LoggableSoap;

trait Loggable
{
    private $logger;
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function unsetLogger()
    {
        $this->logger = null;

        return $this;
    }

    protected function log(
        $request,
        $location,
        $action,
        $version,
        $response
    ) {
        if (null === $this->logger) {
            return;
        }

        $this->logger->log(
            $request,
            $location,
            $action,
            $version,
            $response
        );
    }
}
