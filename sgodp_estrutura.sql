-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jun-2022 às 05:28
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sgodp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `alu_id` int(11) NOT NULL,
  `alu_nome` varchar(60) NOT NULL,
  `alu_dtnascimento` date NOT NULL,
  `alu_nome_responsavel` varchar(45) NOT NULL,
  `alu_contato` varchar(45) DEFAULT NULL,
  `alu_situacao` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `cgo_id` int(11) NOT NULL,
  `cgo_nome` varchar(45) NOT NULL,
  `cgo_situacao` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `ocr_id` int(11) NOT NULL,
  `ocr_numero` varchar(45) NOT NULL,
  `alu_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `part_id` int(11) DEFAULT NULL,
  `tpo_id` int(11) NOT NULL,
  `ocr_descricao` text DEFAULT NULL,
  `ocr_dtcriacao` datetime NOT NULL DEFAULT current_timestamp(),
  `ocr_dtfinalizacao` datetime DEFAULT NULL,
  `ocr_punicao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `part_id` int(11) NOT NULL,
  `part_nome` varchar(60) NOT NULL,
  `part_usuario` varchar(45) DEFAULT NULL,
  `part_senha` varchar(255) DEFAULT NULL,
  `part_email` varchar(100) DEFAULT NULL,
  `cgo_id` int(11) DEFAULT NULL,
  `part_situacao` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_ocorrencia`
--

CREATE TABLE `tipos_ocorrencia` (
  `tpo_id` int(11) NOT NULL,
  `tpo_nome` varchar(45) NOT NULL,
  `tpo_situacao` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `turma_id` int(11) NOT NULL,
  `turma_numero` varchar(30) NOT NULL,
  `turma_periodo` enum('MANHA','TARDE','NOITE') DEFAULT NULL,
  `turma_situacao` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_aluno`
--

CREATE TABLE `turma_aluno` (
  `talu_id` int(11) NOT NULL,
  `alu_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`alu_id`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cgo_id`);

--
-- Índices para tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`ocr_id`),
  ADD KEY `fk_aluno` (`alu_id`),
  ADD KEY `fk_turma_idx` (`turma_id`),
  ADD KEY `fk_participantes` (`part_id`),
  ADD KEY `fk_tipo_ocorrencia` (`tpo_id`);

--
-- Índices para tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `fk_cargo_idx` (`cgo_id`);

--
-- Índices para tabela `tipos_ocorrencia`
--
ALTER TABLE `tipos_ocorrencia`
  ADD PRIMARY KEY (`tpo_id`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`turma_id`);

--
-- Índices para tabela `turma_aluno`
--
ALTER TABLE `turma_aluno`
  ADD PRIMARY KEY (`talu_id`),
  ADD UNIQUE KEY `INDEX_TURMA_ALUNO` (`alu_id`,`turma_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cgo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_ocorrencia`
--
ALTER TABLE `tipos_ocorrencia`
  MODIFY `tpo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `turma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turma_aluno`
--
ALTER TABLE `turma_aluno`
  MODIFY `talu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `fk_aluno` FOREIGN KEY (`alu_id`) REFERENCES `alunos` (`alu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participantes` FOREIGN KEY (`part_id`) REFERENCES `participantes` (`part_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_ocorrencia` FOREIGN KEY (`tpo_id`) REFERENCES `tipos_ocorrencia` (`tpo_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`turma_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `fk_cargo` FOREIGN KEY (`cgo_id`) REFERENCES `cargos` (`cgo_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
