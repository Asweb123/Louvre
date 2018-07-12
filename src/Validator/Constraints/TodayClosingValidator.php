<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class TodayClosingValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {

        if (($bookingDate->format('Y-m-d') == date('Y-m-d')) && (
            ((date('H-i') > '17-30') && (date('w') == 4)) ||
            ((date('H-i') > '17-30') && (date('w') == 6)) ||
            ((date('H-i') > '17-30') && (date('w') == 0)) ||
            ((date('H-i') > '21-15') && (date('w') == 3)) ||
            ((date('H-i') > '21-15') && (date('w') == 5))
            )) {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
