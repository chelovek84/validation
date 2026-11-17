<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Helper;
use Rakit\Validation\Rule;

class Regex extends Rule
{

    /** @var string */
    protected $message = "The :attribute is not valid format";

    /** @var array */
    protected $fillableParams = ['regex'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        $regex = $this->parameter('regex');
        if (!Helper::isStringable($value)) {
            return false;
        }
        return preg_match($regex, (string) $value) > 0;
    }
}
