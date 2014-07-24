-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2013 at 11:15 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bdmitienda`
--
CREATE DATABASE `bdmitienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bdmitienda`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcarritos`
--

CREATE TABLE IF NOT EXISTS `tblcarritos` (
  `nombreusuario` varchar(20) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidadproducto` int(11) NOT NULL,
  PRIMARY KEY (`nombreusuario`,`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcarritos`
--

INSERT INTO `tblcarritos` (`nombreusuario`, `idproducto`, `cantidadproducto`) VALUES
('RAUL', 7, 2),
('RAUL', 8, 1),
('RAUL', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategorias`
--

CREATE TABLE IF NOT EXISTS `tblcategorias` (
  `idcategoria` int(11) NOT NULL,
  `nombrecategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcategorias`
--

INSERT INTO `tblcategorias` (`idcategoria`, `nombrecategoria`) VALUES
(1, 'Alimentos'),
(2, 'Bebidas');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductos`
--

CREATE TABLE IF NOT EXISTS `tblproductos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreproducto` varchar(50) NOT NULL,
  `precioproducto` decimal(10,2) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `fk_categorias_productos` (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblproductos`
--

INSERT INTO `tblproductos` (`idproducto`, `nombreproducto`, `precioproducto`, `idcategoria`) VALUES
(7, 'Carne de Cerdo lb', 70.00, 1),
(8, 'Pescado lb', 90.00, 1),
(9, 'Agua lt', 20.00, 2),
(10, 'Jugo de Toronja', 68.87, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblusuarios`
--

CREATE TABLE IF NOT EXISTS `tblusuarios` (
  `nombreusuario` varchar(20) NOT NULL,
  PRIMARY KEY (`nombreusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblusuarios`
--

INSERT INTO `tblusuarios` (`nombreusuario`) VALUES
('RAUL');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD CONSTRAINT `tblproductos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `tblcategorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
