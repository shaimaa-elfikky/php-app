<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\Rules\RequiredRule;
use TestTask\Validation\Rules\Contract\Rule;

class RequiredRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new RequiredRule();

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_fails_if_given_input_is_empty()
    {
        $sku = '';

        $rule = new RequiredRule();

        $this->assertFalse(
            $rule->apply(
                'sku',
                $sku
            )
        );
    }

    public function test_it_passes_if_given_input_has_a_value()
    {
        $username = 'sku123';

        $rule = new RequiredRule();

        $this->assertTrue(
            $rule->apply(
                'sku',
                $sku
            )
        );
    }
}
