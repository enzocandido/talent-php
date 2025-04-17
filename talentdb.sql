-- Esquema de Banco de Dados Melhorado para o Projeto TALENT
-- 
-- Este banco de dados suporta uma plataforma onde usuários podem compartilhar
-- seus talentos através de vídeos, participar de campeonatos e interagir com outros usuários.

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
CREATE DATABASE IF NOT EXISTS `talentdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `talentdb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `data_nascimento` date NOT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT 0,
  `biografia` text DEFAULT 'Sem biografia.',
  `imagem_perfil` varchar(255) DEFAULT 'profileimg.png',
  `status` enum('ativo','inativo','banido') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `data_upload` datetime NOT NULL DEFAULT current_timestamp(),
  `descricao` text DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `visualizacoes` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_videos_usuario` (`usuario_id`),
  KEY `idx_categoria` (`categoria`),
  CONSTRAINT `fk_videos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `data_like` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_usuario_video` (`usuario_id`,`video_id`),
  KEY `fk_likes_video` (`video_id`),
  CONSTRAINT `fk_likes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_likes_video` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `campeonato`
--

DROP TABLE IF EXISTS `campeonato`;
CREATE TABLE `campeonato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_campeonato` varchar(100) NOT NULL,
  `descricao_campeonato` text DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `limite_usuarios` int(11) NOT NULL DEFAULT 20,
  `recompensa` decimal(10,2) NOT NULL DEFAULT 0.00,
  `premio` varchar(100) DEFAULT NULL,
  `taxa_inscricao` decimal(10,2) NOT NULL DEFAULT 0.00,
  `organizador_id` int(11) NOT NULL,
  `nome_unico` varchar(50) NOT NULL,
  `data_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `data_termino` date NOT NULL,
  `status` enum('aberto','fechado','cancelado','finalizado') NOT NULL DEFAULT 'aberto',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_unico` (`nome_unico`),
  KEY `fk_campeonato_categoria` (`categoria_id`),
  KEY `fk_campeonato_organizador` (`organizador_id`),
  CONSTRAINT `fk_campeonato_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_campeonato_organizador` FOREIGN KEY (`organizador_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `inscricao_campeonato`
--

DROP TABLE IF EXISTS `inscricao_campeonato`;
CREATE TABLE `inscricao_campeonato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campeonato_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `data_inscricao` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pendente','aprovada','rejeitada') NOT NULL DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_campeonato_usuario` (`campeonato_id`,`usuario_id`),
  KEY `fk_inscricao_usuario` (`usuario_id`),
  KEY `fk_inscricao_video` (`video_id`),
  CONSTRAINT `fk_inscricao_campeonato` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonato` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_inscricao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_inscricao_video` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `logs_admin`
--

