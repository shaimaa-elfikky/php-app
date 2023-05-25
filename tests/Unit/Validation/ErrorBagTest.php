<?php

use PHPUnit\Framework\TestCase;
use TestTask\Validation\Message;
use TestTask\Validation\ErrorBag;

class ErrorBagTest extends TestCase
{
    public function test_it_adds_error_message_for_a_field()
    {
        $bag = new ErrorBag();

        $bag->add('name', 'Test message for name');

        $this->assertArrayHasKey('name', $bag->errors);
    }

    public function test_it_can_use_message_api_for_adding_errors()
    {
        $bag = new ErrorBag();

        $bag->add('name', Message::generate('%s is added', 'name'));

        $this->assertArrayHasKey('name', $bag->errors);
        $this->assertEquals('name is added', $bag->errors['name'][0]);
    }

    public function test_it_adds_multiple_error_messages_for_the_same_field()
    {
        $bag = new ErrorBag();

        $bag->add('name', 'First');
        $bag->add('name', 'Second');
        $bag->add('name', 'Third');

        $this->assertCount(3, $bag->errors['name']);
    }
}
