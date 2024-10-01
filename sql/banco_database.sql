-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/10/2024 às 14:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_database`
--
CREATE DATABASE IF NOT EXISTS `banco_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `banco_database`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sgb_cartao_credito`
--

DROP TABLE IF EXISTS `tb_sgb_cartao_credito`;
CREATE TABLE `tb_sgb_cartao_credito` (
  `id_cartao_credito` int(11) NOT NULL,
  `id_tb_sgb_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sgb_cliente`
--

DROP TABLE IF EXISTS `tb_sgb_cliente`;
CREATE TABLE `tb_sgb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `cliente_nome` varchar(255) NOT NULL,
  `cliente_numero_conta` int(11) NOT NULL,
  `cliente_endereco` varchar(255) NOT NULL,
  `id_tb_sgb_gerente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sgb_gerente`
--

DROP TABLE IF EXISTS `tb_sgb_gerente`;
CREATE TABLE `tb_sgb_gerente` (
  `id_gerente` int(11) NOT NULL,
  `gerente_nome` varchar(255) NOT NULL,
  `gerente_email` varchar(255) NOT NULL,
  `gerente_senha` varchar(255) NOT NULL,
  `gerente_ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_sgb_cartao_credito`
--
ALTER TABLE `tb_sgb_cartao_credito`
  ADD PRIMARY KEY (`id_cartao_credito`),
  ADD KEY `id_tb_sgb_cliente` (`id_tb_sgb_cliente`);

--
-- Índices de tabela `tb_sgb_cliente`
--
ALTER TABLE `tb_sgb_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_tb_sgb_gerente` (`id_tb_sgb_gerente`);

--
-- Índices de tabela `tb_sgb_gerente`
--
ALTER TABLE `tb_sgb_gerente`
  ADD PRIMARY KEY (`id_gerente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_sgb_cartao_credito`
--
ALTER TABLE `tb_sgb_cartao_credito`
  MODIFY `id_cartao_credito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_sgb_cliente`
--
ALTER TABLE `tb_sgb_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_sgb_gerente`
--
ALTER TABLE `tb_sgb_gerente`
  MODIFY `id_gerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_sgb_cartao_credito`
--
ALTER TABLE `tb_sgb_cartao_credito`
  ADD CONSTRAINT `tb_sgb_cartao_credito_ibfk_1` FOREIGN KEY (`id_tb_sgb_cliente`) REFERENCES `tb_sgb_cliente` (`id_cliente`);

--
-- Restrições para tabelas `tb_sgb_cliente`
--
ALTER TABLE `tb_sgb_cliente`
  ADD CONSTRAINT `tb_sgb_cliente_ibfk_1` FOREIGN KEY (`id_tb_sgb_gerente`) REFERENCES `tb_sgb_gerente` (`id_gerente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
