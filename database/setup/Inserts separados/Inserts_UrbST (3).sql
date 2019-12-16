INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Levante', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Valencia'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'New Orleans', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Lousiana'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'San Diego', (
	SELECT id FROM sjl_ciudades WHERE nom = 'California'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Calama', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Antofagasta'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Lafayette', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Lousiana'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Lake Charles', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Lousiana'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Yosemite', (
	SELECT id FROM sjl_ciudades WHERE nom = 'California'
));

INSERT INTO sjl_urbanizaciones(id, nom, id_ciudad)
	VALUES (nextval('id_urbanizacion'), 'Austin', (
	SELECT id FROM sjl_ciudades WHERE nom = 'Texas'
));

/* STREETS */

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Audobon', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'New Orleans'
));


INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Dixon', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'New Orleans'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Paris', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'New Orleans'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Palmer park', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'New Orleans'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Paradise hills', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'San Diego'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Chula vista', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'San Diego'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'San carlos', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'San Diego'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Almeria', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'Levante'
));

INSERT INTO sjl_calles(id, nom, id_urb)
	VALUES (nextval('id_calle'), 'Murcia', (
	SELECT id FROM sjl_urbanizaciones WHERE nom = 'Levante'
));