DROP DATABASE IF EXISTS SURF;

CREATE DATABASE SURF;

USE SURF;

CREATE TABLE Utilizadores(
    IdUtilizador INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(150) NOT NULL,
    Apelido VARCHAR(150) NOT NULL,
    DataNascimento  DATE NOT NULL,
    DocumentoIdentificacao VARCHAR(20) NULL UNIQUE,
    Email VARCHAR(100) NOT NULL,
    Senha VARCHAR(255) NOT NULL,
    Telemovel INT  NOT NULL,
    Tipo ENUM('Admin','Aluno','Instrutor') NOT NULL DEFAULT ('Aluno'),
    nivelInstrutor ENUM('Kids','Normal','Intermedio') NULL,
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    apagado_em DATETIME NULL DEFAULT NULL
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
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    apagado_em DATETIME NULL DEFAULT NULL
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
    apagado_em DATETIME NULL DEFAULT NULL,
    FOREIGN KEY (IdInstrutor) REFERENCES Utilizadores (IdUtilizador)
);


CREATE TABLE InscricoesAulas(
    IdInscricaoAula INT AUTO_INCREMENT PRIMARY KEY,
    IdUtilizador INT NOT NULL,
    IdAula INT NOT NULL,
    Dataincricao DATE NOT NULL,
    Estado ENUM('Aberta','Fechada','Cancelada') NOT NULL DEFAULT ('Aberta'),
    Falta ENUM('Presente', 'Faltou') NOT NULL DEFAULT 'Presente',
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    AtualizadoEm TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    apagado_em DATETIME NULL DEFAULT NULL,
    FOREIGN KEY (IdUtilizador) REFERENCES Utilizadores(IdUtilizador),
    FOREIGN KEY (IdAula) REFERENCES Aulas (IdAula)
);
