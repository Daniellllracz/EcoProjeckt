-- Töltők típusai tábla létrehozása
CREATE TABLE ChargerTypes (
    ID INT PRIMARY KEY,
    Type VARCHAR(10),
    SubType VARCHAR(10)
);

INSERT INTO ChargerTypes (ID, Type, SubType) VALUES
(1, 'AC', 'Type 1'),
(2, 'AC', 'Type 2'),
(3, 'DC', 'CCS'),
(4, 'DC', 'CHAdeMO');

-- Országok tábla létrehozása
CREATE TABLE Countries (
    ID INT PRIMARY KEY,
    CountryName VARCHAR(50)
);

INSERT INTO Countries (ID, CountryName) VALUES
(1, 'Norvégia'),
(2, 'Olaszország'),
(3, 'Magyarország'),
(4, 'Németország'),
(5, 'Bulgária'),
(6, 'Románia');

-- Járműtípusok tábla létrehozása
CREATE TABLE VehicleTypes (
    ID INT PRIMARY KEY,
    CountryID INT,
    DieselPercentage INT,
    GasolinePercentage INT,
    ElectricPercentage INT,
    HybridPercentage INT,
    FOREIGN KEY (CountryID) REFERENCES Countries(ID)
);

INSERT INTO VehicleTypes (ID, CountryID, DieselPercentage, GasolinePercentage, ElectricPercentage, HybridPercentage) VALUES
(1, 1, 10, 20, 50, 20),
(2, 2, 30, 40, 10, 20),
(3, 3, 25, 35, 15, 25),
(4, 4, 20, 30, 25, 25),
(5, 5, 40, 40, 5, 15),
(6, 6, 35, 45, 8, 12);
