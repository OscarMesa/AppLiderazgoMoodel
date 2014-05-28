INSERT DELAYED IGNORE INTO `cursos` (`id`, `state_curso`, `id_docente`, `idmateria`, `nombre_curso`, `descripcion_curso`, `fecha_inicio`, `fecha_cierre`) VALUES
(1, 'inactive', 1, 1, 'asdf', 'sdf', '2014-03-27', '2014-04-19');


INSERT DELAYED IGNORE INTO `materias` (`idmaterias`, `nombre_materia`, `state_materia`) VALUES
(1, 'Matematicas', 'active'),
(2, 'Español', 'active'),
(3, 'Fisica', 'active'),
(4, 'Quimica', 'active'),
(5, 'Bilogia', 'active'),
    (6, 'Inglés', 'active');

----------------------

ALTER TABLE  `talleres` ADD  `id_materia` INT( 5 ) NOT NULL AFTER  `idtalleres` ,
ADD  `id_curso` INT( 5 ) NOT NULL AFTER  `id_materia`;

ALTER TABLE  `talleres` ADD INDEX (  `id_materia` ) ;

ALTER TABLE  `talleres` ADD INDEX (  `id_curso` ) ;

ALTER TABLE  `talleres` ADD FOREIGN KEY (  `id_materia` ) REFERENCES  `math`.`materias` (
`idmaterias`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `talleres` ADD FOREIGN KEY (  `id_curso` ) REFERENCES  `math`.`cursos` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;


ALTER TABLE  `cursos` ADD FOREIGN KEY (  `id_docente` ) REFERENCES  `math`.`usuarios` (
`id_usuario`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `cursos` ADD FOREIGN KEY (  `idmateria` ) REFERENCES  `math`.`materias` (
`idmaterias`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;   



ALTER TABLE  `img_videos_sonido_contenidos` ADD FOREIGN KEY (  `img_videos_id` ) REFERENCES  `math`.`img_videos_sonido` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `img_videos_sonido_contenidos` ADD FOREIGN KEY (  `contenidos_id` ) REFERENCES  `math`.`contenidos` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `contenidos` ADD  `almacenado_total` BOOLEAN NOT NULL COMMENT 'este campo permite saber si un contenido se ha almenado en su totalidad o es un registro que puede o no ser tomado en cuenta.' AFTER  `observacion`    

ALTER TABLE  `contenidos` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT


ALTER TABLE `img_videos_sonido_contenidos` CHANGE `contenidos_tipo_contenido_id` `contenidos_tipo_contenido_id` INT( 11 ) NULL 

ALTER TABLE `img_videos_sonido_contenidos` DROP FOREIGN KEY `img_videos_sonido_contenidos_ibfk_2` ,
ADD FOREIGN KEY ( `contenidos_id` ) REFERENCES `math`.`contenidos` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;

ALTER TABLE `usuarios` CHANGE `state_usuario` `state_usuario` ENUM( 'active', 'inactive', 'not_confirmed', 'not_confirmed_admin' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'active'

ALTER TABLE `usuarios_perfiles` ADD `state_up` ENUM( 'active', 'inactive' ) NOT NULL AFTER `perfiles_id_perfil` 

ALTER TABLE `usuarios` CHANGE `state_usuario` `state_usuario` ENUM( 'active', 'inactive', 'not_confirmed', 'not_confirmed_admin', 'recover_password' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'active'


V.1

ALTER TABLE `talleres` ADD `state_taller` ENUM( 'active', 'inactive' ) NOT NULL AFTER `idtalleres` 

ALTER TABLE `talleres` CHANGE `idtalleres` `idtalleres` INT( 11 ) NOT NULL AUTO_INCREMENT 

ALTER TABLE `contenidos_talleres` ADD FOREIGN KEY ( `contenidos_id` ) REFERENCES `math`.`contenidos` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE `contenidos_talleres` ADD FOREIGN KEY ( `talleres_idtalleres` ) REFERENCES `math`.`talleres` (
`idtalleres`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE `ejercicios` DROP `estado_correccion` ;

ALTER TABLE `tema` ADD `idcurso` INT( 5 ) NOT NULL AFTER `idmateria` ,
ADD INDEX ( `idcurso` ) ;

ALTER TABLE `tema` ADD FOREIGN KEY ( `idcurso` ) REFERENCES `math`.`cursos` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;