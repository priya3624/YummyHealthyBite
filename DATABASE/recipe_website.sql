-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 09:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_page`
--

CREATE TABLE `about_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_page`
--

INSERT INTO `about_page` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Info', '<p><strong>Welcome to our recipe website! </strong></p><p>We are passionate about sharing delicious recipes with food lovers from all around the world. Our team of experienced chefs and food enthusiasts work tirelessly to bring you a wide variety of mouthwatering dishes, ranging from traditional family recipes to innovative culinary creations. Whether you\'re a seasoned home cook or just starting your culinary journey, we have something for everyone.</p><p>Explore our collection of recipes, cooking tips, and techniques, and let us inspire you to create culinary masterpieces in your own kitchen.</p><p><em>Happy cooking!</em></p>', '2024-03-03 08:11:47', '2024-03-03 08:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`) VALUES
(1, 'Vinay', '1234', 'vinay@gmail.com'),
(2, 'admin', '1234', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `recipe_id`) VALUES
(18, 4, 11),
(19, 4, 17),
(20, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `ingredients` varchar(1000) NOT NULL,
  `instructions` varchar(2000) NOT NULL,
  `image_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `ingredients`, `instructions`, `image_url`) VALUES
(10, 'Butter Chicken', 'A delicious and creamy Indian chicken dish.', '500g boneless chicken, 2 tbsp butter, 1 cup yogurt, 1 tbsp ginger-garlic paste, 1 tsp garam masala, salt to taste', '<ol><li>Marinate the chicken in yogurt, ginger-garlic paste, garam masala, and salt for 1 hour.</li><li>Heat butter in a pan and add the marinated chicken. Cook until the chicken is tender and cooked through.</li><li>Serve hot with naan or rice.</li></ol>', '../images/butter_chicken.jpg'),
(11, 'Palak Paneer', 'A nutritious and flavorful Indian vegetarian dish made with spinach and cottage cheese.', '200g paneer, 2 bunches of spinach, 1 onion, 2 tomatoes, 2 green chilies, 1 tsp cumin seeds, salt to taste', '<ol><li>Blanch the spinach in boiling water for 2 minutes. Drain and blend into a smooth puree.</li><li>Heat oil in a pan and add cumin seeds. Once they splutter, add chopped onions and green chilies. Sauté until onions turn golden brown.</li><li>Add chopped tomatoes and cook until they turn soft. Then, add the spinach puree and cook for 5 minutes.</li><li>Add cubed paneer, salt, and simmer for another 5 minutes.</li><li>Serve hot with roti or rice.</li></ol>', '../images/palak_paneer.jpg'),
(13, 'Paneer Tikka', 'A popular vegetarian appetizer made with marinated paneer and grilled to perfection.', '200g paneer, 1 bell pepper, 1 onion, 1 tomato, 2 tbsp yogurt, 1 tbsp ginger-garlic paste, 1 tsp tandoori masala, salt to taste', '<ol>\r\n        <li>Cut paneer, bell pepper, onion, and tomato into cubes.</li>\r\n        <li>In a bowl, mix yogurt, ginger-garlic paste, tandoori masala, and salt. Add paneer and vegetables to the marinade. Mix well and let it marinate for 30 minutes.</li>\r\n        <li>Preheat the grill or oven to medium-high heat.</li>\r\n        <li>Thread the marinated paneer and vegetables onto skewers.</li>\r\n        <li>Grill the skewers for 10-12 minutes, turning occasionally, until the paneer and vegetables are lightly charred.</li>\r\n        <li>Serve hot with mint chutney or yogurt dip.</li>\r\n    </ol>', 'paneer_tikka.jpg'),
(14, 'Masala Dosa', 'A popular South Indian breakfast dish made with fermented rice and lentil batter.', '2 cups rice, 1 cup urad dal, 1/2 cup poha (flattened rice), 1/2 tsp fenugreek seeds, oil for cooking dosas, salt to taste', '<ol>\r\n        <li>Wash and soak rice, urad dal, fenugreek seeds, and poha together for 6-8 hours.</li>\r\n        <li>Drain and grind the soaked ingredients to a smooth batter. Add salt and mix well. Let the batter ferment overnight or for 8-10 hours.</li>\r\n        <li>Heat a flat pan or griddle and spread a ladleful of batter in a circular motion to make a thin dosa. Drizzle oil around the edges.</li>\r\n        <li>Cook until the dosa turns golden brown and crispy. Flip and cook the other side as well.</li>\r\n        <li>Serve hot with coconut chutney and sambar.</li>\r\n    </ol>', 'masala_dosa.jpg'),
(15, 'Chole Bhature', 'A popular North Indian dish consisting of spicy chickpea curry served with deep-fried bread.', '1 cup chickpeas, 2 onions, 2 tomatoes, 2 green chilies, 1 tbsp ginger-garlic paste, 1 tsp cumin seeds, 1 tsp garam masala, oil for frying, salt to taste', '<ol>\r\n        <li>Soak chickpeas overnight. Drain and pressure cook them until soft.</li>\r\n        <li>Heat oil in a pan and add cumin seeds. Once they splutter, add chopped onions and green chilies. Sauté until onions turn golden brown.</li>\r\n        <li>Add ginger-garlic paste and cook for a minute. Then, add chopped tomatoes and cook until they turn soft.</li>\r\n        <li>Add cooked chickpeas, garam masala, and salt. Cook for 10-15 minutes, allowing the flavors to blend.</li>\r\n        <li>For the bhature, knead a dough using all-purpose flour, yogurt, salt, and water. Let it rest for 1 hour.</li>\r\n        <li>Divide the dough into small portions and roll out into circular discs. Deep-fry the discs until they puff up and turn golden brown.</li>\r\n        <li>Serve hot chole with bhature, along with pickles or raita.</li>\r\n    </ol>', 'chole_bhature.jpg'),
(17, 'Pani Puri', 'A popular street food snack consisting of hollow puris filled with spicy tangy water and potato mixture.', '20 puris, 2 boiled potatoes, 1/2 cup tamarind chutney, 1/2 cup mint-coriander chutney, 1/2 cup spicy water, 1/2 cup sweet water', '<ol>\r\n        <li>Make a hole in each puri and fill it with a small portion of mashed boiled potatoes.</li>\r\n        <li>Add a spoonful of tamarind chutney and mint-coriander chutney into each puri.</li>\r\n        <li>Dip each filled puri into spicy water and then into sweet water.</li>\r\n        <li>Pop the entire puri into your mouth and enjoy the burst of flavors.</li>\r\n    </ol>', 'pani_puri.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Vinay', '1234', 'vinay@gmail.com'),
(4, 'test', '1234', 'test@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_page`
--
ALTER TABLE `about_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_page`
--
ALTER TABLE `about_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
