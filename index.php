<?php

require_once "classes/template.php";

$template = new template();

$template->head();
$template->navbartop();
$template->sidebar();
$logado = $_SESSION["name"];
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-home fa-fw"></i> Página Inicial</h1>
                <div class="panel-body">
                    <h1 style="text-align: center">Gerenciador Virtual de Bibliotecas</h1>
                    <br>
                    <h3 style="text-align: center"> Bem-vindo <?=$logado;?> </h3>
                    <?=$template->bodypage();?>
                </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
