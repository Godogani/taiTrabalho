CREATE TABLE contato(
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(128),
    sobrenome VARCHAR(128),
    telefone1 VARCHAR(15),
    tipo_telefone1 VARCHAR(9),
    telefone2 VARCHAR(15),
    tipo_telefone2 VARCHAR(9),
    email VARCHAR(128)
);
CREATE TABLE agenda(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(32),
    data_inicio DATE,
    hora_inicio TIME,
    data_fim DATE,
    hora_fim TIME,
    local_reuniao VARCHAR(64),
    descricao VARCHAR(200),
    convidado_id integer,
    FOREIGN KEY (convidado_id) REFERENCES contato(id)
);