<?php

namespace App\Http\Controllers;

use App\Entities\Posting;
use App\Entities\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PesquisaController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function pesquisar()
    {
        $query = Input::get('pesquisar');

        $queryToLower = strtolower($query);

        if($query)
        {
            $posts = $this->em->getRepository(Posting::class)->findAll();

            $posts_query = [];
            foreach($posts as $post)
            {
                $postTituloToLower = strtolower($post->getTitulo());
                $postTemaToLower = strtolower($post->getTema()->getTema());

                if(strpos($postTituloToLower, $queryToLower) !== false || strpos($postTemaToLower, $queryToLower) !== false)
                {
                    array_push($posts_query, $post);
                }
            }

            $data = [
                'posts' => $posts_query,
                'temas' => $this->em->getRepository(Theme::class)->findAll(),
            ];
            return view('home', $data);
        }
        else
            return redirect('home');

    }
}
