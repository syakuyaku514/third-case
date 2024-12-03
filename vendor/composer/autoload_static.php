<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd57f600369c9ce5d14e071feff6ecc9d
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd57f600369c9ce5d14e071feff6ecc9d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd57f600369c9ce5d14e071feff6ecc9d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd57f600369c9ce5d14e071feff6ecc9d::$classMap;

        }, null, ClassLoader::class);
    }
}
