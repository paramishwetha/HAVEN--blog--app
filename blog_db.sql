-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2026 at 08:57 AM
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
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

CREATE TABLE `blogpost` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category` varchar(50) DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogpost`
--

INSERT INTO `blogpost` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `category`) VALUES
(1, 2, 'The Songs We Sing Unheard', 'In the vast expanse of the ocean, whale songs travel hundreds of miles through the dark, cold water. They do not sing to be loud; they sing because it is in their nature to reach out into the unknown, trusting that somewhere across the silent blue, another soul is listening.\r\n\r\nOur thoughts are much the same.\r\n\r\nWhen you write, you are sending out an echo:\r\n\r\nA reflection of a memory you hold dear.\r\n\r\nA truth you were once too hesitant to speak out loud.\r\n\r\nA small spark of light meant for anyone drifting in the dark.', '2026-08-14 16:51:31', '2026-08-14 16:51:31', 'General'),
(2, 2, 'Words as Anchors', 'A single sentence has the power to anchor an fleeting emotion before it vanishes into the currents of time. When we put pen to paper—or text to screen—we transform fragile moments into something enduring.\r\n\r\n\"We do not write to escape the world; we write so the world does not erase who we are.\"\r\n\r\nYour story does not need to be grand to be meaningful. It only needs to be honest. Whether it is a quiet realization on a rainy evening, an idea that keeps you awake at night, or a simple thought you wish to preserve, it deserves its place in the sanctuary of your mind..........', '2026-08-14 16:52:01', '2026-08-14 16:52:42', 'General'),
(3, 1, 'Reach the World', 'Never doubt the weight of your own voice. The ocean is vast, but it is made entirely of gentle, quiet drops.\r\n\r\nLet your thoughts surface. Give them shape, give them color, and let them ripple outward. Beautiful souls create beautiful stories—and like whale songs echoing across the deep, your voice was meant to reach the world.\r\n\r\nWhat echoes are you holding within today? Take a moment, dive beneath the surface, and give voice to your thought.', '2026-08-14 16:53:24', '2026-08-14 16:53:24', 'General'),
(4, 2, 'How are space photos taken? What does space really look like?', 'Imagining the cosmos\r\nImagine the enormous Universe in which the entire Earth with the whole of humanity is but a tiny undetectable speck. People have been doing just that for thousands of years. \r\n\r\nFor quite a while, we relied only on our eyes, regular observations, and calculations. Then, about 60 years ago, we made the first trip to space, and the lucky few experienced space first-hand.\r\n\r\nBut the big breakthrough that allowed us to take a closer look happened a bit earlier: the telescope entered the stage in the early 17th century.\r\n\r\nGalileo Galilei is often credited with the invention, although he only built upon the technology that had already existed. However, his version could magnify objects about 20–30 times, which was a lot. \r\n\r\nAdditionally, Galileo was the first to aim the telescope into the starry sky, leading to crucial astronomical discoveries and shaping our understanding of the Universe for ages to come.\r\n\r\n\r\nPhases of the Moon drawn by Galilei (1616)\r\nMost of us base our mental image of the vast Universe on movies, video games, sci-fi books, and firstly—on images released by NASA. You’ve certainly seen colorful and bright depictions of planets, stars, black holes, interstellar gas clouds, and galaxies. \r\n\r\nIs space as colorful in reality as we see it in the pictures? Let’s figure it out. \r\n\r\nNext up, we’ll discover which tools we rely on to get images of the Universe and find out how space looks. What are the most powerful telescopes? How does science put color and imagination into space pictures?\r\n\r\nThe machines that let us see the Universe and make space photos\r\nNowadays, we can watch the Universe almost constantly. The machines equipped with powerful telescopes and digital cameras take pictures of objects near and far. Let us briefly go through the list of technologies developed to see space closer.\r\n\r\n\r\nA-train and C-train: two “constellations” of Earth observation satellites that fly over the planet synchronously\r\nSatellites are objects in space orbiting larger objects (but not stars): think the Moon circling the Earth. Artificial satellites usually orbit the Earth. They may provide us with TV signals, communications, data for GPS, scientific observations, and monochrome images of the planet’s surface.\r\n\r\nProbes are spacecraft that don’t have a human crew. They too often have cameras and telescopes that collect space data. The first probe, Sputnik 1, was launched in 1957 to study Earth from space. Since then, space probes have completed numerous missions. Perhaps the most famous are Voyager 1 and Voyager 2, launched in 1977 to explore the distant planets of the Solar system and are now bound for interstellar space.\r\n\r\nRovers are robotic machines that explore the surface of other planets: namely, Mars. They deliver pictures and other scientific observations.\r\n\r\n\r\nA “selfie” of Perseverance, the most recently launched Mars rover, taken in September 2021\r\nIn terms of gazing deep into the Universe, telescopes have no equal. They have become much more powerful than Galileo’s. However, they still use the same principle of collecting electromagnetic waves from distant objects.\r\n\r\nThe waves of light we can see (we also say visible light) are also part of the electromagnetic spectrum — but there are many other types of waves. Essentially, they are all the same light that comes in different frequencies.\r\n\r\n\r\nThere are different types of telescopes able to work with different types of waves: for example, optical telescopes work with visible light, radio telescopes catch radio waves, and so on. The most powerful of them can capture objects billions of light-years away. A light-year is a distance light travels in one year. When we look at faraway objects, we see how they were all those years ago, when the light only started its journey in our direction. So technically, we can see back in time.', '2026-08-14 17:57:12', '2026-08-14 17:57:12', 'General'),
(5, 1, 'When Were Wristwatches Invented?', 'Many things in the world seem to exist forever. They are so usual and universally acknowledged that we often don’t think about where they came from. One of these things is a personal watch. So, when and how were wristwatches invented?\r\n\r\nThe early version of the wristwatch appeared in the 16th century as a gift to Elizabeth I of England. But, the Guinness Book holds records of another “first wristwatch”: that made in 1868 for Countess Koscowicz of Hungary by Swiss watchmaker Patek Philippe.\r\n\r\n\r\nThese noblewomen considered the wristlet primarily a hand accessory that was a relatively rare thing back then.\r\n\r\nNowadays, there is an enormous variety of wristwatches: waterproof and shock-resistant, steel and golden, mechanic and electronic – a myriad of models. The wristwatch became a muss product and a status thing simultaneously.\r\n\r\nWhen did the personal watch become a thing? Why did people switch from pocket watches to wristwatches? And how was the wristwatch were invented and improved over time?\r\n\r\n💡 Curious minds welcome!\r\nIf you’re enjoying this read, you’ll love what else we’ve got. Nerdish is packed with short, fascinating reads on everything from ancient history and science to food, psychology, space, and culture. Dive into more interesting topics to learn about — all in one place.\r\n\r\nThe invention of the wristwatch\r\nPeople became into watches in the 18th century and carried them in pockets. Usually, these portable clocks were secured by chains or straps. Soon, in addition to time showing, a pocket watch became a popular method of saving money. There are records that almost half of the 19th-century pawn items in the USA were pocket watches.\r\n\r\nThe 19th century with its industrialization, trains, electricity, and city growth, made life much faster. In 1878, Sir Sandford Fleming developed the system of worldwide time zones we still use today. All these circumstances underlined the value of time and – personal watches. And the end of the century marked the appearance of wristlets.\r\n\r\n[the_ad_group id=”162″]\r\n\r\nOriginally, wristwatches were women’s accessories, and they weren’t packed with much technology or additional features. As for men, they wore pocket watches up until the 20th century.\r\n\r\nThe first change came with Second Boer War. It was a conflict between Britain and two Boer Republics (the South African Republic and the Orange Free State) in 1899-1902. \r\n\r\n\r\nThe usefulness of the wrist watches went to Europe, inspiring brands to consider mass production of wrist watches for men as well as for women. \r\n\r\nIn 1904, a Brazilian aviator Alberto Santos-Dumont asked his friend, Louis Cartier, to make him a personal watch for his flights. It was much easier to check the time by looking on his cuff than to get into his pocket, especially up in the air.\r\n\r\n\r\nThe real boost in popularity came to wristwatches because of World War 1. Keeping in mind the usefulness of wristless, the British War Department sent watches to their soldiers on the frontlines. Eventually, people started to talk about this novelty, even on the other side of the ocean. In 1916, the New York Times printed a lengthy article praising wristlets for their convenience and importance, especially in wartimes. So, when American soldiers stepped into that war, they also wore wristwatches. Cartier Tank watch from 1917 was inspired by actual Renault tanks used on the battlefields of World War 1. This design changed the traditional round shape of watches. Now, the Tank watch variations are among the most imitated models ever.\r\n\r\n\r\nBy the end of that war, wristwatches became usual among military men. Soon, soldiers came home and switched from uniforms to civil clothes but kept their watches. Now, wristlets changed the image from just feminine accessories to men’s necessities. The wristwatch became a symbol of post-war rise, progress, and modernity. In 1930-es, the sales of wristwatches outnumbered pocket ones by 50 times. \r\n\r\nThe product’s popularity led to concurrency and, consequently, to many improvements. \r\n\r\nIn 1926 Rolex made the world’s first waterproof watch line called Oyster. To prove its efficiency, the company presented an Oyster to a swimmer Mercedes Gleitze. In 1927, she swam across the English Channel with the watch on her wrist. After ten hours in the water, both the swimmer and the clock were alright.\r\n\r\n\r\nSoon, the smaller dial came into vogue, and in 1937 Omega presented the first central seconds watch for women. This change made it easier to count pulse, becoming popular among nurses. By World War 2, wristwatches became water-resistant, shock-proof, and antimagnetic. In 1969, when Neil Armstrong stepped on the moon, he was wearing an Omega Seamaster watch.\r\n\r\n\r\nThe wristwatch is more than just a timekeeper — it reflects how we value time, style, and progress. Want to go further? See how we’ve tried to visualize the vastness of space or dive into the history of time zones and the inventions that made modern timekeeping possible.\r\n\r\nFor a historical twist, compare how ancient Greeks measured time and organized daily life.\r\n\r\nUnusual watches & collections\r\nOver the years, brands have been trying to balance the image of a watch as affordable luxury, presenting models for different market segments: from mass-produced to one-of-a-kind. On the one hand, a wristlet is a practical, often a necessary item. On the other, it’s a statement of success and style – much more like jewelry. For instance, the most expensive wristwatch sold in action is the Patek Philippe Grandmaster model. It hit $31.19 million in 2019. \r\n\r\nEven when wristlets started to gain popularity, brands created unusual models to show their creativity. For example, Omega presented an uncommon women’s watch in Art-Deco style during Barcelona Universal Exposition 1929. The item was created for the back of the hand, adjusting with a bracelet on one end and a ring on another.\r\n\r\n\r\nDuring World War 2, radio was the primary news and entertainment source. So, a year after, Dick Tracy presented a watch with a radio inside.\r\n\r\n\r\nAnyone can be a world citizen nowadays, so here’s a watch that shows time in different time zones. This Mr. Jones Time Traveler watch uses the silhouettes of 16 remarkable buildings to mark time around the globe.\r\n\r\n\r\nMany watches are inspired by history and myth stories like this Roger Dubuis Excalibur Series launched in 2005.\r\n\r\n\r\n\r\nAnother inspo comes from space and 2014 The Jacob & Co. Astronomia Solar watch with miniature celestial objects in constant motion.\r\n\r\n\r\nFinally, The Hoptroff No.16 atomic wristwatch is accurate to 1.5 seconds each thousand years. Two side-by-side dials show the time, date, phase of the moon, sunrise, and battery power reserve.', '2026-08-14 17:58:30', '2026-08-14 17:58:30', 'General'),
(6, 1, 'The Art of Reading Code: Why Beginners Should Read More Than They Write', 'When starting out in programming, most advice tells you to \"code, code, code.\" While building projects is essential, there is a quiet superpower that often gets overlooked: the art of reading code written by others.\r\n\r\nWriting code is like writing sentences; reading code is like reading literature. By examining open-source repositories, studying well-structured functions, or analyzing how experienced developers handle edge cases, you begin to recognize patterns and elegant solutions you might never have thought of on your own.\r\n\r\nNext time you get stuck or want to improve, spend thirty minutes exploring a clean codebase. You’ll quickly realize that programming isn\'t just about giving instructions to a computer—it\'s about communicating ideas clearly to other human beings.', '2026-08-14 18:15:36', '2026-08-14 18:15:36', 'Coding & Tech'),
(7, 1, 'Unlocking the Silent Voice: Overcoming the Fear of the Blank Page', 'The blank page can feel like an intimidating abyss. That blinking cursor on a white screen silently asks: \"Are you sure you have something worth saying?\"\r\n\r\nThe secret to overcoming writer\'s block isn\'t waiting for inspiration to strike like lightning; it is giving yourself permission to write badly first. Drafts are meant to be messy. They are the raw clay from which you eventually sculpt your thoughts into art.\r\n\r\nWrite the first sentence without judging it. Let your thoughts flow onto the page like water finding its path through a stream. You can always edit a poor page, but you cannot edit a blank one.', '2026-08-14 18:15:56', '2026-08-14 18:15:56', 'Creative Writing'),
(8, 1, 'The Invisible Machinery: How Embedded Systems Shape Our Daily Lives', 'We often think of computers as laptops, tablets, or smartphones. But quietly humming behind the scenes is an entire universe of microcontrollers and embedded systems that power the modern world.\r\n\r\nFrom the automated thermostat regulating your home’s temperature to the intricate timing circuits inside a 3D printer, embedded systems bridge the gap between abstract code and physical reality. They take electric signals and translate them into motion, heat, and light.\r\n\r\nUnderstanding how hardware and software interact at this fundamental level changes the way you view everyday objects. Suddenly, a simple microwave or traffic light becomes a masterclass in real-time logic and engineering.', '2026-08-14 18:16:17', '2026-08-14 18:16:17', 'Science & Systems'),
(9, 1, 'The Power of White Space: Why Less is More in Visual Design', 'In visual design, there is often a temptation to fill every empty corner with color, text, or graphics. But the true mark of a refined design isn\'t how much you can fit onto the screen—it\'s how gracefully you allow your elements to breathe.\r\n\r\nWhite space (or negative space) is not empty area; it is a active design element. It guides the reader’s eye, creates visual hierarchy, and evokes a feeling of calm and sophistication. \r\n\r\nWhether you are designing a user interface, a poster, or a simple blog layout, remember that space gives meaning to structure. Sometimes, the most powerful thing you can add to a design is room to pause.', '2026-08-14 18:16:34', '2026-08-14 18:16:34', 'Design & Aesthetics'),
(10, 1, 'The Compound Effect of Small Daily Habits', 'We frequently convince ourselves that massive success requires massive action. We wait for the \"right moment\" to make a drastic change, only to feel overwhelmed and give up a few weeks later.\r\n\r\nReal growth rarely happens in sudden leaps. It happens in the quiet, consistent choices made day after day. Reading ten pages of a book, practicing a skill for twenty minutes, or spending ten minutes reflecting in a journal might seem insignificant today. But over six months or a year, these tiny habits compound into remarkable transformation.\r\n\r\nDon\'t worry about mastering everything overnight. Focus simply on being 1% better today than you were yesterday, and let time do the heavy lifting.', '2026-08-14 18:16:54', '2026-08-14 18:17:53', 'Personal Growth');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'parami', 'parami@gmail.com', '$2y$10$LEw6WTHv8bkCkx/URO2wveJ5jK/fv3U/lurGgFddY2O7J7WrWQrjS', 'user'),
(2, 'poojani', 'poojani@gmail.com', '$2y$10$/tHKIlyE405raGIZj8MfMe1svlsFwYjUjx4IGXVHbuM2zybOyFHee', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD CONSTRAINT `blogpost_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
