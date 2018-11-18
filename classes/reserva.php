<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 05/11/2018
 * Time: 19:25
 */

class reserva
{
    private $id;
    private $dt_inicio;
    private $dt_termino;
    private $exemplar_idExemplar;
    private $usuario_idUsuario;

    /**
     * reserva constructor.
     * @param $id
     * @param $dt_inicio
     * @param $dt_termino
     * @param $exemplar_idExemplar
     * @param $usuario_idUsuario
     */
    public function __construct($id, $dt_inicio, $dt_termino, $exemplar_idExemplar, $usuario_idUsuario)
    {
        $this->id = $id;
        $this->dt_inicio = $dt_inicio;
        $this->dt_termino = $dt_termino;
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
    public function getDtInicio()
    {
        return $this->dt_inicio;
    }

    /**
     * @param mixed $dt_inicio
     */
    public function setDtInicio($dt_inicio): void
    {
        $this->dt_inicio = $dt_inicio;
    }

    /**
     * @return mixed
     */
    public function getDtTermino()
    {
        return $this->dt_termino;
    }

    /**
     * @param mixed $dt_termino
     */
    public function setDtTermino($dt_termino): void
    {
        $this->dt_termino = $dt_termino;
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