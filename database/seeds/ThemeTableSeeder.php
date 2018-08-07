<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Entities\Theme;


class ThemeTableSeeder extends Seeder
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

        $tema1 = new Theme();
        $tema1->setTema("JavaScript");
        $this->em->persist($tema1);
        $this->em->flush();

        $tema2 = new Theme();
        $tema2->setTema("PHP");
        $this->em->persist($tema2);
        $this->em->flush();

        $tema3 = new Theme();
        $tema3->setTema("JPA");
        $this->em->persist($tema3);
        $this->em->flush();

        $tema4 = new Theme();
        $tema4->setTema("Java");
        $this->em->persist($tema4);
        $this->em->flush();

        $tema5 = new Theme();
        $tema5->setTema("Redes");
        $this->em->persist($tema5);
        $this->em->flush();

        $tema6 = new Theme();
        $tema6->setTema("Phyton");
        $this->em->persist($tema6);
        $this->em->flush();

        $tema7 = new Theme();
        $tema7->setTema("BD");
        $this->em->persist($tema7);
        $this->em->flush();
    }
}
