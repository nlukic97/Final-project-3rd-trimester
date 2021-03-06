<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitec29dcf9c5812542b2765f334b01268b
{
    public static $classMap = array (
        'App\\Controllers\\ApiFaqController' => __DIR__ . '/../..' . '/controllers/ApiFaqController.php',
        'App\\Controllers\\ApiItemsController' => __DIR__ . '/../..' . '/controllers/ApiItemsController.php',
        'App\\Controllers\\ApiOrdersController' => __DIR__ . '/../..' . '/controllers/ApiOrdersController.php',
        'App\\Controllers\\AuthController' => __DIR__ . '/../..' . '/controllers/AuthController.php',
        'App\\Controllers\\PagesController' => __DIR__ . '/../..' . '/controllers/PagesController.php',
        'App\\Controllers\\UsersController' => __DIR__ . '/../..' . '/controllers/UsersController.php',
        'App\\Controllers\\itemsController' => __DIR__ . '/../..' . '/controllers/itemsController.php',
        'App\\Core\\App' => __DIR__ . '/../..' . '/core/App.php',
        'App\\Core\\Database\\Database' => __DIR__ . '/../..' . '/core/database/Database.php',
        'App\\Core\\Database\\QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'App\\Core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'ComposerAutoloaderInitec29dcf9c5812542b2765f334b01268b' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInitec29dcf9c5812542b2765f334b01268b' => __DIR__ . '/..' . '/composer/autoload_static.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitec29dcf9c5812542b2765f334b01268b::$classMap;

        }, null, ClassLoader::class);
    }
}
