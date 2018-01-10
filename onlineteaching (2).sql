-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 10 jan. 2018 à 16:18
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `onlineteaching`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `pk_category_id` int(11) NOT NULL,
  `category_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`pk_category_id`, `category_name`) VALUES
(1, 'Computer Science'),
(2, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `pk_content_id` int(11) NOT NULL,
  `content_name` varchar(45) DEFAULT NULL,
  `content_text` text,
  `fk_subject_id` int(11) NOT NULL,
  `fk_quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `content`
--

INSERT INTO `content` (`pk_content_id`, `content_name`, `content_text`, `fk_subject_id`, `fk_quiz_id`) VALUES
(1, 'Leçon 1', 'Voici encore une notion très importante en programmation. Une exception est une erreur se produisant dans un programme qui conduit le plus souvent à l\'arrêt de celui-ci. Il vous est sûrement déjà arrivé d\'obtenir un gros message affiché en rouge dans la console d\'Eclipse : eh bien, cela a été généré par une exception… qui n\'a pas été capturée.\r\n\r\nLe fait de gérer les exceptions s\'appelle aussi « la capture d\'exception ». Le principe consiste à repérer un morceau de code (par exemple, une division par zéro) qui pourrait générer une exception, de capturer l\'exception correspondante et enfin de la traiter, c\'est-à-dire d\'afficher un message personnalisé et de continuer l\'exécution.', 1, 9),
(3, 'test content 2', 'Voici un video', 1, NULL),
(19, 'Subject 1', 'Welcome to this C# tutorial. With the introduction of the .NET framework, Microsoft included a new language called C# (pronounced C Sharp). C# is designed to be a simple, modern, general-purpose, object-oriented programming language, borrowing key concepts from several other languages, most notably Java.', 9, 6),
(20, 'Classe', 'Les objets contiennent des attributs et des méthodes. Les attributs sont des variables ou des objets nécessaires au fonctionnement de l\'objet. En Java, une application est un objet. La classe est la description d\'un objet. Un objet est une instance d\'une classe. Pour chaque instance d\'une classe, le code est le même, seules les données sont différentes à chaque objet.', 10, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contentbymember`
--

CREATE TABLE `contentbymember` (
  `pk_contentByMember_id` int(11) NOT NULL,
  `contentByMember_date` datetime DEFAULT NULL,
  `fk_member_id` int(11) NOT NULL,
  `fk_content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contentbymember`
--

INSERT INTO `contentbymember` (`pk_contentByMember_id`, `contentByMember_date`, `fk_member_id`, `fk_content_id`) VALUES
(1, '2017-11-14 00:00:00', 2, 1),
(2, '2017-12-31 15:21:21', 1, 1),
(3, '2017-12-31 15:21:24', 1, 3),
(4, '2017-12-12 00:10:26', 1, 20),
(6, '2017-12-12 00:12:32', 1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `pk_course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `fk_language_id` int(11) NOT NULL,
  `fk_subCategory_id` int(11) NOT NULL,
  `fk_member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`pk_course_id`, `course_name`, `fk_language_id`, `fk_subCategory_id`, `fk_member_id`) VALUES
(1, 'Introduction à la programmation avancée en Java', 1, 2, 1),
(11, 'Introduction To C# Programming ', 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `pk_language_id` int(11) NOT NULL,
  `language_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`pk_language_id`, `language_name`) VALUES
(2, 'english'),
(1, 'francais');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `pk_media_id` int(11) NOT NULL,
  `media_path` varchar(255) NOT NULL,
  `media_name` varchar(45) DEFAULT NULL,
  `media_type` varchar(45) DEFAULT NULL,
  `fk_content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`pk_media_id`, `media_path`, `media_name`, `media_type`, `fk_content_id`) VALUES
(1, 'Media/1/18b36f77cc9c46beff536ec39d372231.jpg', 'Exception', '.jpg', 1),
(2, 'Media/1/4e0fde9b10d02a45e133e23568cc4f3d.mp4', 'test video', '.mp4', 3),
(10, 'Media/1/054bf16a21c11b2dd71499c040985b4a.png', 'C# oop', '.png', 19),
(11, 'Media/1/5fd9d942bf565cd7cc8c272119bcad4b.png', 'Image de classe ', '.png', 20);

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `pk_member_id` int(11) NOT NULL,
  `member_lastName` varchar(45) DEFAULT NULL,
  `member_firstName` varchar(45) DEFAULT NULL,
  `member_userName` varchar(45) DEFAULT NULL,
  `member_password` varchar(100) DEFAULT NULL,
  `member_email` varchar(75) DEFAULT NULL,
  `fk_memberType_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`pk_member_id`, `member_lastName`, `member_firstName`, `member_userName`, `member_password`, `member_email`, `fk_memberType_id`) VALUES
