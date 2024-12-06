-- Create ChargerTypes Table
CREATE TABLE ChargerTypes (
    ID INT PRIMARY KEY,
    Type VARCHAR(10),
    SubType VARCHAR(10)
);

-- Insert values into ChargerTypes
INSERT INTO ChargerTypes (ID, Type, SubType) VALUES
(1, 'AC', 'Type 1'),
(2, 'AC', 'Type 2'),
(3, 'DC', 'CCS'),
(4, 'DC', 'CHAdeMO');

-- Create Countries Table
CREATE TABLE Countries (
    ID INT PRIMARY KEY,
    CountryName VARCHAR(50)
);

-- Insert values into Countries
INSERT INTO Countries (ID, CountryName) VALUES
(1, 'Norvégia'),
(2, 'Olaszország'),
(3, 'Magyarország'),
(4, 'Németország'),
(5, 'Bulgária'),
(6, 'Románia');

-- Create FossilFuelExpenditures Table
CREATE TABLE FossilFuelExpenditures (
    ID INT PRIMARY KEY,
    CountryID INT,
    Year INT,
    DieselExpenditure DECIMAL(15,2),
    GasolineExpenditure DECIMAL(15,2),
    FOREIGN KEY (CountryID) REFERENCES Countries(ID)
);

-- Insert values into FossilFuelExpenditures
INSERT INTO FossilFuelExpenditures (ID, CountryID, Year, DieselExpenditure, GasolineExpenditure) VALUES
(1, 1, 2023, 50000000.00, 40000000.00),
(2, 2, 2023, 60000000.00, 45000000.00),
(3, 3, 2023, 35000000.00, 32000000.00),
(4, 4, 2023, 70000000.00, 60000000.00),
(5, 5, 2023, 20000000.00, 18000000.00),
(6, 6, 2023, 25000000.00, 22000000.00);

-- Create EVChargingEnergyUsage Table
CREATE TABLE EVChargingEnergyUsage (
    ID INT PRIMARY KEY,
    CountryID INT,
    Year INT,
    EnergyUsed DECIMAL(15,2), -- in kWh
    FOREIGN KEY (CountryID) REFERENCES Countries(ID)
);

-- Insert values into EVChargingEnergyUsage
INSERT INTO EVChargingEnergyUsage (ID, CountryID, Year, EnergyUsed) VALUES
(1, 1, 2023, 8000000.00),
(2, 2, 2023, 5000000.00),
(3, 3, 2023, 3000000.00),
(4, 4, 2023, 12000000.00),
(5, 5, 2023, 2500000.00),
(6, 6, 2023, 4000000.00);

-- Create EVChargingStations Table
CREATE TABLE EVChargingStations (
    ID INT PRIMARY KEY,
    CountryID INT,
    ChargerTypeID INT,
    Location VARCHAR(100),
    YearInstalled INT,
    FOREIGN KEY (CountryID) REFERENCES Countries(ID),
    FOREIGN KEY (ChargerTypeID) REFERENCES ChargerTypes(ID)
);

-- Insert values into EVChargingStations
INSERT INTO EVChargingStations (ID, CountryID, ChargerTypeID, Location, YearInstalled) VALUES
(1, 1, 3, 'Oslo, City Center', 2022),
(2, 2, 1, 'Rome, Via Nazionale', 2021),
(3, 3, 2, 'Budapest, Andrassy Avenue', 2023),
(4, 4, 4, 'Berlin, Alexanderplatz', 2022),
(5, 5, 3, 'Sofia, Vitosha Boulevard', 2021),
(6, 6, 1, 'Bucharest, Piata Universitatii', 2022);

-- Create VehicleTypes Table
CREATE TABLE VehicleTypes (
    ID INT PRIMARY KEY,
    CountryID INT,
    DieselPercentage INT,
    GasolinePercentage INT,
    ElectricPercentage INT,
    HybridPercentage INT,
    FOREIGN KEY (CountryID) REFERENCES Countries(ID)
);

-- Insert values into VehicleTypes
INSERT INTO VehicleTypes (ID, CountryID, DieselPercentage, GasolinePercentage, ElectricPercentage, HybridPercentage) VALUES
(1, 1, 10, 20, 50, 20),
(2, 2, 30, 40, 10, 20),
(3, 3, 25, 35, 15, 25),
(4, 4, 20, 30, 25, 25),
(5, 5, 40, 40, 5, 15),
(6, 6, 35, 45, 8, 12);
