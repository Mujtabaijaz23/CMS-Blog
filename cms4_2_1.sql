-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 05:22 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms4.2.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `abio` varchar(500) NOT NULL,
  `aimage` varchar(60) NOT NULL DEFAULT 'comment.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `abio`, `aimage`, `addedby`) VALUES
(1, 'January-13-2019 11:04', 'Mushi', '1234', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Profileimage.jpg', 'Muj'),
(2, 'May-27-2019 16:06:43', 'Haaris', '12345', 'Haaris', '', '', 'comment.png', 'Mushi');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(3, 'Europe', 'Mushi', 'January-17-2019 11:50'),
(4, 'South America', 'Zishan', 'June-11-2019 13:05'),
(5, 'Asia', 'Mushi', 'January-17-2019 11:45'),
(6, 'Africa', 'Mushi', 'January-17-2019 11:40');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`) VALUES
(4, 'May-29-2019 18:44:58', 'Malik', 'malik@gmail.com', 'Amazing Place, Thanks for the info ', 'Mushi Ijaz', 'ON', 10),
(5, 'May-29-2019 18:46:02', 'Zayn', 'Zayn143@gmail.com', 'This place is fantastic I\'m planning my holiday to go this summer to sri lanaka.', 'Mushi Ijaz', 'ON', 8),
(6, 'May-29-2019 18:46:43', 'Kiki', 'Kikidoyouloveme@gmail.com', 'Wowo did not expet this country to be that safe.', 'Pending', 'OFF', 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(3, 'May-29-2019 16:02:16', 'Ruins of Italy', 'Europe', 'Mushi', 'Italy.jpg', '                  Italy is a must-visit country and is one of the most-traveled destinations in Europe. There are so many highlights in this beautiful country â€” from the canals of Venice to the Tuscan wine lands to the cobblestone streets of Rome to the Arno river running through Florence to the cliffs of Positanoâ€¦ and beyond.\r\n\r\nFlorence was one of my favorite cities because of the architecture and natural beautyâ€” the sun setting over the Arno River is something you canâ€™t soon forget.\r\n\r\nRome is one of the most iconic and most traveled cities in Europe and you could spend days getting lost in this magnificent destination. The most picturesque spots in Italy might just be Cinque Terre and all the stops along the Amalfi Coast. Positano is the gem of the Amalfi Coast and is arguably the most picturesque and most romantic town in the whole of Italy.\r\nThe cheapest time of year to visit Italy is in the winter. From December to March, the cold weather keeps most travelers at bay, and you can explore the countryâ€™s incredible museums and galleries to your heartâ€™s content.\r\n\r\nYouâ€™ll also be in time for all the Christmas Markets and have an easier time finding cheap flights to Italy. Another affordable period is between April and May. The summer crowds have yet to arrive, and the countryside is covered in a blanket of blossoming flowers!\r\n\r\nHowever, there really is no place like Italy in the summer. Even if itâ€™s crowded, itâ€™s-ah amazing!                '),
(4, 'May-29-2019 16:13:05', 'The Birthplace of Amazon Brazil', 'South America', 'Mushi', 'Brazil.jpg', 'Christ the Redeemer is one of the New Seven Wonders of the World. Built in 1931 on Mt. Corcovadoâ€™s peak, itâ€™s become the cultural icon for both Rio and Brazil.\r\n\r\nThe best time to check out the statue is before 10:00 a.m. so hop in a taxi and avoid the lines and crowds. Have the driver drop you at the bottom, if you want to save some money, because rides to the top are more expensive.\r\n\r\nYou have the option to take the tram up the mountain to Cristo. If the line is too long, take one of the vans that offers group rides to the last stop before taking an official van to the top!\r\n\r\nEither way, you will need to take one of the official vans for the final leg to Cristo Redentor. Thereâ€™s a nice and inexpensive cafe at the top, which offers snacks and drinks!\r\n\r\nHelpful Tip: The tram does accept credit cards, but the vans do require cashâ€”so make sure to have some handy!\r\nThe cafezinho (little espresso) is a popular welcome drink in Brazil that is often imbibed at work, at home, and at sophisticated boutiques.\r\n\r\nThe minute you walk through any door, donâ€™t be surprised if someone asks you â€œvocÃª quer um cafezinho?â€\r\n\r\nâ€¦when in Rome!\r\nDo as the Brazilians do and pair a cafezinho with a pÃ£o de queijo (cheese bread). A highly recommend cafÃ© in Leblon is called CafeÃ­na, so be sure to check that out!\r\nThe Sugar Loaf Cable Car will take you from Praia Vermelha to Sugarloaf Mountain. It reaches the summit of 1,300 feet with a stop at Morro da Urca along the way.\r\n\r\nOpened in 1912, the Sugar Loaf Cable Car has been in continual use and was even the site for the 1979 James Bond film, Moonraker. The cars run every 30 minutes and have a total of 2,500 visitors each dayâ€”so come early to avoid the lines!\r\n\r\nAt the Urca station, youâ€™ll find a credit card-friendly cafe, snack bar, and restaurant as well as some souvenir stands and a childrenâ€™s area.'),
(5, 'May-29-2019 16:17:19', 'France The City of Lights', 'Europe', 'Mushi', 'France.jpg', '                                    When it comes to tourism in France, Paris is at the top of many travelersâ€™ bucket lists and for a good reason. The city is full of incredible history, architecture, art, charm, and distinct cuisine. Whether you have a day, a week, or a month to explore, Paris is a travel experience in its own.\r\n\r\nParis sure does dominate the headlines, but this doesnâ€™t mean other French cities should be overlooked! Be sure to visit the French countryside, the region of Provence, Bordeaux, the island of Corsica, and the French Riviera â€“ my favorite spot in France! The French Riviera (or CÃ´te dâ€™Azur) is the Mediterranean coast of southern France, and comprises the charming resort towns of Marseille, St. Tropez, Cannes, Nice and the tiny nation of Monaco!\r\nThe best time to visit France is during its shoulder seasons. From April to June and September to November, youâ€™ll have an easier time finding cheap flights from the US and hotelâ€™s lower their rates.\r\n\r\nPlus, youâ€™ll miss the summer crowds and spend less time waiting in lines trying to catch a glimpse of the Mona Lisa in the Louvre Museum.\r\n\r\nIf youâ€™re planning to visit France over the summer (June to August), be sure to book your accommodation well in advance. Itâ€™s the busiest time of year for the country, especially in Paris and Cannes.\r\n\r\nCheck out my guide The Best Time to Travel to France for all the details!                                '),
(6, 'May-29-2019 16:25:13', 'Japan The Land of Rising Sun', 'Asia', 'Mushi', 'Japan.jpg', 'Youâ€™ve never been anywhere like Golden Gai. A throwback to days gone by, this area of the Shinjuku district gives you a glimpse into what the city looked like in the 1950s.\r\n\r\nWith endless shanty-style bars and interesting architecture, this is not your usual nightlife scene. Most of the bars are just a few feet wide and offer a real one-of-a-kind experience.\r\nGolden Gai, also known as the Golden District, is made up of six incredibly tiny alleys jam-packed with almost two hundred bars. This area actually started out as a black market in the 1950s and still looks pretty much the same. It was famous for prostitution until the sixties when it becoming a drinking hot spot.\r\n\r\nDuring the eighties, the bar owners guarded the area around the clock to prevent the Yakuza from burning the bars down.\r\nGolden Gai is located within Tokyoâ€™s Shinjuku District. Itâ€™s less than a ten-minute walk from the east exit of Shinjuku station.\r\n\r\nEach bar has different hours, but generally, the neighborhood operates from 5:30 p.m. to 5:00 a.m. Things are in full swing around eleven p.m.\r\n\r\nMost of the bars donâ€™t serve food, so youâ€™ll want to go for dinner before drinks. For the culinary equivalent of Golden Gai, check out Omoide Yokocho. Full of tiny hole-in-the-wall eateries, this little street serves up authentic Japanese grub.\r\n\r\nFor a totally unforgettable dinner and show before the bar, check out the nearby Robot Restaurant in Tokyo!'),
(7, 'May-29-2019 16:27:36', 'Magical Place of Indonisia ', 'Asia', 'Mushi', 'Indonesia.jpg', 'Indonesia is made up of a whopping 17,800 islandsâ€”something that would take you a lifetime to explore! It is also home to a vast range of fauna and flora as well as countless linguistic and ethnic groups and incredible landscapes. I canâ€™t emphasize enough how much you need to visit (and spend time in) this beautiful country!\r\n\r\nI have frequented the island of Bali, visited the dragons of Komodo Island, trekked to the peak of the Kelimutu volcanic lakes, explored the island of Lombok, and went scuba diving throughout the Gili Islands and Raja Ampat. Indonesia has some of the most pristine underwater landscapes and marine lifeâ€”if you like diving (whether avid or advanced), Indonesia is bucket list status.\r\nThe best time to travel to Indonesia is during the dry season. From May to September the days are hot, dry, and thereâ€™s not a rain cloud in sight!\r\n\r\nYouâ€™ll have excellent weather for scuba diving, hiking and lazy days at the beach.\r\n\r\nIndonesiaâ€™s wet season is from October to April. While there are intense tropical downpours almost daily, the showers only last an hour or two and wonâ€™t ruin your entire day.\r\n\r\nIf you donâ€™t mind the less than perfect weather, youâ€™ll find cheaper hotel rates, airlines drop their prices, and there are fewer crowds at the top attractions.'),
(8, 'May-29-2019 16:29:42', 'Sri Lanka a Land Like no Other', 'Asia', 'Mushi', 'Srilanka.jpg', '                                    Often lost between the tourist hot spots of the Maldives and India, Sri Lanka is an undiscovered gem of Asia. Diverse, multicultural, and drop-dead gorgeous, this country deserves to be on every travelerâ€™s bucket list.\r\n\r\nI was lucky enough to experience the North Central province as a part of TBCasia 2016 Conference by Cinnamon Hotels this past June, and want to share these amazing spots with you.\r\nAnuradhapura has an amazing history. This UNESCO World Heritage cultural site was the political and religious capital for the Ceylonese people for more than 1,300 years before it was abandoned. After being lost in the dense jungle for years, this breathtaking city is thriving once again.\r\n\r\nAnuradhapura is an architectural and archaeological wonder that is home to countless monuments, stupas, monasteries, and palaces\r\nThe stunning rock fortress of Sigiriya is well worth the trip. This 660-foot-tall rock has been a cultural centerpiece for centuries. It was home to the king nearly 2,000 years ago and was later used for a Buddhist monastery.\r\n\r\nAlso listed as a UNESCO World Heritage cultural site, this is one of the planetâ€™s best-preserved examples of ancient urban planning.\r\n\r\nWhile the walk to the top might seem intense, itâ€™s not actually as bad as it looks, and the view from above makes it worth every step                                '),
(9, 'May-29-2019 16:34:44', 'Egypt The Forgotten Kingdom', 'Africa', 'Mushi', 'Egypt.jpg', '                                    Egypt occupied a top spot on my bucket list for ages. With such a rich history and unique culture, it has always fascinated me. However, Iâ€™ll be honest. Iâ€™d been holding off on traveling to Egypt because of the stories Iâ€™d heard of women having negative experiences there.\r\n\r\nWhile Iâ€™d always argue that other peopleâ€™s travel experiences donâ€™t predict your own, I was hesitant to visit Egypt.\r\n\r\nThereâ€™s no wrong or right way to travelâ€”thatâ€™s for sure. And one personâ€™s experience doesnâ€™t automatically mean that itâ€™s going to be the same for someone else. Good or bad. I appreciate honest accounts of travel experiences because it helps me understand when I really need to do my research and decide if itâ€™s the right destination for me or not.\r\n\r\nSome destinations I feel totally comfortable traveling to on a whim without doing an ounce of research. But, even with so much confidence in myself traveling on my own, there are still some places I research tirelessly and make plans to ensure my safety.\r\n\r\nThis was one of those places.\r\n\r\nIâ€™m so happy that I had such a positive experience on my first trip to Egypt. I met so many insanely friendly locals (a total stranger literally handed me their baby) and got to live out my lifelong dream of seeing the creations of Ancient Egyptians with my own two eyes.                                '),
(10, 'May-29-2019 16:41:49', 'Morocco a Place of Wonders', 'Africa', 'Mushi', 'Morocco.jpg', 'Morocco is a country that draws you in. From the colorful, heady markets filled with the rich scents of spices to the vibrant Atlas Mountains, there is just so much to see in this incredible North African country.\r\n\r\nWhile you can have a great time hitting up the main spots over a few days, I highly recommend lingering in Morocco for a week or two to uncover all of the hidden treasures. Keep in mind that Morocco is a more conservative country, so itâ€™s important to be aware of your surroundings, especially as a female traveler.\r\nMorocco is a great year-round destination. With its coastline, mountains, and desert landscapes, itâ€™s an incredibly diverse country that offers something unique to see any time of the year. January is the wettest and coldest month and July and August are the hottestâ€“ so youâ€™ll find theyâ€™re the least crowded. Spring (March & April) and Fall (September & October) have the most pleasant weather.'),
(11, 'May-29-2019 16:45:50', 'Ancient Greek the Island of Greece ', 'Europe', 'Mushi', 'Greece.jpg', 'Greece: where historic ruins, volcanic cliffs, and friendly locals meet the blue Mediterranean Sea. My first trip to Greece was a summer adventure through Athens and Mykonos. I returned again to sail the Saronic Islands on The Yacht Week Greece. There are some islands that are famous for their beaches and natural features, while others have a significant nightlife scene or strong cultural traditions.\r\n\r\nMykonos is one of the most popular tourist destinations in the Greek islands and is famed for its incredible beaches and world-renowned party scene. I spent a week on the island and indulged in delicious food, epic sunsets and some of the best parties Iâ€™ve ever been to. Donâ€™t forget to visit the capital, Athens, and explore the Acropolis and the Parthenon!\r\nIn my opinion, the best time to travel to Greece is between April and May. The weather is perfect for outdoor adventures, and youâ€™ll have the Greek Islands to yourself before the summer crowds arrive.\r\n\r\nThe one event you need to plan your trip around is the Easter weekend. Itâ€™s an incredibly busy time in the country and hotels are often booked up a few weeks in advance.\r\n\r\nIf youâ€™re traveling Greece on a budget or you want to avoid the crowds, the winter months are the best time to visit. The top attractions are void of other tourists, and you wonâ€™t have a problem finding cheap flights and hotel deals.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
