<?php

namespace Sevavietl\LoggableSoap;

class MessageFormatter
{
    /**
     * @var string
     */
    const SCLF = "{hostname} - [{date_common_log}] \"{action} {location} SOAP/{version}\" REQUEST: [{request}] RESPONSE: [{response}]";

    private $template;

    public function __construct($template = self::SCLF)
    {
        $this->template = $template ?: self::SCLF;
    }

    public function format(
        $request,
        $location,
        $action,
        $version,
        $response
    ) {
        $cache = [];
        return preg_replace_callback(
            '/{\s*([A-Za-z_\-\.0-9]+)\s*}/',
            function (array $matches) use ($request, $location, $action, $version, $response, &$cache) {
                if (isset($cache[$matches[1]])) {
                    return $cache[$matches[1]];
                }
                $result = '';
                switch ($matches[1]) {
                    case 'request':
                        $result = $request;
                        break;
                    case 'response':
                        $result = $response;
                        break;
                    case 'ts':
                    case 'date_iso_8601':
                        $result = gmdate('c');
                        break;
                    case 'date_common_log':
                        $result = date('d/M/Y:H:i:s O');
                        break;
                    case 'action':
                        $result = $action;
                        break;
                    case 'version':
                        $result = $version;
                        break;
                    case 'uri':
                    case 'url':
                        $result = $request->getUri();
                        break;
                    case 'hostname':
                        $result = gethostname();
                        break;
                    case 'location':
                        $result = $location;
                        break;
                    default:
                        $result = 'NULL';
                }
                $cache[$matches[1]] = $result;
                return $result;
            },
            $this->template
        );
    }
}
