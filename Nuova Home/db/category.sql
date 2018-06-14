CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Faculty` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `category` (`ID`, `Faculty`, `Name`) VALUES
(1, 5, 'Computer Networks'),
(2, 8, 'Mechanics'),
(3, 1, 'Dadaism'),
(4, 1, 'Modern Art'),
(5, 2, 'Literature'),
(6, 2, 'Poetry'),
(7, 3, 'Microeconomics'),
(8, 3, 'Finance'),
(9, 4, 'Pedagogy'),
(10, 4, 'Psychology'),
(11, 5, 'Electronics'),
(12, 6, 'Criminal Law'),
(13, 6, 'Law Courts'),
(14, 7, 'English'),
(15, 7, 'French'),
(16, 8, 'Fluid Dynamics'),
(17, 8, 'Space');

ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
