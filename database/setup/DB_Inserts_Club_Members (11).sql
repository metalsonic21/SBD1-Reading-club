INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (12345, 'Lucia', 'Isabel', 'Cardoso', 'Militao', '08-08-1960', 'F', 1, null, 2, null, null, 5);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (123, 456, 45678941, 12345);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-01-2008', 12345, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (1, '08-01-2008', 1, 12345, '08-01-2008');

/* Members */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (78965, 'Frank', null, 'Hesse', 'Q', '08-01-1999', 'M', 1, null, 2, null, null, 4);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (785, 456, 45678941, 78965);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('06-06-2017', 78965, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (2, '06-06-2017', 1, 78965, '06-06-2017');

/* Members */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (5521, 'Leo', null, 'Barnes', 'L', '08-17-1999', 'M', 1, null, 2, null, null, 2);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (785, 456, 45678941, 5521);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('02-06-2018', 5521, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (3, '02-06-2018', 1, 5521, '02-06-2018');

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (4521, 'John', null, 'Meyer', 'L', '01-21-1999', 'M', 1, 1, 2, null, null, 2);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (785, 456, 225698, 4521);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('02-06-2018', 4521, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (4, '02-06-2018', 1, 4521, '02-06-2018');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-06-2018', '02-06-2018', 1, 4521, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (6652, 'Jhon', null, 'Anderson', 'L', '01-14-1999', 'M', 1, 1, 3, null, null, 7);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (52, 8854, 5558, 6652);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('04-01-2016', 6652, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (5, '04-01-2016', 1, 6652, '04-01-2016');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('04-01-2016', '04-01-2016', 1, 6652, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (8962, 'Samuel', null, 'Parris', 'L', '03-14-1997', 'M', 1, 1, 1, null, null, 8);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (58, 414, 598256, 8962);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('04-08-2019', 8962, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (6, '04-08-2019', 1, 8962, '04-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('04-08-2019', '04-08-2019', 1, 8962, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (5871, 'Fernando', null, 'Lopez', 'L', '07-11-1996', 'M', 1, 1, 1, null, null, 6);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (47, 5583, 58963, 5871);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('02-02-2006', 5871, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (7, '02-02-2006', 1, 5871, '02-02-2006');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('02-02-2006', '02-02-2006', 1, 5871, 1, null);


/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (9987, 'Jordano', null, 'Diaz', 'C', '04-17-1980', 'M', 1, 1, 1, null, null, 1);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (56, 5521, 558892, 9987);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('07-01-2011', 9987, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (8, '07-01-2011', 1, 9987, '07-01-2011');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('07-01-2011', '07-01-2011', 1, 9987, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (6661, 'Kibutsuji', null, 'Muzan', 'C', '01-20-1910', 'M', 1, 1, 1, null, null, 9);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (32, 754, 69892, 6661);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('04-04-2004', 6661, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (9, '04-04-2004', 1, 6661, '04-04-2004');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('04-04-2004', '04-04-2004', 1, 6661, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (8743, 'Terrance', null, 'Mephesto', 'C', '01-20-1997', 'M', 1, 1, 1, null, null, 5);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (41, 521, 25487, 8743);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('04-04-2014', 8743, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (10, '04-04-2014', 1, 8743, '04-04-2014');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('04-04-2014', '04-04-2014', 1, 8743, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (4141, 'Clyde', null, 'Donnovan', 'C', '03-10-1998', 'M', 1, 1, 1, null, null, 1);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (41, 588, 646266, 4141);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-06-2019', 4141, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (11, '03-06-2019', 1, 4141, '03-06-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-06-2019', '03-06-2019', 1, 4141, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (5616, 'Andrew', null, 'Miller', 'A', '07-11-1999', 'M', 1, 1, 1, null, null, 10);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (25, 86, 65160, 5616);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-26-2019', 5616, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (12, '03-26-2019', 1, 5616, '03-26-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-26-2019', '03-26-2019', 1, 5616, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1414, 'Omar', null, 'Hernandez', 'A', '02-11-1969', 'M', 1, 1, 1, null, null, 18);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (58, 424, 125, 5616);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-05-2015', 1414, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (13, '03-05-2015', 1, 1414, '03-05-2015');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-05-2015', '03-05-2015', 1, 1414, 1, null);


/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (9875, 'Gregg', null, 'Spinetti', 'A', '02-13-1999', 'M', 1, 1, 1, null, null, 18);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (98, 525, 055, 9875);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-05-2019', 9875, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (14, '03-05-2019', 1, 9875, '03-05-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-05-2019', '03-05-2019', 1, 9875, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (6653, 'Cristopher', null, 'Nolan', 'A', '02-11-1999', 'M', 1, 1, 1, null, null, 16);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (52, 885, 666688, 6653);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('09-09-2019', 6653, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (15, '09-09-2019', 1, 6653, '09-09-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('09-09-2019', '09-09-2019', 1, 6653, 1, null);

/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (7777, 'Leopoldo', null, 'Vazquez', 'A', '03-20-1998', 'M', 1, 1, 1, null, null, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 587, 220545, 7777);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('01-01-2019', 7777, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (16, '01-01-2019', 1, 7777, '01-01-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('01-01-2019', '01-01-2019', 1, 7777, 1, null);


/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1010, 'Jhoel', null, 'Vazquez', 'A', '03-20-1999', 'M', 1, 1, 1, null, null, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 587, 25515, 1010);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('01-01-2019', 1010, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (17, '01-01-2019', 1, 1010, '01-01-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('01-01-2019', '01-01-2019', 1, 1010, 1, null);


/* Members with group */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1212, 'Jordy', null, 'Castillo', 'A', '07-19-1999', 'M', 1, 1, 1, null, null, 3);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (78, 5525, 22056, 1212);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('01-19-2019', 1212, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (18, '01-19-2019', 1, 1212, '01-19-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('01-19-2019', '01-19-2019', 1, 1212, 1, null);

/* -------------------------------- KIDS ----------------------------------------------------- */

INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1213, 'Austin', null, 'Morgan', 'A', '07-19-2006', 'M', 1, 2, 1, null, 1212, 9);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (98, 5457, 588448, 1213);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('07-07-2019', 1213, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (19, '07-07-2019', 1, 1213, '07-07-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('07-07-2019', '07-07-2019', 1, 1213, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (8999, 'David', null, 'Guzman', 'A', '07-19-2010', 'M', 1, 2, 1, null, 4521, 18);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 5022, 58542, 8999);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('07-01-2019', 8999, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (20, '07-01-2019', 1, 8999, '07-07-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('07-01-2019', '07-01-2019', 1, 8999, 2, null);


/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (7999, 'Gabriel', null, 'Guzman', 'A', '07-19-2010', 'M', 1, 2, 1, null, 4521, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 5022, 58542, 7999);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('07-01-2019', 7999, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (21, '07-01-2019', 1, 7999, '07-07-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('07-01-2019', '07-01-2019', 1, 7999, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (0178, 'Bryan', null, 'Matos', 'A', '05-19-2012', 'M', 1, 2, 1, null, 5871, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 5022, 6543, 0178);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-08-2019', 0178, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (22, '08-08-2019', 1, 0178, '08-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('08-08-2019', '08-08-2019', 1, 0178, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (0520, 'Piero', null, 'Vilchez', 'A', '05-19-2012', 'M', 1, 2, 1, null, 5871, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 0520, 6543, 0520);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-08-2019', 0520, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (23, '08-08-2019', 1, 0520, '08-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('08-08-2019', '08-08-2019', 1, 0520, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (6768, 'Sarah', null, 'Wildes', 'A', '01-04-2011', 'F', 1, 2, 1, null, 6661, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 0520, 6543, 6768);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-08-2019', 6768, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (24, '08-08-2019', 1, 6768, '08-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('08-08-2019', '08-08-2019', 1, 6768, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1012, 'Anna', null, 'Wildes', 'A', '01-04-2011', 'F', 1, 2, 1, null, 6661, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 0520, 6543, 1012);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-08-2019', 1012, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (25, '08-08-2019', 1, 1012, '08-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('08-08-2019', '08-08-2019', 1, 1012, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1013, 'Melvin', null, 'Rodriguez', 'A', '01-17-2008', 'M', 1, 2, 1, null, 6661, 17);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (54, 526, 1012, 1013);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('08-14-2018', 1013, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (26, '08-14-2018', 1, 1013, '08-08-2019');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('08-14-2018', '08-14-2018', 1, 1013, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (2015, 'Mike', null, 'Havenaar', 'A', '01-17-2008', 'M', 1, 2, 1, null, 4141, 20);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (66, 466, 889, 2015);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-17-2018', 2015, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (27, '03-17-2018', 1, 2015, '03-17-2018');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-17-2018', '03-17-2018', 1, 2015, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1710, 'Louis', null, 'Poirot', 'A', '05-17-2009', 'M', 1, 2, 1, null, 4141, 20);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (669, 0556, 562, 1710);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-17-2018', 1710, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (28, '03-17-2018', 1, 1710, '03-17-2018');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-17-2018', '03-17-2018', 1, 1710, 2, null);

/* Kid */
INSERT INTO sjl_lectores(
	doc_iden, nom1, nom2, ape1, ape2, fec_nac, genero, id_club, id_grup, id_calle, id_rep, id_rep_lec, id_nac)
	VALUES (1111, 'Brittany', null, 'Jazz', 'A', '09-11-2007', 'M', 1, 2, 1, null, 4141, 20);

INSERT INTO sjl_telefonos(
	cod_pais, cod_area, num, id_lector)
	VALUES (669, 5620, 751, 1111);

INSERT INTO sjl_membresias(
	fec_i, id_lec, id_club, estatus, fec_f, motivo_b)
	VALUES ('03-17-2018', 1111, 1, 'A', null, null);

INSERT INTO sjl_historicos_pagos_memb(
	id, id_fec_mem, id_club, id_lec, fec_emi)
	VALUES (29, '03-17-2018', 1, 1111, '03-17-2018');

INSERT INTO sjl_grupos_lectores(
	id_fec_i, id_fec_mem, id_club, id_lec, id_grupo, fec_f)
	VALUES ('03-17-2018', '03-17-2018', 1, 1111, 2, null);