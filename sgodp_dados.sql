-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jun-2022 às 15:36
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

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

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`alu_id`, `alu_nome`, `alu_dtnascimento`, `alu_nome_responsavel`, `alu_contato`, `alu_situacao`) VALUES
(1, 'Raicley Santana', '1998-02-01', 'teste', '(20) 02020-2020', '1');

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`cgo_id`, `cgo_nome`, `cgo_situacao`) VALUES
(1, 'Diretor', '1'),
(2, 'Secretário', '1'),
(4, 'Professor', '1');

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`part_id`, `part_nome`, `part_usuario`, `part_senha`, `part_email`, `cgo_id`, `part_situacao`) VALUES
(1, 'admin', 'admin', '#admin', 'admin@gmail.com', 1, '1');

--
-- Extraindo dados da tabela `tipos_ocorrencia`
--

INSERT INTO `tipos_ocorrencia` (`tpo_id`, `tpo_nome`, `tpo_situacao`) VALUES
(1, 'Algazarra', '1'),
(2, 'Agressão física', '1');

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`turma_id`, `turma_numero`, `turma_periodo`, `turma_situacao`) VALUES
(3, '6º Ano', NULL, '1'),
(5, '7º Ano', NULL, '1'),
(6, '8º Ano', NULL, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
