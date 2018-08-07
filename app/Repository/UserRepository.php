<?php

namespace App\Repository;


use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var QueryBuilder
     *
     */
    private $qb;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;
        $this->qb = $em->createQueryBuilder();

        parent::__construct($em, $class);
    }

    public function findByName($name)
    {
        return $this->em->getRepository(User::class)
            ->findOneBy(["nome" => $name]);
    }

    public function findByEmail($email)
    {
        $this->qb->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email);

        return $this->qb->getQuery()->getSingleResult();
    }
}