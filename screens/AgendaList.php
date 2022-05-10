<?php
include "../database/bd.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="../style.css" rel="stylesheet">
    <title>Listagem</title>
</head>

<body>
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
    <h1 class="title">Listagem da Agenda</h1>
    <form class="row gx-3 gy-2 align-items-center" method="POST" action="AgendaList.php">
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">Name</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Pesquisar">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeSelect">Preference</label>
            <select class="form-select" id="opcoes" name="opcoes">
                <option selected value="titulo">Tipo</option>
                <option value="titulo">Titulo</option>
                <option value="localizacao">Local</option>
                <option value="convidado_id">Convidado</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-success"> <i class="fa-solid fa-magnifying-glass plus"></i>Buscar</button>
            <a type="button" class="btn btn-primary" href="AgendaForm.php"> <i class="fa-solid fa-plus plus"></i>Cadastrar</a>
        </div>
    </form>
    <?php
    $objBD = new BD();
    $objBD->connection();

    if (!empty($_POST['nome'])) {
        $result = $objBD->pesquisar_agenda($_POST);
    } else {
        $result = $objBD->select_agenda();
    }

    if (!empty($_GET['id'])) {
        $objBD->remover_agenda($_GET['id']);
        header("location: AgendaList.php");
    }

    echo "<table class='table table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Data do Início</th>
                    <th>Hora do Início</th>
                    <th>Data do Fim</th>
                    <th>Hora do Fim</th>
                    <th>Local da Reunião</th>
                    <th>Descrição</th>
                    <th>Convidado</th>
                    <th>Ação</th>
                    <th>Ação</th>
                </tr>
            ";
    foreach ($result as $item) {
        echo "
        <tr>
                    <th>" . $item['id'] . "</th>
                    <th>" . $item['titulo'] . "</th>
                    <th>" . $item['data_inicio'] . "</th>
                    <th>" . $item['hora_fim'] . "</th>
                    <th>" . $item['data_fim'] . "</th>
                    <th>" . $item['hora_fim'] . "</th>
                    <th>" . $item['local_reuniao'] . "</th>
                    <th>" . $item['descricao'] . "</th>
                    <th>" . $item['convidado_id'] . "</th>
                    <td>
                        <a href='./AgendaForm.php?id=" . $item['id'] . "'>Editar</a>
                    </td>
                    <td>
                        <a href='./AgendaList.php?id=" . $item['id'] . "'
                        onclick=\"return confirm('Deseja realmente remover o registro?') \" >Deletar</a>
                    </td>
        </tr>";
    }
    echo "</table>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>