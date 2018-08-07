<?php

namespace App\Repository;

use App\Entities\Theme;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class ThemeRepository extends EntityRepository
{
    private $em;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->em = $em;
    }

    public function findByName($tema)
    {
        return $this->em->getRepository(Theme::class)
            ->findOneBy(["tema" => $tema]);
    }
}