<?php

use Twilio\Rest\Client;

include './vendor/autoload.php';

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'XXXXXXXXXXXXXXXXX';
$auth_token = 'XXXXXXXXXXXXXXXXX';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+14000000000";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+524770000000',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);