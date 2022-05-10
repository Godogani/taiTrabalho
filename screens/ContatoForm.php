<?php
include "../database/bd.php"
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <title>SisAgenda</title>
</head>


<body>
    <?php
    $objBD = new BD();
    $objBD->connection();

    if (!empty($_GET['id'])) {
        $result = $objBD->buscar_contato($_GET['id']);
    }
    if (!empty($_POST)) {

        if (empty($_POST['id'])) {
            $objBD->inserir_contato($_POST);
        } else {
            $objBD->atualizar_contato($_POST);
        }
        header("Location: ./ContatoList.php");
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SisAgenda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TAI_2022-main/screens/AgendaList.php">Minha Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TAI_2022-main/screens/ContatoList.php">Meus Contatos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Cadastro de Contato</h1>
    <div class="container" style="display:flex; justify-content:center">
        <div class="col-md-7 col-lg-8">
            <form action="./ContatoForm.php" method="post">
                <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : "" ?>" />
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Sobrenome</label>
                        <input type="text" name="sobrenome" class="form-control" value="<?php echo !empty($result->sobrenome) ? $result->sobrenome : "" ?>">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo !empty($result->email) ? $result->email : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="address" class="form-label">Telefone 1</label>
                        <input type="text" name="telefone1" class="form-control" value="<?php echo !empty($result->telefone1) ? $result->telefone1 : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="address" class="form-label">Tipo do Telefone 1</label>
                        <select class="form-select" name="tipo_telefone1" aria-label="Default select example">
                            <option></option>
                            <option value="Casa">Casa</option>
                            <option value="Celular">Celular</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Principal">Principal</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="address" class="form-label">Telefone 2</label>
                        <input type="text" name="telefone2" class="form-control" value="<?php echo !empty($result->telefone2) ? $result->telefone2 : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="address" class="form-label">Tipo do Telefone 2</label>
                        <select class="form-select" name="tipo_telefone2" aria-label="Default select example">
                            <option></option>
                            <option value="Casa">Casa</option>
                            <option value="Celular">Celular</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Principal">Principal</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>