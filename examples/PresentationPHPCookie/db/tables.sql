--
-- Database: `utilisateurCookie`

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `emailUtilisateur` varchar(200) NOT NULL,
  `mdpUtilisateur` varchar(200) NOT NULL,
  `nomUtilisateur` varchar(200) NOT NULL,
  `statutUtilisateur` enum('Actif','Inactif') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- On insère dans la table
--

INSERT INTO `utilisateur` (`idUtilisateur`, `emailUtilisateur`, `mdpUtilisateur`, `nomUtilisateur`, `statutUtilisateur`) VALUES
(1, 'example.php@gmail.com', '$2y$10$cHpf3TzonURXDENRiRF0de1ycSfnM4NJ27sdwyUCf5L.sewDlkCBe', 'Example PHP', 'Actif'),
(2, 'mila.godiniaux@gmail.com', '$2y$10$lcLYyNeK1adgzYcBplv45uuXHFuFyWYThnj3nB2SZ/LbQvtWSoGjO', 'Mila Godiniaux', 'Actif'),
(3, 'emma.boullenger@gmail.com', '$2y$10$XlyVI9an5B6rHW3SS9vQpesJssKJxzMQYPbSaR7dnpWjDI5fpxJSS', 'Emma Boullenger', 'Actif'),
(4, 'gabriel.mougard@gmail.com', '$2y$10$n1B.FdHNwufTkmzp/pNqc.EiwjB8quQ1tBCEC7nkaldI5pS.et04e', 'Gabriel Mougard', 'Actif'),
(5, 'victor.martin@gmail.com', '$2y$10$s57SErOPlgkIZf1lxzlX3.hMt8LSSKaYig5rusxghDm7LW8RtQc/W', 'Victor Martin',  'Actif'),
(6, 'thomas.nguyen@gmail.com', '$2y$10$mfMXnH.TCmg5tlYRhqjxu.ILly8s9.qsLKOpyxgUl6h1fZt6x/B5C', 'Thomas Nguyen','Actif');

--
-- Indexes for dumped tables
--

--
-- clé primaire
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);



--
-- auto-incrémentation
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;