<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\RulesResolver;
use TestTask\Validation\Rules\EmailRule;
use TestTask\Validation\UniqueRule;
use TestTask\Validation\Rules\RequiredRule;
use TestTask\Validation\Rules\Contract\Rule;

class RulesResolverTest extends TestCase
{
    public function test_it_gets_rules_from_a_string()
    {
        $stringToMap = 'required';

        $instance = RulesResolver::getRuleFromString($stringToMap);

        $this->assertInstanceOf(RequiredRule::class, $instance);
    }

    public function test_it_makes_an_array_of_rules_out_of_piped_string()
    {
        $rules = 'required|unique';

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }

    public function test_it_resolves_array_of_strings_to_array_of_rules()
    {
        $rules = ['unique', 'required'];

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }


    public function test_it_gets_unique_rule_instance()
    {
        $stringToMap = 'unique';
        
        $instance = RulesResolver::getRuleFromString($stringToMap);
        
        $this->assertInstanceOf(UniqueRule::class, $instance);
    }


    public function test_it_accepts_array_of_rule_instances()
    {
        $rules = [
            new RequiredRule(),
            new EmailRule(),
            new UniqueRule(),
        ];

        $instances = RulesResolver::make($rules);

        $this->assertContainsOnlyInstancesOf(Rule::class, $instances);
    }
}
