CREATE TABLE Users
(
  id int NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(500) NOT NULL,
  email varchar(500) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Categories
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Articles
(
  id int NOT NULL,
  title varchar(100),
  url varchar(500),
  author int,
  category int,
  midichlorians int DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (author) REFERENCES Users(id),
  FOREIGN KEY (category) REFERENCES Categories(id)
);

INSERT INTO Users
VALUES (1,'codymalick','password','codymalick@test.com'),
        (2,'matthewjohnson','password','matthew@test.com');

INSERT INTO Categories
VALUES (1,'Network Security'),
        (2, 'Physical Security'),
        (3, 'Cryptography'),
        (4, 'Misc');

INSERT INTO Articles
VALUES (1,'How to Encrypt a Device', 'google.com', 1, 3, 0),
        (2,'How to defend against the dark arts', 'google.com', 2, 1, 0);
