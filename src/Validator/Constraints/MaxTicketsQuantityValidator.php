<?php

namespace App\Validator\Constraints;


use App\Service\TotalTicketsDayCalculator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxTicketsQuantityValidator extends ConstraintValidator
{
    private $totalTicketsDayCalculator;

    public function __construct(TotalTicketsDayCalculator $totalTicketsDayCalculator)
    {
        $this->totalTicketsDayCalculator = $totalTicketsDayCalculator;
    }


    public function validate($order, Constraint $constraint)
    {
        $totalTicketsDay = $this->totalTicketsDayCalculator->totalTicketsDayCalculator($order->getBookingDate());
        $ticketsQuantityAvailable = 1000 - $totalTicketsDay;

        if (($order->getTicketsQuantity() + $totalTicketsDay) > 1000)
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ ticketsQuantityAvailable }}', $ticketsQuantityAvailable)
                ->atPath('ticketsQuantity')
                ->addViolation();
        }

    }
}