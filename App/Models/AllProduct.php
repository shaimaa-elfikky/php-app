<?php

namespace App\Models;
use App\Models\Model;


class Allproduct extends Model {
    
   // protected $table = 'allproducts';
    protected $primaryKey = 'sku';

    private $id;
    private $sku;
    private $name;
    private $price;
    private $type;
    
    // Constructor
    

    
    // Getter and setter functions
public function getId() {
        return $this->id;
    }
    
public function setId($id) {
        $this->id = $id;
    }
    
public function getSku() {
        return $this->sku;
    }
    
public function setSku($sku) {
        $this->sku = $sku;
    }
    
public function getName() {
        return $this->name;
    }
    
public function setName($name) {
        $this->name = $name;
    }
    
public function getPrice() {
        return $this->price;
    }
    
public function setPrice($price) {
        $this->price = $price;
    }
    
public function getType() {
        return $this->type;
    }
    
public function setType($type) {
        $this->type = $type;
    }
    
    public function simpleDetails()
    {
        $data = ['name' => $this->getName(), 'price' => $this->getPrice()];
        
        $size = $this->hasOne(Size::class, 'product_sku')->first();
        if ($size) {
            $data['size'] = $size->name;
        }
        
        return $data;
    }
    
    public function configurableDetails()
    {
        $data = ['name' => $this->getName(), 'price' => $this->getPrice()];
        
        $dimensions = $this->hasMany(Dimension::class, 'product_sku')->get();
        $dimensionsStr = '';
        foreach ($dimensions as $dimension) {
            $dimensionsStr .= $dimension->height . 'x' . $dimension->width . 'x' . $dimension->length . ', ';
        }
        $data['dimensions'] = rtrim($dimensionsStr, ', ');
        
        return $data;
    }

    public static function deleteByIds($ids)
    {
        return self::whereIn('id', $ids)->delete();
    }


}
