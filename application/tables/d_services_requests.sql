

-- --------------------------------------------------------

--
-- Table structure for table `d_services_requests`
--

CREATE TABLE `services_requests` (
  `sr_id` int(11) NOT NULL,
  `sr_address` varchar(255) NOT NULL COMMENT 'address',
  `sr_lat` decimal(10,8) NOT NULL COMMENT 'sr_lat',
  `sr_lng` decimal(11,8) NOT NULL COMMENT 'sr_lng',
  `sr_created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='requests_adresses';


--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_services_requests`
--
ALTER TABLE `services_requests`
ADD PRIMARY KEY (`sr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_services_requests`
--
ALTER TABLE `services_requests`
MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

