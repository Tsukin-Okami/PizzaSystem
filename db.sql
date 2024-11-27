CREATE DATABASE pizzaria;

USE pizzaria;

CREATE TABLE clientes(
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    telefone VARCHAR(20),
    endereco VARCHAR(255)
);

CREATE TABLE pizzas(
    id_pizza INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50),
    tamanho VARCHAR(20)
);

CREATE TABLE ingredientes(
    id_ingrediente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50)
);