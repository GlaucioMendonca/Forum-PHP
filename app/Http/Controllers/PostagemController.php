<?php

namespace App\Http\Controllers;

use App\Entities\Answer;
use App\Entities\Posting;
use App\Entities\Theme;
use App\Helper\MyDateTime;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PostagemController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function cadastrarPostagem()
    {
        $tema = $this->em->getRepository(Theme::class)
            ->find(Input::get('tema'));

        $post = new Posting();

        $post->setUser(Auth::user());
        $post->setTitulo(Input::get('titulo'));
        $post->setTema($tema);
        $post->setMensagem(Input::get('mensagem'));

        $this->em->persist($post);
        $this->em->flush();

        return Redirect::back();
    }

    public function removerPostagem($postagem_id)
    {
        $posting = $this->em->getRepository(Posting::class)
            ->find($postagem_id);

        $this->em->remove($posting);
        $this->em->flush();
        return redirect('/home');
    }

    public function comentarPostagem($postagem_id)
    {
        $posting = $this->em->getRepository(Posting::class)
            ->find($postagem_id);

        $answer = new Answer();
        $answer->setUser(Auth::user());
        $answer->setMensagem(Input::get('comentario'));
        $answer->setPost($posting);
        $posting->addAnswer($answer);

        $this->em->persist($posting);
        $this->em->persist($answer);
        $this->em->flush();

        return Redirect::back();
    }

    public function showEditPost($postagem_id)
    {
        $post = $this->em->getRepository(Posting::class)
            ->find($postagem_id);

        return view('editPostagem', ['post' => $post]);
    }

    public function editPost($postagem_id)
    {
        $post = $this->em->getRepository(Posting::class)
            ->find($postagem_id);

        $post->setTitulo(Input::get('titulo'));
        $post->setMensagem(Input::get('mensagem'));

        $this->em->persist($post);
        $this->em->flush();

        return redirect('home');
    }
}
