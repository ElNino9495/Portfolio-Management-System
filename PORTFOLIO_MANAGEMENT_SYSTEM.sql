create database Portfolio_Management;
use portfolio_management;
CREATE DATABASE Portfolio_Management;
USE Portfolio_Management;

CREATE TABLE user_details (
    user_id VARCHAR(12) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    pan VARCHAR(10) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE phone_numbers (
    user_id VARCHAR(12),
    phone_number VARCHAR(10) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id)
);

CREATE TABLE COMPANY (
    STOCK_ID VARCHAR(4) PRIMARY KEY,
    STOCK_NAME VARCHAR(255) NOT NULL,
    STOCK_PRICE DECIMAL(10, 2) NOT NULL
);

CREATE TABLE WATCHLIST (
    USER_ID VARCHAR(12) NOT NULL,
    STOCK_ID VARCHAR(4),
    STOCK_PRICE DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (USER_ID) REFERENCES user_details(USER_ID),
    FOREIGN KEY (STOCK_ID) REFERENCES COMPANY(STOCK_ID)
);

CREATE TABLE PORTFOLIO (
    USER_ID VARCHAR(12) NOT NULL,
    buy_price INT,
    STOCK_ID VARCHAR(4) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (STOCK_ID) REFERENCES COMPANY(STOCK_ID),
    FOREIGN KEY (USER_ID) REFERENCES user_details(USER_ID)
);

CREATE TABLE TRANSACTION (
    TRANSACTION_ID INT PRIMARY KEY AUTO_INCREMENT,
    DATE_OF_PURCHASE DATE NOT NULL,
    USER_ID_PURCHASED VARCHAR(12),
    STOCK_ID VARCHAR(4),
    PRICE DECIMAL(10, 2) NOT NULL,
    QUANTITY INT NOT NULL,
    USER_ID_BOUGHT VARCHAR(12),
    FOREIGN KEY (USER_ID_PURCHASED) REFERENCES user_details(USER_ID),
    FOREIGN KEY (USER_ID_BOUGHT) REFERENCES user_details(USER_ID),
    FOREIGN KEY (STOCK_ID) REFERENCES COMPANY(STOCK_ID)
);

CREATE TABLE COMPANY_PERFORMANCE (
    OPEN_PRICE DECIMAL(10, 2) NOT NULL,
    CLOSE_PRICE DECIMAL(10, 2) NOT NULL,
    DATE DATE NOT NULL,
    LOWEST_PRICE DECIMAL(10, 2) NOT NULL,
    HIGHEST_PRICE DECIMAL(10, 2) NOT NULL,
    TIME TIME NOT NULL,
    STOCK_ID VARCHAR(4) NOT NULL PRIMARY KEY,
    FOREIGN KEY (STOCK_ID) REFERENCES COMPANY(STOCK_ID)
);

ALTER TABLE user_details ADD COLUMN role VARCHAR(255) DEFAULT 'user';

-- Insert 5 users into the user_details table
INSERT INTO user_details (user_id, dob, name, password, pan, email)
VALUES
('ABCDE1234G03', '2003-06-30', 'John Doe', 'password1', 'ABCDE1234G', 'john@example.com'),
('XYZTE9876R13', '2013-11-30', 'Jane Smith', 'password2', 'XYZTE9876R', 'jane@example.com'),
('PQRWF4567F03', '2003-06-30', 'Bob Johnson', 'password3', 'PQRWF4567F', 'bob@example.com'),
('LMNER2348G09', '2009-05-31', 'Alice Brown', 'password4', 'LMNER2348G', 'alice@example.com'),
('DEFRE7890K03', '2003-06-05', 'Eva Wilson', 'password5', 'DEFRE7890K', 'eva@example.com');

-- Insert phone numbers for the users
INSERT INTO phone_numbers (user_id, phone_number)
VALUES
('ABCDE1234G03', '1234567890'),
('XYZTE9876R13', '9876543210'),
('PQRWF4567F03', '5555555555'),
('LMNER2348G09', '1111111111'),
('DEFRE7890K03', '9999999999');

-- Insert 5 companies
INSERT INTO COMPANY (STOCK_ID, STOCK_NAME, STOCK_PRICE)
VALUES
('AAPL', 'Apple Inc.', 150.50),
('GOOG', 'Alphabet Inc.', 2800.00),
('MSFT', 'Microsoft Corporation', 300.75),
('AMZN', 'Amazon.com Inc.', 3400.25),
('TSLA', 'Tesla, Inc.', 650.00);

-- Insert stocks into watchlists
INSERT INTO WATCHLIST (USER_ID, STOCK_ID, STOCK_PRICE)
VALUES
('ABCDE1234G03', 'AAPL', 150.50),
('XYZTE9876R13', 'GOOG', 2800.00),
('PQRWF4567F03', 'MSFT', 300.75),
('LMNER2348G09', 'AMZN', 3400.25),
('DEFRE7890K03', 'TSLA', 650.00);

-- Insert portfolios for users
INSERT INTO PORTFOLIO (USER_ID, buy_price, stock_id, quantity)
VALUES
('ABCDE1234G03', 3400.25, 'AMZN', 23),
('ABCDE1234G03', 2800.00, 'GOOG', 40),
('XYZTE9876R13', 2800.00, 'GOOG', 38),
('PQRWF4567F03', 300.75, 'MSFT', 69),
('LMNER2348G09', 650.00, 'TSLA', 412);

