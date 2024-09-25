<?php

namespace modelo;

trait Entidad {

    public function toArray() {
        $array = [];
        $reflectionClass = new \ReflectionClass($this);
        while ($reflectionClass) {
            foreach ($reflectionClass->getProperties() as $property) {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($this);
            }
            $reflectionClass = $reflectionClass->getParentClass();
        }
        return $array;
    }
}
