/* 1. FICHA LIBRO */
/*A. Información de libro */

SELECT l.titulo_esp as "Título en Español", l.titulo_ori as "Título Original", l.tema_princ as "Tema Principal", l.sinop
as "Sinopsis", l.n_pag as "Número de Páginas", l.fec_pub as "Fecha de Publicación", l.autor as "Autor", 
    (SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NULL AND 
g.id_lib = l.isbn)"Género", (
    SELECT s.nom from sjl_subgeneros s, sjl_generos_libros g WHERE s.id = g.id_gen AND s.id_subg IS NOT NULL AND 
g.id_lib = l.isbn
)"Subgénero"
    FROM sjl_libros l
    ORDER BY l.isbn;

/* B. Estructura de libro */

SELECT (CASE WHEN e.tipo = 'C' THEN 'Capítulo' ELSE '' END) || ' ' || s.num || '-' || s.nom as "Número" 
FROM sjl_secciones_libros s, sjl_estructuras_libros e 
WHERE e.id = s.id_est
ORDER BY e.id_lib; 

/* 2. FICHA CLUB */
SELECT c.id, c.nom as nom FROM sjl_clubes_lectura c ORDER BY c.nom;
/* A. Grupos con Horario Disponible */
SELECT g.nom, (CASE
    WHEN g.dia_sem = 2 THEN 'Lunes'
    WHEN g.dia_sem = 3 THEN 'Martes'
    WHEN g.dia_sem = 4 THEN 'Miercoles'
    WHEN g.dia_sem = 5 THEN 'Jueves'
    ELSE 'Viernes'
END)dia, (select to_char(g.hora_i::time, 'HH12:MI AM')) || ' - ' || (select to_char(g.hora_f::time, 'HH12:MI AM')) as horario,
(CASE
    WHEN g.tipo = 'A' THEN 'Adultos'
    WHEN g.tipo = 'J' THEN 'Jovenes'
    ELSE 'Niños'
END)tipo FROM sjl_grupos_lectura g ORDER BY g.nom;
/* B. Clubes asociados */

SELECT a.id_club1, a.id_club2, (SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club1)clubone, (
    SELECT nom FROM sjl_clubes_lectura WHERE id = a.id_club2
) FROM sjl_clubes_clubes a;

/* 3. PORCENTAJE DE ASISTENCIA DE MIEMBROS DE UN CLUB Y GRUPO DETERMINADOS */
SELECT l.doc_iden, l.nom1 || ' ' || l.ape1 as nombre, m.estatus,(
    (SELECT COUNT(i.fec_reu_men) FROM sjl_inansistencias i WHERE i.id_club=1 AND i.id_lec = l.doc_iden AND i.id_grupo=1 AND i.fec_reu_men>=m.fec_i AND i.fec_reu_men>=g.id_fec_i AND i.fec_reu_men BETWEEN DATE '2019-01-01' AND DATE '2019-01-01'+interval '2 months')*100
    /(CASE WHEN (SELECT COUNT(r.fec) FROM sjl_reuniones_mensuales r WHERE r.id_club=1 AND r.id_grupo=1 AND r.fec>=m.fec_i AND r.fec>=g.id_fec_i AND r.fec BETWEEN DATE '2019-01-01' AND DATE '2019-01-01'+interval '2 months')=0 THEN 1 ELSE (SELECT COUNT(r.fec) FROM sjl_reuniones_mensuales r WHERE r.id_club=1 AND r.id_grupo=1 AND r.fec>=m.fec_i AND r.fec>=g.id_fec_i AND r.fec BETWEEN DATE '2019-01-01' AND DATE '2019-01-01'+interval '2 months') END)
)porcentaje
FROM sjl_lectores l, sjl_membresias m, sjl_grupos_lectores g WHERE l.id_club=1 AND l.id_grup=1 
AND m.id_lec=l.doc_iden AND m.id_club=1
AND g.id_fec_mem = m.fec_i AND g.id_club = 1 AND g.id_grupo=1 AND g.id_lec = l.doc_iden
ORDER BY l.nom1,l.ape1;