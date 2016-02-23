<?php
$title = "PROJETOS | ACELERADORA DE PESSOAS";
$debug = false; // Liga as saídas para ajudar o debug
$header_script = '  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:\'textarea\' });</script>';


if (isset($_FILES['userfile'])) { // faz as verificações de segurança para arquivos uploadados, caso tenham subido uma imagem.
    if ($_FILES['userfile']['error'] > 0) {
        die('An error ocurred when uploading.');
    }

    if (!getimagesize($_FILES['userfile']['tmp_name'])) {
        die('Please ensure you are uploading an image.');
    }

// Acha o próximo arquivo vazio
    $file_name = $_FILES['userfile']['name'];
    $uploaddir = '/home/aceleradoradepes/public_html/projetosAP/img/upload/';

    if (file_exists($uploaddir . $file_name)) { // verifica se tem um arquivo com o nome
        $t = 1;
        $path_parts = pathinfo($uploaddir . $file_name);
        while (file_exists($uploaddir . $path_parts['filename'] . "_" . $t . "." . $path_parts['extension'])) { // se não tem arquivo, coloca um _1, _2 e testa...
            $t++;
        }
        $file_name = $path_parts['filename'] . "_" . $t . "." . $path_parts['extension'];
    }

// Upload file

    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $file_name)) {
        die('Error uploading file - check destination is writeable.');
    }
}

require_once "db.php";

$Cod = db_quote($_GET['Cod']);



if ($_GET['Edit'] == "true") {
    $edit = true;
} else {
    $edit = false;
} // se chamado o link editarprojeto, a variável $edit true, para mostrar form de edição ao invés do projeto

$query = "SELECT * FROM  `Projetos` WHERE  `Nome_link` =$Cod"; // Busca informações do projeto do BD
$result = db_select_single_row($query);

$permissão = true; // Ainda não implementado, verifica se a pessoa tem permissão de alterar este projeto (adm podem alterar todos, cada um pode alterar o seu).
// Precisa ser feito depois do SSO

if (!$permissão and $edit) { // verifica se a pessoa está editando e tem permissões
    die("Sem permissão para editar este projeto");
}


if ($debug) {
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    echo "<pre>";
    print_r($_FILES);
    print "</pre>";
}

if ($result === false) {
    die("erro na consulta");
}

if (!isset($result[ID])) {
    die("este projeto não existe");
}



require_once "header.php";

$percent = ($result[Valor_financiado] / $result[Valor]) * 100; // Calcula o % financiado do projeto
?>
<div class="container marketing" style="padding-top: 90px;">






    <div id="main_wrapper" class="projeto">
        <?php if ($edit) { ?>
            <form enctype="multipart/form-data" action="#" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <div id="imgProj">
                    <table border="0"><tr><td>
                                <img id="kid" src="/img/upload/<?php echo $result[Imagem]; ?>" alt="<?php echo $result[Alt_img]; ?>"> </td></tr><tr><td>

                                Trocar imagem: <input name="userfile" type="file" />    </td></tr></table>

                </div>
            <?php } else { ?>
                <div id="imgProj">
                    <img id="kid" src="/img/upload/<?php echo $result[Imagem]; ?>" alt="<?php echo $result[Alt_img]; ?>">
                </div>

            <?php } ?>

            <div id="sobreProj">
                <h2><?php if ($edit) { ?>

                        <input type="text" name="Nome" value="<?php echo htmlentities($result[Nome]); ?>" size="50" />
                        <?php
                    } else {
                        echo htmlentities($result[Nome]);
                    }
                    ?></h2>

                <?php if ($edit) { ?>

                    <textarea name="Descricao" /><?php echo $result[Descricao]; ?></textarea>
                    <?php
                } else {
                    echo $result[Descricao];
                }
                ?>


            </div>
    </div>

    <div id="progresso">
        <div id="barProj1" class="bar">
            <img id="mask" src="/img/bar-mask.svg" alt="">
            <!-- aqui vai a barra. fundo de marcação -->
            <div id="barra" style="width: 
            <?php
            if ($edit) {
                echo 0;
            } else {
                if ($percent > 100) {
                    echo 100;
                } else {
                    echo percent;
                };
            }
            ?>%" >
            </div>
            <div id="fundo">
            </div>
            <!-- fim da barra -->  
        </div>

        <div id="numProj">
            <table class="dadosProj">
                <tr id="numeros">
                    <td>R$ <?php
                        if ($edit) {
                            echo 0;
                        } else {
                            echo $result[Valor] / 100;
                        }
                        ?></td>
                    <td><?php
                        if ($edit) {
                            echo 0;
                        } else {
                            echo $percent;
                        }
                        ?>%</td> 
                    <td><?php
                        if ($edit) {
                            echo 0;
                        } else {
                            echo ($result[N_Apoiadores]);
                        }
                        ?></td>
                </tr>
                <tr id="relative">
                    <td>meta</td>
                    <td>conquistado</td> 
                    <td>apoiadores</td>
                </tr>
            </table>

            <?php if ($edit) { ?>
                <input type="submit" value="Editar Projeto" />
                </form>
            <?php } else { ?>
                <a href="/doar/projeto/<?php echo $result[Nome_link]; ?>" class="myButton">SEJA APOIADOR</a>
            <?php } ?>
        </div>

    </div>

</div>


<?php require "footer.php"; ?>