-- Insert additional companies
INSERT INTO COMPANY (STOCK_ID, STOCK_NAME, STOCK_PRICE)
VALUES
('AAP', 'Advance Auto Parts Inc.', 200.90),
('CAT', 'Caterpillar Inc.', 180.25),
('LMT', 'Lockheed Martin Corporation', 400.60),
('ABBV', 'AbbVie Inc.', 110.75),
('PEP', 'PepsiCo Inc.', 150.30);

INSERT INTO COMPANY (STOCK_ID, STOCK_NAME, STOCK_PRICE)
VALUES
('NFLX', 'Netflix Inc.', 600.80),
('BA', 'The Boeing Company', 220.10),
('PYPL', 'PayPal Holdings Inc.', 290.80),
('ORCL', 'Oracle Corporation', 85.50),
('VZ', 'Verizon Communications Inc.', 55.25),
('WMT', 'Walmart Inc.', 140.30),
('PFE', 'Pfizer Inc.', 45.60),
('XOM', 'Exxon Mobil Corporation', 65.75),
('GE', 'General Electric Company', 90.20),
('AMD', 'Advanced Micro Devices Inc.', 120.40);

-- Insert transactions
INSERT INTO TRANSACTION (DATE_OF_PURCHASE, USER_ID_PURCHASED, STOCK_ID, PRICE, QUANTITY, USER_ID_BOUGHT)
VALUES
('2023-10-24', 'ABCDE1234G03', 'AAPL', 150.50, 10, 'XYZTE9876R13'),
('2023-10-23', 'PQRWF4567F03', 'GOOG', 2800.00, 5, 'LMNER2348G09'),
('2023-10-22', 'XYZTE9876R13', 'MSFT', 300.75, 8, 'DEFRE7890K03'),
('2023-10-21', 'DEFRE7890K03', 'AMZN', 3400.25, 12, 'ABCDE1234G03'),
('2023-10-20', 'LMNER2348G09', 'TSLA', 650.00, 15, 'PQRWF4567F03');

-- Insert performance data for companies
INSERT INTO COMPANY_PERFORMANCE (OPEN_PRICE, CLOSE_PRICE, DATE, LOWEST_PRICE, HIGHEST_PRICE, TIME, STOCK_ID)
VALUES
(152.00, 150.50, '2023-10-24', 149.75, 152.50, '09:30:00', 'AAPL'),
(2802.00, 2800.00, '2023-10-24', 2798.50, 2810.25, '09:30:00', 'GOOG'),
(301.00, 300.75, '2023-10-24', 299.75, 302.25, '09:30:00', 'MSFT'),
(3405.50, 3400.25, '2023-10-24', 3399.75, 3412.00, '09:30:00', 'AMZN'),
(655.00, 650.00, '2023-10-24', 648.50, 657.25, '09:30:00', 'TSLA');

-- Insert additional performance data
INSERT INTO COMPANY_PERFORMANCE (OPEN_PRICE, CLOSE_PRICE, DATE, LOWEST_PRICE, HIGHEST_PRICE, TIME, STOCK_ID)
VALUES
(200.90, 201.50, '2023-11-19', 199.75, 203.20, '12:30:00', 'AAP'),
(110.75, 112.20, '2023-11-19', 109.90, 113.00, '12:30:00', 'ABBV'),
(120.40, 122.00, '2023-11-19', 119.80, 123.50, '12:30:00', 'AMD'),
(180.25, 181.00, '2023-11-19', 179.80, 183.50, '12:30:00', 'CAT'),
(90.20, 91.00, '2023-11-19', 89.80, 93.50, '12:30:00', 'GE'),
(400.60, 402.00, '2023-11-19', 398.80, 403.50, '12:30:00', 'LMT'),
(150.30, 152.00, '2023-11-19', 149.80, 153.50, '12:30:00', 'PEP'),
(45.60, 47.00, '2023-11-19', 44.80, 48.50, '12:30:00', 'PFE'),
(140.30, 142.00, '2023-11-19', 138.80, 143.50, '12:30:00', 'WMT'),
(90.20, 91.00, '2023-11-19', 89.80, 93.50, '12:30:00', 'XOM');

ALTER TABLE user_details ADD COLUMN role VARCHAR(255) DEFAULT 'user';

INSERT INTO user_details (user_id, name, password, dob, pan, email,role)
VALUES ('admin', 'Admin', 'admin', '1990-01-01', 'ADMIN1234P', 'admin@admin.com',"admin");
ALTER TABLE portfolio
ADD PRIMARY KEY (user_id, stock_id);


DELIMITER //
CREATE TRIGGER generate_username
BEFORE INSERT ON user_details
FOR EACH ROW
BEGIN
    DECLARE last_two_digits CHAR(2);
    
    -- Extract the last two digits of the year from the dob
    SET last_two_digits = RIGHT(YEAR(NEW.dob), 2);
    
    -- Generate the username by concatenating pan and last two digits
    SET NEW.user_id = CONCAT(NEW.pan, last_two_digits);
END;
//
DELIMITER ;









