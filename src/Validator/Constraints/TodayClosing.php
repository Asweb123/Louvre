<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TodayClosing extends Constraint
{
    public $message = 'The museum will close in less than a hour and doesn\'t accept anymore visitor. Please change the date of your visit.';

}