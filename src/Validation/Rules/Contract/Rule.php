<?php

namespace TestTask\Validation\Rules\Contract;

interface Rule extends \Stringable
{
    public function apply($field, $value, $data = []);
}
