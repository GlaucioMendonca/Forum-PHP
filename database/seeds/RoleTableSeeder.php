<?php

use Illuminate\Database\Seeder;
use App\Entities\Role;

class RoleTableSeeder extends Seeder
{

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->setRole('Administrador');
        $this->em->persist($role_admin);
        $this->em->flush();

        $role_part = new Role();
        $role_part->setRole('Participante');
        $this->em->persist($role_part);
        $this->em->flush();

        $role_pesq = new Role();
        $role_pesq->setRole('Pesquisador');
        $this->em->persist($role_pesq);
        $this->em->flush();
    }
}
