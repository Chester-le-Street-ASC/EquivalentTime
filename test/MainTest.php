<?php

/**
 * Run this code to test the converter. You can change the variables as you
 * please
 */

$object = new EquivalentTime("50m", "200 Free", 	119.31);
$object->setOutputAsString(true);

echo "25m -     " . $object->getConversion("25m") . "\r\n";
echo "33.3m -   " . $object->getConversion("33 1/3m") . "\r\n";
echo "20m -     " . $object->getConversion("20m") . "\r\n";
echo "36 2/3y - " . $object->getConversion("36 2/3y") . "\r\n";
echo "27 1/2y - " . $object->getConversion("27 1/2y") . "\r\n";
echo "33 1/3y - " . $object->getConversion("33 1/3y") . "\r\n";
echo "25y -     " . $object->getConversion("25y") . "\r\n";
echo "20y -     " . $object->getConversion("20y") . "\r\n";
