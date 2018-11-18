<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 15/11/2018
 * Time: 15:14
 */

require_once "classes/template.php";

require_once "dao/livroDAO.php";
require_once "classes/livro.php";

$object = new livroDAO();

$template = new Template();

$template->head();
$template->navbartop();
$template->sidebar();

$erro = false;

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != null) ? $_POST["titulo"] : "";
    $autor = (isset($_POST["autor"]) && $_POST["autor"] != null) ? $_POST["autor"] : "";
    $tradutor = (isset($_POST["tradutor"]) && $_POST["tradutor"] != null) ? $_POST["tradutor"] : "";
    $isbn = (isset($_POST["isbn"]) && $_POST["isbn"] != null) ? $_POST["isbn"] : "";
    $editora = (isset($_POST["editora"]) && $_POST["editora"] != null) ? $_POST["editora"] : "";
    $ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";
    $local = (isset($_POST["local"]) && $_POST["local"] != null) ? $_POST["local"] : "";
    $num_paginas = (isset($_POST["num_paginas"]) && $_POST["num_paginas"] != null) ? $_POST["num_paginas"] : "";
    $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
    $categoria_idCategoria = (isset($_POST["categoria_idCategoria"]) && $_POST["categoria_idCategoria"] != null) ? $_POST["categoria_idCategoria"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $titulo = NULL;
    $autor = NULL;
    $tradutor = NULL;
    $isbn = NULL;
    $editora = NULL;
    $ano = NULL;
    $local = NULL;
    $num_paginas = NULL;
    $descricao = NULL;
    $categoria_idCategoria = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $livro = new livro($id,'','','','','','','','','','');

    $resultado = $object->atualizar($livro);
    $titulo = $resultado->getTitulo();
    $autor = $resultado->getAutor();
    $tradutor = $resultado->getTradutor();
    $isbn = $resultado->getIsbn();
    $editora = $resultado->getEditora();
    $ano = $resultado->getAno();
    $local = $resultado->getLocal();
    $num_paginas = $resultado->getNumPaginas();
    $descricao = $resultado->getDescricao();
    $categoria_idCategoria = $resultado->getCategoriaIdCategoria();

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $titulo != "" && $autor != "" && $tradutor != "" && $isbn != "" && $editora != "" && $ano != "" && $local != "" && $num_paginas != "" && $descricao != "" && $categoria_idCategoria != "") {
    $livro = new livro($id, $titulo, $autor, $tradutor, $isbn, $editora, $ano, $local, $num_paginas, $descricao, $categoria_idCategoria);
    $msg = $object->salvar($livro);
    $id = null;
    $titulo = NULL;
    $autor = NULL;
    $tradutor = NULL;
    $isbn = NULL;
    $editora = NULL;
    $ano = NULL;
    $local = NULL;
    $num_paginas = NULL;
    $descricao = NULL;
    $categoria_idCategoria = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $livro = new livro($id, '', '','','','','','','','','');
    $msg = $object->remover($livro);
    $id = null;
}

if((! isset($titulo) || !is_string($titulo)) && !$erro){
    $erro = 'O campo "Título" contém valores não válidos';
}

if((! isset($autor) || !is_string($autor)) && !$erro){
    $erro = 'O campo "Autor" contém valores não válidos';
}

if((! isset($tradutor) || !is_string($tradutor)) && !$erro){
    $erro = 'O campo "Tradutor" contém valores não válidos';
}

if((! isset($isbn) || !is_string($isbn)) && !$erro){
    $erro = 'O campo "ISBN" contém valores não válidos';
}

if((! isset($editora) || !is_string($editora)) && !$erro){
    $erro = 'O campo "Editora" contém valores não válidos';
}

if((! isset($ano) || !is_numeric($ano)) && !$erro){
    $erro = 'O campo "Ano de lançamento" só aceita números';
}

if((! isset($local) || !is_string($local)) && !$erro){
    $erro = 'O campo "Local de Lançamento" contém valores não válidos';
}

if((! isset($num_paginas) || !is_numeric($num_paginas)) && !$erro){
    $erro = 'O campo "Número de páginas" só aceita números';
}

if((! isset($descricao) || !is_string($descricao)) && !$erro){
    $erro = 'O campo "Descrição" contém valores não válidos';
}


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-book fa-fw"></i> Área Livros</h1>
            <div class='content table-responsive'>
                <form action="?act=save&id=" method="POST" name="form1">
                    <input type="hidden" name="id" value="<?php
                    echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                    ?>"/>
                    Título:
                    <input class="form-control" type="text" name="titulo" maxlength="100" required value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($titulo) && ($titulo != null || $titulo != "")) ? $titulo: '';
                    ?>"/>
                    <br/>
                    Autor:
                    <input class="form-control" type="text" maxlength="100" name="autor" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($autor) && ($autor != null || $autor != "")) ? $autor : '';
                    ?>"/>
                    <br/>
                    Tradutor(a):
                    <input class="form-control" type="text" maxlength="100" name="tradutor" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($tradutor) && ($tradutor != null || $tradutor != "")) ? $tradutor : '';
                    ?>"/>
                    <br/>
                    ISBN:
                    <input class="form-control" type="text" maxlength="13" name="isbn" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($isbn) && ($isbn != null || $isbn != "")) ? $isbn : '';
                    ?>"/>
                    <br/>
                    Editora:
                    <input class="form-control" type="text" maxlength="100" name="editora" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($editora) && ($editora != null || $editora != "")) ? $editora : '';
                    ?>"/>
                    <br/>
                    Ano de Lançamento:
                    <input class="form-control" type="text" name="ano" maxlength="4" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($ano) && ($ano != null || $ano != "")) ? $ano : '';
                    ?>"/>
                    <br/>
                    Local de Lançamento:
                    <input class="form-control" type="text" maxlength="100" name="local" required placeholder="Forneça cidade, estado e país ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($tipo) && ($tipo != null || $tipo != "")) ? $tipo : '';
                    ?>"/>
                    <br/>
                    Número de Páginas:
                    <input class="form-control" type="numeric" name="num_paginas" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($num_paginas) && ($num_paginas != null || $num_paginas != "")) ? $num_paginas : '';
                    ?>"/>
                    <br/>
                    Descrição:
                    <input class="form-control" type="text" maxlength="200" name="descricao" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($descricao) && ($descricao != null || $descricao != "")) ? $descricao : '';
                    ?>"/>
                    <br/>
                    Categoria:
                    <select class="form-control" required name="categoria_idCategoria">
                        <?php
                        $query = "SELECT * FROM categoria order by nome;";
                        $statement = $pdo->prepare($query);
                        if ($statement->execute()) {
                            $result = $statement->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result as $rs) {
                                if ($rs->idCategoria == $categoria_idCategoria) {
                                    echo "<option value='$rs->idCategoria' selected>$rs->nome</option>";
                                } else {
                                    echo "<option value='$rs->idCategoria'>$rs->nome</option>";
                                }
                            }
                        } else {
                            throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
                        }
                        ?>
                    </select>
                    <br/>
                    <input class="btn btn-success" type="submit" value="Gravar">
                    <hr>
                </form>
                <?php
                echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                //chamada a paginação
                $object->tabelapaginada();
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
