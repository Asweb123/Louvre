<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxTicketsQuantity extends Constraint
{
    public $message = 'Sorry, no more tickets available for this date.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}