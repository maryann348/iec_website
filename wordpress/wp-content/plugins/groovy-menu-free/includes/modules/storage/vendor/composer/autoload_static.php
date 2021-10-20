<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9e4ed865cf4137a923bde9bf6f73995c
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GroovyMenu\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GroovyMenu\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9e4ed865cf4137a923bde9bf6f73995c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9e4ed865cf4137a923bde9bf6f73995c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
