<?php require 'pages/header.php';?>
    <div class="container">
        <h1>Login</h1>
        <?php 
        
            require 'classes/usuarios.class.php';

            $usuario = new Usuarios();

            

            if(isset($_POST['email']) && !empty($_POST['email'])) {
                
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);

                if($usuario->login($email, $senha)) {

                    ?>

                      <script>
                      
                        window.location.href="./";
                      
                      </script>  

                    <?php

                } else {


                    ?>

                    <div class="alert alert-danger">
                        Usuário e/ou Senha errados!
                    </div>

                <?php 
                }
                

            }
        
        
        ?>
        <form method="post" action="">

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control">
            </div>
 
            <input type="submit" value="Fazer login" class="btn btn-default">

        </form>
    </div>
<?php require 'pages/footer.php';?>