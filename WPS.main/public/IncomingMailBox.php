<?php
/*
 * This file performs receiving the envelope , and outputs an envelope containing a message with an exchange receipt
 */
require_once '../interfaces/PostOffice.php';
$envelope=file_get_contents('php://input');
echo receiveEnvelopeAndGiveReceipt($envelope,$password);
?>
