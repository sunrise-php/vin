# Sunrise VIN

> Vehicle Identification Number

[![Build Status](https://api.travis-ci.com/sunrise-php/vin.svg?branch=master)](https://travis-ci.com/sunrise-php/vin)
[![CodeFactor](https://www.codefactor.io/repository/github/sunrise-php/vin/badge)](https://www.codefactor.io/repository/github/sunrise-php/vin)
[![Latest Stable Version](https://poser.pugx.org/sunrise/vin/v/stable)](https://packagist.org/packages/sunrise/vin)
[![Total Downloads](https://poser.pugx.org/sunrise/vin/downloads)](https://packagist.org/packages/sunrise/vin)
[![License](https://poser.pugx.org/sunrise/vin/license)](https://packagist.org/packages/sunrise/vin)

## Installation

```
composer require sunrise/vin
```

## Usage

```php
try
{
    $vin = new \Sunrise\Vin\Vin('wvwzzz1kz6w612305');
}
catch (\InvalidArgumentException $e)
{
    // It's not a valid VIN
}

$vin->getVin(); // returns "WVWZZZ1KZ6W612305"
$vin->getWmi(); // returns "WVW"
$vin->getVds(); // returns "ZZZ1KZ"
$vin->getVis(); // returns "6W612305"
$vin->getRegion(); // returns "Europe"
$vin->getCountry(); // returns "Germany"
$vin->getManufacturer(); // returns "Volkswagen"
```
