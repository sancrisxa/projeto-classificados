<?php require 'pages/header.php';?>
<?php 

    require 'classes/anuncios.class.php';
    require 'classes/usuarios.class.php';
    
    $anuncio = new Anuncios();
    $usuario = new Usuarios();
    
    $total_anuncios = $anuncio->getTotalAnuncios();
    $total_usuarios = $usuario->getTotalUsuarios();

    $p = 1;

    $por_pagina = 2;

    $total_paginas = ceil($total_anuncios / $por_pagina);

    if(isset($_GET['p']) && !empty($_GET['p'])) {

        $p = addslashes($_GET['p']);
    }

    $anuncios = $anuncio->getUltimosAnuncios($p, $por_pagina);

    
    
?>

<div class="container-fluid">
    <div class="jumbotron">
        <h2>Nós temos hoje <?php echo $total_anuncios;?> anúncios.</h2>
        <p>E mais de <?php echo $total_usuarios;?> usuários cadastrados.</p>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <h4>Pesquisa Avançada.</h4>
        </div>
        <div class="col-sm-9">
            <h4>Últimos anúncios.</h4>
            <table class="table table-striped">
                <tbody>
                    <?php foreach($anuncios as $anuncio) :?>
                        <tr>
                            <td>
                                <?php if(!empty($anuncio['url'])) : ?>
                                    <img src="assets/images/anuncios/<?php echo $anuncio['url'];?>" alt="" border="0" height="50">
                                <?php else:?>
                                    <img src="assets/images/default.png" alt="" border="0" height="50">  
                                <?php endif;?>
                            </td>
                            <td>
                                <a href="produto.php?id=<?php echo $anuncio['id'];?>"><?php echo $anuncio['titulo'];?></a><br>
                                <?php echo utf8_encode($anuncio['categoria']);?>
                            </td>
                            <td>
                                R$ <?php echo number_format($anuncio['valor'], 2)?> 
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for($q = 1; $q <= $total_paginas; $q++) : ?>
                    <li class="<?php echo ($p == $q) ? 'active' : '';?>">
                        <a href="index.php?p=<?php echo $q?>"><?php echo $q;?></a>
                    </li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
</div> 

<?php require 'pages/footer.php';?>