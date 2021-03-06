-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 12, 2021 alle 16:15
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `addetto_vendita`
--

CREATE TABLE `addetto_vendita` (
  `id_addetto` int(5) NOT NULL,
  `id_reparto` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `addetto_vendita`
--

INSERT INTO `addetto_vendita` (`id_addetto`, `id_reparto`, `nome`, `cognome`, `email`, `pass`) VALUES
(1, 2, 'Paolo', 'Rossi', 'addetto@addetto.it', '0dede6c43439ae6e1c0bb5658284cab0a270633564e199fce1bdfbd827d4fc95');

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `id_articolo` int(5) NOT NULL,
  `id_categoria` int(5) DEFAULT NULL,
  `id_reparto` int(5) DEFAULT NULL,
  `id_ordine` int(5) DEFAULT NULL,
  `nome_articolo` varchar(100) NOT NULL,
  `quantita` int(33) NOT NULL,
  `prezzo` decimal(10,0) DEFAULT NULL,
  `taglia` varchar(5) DEFAULT NULL,
  `data_vendita` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`id_articolo`, `id_categoria`, `id_reparto`, `id_ordine`, `nome_articolo`, `quantita`, `prezzo`, `taglia`, `data_vendita`) VALUES
(68, 5, 1, NULL, 'Pantalone a quadri', 1, '25', 'M', NULL),
(69, 5, 1, NULL, 'Pantalone a quadri', 1, '25', 'M', NULL),
(71, 5, 1, NULL, 'Pantalone a quadri', 1, '25', 'M', '2021-02-11 16:52:48'),
(72, 3, 1, NULL, 'Maglione pesante', 1, '25', 'M', '2021-02-11 16:32:10'),
(73, 3, 1, NULL, 'Maglione pesante', 1, '25', 'M', '2021-02-11 16:32:10'),
(74, 3, 1, NULL, 'Maglione pesante', 1, '25', 'M', '2021-02-11 16:32:10'),
(75, 3, 1, NULL, 'Maglione pesante', 1, '25', 'M', '2021-02-11 18:29:06'),
(76, 3, 1, NULL, 'Maglione pesante', 1, '25', 'M', '2021-02-11 15:49:29'),
(133, 6, 1, NULL, 'Tuta adidas', 1, '66', '46', '2021-02-11 18:29:06'),
(134, NULL, NULL, NULL, 'Jeans starappati slim-fit', 1, '0', '46', NULL),
(135, 1, 1, NULL, 'Maglia cotone NERA ', 1, '9', 'M', '2021-02-11 19:15:11'),
(136, NULL, NULL, NULL, 'Maglia cotone NERA ', 1, '0', 'M', NULL),
(137, NULL, NULL, NULL, 'Maglia cotone NERA ', 1, '0', 'M', NULL),
(138, 3, 1, NULL, 'Maglione', 1, '36', 'M', '2021-02-11 19:32:44'),
(139, 3, 1, NULL, 'Maglione', 1, '36', 'M', NULL),
(140, 3, 1, NULL, 'Maglione', 1, '36', 'M', NULL),
(141, 4, 1, NULL, 'Pantalone nero', 1, '25', '50', NULL),
(143, NULL, NULL, NULL, 'Maglia', 1, '0', 'M', NULL),
(144, NULL, NULL, NULL, 'Felpa nera', 1, '0', 'M', NULL),
(145, NULL, NULL, NULL, 'Camicia bianca', 1, '0', 'XS', NULL),
(146, NULL, NULL, NULL, 'Camicia bianca', 1, '0', 'XS', NULL),
(147, NULL, NULL, 102, 'Camicia bianca', 1, '0', 'XS', NULL),
(148, 1, 1, NULL, 'Maglietta bianca', 1, '9', 'XL', '2021-02-12 00:06:35'),
(149, NULL, NULL, NULL, 'Maglietta bianca', 1, '0', 'XL', NULL),
(156, NULL, NULL, NULL, 'Felpa nera', 1, '0', 'M', NULL),
(157, NULL, NULL, 109, 'Felpa nera', 1, '0', 'M', NULL),
(158, NULL, NULL, 110, 'Felpa nera', 1, '0', 'M', NULL),
(159, 2, 2, NULL, 'Maglietta BLU', 1, '5', 'XL', NULL),
(160, NULL, NULL, NULL, 'Maglietta BLU', 1, '0', 'XL', NULL),
(161, NULL, NULL, 113, 'Pullover Nero', 1, '0', 'XS', NULL),
(162, NULL, NULL, 114, 'Pullover Nero', 1, '0', 'XS', NULL),
(163, NULL, NULL, 115, 'Pullover Nero', 1, '0', 'XS', NULL),
(164, 9, 3, NULL, 'Felpa gialla', 1, '0', 'M', NULL),
(165, 9, 3, NULL, 'Felpa gialla', 1, '0', 'M', NULL),
(166, 9, 3, NULL, 'Felpa gialla', 1, '0', 'M', NULL),
(167, 3, 2, NULL, 'Maglione lana rosso', 1, '15', 'L', NULL),
(168, 3, 2, NULL, 'Maglione lana rosso', 1, '15', 'L', NULL),
(169, 3, 2, NULL, 'Maglione lana rosso', 1, '15', 'L', NULL),
(170, 3, 2, NULL, 'Maglione lana rosso', 1, '15', 'L', NULL),
(171, 7, 3, NULL, 'Pantaloncini neri', 1, '10', 'M', NULL),
(172, 7, 3, NULL, 'Pantaloncini neri', 1, '10', 'M', NULL),
(173, 7, 3, NULL, 'Pantaloncini neri', 1, '10', 'M', NULL),
(174, NULL, NULL, 116, 'Camicia nera slim-fit', 1, '0', 'S', NULL),
(175, NULL, NULL, NULL, 'Camicia nera slim-fit', 1, '0', 'S', NULL),
(176, NULL, NULL, 118, 'Camicia nera slim-fit', 1, '0', 'S', NULL),
(177, NULL, NULL, 119, 'Camicia nera slim-fit', 1, '0', 'S', NULL),
(178, NULL, NULL, 120, 'Pantalone quadri blu', 1, '0', '46', NULL),
(179, NULL, NULL, 121, 'Pantalone quadri blu', 1, '0', '46', NULL),
(180, NULL, NULL, 122, 'Pantalone quadri blu', 1, '0', '46', NULL),
(181, NULL, NULL, 123, 'Pantalone quadri blu', 1, '0', '46', NULL),
(182, NULL, NULL, 124, 'Pantalone quadri blu', 1, '0', '46', NULL),
(183, 11, 1, NULL, 'Vestito nero', 1, '150', 'L', NULL),
(184, 11, 1, NULL, 'Vestito nero', 1, '150', 'L', NULL),
(185, 11, 1, NULL, 'Vestito nero', 1, '150', 'L', NULL),
(186, 4, 2, NULL, 'Jeans strappati', 1, '25', '44', NULL),
(187, 4, 2, NULL, 'Jeans strappati', 1, '25', '44', NULL),
(188, 4, 2, NULL, 'Jeans strappati', 1, '25', '44', NULL),
(189, 4, 2, NULL, 'Jeans strappati', 1, '25', '44', NULL),
(190, NULL, NULL, 125, 'Maglione verde', 1, '0', 'XL', NULL),
(191, NULL, NULL, NULL, 'Maglione verde', 1, '0', 'XL', NULL),
(192, NULL, NULL, 127, 'Maglione verde', 1, '0', 'XL', NULL),
(193, NULL, NULL, 128, 'Maglione verde', 1, '0', 'XL', NULL),
(194, NULL, NULL, 129, 'Maglione verde', 1, '0', 'XL', NULL),
(195, NULL, NULL, 130, 'Felpa rossa', 1, '0', 'M', NULL),
(196, NULL, NULL, 131, 'Felpa rossa', 1, '0', 'M', NULL),
(197, NULL, NULL, 132, 'Felpa rossa', 1, '0', 'M', NULL),
(198, NULL, NULL, 133, 'Pantalone tuta bianca', 1, '0', 'M', NULL),
(199, NULL, NULL, 134, 'Pantalone tuta bianca', 1, '0', 'M', NULL),
(200, NULL, NULL, 135, 'Pantalone tuta bianca', 1, '0', 'M', NULL),
(201, NULL, NULL, 136, 'Giacca blu notte slim', 1, '0', 'S', NULL),
(202, NULL, NULL, 137, 'Giacca blu notte slim', 1, '0', 'S', NULL),
(203, NULL, NULL, 138, 'Giacca blu notte slim', 1, '0', 'S', NULL),
(204, NULL, NULL, 139, 'Giacca blu notte slim', 1, '0', 'S', NULL),
(205, NULL, NULL, 140, 'Pantalone elegante blu notte', 1, '0', '48', NULL),
(206, NULL, NULL, NULL, 'Pantalone elegante blu notte', 1, '0', '48', NULL),
(207, NULL, NULL, 142, 'Pantalone elegante blu notte', 1, '0', '48', NULL),
(208, NULL, NULL, 143, 'Pantalone elegante blu notte', 1, '0', '48', NULL),
(209, NULL, NULL, 144, 'Abito cerimonia', 1, '0', '42', NULL),
(210, NULL, NULL, 145, 'Abito cerimonia', 1, '0', '42', NULL),
(211, NULL, NULL, 146, 'Abito cerimonia', 1, '0', '42', NULL),
(212, NULL, NULL, 147, 'Gonna a pois ', 1, '0', 'XS', NULL),
(213, NULL, NULL, 148, 'Gonna a pois ', 1, '0', 'XS', NULL),
(214, NULL, NULL, 149, 'Gonna a pois ', 1, '0', 'XS', NULL),
(215, NULL, NULL, 150, 'Gonna a pois ', 1, '0', 'XS', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(5) NOT NULL,
  `id_sottocategoria` int(5) DEFAULT NULL,
  `categoria` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `id_sottocategoria`, `categoria`) VALUES
