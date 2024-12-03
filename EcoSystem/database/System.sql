-- Create the Countries Table
CREATE TABLE `Countries` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `country_name` VARCHAR(255) NOT NULL,
  `country_code` VARCHAR(255) NOT NULL
);

-- Create the Cities Table
CREATE TABLE `Cities` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `city_name` VARCHAR(255) NOT NULL,
  `country_id` INTEGER,
  FOREIGN KEY (`country_id`) REFERENCES `Countries`(`id`)
);

-- Create the Station Types Table
CREATE TABLE `Station_Types` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `type_name` VARCHAR(255) NOT NULL
);

-- Create the Stations Table
CREATE TABLE `Stations` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `station_name` VARCHAR(255) NOT NULL,
  `station_type_id` INTEGER,
  `latitude` DECIMAL NOT NULL,
  `longitude` DECIMAL NOT NULL,
  `city_id` INTEGER,
  `neighborhood` VARCHAR(255),
  `capacity` INTEGER NOT NULL,
  `status` INTEGER NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `last_maintenance` TIMESTAMP,
  FOREIGN KEY (`station_type_id`) REFERENCES `Station_Types`(`id`),
  FOREIGN KEY (`city_id`) REFERENCES `Cities`(`id`)
);

-- Create the Operational Hours Table
CREATE TABLE `Operational_Hours` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `station_id` INTEGER,
  `day_of_week` INTEGER NOT NULL,
  `open_time` TIME NOT NULL,
  `close_time` TIME NOT NULL,
  FOREIGN KEY (`station_id`) REFERENCES `Stations`(`id`)
);

-- Create the Vehicle Types Table
CREATE TABLE `Vehicle_Types` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `type_name` VARCHAR(255) NOT NULL,
  `cost` DECIMAL NOT NULL
);

-- Create the Manufacturers Table
CREATE TABLE `Manufacturers` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL
);

-- Create the Models Table
CREATE TABLE `Models` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `manufacturer_id` INTEGER,
  `model_name` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`manufacturer_id`) REFERENCES `Manufacturers`(`id`)
);

-- Create the Vehicles Table
CREATE TABLE `Vehicles` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `station_id` INTEGER,
  `vehicle_type_id` INTEGER,
  `model_id` INTEGER,
  `battery_capacity` DECIMAL NOT NULL,
  `status` INTEGER NOT NULL,
  `mileage` DECIMAL NOT NULL,
  `emission_rate` DECIMAL NOT NULL,
  `last_maintenance` DATE,
  `acquisition_date` DATE NOT NULL,
  `last_usage` TIMESTAMP,
  FOREIGN KEY (`station_id`) REFERENCES `Stations`(`id`),
  FOREIGN KEY (`vehicle_type_id`) REFERENCES `Vehicle_Types`(`id`),
  FOREIGN KEY (`model_id`) REFERENCES `Models`(`id`)
);

-- Create the Membership Types Table
CREATE TABLE `Membership_Types` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `type_name` VARCHAR(255) NOT NULL
);

-- Create the Genders Table
CREATE TABLE `Genders` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `gender_name` VARCHAR(255) NOT NULL
);

-- Create the Modes Table
CREATE TABLE `Modes` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `mode_name` VARCHAR(255) NOT NULL
);

-- Create the Users Table
CREATE TABLE `Users` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `registration_date` TIMESTAMP NOT NULL,
  `membership_type_id` INTEGER,
  `gender_id` INTEGER,
  `city_id` INTEGER,
  `age` INTEGER NOT NULL,
  FOREIGN KEY (`membership_type_id`) REFERENCES `Membership_Types`(`id`),
  FOREIGN KEY (`gender_id`) REFERENCES `Genders`(`id`),
  FOREIGN KEY (`city_id`) REFERENCES `Cities`(`id`)
);

-- Create the Payment Info Table
CREATE TABLE `Payment_Info` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER,
  `payment_method` VARCHAR(255) NOT NULL,
  `card_number` VARCHAR(255),
  `billing_address` VARCHAR(255),
  FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`)
);

-- Create the User Preferred Modes Table
CREATE TABLE `User_Preferred_Modes` (
  `user_id` INTEGER,
  `mode_id` INTEGER,
  PRIMARY KEY (`user_id`, `mode_id`),
  FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`),
  FOREIGN KEY (`mode_id`) REFERENCES `Modes`(`id`)
);

-- Create the Rentals Table
CREATE TABLE `Rentals` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER,
  `vehicle_id` INTEGER,
  `start_station_id` INTEGER,
  `end_station_id` INTEGER,
  `start_time` TIMESTAMP NOT NULL,
  `end_time` TIMESTAMP,
  `distance_travelled` DECIMAL,
  `emission_saved` DECIMAL,
  FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicles`(`id`),
  FOREIGN KEY (`start_station_id`) REFERENCES `Stations`(`id`),
  FOREIGN KEY (`end_station_id`) REFERENCES `Stations`(`id`)
);

-- Create the Environment Table
CREATE TABLE `Environment` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `city_id` INTEGER,
  `record_time` TIMESTAMP NOT NULL,
  `average_emission_reduction` DECIMAL,
  `average_energy_savings` DECIMAL,
  FOREIGN KEY (`city_id`) REFERENCES `Cities`(`id`)
);

-- Create the Vehicle Emission Data Table
CREATE TABLE `Vehicle_Emission_Data` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `environment_id` INTEGER,
  `vehicle_id` INTEGER,
  `emission_rate` DECIMAL NOT NULL,
  FOREIGN KEY (`environment_id`) REFERENCES `Environment`(`id`),
  FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicles`(`id`)
);

-- Create the Traffic Table
CREATE TABLE `Traffic` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `city_id` INTEGER,
  `congestion_level` INTEGER NOT NULL,
  `date` TIMESTAMP NOT NULL,
  `accidents_count` INTEGER,
  FOREIGN KEY (`city_id`) REFERENCES `Cities`(`id`)
);

-- Create the Peak Hours Table
CREATE TABLE `Peak_Hours` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `traffic_id` INTEGER,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  FOREIGN KEY (`traffic_id`) REFERENCES `Traffic`(`id`)
);
