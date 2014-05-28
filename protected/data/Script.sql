
-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2014 at 01:31 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `math`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comentarios_curso`
--

CREATE TABLE IF NOT EXISTS `Comentarios_curso` (
  `idcurso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `comentario` varchar(45) NOT NULL,
  PRIMARY KEY (`idcurso`,`idusuario`),
  KEY `fk_Comentarios_curso_cursos1_idx` (`idcurso`),
  KEY `fk_Comentarios_curso_usuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_evaluacion`
--

CREATE TABLE IF NOT EXISTS `comentarios_evaluacion` (
  `idusuario` int(11) NOT NULL,
  `idevaluacion` varchar(45) NOT NULL,
  `comentarios_evaluacion` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuario`,`idevaluacion`),
  KEY `fk_comentarios_evaluacion_usuarios1_idx` (`idusuario`),
  KEY `fk_comentarios_evaluacion_evaluaciones1_idx` (`idevaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_taller`
--

CREATE TABLE IF NOT EXISTS `comentarios_taller` (
  `idtaller` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `comentarios_taller` varchar(45) NOT NULL,
  PRIMARY KEY (`idtaller`,`idusuario`),
  KEY `fk_comentarios_taller_usuarios1_idx` (`idusuario`),
  KEY `fk_comentarios_taller_talleres1_idx` (`idtaller`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contenidos`
--

CREATE TABLE IF NOT EXISTS `contenidos` (
  `id` int(11) NOT NULL,
  `state_contenido` enum('active','inactive') NOT NULL DEFAULT 'active',
  `titulo` varchar(45) DEFAULT NULL,
  `texto` text,
  `observacion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contenidos_ejercicio`
--

CREATE TABLE IF NOT EXISTS `contenidos_ejercicio` (
  `contenidos_id` int(11) NOT NULL,
  `state_ce` enum('active','inactive') NOT NULL DEFAULT 'active',
  `ejercicios_id` int(11) NOT NULL,
  PRIMARY KEY (`contenidos_id`,`ejercicios_id`),
  KEY `fk_contenidos_has_ejercicios_ejercicios1` (`ejercicios_id`),
  KEY `fk_contenidos_has_ejercicios_contenidos1` (`contenidos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contenidos_talleres`
--

CREATE TABLE IF NOT EXISTS `contenidos_talleres` (
  `contenidos_id` int(11) NOT NULL,
  `talleres_idtalleres` int(11) NOT NULL,
  PRIMARY KEY (`contenidos_id`,`talleres_idtalleres`),
  KEY `fk_contenidos_has_talleres_talleres1_idx` (`talleres_idtalleres`),
  KEY `fk_contenidos_has_talleres_contenidos1_idx` (`contenidos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_curso` enum('active','inactive') NOT NULL DEFAULT 'active',
  `id_docente` int(11) DEFAULT NULL,
  `idmateria` int(11) NOT NULL,
  `nombre_curso` varchar(45) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `canvas` enum('si','no') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cursos_docentes1` (`id_docente`),
  KEY `fk_cursos_materias1_idx` (`idmateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cursos_evaluaciones`
--

CREATE TABLE IF NOT EXISTS `cursos_evaluaciones` (
  `cursos_id` int(11) NOT NULL,
  `evaluaciones_id` int(11) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `porcentaje` decimal(10,0) DEFAULT NULL COMMENT 'este es el porcentaje del examen con relacion al curso',
  `tiempo_limite` time DEFAULT NULL,
  PRIMARY KEY (`cursos_id`,`evaluaciones_id`),
  KEY `fk_cursos_has_evaluaciones_evaluaciones1_idx` (`evaluaciones_id`),
  KEY `fk_cursos_has_evaluaciones_cursos1_idx` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cursos_has_tema`
--

CREATE TABLE IF NOT EXISTS `cursos_has_tema` (
  `cursos_id` int(11) NOT NULL,
  `tema_idtema` int(11) NOT NULL,
  PRIMARY KEY (`cursos_id`,`tema_idtema`),
  KEY `fk_cursos_has_tema_tema1_idx` (`tema_idtema`),
  KEY `fk_cursos_has_tema_cursos1_idx` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cursos_juego`
--

CREATE TABLE IF NOT EXISTS `cursos_juego` (
  `cursos_id` int(11) NOT NULL,
  `juego_idjuego` int(11) NOT NULL,
  PRIMARY KEY (`cursos_id`,`juego_idjuego`),
  KEY `fk_cursos_has_juego_juego1_idx` (`juego_idjuego`),
  KEY `fk_cursos_has_juego_cursos1_idx` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cursos_talleres`
--

CREATE TABLE IF NOT EXISTS `cursos_talleres` (
  `cursos_id` int(11) NOT NULL,
  `talleres_idtalleres` int(11) NOT NULL,
  PRIMARY KEY (`cursos_id`,`talleres_idtalleres`),
  KEY `fk_cursos_has_talleres_talleres1_idx` (`talleres_idtalleres`),
  KEY `fk_cursos_has_talleres_cursos1_idx` (`cursos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ejercicios`
--

CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `state_ejercicios` enum('active','inactive') NOT NULL DEFAULT 'active',
  `ejercicio` varchar(45) NOT NULL,
  `solucion` varchar(45) NOT NULL,
  `dificultada` int(3) NOT NULL COMMENT 'Esta tabla permite ingresase a una ecuación su grado de dificultad ',
  `valoracion_porcentaje` varchar(45) NOT NULL,
  `estado_correccion` enum('correcto','sin revision','errado') DEFAULT NULL,
  `idtema` int(11) DEFAULT NULL,
  `idusuariocreador` int(11) DEFAULT NULL,
  `IdDocente` int(11) DEFAULT NULL COMMENT 'cunado el creador del ejercicio es el docente, el creador y el iddocente es el mismo.',
  PRIMARY KEY (`id_ejercicio`),
  KEY `fk_ejercicios_tema1_idx` (`idtema`),
  KEY `fk_ejercicios_usuarios1_idx` (`idusuariocreador`),
  KEY `fk_ejercicios_usuarios2_idx` (`IdDocente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ejercicios_Ecuaciones`
--

CREATE TABLE IF NOT EXISTS `Ejercicios_Ecuaciones` (
  `ejercicios_id` int(11) NOT NULL,
  `state_ee` enum('active','inactive') NOT NULL DEFAULT 'active',
  `Ecuaciones_id_ecuacion` int(11) NOT NULL,
  PRIMARY KEY (`ejercicios_id`,`Ecuaciones_id_ecuacion`),
  KEY `fk_ejercicios_has_Ecuaciones_Ecuaciones1` (`Ecuaciones_id_ecuacion`),
  KEY `fk_ejercicios_has_Ecuaciones_ejercicios1` (`ejercicios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ejercicios_evaluaciones`
--

CREATE TABLE IF NOT EXISTS `ejercicios_evaluaciones` (
  `ejercicios_id_ejercicio` int(11) NOT NULL,
  `evaluaciones_id` int(11) NOT NULL,
  PRIMARY KEY (`ejercicios_id_ejercicio`,`evaluaciones_id`),
  KEY `fk_ejercicios_has_evaluaciones_evaluaciones1_idx` (`evaluaciones_id`),
  KEY `fk_ejercicios_has_evaluaciones_ejercicios1_idx` (`ejercicios_id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ejercicios_RespuestaEjercicio`
--

CREATE TABLE IF NOT EXISTS `ejercicios_RespuestaEjercicio` (
  `ejercicios_id_ejercicio` int(11) NOT NULL,
  `RespuestaEjercicio_idRespuestaEjercicio` int(11) NOT NULL,
  PRIMARY KEY (`ejercicios_id_ejercicio`,`RespuestaEjercicio_idRespuestaEjercicio`),
  KEY `fk_ejercicios_has_RespuestaEjercicio_RespuestaEjercicio1_idx` (`RespuestaEjercicio_idRespuestaEjercicio`),
  KEY `fk_ejercicios_has_RespuestaEjercicio_ejercicios1_idx` (`ejercicios_id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ejercicios_talleres`
--

CREATE TABLE IF NOT EXISTS `ejercicios_talleres` (
  `ejercicios_id_ejercicio` int(11) NOT NULL,
  `talleres_idtalleres` int(11) NOT NULL,
  PRIMARY KEY (`ejercicios_id_ejercicio`,`talleres_idtalleres`),
  KEY `fk_ejercicios_has_talleres_talleres1_idx` (`talleres_idtalleres`),
  KEY `fk_ejercicios_has_talleres_ejercicios1_idx` (`ejercicios_id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluaciones`
--

CREATE TABLE IF NOT EXISTS `evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_evalucaciones` enum('active','inactive') NOT NULL DEFAULT 'active',
  `porcentaje` float NOT NULL,
  `tiempo_limite` int(11) NOT NULL,
  `competencia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `evalucacion_integrante`
--

CREATE TABLE IF NOT EXISTS `evalucacion_integrante` (
  `id_evaluacion` int(11) NOT NULL,
  `state_evalucacion_integrante` enum('active','inactive') NOT NULL DEFAULT 'active',
  `id_integrante_curso` varchar(45) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`,`id_integrante_curso`),
  KEY `fk_evalucacion_integrante_integrantes_curso1` (`id_integrante_curso`),
  KEY `fk_evalucacion_integrante_evaluaciones1` (`id_evaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `img_videos_sonido`
--

CREATE TABLE IF NOT EXISTS `img_videos_sonido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_img_videos` enum('active','inactive') NOT NULL DEFAULT 'active',
  `url` varchar(100) DEFAULT NULL,
  `nombre` text,
  `type` enum('img','video','sonido') NOT NULL,
  `descripcion` text,
  `idUsiario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_img_videos_sonido_usuarios1_idx` (`idUsiario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `img_videos_sonido_contenidos`
--

CREATE TABLE IF NOT EXISTS `img_videos_sonido_contenidos` (
  `img_videos_id` int(11) NOT NULL,
  `contenidos_id` int(11) NOT NULL,
  `state_video_has_contenidos` enum('active','inactive') NOT NULL DEFAULT 'active',
  `contenidos_tipo_contenido_id` int(11) NOT NULL,
  PRIMARY KEY (`img_videos_id`,`contenidos_id`,`contenidos_tipo_contenido_id`),
  KEY `fk_img_videos_has_contenidos_contenidos1_idx` (`contenidos_id`,`contenidos_tipo_contenido_id`),
  KEY `fk_img_videos_has_contenidos_img_videos1_idx` (`img_videos_id`),
  KEY `fk_img_videos_has_contenidos_contenidos1_idx1` (`contenidos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `integrantes_curso`
--

CREATE TABLE IF NOT EXISTS `integrantes_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_integrantes_curso` enum('active','inactive','penddocente','pendalumno') NOT NULL DEFAULT 'active',
  `cursos_id` int(11) NOT NULL,
  `id_integrante` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`,`cursos_id`,`id_integrante`),
  KEY `fk_usuarios_has_cursos_cursos1` (`cursos_id`),
  KEY `fk_integrantes_curso_usuarios1` (`id_integrante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `juego`
--

CREATE TABLE IF NOT EXISTS `juego` (
  `idjuego` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `dir_servidor` varchar(45) NOT NULL,
  PRIMARY KEY (`idjuego`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `idmaterias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(45) DEFAULT NULL,
  `state_materia` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`idmaterias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `materias_docente`
--

CREATE TABLE IF NOT EXISTS `materias_docente` (
  `materias_idmaterias` int(11) NOT NULL,
  `usuarios_id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`materias_idmaterias`,`usuarios_id_usuario`),
  KEY `fk_materias_has_usuarios_usuarios1_idx` (`usuarios_id_usuario`),
  KEY `fk_materias_has_usuarios_materias1_idx` (`materias_idmaterias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `state_perfiles` enum('active','inactive') NOT NULL DEFAULT 'active',
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `state_perfiles`, `nombre`) VALUES
(4, 'active', 'Docente'),
(5, 'active', 'Estudiante'),
(6, 'active', 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_permisos` enum('active','inactive') NOT NULL DEFAULT 'active',
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `state_permisos`, `nombre`) VALUES
(1, 'active', 'insertar usuario'),
(2, 'active', 'seleccionar usario'),
(3, 'active', 'eliminar usuario');

-- --------------------------------------------------------

--
-- Table structure for table `permisos_perfil`
--

CREATE TABLE IF NOT EXISTS `permisos_perfil` (
  `perfiles_id` int(11) NOT NULL,
  `state_permisos_perfil` enum('active','inactive') NOT NULL DEFAULT 'active',
  `permisos_id` int(11) NOT NULL,
  PRIMARY KEY (`perfiles_id`,`permisos_id`),
  KEY `fk_perfiles_has_permisos_permisos1` (`permisos_id`),
  KEY `fk_perfiles_has_permisos_perfiles1` (`perfiles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permisos_perfil`
--

INSERT INTO `permisos_perfil` (`perfiles_id`, `state_permisos_perfil`, `permisos_id`) VALUES
(4, 'active', 1),
(4, 'active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Profesion`
--

CREATE TABLE IF NOT EXISTS `Profesion` (
  `id_profesion` int(5) NOT NULL AUTO_INCREMENT,
  `state_profesion` enum('active','inactive') NOT NULL DEFAULT 'active',
  `descripcion` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_profesion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `RespuestaEjercicio`
--

CREATE TABLE IF NOT EXISTS `RespuestaEjercicio` (
  `idRespuestaEjercicio` int(11) NOT NULL,
  `respuesta_ejercicio` varchar(45) NOT NULL,
  `ordenposicion` enum('a','b','c','d','f') NOT NULL,
  `idContenido` int(11) DEFAULT NULL COMMENT 'SI a la respuesta se le desea indexar algun contenido que haga mas explicativa la respuesta.\n',
  `es_verdadero` enum('v','f') DEFAULT NULL,
  PRIMARY KEY (`idRespuestaEjercicio`),
  KEY `fk_RespuestaEjercicio_contenidos1_idx` (`idContenido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Respuestas_evaluado`
--

CREATE TABLE IF NOT EXISTS `Respuestas_evaluado` (
  `ejercicios_id_ejercicio` int(11) NOT NULL,
  `evalucacion_integrante_id_evaluacion` int(11) NOT NULL,
  `evalucacion_integrante_id_integrante_curso` varchar(45) NOT NULL,
  `respuesta_ejercicio` varchar(45) DEFAULT NULL,
  `es_verdadero` enum('v','f') DEFAULT NULL,
  `posicionrespuesta` enum('a','b','c','d','f') DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`ejercicios_id_ejercicio`,`evalucacion_integrante_id_evaluacion`,`evalucacion_integrante_id_integrante_curso`),
  KEY `fk_ejercicios_has_evalucacion_integrante_evalucacion_integr_idx` (`evalucacion_integrante_id_evaluacion`,`evalucacion_integrante_id_integrante_curso`),
  KEY `fk_ejercicios_has_evalucacion_integrante_ejercicios1_idx` (`ejercicios_id_ejercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `talleres`
--

CREATE TABLE IF NOT EXISTS `talleres` (
  `idtalleres` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idtalleres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE IF NOT EXISTS `tema` (
  `idtema` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `idmateria` int(11) NOT NULL,
  PRIMARY KEY (`idtema`),
  KEY `fk_tema_materias1_idx` (`idmateria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tema_contenidos`
--

CREATE TABLE IF NOT EXISTS `tema_contenidos` (
  `tema_idtema` int(11) NOT NULL,
  `contenidos_id` int(11) NOT NULL,
  PRIMARY KEY (`tema_idtema`,`contenidos_id`),
  KEY `fk_tema_has_contenidos_contenidos1_idx` (`contenidos_id`),
  KEY `fk_tema_has_contenidos_tema1_idx` (`tema_idtema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tema_evaluaciones`
--

CREATE TABLE IF NOT EXISTS `tema_evaluaciones` (
  `tema_idtema` int(11) NOT NULL,
  `evaluaciones_id` int(11) NOT NULL,
  PRIMARY KEY (`tema_idtema`,`evaluaciones_id`),
  KEY `fk_tema_has_evaluaciones_evaluaciones1_idx` (`evaluaciones_id`),
  KEY `fk_tema_has_evaluaciones_tema1_idx` (`tema_idtema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tema_talleres`
--

CREATE TABLE IF NOT EXISTS `tema_talleres` (
  `tema_idtema` int(11) NOT NULL,
  `talleres_idtalleres` int(11) NOT NULL,
  PRIMARY KEY (`tema_idtema`,`talleres_idtalleres`),
  KEY `fk_tema_has_talleres_talleres1_idx` (`talleres_idtalleres`),
  KEY `fk_tema_has_talleres_tema1_idx` (`tema_idtema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `universidad`
--

CREATE TABLE IF NOT EXISTS `universidad` (
  `id_universidad` int(5) NOT NULL AUTO_INCREMENT,
  `state_universidad` enum('active','inactive') NOT NULL DEFAULT 'active',
  `nombre_universidad` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_universidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `state_usuario` enum('active','inactive') NOT NULL DEFAULT 'active',
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `contrasena` varchar(40) DEFAULT NULL,
  `telefono` int(15) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `state_usuario`, `nombre`, `apellido1`, `apellido2`, `contrasena`, `telefono`, `celular`, `correo`) VALUES
(1, 'inactive', 'oscar', 'mesa', NULL, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 5804661, '3012280744', 'oscarmesa.elpoli@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_contenidos`
--

CREATE TABLE IF NOT EXISTS `usuarios_contenidos` (
  `usuarios_id_usuario` int(11) NOT NULL,
  `contenidos_id` int(11) NOT NULL,
  PRIMARY KEY (`usuarios_id_usuario`,`contenidos_id`),
  KEY `fk_usuarios_has_contenidos_contenidos1_idx` (`contenidos_id`),
  KEY `fk_usuarios_has_contenidos_usuarios1_idx` (`usuarios_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_perfiles`
--

CREATE TABLE IF NOT EXISTS `usuarios_perfiles` (
  `usuarios_id_usuario` int(11) NOT NULL,
  `perfiles_id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`usuarios_id_usuario`,`perfiles_id_perfil`),
  KEY `fk_usuarios_has_perfiles_perfiles1_idx` (`perfiles_id_perfil`),
  KEY `fk_usuarios_has_perfiles_usuarios1_idx` (`usuarios_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios_perfiles`
--

INSERT INTO `usuarios_perfiles` (`usuarios_id_usuario`, `perfiles_id_perfil`) VALUES
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_Profesion`
--

CREATE TABLE IF NOT EXISTS `usuarios_Profesion` (
  `id_usuario` int(11) NOT NULL,
  `Profesion_id_profesion` int(5) NOT NULL,
  PRIMARY KEY (`id_usuario`,`Profesion_id_profesion`),
  KEY `fk_usuarios_has_Profesion_Profesion1_idx` (`Profesion_id_profesion`),
  KEY `fk_usuarios_has_Profesion_usuarios1_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_universidades`
--

CREATE TABLE IF NOT EXISTS `usuario_universidades` (
  `id_usuario` int(11) NOT NULL,
  `state_uu` enum('active','inactive') NOT NULL DEFAULT 'active',
  `universidades_id` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`,`universidades_id`),
  KEY `fk_docentes_has_universidades_docentes1` (`id_usuario`),
  KEY `fk_usuario_universidades_universidad1` (`universidades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permisos_perfil`
--
ALTER TABLE `permisos_perfil`
  ADD CONSTRAINT `permisos_perfil_ibfk_1` FOREIGN KEY (`perfiles_id`) REFERENCES `perfiles` (`id_perfil`),
  ADD CONSTRAINT `permisos_perfil_ibfk_2` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id`);

--
-- Constraints for table `usuarios_perfiles`
--
ALTER TABLE `usuarios_perfiles`
  ADD CONSTRAINT `usuarios_perfiles_ibfk_1` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_perfiles_ibfk_2` FOREIGN KEY (`perfiles_id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON UPDATE CASCADE;

--
-- Constraints for table `usuario_universidades`
--
ALTER TABLE `usuario_universidades`
  ADD CONSTRAINT `usuario_universidades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuario_universidades_ibfk_2` FOREIGN KEY (`universidades_id`) REFERENCES `universidad` (`id_universidad`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;