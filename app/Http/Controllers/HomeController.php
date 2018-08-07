<?php

namespace App\Http\Controllers;

use App\Entities\Answer;
use App\Entities\Posting;
use App\Entities\Theme;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $em;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->em->getRepository(Posting::class)->findAll();
        $temas = $this->em->getRepository(Theme::class)->findAll();

        $data = [
            'posts' => $posts,
            'temas' => $temas,
        ];

        return view('home', $data);
    }

    /**
     * @param $tema_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     *
     */

    public function post($tema_id)
    {
        $tema = $this->em->find(Theme::class, $tema_id);
        $posts = $this->em->getRepository(Posting::class)->findAllByTheme($tema->getTema());

        $data = [
            'posts' => $posts,
            'tema' => $tema,
        ];

        return view('posts', $data);
    }

    /**
     * @param $tema_id
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function message($tema_id, $post_id)
    {
        $post = [];
        $post[] = $this->em->find(Posting::class, $post_id); // $post é um array que contém mensagem e resposta

        return view('messages', ["data" => $post]);
    }

    public function indexQuery($data){

        return view('home', $data);
    }
}
