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
        $result = $objBD->buscar_agenda($_GET['id']);
    }
    if (!empty($_POST)) {

        if (empty($_POST['id'])) {
            $objBD->inserir_agenda($_POST);
        } else {
            $objBD->atualizar_agenda($_POST);
        }
        header("Location: ./AgendaList.php");
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
    <h1>Cadastro de Agenda</h1>
    <div class="container" style="display:flex; justify-content:center">
        <div class="col-md-7 col-lg-8">
            <form action="./AgendaForm.php" method="post">
                <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : "" ?>" />
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" name="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo !empty($result->titulo) ? $result->titulo : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" name="titulo" class="form-label">Local da Reunião</label>
                        <input type="text" name="local_reuniao" class="form-control" value="<?php echo !empty($result->local_reuniao) ? $result->local_reuniao : "" ?>">
                    </div>
                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Data do Início</label>
                        <input type="date" name="data_inicio" class="form-control" value="<?php echo !empty($result->sobrenome) ? $result->sobrenome : "" ?>">
                    </div>
                    <div class="col-3">
                        <label for="email" class="form-label">Hora do Início</label>
                        <input type="time" name="hora_inicio" class="form-control" value="<?php echo !empty($result->email) ? $result->email : "" ?>">
                    </div>
                    <div class="col-sm-3">
                        <label for="lastName" class="form-label">Data do Fim</label>
                        <input type="date" name="data_fim" class="form-control" value="<?php echo !empty($result->sobrenome) ? $result->sobrenome : "" ?>">
                    </div>
                    <div class="col-3">
                        <label for="email" class="form-label">Hora do Fim</label>
                        <input type="time" name="hora_fim" class="form-control" value="<?php echo !empty($result->email) ? $result->email : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Local da Reunião</label>
                        <input type="text" name="local_reuniao" class="form-control" value="<?php echo !empty($result->local_reuniao) ? $result->local_reuniao : "" ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" value="<?php echo !empty($result->descricao) ? $result->descricao : "" ?>">
                    </div>

                    <?php
                    echo " <div class='col-sm-6'>
                            <label for='firstName' class='form-label'>Convidado</label>
                            <select class='form-select' name='convidado_id' aria-label='Default select example'>";
                    $objBD = new BD();
                    $objBD->connection();
                    $convidado = $objBD->buscar_convidado();
                    foreach ($convidado as $item) {
                        echo "<option value=" . $item['id'] . ">" . $item['nome'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                    <input type="submit" />
                    </select>
                </div>
        </div>
        </form>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>