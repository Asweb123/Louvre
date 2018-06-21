<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PublicHolidayBookingDesabled extends Constraint
{
    public $message = 'On this date, the museum will be closed due to public holiday.';
}