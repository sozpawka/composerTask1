<?php
namespace Src\Validator\Rules;
use Src\Validator\AbstractRule;

class NumberRule extends AbstractRule {
    public function rule(): bool {
        return isset($this->value) && is_numeric($this->value);
    }

    public function validate(): string {
        return $this->message ?? "Поле должно быть числом";
    }
}