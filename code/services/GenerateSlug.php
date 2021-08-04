<?php

namespace App\services;

use Ausi\SlugGenerator\SlugGenerator;

class GenerateSlug
{
    public function __invoke($cadena)
    {
        $slugGenerator = new SlugGenerator();
        return $slugGenerator->generate($cadena);
        
    }

}