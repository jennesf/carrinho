CREATE DATABASE suamedida;

use suamedida;

create table usuarios (
 id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


select * from usuarios;


SHOW COLUMNS FROM usuarios;

delete from usuarios;


CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT, 
    tipo VARCHAR(45) NOT NULL, 
    nome VARCHAR(45) NOT NULL, 
    imagem VARCHAR(80) NOT NULL, 
    preco DECIMAL (5,2) NOT NULL, 
PRIMARY KEY (id));

select * from produtos;


INSERT INTO produtos (tipo, nome, imagem, preco) VALUES ('roupa', 'cropped branco', '../img/roupa1.jpeg',  50.00);
INSERT INTO produtos (tipo, nome, imagem, preco) VALUES ('roupa', 'cropped listrado', '../img/roupa2.jpeg', 50.00);
INSERT INTO produtos (tipo, nome, imagem, preco) VALUES ('roupa', 'regata preta', '../img/roupa3.jpeg', 50.00);


select * from produtos;


delete from produtos where id=1;

update produtos set id=1  where nome = 'cropped branco';



select * from usuarios;

alter table usuarios add perfil varchar(50) default(0);
update usuarios set perfil = 'admin' where email = 'abc@ifsp.edu.br';

