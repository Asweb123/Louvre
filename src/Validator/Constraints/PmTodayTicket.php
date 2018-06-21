<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PmTodayTicket extends Constraint
{
    public $message = 'After 2 pm, it\'s not possible to choose a day ticket. Please select a half day ticket.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}

