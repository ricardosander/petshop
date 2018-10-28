create table cliente_bkp select * from cliente;

update cliente set telefone = concat(substring(telefone, 1,2), '9', substring(telefone, 3)) where telefone is not null and telefone <> '';
update cliente set telefone2 = concat(substring(telefone2, 1,2), '9', substring(telefone2, 3)) where telefone2 is not null and telefone2 <> '';
update cliente set telefone3 = concat(substring(telefone3, 1,2), '9', substring(telefone3, 3)) where telefone3 is not null and telefone3 <> '';
update cliente set telefone4 = concat(substring(telefone4, 1,2), '9', substring(telefone4, 3)) where telefone4 is not null and telefone4 <> '';
update cliente set telefone5 = concat(substring(telefone5, 1,2), '9', substring(telefone5, 3)) where telefone5 is not null and telefone5 <> '';