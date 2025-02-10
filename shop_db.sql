-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 11:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
CREATE DATABASE shop_db;
use shop_db;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(12,0) DEFAULT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 34, 'Satyajit Malakar', '123@gmail.com', '12', 'Help');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` float NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`, `is_available`) VALUES
(27, 'Lamb Midloins 6 - 9 Pieces 650g - 1.1kg', 'meat', 'Lamb Mid Loin Chops feature juicy 100% Australian lamb and contain 6-9 pieces per pack, making them ideal for family meals and entertaining. A tender cut on the bone, Australian lamb mid loin chops are cut from the loin and have a succulent texture and a rich meaty flavour.', 20, '764868.jpg', 0),
(28, 'Salmon Tasmanian Atlantic Fillets Skin On Per Kg', 'fish', 'Approximately 200g - 300g per fillet', 32, '095171.jpg', 1),
(29, 'Chicken Rscpa Approved Chicken 1.1kg - 1.7kg', 'meat', 'This is a variable weight product and is priced by $/kg. Once we&#39;ve picked your item in store, we&#39;ll refund you for the difference between the weight paid and the weight received. Please advise in your personal shopper notes your preferred weight when reviewing your order at checkout. We will try our best to provide you with the requested weight.', 10, '123643123.png', 1),
(30, 'Pork & Veal Meatballs 400g', 'meat', 'Australian Pork (60%), Australian Veal (20%), Water, Gluten Free Crumb (Maize Flour, Rice Flour, Salt, Dextrose (Tapioca, Maize), Canola Oil, Mineral Salts (450, Sodium Carbonate)), Rice Flour, Salt, Carrot Fibre, Vegetable Protein (Soy), Potato Starch, Sugar, Garlic Powder, Herbs, Spices, Lemon Juice, Preservative (223 (Sulphites)), Natural Flavouring, Fermented Rice', 13, '1235231.jpg', 1),
(31, '8 Beef Sausages 600g', 'meat', 'Made from tender Australian beef, our gluten-free beef sausages are deliciously juicy with a rich meaty flavour. Free from artificial colours or flavours, Woolworths Australian Beef Sausages are ready to pan-fry or cook on the barbecue in just 16 minutes.', 12, '233145.jpg', 1),
(32, 'Lebanese Cucumbers Each', 'vegitables', 'The Lebanese cucumber is green skinned, white fleshed and only 12?15 cm long. It has a juicy texture and a tender skin that does not need to be peeled.', 1, '95273.jpg', 0),
(35, 'Red Capsicum Each', 'vegitables', 'Capsicums are seed pods. A shiny red vegetable with crisp, moist flesh. Hollow with a seeded core. Capsicums are sweet and juicy with a mild spicy flavour. Red capsicums, being riper, are sweeter than green capsicums. Shape also varies with each variety, from the more commonly found blocky shape to a pointy capsicum. Miniature varieties are sometimes available.', 1.98, '135306.jpg', 1),
(36, 'Fresh Strawberry 250g', 'fruits', 'Pick firm strawberries with a red and glossy appearance that are free from bruising. Fresh looking green stems are a sign of freshness! ', 3.4, '123412.jpg', 1),
(37, 'Cavendish Bananas Each', 'fruits', 'Cavendish is the most popular banana variety in Australia, with firm, starchy flesh and available all year round.\r\nRipe bananas are perfect for snacking, used in baking, fruit salads and smoothie.', 0.72, '126784.png', 1),
(38, 'Fresh Pink Lady Apples Each', 'fruits', 'A firm, sweet, crisp apple with juicy flesh, the Pink Lady apple also plays well with your salads and sauces.', 0.53, '134345667.jpg', 1),
(39, 'Red Watermelon Cut Quarter Each', 'fruits', 'Large oval fruit with a thick green skin and a sweet watery pink to red flesh. Often the deeper colored the flesh, the sweeter the taste. \r\nWatermelon&#39;s flesh contains about 6% sugar and it is comprised primarily of water. This seedless variety is perfect for kids.', 4.18, '1234785.webp', 0),
(40, 'Fresh Granny Smith Apples Each', 'fruits', 'The ultimate tangy apple! Firm, crunchy, and tart making the Granny Smith a great snack, and ideal for baking and cooking.', 0.79, '23483.jpg', 1),
(41, 'Driscoll&#39;s Fresh Raspberries Punnet 125g', 'fruits', 'Balanced sweet/tart flavour in a firm, yet delicate berry. \r\n', 3.3, '165262.jpg', 1),
(42, 'Plum Black Each', 'fruits', 'Rich in flavour and texture, perfect for snacking or adding to a dessert. \r\n', 0.31, '139894.jpg', 0),
(43, 'Orange Navel Each', 'fruits', 'This product varies by state. Please review the product packaging for specific details when you receive this product, including nutritional information and country of origin, before consuming.', 2, '23427.jpg', 0),
(44, 'White Seedless Grapes Bunch Each', 'fruits', 'White seedless grapes have firm, crisp flesh and their sweetness makes them great to eat straight off the bunch. ', 4.66, '138801.webp', 0),
(45, 'Fresh Blueberries Punnet 125g', 'fruits', 'Blueberries are sweet with a nice crunchy texture. ', 5.5, '657325.jpg', 1),
(46, 'Fresh William Bartlett Pear Each', 'fruits', 'Also known as Williams Bon Chrétien or Barlett pears, their green skin turns pale green when ripe.\r\nEnjoy them fresh when they are ripe and juicy, or use them for cooking when they are on the firmer side.', 0.58, '3412877656.webp', 1),
(47, 'Red Seedless Watermelon Whole Each', 'fruits', 'Large oval fruit with a thick green skin and a sweet watery pink to red flesh with usually many seeds.\r\nOften the deeper colored the flesh, the sweeter the taste. Watermelon&#39;s flesh contains about 6% sugar and it is comprised primarily of water. ', 16.72, '2343812345.jpeg', 1),
(48, 'Lime Fresh Each', 'fruits', 'Round sour fruit, slightly smaller than a lemon and green in colour.\r\nGreat in dressings, desserts and drinks.', 1.34, '462345.jpg', 1),
(49, 'Orange Valencia Each', 'fruits', 'This product varies by state. Please review the product packaging for specific details when you receive this product, including nutritional information and country of origin, before consuming.', 0.59, '144708.jpg', 1),
(50, 'Pineapple Naturally Sweet Whole Each', 'fruits', 'Oval fruit with a thick greenish skin and yellow flesh. Cayenne variety. Skin removed.', 4.5, '137534.jpg', 1),
(51, 'Mango Keitt Each', 'fruits', 'Sweet, mild flavour with a firm texture and bright pinky red blush', 2.9, '1234134571.webp', 1),
(52, 'Iceberg Lettuce Each', 'vegitables', 'Iceberg Lettuce is round in shape, with packed layers of\r\ncrisp green leaves. The heads are firm and tightly packed with a\r\ncentral core or heart. The leaves are crunchy and have a mild flavour.\r\nThe outer leaves are a darker green; the central leaves are pale green.\r\nThe leaves are cupped, hold their shape and can be used to hold fillings.', 4, '714635.avif', 1),
(53, 'Spring Onion Eschallot Bunch', 'vegitables', 'They are harvested when young and before the white bulb has time to form properly and are tender and mild with a long white slender neck and hollow green tops. Spring onions are milder than onions so can be eaten raw in salads and sandwiches. The green tops can be used like chives, as a garnish or sliced in salads or stir fries.\r\n', 2.5, '47146.avif', 1),
(54, 'Capsicum Green Each', 'vegitables', 'A shiny green vegetable with crisp, moist flesh. Hollow with a seeded core.', 1.98, '414672.jpg', 1),
(55, 'Cos Hearts Lettuce 2 Pack', 'vegitables', '1 Cup = 1 Serve Of Vegetables^ ^ Australian Dietary Guidelines recommend 5 serves of vegetables per day', 3.5, '134761.png', 1),
(56, 'Ginger Fresh Per Kg', 'vegitables', 'Fresh & Dry premium Quality Ginger', 27, '138082.jpg', 1),
(57, 'Mushrooms Cups Loose Per Kg', 'vegitables', 'Fresh Mushrooms that are ideal for a variety of different dishes.\r\nThey go great in a pasta or Burger and are also Vegetarian.\r\nMushrooms are great on the BBQ.', 10.9, '143109.jpg', 1),
(58, 'Garlic Head Each', 'vegitables', 'Bulb made up of segments called cloves, covered by a papery shell. The most common varieties of garlic contain 10 cloves (or segments) with white skin. Other varieties have pink or purple skin and larger cloves. As a rule, the smaller the clove, the stronger the taste. ', 1.65, '72451.jpg', 1),
(59, 'Fresh Tomato Each', 'vegitables', 'Round in shape, with a bright red shiny skin and red pulp and whitish seeds. The tomato is actually a fruit but is considered a vegetable because of its uses', 0.76, '134034.jpg', 1),
(60, 'Truss Tomatoes Each', 'vegitables', 'Round in shape, with a bright red shiny skin, red pulp and whitish seeds. Tomatoes on the truss, are popular. Small, medium and large tomatoes are sold on the truss. There are many different vine varieties; as a general rule vine varieties have a very intense flavour.', 1.25, '2572456.webp', 1),
(61, 'Green Zucchini Each', 'vegitables', 'Variety of marrow or summer squash, picked when small. Long and cylindrical in shape with green smooth skin and a cream flesh. ', 1.18, '23472.jpg', 1),
(62, 'Potato White Washed Each', 'vegitables', 'White Washed Potatoes\r\n\r\nA potato is a kind of root vegetable that ranges in size and shape, including round, oval and elongated. Potato skin colour can be red, pink, white, cream, yellow and purple. Potatoes are versatile vegetables that can be enjoyed as a side with many meals. The whole potato can be eaten – skin included – and should always be washed and cooked. Barbecue, bake, boil, or blitz them into a soup. Mashed potatoes are a classic family favourite, or slice potatoes into chips.', 0.81, '146147.jpg', 1),
(63, 'Onion Brown Each', 'vegitables', 'These are the most common onions and are available all year round. They are strongly flavoured, firm onions with layers of golden brown paper skins and white flesh. Edible portion includes flesh only. Generally used for cooking rather than eaten raw.\r\n', 0.59, '144329.jpg', 1),
(64, 'Fresh Broccoli Each', 'vegitables', 'A vegetable with deep green flower clusters which form the head, and pale green stems,\r\nwith firm stalks that snap easily. Avoid using broccoli with yellowed\r\nleaves or yellow flowers through the buds.\r\n', 2.28, '134681.jpg', 0),
(65, 'Baby Leaf Spinach 120g', 'vegitables', 'Baby Spinach 120g bag features fresh baby spinach leaves that can be enjoyed raw or cooked. Washed and ready to eat, our bagged spinach makes it easy to enjoy the healthy goodness of fresh spinach, which is rich in iron.', 2.2, '1589255.jpg', 1),
(66, 'Carrot Fresh Each', 'vegitables', 'Carrot are selected fresh from Australian farms, the ever versatile carrots is perfect for cooking or eating raw as a fresh snack. Edible portion includes flesh only. \r\n', 0.35, '69826.jpg', 1),
(67, 'Onion Red Each', 'vegitables', 'Red onions have burgundy red skins and red tinged flesh. Spanish type red onions are large and round, while Californian red onions tend to be flatter and milder. They are mild, sweet and juicy and are delicious eaten raw in salads, used as a garnish or added to sandwiches.', 0.68, '144497.jpg', 1),
(68, 'Continental Cucumbers Each', 'vegitables', 'Continental Cucumber.\r\nIt is long, usually 30?45 cm, and often individually wrapped in plastic because its skin is very soft and is easily damaged. The plastic stops the cucumber drying out and going soft. The cucumber skin does not need peeling. They are often referred to as seedless because when harvested at their best, the seeds are immature or virtually nonexistent.\r\n', 2.9, '3682.webp', 1),
(69, 'Green Banana Prawns Large Thawed Per Kg', 'fish', 'This product may contain traces of Gluten,,Crustacean, Egg, Fish, Milk, Peanuts, Soy,Sulphites, Tree Nuts, Sesame.', 20, '246256.jpg', 1),
(70, 'Salmon Tasmanian Atlantic Fillets Skinned & Boned Per Kg', 'fish', 'Approximately 200g - 260g per portion\r\nContains: Fish. This product may contain traces of Gluten, Crustacea, Egg, Milk, Peanuts, Soybeans, Sulphites, Tree Nuts, Sesame Seeds.', 46, '15345.webp', 0),
(71, 'Freshwater Basa Fillets Thawed Per Kg', 'fish', 'Due to its mild flavour, basa is an excellent option for families. Our passionate Innovation Chef Amanda, recommends pan frying this basa in a little butter and garlic then finishing with fresh herbs and a squeeze of lemon.', 11, '535648.jpeg', 1),
(72, 'Thawed Marinara Mix Per Kg', 'fish', 'Our seafood marinara mix is a delicious blend of seafood, perfect for adding a burst of flavour to your pasta dishes or seafood stews, and offering a medley of tender and succulent textures and tastes.', 18, '34567.webp', 0),
(73, 'Cooked Jumbo Tiger Prawns Thawed Per Kg', 'fish', 'Farmed Contains: Crustacea. May Contain Traces of: Gluten, Egg, Fish, Milk, Peanuts, Soybeans, Tree Nuts, Sesame Seeds, Sulphites.', 33, '257245.webp', 1),
(74, 'Fresh Skin On Barramundi Fillets Per Kg', 'fish', 'Contains: Fish. \r\n\r\nThis product may contain traces of Gluten, Crustacea, Egg, Milk, Peanuts, Soybeans, Sulphites, Tree Nuts, Sesame Seeds.\r\n', 36, '24572.webp', 1),
(75, 'Fresh Whole Australian Barramundi Per Kg', 'fish', 'Contains: Fish. \r\n\r\nThis product may contain traces of Gluten, Crustacea, Egg, Milk, Peanuts, Soybeans, Sulphites, Tree Nuts, Sesame Seeds.\r\n', 22, '095181.webp', 1),
(76, 'Fresh Whole Rainbow Trout Per Kg', 'fish', 'Contains: Fish. This product may contain traces of Gluten, Crustacea, Egg, Milk, Peanuts, Soybeans, Sulphites, Tree Nuts, Sesame Seeds.', 22, '24572.jpg', 1),
(77, 'Beef Sizzle Schnitzel 400g', 'meat', 'Beef Sizzle Steaks are cut from 100% Australian beef knuckle. Thinly cut for a convenient quick cooking time, Australian Beef Sizzle Steaks are tender and full of flavour.\r\n', 10, '1256712.webp', 1),
(78, 'Lean Beef Mince 1kg', 'meat', 'Lean Beef Mince features 100% Australian beef sourced from our selected Aussie farmers, to bring you the tastiest quality beef for you and your family to enjoy. Containing 90% beef and 10% fat, Woolworths Lean Beef Mince is a healthier alternative to our standard beef mince.', 15, '123236.avif', 0),
(79, 'Deli Leg Ham Shaved From The Deli Per Kg', 'meat', 'Contains: CONTAINS:GLUTEN,WHEAT,MILK,SOY,SULPHITES.\r\nMay contain: EGG,GLUTEN,WHEAT,MILK,CRUSTACEAN,FISH,PEANUTS,TREE NUTS,SESAME,SOY,SULPHITES ', 18, '130276.jpg', 1),
(80, 'D&#39;orsogna Ham Leg Triple Smoked 97% Fat Free Shaved 1kg', 'meat', 'This premium quality boneless ham is made from the finest leg of pork. It is traditionally cured and naturally wood-smoked to the D&#39;Orsogna family recipe. Their artisans have crafted a delicate, slightly sweet taste profile enhanced by an extended cooking process in smokehouses. The traditional process of this fine quality, full muscle ham enhances its natural flavours and provides the highest quality product and is 97% Fat Free. Fantastic in sandwiches or as after-school snacks.', 27, '175734.jpg', 1),
(81, 'Beef Stir Fry 500g', 'meat', 'Featuring tender strips of 100% Australian beef selected for quality, Woolworths Extra Lean Beef Stir Fry strips are ideal for creating delicious family meals. Containing less than 1% saturated fat, Woolworths Extra Lean Beef Stir Fry strips can be enjoyed as part of a healthy, balanced diet.\r\n', 10, '1262462.jpg', 1),
(82, 'Beef Porterhouse Steak & Butter 400g', 'meat', 'Australian Beef (90%), Herb And Garlic Butter (Salted Butter (8%) (Cream (Milk), Water, Salt)), Seasoning (Garlic (1%), Onion Powder, Herbs (Parsley, Chives, Rosemary, Sage), Spices, Salt, Vegetable Gums (Xanthan Gum, Guar Gum), Acidity Regulator (Citric Acid)))', 14, '12714357.avif', 1),
(83, 'Heart Smart Extra Lean Beef Mince 500g', 'meat', 'Extra Lean Beef Mince features 100% Australian beef sourced from selected Aussie farmers. Our Heart Smart mince contains no more than 5% total fat, is high in protein, and can be enjoyed as part of a healthy, balanced diet. A great healthy choice for family meals, Woolworths Extra Lean Beef Mince is ideal for dishes such as tacos or chilli con carne. For a Mexican-style family dinner, cook your Extra Lean Beef Mince with taco seasoning and serve in tacos topped with shredded lettuce, tomato and ', 10, '16901.avif', 1),
(100, 'Cucumber', 'vegitables', 'Cucumber', 5, '134617.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(31, 'Sumit', 'malakarsumit70@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'avatar-man-cartoon-vector-10622764.jpg'),
(33, 'S M', 'sm@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'wallpaperflare.com_wallpaper (1).jpg'),
(35, 'Satyajit Malakar', 'sumit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'Image.jfif'),
(36, 'Satyajit Malakar', 'malakar.satyajit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'download.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
