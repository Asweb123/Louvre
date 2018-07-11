<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TodayClosing extends Constraint
{
    public $message = 'Le musée va fermer dans moins d\'une heure et n\'accepte plus de visiteur. Veuillez choisir une autre date de visite.';

}

// 'The museum will close in less than a hour and doesn\'t accept anymore visitor. Please change the date of your visit.'