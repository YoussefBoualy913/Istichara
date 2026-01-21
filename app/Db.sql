CREATE TABLE istichara;
use istichara;

CREATE TABLE ville (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL unique
);

CREATE TABLE avocat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    ville_id INT,
    years_of_experience INT,
    specialite ENUM('Droitpénal', 'civil', 'famille', 'affaires') NOT NULL,
    consoltation_en_ligne bool,
    FOREIGN KEY (ville_id) REFERENCES ville(id)
);

CREATE TABLE huissier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    ville_id INT,
    years_of_experience INT,
    types_actes ENUM('Signification', 'exécution', 'constats') NOT NULL,
    FOREIGN KEY (ville_id) REFERENCES ville(id)
);

