# XML to PHP Array Converter

[![Build Status](https://travis-ci.org/multidimension-al/xml-array.svg)](https://travis-ci.org/multidimension-al/xml-array)
[![Latest Stable Version](https://poser.pugx.org/multidimensional/xml-array/v/stable.svg)](https://packagist.org/packages/multidimensional/xml-array)
[![Code Coverage](https://scrutinizer-ci.com/g/multidimension-al/xml-array/badges/coverage.png)](https://scrutinizer-ci.com/g/multidimension-al/xml-array/)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/multidimensional/xml-array/license.svg)](https://packagist.org/packages/multidimensional/xml-array)
[![Total Downloads](https://poser.pugx.org/multidimensional/xml-array/d/total.svg)](https://packagist.org/packages/multidimensional/xml-array)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/multidimension-al/xml-array/badges/quality-score.png)](https://scrutinizer-ci.com/g/multidimension-al/xml-array/)

This is a very simple and basic library that will create a PHP Array from a well formatted XML input. This library does the opposite of our [DOM-Array](https://github.com/multidimension-al/dom-array) library which converts an array into an XML file.

## Requirements

* PHP 5.5+

# Installation

The easiest way to install this library is to use composer. To install, simply include the following in your ```composer.json``` file:

```
"require": {
    "php": ">=5.6",
    "multidimensional/xml-array": "*"
}
```

Or run the following command from a terminal or shell:

```
composer require --prefer-dist multidimensional/xml-array
```

You can also specify version constraints, with more information available [here](https://getcomposer.org/doc/articles/versions.md).

# Usage

This library utilizes PSR-4 autoloading, so make sure you include the library near the top of your class file:

```php
use Multidimensional\XmlArray\XMLArray;
```

How to use in your code:

```php
$xml = '<tag>Value</tag>';
$array = XMLArray::generateArray($xml);
print_r($array);

//$array = array("tag" => array(0 => 'Value'));
```

By default, the library will convert attributes and will prepend ```@``` prior to the name of the attribute. You can disable the conversion of attributes by setting the 2nd parameter in ```generateArray``` to false.

When set to false, the attributes will be placed in an array, typically marked by the value '@attributes'. 

# Contributing

We appreciate all help in improving this library by either adding functions to improving existing functionality. If you do want to add to our library, please ensure you use PSR-2 formatting and add unit testing for all added functions.

Feel free to fork and submit a pull request!

# License

    MIT License
    
    Copyright (c) 2017 - 2019 multidimension.al
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.