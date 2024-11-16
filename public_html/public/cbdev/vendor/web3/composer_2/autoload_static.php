<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05e2d86f8150ca0d0233ceafbbc1f468
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'k' => 
        array (
            'kornrunner\\Ethereum\\' => 20,
            'kornrunner\\' => 11,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'M' => 
        array (
            'Mdanter\\Ecc\\' => 12,
        ),
        'F' => 
        array (
            'FG\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'kornrunner\\Ethereum\\' => 
        array (
            0 => __DIR__ . '/..' . '/kornrunner/ethereum-address/src',
        ),
        'kornrunner\\' => 
        array (
            0 => __DIR__ . '/..' . '/kornrunner/keccak/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Mdanter\\Ecc\\' => 
        array (
            0 => __DIR__ . '/..' . '/mdanter/ecc/src',
        ),
        'FG\\' => 
        array (
            0 => __DIR__ . '/..' . '/fgrosse/phpasn1/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit05e2d86f8150ca0d0233ceafbbc1f468::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit05e2d86f8150ca0d0233ceafbbc1f468::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit05e2d86f8150ca0d0233ceafbbc1f468::$classMap;

        }, null, ClassLoader::class);
    }
}