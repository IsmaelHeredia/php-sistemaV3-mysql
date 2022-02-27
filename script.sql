create table tipos_usuarios(
	id int not null auto_increment,
	nombre varchar(100),
	primary key(id)
);
create table usuarios(
	id int not null auto_increment,
	nombre varchar(100),
	clave varchar(100),
	id_tipo int,
	fecha_registro varchar(100),
	primary key(id),
	foreign key (id_tipo) references tipos_usuarios(id)
);
create table proveedores(
	id int not null auto_increment,
	nombre varchar(100),
	direccion varchar(100),
	telefono int,
	fecha_registro varchar(100),
	primary key(id)
);
create table productos(
	id int not null auto_increment,
	nombre varchar(100),
	descripcion varchar(100),
	precio double,
	id_proveedor int,
	fecha_registro varchar(100),
	primary key(id),
	foreign key (id_proveedor) references proveedores(id) 
);
create table imagenes(
	id int not null auto_increment,
	nombre varchar(100),
	tamaño int,
	id_producto int,
	fecha_registro varchar(100),
	identificador varchar(100),
	id_usuario int,
	primary key(id),
	foreign key (id_producto) references productos(id),
	foreign key (id_usuario) references usuarios(id)
);

insert into tipos_usuarios(nombre) values('Administrador');
insert into tipos_usuarios(nombre) values('Usuario');
insert into usuarios(nombre,clave,id_tipo,fecha_registro) 
	values('supervisor','$2y$10$nEV3yqmXxF5aFdozNbzxRuS6wKWA4rKqFEDJrNNjWIgX2jvXaMQoq',1,'2022-01-14');
insert into proveedores(nombre,direccion,telefono,fecha_registro) 
	values('empresa 1','calle 1',4975034,'2022-01-14');
insert into proveedores(nombre,direccion,telefono,fecha_registro) 
	values('empresa 2','calle 2',4646891,'2022-01-14');
insert into proveedores(nombre,direccion,telefono,fecha_registro) 
	values('empresa 3','calle 3',4646891,'2022-01-14');
insert into productos(nombre,descripcion,precio,id_proveedor,fecha_registro) 
	values('producto 1','descripción 1',200.20,1,'2022-01-14');
insert into productos(nombre,descripcion,precio,id_proveedor,fecha_registro) 
	values('producto 2','descripción 2',400,2,'2022-01-14');
insert into productos(nombre,descripcion,precio,id_proveedor,fecha_registro) 
	values('producto 3','descripción 3',500.55,3,'2022-01-14');
insert into productos(nombre,descripcion,precio,id_proveedor,fecha_registro) 
	values('producto 4','descripción 4',250,2,'2022-01-14');
insert into productos(nombre,descripcion,precio,id_proveedor,fecha_registro) 
	values('producto 5','descripción 5',750,3,'2022-01-14');