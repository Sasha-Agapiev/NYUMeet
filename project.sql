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
    FinishedSetup Boolean NOT NULL,
    Bio varchar (512),
    Snapchat varchar(255),
    Zoom varchar(255),
    Instagram varchar(255),
    UNIQUE(Username),
    PRIMARY KEY(UserId)
);

CREATE TABLE Questions (
    QuestionId int NOT NULL,
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

-- Create new questions
INSERT INTO Questions(QuestionId, QuestionText) VALUES (0, "What is your NYU school?");
INSERT INTO Questions(QuestionId ,QuestionText) VALUES (1, "Are you an introvert or extrovert?"); /*"Are you an introvert or an extrovert?"*/
INSERT INTO Questions(QuestionId, QuestionText) VALUES (2, "What are you most interested in?"); /* What do you like to talk about? */ 
INSERT INTO Questions(QuestionId, QuestionText) VALUES (3, "How punctual are you?");
INSERT INTO Questions(QuestionId, QuestionText) VALUES (4, "Will you be on-campus in spring?");
-- Create possible answers for each question and insert them to AnswerOptions table

-- Answer Options for question #0 ("What is your NYU school?")
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 0, "CAS");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 0, "Stern");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3. 0, "Gallatin");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 0, "Tisch");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 0, "SPS");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (6, 0, "Liberal Studies");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (7, 0, "Tandon");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (8, 0, "Law");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (9, 0, "Silver");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (10, 0, "Steinhardt");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (11, 0, "NYU AD");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (12, 0, "NYU Shanghai");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (13, 0, "Not an NYU student");
-- Answer Options for question #1 ("Are you an introvert or extrovert?")
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 1, "Introvert");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 1, "Ambivert");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 1, "Extrovert");
-- Answer Options for question #2 ("What are you most interested in?")
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 2, "I like watching tv");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 2, "I like reading books");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 2, "Nothing in particular, my interests are vast and are known to vary.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 2, "Learning about new things");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 2, "Gaming");
-- Answer Options for question #6 ("How punctual are you?")
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 3, "Fashionably late");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 3, "I'm on time when it counts");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 3, "I strive to live on my own time");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 3, "I'm usually chatting with the teacher over Zoom 5 minutes before class starts");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 3, "Due tomorrow, do tomorrow");
-- Answer Options for question #8 ("Will you be on-campus in the Spring?")
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 4, "Yes!");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 4, "I hope, but not sure yet");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 4, "No, unfortunately");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 4, "Never");

-- Create new users to start
INSERT INTO Users(Username, Password, FirstName, LastName) VALUES ("ephil012", "423sgsfsd", "Ethan", "Philpott");

/* Find all QuestionId and QuestionText and group by QuestionId to prevent repeats */
SELECT Questions.QuestionId, Questions.QuestionText FROM Questions GROUP BY Questions.QuestionId;

/* How to find all the answer options for questionID*/
SELECT AnswerOptions.AnswerOptionId, AnswerOptions.AnswerOptionText FROM AnswerOptions WHERE AnswerOptions.QuestionId = :QuestionId;
/* How to find all the answer options for questionID 0*/
SELECT AnswerOptions.AnswerOptionId, AnswerOptions.AnswerOptionText FROM AnswerOptions WHERE AnswerOptions.QuestionId = 0;

/* Get if user already answered question */
SELECT * FROM UserAnswers WHERE UserId=:UserId AND QuestionId=:QuestionId;

/* Add new question answer for user */
INSERT INTO UserAnswers(UserId, QuestionId, AnswerOptionId) VALUES (:UserId, :QuestionId, :AnswerOptionId)

/* Update question answers for user */ 
UPDATE UserAnswers SET AnswerOptionId = :AnswerOptionId WHERE UserId = :UserId AND QuestionId = :QuestionId

/* Get info about people */
SELECT Questions.QuestionText, AnswerOptions.AnswerOptionText FROM Users 
    INNER JOIN UserAnswers ON Users.UserId = UserAnswers.UserID
    INNER JOIN Questions ON UserAnswers.QuestionId = Questions.QuestionId
    INNER JOIN AnswerOptions ON UserAnswers.AnswerOptionId = AnswerOptions.AnswerOptionId AND UserAnswers.QuestionId = AnswerOptions.QuestionId;
