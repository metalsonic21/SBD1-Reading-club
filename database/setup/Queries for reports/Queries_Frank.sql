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