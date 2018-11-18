<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 05/11/2018
 * Time: 19:25
 */

require_once "banco/connection.php";
require_once "classes/exemplar.php";

class exemplarDAO
{
    public function remover($exe)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM exemplar WHERE idExemplar = :id");
            $statement->bindValue(":id", $exe->getId());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($exe)
    {
        global $pdo;
        try {
            if ($exe->getId() != "") {
                $statement = $pdo->prepare("UPDATE exemplar SET fornecedor=:fornecedor, doador=:doador, situacao=:situacao, localizacao=:localizacao, data_cadastro=:data_cadastro, preco=:preco, tipo=:tipo, qtd_disponivel=:qtd_disponivel, livro_idLivro=:livro_idLivro, download=:download WHERE idExemplar = :id;");
                $statement->bindValue(":id", $exe->getId());
            } else {
                $statement = $pdo->prepare("INSERT INTO exemplar (fornecedor, doador, situacao, localizacao, data_cadastro, preco, tipo, qtd_disponivel, livro_idLivro, download) VALUES (:fornecedor, :doador, :situacao, :localizacao, :data_cadastro, :preco, :tipo, :qtd_disponivel, :livro_idLivro, :download) ");
            }
            $statement->bindValue(":fornecedor", $exe->getFornecedor());
            $statement->bindValue(":doador", $exe->getDoador());
            $statement->bindValue(":situacao", $exe->getSituacao());
            $statement->bindValue(":localizacao", $exe->getLocalizacao());
            $statement->bindValue(":data_cadastro", $exe->getDataCadastro());
            $statement->bindValue(":preco", $exe->getPreco());
            $statement->bindValue(":tipo", $exe->getTipo());
            $statement->bindValue(":qtd_disponivel", $exe->getQtdDisponivel());
            $statement->bindValue(":livro_idLivro", $exe->getLivroIdLivro());
            $statement->bindValue(":download", $exe->getDownload());


            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "<script> alert('Dados cadastrados com sucesso !'); </script>";
                } else {
                    return "<script> alert('Erro ao tentar efetivar cadastro !'); </script>";
                }
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($exe)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idExemplar, fornecedor, doador, situacao, localizacao, data_cadastro, preco, tipo, qtd_disponivel, livro_idLivro, download FROM exemplar WHERE idExemplar = :id");
            $statement->bindValue(":id", $exe->getId());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $exe->setId($rs->idExemplar);
                $exe->setFornecedor($rs->fornecedor);
                $exe->setDoador($rs->doador);
                $exe->setSituacao($rs->situacao);
                $exe->setLocalizacao($rs->localizacao);
                $exe->setDataCadastro($rs->data_cadastro);
                $exe->setPreco($rs->preco);
                $exe->setTipo($rs->tipo);
                $exe->setQtdDisponivel($rs->qtd_disponivel);
                $exe->setLivroIdLivro($rs->livro_idLivro);
                $exe->setDownload($rs->download);
                return $exe;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 2);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT CA.idExemplar, CA.fornecedor, CA.doador, CA.situacao, CA.localizacao, CA.data_cadastro, CA.preco, CA.tipo, CA.qtd_disponivel, CA.livro_idLivro, CA.download, L.titulo, L.isbn FROM categoria CA INNER JOIN livro L ON L.idLivro = CA.livro_idLivro LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM exemplar";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr style='text-transform: uppercase;' class='active'>
        <th style='text-align: center; font-weight: bolder;'>ID</th>
        <th style='text-align: center; font-weight: bolder;'>Título</th>
        <th style='text-align: center; font-weight: bolder;'>ISBN</th>
        <th style='text-align: center; font-weight: bolder;'>Fornecedor</th>
        <th style='text-align: center; font-weight: bolder;'>Doador</th>
        <th style='text-align: center; font-weight: bolder;'>Situação</th>
        <th style='text-align: center; font-weight: bolder;'>Localização</th>
        <th style='text-align: center; font-weight: bolder;'>Data de Cadastro</th>
        <th style='text-align: center; font-weight: bolder;'>Preço</th>
        <th style='text-align: center; font-weight: bolder;'>Tipo</th>
        <th style='text-align: center; font-weight: bolder;'>Quantidade Disponível</th>
        <th style='text-align: center; font-weight: bolder;'>Download</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Ações Admin</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Ações Cliente</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $exe):
                echo "<tr>
        <td style='text-align: center'>$exe->idExemplar</td>
        <td style='text-align: center'>$exe->titulo</td>
        <td style='text-align: center'>$exe->isbn</td>
        <td style='text-align: center'>$exe->fornecedor</td>
        <td style='text-align: center'>$exe->doador</td>
        <td style='text-align: center'>$exe->situacao</td>
        <td style='text-align: center'>$exe->localizacao</td>
        <td style='text-align: center'>$exe->data_cadastro</td>
        <td style='text-align: center'>$exe->preco</td>
        <td style='text-align: center'>$exe->tipo</td>
        <td style='text-align: center'>$exe->qtd_disponivel</td>
        <td style='text-align: center'>$exe->download</td>
        <td style='text-align: center'><a href='?act=upd&id=$exe->idExemplar' title='Alterar'><i class='fa-rotate-right'></i></a></td>
        <td style='text-align: center'><a href='?act=del&id=$exe->idExemplar' title='Remover'><i class='fa-times'></i></a></td>
        <td style='text-align: center'><a href='?act=upd&id=$exe->idExemplar' title='Emprestimo'>Solicitar Empréstimo</a></td>
        <td style='text-align: center'><a href='?act=del&id=$exe->idExemplar' title='Reserva'>Slocitar Reserva</a></td>
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

    <div class='box-paginacao' style='text-align: center'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'> Primeira  |</a>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'> Anterior  |</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'> ( $i ) </a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>| Próxima  </a>
                  <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina'  title='Última Página'>| Última  </a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }

}