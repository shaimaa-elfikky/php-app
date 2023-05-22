<?php

namespace TestTask\Validation;

use TestTask\Validation\Rules\MaxRule;
use TestTask\Validation\Rules\EmailRule;
use TestTask\Validation\Rules\UniqueRule;
use TestTask\Validation\Rules\BetweenRule;
use TestTask\Validation\Rules\AlphaNumRule;
use TestTask\Validation\Rules\RequiredRule;
use TestTask\Validation\Rules\ConfirmedRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmedRule::class,
        'unique' => UniqueRule::class,
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}
