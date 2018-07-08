<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class PublicHolidayBookingDisabledValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {
        if (($bookingDate->format('m-d') == '05-01')
        || ($bookingDate->format('m-d') == '11-01')
        || ($bookingDate->format('m-d') == '12-25'))
        {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}