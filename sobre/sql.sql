CREATE SCHEMA produtos_mercado;
USE produtos_mercado;

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

insert into usuario values (null, 'Administrador', 'admin', '$2y$10$vAT26RQedmtDF1OAGpFIjuQaVkG0yK.UPkWDc/chmorFapN70oKqa', 's');
insert into usuario values (null, 'Professor(a)', 'prof', '$2y$10$5j0YwFKYntEuPlGZgEl4s.wMpRJZyV7gKBpfRD3.5nsM1CnnUyOTO', 's');