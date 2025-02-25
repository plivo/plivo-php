# plivo-php

[![UnitTests](https://github.com/plivo/plivo-php/actions/workflows/unitTests.yml/badge.svg?branch=master&event=push)](https://github.com/plivo/plivo-php/actions/workflows/unitTests.yml)

The Plivo PHP SDK makes it simpler to integrate communications into your PHP applications using the Plivo REST API. Using the SDK, you will be able to make voice calls, send SMS and generate Plivo XML to control your call flows.

**Supported PHP Versions**: This SDK works with PHP 7.3+.

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

To make the API requests, you need to create a `RestClient` and provide it with authentication credentials (which can be found at [https://console.plivo.com/dashboard/](https://console.plivo.com/dashboard/)).

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

$client = new RestClient("<auth_id>", "<auth_token>");
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
$message_created = $client->messages->create([ 
        "src" => "+14156667778", 
        "dst" => "+14156667777", 
        "text"  =>"Hello, this is a sample text from Plivo"
]);
```

### Make a call

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient();
$call_made = $client->calls->create(
    '+14156667778',
    ['+14156667777'],
    'https://answer.url'
);
```

### Lookup a number

```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>", "<auth_token>");
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
$client = new PhloRestClient("<auth_id>", "<auth_token>");
$phlo = $client->phlo->get("<phlo_id>");
try {
    $response = $phlo->run(["field1" => "value1", "field2" => "value2"]); // These are the fields entered in the PHLO console
    print_r($response);
} catch (PlivoRestException $ex) {
    print_r($ex);
}
?>
```

## WhatsApp Messaging
Plivo's WhatsApp API allows you to send different types of messages over WhatsApp, including templated messages, free form messages and interactive messages. Below are some examples on how to use the Plivo Go SDK to send these types of messages.

### Templated Messages
Templated messages are a crucial to your WhatsApp messaging experience, as businesses can only initiate WhatsApp conversation with their customers using templated messages.

WhatsApp templates support 4 components:  `header` ,  `body`,  `footer`  and `button`. At the point of sending messages, the template object you see in the code acts as a way to pass the dynamic values within these components.  `header`  can accomodate `text` or `media` (images, video, documents) content.  `body`  can accomodate text content.  `button`  can support dynamic values in a `url` button or to specify a developer-defined payload which will be returned when the WhatsApp user clicks on the `quick_reply` button. `footer`  cannot have any dynamic variables.

Example:
```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$template = '{ 
            "name": "template_name",
            "language": "en_US",
            "components": [
                {
                    "type": "header",
                    "parameters": [
                        {
                            "type": "media",
                            "media": "https://xyz.com/s3/img.jpg"
                        }
                    ]
                },
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "WA-Text"
                        }
                    ]
                }
            ]
          }';

$response = $client->messages->create([  
        "src" => "+14156667778",
        "dst" => "+14156667777",
        "type"=> "whatsapp",
        "template"=> $template,
        "url"=> "https://foo.com/wa_status/"
]);
print_r($response);
?>
```

### Templated WhatsApp Messages With Named Parameter
This guide shows how to send templated WhatsApp messages with named parameters.

Example:
```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$template = '{ 
            "name": "template_name",
            "language": "en_US",
            "components": [
                {
                    "type": "header",
                    "parameters": [
                        {
                            "type": "text",
                            "parameter_name": "header_title",
                            "text": "WA-header"
                        }
                    ]
                },
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "parameter_name": "user_name",
                            "text": "Saurabh"
                        }
                    ]
                }
            ]
          }';

$response = $client->messages->create([  
        "src" => "+14156667778",
        "dst" => "+14156667777",
        "type"=> "whatsapp",
        "template"=> $template,
        "url"=> "https://foo.com/wa_status/"
]);
print_r($response);
?>
```

### Free Form Messages
Non-templated or Free Form WhatsApp messages can be sent as a reply to a user-initiated conversation (Service conversation) or if there is an existing ongoing conversation created previously by sending a templated WhatsApp message.

#### Free Form Text Message
Example:
```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");
$response = $client->messages->create([  
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "text"=> "Hello, this is sample text",
        "type"=> "whatsapp",
        "url"=> "https://foo.com/wa_status/"
]);
print_r($response);
?>
```

#### Free Form Media Message
Example:
```php
<?php
require 'vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");
$response = $client->messages->create([  
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "text"=> "Hello, this is sample text",
        "type"=> "whatsapp",
        "media_urls"=> ["https://sample-videos.com/img/Sample-png-image-1mb.png"],
        "url"=> "https://foo.com/wa_status/"
]);
print_r($response);
?>
```

### Interactive Messages
This guide shows how to send non-templated interactive messages to recipients using Plivo’s APIs.

#### Quick Reply Buttons
Quick reply buttons allow customers to quickly respond to your message with predefined options.

Example:
```php
<?php
require '/usr/src/app/vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$interactive = '{
        "type": "button",
        "header": {
            "type": "media",
            "media": "https://xyz.com/s3/img.jpg"
        },
        "body": {
            "text": "Make your selection"
        },
        "action": {
            "buttons": [
                {
                    "title": "Click here",
                    "id": "bt1"
                },
                {
                    "title": "Know More",
                    "id": "bt2"
                },
                {
                    "title": "Request Callback",
                    "id": "bt3"
                }
            ]
        }
    }';

$response = $client->messages->create([
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "type"=> "whatsapp",
        "interactive"=> $interactive
]);
print_r($response);
?>
```

#### Interactive Lists
Interactive lists allow you to present customers with a list of options.

Example:
```php
<?php
require '/usr/src/app/vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$interactive = '{
        "type": "list",
        "header": {
            "type": "text",
            "text": "Welcome to Plivo"
        },
        "body": {
            "text": "You can review the list of rewards we offer"
        },
        "footer": {
            "text": "Yours Truly"
        },
        "action": {
            "buttons": [{
                "title": "Click here"
            }],
            "sections": [
                {
                    "title": "SECTION_1_TITLE",
                    "rows": [
                        {
                            "id": "SECTION_1_ROW_1_ID",
                            "title": "SECTION_1_ROW_1_TITLE",
                            "description": "SECTION_1_ROW_1_DESCRIPTION"
                        },
                        {
                            "id": "SECTION_1_ROW_2_ID",
                            "title": "SECTION_1_ROW_2_TITLE",
                            "description": "SECTION_1_ROW_2_DESCRIPTION"
                        }
                    ]
                },
                {
                    "title": "SECTION_2_TITLE",
                    "rows": [
                        {
                            "id": "SECTION_2_ROW_1_ID",
                            "title": "SECTION_2_ROW_1_TITLE",
                            "description": "SECTION_2_ROW_1_DESCRIPTION"
                        },
                        {
                            "id": "SECTION_2_ROW_2_ID",
                            "title": "SECTION_2_ROW_2_TITLE",
                            "description": "SECTION_2_ROW_2_DESCRIPTION"
                        }
                    ]
                }
            ]
        }
    }';

$response = $client->messages->create(
        [
                "src"=> "+14156667778",
                "dst"=> "+14156667777",
                "type"=> "whatsapp",
                "interactive"=> $interactive
        ]
);
print_r($response);
?>
```

#### Interactive CTA URLs
CTA URL messages allow you to send links and call-to-action buttons.

Example:
```php
<?php
require '/usr/src/app/vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$interactive = '{
      "type": "cta_url",
        "header": {
            "type": "media",
            "media": "https://xyz.com/s3/img.jpg"
        },
        "body": {
            "text": "Know More"
        },
        "footer": {
            "text": "Plivo"
        },
        "action": {
            "buttons": [
                {
                    "title": "Click here",
                    "cta_url": "https:plivo.com"
                }
            ]
        }
    }';

$response = $client->messages->create([
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "type"=> "whatsapp",
        "interactive"=> $interactive
]);
print_r($response);
?>
```

### Location Messages
This guide shows how to send templated and non-templated location messages to recipients using Plivo’s APIs.

#### Templated Location Messages
Example:
```php
<?php
require '/usr/src/app/vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$template = '{
        "name": "plivo_order_pickup",
        "language": "en_US",
        "components": [
            {
                "type": "header",
                "parameters": [
                    {
                        "type": "location",
                        "location": {
                            "longitude": "122.148981",
                            "latitude": "37.483307",
                            "name": "Pablo Morales",
                            "address": "1 Hacker Way, Menlo Park, CA 94025"
                        }
                    }
                ]
            }
        ]
    }';

$response = $client->messages->create([
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "type"=> "whatsapp",
        "template"=> $template
]);
print_r($response);
?>
```

#### Non-Templated Location Messages
Example:
```php
<?php
require '/usr/src/app/vendor/autoload.php';
use Plivo\RestClient;

$client = new RestClient("<auth_id>","<auth_token>");

$location = '{
        "longitude": "122.148981",
        "latitude": "37.483307",
        "name": "Pablo Morales",
        "address": "1 Hacker Way, Menlo Park, CA 94025"
    }';

$response = $client->messages->create([
        "src"=> "+14156667778",
        "dst"=> "+14156667777",
        "type"=> "whatsapp",
        "location"=> $location
]);
print_r($response);
?>
```

### More examples
More examples are available [here](https://github.com/plivo/plivo-examples-php). Also refer to the [guides for configuring the PHP laravel to run various scenarios](https://www.plivo.com/docs/sms/quickstart/php-laravel/) & use it to test out your integration in under 5 minutes.

## Reporting issues
Report any feedback or problems with this version by [opening an issue on Github](https://github.com/plivo/plivo-php/issues).

## Local Development
> Note: Requires latest versions of Docker & Docker-Compose. If you're on MacOS, ensure Docker Desktop is running.
1. Export the following environment variables in your host machine:
```bash
export PLIVO_AUTH_ID=<your_auth_id>
export PLIVO_AUTH_TOKEN=<your_auth_token>
export PLIVO_API_DEV_HOST=<plivoapi_dev_endpoint>
export PLIVO_API_PROD_HOST=<plivoapi_public_endpoint>
```
2. Run `make build`. This will create a docker container in which the sdk will be setup and dependencies will be installed.
> The entrypoint of the docker container will be the `setup_sdk.sh` script. The script will handle all the necessary changes required for local development.
3. The above command will print the docker container id (and instructions to connect to it) to stdout.
4. The testing code can be added to `<sdk_dir_path>/php-sdk-test/test.php` in host  
 (or `/usr/src/app/php-sdk-test/test.php` in container)
5. The sdk directory will be mounted as a volume in the container. So any changes in the sdk code will also be reflected inside the container.
> To use the local code in the test file, import the sdk in test file using:   
`require /usr/src/app/vendor/autoload.php`   
(Local sdk code will be mounted at `/usr/src/app` inside the container and `vendor` directory will be created by setup script while installing dependencies).
6. To run test code, run `make run CONTAINER=<cont_id>` in host.
7. To run unit tests, run `make test CONTAINER=<cont_id>` in host.
> `<cont_id>` is the docker container id created in 2.
(The docker container should be running)

> Test code and unit tests can also be run within the container using
`make run` and `make test` respectively. (`CONTAINER` argument should be omitted when running from the container)