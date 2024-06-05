-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para empresa_final_tiago
DROP DATABASE IF EXISTS `empresa_final_tiago`;
CREATE DATABASE IF NOT EXISTS `empresa_final_tiago` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `empresa_final_tiago`;

-- A despejar estrutura para tabela empresa_final_tiago.departamento
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- A despejar dados para tabela empresa_final_tiago.departamento: ~4 rows (aproximadamente)
INSERT INTO `departamento` (`id`, `nome`) VALUES
	(1, 'Departamento de Contabilidade'),
	(2, 'Departamento de Informática'),
	(3, 'Departamento de Recursos Humanos'),
	(4, 'Departamento Financeiro');

-- A despejar estrutura para tabela empresa_final_tiago.funcionario
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(140) NOT NULL,
  `data_nascimento` date NOT NULL,
  `morada` text NOT NULL,
  `id_departamento` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcionario_departamento_idx` (`id_departamento`) USING BTREE,
  CONSTRAINT `FK_funcionario_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- A despejar dados para tabela empresa_final_tiago.funcionario: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela empresa_final_tiago.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `tipo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- A despejar dados para tabela empresa_final_tiago.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `nome`, `username`, `password`, `tipo`) VALUES
	(2, 'Tiago Rodrigues', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'A');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
