CREATE TABLE User (
    UserId int NOT NULL AUTO_INCREMENT,
    UserName varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    FirstName varchar(255) NOT NULL,
    LastName varchar(255) NOT NULL,
    Snapchat varchar(255),
    Zoom varchar(255),
    Instagram varchar(255),
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
    FOREIGN KEY(QuestionId),
    PRIMARY KEY(AnswerOptionId, QuestionId)
);

CREATE TABLE UserAnswer (
    UserId int NOT NULL,
    QuestionId int NOT NULL,
    AnswerOptionId int NOT NULL,
    FOREIGN KEY(QuestionId, UserId, AnswerOptionId),
    PRIMARY KEY(UserId, QuestionId)
);

CREATE TABLE Matches (
    UserId1 int NOT NULL,
    UserId2 int NOT NULL,
    PRIMARY KEY(UserId1, UserId2)
);