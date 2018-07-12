<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TuesdayBookingDisabled extends Constraint
{
    public $message = 'Le musée est fermé le mardi.';
}

// 'The museum is closed on Tuesdays'
