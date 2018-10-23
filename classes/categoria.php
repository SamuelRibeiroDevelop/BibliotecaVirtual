<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 22/10/2018
 * Time: 22:55
 */

class categoria
{

    private $id;
    private $nome;
    private $esta_ativo;
    private $descricao;

    /**
     * categoria constructor.
     * @param $id
     * @param $nome
     * @param $esta_ativo
     * @param $descricao
     */
    public function __construct($id, $nome, $esta_ativo, $descricao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->esta_ativo = $esta_ativo;
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEstaAtivo()
    {
        return $this->esta_ativo;
    }

    /**
     * @param mixed $esta_ativo
     */
    public function setEstaAtivo($esta_ativo): void
    {
        $this->esta_ativo = $esta_ativo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }



}