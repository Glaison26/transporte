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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.motoristas: ~4 rows (aproximadamente)
INSERT INTO `motoristas` (`id`, `nome`, `endereco`, `bairro`, `cep`, `cnh`, `fone1`, `fone2`, `email`) VALUES
	(6, 'Anisio Henrique Viieira', 'Av Longitudinal  326', 'Vila Sto Antonio', '34515-440', '02765071500', '(31) 99856-2683', '', ''),
	(7, 'Luiz Wagner Silva', 'Rua Araguari  32', 'Itacolomi', '34580-070', '02311547405', '(31) 99647-1791', '', ''),
	(8, 'CASSIO LUIZ SOARES', 'RUA DAS NAÇOES, 34', 'NAÇOES UNIDAS', '34590000', '02505804404', '(31) 99281-7987', '', ''),
	(9, 'JORGE LUIZ SILVA', 'RUA ESTADOS UNIDOS, 593', 'NAÇOES UNIDAS', '34590290', '00650608026', '(31) 99949-1754', '', ''),
	(10, 'RONALDO DIAS TURBINO', 'RUA MINAS NOVA, 547', 'FÁTIMA', '34600450', '01599660205', '(31) 98848-6843', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.paciente: ~9 rows (aproximadamente)
INSERT INTO `paciente` (`id`, `nome`, `fone1`, `fone2`, `endereco`, `bairro`, `cep`, `email`) VALUES
	(1, 'ELIANE GONÇALVES SANTOS', '(31) 99970-7085', '', 'RUA DOS COQUEIROS, 17', 'FÁTIMA', '', ''),
	(2, 'Marinho Santos', '(31) 99347-6273', '', 'Rua Pirapora, 678', 'N. Sra de Fátima', '', ''),
	(3, 'Claudineia Piedade', '(31) 99158-4478', '', 'Rua Gavião', 'Adelmolândia', '', ''),
	(4, 'Silvia Cristina do Amaral', '(31) 98939-5157', '', 'Rua Belo Vale, 5', 'Val Paraíso - Gal. Carneiro', '', ''),
	(5, 'Renilde de Souza Rodrigues', '(31) 98841-5542', '', 'Rua Sul América, 257', 'Fogo Apagou', '', ''),
	(6, 'Janice dos Santos', '(31) 97310-2471', '', 'Rua Extrema, 08', 'Vila Santa Rita - Gal. Carneiro', '', ''),
	(7, 'Adani Cristina da Silva', '(31) 99726-4747', '', 'Rua Santa Cruz, 382', 'Morro da Cruz', '', ''),
	(8, 'Maria do Rosário Fernandes', '(31) 99356-2453', '', 'Rua Bem Te Vi, 88', 'Adelmolândia', '', ''),
	(9, 'Renato Vieira', '(31) 98759-4030', '', 'Rua Penha, 111', 'Alvorada', '', ''),
	(10, 'Silvana Cristina Amaral', '(31) 98939-5157', '', 'Rua Belo Vale, 5', 'Val Paraíso - Gal. Carneiro', '', '');

-- Copiando estrutura para tabela transporte.solicitantes
CREATE TABLE IF NOT EXISTS `solicitantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `telefone2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.solicitantes: ~21 rows (aproximadamente)
INSERT INTO `solicitantes` (`id`, `nome`, `telefone`, `setor`, `telefone2`) VALUES
	(1, 'UBS - MORRO DA CRUZ', '(31) 3674-3150', 'UNIDADE DE SAÚDE', '(31) 98435-1948'),
	(2, 'UBS - ADELMOLÂNDIA', '(31) 3671-1503', 'UNIDADE DE SAÚDE', '(31) 97101-2394'),
	(3, 'UBS - ALVORADA', '(31) 3488-6526', 'UNIDADE DE SAÚDE', '(31) 98435-7234'),
	(4, 'UBS - CAIC', '(31) 3673-1825', 'UNIDADE DE SAÚDE', '(31) 8437-4742'),
	(5, 'UBS - CAMPO SANTO ANTÔNIO', '(31) 3674-7849', 'UNIDADE DE SAÚDE', '(31) 99500-7719'),
	(6, 'UBS - CAPS I', '(31) 3672-7731', 'UNIDADE DE SAÚDE', '(31) 98435-9525'),
	(7, 'UBS - CAPS II', '(31) 3672-9855', 'UNIDADE DE SAÚDE', '(31) 98435-9123'),
	(8, 'UBS - CASTANHEIRAS', '(31) 3675-2992', 'UNIDADE DE SAÚDE', '(31) 98433-4642'),
	(9, 'CEMAE', '(31) 3674-2871', 'UNIDADE DE SAÚDE', '(31) 97214-6260'),
	(10, 'CESARE', '(31) 3488-5812', 'UNIDADE DE SAÚDE', '(31) 99640-0795'),
	(11, 'UBS - FÁTIMA I', '(31) 3672-2672', 'UNIDADE DE SAÚDE', '(31) 98436-7146'),
	(12, 'UBS - FÁTIMA II', '(31) 3672-2140', 'UNIDADE DE SAÚDE', '(31) 98437-2318'),
	(13, 'UBS - GAL. CARNEIRO', '(31) 3672-9992', 'UNIDADE DE SAÚDE', '(31) 99071-5436'),
	(14, 'UBS - KM 14', '(31) 3691-1016', 'UNIDADE DE SAÚDE', '(31) 98436-2524'),
	(15, 'UBS - NOVA VISTA', '(31) 3487-9666', 'UNIDADE DE SAÚDE', '(31) 98436-8346'),
	(16, 'UBS - NOVO ALVORADA', '(31) 3481-5344', 'UNIDADE DE SAÚDE', '(31) 98435-5033'),
	(17, 'UBS - POMPÉU', '(31) 3671-6102', 'UNIDADE DE SAÚDE', ''),
	(18, 'UBS - RAVENA', '(31) 3672-3704', 'UNIDADE DE SAÚDE', '(31) 99804-6544'),
	(19, 'UBS - ROÇA GRANDE', '(31) 3672-9528', 'UNIDADE DE SAÚDE', '(31) 98435-0714'),
	(20, 'UBS - ROSÁRIO I', '(31) 3674-5077', 'UNIDADE DE SAÚDE', '(31) 98434-9484'),
	(21, 'UBS - SIDERÚRGICA', '(31) 3672-6058', 'UNIDADE DE SAÚDE', '(31) 98435-3198'),
	(22, 'UBS - VILAS REUNIDAS', '(31) 3671-7444', 'UNIDADE DE SAÚDE', '(31) 98434-7601');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `cadastro`, `consulta`, `tipo`, `ativo`, `lancamentos`) VALUES
	(2, 'Glaison Queiroz', 'Glaison', 'VGFpb2JhQDMxNjMxOA==', NULL, NULL, 'Administrador', 'S', NULL),
	(4, 'Transporte', 'Transporte', 'c2FiYXJhQDIwMjU=', 'S', 'N', 'Operador', 'S', 'N'),
	(5, 'Claudio Vicente da Costa', 'claudio.costa', 'QmVyb25CZW50bzE3MjZA', 'S', 'S', 'Administrador', 'S', 'S'),
	(6, 'Vinicius Silva Bento', 'Vinicius', 'U2F1ZGVAMjU=', 'S', 'S', 'Administrador', 'S', 'S'),
	(7, 'Adilson Bento Teixeira', 'adilson.bento', 'YWRpbHNvbi5iZW50b0Ax', 'S', 'S', 'Operador', 'S', 'S');

