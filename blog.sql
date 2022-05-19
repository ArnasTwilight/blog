-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2022 at 12:13 PM
-- Server version: 8.0.24
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(9, 'Game'),
(2, 'Other'),
(1, 'PC'),
(4, 'Science'),
(17, 'TestCategory'),
(18, 'TestCategory2'),
(19, 'TestCategory3');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `category` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `date_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `short_content` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_new` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category`, `title`, `date_post`, `short_content`, `content`, `is_new`) VALUES
(30, 2, 'What is Lorem Ipsum?', '2022-05-10 12:55:39', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL),
(31, 2, 'Why do we use it?', '2022-05-10 12:55:54', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL),
(32, 2, 'Where does it come from?', '2022-05-10 12:56:07', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one ', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', NULL),
(33, 2, 'Where can I get some?', '2022-05-10 12:56:19', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, yo', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', NULL),
(34, 9, 'Game post', '2022-05-10 12:58:10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla. Donec eu porta elit. Cras ut aliquam lectus. In dictum nisl id risus vestibulum porta. Aenean tempus a eros a tristique. Fusce at iaculis leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In blandit eget ligula a consectetur.<br />\r\n<br />\r\nMorbi elit nibh, vestibulum a lorem sed, viverra fermentum dui. Vivamus pharetra purus vitae arcu congue, id varius lectus faucibus. Praesent tristique lacinia odio in hendrerit. Integer ut viverra eros. Vivamus iaculis fringilla sapien, vel venenatis mi molestie ut. Proin pretium nunc ut leo venenatis feugiat. Proin non tincidunt enim. Aliquam euismod pellentesque nisl, pretium imperdiet metus ullamcorper at. Mauris eu tortor rhoncus metus consequat placerat. Mauris tincidunt nunc a sem tempor imperdiet. Nulla facilisi.<br />\r\n<br />\r\nSed sagittis tortor non leo aliquam euismod. In hac habitasse platea dictumst. Donec nec fringilla ante, in viverra eros. Maecenas porttitor faucibus ante in posuere. Phasellus eleifend blandit metus, eget venenatis turpis dictum at. Proin condimentum quam non congue condimentum. Duis in nisi nec felis porta dapibus a ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent consequat turpis nec nibh aliquam, eget maximus lectus semper. Aliquam et laoreet nisl. Ut eu consectetur velit, quis commodo quam. Vivamus auctor ut tortor sodales finibus. Nullam tincidunt molestie venenatis. Class aptent taciti.', NULL),
(35, 4, 'Science post', '2022-05-10 12:58:21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla. Donec eu porta elit. Cras ut aliquam lectus. In dictum nisl id risus vestibulum porta. Aenean tempus a eros a tristique. Fusce at iaculis leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In blandit eget ligula a consectetur.<br />\r\n<br />\r\nMorbi elit nibh, vestibulum a lorem sed, viverra fermentum dui. Vivamus pharetra purus vitae arcu congue, id varius lectus faucibus. Praesent tristique lacinia odio in hendrerit. Integer ut viverra eros. Vivamus iaculis fringilla sapien, vel venenatis mi molestie ut. Proin pretium nunc ut leo venenatis feugiat. Proin non tincidunt enim. Aliquam euismod pellentesque nisl, pretium imperdiet metus ullamcorper at. Mauris eu tortor rhoncus metus consequat placerat. Mauris tincidunt nunc a sem tempor imperdiet. Nulla facilisi.<br />\r\n<br />\r\nSed sagittis tortor non leo aliquam euismod. In hac habitasse platea dictumst. Donec nec fringilla ante, in viverra eros. Maecenas porttitor faucibus ante in posuere. Phasellus eleifend blandit metus, eget venenatis turpis dictum at. Proin condimentum quam non congue condimentum. Duis in nisi nec felis porta dapibus a ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent consequat turpis nec nibh aliquam, eget maximus lectus semper. Aliquam et laoreet nisl. Ut eu consectetur velit, quis commodo quam. Vivamus auctor ut tortor sodales finibus. Nullam tincidunt molestie venenatis. Class aptent taciti.', NULL),
(36, 1, 'PC post', '2022-05-10 12:58:28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae quam in dolor eleifend iaculis ac nec eros. Sed cursus aliquam arcu ut semper. Mauris dictum ut orci nec molestie. Aliquam erat volutpat. Vivamus id efficitur libero, eget rhoncus nulla. Donec eu porta elit. Cras ut aliquam lectus. In dictum nisl id risus vestibulum porta. Aenean tempus a eros a tristique. Fusce at iaculis leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In blandit eget ligula a consectetur.<br />\r\n<br />\r\nMorbi elit nibh, vestibulum a lorem sed, viverra fermentum dui. Vivamus pharetra purus vitae arcu congue, id varius lectus faucibus. Praesent tristique lacinia odio in hendrerit. Integer ut viverra eros. Vivamus iaculis fringilla sapien, vel venenatis mi molestie ut. Proin pretium nunc ut leo venenatis feugiat. Proin non tincidunt enim. Aliquam euismod pellentesque nisl, pretium imperdiet metus ullamcorper at. Mauris eu tortor rhoncus metus consequat placerat. Mauris tincidunt nunc a sem tempor imperdiet. Nulla facilisi.<br />\r\n<br />\r\nSed sagittis tortor non leo aliquam euismod. In hac habitasse platea dictumst. Donec nec fringilla ante, in viverra eros. Maecenas porttitor faucibus ante in posuere. Phasellus eleifend blandit metus, eget venenatis turpis dictum at. Proin condimentum quam non congue condimentum. Duis in nisi nec felis porta dapibus a ut ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent consequat turpis nec nibh aliquam, eget maximus lectus semper. Aliquam et laoreet nisl. Ut eu consectetur velit, quis commodo quam. Vivamus auctor ut tortor sodales finibus. Nullam tincidunt molestie venenatis. Class aptent taciti.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`) VALUES
(10, 'Hex', 'anerios@index.test', '$2y$10$dtwZl9lJ3Y1B1voT3f5cd.Dkz9e5IMF0zo88iayLMu2s8SuJ62rFG', NULL),
(23, 'Sa', 'man@man.com', '$2y$10$9tvbjgazrSkoNl23izf5PeiFvfRXBmLZPBsRkvZTI/4KnIMmvsFny', NULL),
(30, 'Admin', 'admin@mail.com', '$2y$10$zMnkKhMSbWwTa2R.AePWtefkRE34HCdJvn6h82/iQEyEfftFdRBmK', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
