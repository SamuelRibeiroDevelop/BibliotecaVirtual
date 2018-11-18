<?php

require_once "classes/template.php";

$template = new template();

$template->head();
$template->navbartop();
$template->sidebar();
?>


<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-sign-in fa-fw"></i><b> Fazer Logon no Sistema</b></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="logon.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Login" name="login" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <a href="index.html" class="btn btn-lg btn-success btn-block">Entrar</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
$template->footer();
?>