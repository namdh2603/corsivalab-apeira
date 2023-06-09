<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc56aa391ac498061f8d648878e0e6144
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPCSStandards\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 57,
        ),
        'K' => 
        array (
            'Kirki\\Util\\' => 11,
            'Kirki\\Settings\\' => 15,
            'Kirki\\Module\\' => 13,
            'Kirki\\Field\\' => 12,
            'Kirki\\Data\\' => 11,
            'Kirki\\Compatibility\\' => 20,
            'Kirki\\' => 6,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPCSStandards\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
        'Kirki\\Util\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/util/src',
        ),
        'Kirki\\Settings\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/settings/src',
        ),
        'Kirki\\Module\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/module-css/src',
            1 => __DIR__ . '/../..' . '/packages/module-editor-styles/src',
            2 => __DIR__ . '/../..' . '/packages/module-field-dependencies/src',
            3 => __DIR__ . '/../..' . '/packages/module-postmessage/src',
            4 => __DIR__ . '/../..' . '/packages/module-preset/src',
            5 => __DIR__ . '/../..' . '/packages/module-section-icons/src',
            6 => __DIR__ . '/../..' . '/packages/module-selective-refresh/src',
            7 => __DIR__ . '/../..' . '/packages/module-tooltips/src',
            8 => __DIR__ . '/../..' . '/packages/module-webfonts/src',
        ),
        'Kirki\\Field\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/field/src/Field',
            1 => __DIR__ . '/../..' . '/packages/field-background/src',
            2 => __DIR__ . '/../..' . '/packages/field-dimensions/src',
            3 => __DIR__ . '/../..' . '/packages/field-fontawesome/src',
            4 => __DIR__ . '/../..' . '/packages/field-multicolor/src/Field',
            5 => __DIR__ . '/../..' . '/packages/field-multicolor/src',
            6 => __DIR__ . '/../..' . '/packages/field-typography/src/Field',
            7 => __DIR__ . '/../..' . '/packages/field-typography/src',
        ),
        'Kirki\\Data\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/data-option/src',
        ),
        'Kirki\\Compatibility\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/compatibility/src',
        ),
        'Kirki\\' => 
        array (
            0 => __DIR__ . '/../..' . '/packages/control-base/src',
            1 => __DIR__ . '/../..' . '/packages/control-checkbox/src',
            2 => __DIR__ . '/../..' . '/packages/control-code/src',
            3 => __DIR__ . '/../..' . '/packages/control-color/src',
            4 => __DIR__ . '/../..' . '/packages/control-color-palette/src',
            5 => __DIR__ . '/../..' . '/packages/control-cropped-image/src',
            6 => __DIR__ . '/../..' . '/packages/control-custom/src',
            7 => __DIR__ . '/../..' . '/packages/control-dashicons/src',
            8 => __DIR__ . '/../..' . '/packages/control-date/src',
            9 => __DIR__ . '/../..' . '/packages/control-dimension/src',
            10 => __DIR__ . '/../..' . '/packages/control-editor/src',
            11 => __DIR__ . '/../..' . '/packages/control-generic/src',
            12 => __DIR__ . '/../..' . '/packages/control-image/src',
            13 => __DIR__ . '/../..' . '/packages/control-multicheck/src',
            14 => __DIR__ . '/../..' . '/packages/control-palette/src',
            15 => __DIR__ . '/../..' . '/packages/control-radio/src',
            16 => __DIR__ . '/../..' . '/packages/control-react-colorful/src',
            17 => __DIR__ . '/../..' . '/packages/control-react-select/src',
            18 => __DIR__ . '/../..' . '/packages/control-repeater/src',
            19 => __DIR__ . '/../..' . '/packages/control-select/src',
            20 => __DIR__ . '/../..' . '/packages/control-slider/src',
            21 => __DIR__ . '/../..' . '/packages/control-sortable/src',
            22 => __DIR__ . '/../..' . '/packages/control-upload/src',
            23 => __DIR__ . '/../..' . '/packages/field/src',
            24 => __DIR__ . '/../..' . '/packages/googlefonts/src',
            25 => __DIR__ . '/../..' . '/packages/l10n/src',
            26 => __DIR__ . '/../..' . '/packages/module-panels/src',
            27 => __DIR__ . '/../..' . '/packages/module-sections/src',
            28 => __DIR__ . '/../..' . '/packages/url-getter/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc56aa391ac498061f8d648878e0e6144::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc56aa391ac498061f8d648878e0e6144::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc56aa391ac498061f8d648878e0e6144::$classMap;

        }, null, ClassLoader::class);
    }
}
