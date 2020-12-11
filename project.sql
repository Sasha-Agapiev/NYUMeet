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

-- Create new users to start
INSERT INTO Users(Username, Password, FirstName, LastName) VALUES ("ephil012", "423sgsfsd", "Ethan", "Philpott");
INSERT INTO Users(Username, Password, FirstName, LastName) VALUES ("sasha68", "secretpassword", "Sasha", "Agapiev");

-- Create new questions
INSERT INTO Questions(QuestionId, QuestionText) VALUES (0, "What is your NYU school?");
INSERT INTO Questions(QuestionId ,QuestionText) VALUES (1, "How have COVID-19 and remote learning impacted your social life?"); /*"Are you an introvert or an extrovert?"*/
INSERT INTO Questions(QuestionId, QuestionText) VALUES (2, "When you're buying clothes, what do you prioritize?"); /*Are you more emotional or logical?"*/
INSERT INTO Questions(QuestionId, QuestionText) VALUES (3, "If all your school and career work got put on hold for a day, what would you do?"); /*What activity do you prefer?*/
INSERT INTO Questions(QuestionId, QuestionText) VALUES (4, "Which current trend or topic are you most interested in?"); /* What do you like to talk about? */ 
INSERT INTO Questions(QuestionId, QuestionText) VALUES (5, "How organized are you?");
INSERT INTO Questions(QuestionId, QuestionText) VALUES (6, "How punctual are you?");
INSERT INTO Questions(QuestionId, QuestionText) VALUES (7, "What genre of music is your go-to?"); /* What personality best describes you?*/
INSERT INTO Questions(QuestionId, QuestionText) VALUES (8, "Will you be on-campus in spring?");
-- Create possible answers for each question and insert them to AnswerOptions table
/* Answer Options for question #0 ("What is your NYU school?") */
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
/* Answer Options for question #1 ("Are you more of an introvert or an extrovert?") */
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 1, "Very negatively -- I hate being alone and miss hanging out with my friends and going out on weekends.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 1, "Somewhat negatively -- I'm fine but I still miss normal life and feel disconnected from some friends.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 1, "Neutral -- My social life hasn't been impacted.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 1, "Somewhat positively -- I've enjoyed having more alone time to spend by myself and with family.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 1, "I was self-quarantining since before COVID was even a thing.");
/* Answer Options for question #2 ("Are you more emotional or logical?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 2, "Brand / trends.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 2, "Looks.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 2, "Whatever's in the store the same day I go.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 2, "Practicality / price.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 2, "Comfort.");
/* Answer Options for question #3 ("What activity do you prefer?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 3, "Invite people over for a barbecue or kickback.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 3, "Try to plan a day-trip with some friends or classmates.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 3, "Chill and see what I feel like doing.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 3, "Spend some time working on that independent project I've put off to the side.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 3, "Game.");
/* Answer Options for question #4 ("What do you like to talk about?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 4, "I like staying up-to-date on my favorite shows.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 4, "Stocks or cool new startups.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 4, "Nothing in particular, my interests are vast and are known to vary.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 4, "Artificial intelligence or other emerging technologies.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 4, "PS5 vs. XBOX X.");
/* Answer Options for question #5 ("How organized are you?")*/ 
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 5, "I feel like my life is a mess and yet things keep working out.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 5, "I feel like I'm pretty organized, and yet things keep not working out.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 5, "I'm organized enough to get by.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 5, "I try to start working on assignments and projects the first day they're assigned.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 5, " '14 incomplete assignments.' ");
/* Answer Options for question #6 ("How punctual are you?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 6, "Fashionably late.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 6, "I'm on time when it counts.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 6, "I strive to live on my own time.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 6, "I'm usually chatting with the teacher over Zoom 5 minutes before class starts.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 6, "Due tomorrow, do tomorrow.");
/* Answer Options for question #7 ("What genre of music is your go-to?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 7, "Pop.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 7, "Alt Rock.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 7, "Rap.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 7, "Classical.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (5, 7, "Country.");
/* Answer Options for question #8 ("Will you be on-campus in the Spring?")*/
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (1, 8, "Yes!");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (2, 8, "I hope, but not sure yet.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (3, 8, "No, unfortunately.");
INSERT INTO AnswerOptions(AnswerOptionId, QuestionId, AnswerOptionText) VALUES (4, 8, "Hell, no.");

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