<?php require 'pages/header.php';?>
<?php 

    if(empty($_SESSION['cLogin'])) {

        ?>

            <script>
            
                window.location.href="login.php";
            
            </script>
        <?php

        exit;

    }

?>
    <h1>Meus Anúncios</h1>
    <a href="add-anuncio.php" class="btn btn-default">Adicionar Anúncio</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
            require 'classes/anuncios.class.php';

            $anuncios = new Anuncios();
            $anuncios = $anuncios->getMeusAnuncios();
            
            foreach ($anuncios as $anuncio) :    
        ?>
            <tr>
               <td>
                   <img src="assets/images/anuncios/<?php echo $anuncio['url'];?>" alt="" border="0">
               </td> 
               <td>
                   <?php echo $anuncio['titulo'];?>
               </td>
               <td>
                   R$ <?php echo number_format($anuncio['valor'], 2)?>
               </td>
               <td></td>
            </tr>
        <?php endforeach;?>
    </table>

<?php require 'pages/footer.php';?>

