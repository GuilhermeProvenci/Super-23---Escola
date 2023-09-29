# Host: localhost  (Version 5.5.29)
# Date: 2023-07-03 08:47:11
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categorias"
#

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `CodCategoria` int(5) NOT NULL AUTO_INCREMENT,
  `Descricao` char(30) DEFAULT NULL,
  PRIMARY KEY (`CodCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "categorias"
#

INSERT INTO `categorias` VALUES (1,'Alimentos'),(2,'Vestuário'),(3,'Bebidas'),(4,'Ferramentas'),(5,'Carnes'),(6,'Panificação');

#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `CodCliente` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) DEFAULT NULL,
  `Cidade` varchar(50) DEFAULT NULL,
  `Estado` char(2) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Login` varchar(20) DEFAULT NULL,
  `Senha` varchar(20) DEFAULT NULL,
  `Validado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CodCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (1,'Rafael Stuzata','Pato Branco','PR','rafael.stuzata@hotmail.com','admin','admin',1),(2,'Mariana','pato branco','pr','aa@aa.com','senha','senha',1),(3,'lucas','pato branco','pr','email','senha','senha',0),(4,'gui','pb','pr','email','senha','asenha',0),(5,'daniel','Pato Branco','PR','email@dse.com','daniel','senha',0),(6,'erara','ado','am','ak','jklsad','skldajf',0),(7,'ararara','asd','ro','rara','arar','sasfdasd',0),(8,'pagima','adf','mt','asdkj','samdfk','kasjd',0),(9,'papaja','aslhjkl','ac','adjklf','ajksdh','ajkhasf',0),(10,'apapap','kasjdkl','go','asiojdl','asdjklh','sdjklfh',0),(11,'pagina22222222222asjkd','jkldh','rr','adg','ajsdklh','ashukl',0),(12,NULL,NULL,NULL,NULL,NULL,NULL,0);

#
# Structure for table "produtos"
#

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `CodProduto` int(5) NOT NULL AUTO_INCREMENT,
  `Categoria` int(3) DEFAULT NULL,
  `Nome` char(50) DEFAULT NULL,
  `Valor` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`CodProduto`),
  KEY `FK_Categoria` (`Categoria`),
  CONSTRAINT `FK_Categoria` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`CodCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "produtos"
#

INSERT INTO `produtos` VALUES (1,1,'Feijão',12.00),(2,1,'Arroz',30.50),(3,1,'Sal',3.40),(4,2,'Camiseta Lacoste',250.00);
