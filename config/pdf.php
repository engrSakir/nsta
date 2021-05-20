<?php

return [
    // ...
    'mode' => 'utf-8',
    'format'        => 'A4',//A5 is half of A4 need for vauchar
    'orientation'   => 'P', //L | P
    'font_path'     => base_path('resources/fonts/'),
    'font_data'     => [
        'bengali_englisg'   => [
            'R'     => 'Siyam-Rupali-Regular.ttf',    // regular font bangla: bangla 16-December.ttf font bangla & englisg Siyam_Rupali-Regular.ttf
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
        'bengali'   => [
            'R'     => '16-December.ttf',    // regular font bangla: bangla 16-December.ttf font bangla & englisg Siyam_Rupali-Regular.ttf
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
        'english'   => [
            'R'     => 'English.ttf',    // regular font google Galada-Regular
            //'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            //'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
    ]
];
