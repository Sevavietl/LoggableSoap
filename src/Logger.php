<?php

namespace Sevavietl\LoggableSoap;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;

class Logger
{
    protected $logger;   
    protected $formatter;

    public function __construct(LoggerInterface $logger, $formatter = null)
    {
        $this->logger = $logger;
        $this->formatter = $formatter ?: $this->getDefaultFormatter();
    }

    protected function getDefaultFormatter()
    {
        return new MessageFormatter;
    }

    public function log($request, $location, $action, $version, $response)
    {
        $message = $this->formatter->format(
            $request,
            $location,
            $action,
            $version,
            $response
        );

        return $this->logger->log(LogLevel::INFO, $message);
    }
}
