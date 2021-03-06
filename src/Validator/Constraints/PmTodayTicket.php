<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PmTodayTicket extends Constraint
{
    public $message = 'Après 14h, il n\'est plus possible de réserver de billet de type Journée pour le jour même.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
