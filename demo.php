<?php
require_once 'vendor/autoload.php';

use Plivo\Plivo;

// Load env
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$auth_id = getenv('AUTH_ID');
$auth_token = getenv('AUTH_TOKEN');

$plivo = new Plivo($auth_id, $auth_token);

// Fetch the details
$response = $plivo->get_messages();

// Print the response
print_r ($response['response']);