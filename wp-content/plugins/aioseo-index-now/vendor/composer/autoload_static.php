<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit882a3ea1e7c46ceaee9a9fc9539fbeaa
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AIOSEO\\Plugin\\Addon\\IndexNow\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AIOSEO\\Plugin\\Addon\\IndexNow\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit882a3ea1e7c46ceaee9a9fc9539fbeaa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit882a3ea1e7c46ceaee9a9fc9539fbeaa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit882a3ea1e7c46ceaee9a9fc9539fbeaa::$classMap;

        }, null, ClassLoader::class);
    }
}