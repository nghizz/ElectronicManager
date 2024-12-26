<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ca1acbffd900a7481cd4a9dc28e2d59
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '950e8c5ec01dc90f029c243f73011631' => __DIR__ . '/..' . '/goaop/parser-reflection/src/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Cache\\' => 10,
            'Project\\' => 8,
            'PhpParser\\' => 10,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'G' => 
        array (
            'Go\\ParserReflection\\' => 20,
            'Go\\' => 3,
        ),
        'D' => 
        array (
            'Doctrine\\Deprecations\\' => 22,
            'Doctrine\\Common\\Lexer\\' => 22,
            'Doctrine\\Common\\Cache\\' => 22,
            'Doctrine\\Common\\Annotations\\' => 28,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Project',
        ),
        'PhpParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/php-parser/lib/PhpParser',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Go\\ParserReflection\\' => 
        array (
            0 => __DIR__ . '/..' . '/goaop/parser-reflection/src',
        ),
        'Go\\' => 
        array (
            0 => __DIR__ . '/..' . '/goaop/framework/src',
        ),
        'Doctrine\\Deprecations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/deprecations/src',
        ),
        'Doctrine\\Common\\Lexer\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/lexer/src',
        ),
        'Doctrine\\Common\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/cache/lib/Doctrine/Common/Cache',
        ),
        'Doctrine\\Common\\Annotations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/annotations/lib/Doctrine/Common/Annotations',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Dissect' => 
            array (
                0 => __DIR__ . '/..' . '/jakubledl/dissect/src',
            ),
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ca1acbffd900a7481cd4a9dc28e2d59::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ca1acbffd900a7481cd4a9dc28e2d59::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit5ca1acbffd900a7481cd4a9dc28e2d59::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit5ca1acbffd900a7481cd4a9dc28e2d59::$classMap;

        }, null, ClassLoader::class);
    }
}
