CREATE SCHEMA produtos_mercado_herrison;
USE produtos_mercado_herrison;

CREATE TABLE usuario (
id int auto_increment PRIMARY KEY,
nome varchar(255),
login varchar(255) not null,
senha varchar(255) not null,
primeiro_acesso enum('s','n') default 's'
);

CREATE TABLE produto (
id int auto_increment PRIMARY KEY,
nome varchar(255),
marca varchar(255),
tamanho varchar(255),
created_at datetime DEFAULT CURRENT_TIMESTAMP,
updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE estabelecimento (
id int auto_increment PRIMARY KEY,
nome_fantasia varchar(255),
total_lojas int,
cep int,
estado varchar(255),
cidade varchar(255),
bairro varchar(255),
logradouro varchar(255),
numero varchar(255),
created_at datetime DEFAULT CURRENT_TIMESTAMP,
updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE produto_estabelecimento (
id int auto_increment PRIMARY KEY,
produto int,
estabelecimento int,
valor decimal(11,2),
created_at datetime DEFAULT CURRENT_TIMESTAMP,
updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY(produto) REFERENCES produto (id),
FOREIGN KEY(estabelecimento) REFERENCES estabelecimento (id)
);

-- INSERINDO USUARIOS
insert into usuario values (null, 'Administrador', 'admin', '$2y$10$vAT26RQedmtDF1OAGpFIjuQaVkG0yK.UPkWDc/chmorFapN70oKqa', 's');
insert into usuario values (null, 'Professor(a)', 'prof', '$2y$10$5j0YwFKYntEuPlGZgEl4s.wMpRJZyV7gKBpfRD3.5nsM1CnnUyOTO', 's');

-- ISERINDO PRODUTOS
insert into produto (nome, marca, tamanho) values ('Refrigerante', 'Coca-cola', '2L');
insert into produto (nome, marca, tamanho) values ('Refrigerante', 'Pepsi', '2L');
insert into produto (nome, marca, tamanho) values ('Refrigerante', 'H2O', '2L');
insert into produto (nome, marca, tamanho) values ('Computador', 'Dell', '40cm');
insert into produto (nome, marca, tamanho) values ('Monitor', 'Dell', '24POL');
insert into produto (nome, marca, tamanho) values ('Monitor', 'AOC', '27POL');
insert into produto (nome, marca, tamanho) values ('Celular', 'Samsumg', '4POL');
insert into produto (nome, marca, tamanho) values ('Teclado', 'Dell', '40cm');
insert into produto (nome, marca, tamanho) values ('Mouse', 'Microsoft', '7cm');
insert into produto (nome, marca, tamanho) values ('Mouse', 'Lenovo', '7cm');
insert into produto (nome, marca, tamanho) values ('Mochila', 'Bagag', '5L');
insert into produto (nome, marca, tamanho) values ('Galão de água', 'Walter White', '15L');

-- INSERINDO ESTABELECIMENTOS
insert into estabelecimento (nome_fantasia, total_lojas, cep, estado, cidade, bairro) values ('Agile Corp', 1, 25245570, 'RJ', 'Duque de Caxias', 'Xerem');
insert into estabelecimento (nome_fantasia, total_lojas, cep, estado, cidade, bairro) values ('Comercial Milano Brasil', 1, 25245070, 'RJ', 'Duque de Caxias', 'Figueira');
insert into estabelecimento (nome_fantasia, total_lojas, cep, estado, cidade, bairro) values ('Frescatto', 1, 25245130, 'RJ', 'Duque de Caxias', 'Figueira');
insert into estabelecimento (nome_fantasia, total_lojas, cep, estado, cidade, bairro) values ('Leo Madeiras', 1, 25050501, 'RJ', 'Duque de Caxias', 'Jardim Gramacho');