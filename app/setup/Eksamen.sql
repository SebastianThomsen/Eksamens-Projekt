CREATE TABLE `users` (
  `user_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_sessions` (
  `users_session_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `schedule` (
  `schedule_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `scheduleV2` (
  `schedule_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `time_slot` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `new_event` varchar(50) NOT NULL,
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

CREATE TABLE `folders_rooms` (
  `folder_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `folder_name` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `grades` (
  `grade_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subjects` varchar(50) NOT NULL,
  `gradeNumber` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Adding FOREIGN KEY and cascading
--
ALTER TABLE `users`
ADD COLUMN `role` ENUM('student', 'teacher', 'administrator', 'guest') NOT NULL DEFAULT 'student';

ALTER TABLE `users_sessions`
    ADD CONSTRAINT `users_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------
--
-- Inserting initial data
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`) VALUES
(1, 'DeFire@gmail.com', '$2y$10$Yx92MCLLg34NEk0p5GRTrurvPgGNCxG7KzBLqigS8e2/hUvk8riJe', 'DeFire'),
(2, 'Test', '$2y$10$Yx92MCLLg34NEk0p5GRTrurvPgGNCxG7KzBLqigS8e2/hUvk8riJe', 'Test'),
(3, 'Test2', '$2y$10$Yx92MCLLg34NEk0p5GRTrurvPgGNCxG7KzBLqigS8e2/hUvk8riJe', 'Test2'),
(4, 'Test3', '$2y$10$Yx92MCLLg34NEk0p5GRTrurvPgGNCxG7KzBLqigS8e2/hUvk8riJe', 'Test3');

UPDATE users SET role = 'administrator' WHERE username = 'DeFire@gmail.com';
UPDATE users SET role = 'teacher' WHERE username = 'Test2';
UPDATE users SET role = 'guest' WHERE username = 'Test3';

SELECT users.user_id, users.name, grades.subjects
FROM users
JOIN grades ON users.user_id = grades.user_id;

INSERT INTO `scheduleV2` (`schedule_id`, `day`, `time_slot`, `event`, `new_event`) VALUES
(1, 'Monday', '08:00-09:00', 'Math', 'Math'),
(2, 'Monday', '09:00-10:00', 'English', 'English');

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

INSERT INTO `folders_rooms` (`folder_id`, `folder_name`, `room_id`) VALUES
(1, 'Folder 1', 1),
(2, 'Folder 2', 2),
(3, 'Folder 3', 3),
(4, 'Folder 4', 4),
(5, 'Folder 5', 5),
(6, 'Folder 6', 6),
(7, 'Folder 7', 7),
(8, 'Folder 8', 8),
(9, 'Folder 9', 9),
(10, 'Folder 10', 10);

INSERT INTO `grades` (`grade_id`, `user_id`, `subjects`) VALUES
(1, 1, 'Matematik'),
(2, 1, 'Engelsk'),
(3, 1, 'Dansk'),
(4, 1, 'Historie'),
(5, 1, 'Kemi'),
(6, 1, 'Idræt'),
(7, 1, 'Musik'),
(8, 1, 'Design'),
(9, 1, 'Idehistorie'),
(10, 1, 'Geografi'),
(11, 2, 'Matehmatik'),
(12, 2, 'Engelesk'),
(13, 2, 'Dansk'),
(14, 2, 'Historie'),
(15, 2, 'Kemi'),
(16, 2, 'Idræt'),
(17, 2, 'Musik'),
(18, 2, 'Design'),
(19, 2, 'Idehistorie'),
(20, 2, 'Geografi'),
(21, 3, 'Matematik'),
(22, 3, 'Engelsk'),
(23, 3, 'Dansk'),
(24, 3, 'Historie'),
(25, 3, 'Kemi'),
(26, 3, 'Idræt'),
(27, 3, 'Musik'),
(28, 3, 'Design'),
(29, 3, 'Idehistorie'),
(30, 3, 'Geografi'),
(31, 4, 'Matematik'),
(32, 4, 'Engelsk'),
(33, 4, 'Dansk'),
(34, 4, 'Historie'),
(35, 4, 'Kemi'),
(36, 4, 'Idræt'),
(37, 4, 'Musik'),
(38, 4, 'Design'),
(39, 4, 'Idehistorie'),
(40, 4, 'Geografi');