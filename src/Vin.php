<?php declare(strict_types=1);

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Fenric <anatoly@fenric.ru>
 * @copyright Copyright (c) 2018, Anatoly Fenric
 * @license https://github.com/sunrise-php/vin/blob/master/LICENSE
 * @link https://github.com/sunrise-php/vin
 */

namespace Sunrise\Vin;

/**
 * Import constants
 */
use const Sunrise\Vin\MANUFACTURERS;
use const Sunrise\Vin\REGIONS;

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
	 * The VIN
	 *
	 * @var string
	 */
	protected $vin;

	/**
	 * WMI of the VIN
	 *
	 * @var string
	 */
	protected $wmi;

	/**
	 * VDS of the VIN
	 *
	 * @var string
	 */
	protected $vds;

	/**
	 * VIS of the VIN
	 *
	 * @var string
	 */
	protected $vis;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(string $value)
	{
		// The given VIN must be in upper case...
		$value = \strtoupper($value);

		if (! \preg_match(self::REGEX, $value, $match))
		{
			throw new \InvalidArgumentException(
				\sprintf('The value "%s" is not a valid VIN', $value)
			);
		}

		$this->vin = $value;
		$this->wmi = $match['wmi'];
		$this->vds = $match['vds'];
		$this->vis = $match['vis'];
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
	public function getRegion() : string
	{
		$wmi = $this->getWmi();

		return REGIONS[$wmi[0]]['region'];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCountry() : ?string
	{
		$wmi = $this->getWmi();

		$countries = REGIONS[$wmi[0]]['countries'];

		foreach ($countries as $chars => $title)
		{
			if (! (false === \strpbrk($wmi[1], $chars)))
			{
				return $title;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getManufacturer() : ?string
	{
		$wmi = $this->getWmi();

		$long = \substr($wmi, 0, 3);
		$short = \substr($wmi, 0, 2);

		return MANUFACTURERS[$long] ?? MANUFACTURERS[$short] ?? null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getModelYear() : ? string
	{
		$range = \substr($this->vin, 6, 1);
		$year_code = \substr($this->vin, 9, 1);

		// As per the algorithm, we have to check the seventh position if it is
		// alphapet that's mean it refers to a year in the range 2010–2039.
		if (ctype_alpha($range)) {
			return YEARS[1][$year_code] ?? YEARS[1][$year_code] ?? null;
		}

		return YEARS[0][$year_code] ?? YEARS[0][$year_code] ?? null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray() : array
	{
		return [
			'vin' => $this->getVin(),
			'wmi' => $this->getWmi(),
			'vds' => $this->getVds(),
			'vis' => $this->getVis(),
			'region' => $this->getRegion(),
			'country' => $this->getCountry(),
			'manufacturer' => $this->getManufacturer(),
			'model_year' => $this->getModelYear(),
		];
	}
}
