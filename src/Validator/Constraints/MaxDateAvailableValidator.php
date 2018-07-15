<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 12/07/2018
 * Time: 16:09
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxDateAvailableValidator extends ConstraintValidator
{
    public function validate($bookingDate, Constraint $constraint)
    {

        if ($bookingDate->format('Y-m-d') > date('Y-m-d', strtotime("+1 year"))) {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
