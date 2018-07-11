<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxTicketsQuantity extends Constraint
{

    public $message = 'Nombre de billets encore disponibles à la réservation pour cette date: {{ ticketsQuantityAvailable }}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}

// 'Sorry, tickets quantity left for this date: {{ ticketsQuantityAvailable }}'