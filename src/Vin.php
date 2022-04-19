<?php declare(strict_types=1);

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Fenric <anatoly@fenric.ru>
 * @author Saud bin Mohammed <saud@samaphp.com>
 * @copyright Copyright (c) 2018, Anatoly Fenric
 * @license https://github.com/sunrise-php/vin/blob/master/LICENSE
 * @link https://github.com/sunrise-php/vin
 */

namespace Sunrise\Vin;

/**
 * Import classes
 */
use InvalidArgumentException;

/**
 * Import functions
 */
use function date;
use function preg_match;
use function sprintf;
use function strpbrk;
use function strtoupper;

/**
 * Import constants
 */
use const Sunrise\Vin\MANUFACTURERS;
use const Sunrise\Vin\REGIONS;
use const Sunrise\Vin\YEARS;

/**
 * Vehicle Identification Number
 */
class Vin implements VinInterface
{

    /**
     * Regular expression for a VIN parsing/validation (ISO 3779)
     *
     * @var string
     *
     * @link https://www.iso.org/standard/52200.html
     */
    public const REGEX = '/^(?<wmi>[0-9A-HJ-NPR-Z]{3})(?<vds>[0-9A-HJ-NPR-Z]{6})(?<vis>[0-9A-HJ-NPR-Z]{8})$/';

    /**
     * The VIN value
     *
     * @var string
     */
    private $vin;

    /**
     * World manufacturer identifier
     *
     * @var string
     */
    private $wmi;

    /**
     * Vehicle descriptor section
     *
     * @var string
     */
    private $vds;

    /**
     * Vehicle identifier section
     *
     * @var string
     */
    private $vis;

    /**
     * Vehicle region
     *
     * @var string|null
     */
    private $region;

    /**
     * Vehicle country
     *
     * @var string|null
     */
    private $country;

    /**
     * Vehicle manufacturer
     *
     * @var string|null
     */
    private $manufacturer;

    /**
     * Vehicle model year
     *
     * @var list<int>
     */
    private $modelYear;

    /**
     * Constructor of the class
     *
     * @param string $value
     *
     * @throws InvalidArgumentException
     *         If the given value isn't a valid VIN.
     */
    public function __construct(string $value)
    {
        // VIN must be in uppercase...
        $value = strtoupper($value);

        if (!preg_match(self::REGEX, $value, $match)) {
            throw new InvalidArgumentException(sprintf(
                'The value "%s" is not a valid VIN',
                $value
            ));
        }

        $this->vin = $value;
        $this->wmi = $match['wmi'];
        $this->vds = $match['vds'];
        $this->vis = $match['vis'];

        $this->region = $this->determineVehicleRegion();
        $this->country = $this->determineVehicleCountry();
        $this->manufacturer = $this->determineVehicleManufacturer();
        $this->modelYear = $this->determineVehicleModelYear();
    }

    /**
     * {@inheritdoc}
     */
    public function getVin() : string
    {
        return $this->vin;
    }

    /**
     * {@inheritdoc}
     */
    public function getWmi() : string
    {
        return $this->wmi;
    }

    /**
     * {@inheritdoc}
     */
    public function getVds() : string
    {
        return $this->vds;
    }

    /**
     * {@inheritdoc}
     */
    public function getVis() : string
    {
        return $this->vis;
    }

    /**
     * {@inheritdoc}
     */
    public function getRegion() : ?string
    {
        return $this->region;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry() : ?string
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function getManufacturer() : ?string
    {
        return $this->manufacturer;
    }

    /**
     * {@inheritdoc}
     */
    public function getModelYear() : array
    {
        return $this->modelYear;
    }

    /**
     * Converts the object to array
     *
     * @return array{
     *           vin: string,
     *           wmi: string,
     *           vds: string,
     *           vis: string,
     *           region: ?string,
     *           country: ?string,
     *           manufacturer: ?string,
     *           modelYear: list<int>,
     *         }
     */
    public function toArray() : array
    {
        return [
            'vin' => $this->vin,
            'wmi' => $this->wmi,
            'vds' => $this->vds,
            'vis' => $this->vis,
            'region' => $this->region,
            'country' => $this->country,
            'manufacturer' => $this->manufacturer,
            'modelYear' => $this->modelYear,
        ];
    }

    /**
     * Converts the object to string
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->vin;
    }

    /**
     * Tries to determine vehicle region
     *
     * @return string|null
     */
    private function determineVehicleRegion() : ?string
    {
        return REGIONS[$this->wmi[0]]['region'] ?? null;
    }

    /**
     * Tries to determine vehicle country
     *
     * @return string|null
     */
    private function determineVehicleCountry() : ?string
    {
        $countries = REGIONS[$this->wmi[0]]['countries'] ?? null;
        if ($countries === null) {
            return null;
        }

        foreach ($countries as $chars => $name) {
            // there are keys that consist only of numbers...
            $chars = (string) $chars;

            if (strpbrk($this->wmi[1], $chars) !== false) {
                return $name;
            }
        }

        return null;
    }

    /**
     * Tries to determine vehicle manufacturer
     *
     * @return string|null
     */
    private function determineVehicleManufacturer() : ?string
    {
        return MANUFACTURERS[$this->wmi] ?? MANUFACTURERS[$this->wmi[0] . $this->wmi[1]] ?? null;
    }

    /**
     * Tries to determine vehicle model year(s)
     *
     * @return list<int>
     */
    private function determineVehicleModelYear() : array
    {
        $comingYear = date('Y') + 1;
        $estimatedYears = [];

        foreach (YEARS as $year => $char) {
            if ($this->vis[0] === $char) {
                $estimatedYears[] = $year;
            }

            if ($comingYear === $year) {
                break;
            }
        }

        return $estimatedYears;
    }
}
