<?php

namespace App\Repository;

use App\Entity\OrderCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderCustomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderCustomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderCustomer[]    findAll()
 * @method OrderCustomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderCustomerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderCustomer::class);
    }

}
