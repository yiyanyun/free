-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: test123
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `yi_admin`
--

DROP TABLE IF EXISTS `yi_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `yun_user` varchar(255) DEFAULT NULL,
  `yun_password` varchar(255) DEFAULT NULL,
  `yun_token` varchar(255) DEFAULT NULL,
  `beian` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `copyright_time` varchar(255) DEFAULT NULL,
  `web_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_admin`
--

LOCK TABLES `yi_admin` WRITE;
/*!40000 ALTER TABLE `yi_admin` DISABLE KEYS */;
INSERT INTO `yi_admin` VALUES (1,'admin','123456',NULL,'123','网络验证',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `yi_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_agent`
--

DROP TABLE IF EXISTS `yi_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `status` enum('y','n') DEFAULT 'y',
  `time` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_agent`
--

LOCK TABLES `yi_agent` WRITE;
/*!40000 ALTER TABLE `yi_agent` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_agent_order`
--

DROP TABLE IF EXISTS `yi_agent_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_agent_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_agent_order`
--

LOCK TABLES `yi_agent_order` WRITE;
/*!40000 ALTER TABLE `yi_agent_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_agent_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_aglog`
--

DROP TABLE IF EXISTS `yi_aglog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_aglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_aglog`
--

LOCK TABLES `yi_aglog` WRITE;
/*!40000 ALTER TABLE `yi_aglog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_aglog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_agpro`
--

DROP TABLE IF EXISTS `yi_agpro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_agpro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` enum('y','n') DEFAULT 'n',
  `day` varchar(255) DEFAULT NULL COMMENT '天',
  `zhou` varchar(255) DEFAULT NULL COMMENT '周',
  `month` varchar(255) DEFAULT NULL COMMENT '月',
  `year` varchar(255) DEFAULT NULL COMMENT '年',
  `permanent` varchar(255) DEFAULT NULL COMMENT '永久',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_agpro`
--

LOCK TABLES `yi_agpro` WRITE;
/*!40000 ALTER TABLE `yi_agpro` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_agpro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_alog`
--

DROP TABLE IF EXISTS `yi_alog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_alog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_alog`
--

LOCK TABLES `yi_alog` WRITE;
/*!40000 ALTER TABLE `yi_alog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_alog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_code_mac`
--

DROP TABLE IF EXISTS `yi_code_mac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_code_mac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `mac` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_code_mac`
--

LOCK TABLES `yi_code_mac` WRITE;
/*!40000 ALTER TABLE `yi_code_mac` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_code_mac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_message`
--

DROP TABLE IF EXISTS `yi_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_message`
--

LOCK TABLES `yi_message` WRITE;
/*!40000 ALTER TABLE `yi_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_plog`
--

DROP TABLE IF EXISTS `yi_plog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_plog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `login_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_plog`
--

LOCK TABLES `yi_plog` WRITE;
/*!40000 ALTER TABLE `yi_plog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_plog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_project`
--

DROP TABLE IF EXISTS `yi_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `name` varchar(255) DEFAULT NULL COMMENT '项目名称',
  `key` varchar(255) DEFAULT NULL COMMENT '项目KEY',
  `version` varchar(255) DEFAULT NULL COMMENT '项目版本',
  `status` enum('y','n') DEFAULT 'y' COMMENT '项目状态',
  `sgin_status` enum('y','n') DEFAULT 'y' COMMENT '签名状态',
  `time` varchar(255) DEFAULT NULL COMMENT '项目创建时间',
  `submit_encrypt` enum('0','1','2','') DEFAULT '0' COMMENT '提交加密',
  `encrypt` enum('0','1','2') DEFAULT '0' COMMENT '返回加密',
  `key_aes` varchar(255) DEFAULT NULL COMMENT 'aes密匙',
  `sign_time` datetime DEFAULT NULL,
  `pro_sign` varchar(255) DEFAULT NULL,
  `reg_Interval` varchar(255) DEFAULT NULL COMMENT '注册间隔',
  `kami_interval` varchar(255) DEFAULT NULL,
  `kami_mac` varchar(255) DEFAULT NULL,
  `kami_sgin` varchar(255) DEFAULT NULL,
  `login_mac` varchar(255) DEFAULT NULL COMMENT '登录限制设备数',
  `login_interval` varchar(255) DEFAULT NULL,
  `scode_renew` varchar(255) DEFAULT NULL COMMENT '单卡签到',
  `user_sgin` varchar(255) DEFAULT NULL COMMENT '用户签到',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_project`
--

LOCK TABLES `yi_project` WRITE;
/*!40000 ALTER TABLE `yi_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_scode`
--

DROP TABLE IF EXISTS `yi_scode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_scode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '卡密ID',
  `pid` int(11) DEFAULT NULL COMMENT '项目ID',
  `kami` varchar(255) DEFAULT NULL COMMENT '卡密',
  `value` varchar(255) DEFAULT NULL COMMENT '面值',
  `use_time` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `end_time` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `time` varchar(255) DEFAULT NULL COMMENT '时间',
  `status` enum('y','n') DEFAULT 'y' COMMENT '状态',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_scode`
--

LOCK TABLES `yi_scode` WRITE;
/*!40000 ALTER TABLE `yi_scode` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_scode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_scodelog`
--

DROP TABLE IF EXISTS `yi_scodelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_scodelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kami` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `kid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_scodelog`
--

LOCK TABLES `yi_scodelog` WRITE;
/*!40000 ALTER TABLE `yi_scodelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_scodelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_ucode`
--

DROP TABLE IF EXISTS `yi_ucode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_ucode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kami` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `use_time` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_ucode`
--

LOCK TABLES `yi_ucode` WRITE;
/*!40000 ALTER TABLE `yi_ucode` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_ucode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_user`
--

DROP TABLE IF EXISTS `yi_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `status` enum('y','n') DEFAULT 'y',
  `vip` varchar(255) DEFAULT NULL,
  `reg_time` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reg_mac` varchar(255) DEFAULT NULL,
  `reg_ip` varchar(255) DEFAULT NULL,
  `vip_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_user`
--

LOCK TABLES `yi_user` WRITE;
/*!40000 ALTER TABLE `yi_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_user_log`
--

DROP TABLE IF EXISTS `yi_user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `mac` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `login_time` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_user_log`
--

LOCK TABLES `yi_user_log` WRITE;
/*!40000 ALTER TABLE `yi_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yi_user_mac`
--

DROP TABLE IF EXISTS `yi_user_mac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yi_user_mac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `mac` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yi_user_mac`
--

LOCK TABLES `yi_user_mac` WRITE;
/*!40000 ALTER TABLE `yi_user_mac` DISABLE KEYS */;
/*!40000 ALTER TABLE `yi_user_mac` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-24 20:24:33
