<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Helper;
use Rakit\Validation\Rule;

class Before extends Rule
{
    use Traits\DateUtilsTrait;

    /** @var string */
    protected $message = "The :attribute must be a date before :time.";

    /** @var array */
    protected $fillableParams = ['time'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     * @throws \Exception
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        $time = $this->parameter('time');

        // An invalid rule parameter is a programming error.
        if (!$this->isValidDate($time)) {
            throw $this->throwException($time);
        }

        // An invalid value is user input: fail the rule instead of throwing.
        if (!Helper::isStringable($value) || !$this->isValidDate((string) $value)) {
            return false;
        }

        return $this->getTimeStamp($time) > $this->getTimeStamp($value);
    }
}
