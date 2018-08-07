<?php

namespace App\Http\Controllers;

use App\Entities\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TemaController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function cadastrarTema()
    {
        $tema = new Theme();
        $tema->setTema(Input::get('tema'));
        $this->em->persist($tema);
        $this->em->flush();

        return redirect('/home');
    }
}
