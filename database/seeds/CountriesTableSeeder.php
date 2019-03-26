<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'AF',
                'name' => 'Afghanistan',
                'phonecode' => 93,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'AL',
                'name' => 'Albania',
                'phonecode' => 355,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'DZ',
                'name' => 'Algeria',
                'phonecode' => 213,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'AS',
                'name' => 'American Samoa',
                'phonecode' => 1684,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'AD',
                'name' => 'Andorra',
                'phonecode' => 376,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'AO',
                'name' => 'Angola',
                'phonecode' => 244,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'AI',
                'name' => 'Anguilla',
                'phonecode' => 1264,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'AQ',
                'name' => 'Antarctica',
                'phonecode' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'AG',
                'name' => 'Antigua And Barbuda',
                'phonecode' => 1268,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'AR',
                'name' => 'Argentina',
                'phonecode' => 54,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'AM',
                'name' => 'Armenia',
                'phonecode' => 374,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'AW',
                'name' => 'Aruba',
                'phonecode' => 297,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'AU',
                'name' => 'Australia',
                'phonecode' => 61,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'AT',
                'name' => 'Austria',
                'phonecode' => 43,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'AZ',
                'name' => 'Azerbaijan',
                'phonecode' => 994,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'BS',
                'name' => 'Bahamas The',
                'phonecode' => 1242,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'BH',
                'name' => 'Bahrain',
                'phonecode' => 973,
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'BD',
                'name' => 'Bangladesh',
                'phonecode' => 880,
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'BB',
                'name' => 'Barbados',
                'phonecode' => 1246,
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'BY',
                'name' => 'Belarus',
                'phonecode' => 375,
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'BE',
                'name' => 'Belgium',
                'phonecode' => 32,
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'BZ',
                'name' => 'Belize',
                'phonecode' => 501,
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'BJ',
                'name' => 'Benin',
                'phonecode' => 229,
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'BM',
                'name' => 'Bermuda',
                'phonecode' => 1441,
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'BT',
                'name' => 'Bhutan',
                'phonecode' => 975,
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'BO',
                'name' => 'Bolivia',
                'phonecode' => 591,
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'BA',
                'name' => 'Bosnia and Herzegovina',
                'phonecode' => 387,
            ),
            27 => 
            array (
                'id' => 28,
                'code' => 'BW',
                'name' => 'Botswana',
                'phonecode' => 267,
            ),
            28 => 
            array (
                'id' => 29,
                'code' => 'BV',
                'name' => 'Bouvet Island',
                'phonecode' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'code' => 'BR',
                'name' => 'Brazil',
                'phonecode' => 55,
            ),
            30 => 
            array (
                'id' => 31,
                'code' => 'IO',
                'name' => 'British Indian Ocean Territory',
                'phonecode' => 246,
            ),
            31 => 
            array (
                'id' => 32,
                'code' => 'BN',
                'name' => 'Brunei',
                'phonecode' => 673,
            ),
            32 => 
            array (
                'id' => 33,
                'code' => 'BG',
                'name' => 'Bulgaria',
                'phonecode' => 359,
            ),
            33 => 
            array (
                'id' => 34,
                'code' => 'BF',
                'name' => 'Burkina Faso',
                'phonecode' => 226,
            ),
            34 => 
            array (
                'id' => 35,
                'code' => 'BI',
                'name' => 'Burundi',
                'phonecode' => 257,
            ),
            35 => 
            array (
                'id' => 36,
                'code' => 'KH',
                'name' => 'Cambodia',
                'phonecode' => 855,
            ),
            36 => 
            array (
                'id' => 37,
                'code' => 'CM',
                'name' => 'Cameroon',
                'phonecode' => 237,
            ),
            37 => 
            array (
                'id' => 38,
                'code' => 'CA',
                'name' => 'Canada',
                'phonecode' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'code' => 'CV',
                'name' => 'Cape Verde',
                'phonecode' => 238,
            ),
            39 => 
            array (
                'id' => 40,
                'code' => 'KY',
                'name' => 'Cayman Islands',
                'phonecode' => 1345,
            ),
            40 => 
            array (
                'id' => 41,
                'code' => 'CF',
                'name' => 'Central African Republic',
                'phonecode' => 236,
            ),
            41 => 
            array (
                'id' => 42,
                'code' => 'TD',
                'name' => 'Chad',
                'phonecode' => 235,
            ),
            42 => 
            array (
                'id' => 43,
                'code' => 'CL',
                'name' => 'Chile',
                'phonecode' => 56,
            ),
            43 => 
            array (
                'id' => 44,
                'code' => 'CN',
                'name' => 'China',
                'phonecode' => 86,
            ),
            44 => 
            array (
                'id' => 45,
                'code' => 'CX',
                'name' => 'Christmas Island',
                'phonecode' => 61,
            ),
            45 => 
            array (
                'id' => 46,
                'code' => 'CC',
            'name' => 'Cocos (Keeling) Islands',
                'phonecode' => 672,
            ),
            46 => 
            array (
                'id' => 47,
                'code' => 'CO',
                'name' => 'Colombia',
                'phonecode' => 57,
            ),
            47 => 
            array (
                'id' => 48,
                'code' => 'KM',
                'name' => 'Comoros',
                'phonecode' => 269,
            ),
            48 => 
            array (
                'id' => 49,
                'code' => 'CG',
                'name' => 'Congo',
                'phonecode' => 242,
            ),
            49 => 
            array (
                'id' => 50,
                'code' => 'CD',
                'name' => 'Congo The Democratic Republic Of The',
                'phonecode' => 242,
            ),
            50 => 
            array (
                'id' => 51,
                'code' => 'CK',
                'name' => 'Cook Islands',
                'phonecode' => 682,
            ),
            51 => 
            array (
                'id' => 52,
                'code' => 'CR',
                'name' => 'Costa Rica',
                'phonecode' => 506,
            ),
            52 => 
            array (
                'id' => 53,
                'code' => 'CI',
            'name' => 'Cote D Ivoire (Ivory Coast)',
                'phonecode' => 225,
            ),
            53 => 
            array (
                'id' => 54,
                'code' => 'HR',
            'name' => 'Croatia (Hrvatska)',
                'phonecode' => 385,
            ),
            54 => 
            array (
                'id' => 55,
                'code' => 'CU',
                'name' => 'Cuba',
                'phonecode' => 53,
            ),
            55 => 
            array (
                'id' => 56,
                'code' => 'CY',
                'name' => 'Cyprus',
                'phonecode' => 357,
            ),
            56 => 
            array (
                'id' => 57,
                'code' => 'CZ',
                'name' => 'Czech Republic',
                'phonecode' => 420,
            ),
            57 => 
            array (
                'id' => 58,
                'code' => 'DK',
                'name' => 'Denmark',
                'phonecode' => 45,
            ),
            58 => 
            array (
                'id' => 59,
                'code' => 'DJ',
                'name' => 'Djibouti',
                'phonecode' => 253,
            ),
            59 => 
            array (
                'id' => 60,
                'code' => 'DM',
                'name' => 'Dominica',
                'phonecode' => 1767,
            ),
            60 => 
            array (
                'id' => 61,
                'code' => 'DO',
                'name' => 'Dominican Republic',
                'phonecode' => 1809,
            ),
            61 => 
            array (
                'id' => 62,
                'code' => 'TP',
                'name' => 'East Timor',
                'phonecode' => 670,
            ),
            62 => 
            array (
                'id' => 63,
                'code' => 'EC',
                'name' => 'Ecuador',
                'phonecode' => 593,
            ),
            63 => 
            array (
                'id' => 64,
                'code' => 'EG',
                'name' => 'Egypt',
                'phonecode' => 20,
            ),
            64 => 
            array (
                'id' => 65,
                'code' => 'SV',
                'name' => 'El Salvador',
                'phonecode' => 503,
            ),
            65 => 
            array (
                'id' => 66,
                'code' => 'GQ',
                'name' => 'Equatorial Guinea',
                'phonecode' => 240,
            ),
            66 => 
            array (
                'id' => 67,
                'code' => 'ER',
                'name' => 'Eritrea',
                'phonecode' => 291,
            ),
            67 => 
            array (
                'id' => 68,
                'code' => 'EE',
                'name' => 'Estonia',
                'phonecode' => 372,
            ),
            68 => 
            array (
                'id' => 69,
                'code' => 'ET',
                'name' => 'Ethiopia',
                'phonecode' => 251,
            ),
            69 => 
            array (
                'id' => 70,
                'code' => 'XA',
                'name' => 'External Territories of Australia',
                'phonecode' => 61,
            ),
            70 => 
            array (
                'id' => 71,
                'code' => 'FK',
                'name' => 'Falkland Islands',
                'phonecode' => 500,
            ),
            71 => 
            array (
                'id' => 72,
                'code' => 'FO',
                'name' => 'Faroe Islands',
                'phonecode' => 298,
            ),
            72 => 
            array (
                'id' => 73,
                'code' => 'FJ',
                'name' => 'Fiji Islands',
                'phonecode' => 679,
            ),
            73 => 
            array (
                'id' => 74,
                'code' => 'FI',
                'name' => 'Finland',
                'phonecode' => 358,
            ),
            74 => 
            array (
                'id' => 75,
                'code' => 'FR',
                'name' => 'France',
                'phonecode' => 33,
            ),
            75 => 
            array (
                'id' => 76,
                'code' => 'GF',
                'name' => 'French Guiana',
                'phonecode' => 594,
            ),
            76 => 
            array (
                'id' => 77,
                'code' => 'PF',
                'name' => 'French Polynesia',
                'phonecode' => 689,
            ),
            77 => 
            array (
                'id' => 78,
                'code' => 'TF',
                'name' => 'French Southern Territories',
                'phonecode' => 0,
            ),
            78 => 
            array (
                'id' => 79,
                'code' => 'GA',
                'name' => 'Gabon',
                'phonecode' => 241,
            ),
            79 => 
            array (
                'id' => 80,
                'code' => 'GM',
                'name' => 'Gambia The',
                'phonecode' => 220,
            ),
            80 => 
            array (
                'id' => 81,
                'code' => 'GE',
                'name' => 'Georgia',
                'phonecode' => 995,
            ),
            81 => 
            array (
                'id' => 82,
                'code' => 'DE',
                'name' => 'Germany',
                'phonecode' => 49,
            ),
            82 => 
            array (
                'id' => 83,
                'code' => 'GH',
                'name' => 'Ghana',
                'phonecode' => 233,
            ),
            83 => 
            array (
                'id' => 84,
                'code' => 'GI',
                'name' => 'Gibraltar',
                'phonecode' => 350,
            ),
            84 => 
            array (
                'id' => 85,
                'code' => 'GR',
                'name' => 'Greece',
                'phonecode' => 30,
            ),
            85 => 
            array (
                'id' => 86,
                'code' => 'GL',
                'name' => 'Greenland',
                'phonecode' => 299,
            ),
            86 => 
            array (
                'id' => 87,
                'code' => 'GD',
                'name' => 'Grenada',
                'phonecode' => 1473,
            ),
            87 => 
            array (
                'id' => 88,
                'code' => 'GP',
                'name' => 'Guadeloupe',
                'phonecode' => 590,
            ),
            88 => 
            array (
                'id' => 89,
                'code' => 'GU',
                'name' => 'Guam',
                'phonecode' => 1671,
            ),
            89 => 
            array (
                'id' => 90,
                'code' => 'GT',
                'name' => 'Guatemala',
                'phonecode' => 502,
            ),
            90 => 
            array (
                'id' => 91,
                'code' => 'XU',
                'name' => 'Guernsey and Alderney',
                'phonecode' => 44,
            ),
            91 => 
            array (
                'id' => 92,
                'code' => 'GN',
                'name' => 'Guinea',
                'phonecode' => 224,
            ),
            92 => 
            array (
                'id' => 93,
                'code' => 'GW',
                'name' => 'Guinea-Bissau',
                'phonecode' => 245,
            ),
            93 => 
            array (
                'id' => 94,
                'code' => 'GY',
                'name' => 'Guyana',
                'phonecode' => 592,
            ),
            94 => 
            array (
                'id' => 95,
                'code' => 'HT',
                'name' => 'Haiti',
                'phonecode' => 509,
            ),
            95 => 
            array (
                'id' => 96,
                'code' => 'HM',
                'name' => 'Heard and McDonald Islands',
                'phonecode' => 0,
            ),
            96 => 
            array (
                'id' => 97,
                'code' => 'HN',
                'name' => 'Honduras',
                'phonecode' => 504,
            ),
            97 => 
            array (
                'id' => 98,
                'code' => 'HK',
                'name' => 'Hong Kong S.A.R.',
                'phonecode' => 852,
            ),
            98 => 
            array (
                'id' => 99,
                'code' => 'HU',
                'name' => 'Hungary',
                'phonecode' => 36,
            ),
            99 => 
            array (
                'id' => 100,
                'code' => 'IS',
                'name' => 'Iceland',
                'phonecode' => 354,
            ),
            100 => 
            array (
                'id' => 101,
                'code' => 'IN',
                'name' => 'India',
                'phonecode' => 91,
            ),
            101 => 
            array (
                'id' => 102,
                'code' => 'ID',
                'name' => 'Indonesia',
                'phonecode' => 62,
            ),
            102 => 
            array (
                'id' => 103,
                'code' => 'IR',
                'name' => 'Iran',
                'phonecode' => 98,
            ),
            103 => 
            array (
                'id' => 104,
                'code' => 'IQ',
                'name' => 'Iraq',
                'phonecode' => 964,
            ),
            104 => 
            array (
                'id' => 105,
                'code' => 'IE',
                'name' => 'Ireland',
                'phonecode' => 353,
            ),
            105 => 
            array (
                'id' => 106,
                'code' => 'IL',
                'name' => 'Israel',
                'phonecode' => 972,
            ),
            106 => 
            array (
                'id' => 107,
                'code' => 'IT',
                'name' => 'Italy',
                'phonecode' => 39,
            ),
            107 => 
            array (
                'id' => 108,
                'code' => 'JM',
                'name' => 'Jamaica',
                'phonecode' => 1876,
            ),
            108 => 
            array (
                'id' => 109,
                'code' => 'JP',
                'name' => 'Japan',
                'phonecode' => 81,
            ),
            109 => 
            array (
                'id' => 110,
                'code' => 'XJ',
                'name' => 'Jersey',
                'phonecode' => 44,
            ),
            110 => 
            array (
                'id' => 111,
                'code' => 'JO',
                'name' => 'Jordan',
                'phonecode' => 962,
            ),
            111 => 
            array (
                'id' => 112,
                'code' => 'KZ',
                'name' => 'Kazakhstan',
                'phonecode' => 7,
            ),
            112 => 
            array (
                'id' => 113,
                'code' => 'KE',
                'name' => 'Kenya',
                'phonecode' => 254,
            ),
            113 => 
            array (
                'id' => 114,
                'code' => 'KI',
                'name' => 'Kiribati',
                'phonecode' => 686,
            ),
            114 => 
            array (
                'id' => 115,
                'code' => 'KP',
                'name' => 'Korea North',
                'phonecode' => 850,
            ),
            115 => 
            array (
                'id' => 116,
                'code' => 'KR',
                'name' => 'Korea South',
                'phonecode' => 82,
            ),
            116 => 
            array (
                'id' => 117,
                'code' => 'KW',
                'name' => 'Kuwait',
                'phonecode' => 965,
            ),
            117 => 
            array (
                'id' => 118,
                'code' => 'KG',
                'name' => 'Kyrgyzstan',
                'phonecode' => 996,
            ),
            118 => 
            array (
                'id' => 119,
                'code' => 'LA',
                'name' => 'Laos',
                'phonecode' => 856,
            ),
            119 => 
            array (
                'id' => 120,
                'code' => 'LV',
                'name' => 'Latvia',
                'phonecode' => 371,
            ),
            120 => 
            array (
                'id' => 121,
                'code' => 'LB',
                'name' => 'Lebanon',
                'phonecode' => 961,
            ),
            121 => 
            array (
                'id' => 122,
                'code' => 'LS',
                'name' => 'Lesotho',
                'phonecode' => 266,
            ),
            122 => 
            array (
                'id' => 123,
                'code' => 'LR',
                'name' => 'Liberia',
                'phonecode' => 231,
            ),
            123 => 
            array (
                'id' => 124,
                'code' => 'LY',
                'name' => 'Libya',
                'phonecode' => 218,
            ),
            124 => 
            array (
                'id' => 125,
                'code' => 'LI',
                'name' => 'Liechtenstein',
                'phonecode' => 423,
            ),
            125 => 
            array (
                'id' => 126,
                'code' => 'LT',
                'name' => 'Lithuania',
                'phonecode' => 370,
            ),
            126 => 
            array (
                'id' => 127,
                'code' => 'LU',
                'name' => 'Luxembourg',
                'phonecode' => 352,
            ),
            127 => 
            array (
                'id' => 128,
                'code' => 'MO',
                'name' => 'Macau S.A.R.',
                'phonecode' => 853,
            ),
            128 => 
            array (
                'id' => 129,
                'code' => 'MK',
                'name' => 'Macedonia',
                'phonecode' => 389,
            ),
            129 => 
            array (
                'id' => 130,
                'code' => 'MG',
                'name' => 'Madagascar',
                'phonecode' => 261,
            ),
            130 => 
            array (
                'id' => 131,
                'code' => 'MW',
                'name' => 'Malawi',
                'phonecode' => 265,
            ),
            131 => 
            array (
                'id' => 132,
                'code' => 'MY',
                'name' => 'Malaysia',
                'phonecode' => 60,
            ),
            132 => 
            array (
                'id' => 133,
                'code' => 'MV',
                'name' => 'Maldives',
                'phonecode' => 960,
            ),
            133 => 
            array (
                'id' => 134,
                'code' => 'ML',
                'name' => 'Mali',
                'phonecode' => 223,
            ),
            134 => 
            array (
                'id' => 135,
                'code' => 'MT',
                'name' => 'Malta',
                'phonecode' => 356,
            ),
            135 => 
            array (
                'id' => 136,
                'code' => 'XM',
            'name' => 'Man (Isle of)',
                'phonecode' => 44,
            ),
            136 => 
            array (
                'id' => 137,
                'code' => 'MH',
                'name' => 'Marshall Islands',
                'phonecode' => 692,
            ),
            137 => 
            array (
                'id' => 138,
                'code' => 'MQ',
                'name' => 'Martinique',
                'phonecode' => 596,
            ),
            138 => 
            array (
                'id' => 139,
                'code' => 'MR',
                'name' => 'Mauritania',
                'phonecode' => 222,
            ),
            139 => 
            array (
                'id' => 140,
                'code' => 'MU',
                'name' => 'Mauritius',
                'phonecode' => 230,
            ),
            140 => 
            array (
                'id' => 141,
                'code' => 'YT',
                'name' => 'Mayotte',
                'phonecode' => 269,
            ),
            141 => 
            array (
                'id' => 142,
                'code' => 'MX',
                'name' => 'Mexico',
                'phonecode' => 52,
            ),
            142 => 
            array (
                'id' => 143,
                'code' => 'FM',
                'name' => 'Micronesia',
                'phonecode' => 691,
            ),
            143 => 
            array (
                'id' => 144,
                'code' => 'MD',
                'name' => 'Moldova',
                'phonecode' => 373,
            ),
            144 => 
            array (
                'id' => 145,
                'code' => 'MC',
                'name' => 'Monaco',
                'phonecode' => 377,
            ),
            145 => 
            array (
                'id' => 146,
                'code' => 'MN',
                'name' => 'Mongolia',
                'phonecode' => 976,
            ),
            146 => 
            array (
                'id' => 147,
                'code' => 'MS',
                'name' => 'Montserrat',
                'phonecode' => 1664,
            ),
            147 => 
            array (
                'id' => 148,
                'code' => 'MA',
                'name' => 'Morocco',
                'phonecode' => 212,
            ),
            148 => 
            array (
                'id' => 149,
                'code' => 'MZ',
                'name' => 'Mozambique',
                'phonecode' => 258,
            ),
            149 => 
            array (
                'id' => 150,
                'code' => 'MM',
                'name' => 'Myanmar',
                'phonecode' => 95,
            ),
            150 => 
            array (
                'id' => 151,
                'code' => 'NA',
                'name' => 'Namibia',
                'phonecode' => 264,
            ),
            151 => 
            array (
                'id' => 152,
                'code' => 'NR',
                'name' => 'Nauru',
                'phonecode' => 674,
            ),
            152 => 
            array (
                'id' => 153,
                'code' => 'NP',
                'name' => 'Nepal',
                'phonecode' => 977,
            ),
            153 => 
            array (
                'id' => 154,
                'code' => 'AN',
                'name' => 'Netherlands Antilles',
                'phonecode' => 599,
            ),
            154 => 
            array (
                'id' => 155,
                'code' => 'NL',
                'name' => 'Netherlands The',
                'phonecode' => 31,
            ),
            155 => 
            array (
                'id' => 156,
                'code' => 'NC',
                'name' => 'New Caledonia',
                'phonecode' => 687,
            ),
            156 => 
            array (
                'id' => 157,
                'code' => 'NZ',
                'name' => 'New Zealand',
                'phonecode' => 64,
            ),
            157 => 
            array (
                'id' => 158,
                'code' => 'NI',
                'name' => 'Nicaragua',
                'phonecode' => 505,
            ),
            158 => 
            array (
                'id' => 159,
                'code' => 'NE',
                'name' => 'Niger',
                'phonecode' => 227,
            ),
            159 => 
            array (
                'id' => 160,
                'code' => 'NG',
                'name' => 'Nigeria',
                'phonecode' => 234,
            ),
            160 => 
            array (
                'id' => 161,
                'code' => 'NU',
                'name' => 'Niue',
                'phonecode' => 683,
            ),
            161 => 
            array (
                'id' => 162,
                'code' => 'NF',
                'name' => 'Norfolk Island',
                'phonecode' => 672,
            ),
            162 => 
            array (
                'id' => 163,
                'code' => 'MP',
                'name' => 'Northern Mariana Islands',
                'phonecode' => 1670,
            ),
            163 => 
            array (
                'id' => 164,
                'code' => 'NO',
                'name' => 'Norway',
                'phonecode' => 47,
            ),
            164 => 
            array (
                'id' => 165,
                'code' => 'OM',
                'name' => 'Oman',
                'phonecode' => 968,
            ),
            165 => 
            array (
                'id' => 166,
                'code' => 'PK',
                'name' => 'Pakistan',
                'phonecode' => 92,
            ),
            166 => 
            array (
                'id' => 167,
                'code' => 'PW',
                'name' => 'Palau',
                'phonecode' => 680,
            ),
            167 => 
            array (
                'id' => 168,
                'code' => 'PS',
                'name' => 'Palestinian Territory Occupied',
                'phonecode' => 970,
            ),
            168 => 
            array (
                'id' => 169,
                'code' => 'PA',
                'name' => 'Panama',
                'phonecode' => 507,
            ),
            169 => 
            array (
                'id' => 170,
                'code' => 'PG',
                'name' => 'Papua new Guinea',
                'phonecode' => 675,
            ),
            170 => 
            array (
                'id' => 171,
                'code' => 'PY',
                'name' => 'Paraguay',
                'phonecode' => 595,
            ),
            171 => 
            array (
                'id' => 172,
                'code' => 'PE',
                'name' => 'Peru',
                'phonecode' => 51,
            ),
            172 => 
            array (
                'id' => 173,
                'code' => 'PH',
                'name' => 'Philippines',
                'phonecode' => 63,
            ),
            173 => 
            array (
                'id' => 174,
                'code' => 'PN',
                'name' => 'Pitcairn Island',
                'phonecode' => 0,
            ),
            174 => 
            array (
                'id' => 175,
                'code' => 'PL',
                'name' => 'Poland',
                'phonecode' => 48,
            ),
            175 => 
            array (
                'id' => 176,
                'code' => 'PT',
                'name' => 'Portugal',
                'phonecode' => 351,
            ),
            176 => 
            array (
                'id' => 177,
                'code' => 'PR',
                'name' => 'Puerto Rico',
                'phonecode' => 1787,
            ),
            177 => 
            array (
                'id' => 178,
                'code' => 'QA',
                'name' => 'Qatar',
                'phonecode' => 974,
            ),
            178 => 
            array (
                'id' => 179,
                'code' => 'RE',
                'name' => 'Reunion',
                'phonecode' => 262,
            ),
            179 => 
            array (
                'id' => 180,
                'code' => 'RO',
                'name' => 'Romania',
                'phonecode' => 40,
            ),
            180 => 
            array (
                'id' => 181,
                'code' => 'RU',
                'name' => 'Russia',
                'phonecode' => 70,
            ),
            181 => 
            array (
                'id' => 182,
                'code' => 'RW',
                'name' => 'Rwanda',
                'phonecode' => 250,
            ),
            182 => 
            array (
                'id' => 183,
                'code' => 'SH',
                'name' => 'Saint Helena',
                'phonecode' => 290,
            ),
            183 => 
            array (
                'id' => 184,
                'code' => 'KN',
                'name' => 'Saint Kitts And Nevis',
                'phonecode' => 1869,
            ),
            184 => 
            array (
                'id' => 185,
                'code' => 'LC',
                'name' => 'Saint Lucia',
                'phonecode' => 1758,
            ),
            185 => 
            array (
                'id' => 186,
                'code' => 'PM',
                'name' => 'Saint Pierre and Miquelon',
                'phonecode' => 508,
            ),
            186 => 
            array (
                'id' => 187,
                'code' => 'VC',
                'name' => 'Saint Vincent And The Grenadines',
                'phonecode' => 1784,
            ),
            187 => 
            array (
                'id' => 188,
                'code' => 'WS',
                'name' => 'Samoa',
                'phonecode' => 684,
            ),
            188 => 
            array (
                'id' => 189,
                'code' => 'SM',
                'name' => 'San Marino',
                'phonecode' => 378,
            ),
            189 => 
            array (
                'id' => 190,
                'code' => 'ST',
                'name' => 'Sao Tome and Principe',
                'phonecode' => 239,
            ),
            190 => 
            array (
                'id' => 191,
                'code' => 'SA',
                'name' => 'Saudi Arabia',
                'phonecode' => 966,
            ),
            191 => 
            array (
                'id' => 192,
                'code' => 'SN',
                'name' => 'Senegal',
                'phonecode' => 221,
            ),
            192 => 
            array (
                'id' => 193,
                'code' => 'RS',
                'name' => 'Serbia',
                'phonecode' => 381,
            ),
            193 => 
            array (
                'id' => 194,
                'code' => 'SC',
                'name' => 'Seychelles',
                'phonecode' => 248,
            ),
            194 => 
            array (
                'id' => 195,
                'code' => 'SL',
                'name' => 'Sierra Leone',
                'phonecode' => 232,
            ),
            195 => 
            array (
                'id' => 196,
                'code' => 'SG',
                'name' => 'Singapore',
                'phonecode' => 65,
            ),
            196 => 
            array (
                'id' => 197,
                'code' => 'SK',
                'name' => 'Slovakia',
                'phonecode' => 421,
            ),
            197 => 
            array (
                'id' => 198,
                'code' => 'SI',
                'name' => 'Slovenia',
                'phonecode' => 386,
            ),
            198 => 
            array (
                'id' => 199,
                'code' => 'XG',
                'name' => 'Smaller Territories of the UK',
                'phonecode' => 44,
            ),
            199 => 
            array (
                'id' => 200,
                'code' => 'SB',
                'name' => 'Solomon Islands',
                'phonecode' => 677,
            ),
            200 => 
            array (
                'id' => 201,
                'code' => 'SO',
                'name' => 'Somalia',
                'phonecode' => 252,
            ),
            201 => 
            array (
                'id' => 202,
                'code' => 'ZA',
                'name' => 'South Africa',
                'phonecode' => 27,
            ),
            202 => 
            array (
                'id' => 203,
                'code' => 'GS',
                'name' => 'South Georgia',
                'phonecode' => 0,
            ),
            203 => 
            array (
                'id' => 204,
                'code' => 'SS',
                'name' => 'South Sudan',
                'phonecode' => 211,
            ),
            204 => 
            array (
                'id' => 205,
                'code' => 'ES',
                'name' => 'Spain',
                'phonecode' => 34,
            ),
            205 => 
            array (
                'id' => 206,
                'code' => 'LK',
                'name' => 'Sri Lanka',
                'phonecode' => 94,
            ),
            206 => 
            array (
                'id' => 207,
                'code' => 'SD',
                'name' => 'Sudan',
                'phonecode' => 249,
            ),
            207 => 
            array (
                'id' => 208,
                'code' => 'SR',
                'name' => 'Suriname',
                'phonecode' => 597,
            ),
            208 => 
            array (
                'id' => 209,
                'code' => 'SJ',
                'name' => 'Svalbard And Jan Mayen Islands',
                'phonecode' => 47,
            ),
            209 => 
            array (
                'id' => 210,
                'code' => 'SZ',
                'name' => 'Swaziland',
                'phonecode' => 268,
            ),
            210 => 
            array (
                'id' => 211,
                'code' => 'SE',
                'name' => 'Sweden',
                'phonecode' => 46,
            ),
            211 => 
            array (
                'id' => 212,
                'code' => 'CH',
                'name' => 'Switzerland',
                'phonecode' => 41,
            ),
            212 => 
            array (
                'id' => 213,
                'code' => 'SY',
                'name' => 'Syria',
                'phonecode' => 963,
            ),
            213 => 
            array (
                'id' => 214,
                'code' => 'TW',
                'name' => 'Taiwan',
                'phonecode' => 886,
            ),
            214 => 
            array (
                'id' => 215,
                'code' => 'TJ',
                'name' => 'Tajikistan',
                'phonecode' => 992,
            ),
            215 => 
            array (
                'id' => 216,
                'code' => 'TZ',
                'name' => 'Tanzania',
                'phonecode' => 255,
            ),
            216 => 
            array (
                'id' => 217,
                'code' => 'TH',
                'name' => 'Thailand',
                'phonecode' => 66,
            ),
            217 => 
            array (
                'id' => 218,
                'code' => 'TG',
                'name' => 'Togo',
                'phonecode' => 228,
            ),
            218 => 
            array (
                'id' => 219,
                'code' => 'TK',
                'name' => 'Tokelau',
                'phonecode' => 690,
            ),
            219 => 
            array (
                'id' => 220,
                'code' => 'TO',
                'name' => 'Tonga',
                'phonecode' => 676,
            ),
            220 => 
            array (
                'id' => 221,
                'code' => 'TT',
                'name' => 'Trinidad And Tobago',
                'phonecode' => 1868,
            ),
            221 => 
            array (
                'id' => 222,
                'code' => 'TN',
                'name' => 'Tunisia',
                'phonecode' => 216,
            ),
            222 => 
            array (
                'id' => 223,
                'code' => 'TR',
                'name' => 'Turkey',
                'phonecode' => 90,
            ),
            223 => 
            array (
                'id' => 224,
                'code' => 'TM',
                'name' => 'Turkmenistan',
                'phonecode' => 7370,
            ),
            224 => 
            array (
                'id' => 225,
                'code' => 'TC',
                'name' => 'Turks And Caicos Islands',
                'phonecode' => 1649,
            ),
            225 => 
            array (
                'id' => 226,
                'code' => 'TV',
                'name' => 'Tuvalu',
                'phonecode' => 688,
            ),
            226 => 
            array (
                'id' => 227,
                'code' => 'UG',
                'name' => 'Uganda',
                'phonecode' => 256,
            ),
            227 => 
            array (
                'id' => 228,
                'code' => 'UA',
                'name' => 'Ukraine',
                'phonecode' => 380,
            ),
            228 => 
            array (
                'id' => 229,
                'code' => 'AE',
                'name' => 'United Arab Emirates',
                'phonecode' => 971,
            ),
            229 => 
            array (
                'id' => 230,
                'code' => 'GB',
                'name' => 'United Kingdom',
                'phonecode' => 44,
            ),
            230 => 
            array (
                'id' => 231,
                'code' => 'US',
                'name' => 'United States',
                'phonecode' => 1,
            ),
            231 => 
            array (
                'id' => 232,
                'code' => 'UM',
                'name' => 'United States Minor Outlying Islands',
                'phonecode' => 1,
            ),
            232 => 
            array (
                'id' => 233,
                'code' => 'UY',
                'name' => 'Uruguay',
                'phonecode' => 598,
            ),
            233 => 
            array (
                'id' => 234,
                'code' => 'UZ',
                'name' => 'Uzbekistan',
                'phonecode' => 998,
            ),
            234 => 
            array (
                'id' => 235,
                'code' => 'VU',
                'name' => 'Vanuatu',
                'phonecode' => 678,
            ),
            235 => 
            array (
                'id' => 236,
                'code' => 'VA',
            'name' => 'Vatican City State (Holy See)',
                'phonecode' => 39,
            ),
            236 => 
            array (
                'id' => 237,
                'code' => 'VE',
                'name' => 'Venezuela',
                'phonecode' => 58,
            ),
            237 => 
            array (
                'id' => 238,
                'code' => 'VN',
                'name' => 'Vietnam',
                'phonecode' => 84,
            ),
            238 => 
            array (
                'id' => 239,
                'code' => 'VG',
            'name' => 'Virgin Islands (British)',
                'phonecode' => 1284,
            ),
            239 => 
            array (
                'id' => 240,
                'code' => 'VI',
            'name' => 'Virgin Islands (US)',
                'phonecode' => 1340,
            ),
            240 => 
            array (
                'id' => 241,
                'code' => 'WF',
                'name' => 'Wallis And Futuna Islands',
                'phonecode' => 681,
            ),
            241 => 
            array (
                'id' => 242,
                'code' => 'EH',
                'name' => 'Western Sahara',
                'phonecode' => 212,
            ),
            242 => 
            array (
                'id' => 243,
                'code' => 'YE',
                'name' => 'Yemen',
                'phonecode' => 967,
            ),
            243 => 
            array (
                'id' => 244,
                'code' => 'YU',
                'name' => 'Yugoslavia',
                'phonecode' => 38,
            ),
            244 => 
            array (
                'id' => 245,
                'code' => 'ZM',
                'name' => 'Zambia',
                'phonecode' => 260,
            ),
            245 => 
            array (
                'id' => 246,
                'code' => 'ZW',
                'name' => 'Zimbabwe',
                'phonecode' => 263,
            ),
        ));
        
        
    }
}