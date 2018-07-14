<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TodayAlreadyClosed extends Constraint
{
    public $message = 'Le musée est fermé. Veuillez choisir une autre date de visite.';
}
