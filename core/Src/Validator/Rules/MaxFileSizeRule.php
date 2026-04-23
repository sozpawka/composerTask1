<?php
namespace Src\Validator\Rules;
use Src\Validator\AbstractRule;

class MaxFileSizeRule extends AbstractRule {
    public function rule(): bool {
        if (!isset($this->value['size']) || (isset($this->value['error']) && $this->value['error'] !== 0)) {
            return false;
        }
        
        $maxSize = (int)($this->args[0] ?? 2048) * 1024;
        return $this->value['size'] <= $maxSize;
    }
    public function validate(): string {
        return $this->message ?? "Файл слишком большой";
    }
}