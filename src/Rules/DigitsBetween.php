<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Helper;
use Rakit\Validation\Rule;

class DigitsBetween extends Rule
{

    /** @var string */
    protected $message = "The :attribute must have a length between the given :min and :max";

    /** @var array */
    protected $fillableParams = ['min', 'max'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);

        $min = (int) $this->parameter('min');
        $max = (int) $this->parameter('max');

        if (!Helper::isStringable($value)) {
            return false;
        }
        $value = (string) $value;
        $length = strlen($value);

        return ! preg_match('/[^0-9]/', $value)
                    && $length >= $min && $length <= $max;
    }
}
