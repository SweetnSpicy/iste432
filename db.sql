--
-- Current Database boardgame
--

DROP DATABASE IF EXISTS boardgame;
CREATE DATABASE boardgame;
\c boardgame;


DROP TABLE IF EXISTS BG_User;
CREATE TABLE BG_User(
	username VARCHAR(15) NOT NULL,
	password VARCHAR(100) NOT NULL,
	role VARCHAR(10) NOT NULL,
	PRIMARY KEY(username)
);


DROP TABLE IF EXISTS Ratings_User;
CREATE TABLE Ratings_User(
	gameId INT,
	username VARCHAR(15) NOT NULL,
	PRIMARY KEY(gameId),
	FOREIGN  KEY (username) REFERENCES boardgame_user (username)
);

DROP TABLE IF EXISTS Ratings;
CREATE TABLE Ratings(
	gameId INT NOT NULL,
	title VARCHAR(100),
	rating INT,
	review TEXT,
	PRIMARY KEY (gameId)
);

DROP TABLE IF EXISTS Library;
CREATE TABLE Library(
	username VARCHAR(15) NOT NULL,
	gameId INT NOT NULL,
	PRIMARY KEY(username)
);


