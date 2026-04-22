<?php
namespace Src\Validator\Rules;
use Src\Validator\AbstractRule;

class MaxFileSizeRule extends AbstractRule {
    public function rule(): bool {
        if (empty($this->value['size'])) return false;
        $maxSize = (int)$this->args[0] * 1024;
        return $this->value['size'] <= $maxSize;
    }
    public function validate(): string {
        return $this->message ?? "Файл слишком большой";
    }
}