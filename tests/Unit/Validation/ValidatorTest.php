<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\Validator;

class ValidatorTest extends TestCase
{
    public function test_it_validates_given_data()
    {
        $validator = new Validator();

        $validator->setRules([
            'name' => 'required|unique:allproducts,name',
            'sku' => 'required|unique:allproducts,sku',
            'price' => 'required',
            'type' => 'required',
        ]);

        $validator->make([
            'name' => 'chair',
            'sku' => 'sku123',
            'price' => '50',
            'type' => 'book',
        ]);

		$this->assertTrue($validator->passes());
    }
}
