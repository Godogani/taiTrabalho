<?php

class BD
{

    private $host = "localhost";
    private $dbname = "database";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "";
    private $db_charset = "utf8";

    public function connection()
    {
        $connection = "mysql:host=$this->host;
            dbname=$this->dbname;port=$this->port";

        return new PDO(
            $connection,
            $this->usuario,
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->db_charset]
        );
    }
    public function select_contato()
    {
        $connection = $this->connection();
        $st = $connection->prepare("SELECT * FROM contato");
        $st->execute();

        return $st;
    }

    public function inserir_contato($dados)
    {
        $connection = $this->connection();
        $sql = "INSERT INTO contato (
            nome, 
            sobrenome,
            telefone1,
            tipo_telefone1,
            telefone2,
            tipo_telefone2,
            email) 
            value (?, ?, ?, ?, ?, ?, ?)";

        $st = $connection->prepare($sql);
        $arrayDados = [
            $dados['nome'],
            $dados['sobrenome'],
            $dados['telefone1'],
            $dados['tipo_telefone1'],
            $dados['telefone2'],
            $dados['tipo_telefone2'],
            $dados['email']
        ];
        $st->execute($arrayDados);

        return $st;
    }

    public function atualizar_contato($dados)
    {
        $connection = $this->connection();
        $sql = "UPDATE contato SET nome = ?, 
                sobrenome = ?, 
                telefone1 = ?,
                tipo_telefone1 = ?, 
                telefone2 = ?, 
                tipo_telefone2 = ?,
                email = ? WHERE id = ?";

        $st = $connection->prepare($sql);
        $arrayDados = [
            $dados['nome'],
            $dados['sobrenome'],
            $dados['telefone1'],
            $dados['tipo_telefone1'],
            $dados['telefone2'],
            $dados['tipo_telefone2'],
            $dados['email'],
            $dados['id']
        ];
        $st->execute($arrayDados);

        return $st;
    }

    public function remover_contato($id)
    {
        $connection = $this->connection();
        $sql = "DELETE FROM contato WHERE id = ?";
        $st = $connection->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st;
    }

    public function buscar_contato($id)
    {
        $connection = $this->connection();
        $sql = "SELECT * FROM contato WHERE id = ?";
        $st = $connection->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st->fetchObject();
    }

    public function pesquisar_contato($dados)
    {
        $connection = $this->connection();
        $sql = "SELECT * FROM contato WHERE nome LIKE ?;";

        $st = $connection->prepare($sql);
        $arrayDados = ["%" . $dados["nome"] . "%"];
        $st->execute($arrayDados);

        return $st;
    }
    public function select_agenda()
    {
        $connection = $this->connection();
        $st = $connection->prepare("SELECT * FROM agenda");
        $st->execute();

        return $st;
    }

    public function inserir_agenda($dados)
    {
        $connection = $this->connection();

        $st = $connection->prepare("INSERT INTO agenda (
            titulo, 
            data_inicio, 
            hora_inicio, 
            data_fim, 
            hora_fim, 
            local_reuniao, 
            descricao, 
            convidado_id) 
            value (?, ?, ?, ?, ?, ?, ?, ?)");
        $arrayDados = [
            $dados['titulo'],
            $dados['data_inicio'],
            $dados['hora_inicio'],
            $dados['data_fim'],
            $dados['hora_fim'],
            $dados['local_reuniao'],
            $dados['descricao'],
            $dados['convidado_id']
        ];
        $st->execute($arrayDados);

        return $st;
    }

    public function atualizar_agenda($dados)
    {
        $id = $dados['id'];
        $sql = "UPDATE crudcontato SET ";
        $flag = 0;
        $arrayValor = [];
        foreach ($dados as $campo => $valor) {
            if ($flag == 0) {
                $sql .= "$campo = ?";
            } else {
                $sql .= ", $campo = ?";
            }
            $flag = 1;
            $arrayValor[] = $valor;
        }
        $sql .= "WHERE id = $id;";

        $conn = $this->connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($arrayValor);

        return $stmt;
    }

    public function remover_agenda($id)
    {
        $connection = $this->connection();
        $sql = "DELETE FROM agenda WHERE id = ?";

        $st = $connection->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st;
    }

    public function buscar_agenda($id)
    {
        $connection = $this->connection();
        $sql = "SELECT * FROM agenda WHERE id = ?";
        $st = $connection->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st->fetchObject();
    }


    public function buscar_convidado()
    {
        $connection = $this->connection();
        $st = $connection->prepare("SELECT id,nome FROM contato");
        $st->execute();

        return $st;
    }

    public function pesquisar_agenda($dados)
    {
        $connection = $this->connection();
        $sql = "SELECT * FROM agenda WHERE titulo LIKE ?;";

        $st = $connection->prepare($sql);
        $arrayDados = ["%" . $dados["titulo"] . "%"];
        $st->execute($arrayDados);

        return $st;
    }
    public function search($valor, $tipo)
    {
        $conn = $this->connection();
        $stmt = $conn->prepare("SELECT * FROM crudagenda WHERE $tipo LIKE '$valor';");
        $stmt->execute(["%" . $valor . "%"]);
        return $stmt;
    }
}
