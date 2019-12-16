INSERT INTO sjl_clubes_lectura(
	nom, fec_crea, cuota, id_dir, id_idiom)
	VALUES ('Brandy Book Club', '08-07-2018', 100, (
        SELECT id from sjl_calles WHERE nom = 'Audobon'
    ), (
        SELECT id from sjl_idiomas WHERE nom = 'Arabe'
    ));

INSERT INTO sjl_clubes_lectura(
	nom, fec_crea, cuota, id_dir, id_idiom, id_inst)
	VALUES ('Snow Leopards', '11-30-2015', 0, (
        SELECT id from sjl_calles WHERE nom = 'Audobon'
    ), (
        SELECT id from sjl_idiomas WHERE nom = 'Arabe'
    ),(
        SELECT id from sjl_instituciones WHERE nom = 'Doomshop'
    ));

INSERT INTO sjl_clubes_lectura(
	nom, fec_crea, cuota, id_dir, id_idiom, id_inst)
	VALUES ('First of the Year', '03-27-2017', 0, (
        SELECT id from sjl_calles WHERE nom = 'Paradise hills'
    ), (
        SELECT id from sjl_idiomas WHERE nom = 'Ingles'
    ),(
        SELECT id from sjl_instituciones WHERE nom = 'Doomshop'
    ));

INSERT INTO sjl_clubes_lectura(
	nom, fec_crea, cuota, id_dir, id_idiom)
	VALUES ('Dollars', '03-27-2017', 0, (
        SELECT id from sjl_calles WHERE nom = 'Murcia'
    ), (
        SELECT id from sjl_idiomas WHERE nom = 'Español'
    ));

INSERT INTO sjl_clubes_lectura(
	nom, fec_crea, cuota, id_dir, id_idiom)
	VALUES ('LY', '08-27-2019', 0, (
        SELECT id from sjl_calles WHERE nom = 'Almeria'
    ), (
        SELECT id from sjl_idiomas WHERE nom = 'Español'
    ));
