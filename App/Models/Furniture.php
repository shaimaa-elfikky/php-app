<?php

namespace App\Models;
use App\Models\Allproduct;

class Furniture extends Allproduct
{
    protected $table = 'furniture';
    protected $primaryKey = 'id';
    
    private $height;
    private $width;
    private $length;
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
    }
    
    public function getLength()
    {
        return $this->length;
    }
    
    public function setLength($length)
    {
        $this->length = $length;
    }}