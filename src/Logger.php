<?php

namespace Sevavietl\LoggableSoap;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

final class Logger implements LoggerInterface
{
    private $logger;   
    private $formatter;

    public function __construct(PsrLoggerInterface $logger, $formatter = null)
    {
        $this->logger = $logger;
        $this->formatter = $formatter ?: $this->getDefaultFormatter();
    }

    private function getDefaultFormatter()
    {
        return new MessageFormatter;
    }

    public function log($request, $location, $action, $version, $response)
    {
        $level   = $this->getLogLevel($response);
        $context = compact('location', 'action', 'version');

        if ($this->isSoapFault($response)) {
            $context['faultcode'] = $response->faultcode;
            $context['faultstring'] = $response->faultstring;
            $context['detail'] = $response->detail;
            $context['_name'] = $response->_name;
            $context['headerfault'] = $response->headerfault;

            $response = $response->faultstring;
        }

        $message = $this->formatter->format(
            $request,
            $location,
            $action,
            $version,
            $response
        );

        return $this->logger->log($level, $message, $context);
    }

    private function getLogLevel($response)
    {
        return $this->isSoapFault($response)
            ? LogLevel::NOTICE
            : LogLevel::INFO;
    }

    private function isSoapFault($response)
    {
        return $response instanceof \SoapFault;
    }
}
