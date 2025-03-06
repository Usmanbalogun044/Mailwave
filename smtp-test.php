<?php
$host = 'smtp-relay.brevo.com';
$port = 587;

$connection = fsockopen($host, $port, $errno, $errstr, 10);
if (!$connection) {
    echo "Failed to connect: $errstr ($errno)\n";
} else {
    echo "Connected successfully to Brevo SMTP!";
    fclose($connection);
}
?>
