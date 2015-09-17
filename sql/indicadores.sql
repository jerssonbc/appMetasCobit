CREATE TABLE IF NOT EXISTS `indicador`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `formula` int(11) NULL,
  `lineaBase` varchar(50)  NULL,
  `valorMeta` varchar(50)  NULL,
  `Frecuencia` varchar(50) NULL,
  `rojo` varchar(50) NULL,
  `amarillo` varchar(50) NULL,
  `verde` varchar(50) NULL,
  `proceso_id` int(11) NOT NULL,
  `created_at` timestamp  NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp  NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `objetivos`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp  NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp  NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);



INSERT INTO `procesos`.`indicador` (`id`, `nombre`, `codigo`, `unidad`, `responsable`, `formula`, `lineaBase`, `valorMeta`, `Frecuencia`, `rojo`, `amarillo`, `verde`, `proceso_id`, `created_at`, `updated_at`) VALUES 
(NULL, 'Calidad de materia prima recepcionada', '10002', '%', 'Jefe de Calidad', '10003', '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', '304', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(NULL, 'Cumplimiento de especificaciones', '10003', '%', 'Jefe de Calidad', '10003', '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', '304', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(NULL, 'Botellas sin deficiencia', '10001', '%', 'Jefe de Calidad', '304', '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', '304', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(NULL, 'Botellas sin deficiencia', '10001', '%', 'Jefe de Calidad', '304', '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', '304', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(NULL, 'Botellas sin deficiencia', '10001', '%', 'Jefe de Calidad', '304', '90%', 'Mas del 99%', 'Diario', '<90%', '90-80%', '>98%', '304', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),