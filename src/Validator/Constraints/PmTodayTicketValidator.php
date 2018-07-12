<?php

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PmTodayTicketValidator extends ConstraintValidator
{
    public function validate($order, Constraint $constraint)
    {
        if (($order->getBookingDate()->format('Y-m-d') == date('Y-m-d'))
        && ($order->getTicketType() == 1)
        && (date('H') >= '14'))
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('ticketType')
                ->addViolation();
        }
    }
}
