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
 * List of all regions
 *
 * @var array
 *
 * @link https://en.wikipedia.org/wiki/Vehicle_identification_number#Country_or_Region_codes
 * @link https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)#WMI_Regions
 */
const REGIONS = [
    'A' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDEFGH' => 'South Africa',
            'JKLMN' => 'Ivory Coast',
        ],
    ],
    'B' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDE' => 'Angola',
            'FGHJK' => 'Kenya',
            'LMNPR' => 'Tanzania',
        ],
    ],
    'C' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDE' => 'Benin',
            'FGHJK' => 'Madagascar',
            'LMNPR' => 'Tunisia',
        ],
    ],
    'D' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDE' => 'Egypt',
            'FGHJK' => 'Morocco',
            'LMNPR' => 'Zambia',
        ],
    ],
    'E' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDE' => 'Ethiopia',
            'FGHJK' => 'Mozambique',
        ],
    ],
    'F' => [
        'region' => 'Africa',
        'countries' => [
            'ABCDE' => 'Ghana',
            'FGHJK' => 'Nigeria',
        ],
    ],
    'J' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'Japan',
        ],
    ],
    'K' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDE' => 'Sri Lanka',
            'FGHJK' => 'Israel',
            'LMNPR' => 'South Korea',
            'STUVWXYZ1234567890' => 'Kazakhstan',
        ],
    ],
    'L' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'China',
        ],
    ],
    'M' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDE' => 'India',
            'FGHJK' => 'Indonesia',
            'LMNPR' => 'Thailand',
            'STUVWXYZ1234567890' => 'Myanmar',
        ],
    ],
    'N' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDE' => 'Iran',
            'FGHJK' => 'Pakistan',
            'LMNPR' => 'Turkey',
        ],
    ],
    'P' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDE' => 'Philippines',
            'FGHJK' => 'Singapore',
            'LMNPR' => 'Malaysia',
        ],
    ],
    'R' => [
        'region' => 'Asia',
        'countries' => [
            'ABCDE' => 'United Arab Emirates',
            'FGHJK' => 'Taiwan',
            'LMNPR' => 'Vietnam',
            'STUVWXYZ1234567890' => 'Saudi Arabia',
        ],
    ],
    'S' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDEFGHJKLM' => 'United Kingdom',
            'NPRST' => 'East Germany',
            'UVWXYZ' => 'Poland',
            '1234' => 'Latvia',
        ],
    ],
    'T' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDEFGH' => 'Switzerland',
            'JKLMNP' => 'Czech Republic',
            'RSTUV' => 'Hungary',
            'WXYZ1' => 'Portugal',
        ],
    ],
    'U' => [
        'region' => 'Europe',
        'countries' => [
            'HJKLM' => 'Denmark',
            'NPRST' => 'Ireland',
            'UVWXYZ' => 'Romania',
            '567' => 'Slovakia',
        ],
    ],
    'V' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDE' => 'Austria',
            'FGHJKLMNPR' => 'France',
            'STUVW' => 'Spain',
            'XYZ12' => 'Serbia',
            '345' => 'Croatia',
            '67890' => 'Estonia',
        ],
    ],
    'W' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'Germany',
        ],
    ],
    'X' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDE' => 'Bulgaria',
            'FGHJK' => 'Greece',
            'LMNPR' => 'Netherlands',
            'STUVW' => 'Russia (USSR)',
            'XYZ12' => 'Luxembourg',
            '34567890' => 'Russia',
        ],
    ],
    'Y' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDE' => 'Belgium',
            'FGHJK' => 'Finland',
            'LMNPR' => 'Malta',
            'STUVW' => 'Sweden',
            'XYZ12' => 'Norway',
            '345' => 'Belarus',
            '67890' => 'Ukraine',
        ],
    ],
    'Z' => [
        'region' => 'Europe',
        'countries' => [
            'ABCDEFGHJKLMNPR' => 'Italy',
            'XYZ12' => 'Slovenia',
            '345' => 'Lithuania',
        ],
    ],
    '1' => [
        'region' => 'North America',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'USA',
        ],
    ],
    '2' => [
        'region' => 'North America',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'Canada',
        ],
    ],
    '3' => [
        'region' => 'North America',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVW' => 'Mexico',
            'XYZ1234567' => 'Costa Rica',
            '890' => 'Cayman Islands',
        ],
    ],
    '4' => [
        'region' => 'North America',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'USA',
        ],
    ],
    '5' => [
        'region' => 'North America',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVWXYZ1234567890' => 'USA',
        ],
    ],
    '6' => [
        'region' => 'Oceania',
        'countries' => [
            'ABCDEFGHJKLMNPRSTUVW' => 'Australia',
        ],
    ],
    '7' => [
        'region' => 'Oceania',
        'countries' => [
            'ABCDE' => 'New Zealand',
        ],
    ],
    '8' => [
        'region' => 'South America',
        'countries' => [
            'ABCDE' => 'Argentina',
            'FGHJK' => 'Chile',
            'LMNPR' => 'Ecuador',
            'STUVW' => 'Peru',
            'XYZ12' => 'Venezuela',
        ],
    ],
    '9' => [
        'region' => 'South America',
        'countries' => [
            'ABCDE' => 'Brazil',
            'FGHJK' => 'Colombia',
            'LMNPR' => 'Paraguay',
            'STUVW' => 'Uruguay',
            'XYZ12' => 'Trinidad & Tobago',
            '3456789' => 'Brazil',
        ],
    ],
];
