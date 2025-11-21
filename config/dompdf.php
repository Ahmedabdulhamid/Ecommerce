<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf

    'public_path' => null,  // Override the public path if needed

    /*
     * Dejavu Sans font is missing glyphs for converted entities, turn it off if you need to show € and £.
     */
    'convert_entities' => true,

    'options' => [


        'font_dir' => base_path('public/fonts/'),
        'font_cache' => storage_path('fonts/'),

        'temp_dir' => sys_get_temp_dir(),


        'chroot' => realpath(base_path()),


        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        /**
         * Operational artifact (log files, temporary files) path validation
         */
        'artifactPathValidation' => null,

        /**
         * @var string
         */
        'log_output_file' => null,

        'pdf_backend' => 'CPDF',
        'fonts' => [
            'amiri' => [
                'normal' => public_path('fonts/Amiri/Amiri-Regular.ttf'),
                'bold' => public_path('fonts/Amiri/Amiri-Bold.ttf'),
                'italic' => public_path('fonts/Amiri/Amiri-Italic.ttf'),
                'bold_italic' => public_path('fonts/Amiri/Amiri-BoldItalic.ttf'),
            ],
        ],



        'default_media_type' => 'screen',


        'default_paper_size' => 'a4',


        'default_paper_orientation' => 'portrait',

    'default_font' => 'amiri',


        'dpi' => 96,

        'enable_php' => false,

        'enable_javascript' => true,

        'enable_remote' => false,

        'allowed_remote_hosts' => null,

        /**
         * A ratio applied to the fonts height to be more like browsers' line height
         */
        'font_height_ratio' => 1.1,

        /**
         * Use the HTML5 Lib parser
         *
         * @deprecated This feature is now always on in dompdf 2.x
         *
         * @var bool
         */
        'enable_html5_parser' => true,
    ],

];
