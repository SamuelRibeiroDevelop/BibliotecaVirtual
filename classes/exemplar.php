<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 22/10/2018
 * Time: 22:55
 */

class exemplar
{

    private $id;
    private $fornecedor;
    private $doador;
    private $situacao;
    private $localizacao;
    private $data_cadastro;
    private $preco;
    private $tipo;
    private $qtd_disponivel;
    private $livro_idLivro;

    /**
     * exemplar constructor.
     * @param $id
     * @param $fornecedor
     * @param $doador
     * @param $situacao
     * @param $localizacao
     * @param $data_cadastro
     * @param $preco
     * @param $tipo
     * @param $qtd_disponivel
     * @param $livro_idLivro
     */
    public function __construct($id, $fornecedor, $doador, $situacao, $localizacao, $data_cadastro, $preco, $tipo, $qtd_disponivel, $livro_idLivro)
    {
        $this->id = $id;
        $this->fornecedor = $fornecedor;
        $this->doador = $doador;
        $this->situacao = $situacao;
        $this->localizacao = $localizacao;
        $this->data_cadastro = $data_cadastro;
        $this->preco = $preco;
        $this->tipo = $tipo;
        $this->qtd_disponivel = $qtd_disponivel;
        $this->livro_idLivro = $livro_idLivro;
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
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * @param mixed $fornecedor
     */
    public function setFornecedor($fornecedor): void
    {
        $this->fornecedor = $fornecedor;
    }

    /**
     * @return mixed
     */
    public function getDoador()
    {
        return $this->doador;
    }

    /**
     * @param mixed $doador
     */
    public function setDoador($doador): void
    {
        $this->doador = $doador;
    }

    /**
     * @return mixed
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param mixed $situacao
     */
    public function setSituacao($situacao): void
    {
        $this->situacao = $situacao;
    }

    /**
     * @return mixed
     */
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * @param mixed $localizacao
     */
    public function setLocalizacao($localizacao): void
    {
        $this->localizacao = $localizacao;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param mixed $data_cadastro
     */
    public function setDataCadastro($data_cadastro): void
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco): void
    {
        $this->preco = $preco;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getQtdDisponivel()
    {
        return $this->qtd_disponivel;
    }

    /**
     * @param mixed $qtd_disponivel
     */
    public function setQtdDisponivel($qtd_disponivel): void
    {
        $this->qtd_disponivel = $qtd_disponivel;
    }

    /**
     * @return mixed
     */
    public function getLivroIdLivro()
    {
        return $this->livro_idLivro;
    }

    /**
     * @param mixed $livro_idLivro
     */
    public function setLivroIdLivro($livro_idLivro): void
    {
        $this->livro_idLivro = $livro_idLivro;
    }

}