<?php
namespace Src\Validator\Rules;
use Src\Validator\AbstractRule;

class ImgRule extends AbstractRule {
    public function rule(): bool {
        if (!isset($this->value['name']) || empty($this->value['name'])) {
            return false;
        }
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($this->value['name'], PATHINFO_EXTENSION));
        return in_array($ext, $allowed);
    }
    public function validate(): string {
        return $this->message ?? "Файл должен быть изображением (JPG, PNG)";
    }
}