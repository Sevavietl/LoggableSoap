Loggable SOAP Client
====================

Class and trait that help you to add logging (with logger that implements [Logger Interface](https://www.php-fig.org/psr/psr-3/)) to [`SoapClient`](http://php.net/manual/en/class.soapclient.php).

Usage
-----

If you are using [Monolog](https://github.com/Seldaek/monolog) for logging, you can set up `SoapClient` as following:

```php
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Sevavietl\LoggableSoap\Logger as SoapLogger;
use Sevavietl\LoggableSoap\SoapClient;

$logger = new Logger('default');
$logger->pushHandler(new RotatingFileHandler('path/to/your.log'));
$logger = new SoapLogger($logger);

$client = new SoapClient($wsdl);
$client->setLogger($logger);
```

License
-------

Licensed under the MIT License

Acknowledgments
---------------

- [Logging all Soap request and responses in PHP](https://stackoverflow.com/questions/1729345/logging-all-soap-request-and-responses-in-php/1729614)
- [rtheunissen/guzzle-log-middleware](https://github.com/rtheunissen/guzzle-log-middleware)
- [MessageFormatter](https://github.com/guzzle/guzzle/blob/master/src/MessageFormatter.php)
