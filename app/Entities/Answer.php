<?php

namespace App\Entities;

use App\Helper\MyDateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 * @ORM\Table(name="answer")
 */
class Answer
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
    protected $dataResposta;

    /**
     * @ORM\Column(type="text")
     */
    protected $mensagem;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="answers", cascade={"persist"})
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Posting", inversedBy="answers", cascade={"persist"})
     */
    protected $post;

    public function __construct()
    {
        $this->dataResposta = new MyDateTime;
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
    public function getDataResposta()
    {
        return $this->dataResposta;
    }

    /**
     * @param mixed $dataResposta
     */
    public function setDataResposta(MyDateTime $dataResposta)
    {
        $this->dataResposta = $dataResposta;
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
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost(Posting $post)
    {
        $this->post = $post;
    }
}