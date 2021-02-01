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
 * Vehicle Identification Number
 */
class Vin implements VinInterface
{

    /**
     * Regular expression for a VIN parsing/validation (ISO 3779)
     *
     * @var string
     */
    public const REGEX = '/^(?<wmi>[0-9A-HJ-NPR-Z]{3})(?<vds>[0-9A-HJ-NPR-Z]{6})(?<vis>[0-9A-HJ-NPR-Z]{8})$/';

    /**
     * The VIN code
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
     * @var null|string
     */
    private $region;

    /**
     * Vehicle country
     *
     * @var null|string
     */
    private $country;

    /**
     * Vehicle manufacturer
     *
     * @var null|string
     */
    private $manufacturer;

    /**
     * Vehicle model year
     *
     * @var int[]
     */
    private $modelYear;

    /**
     * Constructor of the class
     *
     * @param string $value
     *
     * @throws InvalidArgumentException If the given string is not a valid VIN.
     */
    public function __construct(string $value)
    {
        // The given VIN must be in upper case...
        $value = strtoupper($value);

        if (!preg_match(self::REGEX, $value, $match)) {
            throw new InvalidArgumentException(
                sprintf('The value "%s" is not a valid VIN', $value)
            );
        }

        // Base values
        $this->vin = $value;
        $this->wmi = $match['wmi'];
        $this->vds = $match['vds'];
        $this->vis = $match['vis'];

        // Parsed values
        $this->region = $this->determineRegion();
        $this->country = $this->determineCountry();
        $this->manufacturer = $this->determineManufacturer();
        $this->modelYear = $this->determineModelYear();
    }

    /**
     * {@inheritDoc}
     */
    public function getVin() : string
    {
        return $this->vin;
    }

    /**
     * {@inheritDoc}
     */
    public function getWmi() : string
    {
        return $this->wmi;
    }

    /**
     * {@inheritDoc}
     */
    public function getVds() : string
    {
        return $this->vds;
    }

    /**
     * {@inheritDoc}
     */
    public function getVis() : string
    {
        return $this->vis;
    }

    /**
     * {@inheritDoc}
     */
    public function getRegion() : ?string
    {
        return $this->region;
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry() : ?string
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     */
    public function getManufacturer() : ?string
    {
        return $this->manufacturer;
    }

    /**
     * {@inheritDoc}
     */
    public function getModelYear() : array
    {
        return $this->modelYear;
    }

    /**
     * Converts the object to array
     *
     * @return array
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
     * Tries to determine vehicle region
     *
     * @return null|string
     */
    private function determineRegion() : ?string
    {
        return REGIONS[$this->wmi[0]]['region'] ?? null;
    }

    /**
     * Tries to determine vehicle country
     *
     * @return null|string
     */
    private function determineCountry() : ?string
    {
        $countries = REGIONS[$this->wmi[0]]['countries'] ?? null;
        if (null === $countries) {
            return null;
        }

        foreach ($countries as $chars => $name) {
            if (!(false === strpbrk($this->wmi[1], (string) $chars))) {
                return $name;
            }
        }

        return null;
    }

    /**
     * Tries to determine vehicle manufacturer
     *
     * @return null|string
     */
    private function determineManufacturer() : ?string
    {
        return MANUFACTURERS[$this->wmi] ?? MANUFACTURERS[$this->wmi[0] . $this->wmi[1]] ?? null;
    }

    /**
     * Tries to determine vehicle model year(s)
     *
     * @return int[]
     */
    private function determineModelYear() : array
    {
        $comingYear = (int) date('Y') + 1;
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