DROP TABLE IF EXISTS `logs_admin`;
CREATE TABLE `logs_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `usuario_afetado_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `acao` enum('banimento','exclusao','restauracao','aviso') NOT NULL,
  `motivo` text NOT NULL,
  `data_acao` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_logs_admin` (`admin_id`),
  KEY `fk_logs_usuario` (`usuario_afetado_id`),
  KEY `fk_logs_video` (`video_id`),
  CONSTRAINT `fk_logs_admin` FOREIGN KEY (`admin_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_logs_usuario` FOREIGN KEY (`usuario_afetado_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_logs_video` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dados iniciais para as tabelas
--

-- Inserindo categorias
INSERT INTO `categorias` (`nome`, `descricao`) VALUES
('música', 'Performances musicais, canto, instrumentos'),
('dança', 'Todas as formas de dança e expressão corporal'),
('comédia', 'Stand up, esquetes de humor'),
('esportes', 'Habilidades esportivas e atléticas'),
('artes visuais', 'Pintura, desenho, escultura'),
('outros', 'Outros talentos não classificados');

-- Inserindo usuários para exemplo
INSERT INTO `usuario` (`usuario`, `email`, `senha`, `nome`, `data_cadastro`, `data_nascimento`, `adm`, `biografia`, `imagem_perfil`) VALUES
('admin', 'admin@talent.com', '$2y$10$KMGdmsUjQrKkewF1.SCFj.0gl8IvXfQF5.fMY9AWGZIeaHj926A6e', 'Administrador', '2021-10-02 15:40:49', '2004-04-23', 1, 'Administrador do sistema TALENT', 'profileimg.png'),
('demo', 'demo@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Usuário Demo', '2021-10-02 15:40:28', '2004-04-23', 0, 'Conta de demonstração para o projeto TALENT', 'profileimg.png'),
('musico123', 'musico@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Carlos Guitarrista', '2023-01-15 10:20:30', '1995-05-15', 0, 'Apaixonado por música, toco guitarra há mais de 10 anos', 'profileimg.png'),
('dançarina', 'danca@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Ana Bailarina', '2023-02-10 14:30:45', '1998-07-22', 0, 'Dançarina profissional de ballet e dança contemporânea', 'profileimg.png'),
('comediante', 'comedia@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Paulo Humorista', '2023-03-05 09:15:20', '1990-12-10', 0, 'Faço as pessoas rirem com stand-up comedy e esquetes', 'profileimg.png'),
('atleta', 'esporte@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Rafael Esportista', '2023-04-20 16:45:10', '1997-03-28', 0, 'Atleta de parkour e acrobacias', 'profileimg.png'),
('artista', 'arte@talent.com', '$2y$10$Gw5.42CG8PmZN2wrE6Ofn.2ZDNpW6AUjuP/GUDSjzlHfPKT.VYFHO', 'Mariana Pintora', '2023-05-12 11:25:35', '1993-09-17', 0, 'Artista visual especializada em pintura e ilustração digital', 'profileimg.png');

-- Inserindo vídeos de exemplo
INSERT INTO `videos` (`usuario_id`, `video_url`, `titulo`, `categoria`, `tags`, `data_upload`, `descricao`, `likes`, `visualizacoes`) VALUES
(3, 'https://www.youtube.com/embed/JGwWNGJdvx8', 'Cover de Shape of You - Ed Sheeran', 'música', 'guitarra, cover, ed sheeran', '2023-01-20 14:30:00', 'Minha versão com guitarra acústica da música Shape of You do Ed Sheeran. Espero que gostem!', 42, 156),
(3, 'https://www.youtube.com/embed/fJ9rUzIMcZQ', 'Bohemian Rhapsody - Solo de Guitarra', 'música', 'queen, solo, guitarra', '2023-02-05 10:15:00', 'Tentando tocar o solo icônico de Brian May em Bohemian Rhapsody. Foi um desafio!', 87, 320),
(4, 'https://www.youtube.com/embed/4YJ5ET5flWM', 'Coreografia de Ballet - O Lago dos Cisnes', 'dança', 'ballet, coreografia, clássico', '2023-02-15 16:45:00', 'Minha interpretação da famosa coreografia do Lago dos Cisnes. Trabalhei nessa performance por meses.', 65, 230),
(4, 'https://www.youtube.com/embed/mGgMZpGYiy8', 'Dança Contemporânea - Expressões', 'dança', 'contemporânea, expressão, sentimentos', '2023-03-10 12:20:00', 'Uma coreografia contemporânea que expressa diferentes emoções através do movimento. Música: Ludovico Einaudi.', 54, 189),
(5, 'https://www.youtube.com/embed/Gc2u6AFImn8', 'Stand-up: A Vida na Cidade Grande', 'comédia', 'stand-up, humor, cidade', '2023-03-20 19:30:00', 'Trecho da minha apresentação de stand-up onde falo sobre as dificuldades de viver na cidade grande. Filmado no Comedy Club.', 110, 456),
(5, 'https://www.youtube.com/embed/8V0HETilr4I', 'Esquete: Entrevista de Emprego', 'comédia', 'esquete, comédia, trabalho', '2023-04-05 17:40:00', 'Uma esquete cômica sobre como NÃO se comportar em uma entrevista de emprego. Com participação de amigos do grupo teatral.', 92, 378),
(6, 'https://www.youtube.com/embed/lq_rLU7s0-M', 'Parkour pela Cidade - Desafios Urbanos', 'esportes', 'parkour, saltos, urbano', '2023-04-25 15:10:00', 'Compilação dos meus melhores movimentos de parkour pela cidade. Não tente fazer isso em casa!', 78, 295),
(6, 'https://www.youtube.com/embed/Tz9dh-chrKU', 'Acrobacias no Parque - Flips e Truques', 'esportes', 'acrobacias, flip, tricking', '2023-05-15 14:25:00', 'Praticando alguns flips e truques acrobáticos no parque da cidade. Mostro o passo a passo de como aprendi o backflip.', 67, 245),
(7, 'https://www.youtube.com/embed/yPjcpgdIk1c', 'Processo de Pintura - Retrato em Óleo', 'artes visuais', 'pintura, óleo, retrato', '2023-06-02 11:05:00', 'Time-lapse do meu processo de pintura de um retrato usando tinta a óleo. A pintura levou cerca de 20 horas para ser concluída.', 45, 180),
(7, 'https://www.youtube.com/embed/k-COG4YTn6M', 'Ilustração Digital - Criando Personagem', 'artes visuais', 'ilustração, digital, personagem', '2023-06-20 13:50:00', 'Processo de criação de um personagem de fantasia usando ilustração digital no Procreate. Da ideia ao resultado final.', 59, 210);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */; 