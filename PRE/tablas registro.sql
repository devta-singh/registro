CREATE TABLE interesados (
	id_interesado int not null primary key auto_increment,
	nombre varchar(255) not null default '',
	apellidos varchar(255) null default '',
	nick varchar(255) null default '',
	email varchar(255) not null,
	email_verificado_cuando datetime null,
	email_clave varchar(255) null,

	telefono1 varchar(255) null,
	telefono2 varchar(255) null,

	clave varchar(255) null,
	alta datetime null,
	ultimo timestamp not null default CURRENT_TIMESTAMP,
	estado enum('pendiente', 'verificado', 'activo', 'inactivo', 'bloqueado', 'cancelado', 'baja')
); 




CREATE TABLE roles (
	id_rol int not null primary key auto_increment,
	nombre varchar(255) not null unique key,
	valor int not null,
	descripcion text null,
	alta datetime null,
	ultimo timestamp null default CURRENT_TIMESTAMP,
	estado enum('pendiente', 'activo', 'inactivo', 'bloqueado', 'cancelado')
);

CREATE TABLE rol(
	id int not null primary key auto_increment,
	id_interesado int not null,
	id_rol int not null,
	alta datetime null
);




CREATE TABLE relacion (
	id_relacion int not null primary key auto_increment,
	relacion varchar(50) not null,
	tabla1 varchar(50) not null,
	campo1 varchar(50) not null,
	tabla2 varchar(50) not null,
	campo2 varchar(50) not null,
	descripcion varchar(255) null,
	descripcion_larga text null
);

CREATE TABLE relaciones (
	id_relacion int,
	id1 int not null,
	id2 int not null,
	alta datetime null,
	ultimo timestamp default CURRENT_TIMESTAMP  
);

