-- Base de datos: acciones
CREATE DATABASE IF NOT EXISTS acciones DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE acciones;

-- Estructura de tabla para la tabla dep_departamento
CREATE TABLE dep_departamento (
  dep_id INT(11) NOT NULL COMMENT 'Llave principal del Departamento del sistema',
  dep_nombre VARCHAR(150) NOT NULL COMMENT 'Nombre del departamento',
  dep_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  dep_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  dep_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  dep_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  dep_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar los Departamento del sistema';

-- Estructura de tabla para la tabla ges_gestion
CREATE TABLE ges_gestion (
  ges_id INT(11) NOT NULL COMMENT 'Llave principal del registro de gestion',
  ges_id_mun INT(11) NOT NULL COMMENT 'Llave primaria del Municipio donde se realizara la gestion',
  ges_nombre VARCHAR(150) NOT NULL COMMENT 'Nombre de la gestion',
  ges_descripcion VARCHAR(500) DEFAULT NULL COMMENT 'Descripcion breve de la gestion',
  ges_tipo_gestion INT(11) NOT NULL COMMENT 'Tipo de gestion (1= Curso, 2= Evento y 3= Proyecto)',
  ges_fecha_inicio DATE NOT NULL COMMENT 'Fecha inicio de la gestion',
  ges_fecha_fin DATE NOT NULL COMMENT 'Fecha fin de la gestion',
  ges_num_benef INT(11) NOT NULL COMMENT 'Numero de beneficiarios de la gestion',
  ges_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  ges_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  ges_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  ges_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  ges_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar las diferentes gestiones a utilizar en';

-- --------------------------------------------------------
-- Estructura de tabla para la tabla mun_municipio
CREATE TABLE mun_municipio (
  mun_id INT(11) NOT NULL COMMENT 'Llave principal de los municipios',
  mun_id_dep INT(11) NOT NULL COMMENT 'Llave primaria del Departamento al que se le esta registrando el registro',
  mun_nombre VARCHAR(150) NOT NULL COMMENT 'Nombre del municipio',
  mun_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  mun_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  mun_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  mun_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  mun_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar los municipios disponibles en el sistema';

-- Estructura de tabla para la tabla per_persona
CREATE TABLE per_persona (
  per_id INT(11) NOT NULL COMMENT 'Llave principal del registro de persona',
  per_id_mun_residencia INT(11) NOT NULL COMMENT 'Llave primaria del Municipio de Residencia',
  per_primer_nombre VARCHAR(150) NOT NULL COMMENT 'Primer nombre de la persona',
  per_segundo_nombre VARCHAR(150) DEFAULT NULL COMMENT 'Segundo Nombre de la persona',
  per_tercer_nombre VARCHAR(150) DEFAULT NULL COMMENT 'Tercer nombre de la persona',
  per_primer_apellido VARCHAR(150) NOT NULL COMMENT 'Primer apellido de la persona',
  per_segundo_apellido VARCHAR(150) DEFAULT NULL COMMENT 'Segundo Apellido de la persona',
  per_apellido_casado VARCHAR(150) DEFAULT NULL COMMENT 'Apellido de caso de la persona',
  per_dui VARCHAR(25) DEFAULT NULL COMMENT 'Numero de documento de identidad',
  per_fecha_nacimiento DATE NOT NULL COMMENT 'Fecha de nacimiento de la persona',
  per_codigo_emp VARCHAR(25) DEFAULT NULL COMMENT 'Codigo de empleado que maneja la persona',
  per_direccion_residencia TEXT DEFAULT NULL COMMENT 'Direccion de residencia de la persona',
  per_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  per_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  per_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  per_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  per_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar las personas (Responsables y Empleados)';

-- Estructura de tabla para la tabla reg_responsablexgestion
CREATE TABLE reg_responsablexgestion (
  reg_id INT(11) NOT NULL COMMENT 'Llave principal del registro del responsable por gestion',
  reg_id_ges INT(11) NOT NULL COMMENT 'Llave primaria de la gestion a la que pertenece el repsonsable',
  reg_id_per INT(11) NOT NULL COMMENT 'Llave primaria de Persona',
  reg_cargo INT(11) DEFAULT NULL COMMENT 'Cargo que desempeñara en la gestion',
  reg_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  reg_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  reg_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  reg_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  reg_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar los responsables por cada gestion';

-- Estructura de tabla para la tabla usu_usuario
CREATE TABLE usu_usuario (
  usu_id INT(11) NOT NULL COMMENT 'Llave principal del Usuario del sistema',
  usu_id_per INT(11) NOT NULL COMMENT 'Llave primaria del Empleado a que le pertenece el usuario',
  usu_usuario VARCHAR(150) NOT NULL COMMENT 'Nombre del usuario que se manejara',
  usu_pass VARCHAR(500) NOT NULL COMMENT 'Contraseña para acceder al sistema',
  usu_rol INT(11) NOT NULL COMMENT 'Rol que manejara el usuario',
  usu_estado INT(11) NOT NULL COMMENT 'Estado del registro',
  usu_usu_creacion INT(11) NOT NULL COMMENT 'Auditoría',
  usu_usu_modificacion INT(11) NOT NULL COMMENT 'Auditoría',
  usu_fecha_creacion DATETIME NOT NULL COMMENT 'Auditoría',
  usu_fecha_modificacion DATETIME NOT NULL COMMENT 'Auditoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar los usuarios del sistema';




-- Indices para tablas volcadas

-- Indices de la tabla dep_departamento
ALTER TABLE dep_departamento
  ADD PRIMARY KEY (dep_id);

-- Indices de la tabla ges_gestion
ALTER TABLE ges_gestion
  ADD PRIMARY KEY (ges_id),
  ADD KEY fk_ges_id_mun (ges_id_mun);

-- Indices de la tabla mun_municipio
ALTER TABLE mun_municipio
  ADD PRIMARY KEY (mun_id),
  ADD KEY fk_mun_id_dep (mun_id_dep);

-- Indices de la tabla per_persona
ALTER TABLE per_persona
  ADD PRIMARY KEY (per_id),
  ADD KEY fk_per_id_mun_residencia (per_id_mun_residencia);

-- Indices de la tabla reg_responsablexgestion
ALTER TABLE reg_responsablexgestion
  ADD PRIMARY KEY (reg_id),
  ADD KEY fk_reg_id_ges (reg_id_ges),
  ADD KEY fk_reg_id_per (reg_id_per);

-- Indices de la tabla usu_usuario
ALTER TABLE usu_usuario
  ADD PRIMARY KEY (usu_id),
  ADD KEY fk_usu_id_per (usu_id_per);





-- Filtros para la tabla ges_gestion
ALTER TABLE ges_gestion
  ADD CONSTRAINT fk_ges_id_mun FOREIGN KEY (ges_id_mun) REFERENCES mun_municipio (mun_id);

-- Filtros para la tabla mun_municipio
ALTER TABLE mun_municipio
  ADD CONSTRAINT fk_mun_id_dep FOREIGN KEY (mun_id_dep) REFERENCES dep_departamento (dep_id);

-- Filtros para la tabla per_persona
ALTER TABLE per_persona
  ADD CONSTRAINT fk_per_id_mun_residencia FOREIGN KEY (per_id_mun_residencia) REFERENCES mun_municipio (mun_id);

-- Filtros para la tabla reg_responsablexgestion
ALTER TABLE reg_responsablexgestion
  ADD CONSTRAINT fk_reg_id_ges FOREIGN KEY (reg_id_ges) REFERENCES ges_gestion (ges_id),
  ADD CONSTRAINT fk_reg_id_per FOREIGN KEY (reg_id_per) REFERENCES per_persona (per_id);

-- Filtros para la tabla usu_usuario
ALTER TABLE usu_usuario
  ADD CONSTRAINT fk_usu_id_per FOREIGN KEY (usu_id_per) REFERENCES per_persona (per_id);


vmITCA2023
Gnulinux2023

