CREATE TABLE `users` (
  `user_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` VARCHAR(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_sessions` (
  `users_session_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `votes` (
  `vote_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `value` BIT DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `administrators` (
  `administrator_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `teachers` (
  `teacher_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `navn` varchar(50) NOT NULL,
  `efternavn` varchar(50) NOT NULL,
  `fødselsdag` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `postnummer` int(11) NOT NULL,
  `telefonnummer` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fag` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `students` (
  `student_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `navn` varchar(50) NOT NULL,
  `efternavn` varchar(50) NOT NULL,
  `klasse` varchar(50) NOT NULL,
  `fødselsdag` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `postnummer` int(11) NOT NULL,
  `telefonnummer` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fag` varchar(50) NOT NULL,
  `årgang` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `schools` (
  `school_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `postnummer` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `schedule` (
  `schedule_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,	
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rooms` (
  `room_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `room_name` varchar(50) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- --------------------------------------------------------

--
-- Adding FOREIGN KEY and cascading
--
ALTER TABLE `users`
ADD COLUMN `user_levels` INT NOT NULL DEFAULT 0;

ALTER TABLE `users`
ADD COLUMN `role` ENUM('student', 'teacher', 'administrator') NOT NULL DEFAULT 'student';


ALTER TABLE `users_sessions`
    ADD CONSTRAINT `users_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `votes`
    ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `administrators`
    ADD CONSTRAINT `moderators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `students`
    ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `teachers`
    ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
    

-- --------------------------------------------------------
--
-- Inserting initial data
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `usertype`) VALUES
(1, 'DeFire@gmail.com', '$2y$10$Yx92MCLLg34NEk0p5GRTrurvPgGNCxG7KzBLqigS8e2/hUvk8riJe', 'DeFire', 'administrator');

UPDATE users SET role = 'administrator' WHERE username = 'DeFire@gmail.com';

INSERT INTO `schedule` (`schedule_id`, `name`) VALUES
(1, 'Klasse 1'),
(2, 'Klasse 2'),
(3, 'Klasse 3'),
(4, 'Klasse 4'),
(5, 'Klasse 5'),
(6, 'Klasse 6'),
(7, 'Klasse 7'),
(8, 'Klasse 8'),
(9, 'Klasse 9'),
(10, 'Klasse 10');

INSERT INTO `rooms` (`room_id`, `room_name`, `schedule_id`) VALUES
(1, 'Room 1', 1),
(2, 'Room 2', 2),
(3, 'Room 3', 3),
(4, 'Room 4', 4),
(5, 'Room 5', 5),
(6, 'Room 6', 6),
(7, 'Room 7', 7),
(8, 'Room 8', 8),
(9, 'Room 9', 9),
(10, 'Room 10', 10);