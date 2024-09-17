CREATE DATABASE SistemaVentasBoletos;
USE SistemaVentasBoletos;

CREATE TABLE Usuarios (
    ID_Usuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Apellido VARCHAR(255),
    CorreoElectronico VARCHAR(255),
    Contrasena VARCHAR(255),
    DireccionHabitacion VARCHAR(255)
);

CREATE TABLE Viajes (
    ID_Viaje INT PRIMARY KEY AUTO_INCREMENT,
    Origen VARCHAR(255),
    Destino VARCHAR(255),
    Fecha DATE,
    Hora TIME,
    Precio DECIMAL(10, 2),
    CupoDisponible INT,
    PorcentajeDescuento DECIMAL(5, 2)
);

CREATE TABLE Autobuses (
    ID_Autobus INT PRIMARY KEY AUTO_INCREMENT,
    NumeroAutobus VARCHAR(255),
    Capacidad INT
);

CREATE TABLE Boletos (
    ID_Boleto INT PRIMARY KEY AUTO_INCREMENT,
    ID_Usuario INT,
    ID_Viaje INT,
    ID_Autobus INT,
    NumeroAsiento INT,
    FechaCompra DATE,
    EstadoBoleto VARCHAR(255),
    MontoTotal DECIMAL(10, 2),
    PorcentajeDescuento DECIMAL(5, 2),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios(ID_Usuario),
    FOREIGN KEY (ID_Viaje) REFERENCES Viajes(ID_Viaje),
    FOREIGN KEY (ID_Autobus) REFERENCES Autobuses(ID_Autobus)
);

CREATE TABLE Descuento (
    Id_Descuento INT PRIMARY KEY AUTO_INCREMENT,
    Id_Viaje INT,
    DescripcionDescuento VARCHAR(255),
    PorcentajeDescuento DECIMAL(5, 2),
    TotalCosto DECIMAL(10, 2),
    FOREIGN KEY (Id_Viaje) REFERENCES Viajes(ID_Viaje)
);

