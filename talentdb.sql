-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Out-2021 às 18:28
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `talentdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `id` int(11) NOT NULL,
  `usuario_punido` varchar(200) NOT NULL,
  `adm_acao` varchar(200) NOT NULL,
  `videoid` int(11) NOT NULL,
  `motivo_exclusao` text NOT NULL,
  `titulo_video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE `campeonato` (
  `id` int(11) NOT NULL,
  `nome_campeonato` varchar(200) NOT NULL,
  `descricao_campeonato` text NOT NULL,
  `categoria_campeonato` text NOT NULL,
  `limite_usuarios` int(11) NOT NULL,
  `recompensa` varchar(200) NOT NULL,
  `premio` text NOT NULL,
  `taxa_inscricao` varchar(200) NOT NULL,
  `admin_organizador` varchar(200) NOT NULL,
  `lucro` varchar(200) NOT NULL,
  `nome_unico` varchar(200) NOT NULL,
  `data_termino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `campeonato`
--

INSERT INTO `campeonato` (`id`, `nome_campeonato`, `descricao_campeonato`, `categoria_campeonato`, `limite_usuarios`, `recompensa`, `premio`, `taxa_inscricao`, `admin_organizador`, `lucro`, `nome_unico`, `data_termino`) VALUES
(1, 'aa', 'aaaaaaaaaaa', '', 20, '50', 'Dinheiro', '0', 'admin', '-50', 'eudanco', '2022-04-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eudanco`
--

CREATE TABLE `eudanco` (
  `id` int(6) UNSIGNED NOT NULL,
  `usuario_inscricao` varchar(30) NOT NULL,
  `tipo_inscricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`id`, `userid`, `postid`) VALUES
(23, 1, 1),
(26, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_nascimento` date NOT NULL,
  `adm` tinyint(4) NOT NULL,
  `biografia` text NOT NULL,
  `imagem_perfil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario`, `email`, `senha`, `nome`, `data_cadastro`, `data_nascimento`, `adm`, `biografia`, `imagem_perfil`) VALUES
(1, 'enzo', 'ennzzc@gmail.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Enzo', '2021-10-02 15:40:28', '2004-04-23', 0, 'Sem biografia.', 'profileimg.png'),
(2, 'admin', 'admin@talent.com', '$2y$10$KMGdmsUjQrKkewF1.SCFj.0gl8IvXfQF5.fMY9AWGZIeaHj926A6e', 'admin', '2021-10-02 15:40:49', '2004-04-23', 1, 'Sem biografia.', 'profileimg.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `titulo` text NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `data_upload` datetime NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dia_upload` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`id`, `video_url`, `titulo`, `categoria`, `tags`, `data_upload`, `usuario`, `descricao`, `likes`, `dia_upload`) VALUES
(1, 'https://www.youtube.com/embed/kCLyivl080g', 'aaaaaaa', 'música', 'aaa', '2021-10-02 15:45:09', 'enzo', 'aaaa #eudanco', 2, '02/10/2021'),
(2, 'https://www.youtube.com/embed/U9pEWkb9_Gc', 'aaaaa', 'outros', 'aaaaaaaaaa', '2021-10-02 15:45:35', 'enzo', 'aa', 2, '02/10/2021');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `eudanco`
--
ALTER TABLE `eudanco`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Índices para tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `eudanco`
--
ALTER TABLE `eudanco`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
