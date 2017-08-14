CREATE TABLE usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  usuario varchar(50) NOT NULL,
  senha varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO usuario VALUES (1, 'admin', ''); -- senha em md5

CREATE TABLE cliente (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(150) NOT NULL,
  nome_secundario varchar(150) DEFAULT NULL,
  endereco varchar(200) DEFAULT NULL,
  bairro varchar(50) NOT NULL,
  telefone varchar(11) NOT NULL,
  telefone2 varchar(11) DEFAULT NULL,
  telefone3 varchar(11) DEFAULT NULL,
  telefone4 varchar(11) DEFAULT NULL,
  telefone5 varchar(11) DEFAULT NULL,
  observacao text,
  saldo_devedor double NOT NULL DEFAULT '0',
  cliente int(11) DEFAULT NULL,
  usuario int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY cliente(cliente),
  KEY usuario(usuario)
);

CREATE TABLE animal (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  especie varchar(50) NOT NULL,
  raca varchar(50) NOT NULL,
  pelo varchar(50) NOT NULL,
  pelagem varchar(50) NOT NULL,
  porte varchar(50) NOT NULL,
  peso float NOT NULL DEFAULT '0',
  nascimento date DEFAULT NULL,
  cadastro date NOT NULL,
  castrado tinyint(1) NOT NULL DEFAULT '0',
  observacoes text,
  sexo char(1) NOT NULL,
  usuario int(11) NOT NULL,
  cliente_pacote tinyint(1) NOT NULL DEFAULT '0',
  cliente int(11) DEFAULT NULL,
  PRIMARY KEY(id),
  KEY cliente(cliente)
);