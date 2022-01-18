CREATE TABLE `Thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `User` (
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`login`)
);

CREATE TABLE `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadId` int(11) NOT NULL,
  `author` varchar(128) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `text` text,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`threadId`) REFERENCES `Thread` (`id`),
  FOREIGN KEY (`author`) REFERENCES `User` (`login`)
);

INSERT INTO `Thread` (`id`, `title`) VALUES
(1, 'Vos Pokémon préférés'),
(2, 'Donnez votre avis !');

INSERT INTO `User` (`login`, `password`) VALUES
('Professeur Chen', 'RougeEtBleu'),
('Régis', '23456'),
('Sacha', '12345');

INSERT INTO `Message` (`id`, `threadId`, `author`, `date`, `text`) VALUES
(1, 1, 'Professeur Chen', '2022-01-14 17:27:26', 'Parlez ici de vos Pokémon préférés !'),
(2, 1, 'Sacha', '2022-01-14 19:42:26', 'Pikachu !'),
(3, 1, 'Régis', '2022-01-14 21:42:26', 'Non tout mais pas lui !'),
(4, 2, 'Sacha', '2022-01-13 11:42:26', 'Est-ce que vous aimez ce forum que j’ai construit ?'),
(5, 2, 'Régis', '2022-01-14 20:42:26', 'Non, trop nul !');
