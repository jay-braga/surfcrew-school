DROP DATABASE IF EXISTS SURF;

CREATE DATABASE SURF;

USE SURF;

CREATE TABLE Utilizadores(
    IdUtilizador INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(150) NOT NULL,
    DataNascimento  DATE NOT NULL,
    DocumentoIdentificacao VARCHAR(20) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL,
    Senha VARCHAR(12) NOT NULL,
    Telemovel INT  NOT NULL,
    Tipo ENUM('Admin','Aluno') NOT NULL DEFAULT ('Aluno'),
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
);


CREATE TABLE Instrutores(
    IdInstrutor INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(150) NOT NULL,
    DataNascimento  DATE NOT NULL,
    DocumentoIdentificacao VARCHAR(20) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL,
    Senha VARCHAR(12) NOT NULL,
    Telemovel INT  NOT NULL,
    TipoAula ENUM('Kids','Normal','Intermedio') NOT NULL,
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
);


CREATE TABLE Aulas(
    IdAula INT AUTO_INCREMENT PRIMARY KEY,
    IdInstrutor INT NOT NULL,
    DataAula DATE NOT NULL,
    HoraAula TIME NOT NULL,
    Duracao INT NOT NULL,
    Localizacao ENUM('Praia de Mira', 'Praia Poco da Cruz') NOT NULL,
    Nivel ENUM('Kids','Normal','Intermedio') NOT NULL,
    Vaga INT NOT NULL,
    Estado ENUM('Aberta','Fechada','Cancelada') NOT NULL DEFAULT ('Aberta'),
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (IdInstrutor) REFERENCES Instrutores (IdInstrutor)
);


CREATE TABLE IncricoesAulas(
    IdInscricaoAula INT AUTO_INCREMENT PRIMARY KEY,
    IdUtilizador INT NOT NULL,
    IdAula INT NOT NULL,
    Dataincricao DATE NOT NULL,
    Estado ENUM('Aberta','Fechada','Cancelada') NOT NULL DEFAULT ('Aberta'),
    Falta ENUM('Presente', 'Faltou') NOT NULL DEFAULT 'Presente',
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (IdUtilizador) REFERENCES Utilizadores(IdUtilizador),
    FOREIGN KEY (IdAula) REFERENCES Aulas (IdAula)
);



