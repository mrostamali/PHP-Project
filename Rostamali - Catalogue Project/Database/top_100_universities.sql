-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2022 at 02:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrostamali1_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `top_100_universities`
--

CREATE TABLE `top_100_universities` (
  `university_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `university_name` varchar(150) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `year_founded` int(4) NOT NULL,
  `world_rank` int(5) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `toefl_mark` int(3) NOT NULL,
  `ielts_mark` tinyint(1) NOT NULL DEFAULT 0,
  `gre_mark` tinyint(1) NOT NULL DEFAULT 0,
  `public` tinyint(1) NOT NULL DEFAULT 0,
  `tuition` int(11) NOT NULL,
  `dentistry` tinyint(1) NOT NULL DEFAULT 0,
  `art_humanities` tinyint(1) NOT NULL DEFAULT 0,
  `computer_science` tinyint(1) NOT NULL DEFAULT 0,
  `engineering_technology` tinyint(1) NOT NULL DEFAULT 0,
  `business_management` tinyint(1) NOT NULL DEFAULT 0,
  `life_sciences_medicine` tinyint(1) NOT NULL DEFAULT 0,
  `medical_science` tinyint(1) NOT NULL DEFAULT 0,
  `natural_sciences` tinyint(1) NOT NULL DEFAULT 0,
  `social_sciences_management` tinyint(1) NOT NULL DEFAULT 0,
  `mba` tinyint(1) NOT NULL DEFAULT 0,
  `fulltime_student` int(11) DEFAULT NULL,
  `international_student` int(11) DEFAULT NULL,
  `faculty_staff` int(11) DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `youtube_video` varchar(11) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `top_100_universities`
--

INSERT INTO `top_100_universities` (`university_id`, `country_id`, `university_name`, `nickname`, `year_founded`, `world_rank`, `province`, `city`, `toefl_mark`, `ielts_mark`, `gre_mark`, `public`, `tuition`, `dentistry`, `art_humanities`, `computer_science`, `engineering_technology`, `business_management`, `life_sciences_medicine`, `medical_science`, `natural_sciences`, `social_sciences_management`, `mba`, `fulltime_student`, `international_student`, `faculty_staff`, `website`, `description`, `youtube_video`, `file_name`) VALUES
(7, 22, 'Massachusetts Institute of Technology (MIT)', 'Engineers', 1861, 1, 'Massachusetts', 'Cambridge', 90, 1, 0, 0, 57590, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 11035, 3627, 2919, 'https://www.mit.edu/', 'The Massachusetts Institute of Technology (MIT) is a private land-grant research university in Cambridge, Massachusetts. Established in 1861, MIT has since played a key role in the development of modern technology and science, ranking among the top academic institutions in the world.', 'KIop1hxFliQ', 'img-b0a612115f782fffeef3b87ba733fcc4.png'),
(8, 21, 'University of CambridgeÂ ', 'The Chancellor', 1209, 2, 'East of England', 'Cambridge', 100, 1, 0, 1, 16266, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 20871, 7856, 5735, 'https://www.cam.ac.uk/', 'The University of Cambridge is a public collegiate research university in Cambridge, England. Founded in 1209[9] and granted a royal charter by Henry III in 1231, Cambridge is the world\'s third oldest surviving university and one of its most prestigious, currently ranked second best in the world and the best in Europe by QS World University Rankings.', 'LlCwHnp3kL4', 'img-ff5364b7f30a7dde8e794e97f4dd4846.jpg'),
(9, 22, 'Stanford University', 'Cardinal', 1891, 3, 'California', 'Stanford', 101, 0, 1, 0, 56169, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 14518, 3318, 4694, 'https://www.stanford.edu/', 'Stanford University, officially Leland Stanford Junior University, is a private research university in Stanford, California. The campus occupies 8,180 acres (3,310 hectares), among the largest in the United States, and enrolls over 17,000 students. Stanford is ranked among the top universities in the world.', '95N_spFNEkY', 'img-03e9721e136d8df2a9556c20052d6c1f.jpg'),
(10, 21, 'University of OxfordÂ ', 'The Chancellor', 1096, 4, 'East of England', 'Oxford', 100, 1, 1, 1, 57120, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 21972, 9024, 6650, 'https://www.ox.ac.uk/', 'The University of Oxford is the oldest university in the English-speaking world and is actually so ancient that its founding date is unknown â€“ though it is thought that teaching took place there as early as the 11th century.', 'WzSoPYDiefw', 'img-0e4cbfb13bd7cf8239f41e03169d37cd.png'),
(11, 22, 'Harvard UniversityÂ ', 'Crimson', 1636, 5, 'Massachusetts', 'Cambridge', 80, 0, 1, 0, 54768, 0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 21877, 5379, 4480, 'https://www.harvard.edu/', 'Established in 1636, Harvard is the oldest higher education institution in the United States, and is widely regarded in terms of its influence, reputation, and academic pedigree as a leading university in not just the US but also the world.', 'bO4RoQL9H8I', 'img-26707a03f360e0720250b2f472b84116.jpg'),
(12, 22, 'California Institute of Technology (Caltech)Â ', 'Beavers', 1891, 6, 'California', 'Pasadena', 110, 0, 1, 0, 58479, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 2240, 683, 969, 'https://www.caltech.edu/', 'The California Institute of Technology (Caltech) is a world-renowned science and engineering research and education institution located in Pasadena, California, around 11 miles northeast of downtown Los Angeles.', '4PYLCvaMEWc', 'img-6487518ca113796cf84fbd5ab68c9178.jpg'),
(13, 21, 'Imperial College LondonÂ ', 'Coat of arms', 1907, 6, 'South Kensington', 'London', 92, 1, 1, 1, 10770, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0, 20191, 12332, 4099, 'https://www.imperial.ac.uk/', 'Ranked 7th in the world in the QS World University RankingsÂ® 2022, Imperial College London is a one-of-a-kind institution in the UK, focusing solely on science, engineering, medicine and business. Imperial offers a research-led education, exposing you to real-world challenges with no easy answers, teaching that opens everything up to questions and opportunities to work across multi-cultural, multi-national teams.', 'LWy9pYO5GwU', 'img-a9b98d38e5c3a6263678fb07d0ae3b21.jpg'),
(14, 21, 'UCL (University College London)Â ', 'UCL', 1826, 8, 'South Kensington', 'London', 92, 1, 1, 1, 11326, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 41194, 25076, 7251, 'https://www.ucl.ac.uk/', 'UCL sits at the heart of one of the worldâ€™s most dynamic cities, meaning you are perfectly placed to take advantage of everything London has to offer. We were the first university in England to welcome women to university education and the first university in England to welcome students of any religion or social background. UCL has 18,000 students from outside the UK, with over 150 countries represented, providing a truly global perspective.', 'eLSEC7SfWmA', 'img-a4373bdac662c341a33f1e6f9247e0ba.png'),
(15, 19, 'ETH Zurich (Swiss Federal Institute of Technology)Â ', 'EidgenÃ¶ssische Polytechnische Schule', 1855, 9, 'North Central', 'ZÃ¼rich', 100, 1, 0, 1, 1705, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 20892, 8420, 2820, 'https://ethz.ch/de.html', 'ETH Zurich is one of the world\'s leading universities in science and technology and is known for its cutting-edge research and innovation. It was established in 1855 as the Swiss Federal Polytechnic School. A century and a half later, the university can count 21 Nobel laureates, 2 Fields Medalists, 3 Pritzker Prize winners, and 1 Turing Award winner as alumni, including the great Albert Einstein himself.', 'IvbhVPLS2fM', 'img-759d2aeb4781bbdb3672041d39d4eb64.jpg'),
(16, 22, 'University of ChicagoÂ ', 'Maroons', 1890, 10, 'Illinois', 'Chicago', 104, 1, 1, 0, 62241, 0, 1, 0, 0, 1, 1, 0, 1, 1, 1, 16325, 4442, 2703, 'https://www.uchicago.edu/', 'Established in 1856, the University of Chicago is a private research university based in the urban center of Chicago, the third most populous city in the United States. Outside of the Ivy League, Chicago is one of Americaâ€™s top universities and holds top-ten positions in various national and international rankings.', 'OiFE9_ZDrUw', 'img-aab70960c2ae441fa802d6e109e8bd9b.jpg'),
(17, 16, 'National University of Singapore (NUS)Â ', 'Universiti Nasional Singapura', 1905, 11, 'Central Region', 'Queenstown', 85, 1, 1, 0, 1525, 1, 1, 0, 0, 1, 0, 0, 0, 1, 1, 30725, 8129, 4268, 'https://nus.edu.sg/', 'A leading global university centred in Asia, the National University of Singapore (NUS) is Singaporeâ€™s flagship university, which offers a global approach to education and research, with a focus on Asian perspectives and expertise.', 'Mk4l9ZVF-MI', 'img-e7b93519c3c8eab976e122ce2bf23c2a.png'),
(18, 11, 'Peking UniversityÂ ', '', 1898, 12, 'Haidian District', 'Beijing', 92, 1, 0, 1, 3998, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1, 31873, 5436, 5361, 'https://www.pku.edu.cn/', 'The oldest higher education institution in China, Peking University was founded in 1898 as a replacement for the ancient Guozijian school (Imperial College). By the early 1920s, it had become a center for Chinese progressive thought, playing an important role in China\'s New Culture Movement, the May Fourth Movement, and the Tiananmen Square protest of 1989, among other significant historical events.', 'dnD1i37u_CI', 'img-b595c052129f7ef4fec5ba2538abc4b4.jpg'),
(21, 22, 'University of PennsylvaniaÂ ', 'Quakers', 1740, 13, 'Pennsylvania', 'Philadelphia', 100, 1, 1, 0, 61710, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 22261, 5426, 5069, 'https://www.upenn.edu/', 'The University of Pennsylvania is a private Ivy League research university located in the city of Philadelphia. It was founded in 1740 by Benjamin Franklin, one of the United Statesâ€™ founding fathers, who were eager to create a school to educate future generations.', 'kFBe6nIKywA', 'img-6b926ee0c1bc225d7c8d2fc96f3b6c80.jpg'),
(22, 11, 'Tsinghua UniversityÂ ', 'Self-Discipline and Social Commitment', 1911, 14, 'Haidian District', 'Beijing', 90, 1, 0, 1, 4368, 0, 1, 0, 1, 1, 1, 1, 0, 1, 0, 36893, 5162, 6136, 'https://www.tsinghua.edu.cn/en/', 'Tsinghua University was established in 1911 in the wake of the anti-colonialist Boxer Rebellion, which saw the US fine China $30m as punishment. In 1909, President Theodore Roosevelt negotiated with Congress a reduction in the sum, with the leftover money earmarked for university scholarships for Chinese students to study in the US. Tsinghua University was established as a preparatory school for studentsâ€™ trips abroad.', '3h6ElRM3XLQ', 'img-de07b8234ff1a08d4399abc983ed92e0.jpg'),
(23, 21, 'University of EdinburghÂ ', '', 1583, 15, 'Scotland', 'Edinburgh', 92, 0, 1, 1, 11321, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 33861, 15268, 4865, 'https://www.ed.ac.uk/', 'The University of Edinburgh is one of the world\'s top universities, consistently ranked in the world\'s top 50*, and placed 15th in the 2023 QS World University Rankings. Our entrepreneurial and cross-disciplinary culture attracts students and staff from across the globe, creating a unique Edinburgh experience. Whatever excites you, whatever your ambition, whatever makes you â€˜youâ€™, we know one thing; nothing ordinary comes from this extraordinary place.', '6z77vVRCB2s', 'img-a5054791961efefab122c2092948684e.jpg'),
(24, 19, 'Ecole Polytechnique FÃ©dÃ©rale de Lausanne (EPFL)Â ', 'le Poly', 1853, 16, 'Ouest Lausannois', 'Canton of Vaud', 72, 1, 0, 1, 1666, 0, 0, 0, 1, 1, 0, 0, 0, 1, 0, 10919, 6837, 1757, 'https://www.epfl.ch/en/', 'The Ã‰cole Polytechnique fÃ©dÃ©rale de Lausanne (EPFL) is a research institute and university in Lausanne, Switzerland, specializing in the natural sciences and engineering. \r\nIts roots can be traced back to the foundation of a private school in 1853, which, to start with, only had 11 students. Those days are long gone, though, with the modern-day EPFL one of two Swiss Federal Institutes of Technology and student numbers in Lausanne now totalling over 10,000.', '-iZRkJhrrQg', 'img-17f0fddc820c6aafcf49c32d34d090b1.jpg'),
(25, 22, 'Princeton UniversityÂ ', 'Tigers', 1746, 16, 'New Jersey', 'Princeton', 100, 1, 1, 0, 56010, 0, 1, 1, 1, 0, 0, 0, 0, 1, 0, 7767, 1813, 1066, 'https://www.princeton.edu/', 'Princeton is one of the oldest and most prestigious universities in the United States. It was founded in 1746 and moved to its current site in New Jersey in 1896. Princeton is one of the worldâ€™s foremost research universities and has educated two US presidents, James Madison and Woodrow Wilson. Other distinguished graduates include Michelle Obama, actors Jimmy Stewart and David Duchovny, Google chairman Eric Schmidt and Apollo astronaut Pete Conrad.', 'ccRnkLnwUZg', 'img-684a77fc267f455bcc4c76e1f21024c9.jpg'),
(26, 22, 'Yale UniversityÂ ', 'Bulldogs', 1701, 18, 'Connecticut', 'New Haven', 100, 1, 1, 0, 62250, 0, 1, 0, 1, 1, 1, 0, 1, 1, 1, 11283, 3118, 5527, 'https://www.yale.edu/', 'Yale University is a private research university and a member of the prestigious Ivy League, a group of Americaâ€™s most celebrated higher education institutions. Situated in New Haven, Connecticut, the first planned city in America, Yale was founded by English Puritans in 1701, making it the third-oldest higher education institution in the United States.', 'vWp94-7umyQ', 'img-a148cdca36c1027d2a0d1abc9f2d40b0.jpg'),
(27, 16, 'Nanyang Technological University, Singapore (NTU)Â ', '', 1981, 19, 'West Region', 'Jurong West', 100, 1, 1, 0, 5548, 0, 1, 1, 1, 0, 0, 0, 1, 1, 0, 25895, 6900, 3735, 'https://www.ntu.edu.sg/', 'Young and research-intensive, Nanyang Technological University, Singapore (NTU Singapore) has been placed 11th globally and 1st among the worldâ€™s best young universities for five consecutive years (QS university rankings). Ranked the top university in the world for citations in artificial intelligence (Nikkei and Elsevier 2017) for 2012-2016, NTU is embracing digital technologies for better learning and living as part of its Smart Campus vision. It has partnerships with the worldâ€™s leading technology companies, such as Alibaba, Rolls-Royce, BMW, Volvo, Delta Electronics, and Singtel, in many areas of societal importance and impact that include artificial intelligence, data science, robotics, smart transportation, computing, personalized medicine, healthcare and clean energy.', 'Gm1bCS7FLL0', 'img-89ffb51030daafb5db0c168c04ee6c31.jpg'),
(28, 22, 'Cornell UniversityÂ ', 'Big Red', 1865, 20, 'New York', 'Ithaca', 77, 1, 1, 0, 62456, 0, 1, 0, 1, 1, 1, 0, 1, 1, 1, 23188, 5015, 2838, 'https://www.cornell.edu/', '\"I would found an institution where any person can find instruction in any study,â€ is the motto of Cornell University, words first uttered by its co-founder Ezra Cornell. Cornell was founded in 1865 with the then-radical intention of teaching and contributing to all fields of knowledge. The main campus of Cornell is on East Hill in Ithaca, New York, overlooking the city and Cayuga Lake. It spreads over 2,300 acres and comprises laboratories, administrative buildings, and almost all the campus\' academic buildings, athletic facilities, auditoriums, and museums.', 'U15qVeDKkpo', 'img-b51f076ce539338c071e551ff2469b84.jpg'),
(29, 8, 'University of Hong Kong (UKU)Â ', '', 1887, 21, 'Southern District', 'Pokfulam', 80, 1, 0, 1, 5404, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 19958, 8353, 2957, 'https://hku.hk/', 'The University of Hong Kong (HKU), is Hong Kongâ€™s oldest tertiary institution, with a history stretching back over a hundred years. The University of Hong Kong is ranked 26th amongst the most respected comprehensive research-led universities in the world.', '4tS-rg-SUwA', 'img-033c39539ffd7e2b7751f8fb8f2ba6bb.jpg'),
(30, 22, 'Columbia UniversityÂ ', 'Lions', 1754, 22, 'New York', 'New York', 100, 1, 0, 0, 62570, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 25914, 8686, 7401, 'https://www.columbia.edu/', 'Established in 1754, Columbia University is a private Ivy League research university in Upper Manhattan, New York City. It was established as King\\\'s College by the royal charter of George II of Great Britain and renamed Columbia College in 1784 following the American Revolutionary War.', '7cwUcdpUayQ', 'img-70e119a3be5baa4b6ceed742d4530239.jpg'),
(31, 10, 'University of TokyoÂ ', 'Todai', 1877, 23, 'Tokyo', 'BunkyÅ', 80, 1, 0, 1, 4111, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 27826, 4063, 4534, 'https://www.u-tokyo.ac.jp/ja/index.html', 'Established in 1877 as the first imperial university, the University of Tokyo is one of Japanâ€™s most storied and prestigious higher education establishments. In 2011, the university, which is nicknamed Todai, was ranked second in the world behind Harvard for the number of alumni in CEO positions at Fortune 500 companies. Also, 15 of Japanâ€™s 62 prime ministers were educated at the University of Tokyo, and five alumni have gone on to become astronauts.', '--WWvrwrIp0', 'img-8c55b0376e51597f233ca67249953bc4.jpg'),
(32, 22, 'Johns Hopkins UniversityÂ ', 'Blue Jays', 1876, 24, 'Maryland', 'Baltimore', 100, 1, 0, 0, 54160, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0, 14891, 4251, 4969, 'https://www.jhu.edu/', 'Johns Hopkins University is an American private research university in Baltimore, Maryland. It was founded in 1876 and named after its first benefactor, the American entrepreneur, abolitionist, and philanthropist Johns Hopkins. Johns Hopkins is organized into ten divisions on Maryland and Washington, DC campuses, with international centers in Italy, China, and Singapore. Johns Hopkins regularly ranks in the top 10 universities in the US and is also competitive globally, especially for its undergraduate programs.', 'oj7D2Kfgylg', 'img-907206142e5fb425015cafa4864577ef.jpg'),
(33, 22, 'University of Michigan-Ann ArborÂ ', 'Wolverines', 1817, 25, 'Michigan', 'Ann Arbor', 100, 1, 1, 1, 53232, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, 45651, 7341, 7132, 'https://umich.edu/', 'One of the foremost research universities in the United States, the University of Michigan was founded in 1817, before Michigan had even become a state, and moved from Detroit to what is now its Central campus in Ann Arbor in 1837. \r\n', 'zKeGGfYfkYg', 'img-dfcae61b59471aa15d5e4658623f0388.jpg'),
(34, 6, 'Universite PSLÂ ', '', 1530, 26, 'Paris', 'Paris', 87, 1, 0, 1, 8651, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 14591, 5536, 3180, 'https://www.psl.eu/en', 'Located in the heart of Paris, PSL inspires dialogue among and between all areas of knowledge, innovation, and creativity. With 17,000 students and 2,900 researchers, it is a human-scale university.\r\nPSL includes 9 Component Schools and 2 Associate Members and works closely with 3 research entities. It draws on the scientific strengths of all its schools to foster unprecedented opportunities for its communities in education, research, technology transfer, and industrial and academic partnerships both nationally and internationally.', 'huuDvHzc0sE', 'img-9197c0dc04f10e2b3078d5ed8a451fcb.png'),
(35, 22, 'University of California, Berkeley (UCB)Â ', 'Golden Bears', 1868, 27, 'California', 'Berkeley', 90, 1, 1, 1, 14226, 0, 1, 1, 0, 1, 0, 0, 0, 1, 0, 40468, 8989, 3405, 'https://www.berkeley.edu/', 'Founded in 1868, the University of California, Berkeley (UCB) is a public research university and the flagship institution of the ten research universities affiliated with the University of California system. \r\nBerkeley is one of the 14 founding members of the Association of American Universities and is home to some world-renowned research institutes, including the Mathematical Sciences Research Institute and the Space Sciences Laboratory.', 'YkR7tD3OrKI', 'img-f625ca5a6c0d526c9c0919889677652d.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `top_100_universities`
--
ALTER TABLE `top_100_universities`
  ADD PRIMARY KEY (`university_id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `top_100_universities`
--
ALTER TABLE `top_100_universities`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `top_100_universities`
--
ALTER TABLE `top_100_universities`
  ADD CONSTRAINT `top_100_universities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
