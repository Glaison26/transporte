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
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__solicitantes` (`id_solicitante`),
  KEY `FK__motoristas` (`id_motorista`),
  KEY `FK__veiculo` (`id_veiculo`),
  KEY `FK_lancamentos_paciente` (`id_paciente`),
  CONSTRAINT `FK__motoristas` FOREIGN KEY (`id_motorista`) REFERENCES `motoristas` (`id`),
  CONSTRAINT `FK__solicitantes` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitantes` (`id`),
  CONSTRAINT `FK__veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`),
  CONSTRAINT `FK_lancamentos_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.lancamentos: ~2 rows (aproximadamente)
REPLACE INTO `lancamentos` (`id`, `id_solicitante`, `id_paciente`, `id_motorista`, `id_veiculo`, `data`, `hora`, `destino`, `justificativa`, `tipo`) VALUES
	(1, 2, 1, 5, 8, '2025-01-30', '11:05:00', 'ida ao centro administrativo largo do marquês', _binary 0x7465737465, 'Administrativo'),
	(2, 2, 1, 3, 7, '2025-01-30', '15:09:00', 'Regional Roça Grande ', _binary 0x456e76696f206465206d65646963616d656e746f73, 'Unidade de Saúde');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.motoristas: ~2 rows (aproximadamente)
REPLACE INTO `motoristas` (`id`, `nome`, `endereco`, `bairro`, `cep`, `cnh`, `fone1`, `fone2`, `email`) VALUES
	(3, 'Flavio da Silva', 'Rua daze, 140', 'centro', '34505-480', '4234', '(53) 45324-5345', '(34) 534534-5345', 'glaison26.queiroz@gmail.com'),
	(5, 'Glaison Queiroz', 'Rua da Intendência', 'centro', '34505-480', NULL, '(31) 3672-7688', '', 'glaison26.queiroz@gmail.com');

-- Copiando estrutura para tabela transporte.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone1` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone2` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `endereco` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.paciente: ~0 rows (aproximadamente)
REPLACE INTO `paciente` (`id`, `nome`, `fone1`, `fone2`, `endereco`, `bairro`, `cep`, `email`) VALUES
	(1, 'Glaison Queiroz', '(31) 3672-7720', '(56) 54656-5553', 'Rua da Intendência 316', 'centro', '34505-480', 'glaison26.queiroz@gmail.com');

-- Copiando estrutura para tabela transporte.solicitantes
CREATE TABLE IF NOT EXISTS `solicitantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `telefone2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.solicitantes: ~3 rows (aproximadamente)
REPLACE INTO `solicitantes` (`id`, `nome`, `telefone`, `setor`, `telefone2`) VALUES
	(1, 'Glaison Queiroz', '(31)984262508', 'Informática', '(31) 456546-5455'),
	(2, 'José da Silva', '(31) 8899-0088', 'Informática da Saúde', '(36) 717733-7777');

-- Copiando estrutura para tabela transporte.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `cadastro` char(1) DEFAULT NULL,
  `consulta` char(1) DEFAULT NULL,
  `tipo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `lancamentos` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.usuarios: ~2 rows (aproximadamente)
REPLACE INTO `usuarios` (`id`, `nome`, `login`, `senha`, `cadastro`, `consulta`, `tipo`, `ativo`, `lancamentos`) VALUES
	(1, 'Usuáro de teste', 'teste', 'VGFpb2JhQDMxNjMxOA==', NULL, NULL, 'Operador', 'S', NULL),
	(2, 'Glaison Queiroz', 'Glaison', 'VGFpb2JhQDMxNjMxOA==', NULL, NULL, 'Administrador', 'S', NULL);

-- Copiando estrutura para tabela transporte.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `placa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.veiculo: ~2 rows (aproximadamente)
REPLACE INTO `veiculo` (`id`, `descricao`, `placa`) VALUES
	(7, 'Camionete D20', '4423'),
	(8, 'Ford Corola plus', '523453');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
