-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Nov-2024 às 22:21
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `bota`
--

INSERT INTO `bota` (`cod_bota`, `produto_cod`, `altura_cano`) VALUES
(11, 42, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `camisa`
--

CREATE TABLE `camisa` (
  `cod_camisa` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `camisa`
--

INSERT INTO `camisa` (`cod_camisa`, `produto_cod`, `modelo`, `cor`) VALUES
(4, 41, 'Camiseta comum', 'Preta'),
(5, 43, 'Polo', 'Preta'),
(6, 44, 'Jaqueta', 'Preta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`cod`, `cliente_cod`, `produto_cod`, `quantidade`) VALUES
(81, 1, 43, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chapeu`
--

CREATE TABLE `chapeu` (
  `cod_chapeu` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `estilo` varchar(50) NOT NULL,
  `circunferencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cinto`
--

CREATE TABLE `cinto` (
  `cod_cinto` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `largura` decimal(5,2) NOT NULL,
  `material_fivela` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(16, '78945632100', 'Yan', 'Pablo', '2024-06-07', '(18) 9836-3999', 'yanpablo@gmail.com', 'yanp'),
(17, '77777777771', 'Bruno', 'Lima', '1998-08-21', '(18) 9844-5697', 'bruno@gmail.com', 'bruno123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupons`
--

CREATE TABLE `cupons` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` enum('BlackFriday','Natal2024') NOT NULL,
  `desconto` decimal(10,2) NOT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `data_expiracao` datetime NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cupons`
--

INSERT INTO `cupons` (`id`, `nome`, `tipo`, `desconto`, `data_criacao`, `data_expiracao`, `status`) VALUES
(1, 'BlackFriday', 'BlackFriday', 30.00, '2024-11-27 16:20:03', '2024-12-27 16:20:03', 'ativo'),
(2, 'teste10', 'Natal2024', 10.00, '2024-11-27 16:32:06', '2024-12-27 16:32:06', 'ativo'),
(3, 'teste15', 'Natal2024', 300.00, '2024-11-27 16:53:36', '2024-12-27 16:53:36', 'ativo');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cod`, `cod_cliente`, `cep`, `rua`, `numero`, `bairro`, `complemento`) VALUES
(2, 11, 2147483647, 'Rua da miticagem', 32, 'Rocinha', ''),
(3, 9, 2147483647, 'Rua dos igors', 74, 'Mata atlantica', 'Longe viu'),
(5, 17, 19160000, 'Rua terezinha', 70, 'Vila paulo roberto', 'Dentro da faculdade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cod`, `nome`, `email`, `senha`) VALUES
(2, 'Arthur', 'arthur@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `cod` int(11) NOT NULL,
  `codVenda` int(11) DEFAULT NULL,
  `codProduto` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `valorUnitario` decimal(10,2) DEFAULT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `itensvenda`
--

INSERT INTO `itensvenda` (`cod`, `codVenda`, `codProduto`, `qtd`, `valorUnitario`, `valorTotal`) VALUES
(3, 43, 42, 1, 200.00, 200.00),
(4, 43, 41, 1, 200.00, 200.00),
(5, 44, 42, 1, 200.00, 200.00),
(6, 44, 41, 1, 200.00, 200.00),
(7, 48, 42, 1, 200.00, 200.00),
(8, 49, 41, 1, 200.00, 200.00),
(9, 49, 42, 1, 200.00, 200.00),
(10, 50, 41, 1, 200.00, 200.00),
(11, 51, 41, 1, 200.00, 200.00),
(12, 51, 42, 1, 200.00, 200.00),
(13, 52, 42, 1, 200.00, 200.00),
(14, 53, 44, 1, 1200.00, 1200.00),
(15, 54, 44, 1, 1200.00, 1200.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`nome`, `fabricante`, `descricao`, `valor`, `cod`, `imagem_path`, `sexo`, `tipo`, `tamanho`, `material`) VALUES
('Camiseta Preta', 'Texas farm', 'aaa', 200, 41, '../imagens/uploads/camisapretaTexas.png', 'Masculino', 'CAMISA', 'G', 'Algodão'),
('Bota', 'eua', 'Bota bota', 200, 42, '../imagens/uploads/botabranca.jpeg', 'Feminino', 'BOTA', '38', 'Couro Sintetico'),
('Camisa', 'heregin', 'Camiseta básica preta', 100, 43, '../imagens/uploads/camisa_polo_50_algodao_50_dry_tradicional_jardel_preto_jardel_atacadao_000041H.jpg', 'Masculino', 'CAMISA', 'G', 'Algodão'),
('Jaqueta Couro Preta', 'couro rafael', 'Linda jaqueta de couro legitimo', 1200, 44, '../imagens/uploads/images.jpg', 'Masculino', 'CAMISA', 'M', 'Couro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`cod`, `cliente_cod`, `valor_total`, `data_venda`) VALUES
(43, 1, 400.00, '2024-06-19 00:46:44'),
(44, 1, 400.00, '2024-06-19 03:29:58'),
(45, 1, 0.00, '2024-06-19 04:55:18'),
(46, 1, 0.00, '2024-06-19 04:55:20'),
(47, 1, 0.00, '2024-06-19 04:59:46'),
(48, 11, 200.00, '2024-06-19 05:26:37'),
(49, 9, 400.00, '2024-06-19 05:27:59'),
(50, 1, 200.00, '2024-06-19 18:20:26'),
(51, 17, 400.00, '2024-06-19 20:04:48'),
(52, 1, 200.00, '2024-06-20 14:09:12'),
(53, 1, 1200.00, '2024-11-26 00:27:33'),
(54, 1, 1200.00, '2024-11-27 20:36:37');

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
-- Índices para tabela `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `codVenda` (`codVenda`),
  ADD KEY `codProduto` (`codProduto`);

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
  ADD KEY `cliente_cod` (`cliente_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bota`
--
ALTER TABLE `bota`
  MODIFY `cod_bota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `camisa`
--
ALTER TABLE `camisa`
  MODIFY `cod_camisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `cupons`
--
ALTER TABLE `cupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`);

--
-- Limitadores para a tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD CONSTRAINT `itensvenda_ibfk_1` FOREIGN KEY (`codVenda`) REFERENCES `vendas` (`cod`),
  ADD CONSTRAINT `itensvenda_ibfk_2` FOREIGN KEY (`codProduto`) REFERENCES `produto` (`cod`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
