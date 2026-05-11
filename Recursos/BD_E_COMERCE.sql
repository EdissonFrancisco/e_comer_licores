CREATE DATABASE e_comerce;

USE e_comerce;

CREATE TABLE IF NOT EXISTS cliente(
	idCliente INT NOT NULL AUTO_INCREMENT,    
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    nit_cc int not null,
	direccion varchar(50) not null,
    correo varchar(100) not null,
    clave varchar(200) not null,
    estado int,
    primary key (idCliente)
); 

CREATE TABLE IF NOT EXISTS telCliente(
	idTelCli INT NOT NULL AUTO_INCREMENT,
    idCliente int NOT NULl,
    telefono BIGINT NOT NULl,
    PRIMARY KEY (idTelCli),
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
);

CREATE TABLE IF NOT EXISTS marca(
	idMarca INT NOT NULL AUTO_INCREMENT,
    nombre varchar(100) NOT NULl,
    descripcion varchar(500) NOT NULl,
    PRIMARY KEY (idMarca)
);

CREATE TABLE IF NOT EXISTS tipoLicor(
	idTipoLicor INT NOT NULL AUTO_INCREMENT,
    nombre varchar(100) NOT NULl,
    descripcion varchar(500) NOT NULl,
    PRIMARY KEY (idTipoLicor)
);

CREATE TABLE IF NOT EXISTS producto(
	idProducto INT NOT NULL AUTO_INCREMENT,
    idMarca INT NOT NULL,
    idTipoLicor INT NOT NULL,
    nombre varchar(100) NOT NULl,
    foto varchar(500) NOT NULl,
    valorUnidad INT NOT NULl,
    inventario INT NOT NULL,
    estado int,
    PRIMARY KEY (idProducto),
    FOREIGN KEY (idMarca) REFERENCES marca (idMarca),
    FOREIGN KEY (idTipoLicor) REFERENCES tipoLicor (idTipoLicor)
);

CREATE TABLE IF NOT EXISTS administrador(
	idAdministrador int not null AUTO_INCREMENT,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    nit_cc int not null,
	direccion varchar(50) not null,
    correo varchar(100) not null,
    clave varchar(200) not null,
    primary key (idAdministrador)
);

CREATE TABLE IF NOT EXISTS domiciliario(
	idDomiciliario int not null AUTO_INCREMENT,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    nit_cc int not null,
	direccion varchar(50) not null,
    correo varchar(100) not null,
    clave varchar(200) not null,
    estado int,
    primary key (idDomiciliario)
);

CREATE TABLE IF NOT EXISTS orden(
	idOrden INT NOT NULL AUTO_INCREMENT,
    idProducto INT NOT NULL,
    idCliente INT NOT NULL,
    unidades INT NOT NULl,
    precioUnidad BIGINT NOT NULL,
    subTotal BIGINT NOT NULL,
    numOrden INT NOT NULL,
    PRIMARY KEY (idOrden),
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto),
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
);

/* Encabezado de compra; numOrden enlaza las filas de la tabla orden del mismo pedido */
CREATE TABLE IF NOT EXISTS factura(
	idFactura INT NOT NULL AUTO_INCREMENT,
    idCliente INT NOT NULL,
    fecha VARCHAR(20) NOT NULL,
    hora VARCHAR(20) NOT NULL,
    tipoEntrega VARCHAR(50) NOT NULL,
    numOrden INT NOT NULL,
    estadoEntrega INT NOT NULL DEFAULT 0,
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente),
    PRIMARY KEY (idFactura)
);

CREATE TABLE IF NOT EXISTS carrito(
	idCarrito INT NOT NULL AUTO_INCREMENT,
    idProducto INT NOT NULL,
    idCliente int not null,
    cantidad BIGINT NOT NULl,
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto),    
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente),
    PRIMARY KEY (idCarrito)
);

CREATE TABLE IF NOT EXISTS logAdmin(
	idLogAdmin INT NOT NULL AUTO_INCREMENT,
    idAdministrador INT NOT NULL,
	horaIngreso time NOT NULL,
    fechaIngreso date NOT NULl,
    aciones varchar(500) NOT NULl,
    FOREIGN KEY (idAdministrador) REFERENCES administrador (idAdministrador),
    PRIMARY KEY (idLogAdmin)
);

CREATE TABLE IF NOT EXISTS domicilio(
	idDomicilio INT NOT NULL AUTO_INCREMENT,
    idDomiciliario int not null,
    idCliente INT NOT NULL,
    idFactura INT NOT NULL,
	estadoEntrega INT NOT NULL,
    obserbaciones VARCHAR(300) NOT NULl,
    FOREIGN KEY (idDomiciliario) REFERENCES domiciliario (idDomiciliario),
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente),
    FOREIGN KEY (idFactura) REFERENCES factura (idFactura),
    PRIMARY KEY (idDomicilio)
);


/* no incluidas fallas de logica */
CREATE TABLE IF NOT EXISTS productoMarca(
	idProducto INT NOT NULL,
    idMarca INT NOT NULL,    
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto),
    FOREIGN KEY (idMarca) REFERENCES marca (idMarca),
    PRIMARY KEY (idProducto, idMarca)
);

CREATE TABLE IF NOT EXISTS productoLicor(
	idProducto INT NOT NULL,
    idTipoLicor INT NOT NULL,
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto),
    FOREIGN KEY (idTipoLicor) REFERENCES tipoLicor (idTipoLicor),
    PRIMARY KEY (idProducto, idTipoLicor)
);
