<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 22/10/2018
 * Time: 22:55
 */

class reserva
{

    private $id;
    private $dataEmprestimo;
    private $dataDevolucao;
    private $exemplar_idExemplar;
    private $usuario_idUsuario;

    /**
     * reserva constructor.
     * @param $id
     * @param $dataEmprestimo
     * @param $dataDevolucao
     * @param $exemplar_idExemplar
     * @param $usuario_idUsuario
     */
    public function __construct($id, $dataEmprestimo, $dataDevolucao, $exemplar_idExemplar, $usuario_idUsuario)
    {
        $this->id = $id;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
        $this->exemplar_idExemplar = $exemplar_idExemplar;
        $this->usuario_idUsuario = $usuario_idUsuario;
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
    public function getDataEmprestimo()
    {
        return $this->dataEmprestimo;
    }

    /**
     * @param mixed $dataEmprestimo
     */
    public function setDataEmprestimo($dataEmprestimo): void
    {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    /**
     * @return mixed
     */
    public function getDataDevolucao()
    {
        return $this->dataDevolucao;
    }

    /**
     * @param mixed $dataDevolucao
     */
    public function setDataDevolucao($dataDevolucao): void
    {
        $this->dataDevolucao = $dataDevolucao;
    }

    /**
     * @return mixed
     */
    public function getExemplarIdExemplar()
    {
        return $this->exemplar_idExemplar;
    }

    /**
     * @param mixed $exemplar_idExemplar
     */
    public function setExemplarIdExemplar($exemplar_idExemplar): void
    {
        $this->exemplar_idExemplar = $exemplar_idExemplar;
    }

    /**
     * @return mixed
     */
    public function getUsuarioIdUsuario()
    {
        return $this->usuario_idUsuario;
    }

    /**
     * @param mixed $usuario_idUsuario
     */
    public function setUsuarioIdUsuario($usuario_idUsuario): void
    {
        $this->usuario_idUsuario = $usuario_idUsuario;
    }


}