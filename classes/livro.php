<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 22/10/2018
 * Time: 22:21
 */

class livro
{

    private $id;
    private $titulo;
    private $autor;
    private $tradutor;
    private $isbn;
    private $editora;
    private $ano;
    private $local;
    private $num_paginas;
    private $descricao;
    private $categoria_idCategoria;

    /**
     * livro constructor.
     * @param $id
     * @param $titulo
     * @param $autor
     * @param $tradutor
     * @param $isbn
     * @param $editora
     * @param $ano
     * @param $local
     * @param $num_paginas
     * @param $descricao
     * @param $categoria_idCategoria
     */
    public function __construct($id, $titulo, $autor, $tradutor, $isbn, $editora, $ano, $local, $num_paginas, $descricao, $categoria_idCategoria)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->tradutor = $tradutor;
        $this->isbn = $isbn;
        $this->editora = $editora;
        $this->ano = $ano;
        $this->local = $local;
        $this->num_paginas = $num_paginas;
        $this->descricao = $descricao;
        $this->categoria_idCategoria = $categoria_idCategoria;
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor): void
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getTradutor()
    {
        return $this->tradutor;
    }

    /**
     * @param mixed $tradutor
     */
    public function setTradutor($tradutor): void
    {
        $this->tradutor = $tradutor;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getEditora()
    {
        return $this->editora;
    }

    /**
     * @param mixed $editora
     */
    public function setEditora($editora): void
    {
        $this->editora = $editora;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano): void
    {
        $this->ano = $ano;
    }

    /**
     * @return mixed
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param mixed $local
     */
    public function setLocal($local): void
    {
        $this->local = $local;
    }

    /**
     * @return mixed
     */
    public function getNumPaginas()
    {
        return $this->num_paginas;
    }

    /**
     * @param mixed $num_paginas
     */
    public function setNumPaginas($num_paginas): void
    {
        $this->num_paginas = $num_paginas;
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

    /**
     * @return mixed
     */
    public function getCategoriaIdCategoria()
    {
        return $this->categoria_idCategoria;
    }

    /**
     * @param mixed $categoria_idCategoria
     */
    public function setCategoriaIdCategoria($categoria_idCategoria): void
    {
        $this->categoria_idCategoria = $categoria_idCategoria;
    }


}