# EquivalentTime
A class based implementation of the British Swimming/SPORTSYSTEMS Equivalent
Time Algorithm. Written in-house by Chester-le-Street ASC.

## Basic Usage
1. Install via composer
```
composer require clsasc/equivalent-time
```
2. From there, create an EquivalentTime Object in your project
```PHP
use CLSASC\EquivalentTime\EquivalentTime;
$object = new EquivalentTime("25m", "200 Free", 116.68);
```
Parameter 1 is the length of the source pool, Parameter 2 is the event and
Parameter 3 is the time, formatted as a float, `seconds.hundreds` - You may wish
to cast this to a float, just in case your code takes in time as a string.

3. Choose if you want the output to be formatted as a string or a float. Float
output is default, but you can get it as an 'alpha format' (MM:SS:H) string by
invoking the `setOutputAsString();` method on your object. Switch back by
calling the `setOutputAsReal();` method on your object.

4. Get your output. ```PHP $object->getConversion("50m"); ``` Where the
parameter is the length of pool you would like your time to be converted to.

5. You can call the `getConversion($length)` method on your conversion object as
many times as you wish. To convert another time, create a new object and the old
one will be garbage collected by PHP after it is no longer referenced.

## Documentation
[Full API Style documentation](/docs) is available (phpDocumentor).

## Accepted Source Pool Lengths
Source Pool Length names are shown as they should be entered as a string to the
converter object.

The same strings  as listed below should be used when calling a method to obtain
a converted time, though you should always `try {...} catch (Exception ...) {...}`
when calling the method as if the event cannot be swum in the distance you have
requested, the converter will throw an exception to alert you to the problem.

* `20m`
* `25m`
* `33 1/3m`
* `50m`
* `20y`
* `25y`
* `26 2/3y`
* `27 1/2y`
* `33 1/3y`

## Accepted Events
Below is a list of events accepted by the time converter. Some events are only
accepted for a subset of source pool lengths, described by the list following
the event name. If you do try to create an object with an event and source pool
length which are incompatible, an exception will be thrown, which you should
`catch...`.

Event names are shown as they should be entered as a string to the converter
object.

* `50 Free` is allowed with the following source pool lengths;
  * `50m`
  * `25m`
  * `27 1/2y`
  * `25y`
* `100 Free`
* `200 Free`
* `400 Free`
* `800 Free`
* `1500 Free` is not allowed with the following source pool lengths;
  * `33 1/3y`
  * `20y`
* `50 Breast` is allowed with the following source pool lengths;
  * `50m`
  * `25m`
  * `27 1/2y`
  * `25y`
* `100 Breast`
* `200 Breast`
* `50 Fly` is allowed with the following source pool lengths;
  * `50m`
  * `25m`
  * `27 1/2y`
  * `25y`
* `100 Fly`
* `200 Fly`
* `50 Back` is allowed with the following source pool lengths;
  * `50m`
  * `25m`
  * `27 1/2y`
  * `25y`
* `100 Back`
* `200 Back`
* `200 IM`
* `400 IM`

## Exceptions
The system will throw exceptions for error conditions. [Please read the
docs](/docs) for full details on these.
