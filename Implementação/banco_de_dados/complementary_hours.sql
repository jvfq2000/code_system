-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 13-Mar-2020 às 22:26
-- Versão do servidor: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complementary_hours`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `aluno_ano_inicio_curso` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pessoa_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pessoa_nome` varchar(100) NOT NULL,
  `pessoa_sobrenome` varchar(100) NOT NULL,
  `pessoa_data_nascimento` date NOT NULL,
  `pessoa_telefone` char(16) DEFAULT NULL,
  `pessoa_curso` char(100) NOT NULL,
  `pessoa_campus` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`pessoa_id`, `usuario_id`, `pessoa_nome`, `pessoa_sobrenome`, `pessoa_data_nascimento`, `pessoa_telefone`, `pessoa_curso`, `pessoa_campus`) VALUES
(1, 4, 'teste1', 'somente teste', '2000-03-01', '', '', ''),
(2, 5, 'teste', 'so teste', '2000-03-01', '38998566623', '', ''),
(3, 7, 'João Vitor', 'Farias Quintal', '2000-03-01', '351651811', '', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `professor_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_senha` varchar(100) NOT NULL,
  `usuario_nivel` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_email`, `usuario_senha`, `usuario_nivel`) VALUES
(1, 'user1@email.com', 'user1', '1'),
(2, 'user2@email.com', 'user2', '2'),
(3, 'user3@email.com', 'user3', '3'),
(4, '', '', '1'),
(5, 'teste@teste.com', 'teste', '1'),
(7, 'testejoao@teste.com', 'joao', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_id`),
  ADD KEY `FK_aluno_pessoa` (`pessoa_id`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pessoa_id`),
  ADD KEY `FK_pessoa_usuario` (`usuario_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`),
  ADD KEY `FK_professor_pessoa` (`pessoa_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pessoa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `FK_aluno_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`);

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `FK_pessoa_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `FK_professor_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
