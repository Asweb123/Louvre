<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SundayBookingDisabled extends Constraint
{
    public $message = 'Les dimanches sont indisponibles à la réservation.';
}

// 'It\'s not possible to book tickets on Sundays'