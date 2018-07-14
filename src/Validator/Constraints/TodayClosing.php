<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TodayClosing extends Constraint
{
    public $message = 'Le musée fermera ses portes dans moins d\'une demi-heure et n\'accepte plus de visiteur. Veuillez choisir une autre date de visite.';
}
