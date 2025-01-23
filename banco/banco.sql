-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para transporte
CREATE DATABASE IF NOT EXISTS `transporte` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `transporte`;

-- Copiando estrutura para tabela transporte.lancamentos
CREATE TABLE IF NOT EXISTS `lancamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_solicitante` int DEFAULT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_motorista` int DEFAULT NULL,
  `id_veiculo` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `destino` varchar(200) DEFAULT NULL,
  `justificativa` blob,
  `tipo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__solicitantes` (`id_solicitante`),
  KEY `FK__paciente` (`id_paciente`),
  KEY `FK__motoristas` (`id_motorista`),
  KEY `FK__veiculo` (`id_veiculo`),
  CONSTRAINT `FK__motoristas` FOREIGN KEY (`id_motorista`) REFERENCES `motoristas` (`id`),
  CONSTRAINT `FK__paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  CONSTRAINT `FK__solicitantes` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id`),
  CONSTRAINT `FK__veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.lancamentos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela transporte.motoristas
CREATE TABLE IF NOT EXISTS `motoristas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `cnh` varchar(20) DEFAULT NULL,
  `fone1` varchar(20) DEFAULT NULL,
  `fone2` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.motoristas: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela transporte.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone1` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone2` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `endereco` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.paciente: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela transporte.solicitantes
CREATE TABLE IF NOT EXISTS `solicitantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.solicitantes: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela transporte.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `cadastro` char(1) DEFAULT NULL,
  `consulta` char(1) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.usuarios: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela transporte.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `placa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.veiculo: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
