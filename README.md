## Simple VIN decoder for PHP 7.1+ (incl. PHP 8) based on ISO-3779

[![Gitter](https://badges.gitter.im/sunrise-php/support.png)](https://gitter.im/sunrise-php/support)
[![Build Status](https://circleci.com/gh/sunrise-php/vin.svg?style=shield)](https://circleci.com/gh/sunrise-php/vin)
[![Code Coverage](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/vin/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/vin/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/sunrise/vin.svg?label=downloads)](https://packagist.org/packages/sunrise/vin)
[![Latest Stable Version](https://img.shields.io/packagist/v/sunrise/vin.svg?label=version)](https://packagist.org/packages/sunrise/vin)
[![License](https://img.shields.io/packagist/l/sunrise/vin.svg?label=license)](https://packagist.org/packages/sunrise/vin)

## Installation

```bash
composer require sunrise/vin
```

## How to use?

```php
use InvalidArgumentException;
use Sunrise\Vin\Vin;

try {
    $vin = new Vin('WVWZZZ1KZ6W612305');
} catch (InvalidArgumentException $e) {
    // It isn't a valid VIN...
}

$vin->getVin(); // returns "WVWZZZ1KZ6W612305"
$vin->getWmi(); // returns "WVW"
$vin->getVds(); // returns "ZZZ1KZ"
$vin->getVis(); // returns "6W612305"
$vin->getRegion(); // returns "Europe"
$vin->getCountry(); // returns "Germany"
$vin->getManufacturer(); // returns "Volkswagen"
$vin->getModelYear(); // returns [2006]
```

## Useful links

* https://en.wikipedia.org/wiki/Vehicle_identification_number
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/Model_year
