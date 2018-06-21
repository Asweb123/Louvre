<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TuesdayBookingDesabled extends Constraint
{
    public $message = 'The museum is closed on Tuesdays';
}