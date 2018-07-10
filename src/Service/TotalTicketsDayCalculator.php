<?php

namespace App\Service;


use App\Repository\OrderCustomerRepository;

class TotalTicketsDayCalculator
{
    private $orderRepository;

    public function __construct(OrderCustomerRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function totalTicketsDayCalculator($bookingDate)
    {

        $ordersSelectedDay = $this->orderRepository->findBy(['bookingDate' => $bookingDate]);

        $totalTicketsSelectedDay = 0;

        if($ordersSelectedDay !== null)
        {
            foreach ($ordersSelectedDay as $order)
            {
                $ticketsQuantityPerOrder = $order->getTicketsQuantity();

                $totalTicketsSelectedDay += $ticketsQuantityPerOrder;
            }
        }

        return $totalTicketsSelectedDay;
    }
}