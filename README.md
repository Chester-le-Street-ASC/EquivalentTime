# EquivalentTime
A class based implementation of the British Swimming/SPORTSYSTEMS Equivalent
Time Algorithm. Written in-house by Chester-le-Street ASC.

This library has not yet undergone full testing, so use with caution for now.

## Basic Usage
1. Install via composer
```
composer require clsasc/equivalent-time
```
2. From there, create an EquivalentTime Object in your project
```PHP
$object = new EquivalentTime("25m", "200 Free", 116.68);
```
Parameter 1 is the length of the source pool, Parameter 2 is the event and Parameter 3 is the time, formatted as a float, `seconds.hundreds`.
3. Choose if you want the output to be formatted as a string or a float. Float output is default, but you can get it as an 'alpha format' string by invoking the `setOutputAsString(true);` method on your object
4. Get your output.
```PHP
$obj->getConversion("50m");
```
Where the parameter is the length of pool you would like your time to be converted to.
5. You can call the `getConversion($length)` method on your conversion object as many times as you wish. To convert another time, create a new object and the old one will be garbage collected by PHP after it is no longer referenced.
