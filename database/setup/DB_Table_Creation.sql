/* This file is intended for being used at the initialization and setup of the READING CLUB Data Base System
    We assume that the current file will be imported into a PSQL database, but we try to keep everything standar
    like so there will be likely zero compatibility issues with others RDBMS
    
    Also the prefix on every table is a requirement that ask us to use the developer members initials  */

/*  First we create every table that we will be using on the database, we will define the relations and foreign
    keys on the following section */

CREATE TABLE SJL_lectores (
    doc_iden                 INTEGER NOT NULL,
    nom1                     VARCHAR(15) NOT NULL,
    nom2                     VARCHAR(15),
    ape1                     VARCHAR(15) NOT NULL,
    ape2                     VARCHAR(15) NOT NULL,
    fec_nac                  DATE NOT NULL,
    genero                   VARCHAR(2) NOT NULL,
    id_club                  INTEGER NOT NULL,
    id_grup                  INTEGER,
    id_calle                 INTEGER NOT NULL,
    id_rep                   INTEGER,
    id_rep_lec               INTEGER,
    id_nac                   INTEGER NOT NULL,
    CONSTRAINT lectores_pk PRIMARY KEY (doc_iden)
);

CREATE TABLE SJL_grupos_lectura (
    id                	SERIAL NOT NULL,
    id_club           	INTEGER NOT NULL,
    nom               	VARCHAR(40) NOT NULL,
    tipo 				VARCHAR(40) NOT NULL,
    dia_sem           	INTEGER NOT NULL,
    hora_i            	TIME NOT NULL,
    hora_f            	TIME NOT NULL,
    CONSTRAINT grupos_lectura_pk PRIMARY KEY (id,id_club)
);

