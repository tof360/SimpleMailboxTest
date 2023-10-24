<?php

namespace App\Repository;

use App\Entity\Mail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mail>
 *
 * @method Mail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mail[]    findAll()
 * @method Mail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mail::class);
    }
    public function findByUser($id): ?array
    {
        return $this->createQueryBuilder('m')
            ->andWhere(':id MEMBER OF m.sendTo')
            ->andWhere('m.archived = 0')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findUnreadByUser($id): ?int
    {
        return $this->createQueryBuilder('m')
            ->select('COUNT(m)')
            ->andWhere(':id MEMBER OF m.sendTo')
            ->andWhere('m.archived = 0')
            ->andWhere('m.isRead = 0')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
