CREATE TABLE slogans (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    SloganText VARCHAR(255) NOT NULL,
    ImagePath VARCHAR(255) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);