<?php require 'pages/header.php';?>
<?php require 'classes/categorias.class.php';?>
<?php require 'classes/anuncios.class.php';?>
<?php 

$anuncio = new Anuncios();

if(empty($_SESSION['cLogin'])) {

    ?>

        <script>
        
            window.location.href="login.php";
        
        </script>
    <?php

    exit;

}

if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);
    if(isset($_FILES['fotos'])) {

        $fotos = $_FILES['fotos'];

    } else {

        $fotos = array();
    }
    

    $anuncio->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);

    
?>
    <div class="alert alert-success">
        Produto editado com sucesso!
    </div>
<?php
}

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $info = $anuncio->getAnuncio($_GET['id']);
    }else{

        ?>
        <script type="text/javascript">
            window.location.href=".meus-anuncios.php";
        </script>
<?php
    exit;
    
}

    
?>
<div class="container">
    <h1>Meus Anúncios - Editar Anúncio</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php
                    $categoria = new Categorias();
                    $categorias = $categoria->getLista();
                    foreach($categorias as $categoria) :
                ?>
                    <option value="<?php echo $categoria['id'];?>" <?php echo $info['id_categoria'] == $categoria['id'] ? 'selected="selected"': '';?>><?php echo utf8_encode($categoria['nome']);?></option>
                <?php
                    endforeach;
                ?>
            </select>
        </div> 
        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo'];?>">
        </div>   
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $info['valor'];?>">
        </div>   
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control"><?php echo $info['descricao'];?></textarea>
        </div>   
        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?php echo $info['estado'] == 0 ? 'selected="selected"': '';?>>Ruim</option>
                <option value="1" <?php echo $info['estado'] == 1 ? 'selected="selected"': '';?>>Bom</option>
                <option value="2" <?php echo $info['estado'] == 2 ? 'selected="selected"': '';?>>Ótimo</option>
            </select>
        </div>  
        
        <div class="form-group">
            <label for="add-foto">Fotos do anúncio:</label><br>
            <input type="file" name="fotos[]" multiple>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Fotos do Anúncio
            </div>
            <div class="panel-body">
                    <?php foreach($info['fotos'] as $foto) : ?>
                        <div class="foto_item">
                            <img src="assets/images/anuncios/<?php echo $foto['url'];?>" alt="" class="img-thumbnail" border=""><br>
                            <a href="excluir-foto.php?id=<?php echo $foto['id'];?>" class="btn btn-default">Excluir Imagem</a>
                        </div>
                    <?php endforeach;?>

            </div> 
        </div>

                    
        <input type="submit" value="Salvar" class="btn btn-default">

    </form>
</div>

<?php require 'pages/footer.php';?>