-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Maio-2024 às 04:26
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `toca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bota`
--

CREATE TABLE `bota` (
  `cod_bota` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `altura_cano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `camisa`
--

CREATE TABLE `camisa` (
  `cod_camisa` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chapeu`
--

CREATE TABLE `chapeu` (
  `cod_chapeu` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `estilo` varchar(50) NOT NULL,
  `circunferencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cinto`
--

CREATE TABLE `cinto` (
  `cod_cinto` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `largura` decimal(5,2) NOT NULL,
  `material_fivela` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `dataNascimento` date NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod`, `cpf`, `nome`, `sobrenome`, `dataNascimento`, `telefone`, `email`, `senha`) VALUES
(1, '12300025262', 'Casimiro', 'Jose', '1993-10-20', '18996320412', 'ceze@outlook.com', 'ceze123'),
(2, '12312312310', 'Roguer', 'Guedes', '1992-03-12', '18912312312', 'guedes10@gmail.com', 'amem123'),
(3, '52125893800', 'Rafael', 'Perez Silva', '2024-03-21', '18981617763', 'rafaelperezsilva2005@gmail.com', '1234'),
(4, '55566628422', 'Ludmilla', 'Gonçalves', '1993-05-04', '18992220102', 'lud_numanice@outlook.com', 'numanice'),
(5, '77700707007', 'Cristiano', 'Ronaldo', '1987-07-07', '18900070707', 'cr7@gmail.com', 'sete7'),
(6, '77785295623', 'Beyoncé', 'Carter', '1981-09-04', '18996325852', 'beyonce_com_c@gmail.com', '123456'),
(9, '11111111111', 'Igao', 'podpah', '2024-04-11', '(22) 22222-2222', 'igao@gmail.com', 'igao'),
(11, '44444444444', 'Mitico', 'podpa', '2024-04-03', '(44) 44444-4444', 'mitico@gmail.com', 'mitico'),
(14, '123', 'Yan Lindo', 'Andrade', '2024-04-05', '(18) 98161-7763', 'yan@gmail.com', '1'),
(15, '88888888808', 'Miguel', 'Perez', '2024-04-18', '(18) 98161-7763', 'miguel@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cep` int(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cod`, `cod_cliente`, `cep`, `rua`, `numero`, `bairro`, `complemento`) VALUES
(1, 1, 19160000, 'Rua pinxinguinha número', 75, 'Jardim Horizonte', 'Bar do seu jao'),
(2, 14, 1212121212, 'Pirapo ', 12, 'Bairro de Sao joao', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cod`, `nome`, `email`, `senha`) VALUES
(2, 'Arthur', 'arthur@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `nome` varchar(100) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` int(11) NOT NULL,
  `cod` int(11) NOT NULL,
  `imagem_path` varchar(255) DEFAULT NULL,
  `sexo` varchar(40) DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `tamanho` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `fabricante`, `descricao`, `valor`, `cod`, `imagem_path`, `sexo`, `tipo`, `tamanho`, `material`) VALUES
('Bota', 'Texas', 'Bota bota', 1445, 24, '../imagens/uploads/botabranca.jpeg', 'Feminino', 'BOTA', '38', 'Couro Sintetico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bota`
--
ALTER TABLE `bota`
  ADD PRIMARY KEY (`cod_bota`),
  ADD KEY `fk_produto_bota` (`produto_cod`);

--
-- Índices para tabela `camisa`
--
ALTER TABLE `camisa`
  ADD PRIMARY KEY (`cod_camisa`),
  ADD KEY `fk_produto_camisa` (`produto_cod`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cliente_cod` (`cliente_cod`),
  ADD KEY `produto_cod` (`produto_cod`);

--
-- Índices para tabela `chapeu`
--
ALTER TABLE `chapeu`
  ADD PRIMARY KEY (`cod_chapeu`),
  ADD KEY `fk_produto_chapeu` (`produto_cod`);

--
-- Índices para tabela `cinto`
--
ALTER TABLE `cinto`
  ADD PRIMARY KEY (`cod_cinto`),
  ADD KEY `fk_produto_cinto` (`produto_cod`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_cod_cliente` (`cod_cliente`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cliente_cod` (`cliente_cod`),
  ADD KEY `produto_cod` (`produto_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bota`
--
ALTER TABLE `bota`
  MODIFY `cod_bota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `camisa`
--
ALTER TABLE `camisa`
  MODIFY `cod_camisa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de tabela `chapeu`
--
ALTER TABLE `chapeu`
  MODIFY `cod_chapeu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cinto`
--
ALTER TABLE `cinto`
  MODIFY `cod_cinto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bota`
--
ALTER TABLE `bota`
  ADD CONSTRAINT `fk_produto_bota` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `camisa`
--
ALTER TABLE `camisa`
  ADD CONSTRAINT `fk_produto_camisa` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cod`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `chapeu`
--
ALTER TABLE `chapeu`
  ADD CONSTRAINT `fk_produto_chapeu` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `cinto`
--
ALTER TABLE `cinto`
  ADD CONSTRAINT `fk_produto_cinto` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `cod_cliente` FOREIGN KEY (`cod`) REFERENCES `cliente` (`cod`),
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cod`),
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
