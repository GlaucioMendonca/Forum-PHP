<?php

namespace App\Repository;


use App\Entities\Answer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;

class AnswerRepository extends EntityRepository
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

    public function findbyDate(\DateTime $date)
    {
        return $this->em->getRepository(Answer::class)
            ->findOneBy(["dataResposta" => $date]);
    }

    public function findAllByDateOrder($type)
    {
        $this->qb->select('a')
            ->from(Answer::class, 'a')
            ->orderBy('a.dataResposta', $type);

        return $this->qb->getQuery()->getResult();
    }

    public function findAllByTheme($tema)
    {
        $this->qb->select('a')
            ->from(Answer::class, 'a')
            ->join('a.tema', 't')
            ->where('t.tema = :tema')
            ->setParameter(':tema', $tema);

        return $this->qb->getQuery()->getResult();
    }

    public function findAllByUserId($user_id)
    {
        $this->qb->select('a')
            ->from(Answer::class, 'a')
            ->join('a.user', 'u')
            ->where('u.id = :user_id')
            ->setParameter('user_id', $user_id);

        return $this->qb->getQuery()->getResult();
    }
}