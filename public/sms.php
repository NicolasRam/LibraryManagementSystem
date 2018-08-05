<?php
/**
* Liste et affiche le détail de chaque compte SMS
*
* Rendez-vous sur https://api.ovh.com/createToken/index.cgi?GET=/sms&GET=/sms/*&PUT=/sms/*&DELETE=/sms/*&POST=/sms/*
* pour générer les clés d'accès API pour:
*
* GET /sms
* GET /sms/*
* POST /sms/*
* PUT /sms/*
* DELETE /sms/*
*/

require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

$endpoint = 'ovh-eu';
$applicationKey = "mZtiA9aELf6jvcev";
$applicationSecret = "GvmTnglzP65P4w81hqardE1mAGfSBgaj";
$consumer_key = "4MbGIgKnmhWvEBD859qoQG5jy04YH9za";

$conn = new Api(    $applicationKey,
$applicationSecret,
$endpoint,
$consumer_key);

$smsServices = $conn->get('/sms/');
foreach ($smsServices as $smsService) {

print_r($smsService);
}