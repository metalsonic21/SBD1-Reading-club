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