<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxTicketsQuantity extends Constraint
{

    public $message = 'Sorry, tickets quantity left for this date: {{ ticketsQuantityAvailable }}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}