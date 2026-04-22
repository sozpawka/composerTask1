<?php

namespace Src\Validator;

abstract class AbstractRule
{
    protected string $field;
    protected $value;
    protected array $args;
    protected ?string $message;

    public function __construct(string $field, $value, array $args = [], ?string $message = null)
    {
        $this->field = $field;
        $this->value = $value;
        $this->args = $args;
        $this->message = $message;
    }

    abstract public function rule(): bool;
    abstract public function validate(): string;
}