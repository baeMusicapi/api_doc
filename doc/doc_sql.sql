
-- -----------------------------------------------------
-- Table `category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `category` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL comment '类似song 这样的名称',
  `title` VARCHAR(255) comment '解释性标题',
  `level` TINYINT(2) not null default 0,
  `parent_id` INT(10) NOT NULL DEFAULT 0,
  `status` tinyint(2) not null default 1 comment '状态 1:正常 2:删除',
  `type` TINYINT(2) NOT NULL DEFAULT 1 COMMENT '类型属性 1: 接口分类  2:错误码分类',
  PRIMARY KEY (`id`),
  KEY(`parent_id`)
  )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `interface`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `interface` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) not null,
  `title` VARCHAR(100) NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `introduction` TEXT NOT NULL,
  `result` TEXT NOT NULL,
  `category_id` INT(10) NOT NULL DEFAULT 0,
  `create_time` INT(10) NOT NULL DEFAULT 0,
  `update_time` INT(10) NOT NULL DEFAULT 0,
  `type` tinyint(2) not null default 1,
  `error_codes` varchar(200) not null default '',
  PRIMARY KEY (`id`),
  INDEX `fk_interface_category1_idx` (`category_id` ASC),
  KEY(`create_time`)
  )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `interface_parameter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `interface_parameter` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `must` TINYINT(2) NOT NULL DEFAULT 0 COMMENT '是否必须 0:非必须 1:必须',
  `default` VARCHAR(45) NULL,
  `comment` VARCHAR(45) NULL,
  `interface_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_interface_parameter_interface1_idx` (`interface_id` ASC))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `error_code`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `error_code` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `comment` VARCHAR(200) NULL,
  `category_id` INT(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_error_code_category1_idx` (`category_id` ASC))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `interface_error_code`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `interface_error_code` (
  `interface_id` INT(10) NOT NULL,
  `error_code_id` VARCHAR(45) NOT NULL,
  INDEX `fk_interface_error_code_error_code1_idx` (`error_code_id` ASC),
  KEY(`interface_id`)
  )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tag` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `level` TINYINT(2) NOT NULL DEFAULT 0,
  `parent_id` INT(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `interface_tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `interface_tag` (
  `interface_id` INT(10) NOT NULL,
  `tag_id` INT(10) NOT NULL,
  INDEX `fk_interface_tag_interface1_idx` (`interface_id` ASC),
  INDEX `fk_interface_tag_tag1_idx` (`tag_id` ASC))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- -----------------------------------------------------
-- Table `admin_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `status` TINYINT(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `suggestion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title`  VARCHAR(60) NOT NULL DEFAULT '',
  `username` VARCHAR(45) NOT NULL,
  `contact` VARCHAR(200) NOT NULL,
  `status` TINYINT(2) NOT NULL DEFAULT 1,
  `message` TEXT,
  `ip`  VARCHAR(32) not null default '',
  `create_time` int(10) not null default 0,
  `update_time` int(10) not null default 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

