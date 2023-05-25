<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\Message;

class MessageTest extends TestCase
{
    public function test_it_replaces_rule_name_within_string()
    {
        $this->assertEquals(Message::generate('%s is required and cannot be empty', 'name'), 'name is required and cannot be empty');
    }
}
