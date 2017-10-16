# Laravel Clickatell REST API

For Laravel 5.0 and above. This package allows integration with the new [Clickatell](https://portal.clickatell.com) website.

## Introduction
Integrate Clickatell in your laravel application and send sms using this package.

## Getting Started
To get started add the following package to your `composer.json` file.

    composer require bigbharatjain/laravel-clickatell

## Configuring
When composer installs Clickatell library successfully, register the `Clickatell\ClickatellServiceProvider` in your `config/app.php` configuration file.

```php
'providers' => [
    // Other service providers...
    Clickatell\ClickatellServiceProvider::class,
],
```
Also, add the `Clickatell` facade to the `aliases` array in your `app` configuration file:

```php
'aliases' => [
    // Other aliases
    'Clickatell' => Clickatell\ClickatellFacade::class,
],
```
#### One more step to go....
It will publish a `clickatell.php` in config folder
Add set Clickatell api_key here or create an environment variable `CLICKATELL_API_KEY`

## Usage

The new APIs only support `sendMessage` call and webhooks for outgoing and inbound messages via a *RESTful* interface.

``` php
namespace App\Http\Controllers;

use Clickatell\Rest;
use Clickatell\ClickatellException;

class SendSmsController extends Controller
{
$clickatell = new \Clickatell\Rest();

// Full list of support parameters can be found at https://www.clickatell.com/developers/api-documentation/rest-api-request-parameters/
try {
    $result = $clickatell->sendMessage(['to' => ['27111111111'], 'content' => 'Message Content']);

    foreach ($result['messages'] as $message) {
        var_dump($message);

        /*
        [
            'apiMsgId'  => null|string,
            'accepted'  => boolean,
            'to'        => string,
            'error'     => null|string
        ]
        */
    }

} catch (ClickatellException $e) {
    // Any API call error will be thrown and should be handled appropriately.
    // The API does not return error codes, so it's best to rely on error descriptions.
    var_dump($e->getMessage());
}
```

### Status/Reply Callback

After configuring your webhooks/callbacks inside the developer portal, you can use the static callback methods to listen for web requests from Clickatell. These callbacks will extract the supported fields from the request body.

``` php
use Clickatell\Rest;
use Clickatell\ClickatellException;

// Outgoing traffic callbacks (MT callbacks)
Rest::parseStatusCallback(function ($result) {
    var_dump($result);
    // This will execute if the request to the web page contains all the values
    // specified by Clickatell. Requests that omit these values will be ignored.
});

// Incoming traffic callbacks (MO/Two Way callbacks)
Rest::parseReplyCallback(function ($result) {
    var_dump($result);
    // This will execute if the request to the web page contains all the values
    // specified by Clickatell. Requests that omit these values will be ignored.
});

```

## Credits

[PHP library for the Clickatell Platform](https://github.com/clickatell/clickatell-php)

## Issues/Contributions

Found a bug or missing a feature? Log it [here](https://github.com/bigbharatjain/clickatell/issues) and I will take a look.
