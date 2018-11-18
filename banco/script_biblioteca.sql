CREATE DATABASE  IF NOT EXISTS `db_biblioteca` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_biblioteca`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_biblioteca
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `esta_ativo` varchar(3) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprestimo` (
  `idEmprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `dataEmprestimo` datetime NOT NULL,
  `dataDevolucao` datetime NOT NULL,
  `exemplar_idExemplar` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idEmprestimo`),
  KEY `fk_reserva_exemplar1_idx` (`exemplar_idExemplar`),
  KEY `fk_reserva_usuario1_idx` (`usuario_idUsuario`),
  CONSTRAINT `fk_reserva_exemplar1` FOREIGN KEY (`exemplar_idExemplar`) REFERENCES `exemplar` (`idExemplar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_usuario1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimo`
--

LOCK TABLES `emprestimo` WRITE;
/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;
/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exemplar`
--

DROP TABLE IF EXISTS `exemplar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exemplar` (
  `idExemplar` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(100) DEFAULT NULL,
  `doador` varchar(100) DEFAULT NULL,
  `situacao` varchar(45) DEFAULT 'Novo',
  `localizacao` varchar(30) DEFAULT 'Disponível',
  `data_cadastro` datetime NOT NULL,
  `preco` double DEFAULT '0',
  `tipo` varchar(45) NOT NULL,
  `qtd_disponivel` int(11) NOT NULL,
  `livro_idLivro` int(11) NOT NULL,
  `download` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idExemplar`),
  KEY `fk_exemplar_livro1_idx` (`livro_idLivro`),
  CONSTRAINT `fk_exemplar_livro1` FOREIGN KEY (`livro_idLivro`) REFERENCES `livro` (`idLivro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exemplar`
--

LOCK TABLES `exemplar` WRITE;
/*!40000 ALTER TABLE `exemplar` DISABLE KEYS */;
/*!40000 ALTER TABLE `exemplar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro` (
  `idLivro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `tradutor` varchar(100) NOT NULL,
  `isbn` int(13) NOT NULL,
  `editora` varchar(100) NOT NULL,
  `ano` int(4) NOT NULL,
  `local` varchar(100) NOT NULL,
  `num_paginas` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `categoria_idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idLivro`),
  KEY `fk_livro_categoria_idx` (`categoria_idCategoria`),
  CONSTRAINT `fk_livro_categoria` FOREIGN KEY (`categoria_idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `dt_inicio` date NOT NULL,
  `dt_termino` date NOT NULL,
  `exemplar_idExemplar` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `fk_reserva_exemplar2_idx` (`exemplar_idExemplar`),
  KEY `fk_reserva_usuario2_idx` (`usuario_idUsuario`),
  CONSTRAINT `fk_reserva_exemplar2` FOREIGN KEY (`exemplar_idExemplar`) REFERENCES `exemplar` (`idExemplar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_usuario2` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `tipo` varchar(45) DEFAULT 'Usuário',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-14 20:21:17
