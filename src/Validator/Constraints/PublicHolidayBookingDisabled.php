<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PublicHolidayBookingDisabled extends Constraint
{
    public $message = 'Le musée sera fermé à la date sélectionnée.';
}
