<?php

namespace App\Models;
use App\Models\Allproduct;

class Dvd extends Allproduct
{
    protected $table = 'dvds';
    protected $primaryKey = 'id';
    
    private $size;
    
    public function getSize()
    {
        return $this->size;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    }
}