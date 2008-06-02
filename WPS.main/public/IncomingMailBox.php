<?php
require_once '../interfaces/PostOffice.php';
$envelope=file_get_contents('php://input');
echo receiveEnvelopeAndGiveReceipt($envelope,$password);
?>
