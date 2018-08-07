<?php

namespace App\Entities;

use App\Helper\MyDateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostingRepository")
 * @ORM\Table(name="posting")
 */
class Posting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataPostagem;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $titulo;

    /**
     * @ORM\Column(type="text")
     */
    protected $mensagem;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts", cascade={"persist"})
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="post", cascade={"ALL"}, orphanRemoval= true)
     * @var ArrayCollection|Answer[]
     */
    protected $answers;

    /**
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="posts", cascade={"persist"})
     */
    protected $tema;

    public function __construct()
    {
        $this->dataPostagem = new MyDateTime;
        $this->answers = new ArrayCollection;
        $this->tema = new Theme;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDataPostagem()
    {
        return $this->dataPostagem;
    }

    /**
     * @param mixed $dataPostagem
     */
    public function setDataPostagem(MyDateTime $dataPostagem)
    {
        $this->dataPostagem = $dataPostagem;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $mensagem
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * @param mixed $mensagem
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Answer[]|ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer)
    {
        if(!$this->answers->contains($answer)) {
            $answer->setPost($this);
            $this->answers->add($answer);
        }
    }

    /**
     * @return Theme
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * @param mixed $tema
     */
    public function setTema(Theme $tema)
    {
        $this->tema = $tema;
    }
}