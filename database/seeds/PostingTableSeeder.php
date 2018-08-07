<?php

use Illuminate\Database\Seeder;
use App\Entities\Posting;
use App\Entities\User;
use App\Entities\Theme;

class PostingTableSeeder extends Seeder
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
        $user = $this->em->find(User::class, 1);
        $tema = $this->em->find(Theme::class, 2);

        $post = new Posting();
        $post->setUser($user);
        $post->setTema($tema);
        $post->setMensagem("Como usar uma trait");
        $post->setTitulo("Titulo 1");

        $this->em->persist($post);
        $this->em->flush();


        $user2 = $this->em->find(User::class, 2);
        $tema2 = $this->em->find(Theme::class, 7);
        $post2 = new Posting();
        $post2->setUser($user2);
        $post2->setTema($tema2);
        $post2->setMensagem("Como conectar ao banco");
        $post2->setTitulo("Titulo 2");

        $this->em->persist($post2);
        $this->em->flush();

        $user3 = $this->em->find(User::class, 3);
        $tema3 = $this->em->find(Theme::class, 2);
        $post3 = new Posting();
        $post3->setUser($user3);
        $post3->setTema($tema3);
        $post3->setMensagem("Como tirar 10 no projeto php");
        $post3->setTitulo("Titulo 3");

        $this->em->persist($post3);
        $this->em->flush();

        $user4 = $this->em->find(User::class, 4);
        $tema4 = $this->em->find(Theme::class, 5);
        $post4 = new Posting();
        $post4->setUser($user4);
        $post4->setTema($tema4);
        $post4->setMensagem("Como implemtar uma vlan");
        $post4->setTitulo("Titulo 4");

        $this->em->persist($post4);
        $this->em->flush();
    }

}