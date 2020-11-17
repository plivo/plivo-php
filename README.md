# plivo-php

[![Build Status](https://travis-ci.org/plivo/plivo-php.svg?branch=master)](https://travis-ci.org/plivo/plivo-php)

The Plivo PHP SDK makes it simpler to integrate communications into your PHP applications using the Plivo REST API. Using the SDK, you will be able to make voice calls, send SMS and generate Plivo XML to control your call flows.

**Supported PHP Versions**: This SDK works with PHP 7.1.0+.

## Installation

### To install Composer
#### Globally in Mac

1. Download the latest version of [Composer](https://getcomposer.org/download/). 
2. Run the following command in Terminal: 
        
        $ php ~/Downloads/composer.phar --version

3. Run the following command to make it executable:
        
        $ cp ~/Downloads/composer.phar /usr/local/bin/composer
        $ sudo chmod +x /usr/local/bin/composer
        $ Make sure you move the file to bin directory.

4. To check if the path has **/usr/local/bin**, use 
        
        $ echo $PATH

   If the path is different, use the following command to update the $PATH:    
            
        $ export PATH = $PATH:/usr/local/bin
        $ source ~/.bash_profile 

4. You can also check the version of Composer by running the following command:
        
        $ composer --version.       

#### Globally in Linux

1. Run the following command:
        
        $ curl -sS https://getcomposer.org/installer | php

2. Run the following command to make the composer.phar file as executable:
        
        $ chmod +x composer.phar

3. Run the following command to make Composer globally available for all system users:
        
        $ mv composer.phar /usr/local/bin/composer

#### Windows 10

1. Download and run the [Windows Installer](https://getcomposer.org/download/) for Composer.

    **Note:** Make sure to allow Windows Installer for Composer to make changes to your **php.ini** file.

2. If you have any terminal windows open, close all instances and open a fresh terminal instance.
3. Run the Composer command.
        
        $ composer -V

### Steps to install Plivo Package

- To install the **stable release**, run the following command in the project directory:
        
        $ composer require plivo/plivo-php

- To install a **specific release**, run the following command in the project directory:
        
        $ composer require plivo/plivo-php:4.14.0

- To test the features in the **beta release**, run the following command in the project directory:
        
        $ composer require plivo/plivo-php:v4.2-beta1

- Alternatively, you can download this source and run
        
        $ composer install

This generates the autoload files, which you can include using the following line in your PHP source code to start using the SDK.

```php
<?php
require 'vendor/autoload.php'
```

## Getting started

### Authentication

To make the API requests, you need to create a `RestClient` and provide it with authentication credentials (which can be found at [https://manage.plivo.com/dashboard/](https://manage.plivo.com/dashboard/)).

We recommend that you store your credentials in the `PLIVO_AUTH_ID` and the `PLIVO_AUTH_TOKEN` environment variables, so as to avoid the possibility of accidentally committing them to source control. If you do this, you can initialise the client with no arguments and it will automatically fetch them from the environment variables:

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient();
```

Alternatively, you can specifiy the authentication credentials while initializing the `RestClient`.

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("your_auth_id", "your_auth_token");
```

## The Basics
The SDK uses consistent interfaces to create, retrieve, update, delete and list resources. The pattern followed is as follows:

```php
<?php
$client->resources->create($params) # Create
$client->resources->get($id) # Get
$client->resources->update($id, $params) # Update
$client->resources->delete($id) # Delete
$client->resources->list() # List all resources, max 20 at a time
```

You can also use the `resource` directly to update and delete it. For example,

```php
<?php
$resource = $client->resources->get($id)
$resource->update($params) # update the resource
$resource->delete() # Delete the resource
```

Also, using `$client->resources->list()` would list the first 20 resources by default (which is the first page, with `limit` as 20, and `offset` as 0). To get more, you will have to use `limit` and `offset` to get the second page of resources.

## Examples

### Send a message

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient();
$message_created = $client->messages->create(
    'the_source_number',
    ['the_destination_number'],
    'Hello, world!'
);
```

### Make a call

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient();
$call_made = $client->calls->create(
    'the_source_number',
    ['the_destination_number'],
    'https://answer.url'
);
```

### Lookup a number

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("AUTH_ID", "AUTH_TOKEN");
$response = $client->lookup->get("<number-goes-here>");
```

### Generate Plivo XML

```php
<?php
require 'vendor/autoload.php';
use Plivo\XML\Response;

$response = new Response();
$response->addSpeak('Hello, world!');
echo($response->toXML());
```

This generates the following XML:

```xml
<?xml version="1.0" encoding="utf-8"?>
<Response>
  <Speak>Hello, world!</Speak>
</Response>
```

### Run a PHLO

```php
<?php
/**
 * Example for API Request
 */
require 'vendor/autoload.php';
use Plivo\Resources\PHLO\PhloRestClient;
use Plivo\Exceptions\PlivoRestException;
$client = new PhloRestClient("YOUR_AUTH_ID", "YOUR_AUTH_TOKEN");
$phlo = $client->phlo->get("YOUR_PHLO_ID");
try {
    $response = $phlo->run(["field1" => "value1", "field2" => "value2"]); // These are the fields entered in the PHLO console
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
?>
```

### More examples
Refer to the [Plivo API Reference](https://api-reference.plivo.com/latest/php/introduction/overview) for more examples. Also refer to the [guide to setting up dev environment](https://developers.plivo.com/getting-started/setting-up-dev-environment/) on [Plivo Developers Portal](https://developers.plivo.com) to setup a simple PHP server & use it to test out your integration in under 5 minutes.

## Reporting issues
Report any feedback or problems with this version by [opening an issue on Github](https://github.com/plivo/plivo-php/issues).
