CREATE DATABASE pizzaria;

USE pizzaria;

CREATE TABLE clientes(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco TEXT NOT NULL
);

CREATE TABLE pedidos(
    id INT(11) PRIMARY KEY,
    cliente_id INT(11) NOT NULL,
    sabor_pizza VARCHAR(100) NOT NULL, -- redundancia
    quantidade_pizza INT(11) NOT NULL,
    observacao TEXT DEFAULT NULL,
    status VARCHAR(20) DEFAULT "a fazer",

    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE pizzas(
    id INT(11) PRIMARY KEY,
    sabor_pizza VARCHAR(255) NOT NULL
);