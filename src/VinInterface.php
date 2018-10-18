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
 * Vehicle Identification Number
 *
 * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
 * @link https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
 */
interface VinInterface
{

	/**
	 * Constructor of the class
	 *
	 * @param string $value
	 *
	 * @throws \InvalidArgumentException If the given value is not a valid VIN
	 */
	public function __construct(string $value);

	/**
	 * Gets the VIN
	 *
	 * @return string
	 */
	public function getVin() : string;

	/**
	 * Gets WMI from the VIN
	 *
	 * @return string
	 */
	public function getWmi() : string;

	/**
	 * Gets VDS from the VIN
	 *
	 * @return string
	 */
	public function getVds() : string;

	/**
	 * Gets VIS from the VIN
	 *
	 * @return string
	 */
	public function getVis() : string;

	/**
	 * Gets a region from the VIN
	 *
	 * @return string
	 */
	public function getRegion() : string;

	/**
	 * Gets a country from the VIN
	 *
	 * @return null|string
	 */
	public function getCountry() : ?string;

	/**
	 * Gets a manufacturer from the VIN
	 *
	 * @return null|string
	 */
	public function getManufacturer() : ?string;

	/**
	 * Converts the VIN to array
	 *
	 * @return array
	 */
	public function toArray() : array;
}
