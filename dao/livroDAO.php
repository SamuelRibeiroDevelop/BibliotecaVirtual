<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 05/11/2018
 * Time: 19:26
 */

require_once "banco/connection.pbp";
require_once "classes/livro.php";

class livroDAO
{
    public function remover($livro)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM livro WHERE idLivro = :id");
            $statement->bindValue(":id", $livro->getId());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($livro)
    {
        global $pdo;
        try {
            if ($livro->getId() != "") {
                $statement = $pdo->prepare("UPDATE livro SET titulo=:titulo, autor=:autor, tradutor=:tradutor, isbn=:isbn, editora=:editora, ano=:ano, local=:local, num_paginas=:num_paginas, descricao=:descricao, categoria_idCategoria=:categoria_idCategoria WHERE idLivro = :id;");
                $statement->bindValue(":id", $livro->getId());
            } else {
                $statement = $pdo->prepare("INSERT INTO livro (titulo, autor, tradutor, isbn, editora, ano, local, num_paginas, descricao, categoria_idCategoria) VALUES (:titulo, :autor, :tradutor, :isbn, :editora, :ano, :local, :num_paginas, :descricao, :categoria_idCategoria) ");
            }
            $statement->bindValue(":titulo", $livro->getTitulo());
            $statement->bindValue(":autor", $livro->getAutor());
            $statement->bindValue(":tradutor", $livro->getTradutor());
            $statement->bindValue(":isbn", $livro->getIsbn());
            $statement->bindValue(":editora", $livro->getEditora());
            $statement->bindValue(":ano", $livro->getAno());
            $statement->bindValue(":local", $livro->getLocal());
            $statement->bindValue(":num_paginas", $livro->getNumPaginas());
            $statement->bindValue(":descricao", $livro->getDescricao());
            $statement->bindValue(":categoria_idCategoria", $livro->getCategoriaIdCategoria());

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

    public function atualizar($livro)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idLivro, titulo, autor, tradutor, isbn, editora, ano, local, num_paginas, descricao, categoria_idCategoria FROM livro WHERE idLivro = :id");
            $statement->bindValue(":id", $livro->getId());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $livro->setId($rs->idLivro);
                $livro->setTitulo($rs->titulo);
                $livro->setAutor($rs->autor);
                $livro->setTradutor($rs->tradutor);
                $livro->setIsbn($rs->isbn);
                $livro->setEditora($rs->editora);
                $livro->setAno($rs->ano);
                $livro->setLocal($rs->local);
                $livro->setNumPaginas($rs->num_paginas);
                $livro->setDescricao($rs->descricao);
                $livro->setCategoriaIdCategoria($rs->categoria_idCategoria);
                return $livro;
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
        $sql = "SELECT L.idLivro, L.titulo, L.autor, L.tradutor, L.isbn, L.editora, L.ano, L.local, L.num_paginas, L.descricao, L.categoria_idCategoria, CA.nome FROM livro L INNER JOIN categoria CA ON L.categoria_idCategoria = CA.idCategoria LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM livro";
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
        <th style='text-align: center; font-weight: bolder;'>Autor</th>
        <th style='text-align: center; font-weight: bolder;'>Tradutor</th>
        <th style='text-align: center; font-weight: bolder;'>ISBN</th>
        <th style='text-align: center; font-weight: bolder;'>Editora</th>
        <th style='text-align: center; font-weight: bolder;'>Ano Lançamento</th>
        <th style='text-align: center; font-weight: bolder;'>Local de Lançamento</th>
        <th style='text-align: center; font-weight: bolder;'>Número de Páginas</th>
        <th style='text-align: center; font-weight: bolder;'>Descrição</th>
        <th style='text-align: center; font-weight: bolder;'>Categoria</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $livro):
                echo "<tr>
        <td style='text-align: center'>$livro->idLivro</td>
        <td style='text-align: center'>$livro->titulo</td>
        <td style='text-align: center'>$livro->autor</td>
        <td style='text-align: center'>$livro->tradutor</td>
        <td style='text-align: center'>$livro->isbn</td>
        <td style='text-align: center'>$livro->editora</td>
        <td style='text-align: center'>$livro->ano</td>
        <td style='text-align: center'>$livro->local</td>
        <td style='text-align: center'>$livro->num_paginas</td>
        <td style='text-align: center'>$livro->descricao</td>
        <td style='text-align: center'>$livro->nome</td>
        <td style='text-align: center'><a href='?act=upd&id=$livro->idLivro' title='Alterar'><i class='fa-rotate-right'></i></a></td>
        <td style='text-align: center'><a href='?act=del&id=$livro->idLivro' title='Remover'><i class='fa-times'></i></a></td>
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