<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\Rules\EmailRule;
use TestTask\Validation\Rules\Contract\Rule;

class EmailRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new EmailRule();

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_passes_if_email_is_valid()
    {
        $email = 'shaimaa_elfikk79@outlook.com';

        $rule = new EmailRule();

        $this->assertTrue(
            (bool) $rule->apply('email', $email)
        );
    }

    public function test_it_fails_if_email_is_not_valid()
    {
        $email = 'shaimaa@12';

        $rule = new EmailRule();

        $this->assertFalse(
            (bool) $rule->apply('email', $email)
        );
    }
}
