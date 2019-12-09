INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES (nextval('id_inst'), 'One Zillion Cats', 'B', (
        SELECT id from sjl_ciudades WHERE nom = 'Zagreb'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES (nextval('id_inst'), 'Taking Back Spring', 'U', (
        SELECT id from sjl_ciudades WHERE nom = 'Berlin'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES (nextval('id_inst'), 'Les Stat', 'E', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES (nextval('id_inst'), 'Doomshop', 'B', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES (nextval('id_inst'), 'John Tracy', 'E', (
        SELECT id from sjl_ciudades WHERE nom = 'Tirana'
    ));