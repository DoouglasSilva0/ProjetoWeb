<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc6c5e26da01c61d10392d20c42b2ebf2
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitc6c5e26da01c61d10392d20c42b2ebf2', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc6c5e26da01c61d10392d20c42b2ebf2', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc6c5e26da01c61d10392d20c42b2ebf2::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
