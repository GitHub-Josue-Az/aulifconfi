# 31-07-2019 

CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `users_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_classroom_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_classroom_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `enrollments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `classrooms_id` INT(11) NOT NULL,
  `users_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_enrollments_users1_idx` (`users_id` ASC),
  INDEX `fk_enrollments_classrooms1_idx` (`classrooms_id` ASC),
  CONSTRAINT `fk_enrollments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrollments_classrooms1`
    FOREIGN KEY (`classrooms_id`)
    REFERENCES `classrooms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `classrooms_id` INT(11) NOT NULL,
  `lessons_id` INT(11) NOT NULL,
  `startdate` TIMESTAMP NULL DEFAULT NULL,
  `enddate` TIMESTAMP NULL DEFAULT NULL,
  `nivel1` INT(11) NOT NULL DEFAULT 0,
  `nivel2` INT(11) NOT NULL DEFAULT 0,
  `nivel3` INT(11) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_assignment_lessons1_idx` (`lessons_id` ASC),
  INDEX `fk_assignments_classrooms1_idx` (`classrooms_id` ASC),
  CONSTRAINT `fk_assignment_lessons1`
    FOREIGN KEY (`lessons_id`)
    REFERENCES `lessons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignments_classrooms1`
    FOREIGN KEY (`classrooms_id`)
    REFERENCES `classrooms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE `assignments` 
CHANGE COLUMN `nivel1` `level1` INT(11) NOT NULL DEFAULT 0 ,
CHANGE COLUMN `nivel2` `level2` INT(11) NOT NULL DEFAULT 0 ,
CHANGE COLUMN `nivel3` `level3` INT(11) NOT NULL DEFAULT 0 ;


ALTER TABLE `lessons` 
ADD COLUMN `price` DECIMAL(8,2) NOT NULL AFTER `title`;

ALTER TABLE `books` 
ADD COLUMN `price` DECIMAL(8,2) NOT NULL AFTER `title`,
ADD COLUMN `image` VARCHAR(255) NULL DEFAULT NULL AFTER `price`;

ALTER TABLE `courses` 
ADD COLUMN `price` DECIMAL(8,2) NOT NULL AFTER `title`,
ADD COLUMN `image` VARCHAR(255) NULL DEFAULT NULL AFTER `price`;

ALTER TABLE `assignments` 
CHANGE COLUMN `level1` `level1_count` INT(11) NOT NULL DEFAULT 0 ,
CHANGE COLUMN `level2` `level2_count` INT(11) NOT NULL DEFAULT 0 ,
CHANGE COLUMN `level3` `level3_count` INT(11) NOT NULL DEFAULT 0 ;

CREATE TABLE IF NOT EXISTS `users_lessons` (
  `users_id` INT(11) NOT NULL,
  `lessons_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`users_id`, `lessons_id`),
  INDEX `fk_users_has_lessons_lessons1_idx` (`lessons_id` ASC),
  INDEX `fk_users_has_lessons_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_lessons_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_lessons_lessons1`
    FOREIGN KEY (`lessons_id`)
    REFERENCES `lessons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `users_courses` (
  `users_id` INT(11) NOT NULL,
  `courses_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`users_id`, `courses_id`),
  INDEX `fk_users_has_courses_courses1_idx` (`courses_id` ASC),
  INDEX `fk_users_has_courses_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_courses_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_courses1`
    FOREIGN KEY (`courses_id`)
    REFERENCES `courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `users_books` (
  `users_id` INT(11) NOT NULL,
  `books_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`users_id`, `books_id`),
  INDEX `fk_users_has_books_books1_idx` (`books_id` ASC),
  INDEX `fk_users_has_books_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_books_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_books_books1`
    FOREIGN KEY (`books_id`)
    REFERENCES `books` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` INT(11) NOT NULL,
  `type` CHAR(1) NOT NULL,
  `body` TEXT NOT NULL,
  `created_at` VARCHAR(45) NOT NULL,
  `updated_at` VARCHAR(45) NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_contents_lessons1_idx` (`lessons_id` ASC),
  CONSTRAINT `fk_contents_lessons1`
    FOREIGN KEY (`lessons_id`)
    REFERENCES `lessons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` INT(11) NOT NULL,
  `body` TEXT NOT NULL,
  `level` INT(1) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_questions_lessons1_idx` (`lessons_id` ASC),
  CONSTRAINT `fk_questions_lessons1`
    FOREIGN KEY (`lessons_id`)
    REFERENCES `lessons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `answers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `questions_id` INT(11) NOT NULL,
  `body` TEXT NOT NULL,
  `correct` CHAR(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_questions1_idx` (`questions_id` ASC),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`questions_id`)
    REFERENCES `questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `quizsubmissions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` INT(11) NOT NULL,
  `users_id` INT(11) NOT NULL,
  `score` DECIMAL(8,2) NULL DEFAULT NULL,
  `finished` CHAR(1) NOT NULL DEFAULT 0,
  `finished_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_lessonexams_lessons1_idx` (`lessons_id` ASC),
  INDEX `fk_lessonexams_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_lessonexams_lessons1`
    FOREIGN KEY (`lessons_id`)
    REFERENCES `lessons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessonexams_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `assignments_id` INT(11) NOT NULL,
  `enrollments_id` INT(11) NOT NULL,
  `score` DECIMAL(8,2) NULL DEFAULT NULL,
  `finished` CHAR(1) NOT NULL DEFAULT 0,
  `finished_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_assignmentexams_assignments1_idx` (`assignments_id` ASC),
  INDEX `fk_assignmentexams_enrollments1_idx` (`enrollments_id` ASC),
  CONSTRAINT `fk_assignmentexams_assignments1`
    FOREIGN KEY (`assignments_id`)
    REFERENCES `assignments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignmentexams_enrollments1`
    FOREIGN KEY (`enrollments_id`)
    REFERENCES `enrollments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `submissions_questions` (
  `submissions_id` INT(11) NOT NULL,
  `questions_id` INT(11) NOT NULL,
  `answers_id` INT(11) NULL DEFAULT NULL,
  `myanswers_id` INT(11) NULL DEFAULT NULL,
  `correct` CHAR(1) NULL DEFAULT NULL,
  `score` DECIMAL(8,2) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`submissions_id`, `questions_id`),
  INDEX `fk_submissions_has_questions_questions1_idx` (`questions_id` ASC),
  INDEX `fk_submissions_has_questions_submissionss1_idx` (`submissions_id` ASC),
  INDEX `fk_submissions_questions_answers1_idx` (`myanswers_id` ASC),
  INDEX `fk_submissions_questions_answers2_idx` (`answers_id` ASC),
  CONSTRAINT `fk_submissions_has_questions_assignmentexams1`
    FOREIGN KEY (`submissions_id`)
    REFERENCES `submissions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_has_questions_questions1`
    FOREIGN KEY (`questions_id`)
    REFERENCES `questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_questions_answers1`
    FOREIGN KEY (`myanswers_id`)
    REFERENCES `answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_questions_answers2`
    FOREIGN KEY (`answers_id`)
    REFERENCES `answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `quizphases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `quizsubmissions_id` INT(11) NOT NULL,
  `phase` INT(1) NOT NULL,
  `score` DECIMAL(8,2) NULL DEFAULT NULL,
  `finished` CHAR(1) NOT NULL DEFAULT 0,
  `finished_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted` CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_quizphases_quizsubmissions1_idx` (`quizsubmissions_id` ASC),
  CONSTRAINT `fk_quizphases_quizsubmissions1`
    FOREIGN KEY (`quizsubmissions_id`)
    REFERENCES `quizsubmissions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `quizphases_questions` (
  `quizphases_id` INT(11) NOT NULL,
  `questions_id` INT(11) NOT NULL,
  `answers_id` INT(11) NULL DEFAULT NULL,
  `myanswers_id` INT(11) NULL DEFAULT NULL,
  `correct` CHAR(1) NULL DEFAULT NULL,
  `score` DECIMAL(8,2) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`quizphases_id`, `questions_id`),
  INDEX `fk_quizphases_has_questions_questions1_idx` (`questions_id` ASC),
  INDEX `fk_quizphases_has_questions_quizphases1_idx` (`quizphases_id` ASC),
  INDEX `fk_quizphases_questions_answers1_idx` (`myanswers_id` ASC),
  INDEX `fk_quizphases_questions_answers2_idx` (`answers_id` ASC),
  CONSTRAINT `fk_quizphases_has_questions_quizphases1`
    FOREIGN KEY (`quizphases_id`)
    REFERENCES `quizphases` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_has_questions_questions1`
    FOREIGN KEY (`questions_id`)
    REFERENCES `questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_questions_answers1`
    FOREIGN KEY (`myanswers_id`)
    REFERENCES `answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_questions_answers2`
    FOREIGN KEY (`answers_id`)
    REFERENCES `answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


ALTER TABLE `classrooms` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `enrollments` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `assignments` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `users_lessons` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `users_courses` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `users_books` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `pages` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
CHANGE COLUMN `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL ;

ALTER TABLE `questions` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `answers` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `quizsubmissions` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `submissions` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `submissions_questions` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
ADD COLUMN `deleted` CHAR(1) NOT NULL DEFAULT 0 AFTER `updated_at`;

ALTER TABLE `quizphases` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `quizphases_questions` 
CHANGE COLUMN `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
ADD COLUMN `deleted` CHAR(1) NOT NULL DEFAULT 0 AFTER `updated_at`;

