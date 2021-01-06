<?php

namespace App\Models;

//use ReflectionClass;

abstract class Model
{
//    /** @var ReflectionClass $reflectionClass */
//    private $reflectionClass;
//
//    /**
//     * Model constructor.
//     */
//    public function __construct()
//    {
//        $this->reflectionClass = new ReflectionClass($this);
//    }
//
//    public function __get($property)
//    {
//        $properties = array_map(function(\ReflectionProperty $property){
//            return $property->name;
//        }, $this->reflectionClass->getProperties());
//        if (in_array($property, $properties)) {
//            return $this->$property;
//        }
//        return null;
//    }
}