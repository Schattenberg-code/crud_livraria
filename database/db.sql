
CREATE DATABASE livraria_lucasa_m2;
USE livraria_lucasa_m2;

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100)NOT NULL,
    ano INT NOT NULL
);