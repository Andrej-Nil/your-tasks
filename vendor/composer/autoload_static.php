<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb5f3da2ede3d5bfe09590329c23156c9
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'middleware\\' => 11,
        ),
        'c' => 
        array (
            'classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'middleware\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/middleware',
        ),
        'classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb5f3da2ede3d5bfe09590329c23156c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb5f3da2ede3d5bfe09590329c23156c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb5f3da2ede3d5bfe09590329c23156c9::$classMap;

        }, null, ClassLoader::class);
    }
}
