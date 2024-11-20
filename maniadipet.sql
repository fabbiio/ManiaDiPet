-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19/11/2024 às 21:53
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `maniadipet`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `update_product_status`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product_status` (IN `product_id` INT)   BEGIN
    IF (SELECT quantidade FROM produtos WHERE id = product_id) <= 3 THEN
        UPDATE produtos
        SET status = 'desativado'
        WHERE id = product_id;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cod_compra` int NOT NULL,
  `id_produto` int DEFAULT NULL,
  `quantidade_produto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `cod_compra`, `id_produto`, `quantidade_produto`, `id_usuario`) VALUES
(1, 0, 2, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

DROP TABLE IF EXISTS `contato`;
CREATE TABLE IF NOT EXISTS `contato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `mensagem` varchar(200) DEFAULT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_produto`, `id_usuario`) VALUES
(4, 42, NULL),
(5, 42, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

DROP TABLE IF EXISTS `itens_pedido`;
CREATE TABLE IF NOT EXISTS `itens_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_pedido` int DEFAULT NULL,
  `id_produto` int DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_produto` (`id_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `id_usuario`, `id_pedido`, `id_produto`, `quantidade`) VALUES
(18, 8, 41, 3, 1),
(20, 8, 42, 1, 1),
(19, 8, 42, 2, 1),
(21, 8, 43, 40, 500),
(22, 8, 44, 3, 2),
(23, 8, 44, 42, 1),
(24, 8, 45, 3, 1),
(25, 8, 47, 3, 1);

--
-- Acionadores `itens_pedido`
--
DROP TRIGGER IF EXISTS `atualiza`;
DELIMITER $$
CREATE TRIGGER `atualiza` AFTER INSERT ON `itens_pedido` FOR EACH ROW BEGIN
    -- Atualizar o valor da compra na tabela usuarios
    UPDATE usuario
    SET compras = compras + 1
    WHERE id = NEW.id_usuario;

    -- Limpar a tabela carrinho para o usuário correspondente
    DELETE FROM carrinho
    WHERE id_usuario = NEW.id_usuario;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `atualiza_estoque`;
DELIMITER $$
CREATE TRIGGER `atualiza_estoque` AFTER INSERT ON `itens_pedido` FOR EACH ROW BEGIN
    -- Subtrair a quantidade de produtos na tabela produtos
    UPDATE produtos
    SET quantidade = quantidade - NEW.quantidade
    WHERE id = NEW.id_produto;
    
    -- Chamar o procedimento para atualizar o status do produto
    CALL update_product_status(NEW.id_produto);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paginacao`
--

DROP TABLE IF EXISTS `paginacao`;
CREATE TABLE IF NOT EXISTS `paginacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cor_cabecalho` varchar(20) DEFAULT NULL,
  `nome_site` varchar(20) DEFAULT NULL,
  `imagem_title` varchar(20) DEFAULT NULL,
  `imagem_icone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `paginacao`
--

INSERT INTO `paginacao` (`id`, `cor_cabecalho`, `nome_site`, `imagem_title`, `imagem_icone`) VALUES
(1, 'green', 'ManiaDiPet', 'maniadipet.png', 'cachorro.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `data_pedido` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `data_pedido`) VALUES
(47, 8, '2024-11-19 11:27:16'),
(46, 8, '2024-11-19 11:24:10'),
(45, 8, '2024-11-19 11:21:55'),
(44, 8, '2024-11-18 12:19:04'),
(43, 8, '2024-11-18 09:47:52'),
(42, 8, '2024-11-17 15:54:38'),
(41, 8, '2024-11-17 15:54:15');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `pedidos_usuario`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `pedidos_usuario`;
CREATE TABLE IF NOT EXISTS `pedidos_usuario` (
`pedido_id` int
,`data_pedido` datetime
,`id_usuario` int
,`usuario_nome` varchar(50)
,`id_produto` int
,`produto_nome` varchar(20)
,`preco_unitario` decimal(10,2)
,`quantidade` int
,`subtotal` decimal(20,2)
,`valor_produtos` decimal(42,2)
,`valor_total` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `quantidade` int NOT NULL,
  `imagem_um` varchar(50) DEFAULT NULL,
  `imagem_dois` varchar(50) NOT NULL,
  `imagem_tres` varchar(50) NOT NULL,
  `imagem_quatro` varchar(50) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `categoria` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `valor`, `quantidade`, `imagem_um`, `imagem_dois`, `imagem_tres`, `imagem_quatro`, `descricao`, `categoria`, `status`) VALUES
(1, 'Coleira Vermelhas', 50.50, 50, 'sem_imagem.jpeg', 'sem_imagem.jpeg', 'sem_imagem.jpeg', 'sem_imagem.jpeg', 'efefesfwrg 4gregreg rgrgrgs hgjdsgvjhw vewbkjhjfbvkrejvbu43ykehvhwnfeiuec jklhrv orhvigeiurvrogverbggerg', '', 'analise'),
(2, 'Cachorro Pelucia', 22.50, 15, 'sem_imagem.jpeg', 'sem_imagem', 'sem_imagem', 'sem_imagem', 'Pelucia macia feita de pelos de unicornio.', '', 'ativado'),
(3, 'Racao 1', 70.00, 1996, 'racao.png', 'sem_imagem', 'sem_imagem', 'sem_imagem', 'Racao Tipo 1 ', '', 'ativado'),
(40, 'Bebedouro Cachorro', 20.00, 1, 'bebedouro.jpeg', 'bebedouro1.jpeg', 'bebedouro2.jpeg', 'bebedouro3.jpeg', 'Bebedouro para cachorro', 'Alimentos', 'desativado'),
(42, 'Bebedouro Cachorro', 22.00, 221, 'bebedouro.jpeg', 'bebedouro1.jpeg', 'bebedouro2.jpeg', 'bebedouro3.jpeg', '22', 'Eletrônicos', 'ativado');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `resumo_pedidos`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `resumo_pedidos`;
CREATE TABLE IF NOT EXISTS `resumo_pedidos` (
`pedido_id` int
,`usuario_nome` varchar(50)
,`estado` varchar(2)
,`data_pedido` datetime
,`valor_total_pedido` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `rua` varchar(20) NOT NULL,
  `numero` int NOT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `senha` varchar(50) NOT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `compras` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `cpf`, `data_nascimento`, `email`, `telefone`, `cep`, `cidade`, `estado`, `rua`, `numero`, `bairro`, `complemento`, `referencia`, `senha`, `data_cadastro`, `compras`) VALUES
(8, 'Fabio Felipe', '14342615657', '1997-07-28', 'fabiofelipe788@gmail.com', '35984039274', '37650000', 'Camanducaia', 'MG', 'Rua Bom Jesus', 234, 'Centro', '', '', '10203040', '2024-11-07 11:36:22', 19),
(9, 'fabricio', '11564215601', '1996-08-24', 'buslogextrema@gmail.com', '35991579144', '13240000', 'Jarinu', 'SP', 'rua contarini', 86, 'trieste', '', '', '12345678', '2024-11-07 12:19:02', 0),
(10, 'Andre Luiz Da Cunha', '12618745604', '1995-09-06', 'andrecamanducaia@hotmail.com', '35984723627', '37650000', 'Camanducaia', 'MG', 'Rua do cruzeiro', 34, 'cruzeiro', '', '', '06091995', '2024-11-12 22:35:17', 0);

-- --------------------------------------------------------

--
-- Estrutura para view `pedidos_usuario`
--
DROP TABLE IF EXISTS `pedidos_usuario`;

DROP VIEW IF EXISTS `pedidos_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pedidos_usuario`  AS SELECT `p`.`id` AS `pedido_id`, `p`.`data_pedido` AS `data_pedido`, `p`.`id_usuario` AS `id_usuario`, `u`.`nome` AS `usuario_nome`, `i`.`id_produto` AS `id_produto`, `pr`.`nome` AS `produto_nome`, `pr`.`valor` AS `preco_unitario`, `i`.`quantidade` AS `quantidade`, (`pr`.`valor` * `i`.`quantidade`) AS `subtotal`, (select sum((`pr`.`valor` * `i`.`quantidade`)) from (`itens_pedido` `i` join `produtos` `pr` on((`i`.`id_produto` = `pr`.`id`))) where (`i`.`id_pedido` = `p`.`id`)) AS `valor_produtos`, (select sum((`pr`.`valor` * `i`.`quantidade`)) from (`itens_pedido` `i` join `produtos` `pr` on((`i`.`id_produto` = `pr`.`id`))) where (`i`.`id_pedido` = `p`.`id`)) AS `valor_total` FROM (((`pedidos` `p` join `itens_pedido` `i` on((`p`.`id` = `i`.`id_pedido`))) join `produtos` `pr` on((`i`.`id_produto` = `pr`.`id`))) join `usuario` `u` on((`p`.`id_usuario` = `u`.`id`))) ;

-- --------------------------------------------------------

--
-- Estrutura para view `resumo_pedidos`
--
DROP TABLE IF EXISTS `resumo_pedidos`;

DROP VIEW IF EXISTS `resumo_pedidos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `resumo_pedidos`  AS SELECT `subquery`.`pedido_id` AS `pedido_id`, `subquery`.`usuario_nome` AS `usuario_nome`, `subquery`.`estado` AS `estado`, `subquery`.`data_pedido` AS `data_pedido`, `subquery`.`valor_total_pedido` AS `valor_total_pedido` FROM (select `p`.`id` AS `pedido_id`,`u`.`nome` AS `usuario_nome`,`u`.`estado` AS `estado`,`p`.`data_pedido` AS `data_pedido`,sum((`pr`.`valor` * `i`.`quantidade`)) AS `valor_total_pedido` from (((`pedidos` `p` join `itens_pedido` `i` on((`p`.`id` = `i`.`id_pedido`))) join `produtos` `pr` on((`i`.`id_produto` = `pr`.`id`))) join `usuario` `u` on((`p`.`id_usuario` = `u`.`id`))) group by `p`.`id`,`u`.`nome`,`u`.`estado`,`p`.`data_pedido` order by `p`.`data_pedido` desc limit 7) AS `subquery` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
