<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class SundayBookingDisabledValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {
        if ($bookingDate->format('w') == 0)
        {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}