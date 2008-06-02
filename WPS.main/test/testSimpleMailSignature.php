<?php
require_once '../interfaces/PostOffice.php';
require_once 'testData.php';

echo simpleSignMessage($password, $messageBody);
echo simpleCheckMessageSignature($password, $messageBody, simpleSignMessage($password, $messageBody));
?>