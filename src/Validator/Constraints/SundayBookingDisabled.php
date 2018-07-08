<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SundayBookingDisabled extends Constraint
{
    public $message = 'It\'s not possible to book tickets on Sundays';
}