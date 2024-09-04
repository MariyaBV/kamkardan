<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit758b2393b8cbddbace512c940013b2f4
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Delivery\\Mne\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Delivery\\Mne\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit758b2393b8cbddbace512c940013b2f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit758b2393b8cbddbace512c940013b2f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit758b2393b8cbddbace512c940013b2f4::$classMap;

        }, null, ClassLoader::class);
    }
}
