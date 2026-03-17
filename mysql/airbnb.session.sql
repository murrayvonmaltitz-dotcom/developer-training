SELECT * FROM users
RIGHT JOIN Rooms
ON Rooms.owner_id = Users.id;
