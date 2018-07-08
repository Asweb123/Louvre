<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PublicHolidayBookingDisabled extends Constraint
{
    public $message = 'On this date, the museum will be closed due to public holiday.';
}