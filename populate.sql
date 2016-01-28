CREATE TABLE users
(
  id int NOT NULL AUTO_INCREMENT,
  username varchar(100) NOT NULL,
  email varchar(500) NOT NULL,
  midichlorians int,
  PRIMARY KEY (id)
);

CREATE TABLE categories
(
  id int NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE articles
(
  id int NOT NULL AUTO_INCREMENT,
  title varchar(100),
  url varchar(500),
  user_id int,
  category_id int,
  midichlorians int DEFAULT 0,
  time_submitted datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO users
VALUES (NULL, 'codymalick','codymalick@test.com', 0),
        (NULL, 'matthewjohnson','matthew@test.com', 0);

INSERT INTO categories
VALUES (NULL, 'Network Security'),
        (NULL, 'Physical Security'),
        (NULL, 'Cryptography'),
        (NULL, 'Misc');

INSERT INTO articles
VALUES (NULL,'How to Encrypt a Device', 'google.com', 1, 3, 0, CURDATE()),
        (NULL,'How to defend against the dark arts', 'google.com', 2, 1, 0, CURDATE());
