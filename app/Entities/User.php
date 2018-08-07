<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements Authenticatable
{

    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    protected $cpf;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $sobrenome;

    /**
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    protected $password;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="users", cascade={"ALL"})
     * @var $role
     */
    protected $role;

    /**
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="user", cascade={"ALL"})
     */
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="user", cascade={"ALL"})
     */
    protected $answers;

    public function __construct()
    {
        $this->role = new Role();
        $this->posts = new ArrayCollection;
        $this->answers = new ArrayCollection;
    }

    /* Metodos da Interface Authenticatable
     *
     */
    /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * @return integer
     */
    public function getAuthIdentifier()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * @param string
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'rememberToken';
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
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param mixed $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function addPost(Posting $post)
    {
        if(!$this->posts->contains($post)) {
            $post->setUser($this);
            $this->posts->add($post);
        }
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer)
    {
        if(!$this->answers->contains($answer)) {
            $answer->setUser($this);
            $this->answers->add($answer);
        }
    }
}