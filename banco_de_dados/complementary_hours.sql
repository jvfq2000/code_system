-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.29-0ubuntu0.18.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para complementary_hours
CREATE DATABASE IF NOT EXISTS `complementary_hours` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `complementary_hours`;

-- Copiando estrutura para tabela complementary_hours.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `aluno_id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `aluno_ano_inicio_curso` int(4) NOT NULL,
  PRIMARY KEY (`aluno_id`),
  KEY `FK_aluno_pessoa` (`pessoa_id`),
  CONSTRAINT `FK_aluno_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.aluno: ~0 rows (aproximadamente)
DELETE FROM `aluno`;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela complementary_hours.campus
CREATE TABLE IF NOT EXISTS `campus` (
  `campus_id` int(11) NOT NULL AUTO_INCREMENT,
  `campus_descricao` varchar(100) NOT NULL,
  `campus_cidade` varchar(100) NOT NULL,
  `campus_estado` varchar(100) NOT NULL,
  PRIMARY KEY (`campus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.campus: ~0 rows (aproximadamente)
DELETE FROM `campus`;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` (`campus_id`, `campus_descricao`, `campus_cidade`, `campus_estado`) VALUES
	(1, 'IFNMG - Campus Arinos', 'Arinos', 'Minas Gerais');
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;

-- Copiando estrutura para tabela complementary_hours.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_descricao` varchar(100) NOT NULL,
  `curso_qtd_periodos` tinyint(4) NOT NULL,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.curso: ~4 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`curso_id`, `curso_descricao`, `curso_qtd_periodos`) VALUES
	(1, 'Bacharelado em Administração', 8),
	(2, 'Bacharelado em Agronomia', 10),
	(3, 'Bacharelado em Sistemas de Informação', 8),
	(4, 'Tecnologia em Gestão Ambiental', 6),
	(5, 'Tecnologia em Produção de Grãos', 6);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela complementary_hours.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `pessoa_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `pessoa_nome` varchar(100) NOT NULL,
  `pessoa_sobrenome` varchar(100) NOT NULL,
  `pessoa_data_nascimento` date NOT NULL,
  `pessoa_telefone` char(16) DEFAULT NULL,
  PRIMARY KEY (`pessoa_id`),
  KEY `FK_pessoa_usuario` (`usuario_id`),
  KEY `fk_pessoa_curso` (`curso_id`),
  KEY `fk_pessoa_campus` (`campus_id`),
  CONSTRAINT `FK_pessoa_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `fk_pessoa_campus` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campus_id`),
  CONSTRAINT `fk_pessoa_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.pessoa: ~5 rows (aproximadamente)
DELETE FROM `pessoa`;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` (`pessoa_id`, `usuario_id`, `campus_id`, `curso_id`, `pessoa_nome`, `pessoa_sobrenome`, `pessoa_data_nascimento`, `pessoa_telefone`) VALUES
	(3, 6, 1, 1, 'Usuario 1', 'teste', '1111-11-11', '(99) 99999-9999'),
	(4, 7, 1, 3, 'Usuario 2', 'teste', '1111-11-11', '(11) 11111-1111'),
	(5, 8, 1, 3, 'Usuario 3', 'teste', '1111-11-11', '(99) 99999-9999'),
	(6, 9, 1, 3, 'João Vitor ', 'Farias Quintal', '2000-03-01', '(99) 99999-9999');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;

-- Copiando estrutura para tabela complementary_hours.professor
CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  PRIMARY KEY (`professor_id`),
  KEY `FK_professor_pessoa` (`pessoa_id`),
  CONSTRAINT `FK_professor_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.professor: ~0 rows (aproximadamente)
DELETE FROM `professor`;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

-- Copiando estrutura para tabela complementary_hours.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_senha` varchar(100) NOT NULL,
  `usuario_nivel` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela complementary_hours.usuario: ~5 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`, `usuario_email`, `usuario_senha`, `usuario_nivel`) VALUES
	(6, 'usuario1@email.com', 'usuario1', 1),
	(7, 'usuario2@email.com', 'usuario2', 2),
	(8, 'usuario3@email.com', 'usuario3', 3),
	(9, 'joaovictorfariass@gmail.com', '123456', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
