-- using database stratusolve setup from yml file on a docker container,
-- list of commands used while following tutorial for future reference

-- create datebase
CREATE DATABASE airbnb;

--show all databases
SHOW DATABASES; 

--create table with id being a primary key, auto increment
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    bio TEXT,
    country VARCHAR(2)
);

--insert single value
INSERT INTO Users (email, bio, country) 
VALUES (
    'hello@world.com',
    'My name is Murray and I ...',
    'ZA'
)

--insert multiple values
INSERT INTO Users (email, bio, country) 
VALUES 
    ('ross@world.com', 'My name is Ross and...', 'UK'),
    ('test@world.com', 'My name is Test and...', 'US'),
    ('murray@world.com', 'My name is Murray and...', 'BR');

--view all data in Users table
SELECT * FROM Users;

--view only email and Id from Users table and limit to 2 rows ordered by ID ascending
SELECT email, id from Users
ORDER BY id ASC
LIMIT 2;

--Filter only when country === US
SELECT email, id, country from Users
WHERE country = 'US'
ORDER BY id ASC
LIMIT 2;

--Filter only when country === US and id > 1
SELECT email, id, country from Users

WHERE country = 'US'
AND id > 1

ORDER BY id ASC
LIMIT 2;

--Filter only when country === US and emails start with "t"
SELECT email, id, country from Users

WHERE country = 'US'
AND email LIKE 't%'

ORDER BY id ASC
LIMIT 2;

--database index helps the database find important keywords without having to scan the entire dataset 
--BUT slower writes and additional memory 
--Creates index on email field in users table
CREATE INDEX email_index ON Users(email);

--create table rooms for relational practise owner_id (foreign key) to match id in users table
CREATE TABLE Rooms (
    id INT AUTO_INCREMENT,
    street VARCHAR(255),
    owner_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (owner_id) REFERENCES Users(id) 
);

--Inserts data into rooms table
INSERT INTO Rooms (owner_id, street)
VALUES  
    (1, 'first street'),
    (1, 'second street'),
    (1, 'third street'),
    (1, 'fourth street');

--Joins, users left rooms right

--inner join returns rooms that have a corrisponding owner with owner details (may be duplicated)
SELECT * FROM users
INNER JOIN Rooms
ON Rooms.owner_id = Users.id;

--left join fetches all users even if they don't have rooms
SELECT * FROM users
LEFT JOIN Rooms
ON Rooms.owner_id = Users.id;

--right join all rooms even if they don't have users
SELECT * FROM users
RIGHT JOIN Rooms
ON Rooms.owner_id = Users.id;

--outer join not suppoerted in my sql 
SELECT * FROM users
RIGHT JOIN Rooms
ON Rooms.owner_id = Users.id;


--Inner join but user.id and rooms.id renamed
SELECT 
    users.id AS user_id,
    Rooms.id AS room_id,
    email,
    street 
FROM Users 
INNER JOIN Rooms
ON Rooms.owner_id = Users.id;

--create bookings table 
CREATE TABLE Bookings (
    id INT AUTO_INCREMENT,
    guest_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (guest_id) REFERENCES Users(id),
    FOREIGN KEY (room_id) REFERENCES Rooms(id)
)

--adding booking date
INSERT INTO Bookings 

--creating a relation of:
--user has booked many rooms
--room has been booked by many users
SELECT 
    guest_id,
    street,
    check_in
FROM Bookings
INNER JOIN Rooms ON Rooms.owner_id = guest_id
WHERE room_id = 2

--delete table 
DROP TABLE Users;

--delete DATABASE
DROP DATABASE airbnb;
