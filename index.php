<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Login </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="assets/css/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="w-100 p-3"> 
            <div class="card col-lg-3 col-md-6 col-sm-11 bg-white p-3"> 
                <h3 class="text-center"> LOGIN </h3>
                <div class="card-body border-top border-bottom"> 
                    <form action="config/login.php" method="POST">
                        <?php 
                        session_start();
                        if(isset($_SESSION['mensagem'])){
                         $msg = $_SESSION['mensagem'];
                         $alert = $_SESSION['alert'];
                         
                         echo "<div class='alert alert-$alert text-center'> $msg </div>";
                        }
                            
                        session_destroy();
                        ?>
                        
                        <div class="mt-2"> 
                            <label for="login"> Login </label>
                            <input class='form-control' type="text" name="login" id="login" placeholder="Login de acesso" required>
                        </div>
                        <div class="mt-2"> 
                            <label for="senha"> Senha </label>
                            <input class='form-control' type="password" name="senha" id="senha" placeholder="Senha de acesso" required>
                        </div>
                        
                        <div class="mt-3"> 
                            <button class="btn btn-primary float-end"> Entrar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>