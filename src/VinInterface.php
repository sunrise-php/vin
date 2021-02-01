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
 * Vehicle Identification Number
 *
 * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
 * @link https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
 */
interface VinInterface
{

    /**
     * Gets the VIN
     *
     * The length of this string must be 17 characters.
     *
     * @return string
     */
    public function getVin() : string;

    /**
     * Gets WMI (World Manufacturer Identifier) from the VIN
     *
     * The length of this string must be 3 characters.
     *
     * @return string
     */
    public function getWmi() : string;

    /**
     * Gets VDS (Vehicle Descriptor Section) from the VIN
     *
     * The length of this string must be 6 characters.
     *
     * @return string
     */
    public function getVds() : string;

    /**
     * Gets VIS (Vehicle Identifier Section) from the VIN
     *
     * The length of this string must be 8 characters.
     *
     * @return string
     */
    public function getVis() : string;

    /**
     * Gets a region from the VIN
     *
     * The region must be determined by the first character of the VIN.
     *
     * @return null|string
     */
    public function getRegion() : ?string;

    /**
     * Gets a country from the VIN
     *
     * The country must be determined by the second character of the VIN.
     *
     * @return null|string
     */
    public function getCountry() : ?string;

    /**
     * Gets a manufacturer from the VIN
     *
     * The manufacturer must be determined by the first 2 or 3 characters of the VIN.
     *
     * @return null|string
     */
    public function getManufacturer() : ?string;

    /**
     * Gets a model year from the VIN
     *
     * The model year must be determined by the tenth character of the VIN.
     *
     * NOTE! The model year may not be determined correctly.
     *
     * @return int[]
     *
     * @since 1.0.13
     */
    public function getModelYear() : array;
}
