<?php

namespace App\Models;
use App\Models\Allproduct;

class Book extends Allproduct
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    
    private $weight;
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}
