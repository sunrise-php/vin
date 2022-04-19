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
     * @return string
     */
    public function getVin() : string;

    /**
     * Gets WMI (World Manufacturer Identifier) from the VIN
     *
     * @return string
     */
    public function getWmi() : string;

    /**
     * Gets VDS (Vehicle Descriptor Section) from the VIN
     *
     * @return string
     */
    public function getVds() : string;

    /**
     * Gets VIS (Vehicle Identifier Section) from the VIN
     *
     * @return string
     */
    public function getVis() : string;

    /**
     * Gets a region from the VIN
     *
     * @return string|null
     */
    public function getRegion() : ?string;

    /**
     * Gets a country from the VIN
     *
     * @return string|null
     */
    public function getCountry() : ?string;

    /**
     * Gets a manufacturer from the VIN
     *
     * @return string|null
     */
    public function getManufacturer() : ?string;

    /**
     * Gets a model year from the VIN
     *
     * @return list<int>
     */
    public function getModelYear() : array;
}
