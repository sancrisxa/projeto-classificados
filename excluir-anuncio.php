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

    $anuncios->excluirAnuncio($_GET['id']);

}

header("Location: meus-anuncios.php");