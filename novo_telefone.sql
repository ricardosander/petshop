
set foreign_key_checks = 0;

create table telefone(
  id int primary key auto_increment,
  cliente int not null,
  ddd char(2) not null,
  numero char(9) not null,
  nome varchar(50),
  CONSTRAINT telefone_cliente FOREIGN KEY (cliente) REFERENCES cliente(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

insert into telefone (cliente, ddd, numero) select id, substr(telefone, 1, 2), substr(telefone, 3, 11) from cliente where telefone is not null and telefone <> '';
insert into telefone (cliente, ddd, numero) select id, substr(telefone2, 1, 2), substr(telefone, 3, 11) from cliente where telefone2 is not null and telefone2 <> '';
insert into telefone (cliente, ddd, numero) select id, substr(telefone3, 1, 2), substr(telefone3, 3, 11) from cliente where telefone3 is not null and telefone3 <> '';
insert into telefone (cliente, ddd, numero) select id, substr(telefone4, 1, 2), substr(telefone4, 3, 11) from cliente where telefone4 is not null and telefone4 <> '';
insert into telefone (cliente, ddd, numero) select id, substr(telefone5, 1, 2), substr(telefone5, 3, 11) from cliente where telefone5 is not null and telefone5 <> '';

# set foreign_key_checks = 1;