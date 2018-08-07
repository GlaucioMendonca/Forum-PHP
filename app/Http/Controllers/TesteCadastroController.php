<?php

namespace App\Http\Controllers;

use App\Entities\Answer;
use App\Entities\Posting;
use App\Entities\Role;
use App\Entities\Theme;
use App\Entities\User;
use App\Enum\RoleEnum;
use App\Helper\MyDateTime;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TesteCadastroController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function cadastroRoleExemplo()
    {
        $role = new Role;

        // configurando a role
        $role->setRole(RoleEnum::PARTICIPANTE);

        // inserindo no banco
        $this->em->persist($role);
        $this->em->flush();
    }

    public function cadastroTemaExemplo()
    {
        $tema = new Theme;

        // configurando o tema
        $tema->setTema("doctrine");

        // inserindo no banco
        $this->em->persist($tema);
        $this->em->flush();
    }

    public function cadastroPostagemExemplo()
    {
        $posting = new Posting;
        $tema = $this->em->getRepository(Theme::class)
            ->findByName("doctrine");
        $mensagem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Cras sed bibendum leo. 
        Vestibulum interdum, nulla eu congue maximus, nulla ex sodales nulla, nec pretium felis leo vitae metus. 
        Sed sit amet sem vestibulum, maximus metus non, bibendum nunc. Donec ac nisi tortor. Cras eros nisi, lacinia eget tortor et, hendrerit hendrerit elit. 
        Sed vel urna nec ex malesuada facilisis. Morbi sit amet dignissim orci.";

        if(!is_null($tema)) {
            $posting->setUser(Auth::user());
            $posting->setTema($tema);
            $posting->setDataPostagem(new MyDateTime);
            $posting->setTitulo('Como usar o Doctrine');
            $posting->setMensagem($mensagem);

            $this->em->persist($posting);
            $this->em->flush();
        }
        else {
            dump("acesse primeiro a rota (localhost:8000/tema)");
        }
    }

    public function cadastroRespostaExemplo()
    {
        $answer = new Answer();
        $post = $this->em->find(Posting::class, 1);

        if(!is_null($post)) {
            // configurando a resposta
            $answer->setPost($post);
            $answer->setDataResposta(new MyDateTime());
            $answer->setMensagem("leia a documentação");

            // inserindo no banco
            $this->em->persist($answer);
            $this->em->flush();
        }
        else {
            dump("acesse primeiro a rota (localhost:8000/post)");
        }
    }

    public function cadastroUsuarioExemplo()
    {
        // pegando os dados inseridos acima
        $role = $this->em->getRepository(Role::class)
            ->findByName(RoleEnum::ADMINISTRADOR);
        $post = $this->em->find(Posting::class, 1);
        $answer = $this->em->find(Answer::class, 1);

        // configurando o usuario
        $user = new User;

        $user->setNome("ronaldo");
        $user->setEmail("ronily.web@gmail.com");
        $user->setUsername("ronaldo");
        $user->setPassword(Hash::make("12345"));
        $user->setRole($role);
        $user->addPost($post);
        $user->addAnswer($answer);

        $this->em->persist($user);
        $this->em->flush();
    }
}