(1, 'zeroug', 'mohammed', 'mzeroug', '5f4dcc3b5aa765d61d8327deb882cf99', 'mzeroug@yopmail.com', 1),
(2, 'corriveau', 'mickey', 'mcorriveau', '5f4dcc3b5aa765d61d8327deb882cf99', 'mcorriveau@yopmail.com', 2);

-- --------------------------------------------------------

--
-- Structure de la table `membertype`
--

CREATE TABLE `membertype` (
  `pk_memberType_id` int(11) NOT NULL,
  `memberType_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membertype`
--

INSERT INTO `membertype` (`pk_memberType_id`, `memberType_name`) VALUES
(3, 'admin'),
(2, 'student'),
(1, 'teacher');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `pk_question_id` int(11) NOT NULL,
  `question_question` varchar(255) DEFAULT NULL,
  `question_answer` varchar(255) DEFAULT NULL,
  `question_points` decimal(10,0) DEFAULT NULL,
  `fk_quiz_id` int(11) NOT NULL,
  `fk_questionType_id` int(11) NOT NULL,
  `question_choix1` varchar(255) DEFAULT NULL,
  `question_choix2` varchar(255) DEFAULT NULL,
  `question_choix3` varchar(255) DEFAULT NULL,
  `question_choix4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`pk_question_id`, `question_question`, `question_answer`, `question_points`, `fk_quiz_id`, `fk_questionType_id`, `question_choix1`, `question_choix2`, `question_choix3`, `question_choix4`) VALUES
(1, 'Java est un langage', 'Compilé et interprété', '10', 1, 1, 'Compilé', 'Interprété', 'Compilé et interprété', 'Ni compilé ni interprété'),
(2, 'Java est un langage développé par', 'Sun Microsystems', '20', 1, 1, 'Hewlett-Packard', 'Sun Microsystems', 'Microsoft', 'Oracle'),
(3, 'Combien d’instances de la classe A crée le code suivant?\r\n\r\nA x,u,v;\r\nx=new A();\r\nA y=x;\r\nA z=new A();\r\n', 'Deux', '70', 1, 1, 'Aucune\r\n', 'Cinq', 'Trois', 'Deux'),
(8, '1', '1', '20', 4, 1, '1', '2', '3', '4'),
(9, '2', '2', '20', 4, 4, '1', '2', '3', '4'),
(10, '3', '3', '20', 4, 5, '', '', '', ''),
(11, '4', '4', '20', 4, 3, '', '', '', ''),
(12, '5', 'true', '20', 4, 2, '', '', '', ''),
(18, 'question 1', '1', '20', 6, 1, '1', '2', '3', '4'),
(19, 'question 2 ', '2', '20', 6, 4, '1', '2', '3', '4'),
(20, 'question 3', '3', '20', 6, 5, '', '', '', ''),
(21, 'question 4', '4', '20', 6, 3, '', '', '', ''),
(22, 'question 5', 'true', '20', 6, 2, '', '', '', ''),
(29, 'Java est un langage?', 'compilé et interprété', '10', 9, 1, 'compilé', 'interprété', 'compilé et interprété', 'ni compilé ni interprété'),
(30, 'Java est un langage développé par?', 'sun microsystems', '20', 9, 1, 'hewlett-packard', 'sun microsystems', 'microsoft', 'oracle'),
(31, 'Combien d’instances de la classe A crée le code suivant?  A x,u,v; x=new A(); A y=x; A z=new A();', 'deux', '70', 9, 1, 'aucune', 'cinq', 'trois', 'deux');

-- --------------------------------------------------------

--
-- Structure de la table `questionbymember`
--

CREATE TABLE `questionbymember` (
  `pk_questionByMember_id` int(11) NOT NULL,
  `questionByMember_answer` varchar(255) DEFAULT NULL,
  `fk_member_id` int(11) NOT NULL,
  `fk_question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questionbymember`
--

INSERT INTO `questionbymember` (`pk_questionByMember_id`, `questionByMember_answer`, `fk_member_id`, `fk_question_id`) VALUES
(1, 'Compilé et interprété', 2, 1),
(2, '1', 1, 8),
(3, '2', 1, 9),
(4, '3', 1, 10),
(5, '4', 1, 11),
(6, 'false', 1, 12),
(12, '1', 1, 18),
(13, '2', 1, 19),
(14, '3', 1, 20),
(15, '4', 1, 21),
(16, 'false', 1, 22),
(17, 'compil?? et interpr??t??', 1, 1),
(18, 'sun microsystems', 1, 2),
(19, 'deux', 1, 3),
(23, 'compilé et interprété', 1, 29),
(24, 'sun microsystems', 1, 30),
(25, 'cinq', 1, 31);

-- --------------------------------------------------------

--
-- Structure de la table `questiontype`
--

CREATE TABLE `questiontype` (
  `pk_questionType_id` int(11) NOT NULL,
  `questionType_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questiontype`
--

INSERT INTO `questiontype` (`pk_questionType_id`, `questionType_name`) VALUES
(1, 'Drop Down List'),
(4, 'Multiple Choice'),
(5, 'Numeric'),
(3, 'Textual Answer'),
(2, 'True or False');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `pk_quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(45) DEFAULT NULL,
  `quiz_total` decimal(10,0) DEFAULT NULL,
  `fk_member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`pk_quiz_id`, `quiz_name`, `quiz_total`, `fk_member_id`) VALUES
(1, 'test', '100', 1),
(3, 'bla test ', '100', 2),
(4, 'All in One', '100', 1),
(6, 'all in one 2 ', '100', 1),
(7, 'old test', '100', 1),
(9, 'replaced test', '100', 1);

-- --------------------------------------------------------

--
-- Structure de la table `subcategory`
--

CREATE TABLE `subcategory` (
  `pk_subCategory_id` int(11) NOT NULL,
  `subCategory_name` varchar(45) DEFAULT NULL,
  `fk_category_id` int(11) NOT NULL,
  `subCategory_imagePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subcategory`
--

INSERT INTO `subcategory` (`pk_subCategory_id`, `subCategory_name`, `fk_category_id`, `subCategory_imagePath`) VALUES
(1, 'Object Oriented Programming', 1, 'Media/SubCategory/oop.png'),
(2, 'Programmation Orienté Objet', 2, 'Media/SubCategory/poo.gif');

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

CREATE TABLE `subject` (
  `pk_subject_id` int(11) NOT NULL,
  `subject_name` varchar(45) DEFAULT NULL,
  `fk_course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`pk_subject_id`, `subject_name`, `fk_course_id`) VALUES
