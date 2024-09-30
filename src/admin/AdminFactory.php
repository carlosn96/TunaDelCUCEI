<?php

namespace admin;

class AdminFactory {

    private static $instances = [];

    public static function getAdminAsistencia(): AdminAsistencia {
        return self::getOrCreateInstance(AdminAsistencia::class);
    }
    
    public static function getAdminInstrumento(): AdminInstrumento {
        return self::getOrCreateInstance(AdminInstrumento::class);
    }

    public static function getAdminIntegrante(): AdminIntegrante {
        return self::getOrCreateInstance(AdminIntegrante::class);
    }

    public static function getAdminUsuario(): AdminUsuario {
        return self::getOrCreateInstance(AdminUsuario::class);
    }

    public static function getAdminEvento(): AdminEvento {
        return self::getOrCreateInstance(AdminEvento::class);
    }

    private static function getOrCreateInstance(string $class): Admin {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }
}
