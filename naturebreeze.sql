-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2015 at 04:12 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `naturebreeze`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `apw` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apw`) VALUES
(1, 'ksml', '123');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `bid` int(11) NOT NULL,
  `bname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bid`, `bname`) VALUES
(1, 'Canon'),
(2, 'Nikon'),
(3, 'Sony'),
(4, 'Fujifilm');

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE IF NOT EXISTS `camera` (
  `cid` int(11) NOT NULL,
  `cbrandname` varchar(50) NOT NULL,
  `cmodel` varchar(50) NOT NULL,
  `cprice` varchar(50) NOT NULL,
  `cdate` date NOT NULL,
  `photo` varchar(500) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camera`
--

INSERT INTO `camera` (`cid`, `cbrandname`, `cmodel`, `cprice`, `cdate`, `photo`, `qty`) VALUES
(2, 'Fujifilm', 'FinePix S9900W', '400', '2015-05-16', 'ZYFRONT-MD.JPG', 30),
(3, 'Sony', 'Sony Cyber-shot DSC-RX1', '500', '2012-12-05', 'ZURLEFT-S.JPG', 0),
(4, 'Canon', 'EOS-1D C', '800', '2013-03-14', 'ZURFRONT-S.JPG', 22),
(5, 'Fujifilm', 'FinePix S9900W', '400', '2015-05-16', 'ZYFRONT-MD.JPG', 8),
(6, 'Sony', 'Sony Cyber-shot DSC-RX1', '500', '2012-12-05', 'ZURLEFT-S.JPG', 0),
(7, 'Canon', 'EOS-1D C', '800', '2013-03-14', 'ZURFRONT-S.JPG', 13),
(8, 'Fujifilm', 'FinePix S9900W', '400', '2015-05-16', 'ZYFRONT-MD.JPG', 17);

-- --------------------------------------------------------

--
-- Table structure for table `camera_order`
--

CREATE TABLE IF NOT EXISTS `camera_order` (
  `camera_orderid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `orderid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cprice` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camera_order`
--

INSERT INTO `camera_order` (`camera_orderid`, `cid`, `orderid`, `cprice`, `qty`, `amount`) VALUES
(1, 1, 'Or-000001', 800, 2, 1600),
(2, 2, 'Or-000001', 400, 5, 2000),
(3, 5, 'Or-000002', 400, 3, 1200),
(4, 7, 'Or-000003', 800, 10, 8000),
(5, 2, 'Or-000004', 400, 2, 800),
(6, 5, 'Or-000004', 400, 3, 1200),
(7, 2, 'Or-000005', 400, 3, 1200),
(8, 7, 'Or-000005', 800, 2, 1600);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `orderid` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `orderdate` varchar(50) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderid`, `userid`, `orderdate`, `totalamount`, `status`) VALUES
('Or-000001', 1, '2015-10-15', 3600, 'Approve'),
('Or-000002', 1, '2015-10-15', 1200, 'Approve'),
('Or-000003', 1, '2015-10-15', 8000, 'Approve'),
('Or-000004', 1, '2015-10-16', 2000, 'Pending'),
('Or-000005', 1, '2015-10-16', 2800, 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE IF NOT EXISTS `order_payment` (
  `order_paymentid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `paymentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `oderid` varchar(50) NOT NULL,
  `paymentid` int(11) NOT NULL,
  `paymenttype` varchar(100) NOT NULL,
  `paymentdate` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`oderid`, `paymentid`, `paymenttype`, `paymentdate`, `amount`) VALUES
('Or-000001', 1, 'cashondelivery', '2015-10-15', '3600'),
('Or-000002', 2, 'cashondelivery', '2015-10-15', '1200'),
('Or-000003', 3, 'myanpay', '2015-10-15', '8000'),
('Or-000004', 4, 'banktransfer', '2015-10-16', '2000'),
('Or-000005', 5, 'cashondelivery', '2015-10-16', '2800');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `compassword` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `email`, `address`, `phone`, `password`, `compassword`) VALUES
(1, 'Kyaw Swar Min Lwin', 'kyawswar@gmail.com', 'No.(77) 11st Street Lanmadaw Township', 2147483647, '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `camera_order`
--
ALTER TABLE `camera_order`
  ADD PRIMARY KEY (`camera_orderid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`order_paymentid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `camera_order`
--
ALTER TABLE `camera_order`
  MODIFY `camera_orderid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `order_paymentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
