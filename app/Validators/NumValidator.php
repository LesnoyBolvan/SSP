<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumValidator extends AbstractValidator
{

    protected string $message = 'Field :field must be int';

    public function rule(): bool
    {
        return preg_match('/^[0-9]+$/', $this->value);
    }
}