<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\RulesMapper;
use TestTask\Validation\Rules\RequiredRule;

class RulesMapperTest extends TestCase
{
    public function test_it_maps_strings_to_their_corressponding_classes()
    {
        $stringToMap = 'required';

        $instance = RulesMapper::resolve($stringToMap, []);

        $this->assertInstanceOf(RequiredRule::class, $instance);
    }
}
