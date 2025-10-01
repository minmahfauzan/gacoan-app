<?php

require __DIR__.'/vendor/autoload.php';

$methods = get_class_methods('Endroid\QrCode\Builder\Builder');

print_r($methods);