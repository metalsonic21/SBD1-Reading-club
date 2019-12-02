/* This file is intended for being used at the initialization and setup of the READING CLUB Data Base System
    We assume that the current file will be imported into a PSQL database, but we try to keep everything standar
    like so there will be likely zero compatibility issues with others RDBMS
    
    Also the prefix on every table is a requirement that ask us to use the developer members initials  */

/*  First we create every table that we will be using on the database, we will define the relations and foreign
    keys on the following section */
CREATE TABLE SJL_calles (
    id                NUMERIC(28) NOT NULL,
    nom               VARCHAR(20) NOT NULL,
    cod_post          NUMERIC(28),
    id_urb            NUMERIC(28) NOT NULL, 
    CONSTRAINT calle_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_ciudades (
    id        NUMERIC(28) NOT NULL,
    nom       varchar,
    id_pais  NUMERIC(28) NOT NULL,
    CONSTRAINT ciudades_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_club_club (
    id_club1   NUMERIC(28) NOT NULL,
    id_club2   NUMERIC(28) NOT NULL,
    CONSTRAINT club_club_pk PRIMARY KEY (id_club1,id_club2)
);

CREATE TABLE SJL_clubes_lectura (
    id              NUMERIC(28) NOT NULL,
    nom             VARCHAR(20) NOT NULL,
    fec_crea        DATE NOT NULL,
    cuota           NUMERIC(2),
    id_dir          NUMERIC(28) NOT NULL,
    id_idiom        NUMERIC(28) NOT NULL,
    id_inst         NUMERIC(28),
    CONSTRAINT clubes_lectura_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_editoriales (
    id        NUMERIC(28) NOT NULL,
    nom       VARCHAR(20) NOT NULL,
    id_pais   NUMERIC(28) NOT NULL,
    CONSTRAINT editoriales_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_elenco (
    id_mem      NUMERIC(28) NOT NULL,
    id_club      NUMERIC(28) NOT NULL,
    id_lec      NUMERIC(28) NOT NULL,
    id_pers     NUMERIC(28) NOT NULL,
    id_obra     NUMERIC(28) NOT NULL,
    principal   bit,
    CONSTRAINT elenco_pk PRIMARY KEY (id_mem,id_club,id_lec,id_pers,id_obra)
);

CREATE TABLE SJL_elenco_lectores (
    id_elenco     NUMERIC(28) NOT NULL,
    id_mem        NUMERIC(28) NOT NULL,
    d_club        NUMERIC(28) NOT NULL,
    id_lec        NUMERIC(28) NOT NULL,
    id_pers       NUMERIC(28) NOT NULL,
    id_obra       NUMERIC(28) NOT NULL,
    id_hist_pre   NUMERIC(28) NOT NULL,        
    mej_act       bit NOT NULL,
    CONSTRAINT elenco_lectores_pk PRIMARY KEY (id_elenco ,id_me,id_club,id_lec,id_pers,id_obra,id_hist_pre)
);

CREATE TABLE SJL_estructuras_libros (
    id       NUMERIC(28) NOT NULL,
    id_lib   NUMERIC(28),
    nom      VARCHAR(20) NOT NULL,
    tipo     VARCHAR(2) NOT NULL,
    titulo   VARCHAR(20),
    CONSTRAINT estructuras_libros_pk PRIMARY KEY(id,id_lib)
);

CREATE TABLE SJL_generos_libros (
    id_gen   NUMERIC(28) NOT NULL,
    id_lib   NUMERIC(28) NOT NULL,
    CONSTRAINT generos_libros_pk PRIMARY KEY(id_gen,id_lib)
);

CREATE TABLE SJL_grupos_lectores (
    id_fec_i   DATE NOT NULL,
    id_mem     NUMERIC(28) NOT NULL,
    id_club    NUMERIC(28) NOT NULL,
    id_lec     NUMERIC(28) NOT NULL,
    id_grupo   NUMERIC(28) NOT NULL,
    id_club    NUMERIC(28) NOT NULL,
    fec_f      DATE,
    CONSTRAINT grupos_lectores_pk PRIMARY KEY (id_fec_i,id_mem,id_club,id_lec,id_grupo,id_club)
);

CREATE TABLE SJL_grupos_lectura (
    id                NUMERIC(28) NOT NULL,
    id_club           NUMERIC(28) NOT NULL,
    nom               VARCHAR(20) NOT NULL,
    dia_sem           NUMERIC(28) NOT NULL,
    hora_i            DATE NOT NULL,
    hora_f            DATE NOT NULL,
    club_lectura_id   NUMERIC(28) NOT NULL,
    CONSTRAINT grupos_lectura PRIMARY KEY (id,id_club)
);

CREATE TABLE SJL_historicos_pagos_memb (
    id        NUMERIC(28) NOT NULL,
    id_mem    NUMERIC(28) NOT NULL,
    id_club   NUMERIC(28) NOT NULL,
    id_lec    NUMERIC(28) NOT NULL,
    fec_emi   DATE NOT NULL,
    CONSTRAINT historicos_pagos_memb_pk PRIMARY KEY (id,id_mem,id_club,id_lec)
);

CREATE TABLE SJL_historicos_presentaciones (
    fec         DATE NOT NULL,
    hora_i      DATE NOT NULL,
    estatus     bit,
    valor       NUMERIC(28),
    num_asist   NUMERIC(28),
    id_obra     NUMERIC(28) NOT NULL,
    CONSTRAINT hist_presentaciones_pk PRIMARY KEY (fec)
);

CREATE TABLE SJL_idiomas (
    id    NUMERIC(28) NOT NULL,
    nom   VARCHAR(10) NOT NULL,
    CONSTRAINT idiomas_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_inansistencias (
    id_grup_lec   NUMERIC(28) NOT NULL,
    id_reu_men    NUMERIC(28) NOT NULL,
    CONSTRAINT inasistencias_pk PRIMARY KEY (id_grup_lec,id_reu_men )
);

CREATE TABLE SJL_insituciones (
    id          NUMERIC(28) NOT NULL,
    nom         VARCHAR(20) NOT NULL,
    tipo        VARCHAR(2) NOT NULL,
    id_ciudad   NUMERIC(28) NOT NULL,
    CONSTRAINT instituciones_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_lectores (
    doc_iden                 NUMERIC(28) NOT NULL,
    nom1                     VARCHAR(10) NOT NULL,
    nom2                     VARCHAR(10),
    ape1                     VARCHAR(10) NOT NULL,
    ape2                     VARCHAR(10) NOT NULL,
    fec_nac                  DATE NOT NULL,
    genero                   VARCHAR(2) NOT NULL,
    id_club                  NUMERIC(28) NOT NULL,
    id_grup                  NUMERIC(28),
    id_calle                 NUMERIC(28) NOT NULL,
    id_rep                   NUMERIC(28),
    id_rep_lec               NUMERIC(28),
    id_nac                   NUMERIC(28) NOT NULL,
    grupos_lectura_id        NUMERIC(28),
    grupos_lectura_id_club   NUMERIC(28),
    representante_doc_iden   NUMERIC(28),
    calle_id                 NUMERIC(28) NOT NULL,
    CONSTRAINT lectores_pk PRIMARY KEY (doc_iden)
);

CREATE TABLE SJL_libros (
    isbn         NUMERIC(28) NOT NULL,
    titulo_ori   VARCHAR(30) NOT NULL,
    titulo_esp   VARCHAR(30),
    tema_princ   VARCHAR(50),
    sinop        VARCHAR(50) NOT NULL,
    n_pag        NUMERIC(28) NOT NULL,
    fec_pub      DATE NOT NULL,
    id_prev      NUMERIC(28),
    id_edit      NUMERIC(28) NOT NULL
    CONSTRAINT libros_pk PRIMARY KEY (isbn)
);

CREATE TABLE SJL_lista_favoritos (
    id_lec   NUMERIC(28) NOT NULL,
    id_lib   NUMERIC(28) NOT NULL,
    pref     NUMERIC(28) NOT NULL,
    CONSTRAINT lista_favoritos_pk PRIMARY KEY (id_lec,id_lib)
);

CREATE TABLE SJL_locales_eventos (
    id        NUMERIC(28) NOT NULL,
    nom       varchar NOT NULL,
    tipo      VARCHAR(2) NOT NULL,
    cap       NUMERIC(28) NOT NULL,
    num_s     NUMERIC(28) NOT NULL,
    id_dir    NUMERIC(28) NOT NULL,
    id_club   NUMERIC(28) NOT NULL,
    CONSTRAINT locales_eventos_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_membresias (
    fec_i      DATE NOT NULL,
    id_lec     NUMERIC(28) NOT NULL,
    id_club    NUMERIC(28) NOT NULL,
    estatus    VARCHAR(2) NOT NULL,
    fec_f      DATE,
    motivo_b   VARCHAR(20),
    CONSTRAINT membresias_pk PRIMARY KEY (fec_i,id_lec,id_club)
);

CREATE TABLE SJL_obras (
    id         NUMERIC(28) NOT NULL,
    nom        VARCHAR(20) NOT NULL,
    resum      VARCHAR(200) NOT NULL,
    costo      NUMERIC(28) NOT NULL,
    durac      DATE NOT NULL,
    estatus    bit,
    id_local   NUMERIC(28) NOT NULL,
    CONSTRAINT obras_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_obras_libros (
    id_obra   NUMERIC(28) NOT NULL,
    id_lib    NUMERIC(28) NOT NULL,
    CONSTRAINT obras_libros_pk PRIMARY KEY (id_obra,id_lib)
);

CREATE TABLE SJL_paises (
    id       NUMERIC(28) NOT NULL,
    nom      VARCHAR(20) NOT NULL,
    nac      VARCHAR(20) NOT NULL,
    moneda   VARCHAR(20) NOT NULL,
    CONSTRAINT paises_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_personajes (
    id        NUMERIC(28) NOT NULL,
    id_obra   NUMERIC(28) NOT NULL,
    nom       VARCHAR(15) NOT NULL,
    descrip   VARCHAR(60) NOT NULL,
    CONSTRAINT personajes_pk PRIMARY KEY (id,id_obra)
);

CREATE TABLE SJL_representantes (
    doc_iden   NUMERIC(28) NOT NULL,
    nom1       VARCHAR(10) NOT NULL,
    nom2       VARCHAR(10),
    ape1       VARCHAR(10) NOT NULL,
    ape2       varchar NOT NULL,
    fec_nac    DATE NOT NULL,
    id_dir     NUMERIC(28) NOT NULL
    CONSTRAINT representates_pk PRIMARY KEY (doc_iden)
);

CREATE TABLE SJL_reuniones_mensuales (
    fec               DATE NOT NULL,
    id_lib            NUMERIC(28) NOT NULL,
    id_grupo          NUMERIC(28) NOT NULL,
    id_grup_lec_mod   NUMERIC(28) NOT NULL,
    n_ses             NUMERIC(28) NOT NULL,
    conclu            VARCHAR(200),
    valor             NUMERIC(28)
    CONSTRAINT reuniones_mensuales_pk PRIMARY KEY (fec,id_lib,id_grupo)
);

CREATE TABLE SJL_secciones_libros (
    id       NUMERIC(28) NOT NULL,
    nom      VARCHAR(20) NOT NULL,
    num      NUMERIC(28) NOT NULL,
    titulo   VARCHAR(20),
    id_est   NUMERIC(28) NOT NULL
    CONSTRAINT secciones_libros_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_subgeneros (
    id        NUMERIC(28) NOT NULL,
    nom       VARCHAR(12) NOT NULL,
    tipo      VARCHAR(3) NOT NULL,
    id_subg   NUMERIC(28),
    CONSTRAINT subgeneros_pk PRIMARY KEY (id)
);

CREATE TABLE SJL_telefonos (
    cod_pais    NUMERIC(28) NOT NULL,
    cod_area    NUMERIC(28) NOT NULL,
    num         NUMERIC(28) NOT NULL,
    id_lector   NUMERIC(28) NOT NULL,
    CONSTRAINT telefonos_pk PRIMARY KEY(cod_pais,cod_area,num) 
);

CREATE TABLE SJL_urbanizaciones (
    id          NUMERIC(28) NOT NULL,
    nom         VARCHAR(20) NOT NULL,
    id_ciudad   NUMERIC(28) NOT NULL,
    ciudad_id   NUMERIC(28) NOT NULL,
    CONSTRAINT urbanizaciones_pk PRIMARY KEY (id)
);

/*End of the table creation process*/