(1, 1, 'Maglia'),
(2, 2, 'Maglia'),
(3, 3, 'Maglia'),
(4, 4, 'Pantalone'),
(5, 5, 'Pantalone'),
(6, 6, 'Pantalone'),
(7, 7, 'Pantalone'),
(8, NULL, 'Camicia'),
(9, NULL, 'Felpa'),
(10, NULL, 'Giacca'),
(11, NULL, 'Completo');

-- --------------------------------------------------------

--
-- Struttura della tabella `direttore`
--

CREATE TABLE `direttore` (
  `id_direttore` int(5) NOT NULL,
  `id_negozio` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `direttore`
--

INSERT INTO `direttore` (`id_direttore`, `id_negozio`, `nome`, `cognome`, `email`, `pass`) VALUES
(1, 1, 'Giovanni', 'De ceglie', 'direttore@direttore.it', 'de27ce6cc808f9e839e06f80a55940ebb18e6d7fcaf8b93c343200253519f697');

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE `fornitore` (
  `id_fornitore` int(5) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `fornitore`
--

INSERT INTO `fornitore` (`id_fornitore`, `nome`, `email`, `pass`) VALUES
(1, 'Fornitore srl', 'fornitore@fornitore.it', '5bee64203df803fbd29806cf36d94f8780aad72b010c2994e848c665f7b5c631');

-- --------------------------------------------------------

--
-- Struttura della tabella `giorno`
--

CREATE TABLE `giorno` (
  `id_giorno` int(5) NOT NULL,
  `giorno` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `giorno`
--

INSERT INTO `giorno` (`id_giorno`, `giorno`) VALUES
(1, 'Lunedi'),
(2, 'Martedi'),
(3, 'Mercoledi'),
(4, 'Giovedi'),
(5, 'Venerdi'),
(6, 'Sabato'),
(7, 'Domenica');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazziniere`
--

CREATE TABLE `magazziniere` (
  `id_magazziniere` int(5) NOT NULL,
  `id_negozio` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `magazziniere`
--

INSERT INTO `magazziniere` (`id_magazziniere`, `id_negozio`, `nome`, `cognome`, `email`, `pass`) VALUES
(2, 1, 'Massimo', 'Magazzino', 'magazzino@magazzino.it', 'f37173137aa2f58480cb83fbbacceffd2439d8abbe8c099b899e20e032ad66ce');

-- --------------------------------------------------------

--
-- Struttura della tabella `negozio`
--

CREATE TABLE `negozio` (
  `id_negozio` int(5) NOT NULL,
  `id_direttore` int(5) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `via` varchar(100) NOT NULL,
  `cap` int(50) NOT NULL,
  `citta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `negozio`
--

INSERT INTO `negozio` (`id_negozio`, `id_direttore`, `nome`, `via`, `cap`, `citta`) VALUES
(1, 1, 'Gp outlet Srl', 'Via Saracinello', 89134, 'Reggio Calabria');

-- --------------------------------------------------------

--
-- Struttura della tabella `orario`
--

CREATE TABLE `orario` (
  `id_orario` int(5) NOT NULL,
  `orario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `orario`
--

INSERT INTO `orario` (`id_orario`, `orario`) VALUES
(1, '8:00 - 16:00'),
(2, '8:00 - 12:00 / 16:00 - 20:00'),
(3, '13:00 - 20:00 ');

-- --------------------------------------------------------

--
-- Struttura della tabella `orario_lavorativo`
--

CREATE TABLE `orario_lavorativo` (
  `id_orario_lav` int(5) NOT NULL,
  `id_direttore` int(5) DEFAULT NULL,
  `id_magazziniere` int(5) DEFAULT NULL,
  `id_addetto` int(5) DEFAULT NULL,
  `id_orario` int(5) NOT NULL,
  `id_giorno` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `orario_lavorativo`
--

INSERT INTO `orario_lavorativo` (`id_orario_lav`, `id_direttore`, `id_magazziniere`, `id_addetto`, `id_orario`, `id_giorno`) VALUES
(8, NULL, 2, NULL, 3, 1),
(42, NULL, NULL, 1, 2, 6),
(48, NULL, NULL, 1, 1, 1),
(49, NULL, NULL, 1, 3, 2),
(50, NULL, NULL, 1, 1, 3),
(51, NULL, NULL, 1, 1, 4),
(52, NULL, NULL, 1, 3, 5),
(53, NULL, 2, NULL, 3, 2),
(54, NULL, 2, NULL, 1, 3),
(55, NULL, 2, NULL, 2, 4),
(56, NULL, 2, NULL, 3, 5),
(57, NULL, 2, NULL, 2, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `id_ordine` int(5) NOT NULL,
  `id_direttore` int(5) DEFAULT NULL,
  `id_fornitore` int(5) DEFAULT NULL,
  `articolo` varchar(33) NOT NULL,
  `stato` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id_ordine`, `id_direttore`, `id_fornitore`, `articolo`, `stato`) VALUES
(102, NULL, 1, 'Camicia bianca', '4'),
(109, NULL, 1, 'Felpa nera', '5'),
(110, NULL, 1, 'Felpa nera', '4'),
(113, NULL, 1, 'Pullover Nero', '5'),
(114, NULL, NULL, 'Pullover Nero', '2'),
(115, NULL, NULL, 'Pullover Nero', '2'),
(116, NULL, 1, 'Camicia nera slim-fit', '4'),
(118, NULL, NULL, 'Camicia nera slim-fit', '1'),
(119, NULL, 1, 'Camicia nera slim-fit', '5'),
(120, NULL, NULL, 'Pantalone quadri blu', '2'),
(121, NULL, 1, 'Pantalone quadri blu', '4'),
(122, NULL, NULL, 'Pantalone quadri blu', '1'),
(123, NULL, NULL, 'Pantalone quadri blu', '2'),
(124, NULL, NULL, 'Pantalone quadri blu', '1'),
(125, NULL, NULL, 'Maglione verde', '2'),
(127, NULL, NULL, 'Maglione verde', '1'),
(128, NULL, NULL, 'Maglione verde', '2'),
(129, NULL, NULL, 'Maglione verde', '1'),
(130, NULL, NULL, 'Felpa rossa', '1'),
(131, NULL, NULL, 'Felpa rossa', '2'),
(132, NULL, 1, 'Felpa rossa', '5'),
(133, NULL, 1, 'Pantalone tuta bianca', '5'),
(134, NULL, 1, 'Pantalone tuta bianca', '5'),
(135, NULL, NULL, 'Pantalone tuta bianca', '1'),
(136, NULL, NULL, 'Giacca blu notte slim', '1'),
(137, NULL, 1, 'Giacca blu notte slim', '4'),
(138, NULL, NULL, 'Giacca blu notte slim', '2'),
(139, NULL, NULL, 'Giacca blu notte slim', '1'),
(140, NULL, NULL, 'Pantalone elegante blu notte', '2'),
(142, NULL, NULL, 'Pantalone elegante blu notte', '1'),
(143, NULL, 1, 'Pantalone elegante blu notte', '5'),
(144, NULL, NULL, 'Abito cerimonia', '1'),
(145, NULL, NULL, 'Abito cerimonia', '1'),
(146, NULL, NULL, 'Abito cerimonia', '1'),
(147, NULL, NULL, 'Gonna a pois ', '1'),
(148, NULL, NULL, 'Gonna a pois ', '2'),
(149, NULL, 1, 'Gonna a pois ', '5'),
(150, NULL, NULL, 'Gonna a pois ', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `reparto`
--

CREATE TABLE `reparto` (
  `id_reparto` int(5) NOT NULL,
  `id_negozio` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reparto`
--

INSERT INTO `reparto` (`id_reparto`, `id_negozio`, `nome`) VALUES
(1, 1, 'Uomo'),
(2, 1, 'Donna'),
(3, 1, 'Bambino');

-- --------------------------------------------------------

--
-- Struttura della tabella `sezione`
--

CREATE TABLE `sezione` (
  `id_sezione` int(5) NOT NULL,
  `id_reparto` int(5) NOT NULL,
  `sezione` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sezione`
--

INSERT INTO `sezione` (`id_sezione`, `id_reparto`, `sezione`) VALUES
(1, 1, 'Maglieria'),
(2, 1, 'Elegante'),
(3, 1, 'Sportivo'),
(4, 1, 'Jeans'),
(12, 2, 'Elegante'),
(13, 2, 'Sportivo'),
(14, 2, 'Jeans'),
(15, 2, 'Maglieria'),
(16, 3, 'Maglieria'),
(17, 3, 'Jeans'),
(18, 3, 'Sportivo'),
(19, 3, 'Elegante');

-- --------------------------------------------------------

--
-- Struttura della tabella `sotto_categoria`
--

CREATE TABLE `sotto_categoria` (
  `id_sottocategoria` int(5) NOT NULL,
  `sottocategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sotto_categoria`
--

INSERT INTO `sotto_categoria` (`id_sottocategoria`, `sottocategoria`) VALUES
(1, 'T-shirt'),
(2, 'Maniche Lunghe'),
(3, 'Maglione'),
(4, 'Jeans'),
(5, 'Elegante'),
(6, 'Tuta'),
(7, 'Pantaloncini');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `addetto_vendita`
--
ALTER TABLE `addetto_vendita`
  ADD PRIMARY KEY (`id_addetto`),
  ADD KEY `id_reparto` (`id_reparto`);

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`id_articolo`),
  ADD KEY `id_reparto` (`id_reparto`),
  ADD KEY `id_ordine` (`id_ordine`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_sottocategoria` (`id_sottocategoria`);

--
-- Indici per le tabelle `direttore`
--
ALTER TABLE `direttore`
  ADD PRIMARY KEY (`id_direttore`),
  ADD KEY `id_negozio` (`id_negozio`);

--
-- Indici per le tabelle `fornitore`
--
ALTER TABLE `fornitore`
  ADD PRIMARY KEY (`id_fornitore`);

--
-- Indici per le tabelle `giorno`
--
ALTER TABLE `giorno`
  ADD PRIMARY KEY (`id_giorno`);

--
-- Indici per le tabelle `magazziniere`
--
ALTER TABLE `magazziniere`
  ADD PRIMARY KEY (`id_magazziniere`),
  ADD KEY `id_negozio` (`id_negozio`);

--
-- Indici per le tabelle `negozio`
--
ALTER TABLE `negozio`
  ADD PRIMARY KEY (`id_negozio`),
  ADD KEY `id_direttore` (`id_direttore`);

--
-- Indici per le tabelle `orario`
--
ALTER TABLE `orario`
  ADD PRIMARY KEY (`id_orario`);

--
-- Indici per le tabelle `orario_lavorativo`
--
ALTER TABLE `orario_lavorativo`
  ADD PRIMARY KEY (`id_orario_lav`),
  ADD KEY `id_direttore` (`id_direttore`),
  ADD KEY `id_addetto` (`id_addetto`),
  ADD KEY `id_magazziniere` (`id_magazziniere`),
  ADD KEY `id_orario` (`id_orario`),
  ADD KEY `id_giorno` (`id_giorno`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`id_ordine`),
  ADD KEY `id_direttore` (`id_direttore`),
  ADD KEY `id_fornitore` (`id_fornitore`);

--
-- Indici per le tabelle `reparto`
--
ALTER TABLE `reparto`
  ADD PRIMARY KEY (`id_reparto`),
  ADD KEY `id_negozio` (`id_negozio`);

--
-- Indici per le tabelle `sezione`
--
ALTER TABLE `sezione`
  ADD PRIMARY KEY (`id_sezione`),
  ADD KEY `id_reparto` (`id_reparto`);

--
-- Indici per le tabelle `sotto_categoria`
--
ALTER TABLE `sotto_categoria`
  ADD PRIMARY KEY (`id_sottocategoria`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `addetto_vendita`
--
ALTER TABLE `addetto_vendita`
  MODIFY `id_addetto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `id_articolo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `direttore`
--
ALTER TABLE `direttore`
  MODIFY `id_direttore` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `fornitore`
--
ALTER TABLE `fornitore`
  MODIFY `id_fornitore` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `giorno`
--
ALTER TABLE `giorno`
  MODIFY `id_giorno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `magazziniere`
--
ALTER TABLE `magazziniere`
  MODIFY `id_magazziniere` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `negozio`
--
ALTER TABLE `negozio`
  MODIFY `id_negozio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `orario`
--
ALTER TABLE `orario`
  MODIFY `id_orario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `orario_lavorativo`
--
ALTER TABLE `orario_lavorativo`
  MODIFY `id_orario_lav` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `id_ordine` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT per la tabella `reparto`
--
ALTER TABLE `reparto`
  MODIFY `id_reparto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `sezione`
--
ALTER TABLE `sezione`
  MODIFY `id_sezione` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `sotto_categoria`
--
ALTER TABLE `sotto_categoria`
  MODIFY `id_sottocategoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `addetto_vendita`
--
ALTER TABLE `addetto_vendita`
  ADD CONSTRAINT `addetto_vendita_ibfk_1` FOREIGN KEY (`id_reparto`) REFERENCES `reparto` (`id_reparto`);

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`id_reparto`) REFERENCES `reparto` (`id_reparto`),
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id_ordine`),
  ADD CONSTRAINT `articolo_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Limiti per la tabella `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_2` FOREIGN KEY (`id_sottocategoria`) REFERENCES `sotto_categoria` (`id_sottocategoria`);

--
-- Limiti per la tabella `direttore`
--
ALTER TABLE `direttore`
  ADD CONSTRAINT `direttore_ibfk_1` FOREIGN KEY (`id_negozio`) REFERENCES `negozio` (`id_negozio`);

--
-- Limiti per la tabella `magazziniere`
--
ALTER TABLE `magazziniere`
  ADD CONSTRAINT `magazziniere_ibfk_1` FOREIGN KEY (`id_negozio`) REFERENCES `negozio` (`id_negozio`);

--
-- Limiti per la tabella `negozio`
--
ALTER TABLE `negozio`
  ADD CONSTRAINT `negozio_ibfk_1` FOREIGN KEY (`id_direttore`) REFERENCES `direttore` (`id_direttore`);

--
-- Limiti per la tabella `orario_lavorativo`
--
ALTER TABLE `orario_lavorativo`
  ADD CONSTRAINT `orario_lavorativo_ibfk_1` FOREIGN KEY (`id_direttore`) REFERENCES `direttore` (`id_direttore`),
  ADD CONSTRAINT `orario_lavorativo_ibfk_2` FOREIGN KEY (`id_addetto`) REFERENCES `addetto_vendita` (`id_addetto`),
  ADD CONSTRAINT `orario_lavorativo_ibfk_3` FOREIGN KEY (`id_magazziniere`) REFERENCES `magazziniere` (`id_magazziniere`),
  ADD CONSTRAINT `orario_lavorativo_ibfk_4` FOREIGN KEY (`id_orario`) REFERENCES `orario` (`id_orario`),
  ADD CONSTRAINT `orario_lavorativo_ibfk_5` FOREIGN KEY (`id_giorno`) REFERENCES `giorno` (`id_giorno`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`id_direttore`) REFERENCES `direttore` (`id_direttore`),
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`id_fornitore`) REFERENCES `fornitore` (`id_fornitore`);

--
-- Limiti per la tabella `reparto`
--
ALTER TABLE `reparto`
  ADD CONSTRAINT `reparto_ibfk_1` FOREIGN KEY (`id_negozio`) REFERENCES `negozio` (`id_negozio`);

--
-- Limiti per la tabella `sezione`
--
ALTER TABLE `sezione`
  ADD CONSTRAINT `sezione_ibfk_1` FOREIGN KEY (`id_reparto`) REFERENCES `reparto` (`id_reparto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
