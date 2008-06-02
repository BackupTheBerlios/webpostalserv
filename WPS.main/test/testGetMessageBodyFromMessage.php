<?php
require_once '../interfaces/PostOffice.php';
require_once 'testData.php';

$messageBody=getMessageBodyFromMessage($message);

echo $messageBody['body'];
?>