(1, 'Chapitre 1', 1),
(9, 'Chapter 1', 11),
(10, 'Chapitre 2', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`pk_category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`pk_content_id`,`fk_subject_id`),
  ADD KEY `fk_Content_Subject1_idx` (`fk_subject_id`),
  ADD KEY `fk_quiz_id` (`fk_quiz_id`);

--
-- Index pour la table `contentbymember`
--
ALTER TABLE `contentbymember`
  ADD PRIMARY KEY (`pk_contentByMember_id`,`fk_member_id`,`fk_content_id`),
  ADD KEY `fk_ContentByMember_Member1_idx` (`fk_member_id`),
  ADD KEY `fk_ContentByMember_Content1_idx` (`fk_content_id`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`pk_course_id`,`fk_language_id`,`fk_subCategory_id`),
  ADD KEY `fk_Course_Language_idx` (`fk_language_id`),
  ADD KEY `fk_Course_SubCategory1_idx` (`fk_subCategory_id`),
  ADD KEY `fk_Course_Member` (`fk_member_id`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`pk_language_id`),
  ADD UNIQUE KEY `language_name_UNIQUE` (`language_name`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`pk_media_id`,`fk_content_id`),
  ADD KEY `fk_Media_Content1_idx` (`fk_content_id`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`pk_member_id`,`fk_memberType_id`),
  ADD UNIQUE KEY `member_userName_UNIQUE` (`member_userName`),
  ADD KEY `fk_Member_MemberType1_idx` (`fk_memberType_id`);

--
-- Index pour la table `membertype`
--
ALTER TABLE `membertype`
  ADD PRIMARY KEY (`pk_memberType_id`),
  ADD UNIQUE KEY `memberType_name` (`memberType_name`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`pk_question_id`,`fk_quiz_id`,`fk_questionType_id`),
  ADD KEY `fk_Question_Quiz1_idx` (`fk_quiz_id`),
  ADD KEY `fk_Question_QuestionType1_idx` (`fk_questionType_id`);

--
-- Index pour la table `questionbymember`
--
ALTER TABLE `questionbymember`
  ADD PRIMARY KEY (`pk_questionByMember_id`,`fk_member_id`,`fk_question_id`),
  ADD KEY `fk_QuestionByMember_Member1_idx` (`fk_member_id`),
  ADD KEY `fk_QuestionByMember_Question1_idx` (`fk_question_id`);

--
-- Index pour la table `questiontype`
--
ALTER TABLE `questiontype`
  ADD PRIMARY KEY (`pk_questionType_id`),
  ADD UNIQUE KEY `questionType_name` (`questionType_name`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`pk_quiz_id`),
  ADD KEY `Quiz_Member_Idx` (`fk_member_id`);

--
-- Index pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`pk_subCategory_id`,`fk_category_id`),
  ADD KEY `fk_SubCategory_Category1_idx` (`fk_category_id`);

--
-- Index pour la table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`pk_subject_id`,`fk_course_id`),
  ADD KEY `fk_Subject_Course1_idx` (`fk_course_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `pk_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `content`
--
ALTER TABLE `content`
  MODIFY `pk_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `contentbymember`
--
ALTER TABLE `contentbymember`
  MODIFY `pk_contentByMember_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `pk_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `pk_language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `pk_media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `pk_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `membertype`
--
ALTER TABLE `membertype`
  MODIFY `pk_memberType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `pk_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `questionbymember`
--
ALTER TABLE `questionbymember`
  MODIFY `pk_questionByMember_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `questiontype`
--
ALTER TABLE `questiontype`
  MODIFY `pk_questionType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `pk_quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `pk_subCategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `subject`
--
ALTER TABLE `subject`
  MODIFY `pk_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_Content_Subject1` FOREIGN KEY (`fk_subject_id`) REFERENCES `subject` (`pk_subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Quiz_Id` FOREIGN KEY (`fk_quiz_id`) REFERENCES `quiz` (`pk_quiz_id`);

--
-- Contraintes pour la table `contentbymember`
--
ALTER TABLE `contentbymember`
  ADD CONSTRAINT `fk_ContentByMember_Content1` FOREIGN KEY (`fk_content_id`) REFERENCES `content` (`pk_content_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ContentByMember_Member1` FOREIGN KEY (`fk_member_id`) REFERENCES `member` (`pk_member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_Course_Language` FOREIGN KEY (`fk_language_id`) REFERENCES `language` (`pk_language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Course_Member` FOREIGN KEY (`fk_member_id`) REFERENCES `member` (`pk_member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Course_SubCategory1` FOREIGN KEY (`fk_subCategory_id`) REFERENCES `subcategory` (`pk_subCategory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_Media_Content1` FOREIGN KEY (`fk_content_id`) REFERENCES `content` (`pk_content_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_Member_MemberType1` FOREIGN KEY (`fk_memberType_id`) REFERENCES `membertype` (`pk_memberType_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_Question_QuestionType1` FOREIGN KEY (`fk_questionType_id`) REFERENCES `questiontype` (`pk_questionType_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Question_Quiz1` FOREIGN KEY (`fk_quiz_id`) REFERENCES `quiz` (`pk_quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questionbymember`
--
ALTER TABLE `questionbymember`
  ADD CONSTRAINT `fk_QuestionByMember_Member1` FOREIGN KEY (`fk_member_id`) REFERENCES `member` (`pk_member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_QuestionByMember_Question1` FOREIGN KEY (`fk_question_id`) REFERENCES `question` (`pk_question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `Quiz_Member_Idx` FOREIGN KEY (`fk_member_id`) REFERENCES `member` (`pk_member_id`);

--
-- Contraintes pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_SubCategory_Category1` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`pk_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_Subject_Course1` FOREIGN KEY (`fk_course_id`) REFERENCES `course` (`pk_course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
