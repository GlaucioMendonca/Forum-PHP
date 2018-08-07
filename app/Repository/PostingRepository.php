<?php

namespace App\Repository;


use App\Entities\Posting;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;

class PostingRepository extends EntityRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var QueryBuilder
     */
    private $qb;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;
        $this->qb = $em->createQueryBuilder();

        parent::__construct($em, $class);
    }

    public function findByDate(\DateTime $date)
    {
        return $this->em->getRepository(Posting::class)
            ->findOneBy(["dataPostagem => $date"]);
    }

    public function findAllByDateOrder($type)
    {
        $this->qb->select('p')
            ->from(Posting::class, 'p')
            ->orderBy('p.dataPostagem', $type);

        return $this->qb->getQuery()->getResult();
    }

    public function findAllByTheme($tema)
    {
        $this->qb->select('p')
            ->from(Posting::class, 'p')
            ->join('p.tema', 't')
            ->where('t.tema = :tema')
            ->setParameter(':tema', $tema);

        return $this->qb->getQuery()->getResult();
    }

    public function findAllByUserId($user_id)
    {
        $this->qb->select('p')
            ->from(Posting::class, 'p')
            ->join('p.user', 'u')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id);

        return $this->qb->getQuery()->getResult();
    }
}