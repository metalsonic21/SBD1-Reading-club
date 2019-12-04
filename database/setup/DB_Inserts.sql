/*
DO $$
DECLARE
BEGIN
END;
*/

INSERT INTO SJL_calles  VALUES ($id,$nom,$cod_post,$id_urb);

INSERT INTO SJL_ciudades VALUES ($id,$nom,$id_pais);

INSERT INTO SJL_club_club VALUES ($id_club1,$id_club2);

INSERT INTO SJL_clubes_lectura VALUES ($id,$nom,$fec_crea,$cuota,$id_dir,$id_idiom,$id_inst);

INSERT INTO SJL_editoriales VALUES ($id,$nom,$id_pais);

INSERT INTO SJL_elenco VALUES ($id_mem,$id_club,$id_lec,$id_pers,$id_obra,$principal);

INSERT INTO SJL_elenco_lectores VALUES ($id_elenco,$id_mem,$id_club,$id_pers,$id_obra,$id_hist_pre,$mej_act);

INSERT INTO SJL_estructuras_libros VALUES ($id,$id_lib,$nom,$tipo,$titulo);

INSERT INTO SJL_generos_libros VALUES ($id_gen,$id_lib);

INSERT INTO SJL_grupos_lectores VALUES ($id_fec_i,$id_mem,$id_club,$id_lec,$id_lec,$id_grupo,$fec_f);

INSERT INTO SJL_grupos_lectura VALUES ($id,$id_club,$nom,$dia_sem,$hora_i,$hora_f,$club_lectura_id);

INSERT INTO SJL_historicos_pagos_memb VALUES ($id,$id_mem,$id_club,$id_lec,$fec_emi);

INSERT INTO SJL_historicos_presentaciones VALUES ($fec,$hora_i,$estatus,$valor,$num_asist,$id_obra);

INSERT INTO SJL_idiomas VALUES ($id,$nom);

INSERT INTO SJL_inansistencias VALUES ($id_grup_lec,$id_reu_men);

INSERT INTO SJL_insituciones VALUES ($id,$nom,$tipo,$id_ciudad);

INSERT INTO SJL_lectores VALUES ($doc_iden,$nom1,$nom2,$ape1,$ape2,$fec_nac,$genero,$id_club,$id_grup,$id_calle,$id_rep,$id_rep_lec,$id_nac,$grupos_lectura_id,$grupos_lectura_id_club,$representante_doc_iden,$calle_id);

INSERT INTO SJL_libros VALUES ($isbn,$titulo_ori,$titulo_esp,$tema_princ,$sinop,$n_pag,$fec_pub,$id_prev,$id_edit);

INSERT INTO SJL_lista_favoritos VALUES ($id_lec,$id_lib,$pref);


