<?php

require 'config.php';
require 'classes/anuncios.class.php';

if(empty($_SESSION['cLogin'])) {

    ?>

        <script>
        
            window.location.href="login.php";
        
        </script>
    <?php

    exit;

}

$anuncios = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $id_anuncio = $anuncios->excluirFoto($_GET['id']);

}

if(isset($id_anuncio)) {

    header("Location: editar-anuncios.php" . $id_anuncio);
}

header("Location: meus-anuncios.php");