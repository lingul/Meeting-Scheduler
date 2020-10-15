DROP DATABASE IF EXISTS poll;
CREATE USER IF NOT EXISTS 'poll'@'localhost' IDENTIFIED BY 'poll';
CREATE DATABASE IF NOT EXISTS poll;
GRANT ALL ON poll.* TO 'poll'@'localhost';
USE poll;
CREATE TABLE IF NOT EXISTS users (email VARCHAR(25) PRIMARY KEY, password VARCHAR(25), firstname VARCHAR(25), lastname VARCHAR(25)) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS events (id INT(25) NOT NULL AUTO_INCREMENT PRIMARY KEY, useremail VARCHAR(25), title VARCHAR(25), description VARCHAR(25), date DATE, timestart DATETIME, timeend DATETIME) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS vote (eventid INT(25), useremail VARCHAR(25), vote VARCHAR(25), comment VARCHAR(25), PRIMARY KEY(eventid, useremail), FOREIGN KEY (eventid) REFERENCES events(id)) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS attendens (eventid INT(25), email VARCHAR(25), PRIMARY KEY(eventid, email), FOREIGN KEY (eventid) REFERENCES events(id)) ENGINE=InnoDB;

INSERT INTO users (email, password, firstname, lastname)
VALUES ("linnea@gmail.com", "linnea", "Linnea", "Gullmak");

INSERT INTO users (email, password, firstname, lastname)
VALUES ("ingvar@gmail.com", "ingvar", "Ingvar", "Abrahamsson");

INSERT INTO users (email, password, firstname, lastname)
VALUES ("test@test.se", "test123", "Test", "Test");

INSERT INTO events (useremail, title, description, date, timestart, timeend)
VALUES ("linnea@gmail.com", "meeting1", "stay corona-free", "2020-10-25", "2020-10-25 15:00:00", "2020-10-25 16:00:00");

INSERT INTO events (useremail, title, description, date, timestart, timeend)
VALUES ("ingvar@gmail.com", "meeting2", "Recycle stuff", "2020-11-15", "2020-11-15 09:30:00", "2020-11-15 10:30:00");

INSERT INTO vote (eventid, useremail, vote, comment)
VALUES (2, "ingvar@gmail.com", "no", "none");

INSERT INTO vote (eventid, useremail, vote, comment)
VALUES (1, "linnea@gmail.com", "yes", "none");
