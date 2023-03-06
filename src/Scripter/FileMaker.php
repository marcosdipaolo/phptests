<?php

namespace App\Scripter;

use App\Entities\Model;
use Nette\PhpGenerator\PhpFile;

class FileMaker
{
    const MODEL_NAMESPACE = 'App\Models';
    const MODEL_PATH = 'src/Models/';
    
    public static function make($namespace, $name): void
    {
        $file = new PhpFile;
        $namespace = $file->addNamespace($namespace);
        $class = $namespace->addClass($name);
        $class->setExtends(Model::class);
        $classFile = fopen(self::MODEL_PATH . "{$name}.php", 'w');
        fwrite($classFile, $file);
        fclose($classFile);
    }
}