CREATE TABLE SJL_clubes_lectura (
    id              SERIAL NOT NULL,
    nom             VARCHAR(20) NOT NULL,
    fec_crea        DATE NOT NULL,
    cuota           NUMERIC(4),
    id_dir          INTEGER NOT NULL,
    id_idiom        INTEGER NOT NULL,
    id_inst         INTEGER,
    CONSTRAINT clubes_lectura_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_clubes_clubes (
    id_club1   INTEGER NOT NULL,
    id_club2   INTEGER NOT NULL,
    CONSTRAINT clubes_clubes_pk PRIMARY KEY (id_club1,id_club2)
);

CREATE TABLE SJL_instituciones (
    id          SERIAL NOT NULL,
    nom         VARCHAR(20) NOT NULL,
    tipo        VARCHAR(2) NOT NULL,
    id_ciudad   INTEGER NOT NULL,
    CONSTRAINT instituciones_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_membresias (
    fec_i      DATE NOT NULL,
    id_lec     INTEGER NOT NULL,
    id_club    INTEGER NOT NULL,
    estatus    VARCHAR(2) NOT NULL,
    fec_f      DATE,
    motivo_b   VARCHAR(50),
    CONSTRAINT membresias_pk PRIMARY KEY (fec_i,id_lec,id_club)
);

CREATE TABLE SJL_representantes (
    doc_iden   INTEGER NOT NULL,
    nom1       VARCHAR(15) NOT NULL,
    nom2       VARCHAR(15),
    ape1       VARCHAR(15) NOT NULL,
    ape2       VARCHAR(15) NOT NULL,
    fec_nac    DATE NOT NULL,
    id_dir     INTEGER NOT NULL,
    CONSTRAINT representates_pk PRIMARY KEY (doc_iden)
);

CREATE TABLE SJL_paises (
    id       SERIAL NOT NULL,
    nom      VARCHAR(20) NOT NULL,
    nac      VARCHAR(20) NOT NULL,
    moneda   VARCHAR(20) NOT NULL,
    CONSTRAINT paises_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_ciudades (
    id        SERIAL NOT NULL,
    nom       VARCHAR(20) NOT NULL,
    id_pais   INTEGER NOT NULL,
    CONSTRAINT ciudades_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_urbanizaciones (
    id          SERIAL NOT NULL,
    nom         VARCHAR(20) NOT NULL,
    id_ciudad   INTEGER NOT NULL,
    CONSTRAINT urbanizaciones_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_calles (
    id                SERIAL NOT NULL,
    nom               VARCHAR(20) NOT NULL,
    cod_post          INTEGER,
    id_urb            INTEGER NOT NULL, 
    CONSTRAINT calles_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_telefonos (
    cod_pais    INTEGER NOT NULL,
    cod_area    INTEGER NOT NULL,
    num         INTEGER NOT NULL,
    id_lector   INTEGER NOT NULL,
    CONSTRAINT telefonos_pk PRIMARY KEY(cod_pais,cod_area,num,id_lector) 
);

CREATE TABLE SJL_idiomas (
    id    SERIAL NOT NULL,
    nom   VARCHAR(15) NOT NULL,
    CONSTRAINT idiomas_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_locales_eventos (
    id        SERIAL NOT NULL,
    nom       VARCHAR(15) NOT NULL,
    tipo      VARCHAR(2) NOT NULL,
    cap       INTEGER NOT NULL,
    num_s     INTEGER NOT NULL,
    id_dir    INTEGER NOT NULL,
    id_club   INTEGER,
    CONSTRAINT locales_eventos_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_inansistencias (
    id_fec_i      DATE NOT NULL,
    id_fec_mem    DATE NOT NULL,
    id_club       INTEGER NOT NULL,
    id_lec        INTEGER NOT NULL,
    id_grupo	  INTEGER NOT NULL,
    fec_reu_men   DATE NOT NULL,
    id_lib        INTEGER NOT NULL,
    CONSTRAINT inasistencias_pk PRIMARY KEY (id_fec_i,id_fec_mem,id_club,id_lec,id_grupo,fec_reu_men,id_lib)
);

CREATE TABLE SJL_reuniones_mensuales (
    fec               DATE NOT NULL,
    id_lib            INTEGER NOT NULL,
    id_grupo          INTEGER NOT NULL,
    id_grupo_mod       INTEGER NOT NULL,
    id_fec_mem        DATE NOT NULL,
    id_fec_i          DATE NOT NULL,
    id_club           INTEGER NOT NULL,
    id_lec            INTEGER NOT NULL,
    n_ses             NUMERIC(2) NOT NULL,
    conclu            VARCHAR(200),
    valor             NUMERIC(3),
    CONSTRAINT reuniones_mensuales_pk PRIMARY KEY (fec,id_lib,id_grupo,id_club)
);

CREATE TABLE SJL_libros (
    isbn         INTEGER NOT NULL,
    titulo_esp   VARCHAR(30),
    titulo_ori   VARCHAR(30) NOT NULL,
    tema_princ   VARCHAR(200),
    sinop        VARCHAR(1000) NOT NULL,
    n_pag        INTEGER NOT NULL,
    fec_pub      DATE NOT NULL,
    autor        VARCHAR(50) NOT NULL,
    id_prev      INTEGER,
    id_edit      INTEGER NOT NULL,
    CONSTRAINT libros_pk PRIMARY KEY (isbn)
);

CREATE TABLE SJL_lista_favoritos (
    id_lec   INTEGER NOT NULL,
    id_lib   INTEGER NOT NULL,
    pref     NUMERIC(2) NOT NULL,
    CONSTRAINT lista_favoritos_pk PRIMARY KEY (id_lec,id_lib)
);

CREATE TABLE SJL_editoriales (
    id        SERIAL NOT NULL,
    nom       VARCHAR(30) NOT NULL,
    id_pais   INTEGER NOT NULL,
    CONSTRAINT editoriales_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_subgeneros (
    id        SERIAL NOT NULL,
    nom       VARCHAR(40) NOT NULL,
    tipo      VARCHAR(3) NOT NULL,
    id_subg   INTEGER,
    CONSTRAINT subgeneros_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_generos_libros (
    id_gen   INTEGER NOT NULL,
    id_lib   INTEGER NOT NULL,
    CONSTRAINT generos_libros_pk PRIMARY KEY(id_gen,id_lib)
);


CREATE TABLE SJL_estructuras_libros (
    id       SERIAL NOT NULL,
    id_lib   INTEGER NOT NULL,
    nom      VARCHAR(20) NOT NULL,
    tipo     VARCHAR(2) NOT NULL,
    titulo   VARCHAR(20),
    CONSTRAINT estructuras_libros_pk PRIMARY KEY(id,id_lib)
);

CREATE TABLE SJL_secciones_libros (
    id       SERIAL NOT NULL,
    nom      VARCHAR(20) NOT NULL,
    num      NUMERIC NOT NULL,
    titulo   VARCHAR(20),
    id_est   INTEGER NOT NULL,
    id_lib   INTEGER NOT NULL,
    CONSTRAINT secciones_libros_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_obras_libros (
    id_obra   INTEGER NOT NULL,
    id_lib    INTEGER NOT NULL,
    CONSTRAINT obras_libros_pk PRIMARY KEY (id_obra,id_lib)
);

CREATE TABLE SJL_obras (
    id         SERIAL NOT NULL,
    nom        VARCHAR(20) NOT NULL,
    resum      VARCHAR(200) NOT NULL,
    CONSTRAINT obras_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_personajes (
    id        SERIAL NOT NULL,
    id_obra   INTEGER NOT NULL,
    nom       VARCHAR(15) NOT NULL,
    descrip   VARCHAR(100) NOT NULL,
    CONSTRAINT personajes_pk PRIMARY KEY (id,id_obra)
);

CREATE TABLE SJL_historicos_presentaciones (
    fec        DATE NOT NULL,
    id_obra    INTEGER NOT NULL,
    id_local   INTEGER NOT NULL,
    hora_i     TIME NOT NULL,
    durac      TIME NOT NULL,
    valor      NUMERIC(3),
    num_asist  INTEGER,
    costo      INTEGER NOT NULL,
    CONSTRAINT hist_presentaciones_pk PRIMARY KEY (fec,id_obra,id_local)
);

CREATE TABLE SJL_grupos_lectores (
    id_fec_i   DATE NOT NULL,
    id_fec_mem DATE NOT NULL,
    id_club    INTEGER NOT NULL,
    id_lec     INTEGER NOT NULL,
    id_grupo   INTEGER NOT NULL,
    fec_f      DATE,
    CONSTRAINT grupos_lectores_pk PRIMARY KEY (id_fec_i,id_fec_mem,id_club,id_lec,id_grupo)
);

CREATE TABLE SJL_elenco (
    id_fec_mem  DATE NOT NULL,
    id_club     INTEGER NOT NULL,
    id_lec      INTEGER NOT NULL,
    id_pers     INTEGER NOT NULL,
    id_obra     INTEGER NOT NULL,
    principal   BOOLEAN,
    CONSTRAINT elenco_pk PRIMARY KEY (id_fec_mem,id_club,id_lec,id_pers,id_obra)
);

CREATE TABLE SJL_elenco_lectores (
    id_fec_mem    DATE NOT NULL,
    id_club       INTEGER NOT NULL,
    id_lec        INTEGER NOT NULL,
    id_pers       INTEGER NOT NULL,
    id_obra       INTEGER NOT NULL,
    id_hist_pre   DATE NOT NULL,    
    id_local      INTEGER NOT NULL,    
    mej_act       BOOLEAN,
    CONSTRAINT elenco_lectores_pk PRIMARY KEY (id_fec_mem,id_club,id_lec,id_pers,id_obra,id_hist_pre)
);

CREATE TABLE SJL_historicos_pagos_memb (
    id            SERIAL NOT NULL,
    id_fec_mem    DATE NOT NULL,
    id_club       INTEGER NOT NULL,
    id_lec        INTEGER NOT NULL,
    fec_emi       DATE NOT NULL,
    CONSTRAINT historicos_pagos_memb_pk PRIMARY KEY (id,id_fec_mem,id_club,id_lec)
);

/*End of the table creation process*/

/*Foreign keys*/

ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_clubes_fk FOREIGN KEY(id_club) REFERENCES SJL_clubes_lectura(id);
ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_grupos_fk FOREIGN KEY(id_grup,id_club) REFERENCES SJL_grupos_lectura(id,id_club);
ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_calles_fk FOREIGN KEY(id_calle) REFERENCES SJL_calles(id);
ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_rep_fk FOREIGN KEY(id_rep) REFERENCES SJL_representantes(doc_iden) ON UPDATE CASCADE;
ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_rep_lec_fk FOREIGN KEY(id_rep_lec) REFERENCES SJL_lectores(doc_iden) ON UPDATE CASCADE;
ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_pais_fk FOREIGN KEY(id_nac) REFERENCES SJL_paises(id);

ALTER TABLE SJL_grupos_lectura ADD CONSTRAINT grupos_clubes_fk FOREIGN KEY(id_club) REFERENCES SJL_clubes_lectura(id);

ALTER TABLE SJL_clubes_lectura ADD CONSTRAINT clubes_calles_fk FOREIGN KEY(id_dir) REFERENCES SJL_calles(id);
ALTER TABLE SJL_clubes_lectura ADD CONSTRAINT clubes_idiomas_fk FOREIGN KEY(id_idiom) REFERENCES SJL_idiomas(id);
ALTER TABLE SJL_clubes_lectura ADD CONSTRAINT clubes_inst_fk FOREIGN KEY(id_inst) REFERENCES SJL_instituciones(id);

ALTER TABLE SJL_clubes_clubes ADD CONSTRAINT clubes_club1_fk FOREIGN KEY(id_club1) REFERENCES SJL_clubes_lectura(id);
ALTER TABLE SJL_clubes_clubes ADD CONSTRAINT clubes_club2_fk FOREIGN KEY(id_club2) REFERENCES SJL_clubes_lectura(id);

ALTER TABLE SJL_membresias ADD CONSTRAINT membresias_lectores_fk FOREIGN KEY(id_lec) REFERENCES SJL_lectores(doc_iden) ON UPDATE CASCADE;
ALTER TABLE SJL_membresias ADD CONSTRAINT membresias_clubes_fk FOREIGN KEY(id_club) REFERENCES SJL_clubes_lectura(id);

ALTER TABLE SJL_representantes ADD CONSTRAINT rep_calles_fk FOREIGN KEY(id_dir) REFERENCES SJL_calles(id);

ALTER TABLE SJL_ciudades ADD CONSTRAINT ciudades_paises_fk FOREIGN KEY(id_pais) REFERENCES SJL_paises(id);

ALTER TABLE SJL_urbanizaciones ADD CONSTRAINT urb_ciudades_fk FOREIGN KEY(id_ciudad) REFERENCES SJL_ciudades(id);

ALTER TABLE SJL_calles ADD CONSTRAINT calles_urb_fk FOREIGN KEY(id_urb) REFERENCES SJL_urbanizaciones(id);

ALTER TABLE SJL_telefonos ADD CONSTRAINT telefonos_lectores_fk FOREIGN KEY(id_lector) REFERENCES SJL_lectores(doc_iden) ON UPDATE CASCADE;

ALTER TABLE SJL_locales_eventos ADD CONSTRAINT locales_calles_fk FOREIGN KEY(id_dir) REFERENCES SJL_calles(id);
ALTER TABLE SJL_locales_eventos ADD CONSTRAINT locales_clubes_fk FOREIGN KEY(id_club) REFERENCES SJL_clubes_lectura(id);

ALTER TABLE SJL_inansistencias ADD CONSTRAINT inasistencias_grupos_fk FOREIGN KEY(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo) REFERENCES SJL_grupos_lectores(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo) ON DELETE CASCADE;
ALTER TABLE SJL_inansistencias ADD CONSTRAINT inasistencias_reuniones_fk FOREIGN KEY(fec_reu_men,id_lib,id_grupo,id_club) REFERENCES SJL_reuniones_mensuales(fec,id_lib,id_grupo,id_club) ON DELETE CASCADE;

ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_libros_fk FOREIGN KEY(id_lib) REFERENCES SJL_libros(isbn) ON UPDATE CASCADE;
ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_grupos_fk FOREIGN KEY(id_grupo,id_club) REFERENCES SJL_grupos_lectura(id,id_club) ON DELETE CASCADE;
ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_grupo_mod_fk FOREIGN KEY(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo_mod) REFERENCES SJL_grupos_lectores(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo) ON DELETE CASCADE;

ALTER TABLE SJL_libros ADD CONSTRAINT libros_libro_prev_fk FOREIGN KEY(id_prev) REFERENCES SJL_libros(isbn) ON UPDATE CASCADE;
ALTER TABLE SJL_libros ADD CONSTRAINT libros_editorial_fk FOREIGN KEY(id_edit) REFERENCES SJL_editoriales(id);

ALTER TABLE SJL_lista_favoritos ADD CONSTRAINT favoritos_lectores_fk FOREIGN KEY(id_lec) REFERENCES SJL_lectores(doc_iden) ON UPDATE CASCADE;
ALTER TABLE SJL_lista_favoritos ADD CONSTRAINT favoritos_libros_fk FOREIGN KEY(id_lib) REFERENCES SJL_libros(isbn) ON UPDATE CASCADE;

ALTER TABLE SJL_subgeneros ADD CONSTRAINT subgeneros_subgeneros_fk FOREIGN KEY(id_subg) REFERENCES SJL_subgeneros(id);

ALTER TABLE SJL_generos_libros ADD CONSTRAINT generos_libros_fk FOREIGN KEY(id_gen) REFERENCES SJL_subgeneros(id) ON DELETE CASCADE;
ALTER TABLE SJL_generos_libros ADD CONSTRAINT libros_generos_fk FOREIGN KEY(id_lib) REFERENCES SJL_libros(isbn) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE SJL_estructuras_libros ADD CONSTRAINT estructura_libros_fk FOREIGN KEY(id_lib) REFERENCES SJL_libros(isbn) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE SJL_secciones_libros ADD CONSTRAINT secciones_estructuras_prev_fk FOREIGN KEY(id_est,id_lib) REFERENCES SJL_estructuras_libros(id,id_lib) ON DELETE CASCADE;

ALTER TABLE SJL_obras_libros ADD CONSTRAINT obras_libros_fk FOREIGN KEY(id_obra) REFERENCES SJL_obras(id);
ALTER TABLE SJL_obras_libros ADD CONSTRAINT libros_obras_fk FOREIGN KEY(id_lib) REFERENCES SJL_libros(isbn) ON UPDATE CASCADE;


ALTER TABLE SJL_personajes ADD CONSTRAINT personajes_obras_fk FOREIGN KEY(id_obra) REFERENCES SJL_obras(id);

ALTER TABLE SJL_historicos_presentaciones ADD CONSTRAINT historicos_obras_fk FOREIGN KEY(id_obra) REFERENCES SJL_obras(id);
ALTER TABLE SJL_historicos_presentaciones ADD CONSTRAINT obras_local_fk FOREIGN KEY(id_local) REFERENCES SJL_locales_eventos(id);

ALTER TABLE SJL_grupos_lectores ADD CONSTRAINT grupos_membrecias_fk FOREIGN KEY(id_fec_mem,id_club,id_lec) REFERENCES SJL_membresias(fec_i,id_club,id_lec);
ALTER TABLE SJL_grupos_lectores ADD CONSTRAINT membrecias_grupos_fk FOREIGN KEY(id_grupo,id_club) REFERENCES SJL_grupos_lectura(id,id_club);

ALTER TABLE SJL_elenco ADD CONSTRAINT elenco_membrecias_fk FOREIGN KEY(id_fec_mem,id_club,id_lec) REFERENCES SJL_membresias(fec_i,id_lec,id_club);
ALTER TABLE SJL_elenco ADD CONSTRAINT elenco_personajes_fk FOREIGN KEY(id_pers,id_obra) REFERENCES SJL_personajes(id,id_obra);

ALTER TABLE SJL_elenco_lectores ADD CONSTRAINT elenco_lectores_membresias_fk FOREIGN KEY(id_fec_mem,id_club,id_lec,id_pers,id_obra) REFERENCES SJL_elenco(id_fec_mem,id_club,id_lec,id_pers,id_obra);
ALTER TABLE SJL_elenco_lectores ADD CONSTRAINT elenco_historiales_fk FOREIGN KEY(id_hist_pre,id_obra,id_local) REFERENCES SJL_historicos_presentaciones(fec,id_obra,id_local);

ALTER TABLE SJL_historicos_pagos_memb ADD CONSTRAINT historicos_membrecias_fk FOREIGN KEY(id_fec_mem,id_lec,id_club) REFERENCES SJL_membresias(fec_i,id_lec,id_club) ON UPDATE CASCADE;

/* Constraint Checks */

ALTER TABLE SJL_lectores ADD CONSTRAINT lectores_genero_chk CHECK (genero = 'M' or genero = 'F' );

ALTER TABLE SJL_grupos_lectura ADD CONSTRAINT grupos_tipo_chk CHECK ( tipo = 'A' or tipo = 'J' or tipo = 'N' );
ALTER TABLE SJL_grupos_lectura ADD CONSTRAINT grupos_dia_sem_chk CHECK ( dia_sem >= 2 and dia_sem <= 6 );

ALTER TABLE SJL_membresias ADD CONSTRAINT membresia_estatus_chk CHECK ( estatus = 'A' or estatus = 'I');

ALTER TABLE SJL_locales_eventos ADD CONSTRAINT local_tipo_chk CHECK ( tipo = 'S' or tipo = 'A');

ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_n_ses_chk CHECK ( n_ses = 1 or n_ses = 2 or n_ses = 3);
ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_valor_chk CHECK (valor >= 1 and valor <= 5 );

ALTER TABLE SJL_lista_favoritos ADD CONSTRAINT lista_pref_chk CHECK ( pref = 1 or pref = 2 or pref = 3);

ALTER TABLE SJL_subgeneros ADD CONSTRAINT subgeneros_tipo_chk CHECK ( tipo = 'SG' or tipo = 'T');

ALTER TABLE SJL_estructuras_libros ADD CONSTRAINT estructuras_tipo_chk CHECK ( tipo = 'C' or tipo = 'O');

ALTER TABLE SJL_historicos_presentaciones ADD CONSTRAINT hisorico_presentaciones_valor_chk CHECK (valor >= 1 and valor <= 5 );

/* Constraint Unique */

ALTER TABLE SJL_libros ADD CONSTRAINT libros_id_prev_unq UNIQUE (id_prev);

/* Only for test inserts*/
CREATE SEQUENCE IF NOT EXISTS id_ciudad INCREMENT BY 1 MINVALUE 1 NO MAXVALUE START WITH 1 OWNED BY sjl_ciudades.id;
CREATE SEQUENCE IF NOT EXISTS id_urbanizacion INCREMENT BY 1 NO MINVALUE NO MAXVALUE START WITH 1 OWNED BY sjl_urbanizaciones.id;
CREATE SEQUENCE IF NOT EXISTS id_calle INCREMENT BY 1 NO MINVALUE NO MAXVALUE START WITH 1 OWNED BY sjl_calles.id;
CREATE SEQUENCE IF NOT EXISTS id_inst INCREMENT BY 1 NO MINVALUE NO MAXVALUE START WITH 1 OWNED BY SJL_instituciones.id;
CREATE SEQUENCE IF NOT EXISTS id_idioma INCREMENT BY 1 MINVALUE 1 NO MAXVALUE START WITH 1 OWNED BY SJL_idiomas.id;
CREATE SEQUENCE IF NOT EXISTS id_obras INCREMENT BY 1 MINVALUE 1 NO MAXVALUE START WITH 1 OWNED BY SJL_obras.id;