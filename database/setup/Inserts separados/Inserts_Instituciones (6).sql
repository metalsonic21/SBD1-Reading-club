INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('One Zillion Cats', 'A', (
        SELECT id from sjl_ciudades WHERE nom = 'Zagreb'
    ));

INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('Taking Back Spring', 'E', (
        SELECT id from sjl_ciudades WHERE nom = 'Berlin'
    ));

INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('Les Stat', 'OT', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('Doomshop', 'O', (
        SELECT id from sjl_ciudades WHERE nom = 'California'
    ));

INSERT INTO sjl_instituciones(
	nom, tipo, id_ciudad)
	VALUES ('John Tracy', 'A', (
        SELECT id from sjl_ciudades WHERE nom = 'Tirana'
    ));