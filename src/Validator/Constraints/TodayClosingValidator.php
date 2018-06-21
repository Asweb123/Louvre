<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class TodayClosingValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {

        if (($bookingDate->format('Y-m-d') == date('Y-m-d'))
        && (date('H') > '18')) {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}