<?php
/**
 * Created by PhpStorm.
 * User: ronily
 * Date: 23/01/18
 * Time: 11:02
 */

namespace App\Repository;


use App\Entities\Role;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class RoleRepository extends EntityRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;

        parent::__construct($em, $class);
    }

    public function findByName($role)
    {
        return $this->em->getRepository(Role::class)
            ->findOneBy(["role" => $role]);
    }
}