<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Helper;
use Rakit\Validation\Rule;

class Uppercase extends Rule
{

    /** @var string */
    protected $message = "The :attribute must be uppercase";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        if (!Helper::isStringable($value)) {
            return false;
        }
        $string = (string) $value;

        return mb_strtoupper($string, mb_detect_encoding($string)) === $value;
    }
}
