-- MySQL dump 10.15  Distrib 10.0.20-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u461320604_pet
-- ------------------------------------------------------
-- Server version	10.0.20-MariaDB

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
-- Table structure for table `animal`
--
CREATE DATABASE IF NOT EXISTS petshop;
use petshop;

DROP TABLE IF EXISTS `animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `especie` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `raca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pelo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pelagem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `porte` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `peso` float NOT NULL DEFAULT '0',
  `nascimento` date DEFAULT NULL,
  `cadastro` date NOT NULL,
  `castrado` tinyint(1) NOT NULL DEFAULT '0',
  `observacoes` text COLLATE utf8_unicode_ci,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `cliente_pacote` tinyint(1) NOT NULL DEFAULT '0',
  `cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=666 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal`
--

/*!40000 ALTER TABLE `animal` DISABLE KEYS */;
/*!40000 ALTER TABLE `animal` ENABLE KEYS */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nome_secundario` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `telefone2` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone3` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone4` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone5` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` text COLLATE utf8_unicode_ci,
  `saldo_devedor` double NOT NULL DEFAULT '0',
  `cliente` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`),
  KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=419 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'usuario','f8032d5cae3de20fcec887f395ec9a6a'); --Usuário/Senha usuario/usuario
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;