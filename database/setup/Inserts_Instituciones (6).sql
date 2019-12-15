INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('One Zillion Cats', 'B', (
        SELECT id from sjl_ciudades WHERE nom = 'Zagreb'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES ('Taking Back Spring', 'U', (
        SELECT id from sjl_ciudades WHERE nom = 'Berlin'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES ('Les Stat', 'E', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES ('Doomshop', 'B', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	id, nom, tipo, id_ciudad)
	VALUES ('John Tracy', 'E', (
        SELECT id from sjl_ciudades WHERE nom = 'Tirana'
    ));