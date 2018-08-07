<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Role;
use App\Enum\RoleEnum;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
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
        /**
         * Administrador
         */
        $role = $this->em->getRepository(Role::class)
            ->find(RoleEnum::ADMINISTRADOR);

        $user_admin = new User();
        $user_admin->setNome('admin');
        $user_admin->setCpf('12312312312');
        $user_admin->setEmail('admin@gmail.com');
        $user_admin->setPassword(Hash::make('admin'));
        $user_admin->setRole($role);

        $this->em->persist($user_admin);
        $this->em->flush();


        /**
         *Usuários pesquisadores
         */
        $role = $this->em->getRepository(Role::class)
            ->find(RoleEnum::PESQUISADOR);

        $user_pesquisador = new User();
        $user_pesquisador->setNome('glaucio');
        $user_pesquisador->setCpf('11122233344');
        $user_pesquisador->setEmail('glaucio@gmail.com');
        $user_pesquisador->setPassword(Hash::make('12345'));
        $user_pesquisador->setRole($role);
        $this->em->persist($user_pesquisador);
        $this->em->flush();

        $user_pesquisador = new User();
        $user_pesquisador->setNome('ronili');
        $user_pesquisador->setCpf('11122233300');
        $user_pesquisador->setEmail('ronili@gmail.com');
        $user_pesquisador->setPassword(Hash::make('12345'));
        $user_pesquisador->setRole($role);
        $this->em->persist($user_pesquisador);
        $this->em->flush();

        $user_pesquisador = new User();
        $user_pesquisador->setNome('mateus');
        $user_pesquisador->setCpf('11122233301');
        $user_pesquisador->setEmail('mateus@gmail.com');
        $user_pesquisador->setPassword(Hash::make('12345'));
        $user_pesquisador->setRole($role);
        $this->em->persist($user_pesquisador);
        $this->em->flush();

        $user_pesquisador = new User();
        $user_pesquisador->setNome('pesquisador');
        $user_pesquisador->setCpf('11122233302');
        $user_pesquisador->setEmail('pesquisador@gmail.com');
        $user_pesquisador->setPassword(Hash::make('12345'));
        $user_pesquisador->setRole($role);
        $this->em->persist($user_pesquisador);
        $this->em->flush();

        /**
         * Usuários padrão
         */
        $role = $this->em->getRepository(Role::class)
            ->find(RoleEnum::PARTICIPANTE);

        $user_padrao = new User();
        $user_padrao->setNome('user1');
        $user_padrao->setCpf('11122233303');
        $user_padrao->setEmail('user1@gmail.com');
        $user_padrao->setPassword(Hash::make('12345'));
        $user_padrao->setRole($role);
        $this->em->persist($user_padrao);
        $this->em->flush();

        $user_padrao = new User();
        $user_padrao->setNome('user2');
        $user_padrao->setCpf('11122233304');
        $user_padrao->setEmail('user2@gmail.com');
        $user_padrao->setPassword(Hash::make('12345'));
        $user_padrao->setRole($role);
        $this->em->persist($user_padrao);
        $this->em->flush();

        $user_padrao = new User();
        $user_padrao->setNome('user3');
        $user_padrao->setCpf('11122233305');
        $user_padrao->setEmail('user3@gmail.com');
        $user_padrao->setPassword(Hash::make('12345'));
        $user_padrao->setRole($role);
        $this->em->persist($user_padrao);
        $this->em->flush();

    }
}