-- Copiando estrutura para tabela transporte.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `placa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela transporte.veiculo: ~22 rows (aproximadamente)
INSERT INTO `veiculo` (`id`, `descricao`, `placa`) VALUES
	(1, 'GM / SPIN', 'SEN1H53'),
	(2, 'RENAULT MASTER AMBULÂNCIA', 'PZB 5F53'),
	(3, 'FIAT ARGO', 'SJI 4D49'),
	(4, 'FIAT DOBLO AMBULANCIA', 'PZP 8386'),
	(5, 'FIAT FIORINO/ AMBULÂNCIA', 'QMZ 4C44'),
	(6, 'FIAT DOBLO ESSENCE', 'QNP 0967'),
	(7, 'FIAT FIORINO/ AMBULÂNCIA', 'SYR 0F92'),
	(8, 'SPRINTER / AMBULÂNCIA', 'RTC 8G61'),
	(9, 'SPRINTER / AMBULÂNCIA', 'RTC 8G59'),
	(10, 'GM / SPIN', 'SGB 1C68'),
	(11, 'FIAT ARGO', 'SJI 4D52'),
	(12, 'GM / SPIN', 'TZA 1D39'),
	(13, 'GM / SPIN', 'TXA 8D20'),
	(14, 'GM / SPIN', 'TXA 8D12'),
	(15, 'GM / SPIN', 'TXC 2F41'),
	(16, 'GM / SPIN', 'SGB 0F44'),
	(17, 'GM / SPIN', 'TCP 0H99'),
	(18, 'FIAT FIORINO / AMBULÂNCIA', 'SYR 0C65'),
	(19, 'RENAULT MASTER AMBULÂNCIA', 'QOT 9546'),
	(20, 'RENAULT MASTER AMBULÂNCIA', 'QOT 9552'),
	(21, 'Hilux MAIA AMBULÂNCIA', 'TXE 4G61'),
	(22, 'RENAULT MASTER AMBULÂNCIA', 'TXD 9C55'),
	(23, 'C3 LIVE 1.0', 'TXX 1E44'),
	(24, 'C3 LIVE 1.0', 'TXX 1F31'),
	(25, 'RENAULT MASTER AMBULÂNCIA', 'TXG 4A92');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
