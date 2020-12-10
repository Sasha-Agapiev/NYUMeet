CREATE USER 'phpadmin'@'%' IDENTIFIED BY 's9H1*L@SNC*2NOkrDgIsMGHgl';

GRANT ALL PRIVILEGES ON *.* TO 'phpadmin'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;

CREATE DATABASE NyuMeet;

USE NyuMeet;

-- Note that the password is 255 despite a max of 32 characters.
-- This is because some encrption algorithms result in longer passwords
CREATE TABLE Users (
    UserId int NOT NULL AUTO_INCREMENT,
    Username varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    FirstName varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    Snapchat varchar(255),
    Zoom varchar(255),
    Instagram varchar(255),
    UNIQUE(Username),
    PRIMARY KEY(UserId)
);

CREATE TABLE Questions (
    QuestionId int NOT NULL AUTO_INCREMENT,
    QuestionText varchar(255) NOT NULL,
    PRIMARY KEY(QuestionId)
);

CREATE TABLE AnswerOptions (
    AnswerOptionId int NOT NULL,
    QuestionId int NOT NULL,
    AnswerOptionText varchar(255) NOT NULL,
    FOREIGN KEY(QuestionId) REFERENCES Questions(QuestionId),
    PRIMARY KEY(AnswerOptionId, QuestionId)
);

CREATE TABLE UserAnswers (
    UserId int NOT NULL,
    QuestionId int NOT NULL,
    AnswerOptionId int NOT NULL,
    FOREIGN KEY(UserId) REFERENCES Users(UserId),
    FOREIGN KEY(QuestionId) REFERENCES Questions(QuestionId),
    FOREIGN KEY(AnswerOptionId) REFERENCES AnswerOptions(AnswerOptionId),
    PRIMARY KEY(UserId, QuestionId)
);

CREATE TABLE Matches (
    UserId1 int NOT NULL,
    UserId2 int NOT NULL,
    FOREIGN KEY(UserId1) REFERENCES Users(UserId),
    FOREIGN KEY(UserId2) REFERENCES Users(UserId),
    PRIMARY KEY(UserId1, UserId2)
);

-- Create new user
INSERT INTO Users(Username, Password, FirstName, LastName) VALUES ("ephil012", "423sgsfsd", "Ethan", "Philpott");

-- Create new questions
INSERT INTO Questions(QuestionText) VALUES ("What is your NYU school?");
INSERT INTO Questions(QuestionText) VALUES ("Are you an introvert or an extrovert?");
INSERT INTO Questions(QuestionText) VALUES ("Are you more emotional or logical?");
INSERT INTO Questions(QuestionText) VALUES ("What activity do you prefer?");
INSERT INTO Questions(QuestionText) VALUES ("Which topic do you like to talk about?");
INSERT INTO Questions(QuestionText) VALUES ("How organized are you?");
INSERT INTO Questions(QuestionText) VALUES ("How punctual are you?");
INSERT INTO Questions(QuestionText) VALUES ("What personality best describes you?");
INSERT INTO Questions(QuestionText) VALUES ("Will you be on-campus in spring?");

-- Create new question answers
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 1, "Tandon");