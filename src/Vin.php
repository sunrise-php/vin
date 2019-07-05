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
     * Regular expression for a VIN parsing (ISO 3779)
     *
     * @var string
     */
    public const REGEX = '/^(?<wmi>[0-9A-HJ-NPR-Z]{3})(?<vds>[0-9A-HJ-NPR-Z]{6})(?<vis>[0-9A-HJ-NPR-Z]{8})$/';

    /**
     * @var string
     */
    private $vin;

    /**
     * @var string
     */
    private $wmi;

    /**
     * @var string
     */
    private $vds;

    /**
     * @var string
     */
    private $vis;

    /**
     * @var null|string
     */
    private $region;

    /**
     * @var null|string
     */
    private $country;

    /**
     * @var null|string
     */
    private $manufacturer;

    /**
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

        if (! preg_match(self::REGEX, $value, $match)) {
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
        $this->region = $this->identifyRegion();
        $this->country = $this->identifyCountry();
        $this->manufacturer = $this->identifyManufacturer();
        $this->modelYear = $this->identifyModelYear();
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
     * {@inheritDoc}
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
     * @return null|string
     */
    private function identifyRegion() : ?string
    {
        // undefined region...
        if (! isset(REGIONS[$this->wmi[0]])) {
            return null;
        }

        return REGIONS[$this->wmi[0]]['region'] ?? null;
    }

    /**
     * @return null|string
     */
    private function identifyCountry() : ?string
    {
        // undefined region...
        if (! isset(REGIONS[$this->wmi[0]])) {
            return null;
        }

        foreach (REGIONS[$this->wmi[0]]['countries'] as $chars => $title) {
            if (! (false === strpbrk($this->wmi[1], $chars))) {
                return $title;
            }
        }

        return null;
    }

    /**
     * @return null|string
     */
    private function identifyManufacturer() : ?string
    {
        return MANUFACTURERS[$this->wmi] ?? MANUFACTURERS[$this->wmi[0] . $this->wmi[1]] ?? null;
    }

    /**
     * @return int[]
     */
    private function identifyModelYear() : array
    {
        $comingYear = (int) date('Y') + 1;
        $certainYears = [];

        foreach (YEARS as $year => $char) {
            if ($this->vis[0] === $char) {
                $certainYears[] = $year;
            }

            if ($comingYear === $year) {
                break;
            }
        }

        return $certainYears;
    }
}
