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
    <!--Navbar-->
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
    <h1 class="title">Listagem Clientes</h1>
    <form action="./ContatoList.php" method="post">
        <input type="search" name="nome" placeholder="Pesquisar nome">
        <input type="submit" value="Pesquisar">
    </form>
    <?php
    $objBD = new BD();
    $objBD->connection();

    if (!empty($_POST['nome'])) {
        $result = $objBD->pesquisar_contato($_POST);
    } else {
        $result = $objBD->select_contato();
    }

    if (!empty($_GET['id'])) {
        $objBD->remover_contato($_GET['id']);
        header("location: ContatoList.php");
    }

    echo "<table class='table table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Telefone 1</th>
                    <th>Tipo Telefone 1</th>
                    <th>Telefone 2</th>
                    <th>Tipo Telefone 2</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                    <th>Ação</th>
                </tr>
            ";
    foreach ($result as $item) {
        echo "
        <tr>
            <td>" . $item['id'] . "</td>
            <td>" . $item['nome'] . "</td>
            <td>" . $item['sobrenome'] . "</td>
            <td>" . $item['telefone1'] . "</td>
            <td>" . $item['tipo_telefone1'] . "</td>
            <td>" . $item['telefone2'] . "</td>
            <td>" . $item['tipo_telefone2'] . "</td>
            <td>" . $item['email'] . "</td>
            <td><a href='./ContatoForm.php?id=" . $item['id'] . "'>Editar</a></td>
            <td><a href='./ContatoList.php?id=" . $item['id'] . "'
                   onclick=\"return confirm('Deseja realmente remover o registro?') \" >Deletar</a></td>
        </tr>";
    }
    echo "</table>";
    ?>
</body>

</html>