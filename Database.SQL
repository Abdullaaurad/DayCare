-- Active: 1733297012845@@127.0.0.1@3306@my_db

CREATE TABLE `user` (
    `UserID` INT NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL UNIQUE,
    `Password` VARCHAR(100) NOT NULL,
    `Role` ENUM(
        'User',
        'Teacher',
        'Maid',
        'Receptionist',
        'Doctor',
        'Manager'
    ) NOT NULL DEFAULT 'User',
    `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`UserID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

CREATE TABLE MediaReminder (
    ReminderID INT NOT NULL AUTO_INCREMENT,
    MediaID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    PRIMARY KEY (ReminderID),
    FOREIGN KEY (MediaID) REFERENCES Media (MediaID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    `user` (
        `Username`,
        `Password`,
        `Role`,
        `Date`
    )
VALUES (
        'Abdulla',
        '$2y$10$YGbz8pW/W4YVVsNv1eBm8.l.7crfjezdfOI2NJnJwSFGXQgeDPImy',
        'User',
        '2024-11-09 06:56:22'
    ),
    (
        'Ayyub',
        '$2y$10$zrp6xwcdJ6gjd71tK7jEOOZxnMOcQHLcSLAA4wP6.1br6Yx5fLMmu',
        'User',
        '2024-11-08 19:10:30'
    ),
    (
        'Manha',
        '$2y$10$FOQ3p5aaDSnr.GnE1KgPtOWDz4PfRA7F0lbS4i4M8rapooSsXzNH6',
        'User',
        '2024-11-12 15:30:48'
    ),
    (
        'Registered',
        '$2y$10$mK/Y3WOzwfejvYXsaaChgONXLr5BLBL9DGtjvyLGKdt.Tu1q9xAMa',
        'User',
        '2024-11-08 15:09:21'
    ),
    (
        'Shi',
        '$2y$10$mmBrfNhUXCnba5WSHdUv0u/8r0s/RqZApSa4dTsvJPEg2hPe41Qzy',
        'Manager',
        '2024-12-12 09:57:59'
    ),
    (
        'Shimhan',
        '$2y$10$A3jh3uATnAVxZzh49EOj1eKw7wDZDsQv3dWZj5QZnCLDWVQbBXHd2',
        'Manager',
        '2024-11-25 06:03:02'
    ),
    (
        'Unregistered',
        '$2y$10$71E1xCMkDCuMhGj9Bio7luiqvA.i115KsL7UePHxoyt.oV4YKv4OS',
        'User',
        '2024-11-08 15:08:32'
    ),
    (
        'Yunus',
        '$2y$10$hHfs8Im3XfQ.JPbP1oEmAukf0IA7DDKab7ztt8JKIW6tfFQzMUuc6',
        'User',
        '2024-11-08 18:42:34'
    );

INSERT INTO
    `user` (
        `Username`,
        `Password`,
        `Role`
    )
VALUES (
        'user1',
        'password123',
        'User'
    ),
    (
        'user2',
        'password123',
        'User'
    ),
    (
        'user3',
        'password123',
        'User'
    ),
    (
        'user4',
        'password123',
        'User'
    ),
    (
        'user5',
        'password123',
        'User'
    ),
    (
        'teacher1',
        'password123',
        'Teacher'
    ),
    (
        'teacher2',
        'password123',
        'Teacher'
    ),
    (
        'teacher3',
        'password123',
        'Teacher'
    ),
    (
        'teacher4',
        'password123',
        'Teacher'
    ),
    (
        'teacher5',
        'password123',
        'Teacher'
    ),
    (
        'maid1',
        'password123',
        'Maid'
    ),
    (
        'maid2',
        'password123',
        'Maid'
    ),
    (
        'maid3',
        'password123',
        'Maid'
    ),
    (
        'maid4',
        'password123',
        'Maid'
    ),
    (
        'maid5',
        'password123',
        'Maid'
    ),
    (
        'receptionist1',
        'password123',
        'Receptionist'
    ),
    (
        'receptionist2',
        'password123',
        'Receptionist'
    ),
    (
        'receptionist3',
        'password123',
        'Receptionist'
    ),
    (
        'receptionist4',
        'password123',
        'Receptionist'
    ),
    (
        'receptionist5',
        'password123',
        'Receptionist'
    ),
    (
        'doctor1',
        'password123',
        'Doctor'
    ),
    (
        'doctor2',
        'password123',
        'Doctor'
    ),
    (
        'doctor3',
        'password123',
        'Doctor'
    ),
    (
        'doctor4',
        'password123',
        'Doctor'
    ),
    (
        'doctor5',
        'password123',
        'Doctor'
    ),
    (
        'manager1',
        'password123',
        'Manager'
    ),
    (
        'manager2',
        'password123',
        'Manager'
    ),
    (
        'manager3',
        'password123',
        'Manager'
    ),
    (
        'manager4',
        'password123',
        'Manager'
    ),
    (
        'manager5',
        'password123',
        'Manager'
    );

CREATE TRIGGER `prevent_date_insertion`
BEFORE INSERT ON `user`
FOR EACH ROW
BEGIN
    IF NEW.`Date` IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Manual insertion into Date column is not allowed';
    END IF;
    SET NEW.`Date` = CURRENT_TIMESTAMP;
END;

DROP TRIGGER IF EXISTS `prevent_date_insertion`;

CREATE TABLE `parent` (
    `ParentID` INT NOT NULL AUTO_INCREMENT,
    `UserID` INT NOT NULL,
    `Last_Name` VARCHAR(20) NOT NULL,
    `First_Name` VARCHAR(20) NOT NULL,
    `Phone_Number` VARCHAR(12) NOT NULL,
    `Address` VARCHAR(100) NOT NULL,
    `NID` VARCHAR(12) NOT NULL,
    `Email` VARCHAR(50) NOT NULL,
    `Gender` ENUM('M', 'F', 'O') NOT NULL,
    `Language` VARCHAR(20) NOT NULL,
    `Last_Seen` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Image BLOB,
    PRIMARY KEY (`ParentID`),
    FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE parent ADD COLUMN ImageType VARCHAR(255);

ALTER TABLE child ADD COLUMN ImageType VARCHAR(255);

INSERT INTO
    `parent` (
        `UserID`,
        `Last_Name`,
        `First_Name`,
        `Phone_Number`,
        `Address`,
        `NID`,
        `Email`,
        `Gender`,
        `Language`,
        `Last_Seen`
    )
VALUES (
        5,
        'Abdulla',
        'SA',
        '071-481 0928',
        '106/37',
        '200232901776',
        'abdullaaurad@gmail.com',
        'M',
        'English',
        '2024-11-13 13:38:13'
    ),
    (
        6,
        'Abdulla',
        'SA',
        '071-481 0928',
        '106/37',
        '200232901776',
        'abdullaaurad@gmail.com',
        'M',
        'English',
        '2024-11-13 13:47:22'
    );

INSERT INTO
    parent (
        UserID,
        Last_Name,
        First_Name,
        Phone_Number,
        Address,
        NID,
        Email,
        Gender,
        Language,
        Last_Seen,
        Image
    )
VALUES (
        9,
        'Smith',
        'John',
        '9876543210',
        '123 Elm Street, Cityville',
        '123456789012',
        'john.smith@example.com',
        'M',
        'English',
        '2025-01-05 10:15:00',
        NULL
    ),
    (
        10,
        'Doe',
        'Jane',
        '8765432109',
        '456 Oak Avenue, Townsville',
        '234567890123',
        'jane.doe@example.com',
        'F',
        'Spanish',
        '2025-01-05 12:30:00',
        NULL
    ),
    (
        11,
        'Brown',
        'Michael',
        '7654321098',
        '789 Pine Road, Hamlet',
        '345678901234',
        'michael.brown@example.com',
        'M',
        'French',
        '2025-01-05 14:45:00',
        NULL
    ),
    (
        12,
        'Johnson',
        'Emily',
        '6543210987',
        '321 Maple Lane, Village',
        '456789012345',
        'emily.johnson@example.com',
        'F',
        'German',
        '2025-01-05 16:00:00',
        NULL
    ),
    (
        13,
        'Lee',
        'Chris',
        '5432109876',
        '654 Willow Court, Metropolis',
        '567890123456',
        'chris.lee@example.com',
        'O',
        'Mandarin',
        '2025-01-05 18:15:00',
        NULL
    );

CREATE TABLE `child` (
    `ChildID` INT NOT NULL AUTO_INCREMENT,
    `ParentID` INT NOT NULL,
    `First_Name` VARCHAR(255) NOT NULL,
    `Last_Name` VARCHAR(255) NOT NULL,
    `DOB` DATE NOT NULL,
    `Nickname` VARCHAR(255) DEFAULT NULL,
    `Relation` VARCHAR(255) NOT NULL,
    `Religion` ENUM(
        'Buddhism',
        'Hinduism',
        'Islam',
        'Christianity'
    ),
    `Language` ENUM('Sinhala', 'Tamil', 'English') NOT NULL,
    `Allergies` VARCHAR(255) DEFAULT NULL,
    `Gender` ENUM('M', 'F', 'O') NOT NULL,
    `Image` BLOB,
    PRIMARY KEY (`ChildID`),
    FOREIGN KEY (`ParentID`) REFERENCES `parent` (`ParentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE Child ADD COLUMN PackageID INT;

ALTER TABLE Child
ADD CONSTRAINT fk_package FOREIGN KEY (PackageID) REFERENCES Package (PackageID) ON UPDATE CASCADE ON DELETE CASCADE;

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`
    )
VALUES (
        1,
        1,
        'Aahil',
        'Arshad',
        '2022-03-04',
        'Al',
        'Uncle',
        'Other',
        'English',
        NULL
    ),
    (
        2,
        1,
        'Ayyub',
        'Mahir',
        '2021-12-31',
        'Ayy',
        'Uncle',
        'Islam',
        'English',
        'None'
    ),
    (
        3,
        1,
        'Farha',
        'Fazloon',
        '2021-04-05',
        'pilaka',
        'Cousin',
        'Other',
        'English',
        NULL
    ),
    (
        4,
        1,
        'Manha',
        'Mahir',
        '2021-05-08',
        'Man',
        'Uncle',
        'Islam',
        'English',
        NULL
    ),
    (
        5,
        1,
        'Yunus',
        'Mahir',
        '2017-09-03',
        'Yunu',
        'Uncle',
        'Islam',
        'English',
        'none'
    );

CREATE TABLE `Child_Medication_Images` (
    `ImageID` INT NOT NULL AUTO_INCREMENT,
    `ChildID` INT NOT NULL,
    `MedicationImage` BLOB NOT NULL,
    `DateAdded` DATE NOT NULL,
    PRIMARY KEY (`ImageID`),
    FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE Child_Medication_documents (
    FileID INT AUTO_INCREMENT PRIMARY KEY,
    OriginalName VARCHAR(255) NOT NULL,
    FileType VARCHAR(50) NOT NULL,
    UploadedFile LONGBLOB,
    UploadDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    ChildID INT NOT NULL,
    UNIQUE (FileID),
    FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE child_medication_documents;

CREATE TABLE `guardian` (
    `GuardianID` INT NOT NULL AUTO_INCREMENT,
    `ParentID` INT NOT NULL,
    `First_Name` VARCHAR(255) NOT NULL,
    `Last_Name` VARCHAR(255) NOT NULL,
    `Relation` VARCHAR(255) NOT NULL,
    `Phone_Number` VARCHAR(12) NOT NULL,
    `Address` TEXT NOT NULL,
    `NID` VARCHAR(12) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Gender` ENUM('M', 'F', 'O') NOT NULL,
    `Language` ENUM('Sinhala', 'Tamil', 'English') NOT NULL,
    PRIMARY KEY (`GuardianID`),
    FOREIGN KEY (`ParentID`) REFERENCES `parent` (`ParentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `guardian` (
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `Relation`,
        `Phone_Number`,
        `Address`,
        `NID`,
        `Email`,
        `Gender`,
        `Language`
    )
VALUES (
        1,
        'aurad',
        'Abdulla',
        'Husband',
        '071-481 0928',
        '106/37',
        '200232901776',
        'fadhiya@gmail.com',
        'M',
        'English'
    );

CREATE TABLE Reminder (
    ReminderID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    Description VARCHAR(200) NOT NULL,
    Date DATE NOT NULL,
    PRIMARY KEY (ReminderID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
)

INSERT INTO
    Reminder (ChildID, Description, Date)
VALUES (
        1,
        'Submit homework',
        CURDATE()
    ),
    (
        2,
        'Attend parent-teacher meeting',
        CURDATE()
    ),
    (
        3,
        'Bring signed permission slip',
        CURDATE()
    ),
    (
        4,
        'Complete science project',
        CURDATE()
    ),
    (
        5,
        'Prepare for spelling bee',
        CURDATE()
    );

CREATE TABLE `reservation` (
    `ResID` INT(8) NOT NULL AUTO_INCREMENT,
    `ChildID` INT(8) NOT NULL,
    `Date` DATE NOT NULL,
    `Start_Time` TIME NOT NULL,
    `End_Time` TIME NOT NULL,
    `Status` ENUM(
        'Pending',
        'Canceled',
        'Approved'
    ) NOT NULL DEFAULT 'Pending',
    `Notes` VARCHAR(100) DEFAULT NULL,
    `Is_24_Hour` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`ResID`),
    FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE reservation;

INSERT INTO
    `reservation` (
        `ChildID`,
        `Date`,
        `Start_Time`,
        `End_Time`,
        `Status`,
        `Notes`,
        `Is_24_Hour`
    )
VALUES (
        1,
        '2025-01-20',
        '08:00:00',
        '10:00:00',
        'Approved',
        NULL,
        1
    ),
    (
        1,
        '2025-01-22',
        '09:00:00',
        '11:00:00',
        'Pending',
        NULL,
        0
    ),
    (
        1,
        '2025-01-23',
        '08:30:00',
        '10:30:00',
        'Canceled',
        NULL,
        1
    ),
    (
        1,
        '2025-01-24',
        '09:15:00',
        '11:15:00',
        'Approved',
        NULL,
        1
    ),
    (
        1,
        '2025-01-25',
        '08:45:00',
        '10:45:00',
        'Pending',
        NULL,
        0
    ),
    (
        1,
        '2025-01-26',
        '09:00:00',
        '11:00:00',
        'Canceled',
        NULL,
        1
    ),
    (
        1,
        '2025-01-27',
        '08:00:00',
        '10:00:00',
        'Approved',
        NULL,
        1
    ),
    (
        1,
        '2025-01-28',
        '09:30:00',
        '11:30:00',
        'Pending',
        NULL,
        0
    ),
    (
        1,
        '2025-01-29',
        '08:15:00',
        '10:15:00',
        'Canceled',
        NULL,
        1
    ),
    (
        1,
        '2025-01-30',
        '09:45:00',
        '11:45:00',
        'Approved',
        NULL,
        1
    ),
    (
        1,
        '2025-02-24',
        '08:00:00',
        '10:00:00',
        'Approved',
        NULL,
        0
    ),
    (
        1,
        '2025-02-25',
        '09:00:00',
        '11:00:00',
        'Pending',
        NULL,
        1
    ),
    (
        1,
        '2025-02-16',
        '08:30:00',
        '10:30:00',
        'Canceled',
        NULL,
        1
    ),
    (
        1,
        '2025-02-17',
        '09:15:00',
        '11:15:00',
        'Approved',
        NULL,
        0
    ),
    (
        1,
        '2025-02-18',
        '08:45:00',
        '10:45:00',
        'Pending',
        NULL,
        1
    ),
    (
        1,
        '2025-02-19',
        '09:00:00',
        '11:00:00',
        'Canceled',
        NULL,
        1
    ),
    (
        1,
        '2025-02-20',
        '08:00:00',
        '10:00:00',
        'Approved',
        NULL,
        0
    ),
    (
        1,
        '2025-02-21',
        '09:30:00',
        '11:30:00',
        'Pending',
        NULL,
        1
    );

CREATE TABLE Teacher (
    TeacherID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL UNIQUE,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Gender ENUM('M', 'F', 'O') NOT NULL,
    Language ENUM('English', 'Sinhala', 'Tamil') NOT NULL,
    Last_Seen DATETIME NOT NULL,
    Subject ENUM('Maths', 'English', 'Science') NOT NULL,
    Image BLOB,
    PRIMARY KEY (TeacherID),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    `Teacher` (
        `UserID`,
        `Last_Name`,
        `First_Name`,
        `Phone_Number`,
        `Address`,
        `NID`,
        `Email`,
        `Gender`,
        `Language`,
        `Last_Seen`,
        `Subject`
    )
VALUES (
        1,
        'Smith',
        'John',
        '0712345678',
        '123 Elm Street',
        '123456789012',
        'john.smith@example.com',
        'M',
        'English',
        '2024-01-01 08:30:00',
        'Maths'
    ),
    (
        2,
        'Fernando',
        'Maria',
        '0787654321',
        '456 Oak Avenue',
        '987654321987',
        'maria.fernando@example.com',
        'F',
        'Spanish',
        '2024-01-02 09:00:00',
        'Science'
    ),
    (
        3,
        'Perera',
        'Saman',
        '0771234567',
        '789 Pine Road',
        '112233445566',
        'saman.perera@example.com',
        'M',
        'Sinhala',
        '2024-01-03 10:15:00',
        'Maths'
    ),
    (
        4,
        'Kumar',
        'Anita',
        '0769988776',
        '101 Maple Lane',
        '998877665544',
        'anita.kumar@example.com',
        'F',
        'English',
        '2024-01-04 11:45:00',
        'English'
    ),
    (
        5,
        'Rathnayake',
        'Priya',
        '0755544332',
        '202 Birch Street',
        '556677889900',
        'priya.rathnayake@example.com',
        'F',
        'Tamil',
        '2024-01-05 12:00:00',
        'English'
    );

CREATE TABLE `Maid` (
    `MaidID` INT NOT NULL AUTO_INCREMENT,
    `UserID` INT NOT NULL UNIQUE,
    `Last_Name` VARCHAR(100) NOT NULL,
    `First_Name` VARCHAR(100) NOT NULL,
    `Phone_Number` VARCHAR(15) NOT NULL,
    `Address` VARCHAR(100) NOT NULL,
    `NID` VARCHAR(12) NOT NULL,
    `Language` ENUM('Sinhala', 'Tamil', 'English') NOT NULL,
    `Last_Seen` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `AgeGroup` ENUM(
        '2-3',
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15'
    ) NOT NULL,
    Image BLOB,
    PRIMARY KEY (`MaidID`),
    FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `Maid` (
        `UserID`,
        `Last_Name`,
        `First_Name`,
        `Phone_Number`,
        `Address`,
        `NID`,
        `Language`,
        `Last_Seen`,
        `AgeGroup`
    )
VALUES (
        1,
        'Fernando',
        'Priya',
        '0771234567',
        'Colombo 3, Galle Road',
        '123456789012',
        'Sinhala',
        '2025-01-04 09:15:00',
        '14-15'
    ),
    (
        2,
        'Perera',
        'Tharushi',
        '0762345678',
        'Colombo 5, Jaya Road',
        '234567890123',
        'Tamil',
        '2025-01-04 09:20:00',
        '12-13'
    ),
    (
        3,
        'Wijesinghe',
        'Amara',
        '0753456789',
        'Kandy, Peradeniya Road',
        '345678901234',
        'English',
        '2025-01-04 09:25:00',
        '10-11'
    ),
    (
        4,
        'Dissanayake',
        'Nirosha',
        '0744567890',
        'Gampaha, Kaduwela',
        '456789012345',
        'Sinhala',
        '2025-01-04 09:30:00',
        '8-9'
    ),
    (
        5,
        'Gunarathne',
        'Dilini',
        '0735678901',
        'Negombo, St. Joseph Road',
        '567890123456',
        'Tamil',
        '2025-01-04 09:35:00',
        '6-7'
    );

CREATE TABLE `Receptionist` (
    `ReceptionistID` INT NOT NULL AUTO_INCREMENT,
    `UserID` INT NOT NULL UNIQUE,
    `Last_Name` VARCHAR(100) NOT NULL,
    `First_Name` VARCHAR(100) NOT NULL,
    `Phone_Number` VARCHAR(15) NOT NULL,
    `Address` VARCHAR(100) NOT NULL,
    `NID` VARCHAR(12) NOT NULL,
    `Email` VARCHAR(100) NOT NULL,
    `Gender` ENUM('M', 'F', 'O') NOT NULL,
    `Language` ENUM('Sinhala', 'Tamil', 'English') NOT NULL,
    `Last_Seen` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Image BLOB NOT NULL,
    PRIMARY KEY (`ReceptionistID`),
    FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `Receptionist` (
        `UserID`,
        `Last_Name`,
        `First_Name`,
        `Phone_Number`,
        `Address`,
        `NID`,
        `Email`,
        `Gender`,
        `Language`,
        `Last_Seen`,
        `Image`
    )
VALUES (
        1,
        'Smith',
        'John',
        '0712345678',
        '123 Main St',
        '123456789012',
        'john.smith@example.com',
        'M',
        'English',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        2,
        'Doe',
        'Jane',
        '0712345679',
        '456 Another St',
        '987654321098',
        'jane.doe@example.com',
        'F',
        'Sinhala',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        3,
        'Taylor',
        'Chris',
        '0712345680',
        '789 Elm St',
        '543216789012',
        'chris.taylor@example.com',
        'O',
        'Tamil',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        4,
        'Lee',
        'Alex',
        '0712345681',
        '123 Oak St',
        '321654987012',
        'alex.lee@example.com',
        'M',
        'English',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        5,
        'Green',
        'Emily',
        '0712345682',
        '567 Pine St',
        '654987321098',
        'emily.green@example.com',
        'F',
        'Sinhala',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    );

CREATE TABLE Doctor (
    DoctorID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL UNIQUE,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Specialization VARCHAR(100) NOT NULL,
    Doctor_Number VARCHAR(20) NOT NULL,
    Last_Seen DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Image BLOB NOT NULL,
    PRIMARY KEY (DoctorID),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    `Doctor` (
        `UserID`,
        `Last_Name`,
        `First_Name`,
        `Phone_Number`,
        `NID`,
        `Email`,
        `Specialization`,
        `Doctor_Number`,
        `Last_Seen`,
        `Image`
    )
VALUES (
        29,
        'Johnson',
        'Alice',
        '0712345673',
        '123456789012',
        'alice.johnson@example.com',
        'Cardiology',
        'D123456789',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        30,
        'Williams',
        'Bob',
        '0712345674',
        '234567890123',
        'bob.williams@example.com',
        'Neurology',
        'D223456789',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        31,
        'Brown',
        'Charlie',
        '0712345675',
        '345678901234',
        'charlie.brown@example.com',
        'Orthopedics',
        'D323456789',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        32,
        'Davis',
        'David',
        '0712345676',
        '456789012345',
        'david.davis@example.com',
        'Pediatrics',
        'D423456789',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        33,
        'Miller',
        'Eve',
        '0712345677',
        '567890123456',
        'eve.miller@example.com',
        'Dermatology',
        'D523456789',
        NOW(),
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    );

CREATE TABLE Manager (
    ManagerID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Phone INT(10) NOT NULL,
    Image BLOB NOT NULL,
    PRIMARY KEY (ManagerID),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    `Manager` (
        `UserID`,
        `Name`,
        `Email`,
        `Phone`,
        `Image`
    )
VALUES (
        34,
        'John Smith',
        'john.smith@example.com',
        1234567890,
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        35,
        'Sarah Lee',
        'sarah.lee@example.com',
        2345678901,
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        36,
        'Michael Brown',
        'michael.brown@example.com',
        3456789012,
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        37,
        'Emily Davis',
        'emily.davis@example.com',
        4567890123,
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    ),
    (
        38,
        'David Wilson',
        'david.wilson@example.com',
        5678901234,
        X'89504E470D0A1A0A0000000D4948445200000100000001000802000000F7B3BC34000000000467414D410000B18F0A1E000000000049454E44AE426082'
    );

CREATE TABLE Package (
    PackageID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Description TEXT NOT NULL,
    Monday BOOLEAN DEFAULT 0,
    Tuesday BOOLEAN DEFAULT 0,
    Wednesday BOOLEAN DEFAULT 0,
    Thursday BOOLEAN DEFAULT 0,
    Friday BOOLEAN DEFAULT 0,
    Saturday BOOLEAN DEFAULT 0,
    Sunday BOOLEAN DEFAULT 0,
    AllHours BOOLEAN DEFAULT 0, -- 24 hours allowed
    FoodAddons BOOLEAN DEFAULT 0, -- All food add-ons allowed
    Everything BOOLEAN DEFAULT 0,
    AgeGroup ENUM(
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15',
        'All'
    ) NO NULL,
    CHECK (Price > 0),
    PRIMARY KEY (PackageID)
);

ALTER TABLE Package
ADD COLUMN AllHours BOOLEAN DEFAULT 0,
ADD COLUMN FoodAddons BOOLEAN DEFAULT 0,
ADD COLUMN Everything BOOLEAN DEFAULT 0;

INSERT INTO
    Package (
        Name,
        Price,
        Description,
        Monday,
        Tuesday,
        Wednesday,
        Thursday,
        Friday,
        Saturday,
        Sunday
    )
VALUES (
        'Basic Package',
        49.99,
        'Basic package with standard services.',
        TRUE,
        FALSE,
        TRUE,
        FALSE,
        TRUE,
        FALSE,
        FALSE
    ),
    (
        'Premium Package',
        149.99,
        'Premium package with extended services.',
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE
    ),
    (
        'Family Package',
        89.99,
        'Ideal for families, includes discounts and more.',
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        FALSE,
        TRUE,
        FALSE
    ),
    (
        'Weekend Getaway',
        119.99,
        'Weekend package with all-inclusive services.',
        FALSE,
        FALSE,
        FALSE,
        TRUE,
        TRUE,
        TRUE,
        FALSE
    ),
    (
        'VIP Package',
        249.99,
        'All-inclusive VIP package with luxury services.',
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE,
        TRUE
    );

CREATE TABLE Attendance (
    AttendanceID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    Start_Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    End_Date DATE,
    End_Time TIME,
    Status ENUM('Present', 'Absent') NOT NULL,
    PRIMARY KEY (AttendanceID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE attendance
ADD COLUMN Pickup ENUM('Parent', 'Guardian', 'Other');

INSERT INTO
    Attendance (
        ChildID,
        Start_Date,
        Start_Time,
        End_Date,
        End_Time,
        Status
    )
VALUES (
        1,
        '2025-01-01',
        '08:00:00',
        '2025-01-01',
        '15:00:00',
        'Present'
    ),
    (
        2,
        '2025-01-01',
        '08:30:00',
        '2025-01-01',
        '14:45:00',
        'Present'
    ),
    (
        3,
        '2025-01-01',
        '09:00:00',
        '2025-01-01',
        '13:30:00',
        'Absent'
    ),
    (
        4,
        '2025-01-01',
        '08:15:00',
        '2025-01-01',
        '12:45:00',
        'Absent'
    ),
    (
        5,
        '2025-01-01',
        '07:50:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        1,
        '2025-01-02',
        '08:10:00',
        '2025-01-02',
        '15:20:00',
        'Present'
    ),
    (
        2,
        '2025-01-02',
        '08:25:00',
        '2025-01-02',
        '14:30:00',
        'Present'
    ),
    (
        3,
        '2025-01-02',
        '08:50:00',
        '2025-01-02',
        '13:10:00',
        'Absent'
    ),
    (
        4,
        '2025-01-02',
        '08:00:00',
        '2025-01-02',
        '16:00:00',
        'Present'
    ),
    (
        5,
        '2025-01-02',
        '08:30:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        1,
        '2025-01-03',
        '08:00:00',
        '2025-01-03',
        '15:10:00',
        'Present'
    ),
    (
        2,
        '2025-01-03',
        '08:40:00',
        '2025-01-03',
        '14:00:00',
        'Absent'
    ),
    (
        3,
        '2025-01-03',
        '08:30:00',
        '2025-01-03',
        '14:15:00',
        'Present'
    ),
    (
        4,
        '2025-01-03',
        '07:55:00',
        '2025-01-03',
        '12:30:00',
        'Absent'
    ),
    (
        5,
        '2025-01-03',
        '08:00:00',
        '2025-01-03',
        '15:00:00',
        'Present'
    ),
    (
        1,
        '2025-01-04',
        '08:20:00',
        '2025-01-04',
        '14:50:00',
        'Absent'
    ),
    (
        2,
        '2025-01-04',
        '08:00:00',
        '2025-01-04',
        '15:10:00',
        'Present'
    ),
    (
        3,
        '2025-01-04',
        '09:00:00',
        '2025-01-04',
        '14:00:00',
        'Absent'
    ),
    (
        4,
        '2025-01-04',
        '08:15:00',
        '2025-01-04',
        '15:30:00',
        'Present'
    ),
    (
        5,
        '2025-01-04',
        '08:10:00',
        NULL,
        NULL,
        'Absent'
    );

CREATE TABLE Pickup (
    PickupID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Person ENUM('Parent', 'Guardian', 'New') NOT NULL,
    OTP CHAR(6) NOT NULL CHECK (OTP REGEXP '^[0-9]{6}$'),
    Description VARCHAR(100),
    PRIMARY KEY (PickupID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE NO ACTION,
    UNIQUE (ChildID, Date)
);

INSERT INTO
    Pickup (
        ChildID,
        Date,
        Time,
        Person,
        OTP,
        Description
    )
VALUES (
        1,
        '2025-01-04',
        '08:30:00',
        'Parent',
        '123456',
        'Picked up by father'
    ),
    (
        2,
        '2025-01-04',
        '09:00:00',
        'Guardian',
        '234567',
        'Picked up by aunt'
    ),
    (
        3,
        '2025-01-04',
        '10:00:00',
        'New',
        '345678',
        'Picked up by babysitter'
    ),
    (
        4,
        '2025-01-04',
        '11:15:00',
        'Parent',
        '456789',
        'Picked up by mother'
    ),
    (
        5,
        '2025-01-04',
        '12:45:00',
        'Parent',
        '567890',
        'Picked up by father'
    ),
    (
        1,
        '2025-01-05',
        '08:45:00',
        'Parent',
        '678901',
        'Picked up by mother'
    ),
    (
        2,
        '2025-01-05',
        '09:15:00',
        'Guardian',
        '789012',
        'Picked up by grandmother'
    ),
    (
        3,
        '2025-01-05',
        '10:30:00',
        'New',
        '890123',
        'Picked up by babysitter'
    ),
    (
        4,
        '2025-01-05',
        '11:45:00',
        'Parent',
        '901234',
        'Picked up by father'
    ),
    (
        5,
        '2025-01-05',
        '13:00:00',
        'Parent',
        '012345',
        'Picked up by mother'
    );

CREATE PROCEDURE LogAndDeletePickup()
BEGIN
    -- Insert the pickups for the day into the PickupHistory table
    INSERT INTO PickupHistory_Archive (PickupID, ChildID, Date, Time, Person, OTP, Description)
    SELECT PickupID, ChildID, Date, Time, Person, OTP, Description
    FROM Pickup
    WHERE Date < CURDATE();  -- You can use CURDATE() to select pickups scheduled for the past

    -- Insert the related pickup person details into the PickupPersonHistory table
    INSERT INTO PickupPerson_Archive (PickupID, Name, NID, Image, ArchivedAt)
    SELECT PickupID, Name, NID, Image, NOW()
    FROM PickupPerson
    WHERE PickupID IN (SELECT PickupID FROM Pickup WHERE Date < CURDATE());

    -- Delete the pickups that have been logged and completed
    DELETE FROM Pickup
    WHERE Date < CURDATE();  -- Delete pickups for completed days

    -- Delete the related pickup persons
    DELETE FROM PickupPerson
    WHERE PickupID IN (SELECT PickupID FROM Pickup WHERE Date < CURDATE());
END

CREATE TABLE Pickup_Archive (
    HistoryID INT NOT NULL AUTO_INCREMENT,
    PickupID INT NOT NULL,
    ChildID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Person ENUM('Parent', 'Guardian', 'New') NOT NULL,
    OTP CHAR(6) NOT NULL CHECK (OTP REGEXP '^[0-9]{6}$'),
    Description VARCHAR(100),
    ArchivedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (HistoryID)
);

CREATE TABLE PickupPerson_Archive (
    HistoryID INT NOT NULL AUTO_INCREMENT,
    PickupID INT NOT NULL,
    Name VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Image BLOB,
    ArchivedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (HistoryID),
    FOREIGN KEY (PickupID) REFERENCES Pickup (PickupID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PickupPerson (
    PersonID INT NOT NULL AUTO_INCREMENT,
    PickupID INT NOT NULL,
    Name VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL UNIQUE,
    Image BLOB,
    PRIMARY KEY (PersonID),
    FOREIGN KEY (PickupID) REFERENCES Pickup (PickupID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    PickupPerson (PickupID, Name, NID, Image)
VALUES (
        1,
        'John Doe',
        '123456789012',
        NULL
    ),
    (
        2,
        'Jane Smith',
        '987654321098',
        NULL
    ),
    (
        3,
        'Alice Brown',
        '112233445566',
        NULL
    );

INSERT INTO
    Pickup (
        ChildID,
        Date,
        Time,
        Person,
        OTP,
        Description
    )
VALUES (
        1,
        '2025-01-01',
        '08:30:00',
        'Parent',
        '123456',
        'Picked up by father'
    );

CREATE TABLE Visitor (
    VisitorID INT NOT NULL AUTO_INCREMENT,
    VisitorName VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL UNIQUE,
    Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    End_Time TIME NOT NULL,
    Purpose VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(10) NOT NULL,
    ParentID INT,
    PRIMARY KEY (VisitorID),
    FOREIGN KEY (ParentID) REFERENCES Parent (ParentID) ON UPDATE CASCADE ON DELETE NO ACTION
);

INSERT INTO
    Visitor (
        VisitorName,
        NID,
        Date,
        Start_Time,
        End_Time,
        Purpose,
        Phone_Number,
        ParentID
    )
VALUES (
        'John Doe',
        '123456789012',
        '2025-01-04',
        '08:30:00',
        '09:00:00',
        'Pick Up',
        '9876543210',
        NULL
    ),
    (
        'Jane Smith',
        '987654321098',
        '2025-01-04',
        '10:00:00',
        '10:30:00',
        'Drop Off',
        '1234567890',
        NULL
    ),
    (
        'Mark Johnson',
        '112233445566',
        '2025-01-04',
        '12:00:00',
        '12:30:00',
        'Meeting',
        '5551234567',
        NULL
    ),
    (
        'Lucy Brown',
        '223344556677',
        '2025-01-04',
        '14:00:00',
        '14:45:00',
        'Pick Up',
        '6669876543',
        NULL
    ),
    (
        'Emily White',
        '334455667788',
        '2025-01-04',
        '15:00:00',
        '15:30:00',
        'Emergency',
        '7776543210',
        NULL
    );

CREATE TABLE Visitor_Archive (
    VisitorID INT NOT NULL,
    VisitorName VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL UNIQUE,
    Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    End_Time TIME NOT NULL,
    Purpose VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(10) NOT NULL,
    ParentID INT,
    ArchiveDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (VisitorID)
);

CREATE PROCEDURE ArchiveVisitorData()
BEGIN
    -- Insert all current records from the Visitor table into the Visitor_Archive table
    INSERT INTO Visitor_Archive (VisitorID, VisitorName, NID, Date, Start_Time, End_Time, Purpose, Phone_Number, ParentID)
    SELECT VisitorID, VisitorName, NID, Date, Start_Time, End_Time, Purpose, Phone_Number, ParentID
    FROM Visitor;

    -- Delete the moved records from the Visitor table
    DELETE FROM Visitor;
END

CREATE TABLE MaidReport (
    ReportID INT NOT NULL AUTO_INCREMENT,
    AttendanceID INT NOT NULL,
    Viewed BOOLEAN DEFAULT 0,
    Downloaded Boolean DEFAULT 0,
    MaidID INT NOT NULL,
    PRIMARY KEY (ReportID),
    UNIQUE (AttendanceID), -- Ensure one Maid_Report per AttendanceID
    FOREIGN KEY (MaidID) REFERENCES Maid (MaidID) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY (AttendanceID) REFERENCES Attendance (AttendanceID) ON UPDATE CASCADE ON DELETE CASCADE
)

DROP TABLE Teacherreport;

INSERT INTO
    MaidReport (
        ReportID,
        AttendanceID,
        Viewed,
        MaidID
    )
VALUES (1, 1, 0, 1),
    (2, 2, 1, 2),
    (3, 3, 0, 3),
    (4, 4, 1, 4),
    (5, 5, 0, 5),
    (6, 6, 1, 1),
    (7, 7, 0, 2),
    (8, 8, 1, 3),
    (9, 9, 0, 4),
    (10, 10, 1, 5);

CREATE TABLE TeacherReport (
    ReportID INT NOT NULL,
    TeacherID INT NOT NULL,
    ChildID INT NOT NULL,
    Date DATE NOT NULL,
    Viewed BOOLEAN DEFAULT 0,
    Downloaded Boolean DEFAULT 0,
    PRIMARY KEY (ReportID),
    UNIQUE (ChildID, Date),
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
)

INSERT INTO
    TeacherReport (
        ReportID,
        TeacherID,
        ChildID,
        Date,
        Viewed
    )
VALUES (1, 1, 1, '2025-01-01', 0),
    (2, 2, 2, '2025-01-02', 0),
    (3, 3, 3, '2025-01-03', 1),
    (4, 1, 4, '2025-01-04', 0),
    (5, 2, 5, '2025-01-05', 1),
    (6, 3, 1, '2025-01-06', 0),
    (7, 1, 2, '2025-01-07', 1),
    (8, 2, 3, '2025-01-08', 0),
    (9, 3, 4, '2025-01-09', 0),
    (10, 1, 5, '2025-01-10', 1);

CREATE TABLE FoodPlan (
    MealID INT NOT NULL AUTO_INCREMENT,
    Date DATE NOT NULL,
    Time ENUM(
        'Breakfast',
        'Lunch',
        'Dinner'
    ) NOT NULL,
    Food VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (MealID),
    UNIQUE (Date, Time, Food)
);

INSERT INTO
    FoodPlan (Date, Time, Food)
VALUES (
        '2025-01-05',
        'Breakfast',
        'Pancakes'
    ),
    (
        '2025-01-05',
        'Lunch',
        'Grilled Chicken Salad'
    ),
    (
        '2025-01-05',
        'Dinner',
        'Spaghetti Bolognese'
    ),
    (
        '2025-01-06',
        'Breakfast',
        'Scrambled Eggs with Toast'
    ),
    (
        '2025-01-06',
        'Lunch',
        'Vegetable Stir-Fry with Rice'
    ),
    (
        '2025-01-06',
        'Dinner',
        'Beef Stew with Mashed Potatoes'
    ),
    (
        '2025-01-07',
        'Breakfast',
        'Fruit Yogurt Bowl'
    ),
    (
        '2025-01-07',
        'Lunch',
        'Chicken Caesar Wrap'
    ),
    (
        '2025-01-07',
        'Dinner',
        'Grilled Salmon with Vegetables'
    ),
    (
        '2025-01-08',
        'Breakfast',
        'Oatmeal with Honey and Berries'
    ),
    (
        '2025-01-08',
        'Lunch',
        'Turkey Sandwich'
    ),
    (
        '2025-01-08',
        'Dinner',
        'Vegetarian Lasagna'
    ),
    (
        '2025-01-09',
        'Breakfast',
        'Bagel with Cream Cheese'
    ),
    (
        '2025-01-09',
        'Lunch',
        'Quinoa Salad with Roasted Vegetables'
    ),
    (
        '2025-01-09',
        'Dinner',
        'Roast Chicken with Sweet Potatoes'
    ),
    (
        '2025-01-10',
        'Breakfast',
        'French Toast'
    ),
    (
        '2025-01-10',
        'Lunch',
        'Tuna Salad Sandwich'
    ),
    (
        '2025-01-10',
        'Dinner',
        'Chicken Curry with Rice'
    ),
    (
        '2025-01-11',
        'Breakfast',
        'Banana Smoothie'
    ),
    (
        '2025-01-11',
        'Lunch',
        'Grilled Vegetable Wrap'
    ),
    (
        '2025-01-11',
        'Dinner',
        'BBQ Pork Chops with Coleslaw'
    ),
    (
        '2025-01-12',
        'Breakfast',
        'Breakfast Burrito'
    ),
    (
        '2025-01-12',
        'Lunch',
        'Tomato Soup with Garlic Bread'
    ),
    (
        '2025-01-12',
        'Dinner',
        'Lamb Chops with Steamed Vegetables'
    ),
    (
        '2025-01-13',
        'Breakfast',
        'Avocado Toast'
    ),
    (
        '2025-01-13',
        'Lunch',
        'Chicken Noodle Soup'
    ),
    (
        '2025-01-13',
        'Dinner',
        'Vegetable Pizza'
    ),
    (
        '2025-01-14',
        'Breakfast',
        'Cereal with Milk'
    ),
    (
        '2025-01-14',
        'Lunch',
        'Shrimp Salad'
    ),
    (
        '2025-01-14',
        'Dinner',
        'Stuffed Bell Peppers'
    );

CREATE TABLE SnackPlan (
    SnackID INT NOT NULL AUTO_INCREMENT,
    Date DATE NOT NULL,
    Time ENUM(
        'Breakfast',
        'Lunch',
        'Dinner'
    ) NOT NULL,
    Snack VARCHAR(100) NOT NULL UNIQUE,
    Price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (SnackID),
    UNIQUE (Date, Time, Snack)
);

INSERT INTO
    SnackPlan (Date, Time, Snack, Price)
VALUES
    -- Entries for 2025-01-13
    (
        '2025-01-13',
        'Breakfast',
        'Strawberries',
        1.75
    ),
    (
        '2025-01-13',
        'Breakfast',
        'Granola Bar',
        1.50
    ),
    (
        '2025-01-13',
        'Breakfast',
        'Banana',
        0.75
    ),
    (
        '2025-01-13',
        'Lunch',
        'Energy Ball',
        2.00
    ),
    (
        '2025-01-13',
        'Lunch',
        'Muffin',
        2.50
    ),
    (
        '2025-01-13',
        'Lunch',
        'Yogurt',
        1.50
    ),
    (
        '2025-01-13',
        'Dinner',
        'Graham Crackers',
        1.25
    ),
    (
        '2025-01-13',
        'Dinner',
        'Trail Mix',
        2.25
    ),
    (
        '2025-01-13',
        'Dinner',
        'Cheese Crackers',
        1.75
    ),
    (
        '2025-01-14',
        'Breakfast',
        'Peach Slices',
        1.50
    ),
    (
        '2025-01-14',
        'Breakfast',
        'Apple Slices',
        1.25
    ),
    (
        '2025-01-14',
        'Breakfast',
        'Carrot Sticks with Hummus',
        2.50
    ),
    (
        '2025-01-14',
        'Lunch',
        'Cupcake',
        3.00
    ),
    (
        '2025-01-14',
        'Lunch',
        'Protein Bar',
        2.50
    ),
    (
        '2025-01-14',
        'Lunch',
        'Pretzels',
        1.00
    ),
    (
        '2025-01-14',
        'Dinner',
        'Hot Cocoa',
        2.50
    ),
    (
        '2025-01-14',
        'Dinner',
        'Ice Cream Cup',
        2.75
    ),
    (
        '2025-01-14',
        'Dinner',
        'Fruit Smoothie',
        3.50
    ),
    (
        '2025-01-15',
        'Breakfast',
        'Mixed Nuts',
        2.00
    ),
    (
        '2025-01-15',
        'Breakfast',
        'Hard-Boiled Egg',
        1.00
    ),
    (
        '2025-01-15',
        'Breakfast',
        'Granola with Milk',
        2.00
    ),
    (
        '2025-01-15',
        'Lunch',
        'Cheese Sticks',
        1.50
    ),
    (
        '2025-01-15',
        'Lunch',
        'Veggie Chips',
        1.50
    ),
    (
        '2025-01-15',
        'Lunch',
        'Popcorn',
        1.00
    ),
    (
        '2025-01-15',
        'Dinner',
        'Rice Cake with Almond Butter',
        2.00
    ),
    (
        '2025-01-15',
        'Dinner',
        'Mini Sandwich',
        2.75
    ),
    (
        '2025-01-15',
        'Dinner',
        'Chocolate Chip Cookie',
        1.50
    );

CREATE TABLE ScheduleVisits (
    ScheduleID INT NOT NULL AUTO_INCREMENT,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    NID VARCHAR(12) NOT NULL UNIQUE,
    Phone_Number VARCHAR(12) NOT NULL,
    ParentID INT,
    PRIMARY KEY (ScheduleID),
    FOREIGN KEY (ParentID) REFERENCES Parent (ParentID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE PROCEDURE DeletePastVisits()
BEGIN
    DELETE FROM ScheduleVisits
    WHERE Date < CURDATE();
END

INSERT INTO
    ScheduleVisits (
        Date,
        Time,
        NID,
        Phone_Number,
        ParentID
    )
VALUES (
        '2025-01-06',
        '09:00:00',
        '123456789012',
        '9876543210',
        1
    ),
    (
        '2025-01-06',
        '10:30:00',
        '234567890123',
        '8765432109',
        2
    ),
    (
        '2025-01-06',
        '11:00:00',
        '345678901234',
        '7654321098',
        NULL
    ),
    (
        '2025-01-07',
        '09:15:00',
        '456789012345',
        '6543210987',
        3
    ),
    (
        '2025-01-07',
        '14:00:00',
        '567890123456',
        '5432109876',
        NULL
    ),
    (
        '2025-01-08',
        '08:45:00',
        '678901234567',
        '4321098765',
        4
    ),
    (
        '2025-01-08',
        '15:30:00',
        '789012345678',
        '3210987654',
        5
    ),
    (
        '2025-01-09',
        '10:00:00',
        '890123456789',
        '2109876543',
        NULL
    ),
    (
        '2025-01-09',
        '13:45:00',
        '901234567890',
        '1098765432',
        NULL
    ),
    (
        '2025-01-10',
        '16:00:00',
        '012345678901',
        '0987654321',
        NULL
    );

CREATE TABLE SnackRequest (
    RequestID INT NOT NULL AUTO_INCREMENT,
    SnackID INT NOT NULL,
    ChildID INT NOT NULL,
    Quantity INT NOT NULL DEFAULT 1,
    PRIMARY KEY (RequestID),
    FOREIGN KEY (SnackID) REFERENCES SnackPlan (SnackID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE,
    UNIQUE (Date, SnackID, ChildID)
);

INSERT INTO
    SnackRequest (SnackID, ChildID, Quantity)
VALUES (1, 1, 2),
    (2, 2, 1),
    (3, 3, 3),
    (1, 4, 2),
    (2, 5, 1),
    (3, 1, 1),
    (1, 2, 2),
    (2, 3, 1),
    (3, 4, 2),
    (1, 5, 1);

CREATE TABLE DoctorSchedule (
    ScheduleID INT NOT NULL AUTO_INCREMENT,
    DoctorID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    PRIMARY KEY (ScheduleID),
    FOREIGN KEY (DoctorID) REFERENCES Doctor (DoctorID) ON UPDATE CASCADE ON DELETE CASCADE,
    UNIQUE (Date, Time)
);

CREATE TABLE ChildMedical (
    MedicalID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    DoctorID INT NOT NULL,
    Diagnosis VARCHAR(100),
    DateTime DATETIME NOT NULL,
    Notes VARCHAR(200),
    PRIMARY KEY (MedicalID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (DoctorID) REFERENCES Doctor (DoctorID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    DoctorSchedule (DoctorID, Date, Time)
VALUES (1, '2025-01-05', '09:00:00'),
    (1, '2025-01-05', '10:00:00'),
    (2, '2025-01-06', '11:00:00'),
    (2, '2025-01-06', '12:00:00'),
    (3, '2025-01-07', '08:00:00'),
    (3, '2025-01-07', '14:00:00'),
    (1, '2025-01-08', '09:30:00'),
    (1, '2025-01-08', '11:00:00'),
    (2, '2025-01-09', '13:00:00'),
    (2, '2025-01-09', '15:00:00');

INSERT INTO
    ChildMedical (
        ChildID,
        DoctorID,
        Diagnosis,
        DateTime,
        Notes
    )
VALUES (
        1,
        1,
        'Routine Checkup',
        '2025-01-05 09:00:00',
        'Healthy, no issues detected'
    ),
    (
        1,
        1,
        'Cold and Cough',
        '2025-01-05 10:00:00',
        'Prescribed cough syrup'
    ),
    (
        2,
        2,
        'Ear Infection',
        '2025-01-06 11:00:00',
        'Ear drops prescribed'
    ),
    (
        3,
        3,
        'Fever',
        '2025-01-07 08:00:00',
        'Fever medication given'
    ),
    (
        3,
        3,
        'Allergy',
        '2025-01-07 14:00:00',
        'Antihistamines prescribed'
    ),
    (
        4,
        1,
        'Routine Checkup',
        '2025-01-08 09:30:00',
        'Healthy, no issues detected'
    ),
    (
        5,
        2,
        'Tooth Pain',
        '2025-01-08 11:00:00',
        'Recommended to visit dentist'
    );

CREATE TABLE Emergency (
    EmergencyID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    Description VARCHAR(200) NOT NULL,
    DateTimE DATETIME DEFAULT CURRENT_TIMESTAMP,
    Informed BOOLEAN NOT NULL,
    AssigneeID INT NOT NULL,
    PRIMARY KEY (EmergencyID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (AssigneeID) REFERENCES Maid (MaidID) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE Emergency_Archive (
    EmergencyID INT NOT NULL,
    ChildID INT NOT NULL,
    Description VARCHAR(200) NOT NULL,
    DateTimE DATETIME NOT NULL,
    Informed BOOLEAN NOT NULL,
    AssigneeID INT NOT NULL,
    PRIMARY KEY (EmergencyID)
);

CREATE PROCEDURE ArchiveEmergencyData()
BEGIN
    -- Insert rows older than 30 days into the Emergency_Archive table
    INSERT INTO Emergency_Archive (EmergencyID, ChildID, Description, DateTimE, Informed, AssigneeID)
    SELECT EmergencyID, ChildID, Description, DateTimE, Informed, AssigneeID
    FROM Emergency
    WHERE DateTimE < NOW() - INTERVAL 30 DAY;

    -- Delete rows older than 30 days from the Emergency table
    DELETE FROM Emergency
    WHERE DateTimE < NOW() - INTERVAL 30 DAY;
END

INSERT INTO
    Emergency (
        ChildID,
        Description,
        Informed,
        AssigneeID
    )
VALUES (
        1,
        'Child fell down while playing in the playground',
        TRUE,
        3
    ),
    (
        2,
        'Child had an allergic reaction to peanuts',
        TRUE,
        5
    ),
    (
        3,
        'Child had a minor burn from hot water',
        FALSE,
        2
    ),
    (
        4,
        'Child has a stomach ache',
        TRUE,
        4
    ),
    (
        5,
        'Child was seen fainting and unresponsive',
        FALSE,
        1
    );

CREATE TABLE AssignTeacher (
    WorkID INT NOT NULL AUTO_INCREMENT,
    TeacherID INT NOT NULL,
    Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    AgeGroup ENUM(
        '2-3',
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15'
    ) NOT NULL,
    Subject VARCHAR(20) NOT NULL,
    PRIMARY KEY (WorkID),
    UNIQUE (
        TeacherID,
        Date,
        Start_Time,
        AgeGroup
    )
);

INSERT INTO
    AssignTeacher (
        TeacherID,
        Date,
        Start_Time,
        AgeGroup,
        Subject
    )
VALUES (
        14,
        '2025-01-28',
        '08:00:00',
        '2-3',
        'Math'
    ),
    (
        14,
        '2025-01-28',
        '09:00:00',
        '4-5',
        'Science'
    ),
    (
        14,
        '2025-01-28',
        '10:30:00',
        '6-7',
        'English'
    ),
    (
        14,
        '2025-01-28',
        '11:00:00',
        '8-9',
        'History'
    ),
    (
        14,
        '2025-01-07',
        '12:30:00',
        '10-11',
        'Geography'
    ),
    (
        14,
        '2025-01-07',
        '14:00:00',
        '12-13',
        'Arts'
    );

CREATE TABLE Activity (
    WorkID INT NOT NULL,
    ActivityID INT NOT NULL AUTO_INCREMENT,
    TeacherID INT NOT NULL,
    Description TEXT NOT NULL,
    CreatedBy INT NOT NULL,
    CreatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedBy INT,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ActivityID),
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (WorkID) REFERENCES AssignTeacher (WorkID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    AssignTeacher (
        TeacherID,
        Date,
        Start_Time,
        AgeGroup,
        Subject
    )
VALUES (
        14,
        '2025-01-28',
        '15:00:00',
        '2-3',
        'Math'
    ),
    (
        14,
        '2025-01-28',
        '16:00:00',
        '2-3',
        'Science'
    ),
    (
        14,
        '2025-01-28',
        '17:00:00',
        '2-3',
        'English'
    ),
    (
        14,
        '2025-01-28',
        '18:00:00',
        '2-3',
        'History'
    ),
    (
        14,
        '2025-01-28',
        '19:00:00',
        '2-3',
        'Geography'
    ),
    (
        14,
        '2025-01-28',
        '20:00:00',
        '2-3',
        'Arts'
    ),
    (
        14,
        '2025-01-28',
        '21:00:00',
        '2-3',
        'Biology'
    ),
    (
        14,
        '2025-01-28',
        '22:00:00',
        '2-3',
        'Music'
    ),
    (
        14,
        '2025-01-28',
        '23:00:00',
        '2-3',
        'Physical Education'
    );

INSERT INTO
    Activity (
        WorkID,
        TeacherID,
        Description,
        CreatedBy,
        CreatedAt,
        UpdatedBy,
        UpdatedAt
    )
VALUES (
        2,
        2,
        'Science experiments for age group 4-5',
        2,
        NOW(),
        2,
        NOW()
    ),
    (
        3,
        3,
        'Drawing and arts for age group 6-7',
        3,
        NOW(),
        3,
        NOW()
    ),
    (
        4,
        4,
        'Storytelling for age group 8-9',
        4,
        NOW(),
        4,
        NOW()
    ),
    (
        5,
        5,
        'Music class for age group 10-11',
        5,
        NOW(),
        5,
        NOW()
    ),
    (
        6,
        1,
        'Physical exercise for age group 12-13',
        1,
        NOW(),
        1,
        NOW()
    ),
    (
        7,
        2,
        'History lessons for age group 2-3',
        2,
        NOW(),
        2,
        NOW()
    );

CREATE TABLE AssignMaid (
    WorkID INT NOT NULL AUTO_INCREMENT,
    MaidID INT NOT NULL,
    ChildID INT NOT NULL,
    AgeGroup ENUM(
        '2-3',
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15'
    ) NOT NULL,
    Date DATE NOT NULL,
    UNIQUE (MaidID, ChildID, Date),
    PRIMARY KEY (WorkID),
    FOREIGN KEY (MaidID) REFERENCES Maid (MaidID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    AssignMaid (
        MaidID,
        ChildID,
        AgeGroup,
        Date
    )
VALUES (1, 1, '2-3', '2025-01-01'),
    (2, 2, '4-5', '2025-01-02'),
    (3, 3, '6-7', '2025-01-03'),
    (4, 4, '8-9', '2025-01-04'),
    (1, 5, '10-11', '2025-01-05'),
    (2, 1, '12-13', '2025-01-06'),
    (3, 2, '14-15', '2025-01-07'),
    (4, 3, '2-3', '2025-01-08'),
    (1, 4, '4-5', '2025-01-09'),
    (2, 5, '6-7', '2025-01-10');

CREATE TABLE TeacherLeave (
    LeaveID INT NOT NULL AUTO_INCREMENT,
    TeacherID INT NOT NULL,
    Date DATE NOT NULL,
    LeaveType ENUM(
        'Sick',
        'Casual',
        'Paid',
        'Emergency'
    ) NOT NULL,
    Emergency BOOLEAN NOT NULL,
    PRIMARY KEY (LeaveID),
    UNIQUE (TeacherID, Date),
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE MaidLeave (
    LeaveID INT NOT NULL AUTO_INCREMENT,
    MaidID INT NOT NULL,
    Date DATE NOT NULL,
    Emergency BOOLEAN NOT NULL,
    LeaveType ENUM(
        'Sick',
        'Casual',
        'Paid',
        'Emergency'
    ) NOT NULL,
    PRIMARY KEY (LeaveID),
    UNIQUE (MaidID, Date),
    FOREIGN KEY (MaidID) REFERENCES Maid (MaidID) ON UPDATE CASCADE ON DELETE NO ACTION
);

INSERT INTO
    TeacherLeave (
        TeacherID,
        Date,
        LeaveType,
        Emergency
    )
VALUES (1, '2025-01-10', 'Sick', TRUE),
    (
        2,
        '2025-01-12',
        'Casual',
        FALSE
    ),
    (
        3,
        '2025-01-14',
        'Paid',
        FALSE
    ),
    (
        4,
        '2025-01-15',
        'Emergency',
        TRUE
    ),
    (5, '2025-01-18', 'Sick', TRUE),
    (
        1,
        '2025-01-20',
        'Paid',
        FALSE
    ),
    (
        2,
        '2025-01-22',
        'Casual',
        FALSE
    ),
    (3, '2025-01-25', 'Sick', TRUE),
    (
        4,
        '2025-01-27',
        'Paid',
        FALSE
    ),
    (
        5,
        '2025-01-30',
        'Emergency',
        TRUE
    );

INSERT INTO
    MaidLeave (
        MaidID,
        Date,
        Emergency,
        LeaveType
    )
VALUES (1, '2025-01-10', TRUE, 'Sick'),
    (
        2,
        '2025-01-12',
        FALSE,
        'Casual'
    ),
    (
        3,
        '2025-01-14',
        FALSE,
        'Paid'
    ),
    (
        4,
        '2025-01-15',
        TRUE,
        'Emergency'
    ),
    (5, '2025-01-18', TRUE, 'Sick'),
    (
        1,
        '2025-01-20',
        FALSE,
        'Paid'
    ),
    (
        2,
        '2025-01-22',
        FALSE,
        'Casual'
    ),
    (3, '2025-01-25', TRUE, 'Sick'),
    (
        4,
        '2025-01-27',
        FALSE,
        'Paid'
    ),
    (
        5,
        '2025-01-30',
        TRUE,
        'Emergency'
    );

CREATE PROCEDURE UpdateDatesToCurrentPeriod()
BEGIN
    -- Declare variables for the dates
    DECLARE today_date DATE;
    DECLARE prev_date DATE;
    DECLARE next_date DATE;
    DECLARE today_datetime DATETIME;
    DECLARE prev_datetime DATETIME;
    DECLARE next_datetime DATETIME;
    
    -- Set the date variables
    SET today_date = CURDATE();
    SET prev_date = DATE_SUB(today_date, INTERVAL 1 DAY);
    SET next_date = DATE_ADD(today_date, INTERVAL 1 DAY);
    
    -- Set the datetime variables
    SET today_datetime = NOW();
    SET prev_datetime = DATE_SUB(today_datetime, INTERVAL 1 DAY);
    SET next_datetime = DATE_ADD(today_datetime, INTERVAL 1 DAY);
    
    -- Update Attendance table
    UPDATE Attendance 
    SET Start_Date = 
        CASE 
            WHEN MOD(AttendanceID, 3) = 0 THEN today_date
            WHEN MOD(AttendanceID, 3) = 1 THEN prev_date
            ELSE next_date
        END,
    End_Date = 
        CASE 
            WHEN End_Date IS NOT NULL THEN
                CASE 
                    WHEN MOD(AttendanceID, 3) = 0 THEN today_date
                    WHEN MOD(AttendanceID, 3) = 1 THEN prev_date
                    ELSE next_date
                END
            ELSE NULL
        END;
    
    -- Update Pickup table
    UPDATE Pickup
    SET Date = 
        CASE 
            WHEN MOD(PickupID, 3) = 0 THEN today_date
            WHEN MOD(PickupID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update Visitor table
    UPDATE Visitor
    SET Date = 
        CASE 
            WHEN MOD(VisitorID, 3) = 0 THEN today_date
            WHEN MOD(VisitorID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update TeacherReport table
    UPDATE TeacherReport
    SET Date = 
        CASE 
            WHEN MOD(ReportID, 3) = 0 THEN today_date
            WHEN MOD(ReportID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update FoodPlan table
    UPDATE FoodPlan
    SET Date = 
        CASE 
            WHEN MOD(MealID, 3) = 0 THEN today_date
            WHEN MOD(MealID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update SnackPlan table
    UPDATE SnackPlan
    SET Date = 
        CASE 
            WHEN MOD(SnackID, 3) = 0 THEN today_date
            WHEN MOD(SnackID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update ScheduleVisits table
    UPDATE ScheduleVisits
    SET Date = 
        CASE 
            WHEN MOD(ScheduleID, 3) = 0 THEN today_date
            WHEN MOD(ScheduleID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update DoctorSchedule table
    UPDATE DoctorSchedule
    SET Date = 
        CASE 
            WHEN MOD(ScheduleID, 3) = 0 THEN today_date
            WHEN MOD(ScheduleID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update ChildMedical table
    UPDATE ChildMedical
    SET DateTime = 
        CASE 
            WHEN MOD(MedicalID, 3) = 0 THEN today_datetime
            WHEN MOD(MedicalID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;

    -- Update Emergency table
    UPDATE Emergency
    SET DateTime = 
        CASE 
            WHEN MOD(EmergencyID, 3) = 0 THEN today_datetime
            WHEN MOD(EmergencyID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;

    -- Update AssignTeacher table
    UPDATE AssignTeacher
    SET Date = 
        CASE 
            WHEN MOD(WorkID, 3) = 0 THEN today_date
            WHEN MOD(WorkID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update AssignMaid table
    UPDATE AssignMaid
    SET Date = 
        CASE 
            WHEN MOD(WorkID, 3) = 0 THEN today_date
            WHEN MOD(WorkID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update TeacherLeave table
    UPDATE TeacherLeave
    SET Date = 
        CASE 
            WHEN MOD(LeaveID, 3) = 0 THEN today_date
            WHEN MOD(LeaveID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update MaidLeave table
    UPDATE MaidLeave
    SET Date = 
        CASE 
            WHEN MOD(LeaveID, 3) = 0 THEN today_date
            WHEN MOD(LeaveID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update Activity table timestamps
    UPDATE Activity
    SET CreatedAt = 
        CASE 
            WHEN MOD(ActivityID, 3) = 0 THEN today_datetime
            WHEN MOD(ActivityID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END,
    UpdatedAt = 
        CASE 
            WHEN MOD(ActivityID, 3) = 0 THEN today_datetime
            WHEN MOD(ActivityID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;
        
    -- Show confirmation message
    SELECT CONCAT('Dates updated successfully. Today: ', today_date, 
                 ', Yesterday: ', prev_date, 
                 ', Tomorrow: ', next_date) AS 'Update Status';
END

CALL `UpdateDatesToCurrentPeriod`

CREATE TABLE ReceptionistLeave (
    LeaveID INT NOT NULL AUTO_INCREMENT,
    ReceptionistID INT NOT NULL,
    Date DATE NOT NULL,
    Emergency BOOLEAN NOT NULL,
    PRIMARY KEY (LeaveID),
    UNIQUE (ReceptionistID, Date),
    FOREIGN KEY (ReceptionistID) REFERENCES Receptionist (ReceptionistID) ON UPDATE CASCADE ON DELETE NO ACTION
);

INSERT INTO
    ReceptionistLeave (
        ReceptionistID,
        Date,
        Emergency
    )
VALUES (1, '2025-01-10', TRUE),
    (2, '2025-01-12', FALSE),
    (3, '2025-01-15', TRUE),
    (4, '2025-01-18', FALSE),
    (5, '2025-01-20', TRUE);

CREATE TABLE Item (
    ItemID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    PRIMARY KEY (ItemID)
);

CREATE TABLE RequestItem (
    RequestID INT NOT NULL AUTO_INCREMENT,
    ItemID INT NOT NULL,
    WorkID INT NOT NULL,
    Quantity INT NOT NULL,
    PRIMARY KEY (RequestID),
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (WorkID) REFERENCES AssignTeacher (WorkID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CheckList (
    ListID INT NOT NULL AUTO_INCREMENT,
    RequestID INT NOT NULL,
    ChildID INT NOT NULL,
    Provided BOOLEAN DEFAULT 0,
    PRIMARY KEY (ListID),
    FOREIGN KEY (RequestID) REFERENCES RequestItem (RequestID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    Item (Name)
VALUES ('Pencil'),
    ('Eraser'),
    ('Notebook'),
    ('Ruler'),
    ('Sharpener');

INSERT INTO
    RequestItem (ItemID, WorkID, Quantity)
VALUES (1, 1, 10),
    (2, 2, 5),
    (3, 3, 7),
    (4, 4, 3),
    (5, 5, 6);

INSERT INTO
    CheckList (RequestID, ChildID, Provided)
VALUES (1, 1, TRUE),
    (2, 2, FALSE),
    (3, 3, TRUE),
    (4, 4, FALSE),
    (5, 5, TRUE);

CREATE TABLE Holiday (
    HolidayID INT NOT NULL AUTO_INCREMENT,
    Date DATE NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Details TEXT,
    IsPublicHoliday BOOLEAN NOT NULL DEFAULT 0,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (HolidayID)
);

INSERT INTO
    Holiday (
        Date,
        Name,
        Details,
        IsPublicHoliday
    )
VALUES (
        '2025-12-25',
        'Christmas',
        'Celebration of the birth of Jesus Christ',
        1
    ),
    (
        '2025-01-01',
        'New Year\'s Day',
        'First day of the year',
        1
    ),
    (
        '2025-05-01',
        'Labor Day',
        'Celebration of workers\' rights',
        1
    ),
    (
        '2025-07-04',
        'Independence Day',
        'Commemoration of the declaration of independence',
        1
    ),
    (
        '2025-10-31',
        'Halloween',
        'Celebration of all things spooky',
        0
    );

CREATE PROCEDURE UpdateDatesToCurrentPeriod()
BEGIN
    -- Declare variables for the dates
    DECLARE today_date DATE;
    DECLARE prev_date DATE;
    DECLARE next_date DATE;
    DECLARE today_datetime DATETIME;
    DECLARE prev_datetime DATETIME;
    DECLARE next_datetime DATETIME;
    
    -- Set the date variables
    SET today_date = CURDATE();
    SET prev_date = DATE_SUB(today_date, INTERVAL 1 DAY);
    SET next_date = DATE_ADD(today_date, INTERVAL 1 DAY);
    
    -- Set the datetime variables
    SET today_datetime = NOW();
    SET prev_datetime = DATE_SUB(today_datetime, INTERVAL 1 DAY);
    SET next_datetime = DATE_ADD(today_datetime, INTERVAL 1 DAY);
    
    -- Update Attendance table
    UPDATE Attendance 
    SET Start_Date = 
        CASE 
            WHEN MOD(AttendanceID, 3) = 0 THEN today_date
            WHEN MOD(AttendanceID, 3) = 1 THEN prev_date
            ELSE next_date
        END,
    End_Date = 
        CASE 
            WHEN End_Date IS NOT NULL THEN
                CASE 
                    WHEN MOD(AttendanceID, 3) = 0 THEN today_date
                    WHEN MOD(AttendanceID, 3) = 1 THEN prev_date
                    ELSE next_date
                END
            ELSE NULL
        END;

    -- Update Pickup table
    UPDATE Pickup
    SET Date = 
        CASE 
            WHEN MOD(PickupID, 3) = 0 THEN today_date
            WHEN MOD(PickupID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update Visitor table
    UPDATE Visitor
    SET Date = 
        CASE 
            WHEN MOD(VisitorID, 3) = 0 THEN today_date
            WHEN MOD(VisitorID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update TeacherReport table
    UPDATE TeacherReport
    SET Date = 
        CASE 
            WHEN MOD(ReportID, 3) = 0 THEN today_date
            WHEN MOD(ReportID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update FoodPlan table
    UPDATE FoodPlan
    SET Date = 
        CASE 
            WHEN MOD(MealID, 3) = 0 THEN today_date
            WHEN MOD(MealID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update SnackPlan table
    UPDATE SnackPlan
    SET Date = 
        CASE 
            WHEN MOD(SnackID, 3) = 0 THEN today_date
            WHEN MOD(SnackID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update ScheduleVisits table
    UPDATE ScheduleVisits
    SET Date = 
        CASE 
            WHEN MOD(ScheduleID, 3) = 0 THEN today_date
            WHEN MOD(ScheduleID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update DoctorSchedule table
    UPDATE DoctorSchedule
    SET Date = 
        CASE 
            WHEN MOD(ScheduleID, 3) = 0 THEN today_date
            WHEN MOD(ScheduleID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update ChildMedical table
    UPDATE ChildMedical
    SET DateTime = 
        CASE 
            WHEN MOD(MedicalID, 3) = 0 THEN today_datetime
            WHEN MOD(MedicalID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;

    -- Update Emergency table
    UPDATE Emergency
    SET DateTime = 
        CASE 
            WHEN MOD(EmergencyID, 3) = 0 THEN today_datetime
            WHEN MOD(EmergencyID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;

    -- Update AssignTeacher table
    UPDATE AssignTeacher
    SET Date = 
        CASE 
            WHEN MOD(WorkID, 3) = 0 THEN today_date
            WHEN MOD(WorkID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update AssignMaid table
    UPDATE AssignMaid
    SET Date = 
        CASE 
            WHEN MOD(WorkID, 3) = 0 THEN today_date
            WHEN MOD(WorkID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update TeacherLeave table
    UPDATE TeacherLeave
    SET Date = 
        CASE 
            WHEN MOD(LeaveID, 3) = 0 THEN today_date
            WHEN MOD(LeaveID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update MaidLeave table
    UPDATE MaidLeave
    SET Date = 
        CASE 
            WHEN MOD(LeaveID, 3) = 0 THEN today_date
            WHEN MOD(LeaveID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update Activity table timestamps
    UPDATE Activity
    SET CreatedAt = 
        CASE 
            WHEN MOD(ActivityID, 3) = 0 THEN today_datetime
            WHEN MOD(ActivityID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END,
    UpdatedAt = 
        CASE 
            WHEN MOD(ActivityID, 3) = 0 THEN today_datetime
            WHEN MOD(ActivityID, 3) = 1 THEN prev_datetime
            ELSE next_datetime
        END;
        
    -- Update ReceptionistLeave table
    UPDATE ReceptionistLeave
    SET Date = 
        CASE 
            WHEN MOD(LeaveID, 3) = 0 THEN today_date
            WHEN MOD(LeaveID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update RequestItem table (using WorkID)
    UPDATE RequestItem
    SET Date = 
        CASE 
            WHEN MOD(RequestID, 3) = 0 THEN today_date
            WHEN MOD(RequestID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update CheckList table (using RequestID)
    UPDATE CheckList
    SET Date = 
        CASE 
            WHEN MOD(ListID, 3) = 0 THEN today_date
            WHEN MOD(ListID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Update Holiday table
    UPDATE Holiday
    SET Date = 
        CASE 
            WHEN MOD(HolidayID, 3) = 0 THEN today_date
            WHEN MOD(HolidayID, 3) = 1 THEN prev_date
            ELSE next_date
        END;

    -- Show confirmation message
    SELECT CONCAT('Dates updated successfully. Today: ', today_date, 
                 ', Yesterday: ', prev_date, 
                 ', Tomorrow: ', next_date) AS 'Update Status';
END;

CALL `UpdateDatesToCurrentPeriod`

CREATE TABLE MeetingTimes (
    MeetingID INT NOT NULL AUTO_INCREMENT,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Scheduled BOOLEAN DEFAULT 0,
    PRIMARY KEY (MeetingID)
);

CREATE TABLE Meetings (
    MeetingID INT NOT NULL AUTO_INCREMENT,
    ParentID INT NOT NULL,
    TeacherID INT,
    MeetingReason VARCHAR(255),
    IsParentMeeting BOOLEAN DEFAULT 1,
    PRIMARY KEY (MeetingID),
    FOREIGN KEY (ParentID) REFERENCES Parent (ParentID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE SET NULL
);

INSERT INTO
    MeetingTimes (Date, Time, Scheduled)
VALUES ('2025-02-10', '10:00:00', 0),
    ('2025-02-11', '14:00:00', 0),
    ('2025-02-12', '16:00:00', 0),
    ('2025-02-13', '11:00:00', 0),
    ('2025-02-14', '09:00:00', 0),
    ('2025-02-15', '15:00:00', 0),
    ('2025-02-16', '13:00:00', 0),
    ('2025-02-17', '08:00:00', 0),
    ('2025-02-18', '10:30:00', 0),
    ('2025-02-19', '12:00:00', 0);

INSERT INTO
    Meetings (
        ParentID,
        TeacherID,
        MeetingReason,
        IsParentMeeting
    )
VALUES (
        1,
        1,
        'Discuss child\'s progress',
        1
    ),
    (
        2,
        NULL,
        'Talk about upcoming events',
        1
    ),
    (
        3,
        3,
        'Review exam results',
        1
    ),
    (
        4,
        NULL,
        'Plan future activities',
        1
    ),
    (
        5,
        5,
        'Child behavior discussion',
        1
    ),
    (
        6,
        2,
        'Review academic performance',
        1
    ),
    (
        7,
        NULL,
        'General feedback meeting',
        1
    ),
    (
        8,
        4,
        'Discuss extracurricular activities',
        1
    ),
    (
        9,
        3,
        'Follow-up on previous meeting',
        1
    ),
    (
        10,
        NULL,
        'Plan summer activities',
        1
    );

CREATE TABLE Chat (
    ChatID INT NOT NULL AUTO_INCREMENT,
    SenderID INT NOT NULL,
    ReceiverID INT NOT NULL,
    Message VARCHAR(200),
    Image BLOB,
    SenderRole ENUM(
        'Child',
        'Teacher',
        'Maid',
        'Manager',
        'Receptionist',
        'Doctor'
    ),
    ReceiverRole ENUM(
        'Child',
        'Teacher',
        'Maid',
        'Manager',
        'Receptionist',
        'Doctor'
    ),
    SentDate DATETIME DEFAULT CURRENT_TIMESTAMP, -- Date and time when the message was sent
    Seen BOOLEAN DEFAULT 0, -- If the receiver has seen the message (0 = No, 1 = Yes)
    DeletedBySender BOOLEAN DEFAULT 0, -- If the sender has deleted the message (0 = No, 1 = Yes)
    Edited BOOLEAN DEFAULT 0, -- If the message has been delivered (0 = No, 1 = Yes)
    PRIMARY KEY (ChatID)
);

ALTER TABLE chat
ADD COLUMN DateTime datetime DEFAULT CURRENT_TIMESTAMP;

INSERT INTO
    Chat (
        SenderID,
        ReceiverID,
        Message,
        Image,
        SenderRole,
        ReceiverRole,
        Seen,
        Deleted,
        Edited,
        ImageType,
        DateTime
    )
VALUES (
        1,
        2,
        'Message 1 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        0,
        'jpg',
        '2025-02-25 09:00:00'
    ),
    (
        1,
        3,
        'Message 2 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        0,
        'png',
        '2025-02-25 09:10:00'
    ),
    (
        1,
        4,
        'Message 3 from user 1',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'gif',
        '2025-02-25 09:20:00'
    ),
    (
        1,
        5,
        'Message 4 from user 1',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 09:30:00'
    ),
    (
        1,
        2,
        'Message 5 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        1,
        0,
        'png',
        '2025-02-25 09:40:00'
    ),
    (
        1,
        3,
        'Message 6 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'gif',
        '2025-02-25 09:50:00'
    ),
    (
        1,
        4,
        'Message 7 from user 1',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 10:00:00'
    ),
    (
        1,
        5,
        'Message 8 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        0,
        'png',
        '2025-02-25 10:10:00'
    ),
    (
        1,
        2,
        'Message 9 from user 1',
        NULL,
        'Child',
        'Teacher',
        1,
        1,
        0,
        'gif',
        '2025-02-25 10:20:00'
    ),
    (
        1,
        3,
        'Message 10 from user 1',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'jpg',
        '2025-02-25 10:30:00'
    ),
    (
        2,
        1,
        'Message 1 from user 2',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        0,
        'jpg',
        '2025-02-25 11:00:00'
    ),
    (
        2,
        3,
        'Message 2 from user 2',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'png',
        '2025-02-25 11:10:00'
    ),
    (
        2,
        4,
        'Message 3 from user 2',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        1,
        'gif',
        '2025-02-25 11:20:00'
    ),
    (
        2,
        5,
        'Message 4 from user 2',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 11:30:00'
    ),
    (
        2,
        1,
        'Message 5 from user 2',
        NULL,
        'Teacher',
        'Child',
        0,
        1,
        0,
        'png',
        '2025-02-25 11:40:00'
    ),
    (
        2,
        3,
        'Message 6 from user 2',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'gif',
        '2025-02-25 11:50:00'
    ),
    (
        2,
        4,
        'Message 7 from user 2',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        1,
        'jpg',
        '2025-02-25 12:00:00'
    ),
    (
        2,
        5,
        'Message 8 from user 2',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'png',
        '2025-02-25 12:10:00'
    ),
    (
        2,
        1,
        'Message 9 from user 2',
        NULL,
        'Teacher',
        'Child',
        0,
        1,
        0,
        'gif',
        '2025-02-25 12:20:00'
    ),
    (
        2,
        3,
        'Message 10 from user 2',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        1,
        'jpg',
        '2025-02-25 12:30:00'
    ),
    (
        3,
        2,
        'Message 1 from user 3',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'png',
        '2025-02-25 13:00:00'
    ),
    (
        3,
        4,
        'Message 2 from user 3',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'gif',
        '2025-02-25 13:10:00'
    ),
    (
        3,
        5,
        'Message 3 from user 3',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 13:20:00'
    ),
    (
        3,
        1,
        'Message 4 from user 3',
        NULL,
        'Child',
        'Teacher',
        0,
        1,
        0,
        'png',
        '2025-02-25 13:30:00'
    ),
    (
        3,
        2,
        'Message 5 from user 3',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'gif',
        '2025-02-25 13:40:00'
    ),
    (
        3,
        4,
        'Message 6 from user 3',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'jpg',
        '2025-02-25 13:50:00'
    ),
    (
        3,
        5,
        'Message 7 from user 3',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'png',
        '2025-02-25 14:00:00'
    ),
    (
        3,
        1,
        'Message 8 from user 3',
        NULL,
        'Child',
        'Teacher',
        0,
        1,
        0,
        'gif',
        '2025-02-25 14:10:00'
    ),
    (
        3,
        2,
        'Message 9 from user 3',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 14:20:00'
    ),
    (
        3,
        4,
        'Message 10 from user 3',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'png',
        '2025-02-25 14:30:00'
    ),
    (
        4,
        1,
        'Message 1 from user 4',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'gif',
        '2025-02-25 15:00:00'
    ),
    (
        4,
        2,
        'Message 2 from user 4',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        1,
        'jpg',
        '2025-02-25 15:10:00'
    ),
    (
        4,
        3,
        'Message 3 from user 4',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'png',
        '2025-02-25 15:20:00'
    ),
    (
        4,
        5,
        'Message 4 from user 4',
        NULL,
        'Teacher',
        'Child',
        0,
        1,
        0,
        'gif',
        '2025-02-25 15:30:00'
    ),
    (
        4,
        1,
        'Message 5 from user 4',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 15:40:00'
    ),
    (
        4,
        2,
        'Message 6 from user 4',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        1,
        'png',
        '2025-02-25 15:50:00'
    ),
    (
        4,
        3,
        'Message 7 from user 4',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'gif',
        '2025-02-25 16:00:00'
    ),
    (
        4,
        5,
        'Message 8 from user 4',
        NULL,
        'Teacher',
        'Child',
        0,
        1,
        0,
        'jpg',
        '2025-02-25 16:10:00'
    ),
    (
        4,
        1,
        'Message 9 from user 4',
        NULL,
        'Teacher',
        'Child',
        1,
        0,
        0,
        'png',
        '2025-02-25 16:20:00'
    ),
    (
        4,
        2,
        'Message 10 from user 4',
        NULL,
        'Teacher',
        'Child',
        0,
        0,
        1,
        'gif',
        '2025-02-25 16:30:00'
    ),
    (
        5,
        1,
        'Message 1 from user 5',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 17:00:00'
    ),
    (
        5,
        2,
        'Message 2 from user 5',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'png',
        '2025-02-25 17:10:00'
    ),
    (
        5,
        3,
        'Message 3 from user 5',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'gif',
        '2025-02-25 17:20:00'
    ),
    (
        5,
        4,
        'Message 4 from user 5',
        NULL,
        'Child',
        'Teacher',
        0,
        1,
        0,
        'jpg',
        '2025-02-25 17:30:00'
    ),
    (
        5,
        1,
        'Message 5 from user 5',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'png',
        '2025-02-25 17:40:00'
    ),
    (
        5,
        2,
        'Message 6 from user 5',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'gif',
        '2025-02-25 17:50:00'
    ),
    (
        5,
        3,
        'Message 7 from user 5',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'jpg',
        '2025-02-25 18:00:00'
    ),
    (
        5,
        4,
        'Message 8 from user 5',
        NULL,
        'Child',
        'Teacher',
        0,
        1,
        0,
        'png',
        '2025-02-25 18:10:00'
    ),
    (
        5,
        1,
        'Message 9 from user 5',
        NULL,
        'Child',
        'Teacher',
        1,
        0,
        0,
        'gif',
        '2025-02-25 18:20:00'
    ),
    (
        5,
        2,
        'Message 10 from user 5',
        NULL,
        'Child',
        'Teacher',
        0,
        0,
        1,
        'jpg',
        '2025-02-25 18:30:00'
    );

ALTER TABLE assignmaid DROP COLUMN AgeGroup;

INSERT INTO
    Chat (
        SenderID,
        RecieverID,
        Message,
        ChildID,
        SentDate,
        Seen,
        Delivered
    )
VALUES (
        9,
        5,
        'Hello, I have a question about my child’s progress.',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        7,
        'Can you update me on the homework assignments?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        3,
        'Is my child scheduled for tomorrow\'s activity?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        2,
        'Do you have any updates on the upcoming event?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        1,
        'Could you please confirm the meeting schedule?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        4,
        'I need assistance with understanding the lesson plan.',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        6,
        'Is there any information I should know about the class today?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        3,
        'My child has missed the class. Can you share the notes?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        5,
        'How can I help my child with the upcoming exam?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        7,
        'What time should I pick up my child tomorrow?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        2,
        'I would like to discuss my child’s improvement in the class.',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        4,
        'Can I reschedule the meeting for tomorrow?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        1,
        'I need some feedback on my child’s recent performance.',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        6,
        'Could you send me an update about the extracurricular activities?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        5,
        'When is the next parent-teacher meeting?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        3,
        'Please let me know if there are any changes in the schedule.',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        5,
        'Do you have any updates regarding my child’s health?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        7,
        'I have concerns about my child’s behavior. Can we talk?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        2,
        'Is there any special event I need to prepare for?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        1,
        'Can I arrange a parent-teacher meeting for next week?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        6,
        'I want to know more about today’s class activities.',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        1,
        'Can I get an update on my child’s performance?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        4,
        'Is there anything I need to do to help my child improve?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        3,
        'Can I speak with the teacher about my child’s project?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        7,
        'Can I expect any homework assignments this week?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        2,
        'Can you send me the syllabus for the upcoming semester?',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        7,
        'When will the next parent meeting take place?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        1,
        'Is there any feedback on my child’s social interactions?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        4,
        'I would like more information about the field trip next month.',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        6,
        'I would like to confirm if my child is on track with the curriculum.',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        5,
        'Could you explain the results of my child’s recent test?',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        3,
        'Can we schedule a time to talk about my child’s progress?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        2,
        'Can you let me know about the extracurricular activities planned for next week?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        6,
        'When will the teacher be available for a meeting?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        1,
        'Can you provide me with my child’s attendance record?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        4,
        'How can I help my child with the upcoming group project?',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        5,
        'Can we discuss the behavior issues I’ve noticed recently?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        7,
        'Could you provide an update on my child’s progress?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        3,
        'When is the next science experiment scheduled?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        6,
        'Can I get feedback on my child’s recent participation?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        1,
        'Could we talk about the recent test results?',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        6,
        'I have a question about the new curriculum.',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        4,
        'Is there anything I need to do regarding my child’s health?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        2,
        'Can we arrange a time to meet next week?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        5,
        'Is my child expected to bring anything for the next class?',
        5,
        NOW(),
        0,
        0
    ),
    (
        9,
        3,
        'Can you send me a summary of today’s lesson?',
        1,
        NOW(),
        0,
        0
    ),
    (
        10,
        1,
        'Could you let me know the schedule for next week’s activities?',
        2,
        NOW(),
        0,
        0
    ),
    (
        11,
        7,
        'Is there anything I can do to support my child’s learning at home?',
        3,
        NOW(),
        0,
        0
    ),
    (
        12,
        2,
        'What’s the homework for the weekend?',
        4,
        NOW(),
        0,
        0
    ),
    (
        13,
        4,
        'How is my child performing in the subject?',
        5,
        NOW(),
        0,
        0
    );

INSERT INTO
    Chat (
        SenderID,
        RecieverID,
        Message,
        ChildID,
        SentDate,
        Seen,
        Delivered
    )
VALUES (
        5,
        9,
        'Hello, I have a question about my child’s progress.',
        1,
        NOW(),
        0,
        0
    ),
    (
        7,
        10,
        'Can you update me on the homework assignments?',
        2,
        NOW(),
        0,
        0
    ),
    (
        3,
        11,
        'Is my child scheduled for tomorrow\'s activity?',
        3,
        NOW(),
        0,
        0
    ),
    (
        2,
        12,
        'Do you have any updates on the upcoming event?',
        4,
        NOW(),
        0,
        0
    ),
    (
        1,
        13,
        'Could you please confirm the meeting schedule?',
        5,
        NOW(),
        0,
        0
    ),
    (
        4,
        9,
        'I need assistance with understanding the lesson plan.',
        1,
        NOW(),
        0,
        0
    ),
    (
        6,
        10,
        'Is there any information I should know about the class today?',
        2,
        NOW(),
        0,
        0
    ),
    (
        3,
        11,
        'My child has missed the class. Can you share the notes?',
        3,
        NOW(),
        0,
        0
    ),
    (
        5,
        12,
        'How can I help my child with the upcoming exam?',
        4,
        NOW(),
        0,
        0
    ),
    (
        7,
        13,
        'What time should I pick up my child tomorrow?',
        5,
        NOW(),
        0,
        0
    ),
    (
        2,
        9,
        'I would like to discuss my child’s improvement in the class.',
        1,
        NOW(),
        0,
        0
    ),
    (
        4,
        10,
        'Can I reschedule the meeting for tomorrow?',
        2,
        NOW(),
        0,
        0
    ),
    (
        1,
        11,
        'I need some feedback on my child’s recent performance.',
        3,
        NOW(),
        0,
        0
    ),
    (
        6,
        12,
        'Could you send me an update about the extracurricular activities?',
        4,
        NOW(),
        0,
        0
    ),
    (
        5,
        13,
        'When is the next parent-teacher meeting?',
        5,
        NOW(),
        0,
        0
    ),
    (
        3,
        9,
        'Please let me know if there are any changes in the schedule.',
        1,
        NOW(),
        0,
        0
    ),
    (
        5,
        10,
        'Do you have any updates regarding my child’s health?',
        2,
        NOW(),
        0,
        0
    ),
    (
        7,
        11,
        'I have concerns about my child’s behavior. Can we talk?',
        3,
        NOW(),
        0,
        0
    ),
    (
        2,
        12,
        'Is there any special event I need to prepare for?',
        4,
        NOW(),
        0,
        0
    ),
    (
        1,
        13,
        'Can I arrange a parent-teacher meeting for next week?',
        5,
        NOW(),
        0,
        0
    ),
    (
        6,
        9,
        'I want to know more about today’s class activities.',
        1,
        NOW(),
        0,
        0
    ),
    (
        1,
        10,
        'Can I get an update on my child’s performance?',
        2,
        NOW(),
        0,
        0
    ),
    (
        4,
        11,
        'Is there anything I need to do to help my child improve?',
        3,
        NOW(),
        0,
        0
    ),
    (
        3,
        12,
        'Can I speak with the teacher about my child’s project?',
        4,
        NOW(),
        0,
        0
    ),
    (
        7,
        13,
        'Can I expect any homework assignments this week?',
        5,
        NOW(),
        0,
        0
    ),
    (
        2,
        9,
        'Can you send me the syllabus for the upcoming semester?',
        1,
        NOW(),
        0,
        0
    ),
    (
        7,
        10,
        'When will the next parent meeting take place?',
        2,
        NOW(),
        0,
        0
    ),
    (
        1,
        11,
        'Is there any feedback on my child’s social interactions?',
        3,
        NOW(),
        0,
        0
    ),
    (
        4,
        12,
        'I would like more information about the field trip next month.',
        4,
        NOW(),
        0,
        0
    ),
    (
        6,
        13,
        'I would like to confirm if my child is on track with the curriculum.',
        5,
        NOW(),
        0,
        0
    ),
    (
        5,
        9,
        'Could you explain the results of my child’s recent test?',
        1,
        NOW(),
        0,
        0
    ),
    (
        3,
        10,
        'Can we schedule a time to talk about my child’s progress?',
        2,
        NOW(),
        0,
        0
    ),
    (
        2,
        11,
        'Can you let me know about the extracurricular activities planned for next week?',
        3,
        NOW(),
        0,
        0
    ),
    (
        6,
        12,
        'When will the teacher be available for a meeting?',
        4,
        NOW(),
        0,
        0
    ),
    (
        1,
        13,
        'Can you provide me with my child’s attendance record?',
        5,
        NOW(),
        0,
        0
    ),
    (
        4,
        9,
        'How can I help my child with the upcoming group project?',
        1,
        NOW(),
        0,
        0
    ),
    (
        5,
        10,
        'Can we discuss the behavior issues I’ve noticed recently?',
        2,
        NOW(),
        0,
        0
    ),
    (
        7,
        11,
        'Could you provide an update on my child’s progress?',
        3,
        NOW(),
        0,
        0
    ),
    (
        3,
        12,
        'When is the next science experiment scheduled?',
        4,
        NOW(),
        0,
        0
    ),
    (
        6,
        13,
        'Can I get feedback on my child’s recent participation?',
        5,
        NOW(),
        0,
        0
    ),
    (
        1,
        9,
        'Could we talk about the recent test results?',
        1,
        NOW(),
        0,
        0
    ),
    (
        6,
        10,
        'I have a question about the new curriculum.',
        2,
        NOW(),
        0,
        0
    ),
    (
        4,
        11,
        'Is there anything I need to do regarding my child’s health?',
        3,
        NOW(),
        0,
        0
    ),
    (
        2,
        12,
        'Can we arrange a time to meet next week?',
        4,
        NOW(),
        0,
        0
    ),
    (
        5,
        13,
        'Is my child expected to bring anything for the next class?',
        5,
        NOW(),
        0,
        0
    ),
    (
        3,
        9,
        'Can you send me a summary of today’s lesson?',
        1,
        NOW(),
        0,
        0
    ),
    (
        1,
        10,
        'Could you let me know the schedule for next week’s activities?',
        2,
        NOW(),
        0,
        0
    ),
    (
        7,
        11,
        'Is there anything I can do to support my child’s learning at home?',
        3,
        NOW(),
        0,
        0
    ),
    (
        2,
        12,
        'What’s the homework for the weekend?',
        4,
        NOW(),
        0,
        0
    ),
    (
        4,
        13,
        'How is my child performing in the subject?',
        5,
        NOW(),
        0,
        0
    );

CREATE TABLE Event (
    EventID INT NOT NULL AUTO_INCREMENT,
    EventName VARCHAR(30) NOT NULL,
    Date DATE NOT NULL,
    TeacherID INT NOT NULL,
    Description TEXT NOT NULL,
    Image BLOB NOT NULL,
    BlogID INT,
    ImageType VARCHAR(255) NOT NULL,
    PRIMARY KEY (EventID),
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE ArchivedEvent (
    EventID INT NOT NULL,
    EventName VARCHAR(30) NOT NULL,
    Date DATE NOT NULL,
    TeacherID INT NOT NULL,
    Description TEXT NOT NULL,
    Image BLOB NOT NULL,
    BlogID INT,
    ImageType VARCHAR(255) NOT NULL,
    PRIMARY KEY (EventID)
);

-- Insert past events into ArchivedEvent
CREATE PROCEDURE ArchivePastEvents()
BEGIN
    -- Move past events to ArchivedEvent
    INSERT INTO ArchivedEvent (EventID, EventName, Date, TeacherID, Description, Image, BlogID, ImageType)
    SELECT EventID, EventName, Date, TeacherID, Description, Image, BlogID, ImageType
    FROM Event
    WHERE Date < CURDATE();

    -- Delete past events from Event table
    DELETE FROM Event
    WHERE Date < CURDATE();
END

DROP TABLE Event;

DROP TABLE eventenrollment;

CREATE TABLE Eventenrollment (
    EnrollmentID INT NOT NULL AUTO_INCREMENT,
    EventID INT NOT NULL,
    ChildID INT NOT NULL,
    Reason VARCHAR(20),
    Review VARCHAR(100),
    Rating INT DEFAULT NULL,
    PRIMARY KEY (EnrollmentID),
    FOREIGN KEY (EventID) REFERENCES Event (EventID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    Event (
        EventName,
        Date,
        TeacherID,
        Description,
        Image,
        BlogID
    )
VALUES (
        'Art Workshop',
        '2024-12-15',
        1,
        'Learn painting skills.',
        'BLOB data here',
        NULL
    ),
    (
        'Science Fair',
        '2023-05-20',
        2,
        'Explore innovations.',
        'BLOB data here',
        1
    ),
    (
        'Music Fest',
        '2025-06-10',
        1,
        'Enjoy live music.',
        'BLOB data here',
        NULL
    ),
    (
        'Sports Day',
        '2023-08-05',
        2,
        'Participate in sports.',
        'BLOB data here',
        2
    ),
    (
        'Coding Camp',
        '2023-11-01',
        1,
        'Intro to programming.',
        'BLOB data here',
        NULL
    ),
    (
        'Drama Workshop',
        '2024-03-15',
        2,
        'Acting skills training.',
        'BLOB data here',
        NULL
    ),
    (
        'Math Olympiad',
        '2023-09-10',
        1,
        'Challenge your math skills.',
        'BLOB data here',
        3
    ),
    (
        'History Seminar',
        '2025-01-20',
        2,
        'Learn about history.',
        'BLOB data here',
        NULL
    ),
    (
        'Robotics Fair',
        '2024-07-25',
        1,
        'Explore robotics.',
        'BLOB data here',
        4
    ),
    (
        'Chess Tournament',
        '2023-10-12',
        2,
        'Competitive chess.',
        'BLOB data here',
        NULL
    );

INSERT INTO
    EventEnrollment (
        EventID,
        ChildID,
        Reason,
        Review,
        Rating
    )
VALUES (
        1,
        1,
        'Interested in art.',
        'Amazing workshop!',
        5
    ),
    (
        1,
        2,
        'Loves painting.',
        'Good experience.',
        4
    ),
    (
        2,
        3,
        'Curious about science.',
        'Informative event.',
        5
    ),
    (
        2,
        4,
        'Loves experiments.',
        'Great event for kids.',
        4
    ),
    (
        3,
        1,
        'Loves music.',
        'Incredible!',
        5
    ),
    (
        3,
        5,
        'Interested in live music.',
        'Enjoyable concert.',
        4
    ),
    (
        4,
        2,
        'Sports enthusiast.',
        'Well-organized.',
        4
    ),
    (
        4,
        3,
        'Participates in sports.',
        'Fun and engaging.',
        5
    ),
    (
        5,
        4,
        'Interested in coding.',
        'Great experience.',
        5
    ),
    (
        5,
        5,
        'Wants to learn coding.',
        'Very informative.',
        4
    ),
    (
        6,
        1,
        'Passionate about acting.',
        'Loved it!',
        5
    ),
    (
        6,
        2,
        'Interested in drama.',
        'Good workshop.',
        4
    ),
    (
        7,
        3,
        'Math lover.',
        'Challenging and fun.',
        5
    ),
    (
        7,
        4,
        'Competes in math.',
        'Very well-organized.',
        4
    ),
    (
        8,
        5,
        'Enjoys history.',
        'Insightful seminar.',
        4
    ),
    (
        8,
        1,
        'Loves historical topics.',
        'Highly educational.',
        5
    ),
    (
        9,
        2,
        'Interested in robotics.',
        'Super informative.',
        5
    ),
    (
        9,
        3,
        'Likes robotics.',
        'Great for beginners.',
        4
    ),
    (
        10,
        4,
        'Chess lover.',
        'Very competitive.',
        5
    ),
    (
        10,
        5,
        'Wants to improve skills.',
        'Great atmosphere.',
        4
    );

CREATE TABLE Payment (
    PaymentID INT NOT NULL AUTO_INCREMENT,
    DateTime DATETIME NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    PayerID INT NOT NULL,
    Mode ENUM(
        'Cash',
        'Bank Transfer',
        'Credit Card'
    ) NOT NULL DEFAULT 'Cash',
    PRIMARY KEY (PaymentID),
    CHECK (Amount > 0),
    FOREIGN KEY (PayerID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE Refund (
    RefundID INT NOT NULL AUTO_INCREMENT,
    PaymentID INT NOT NULL,
    Reason VARCHAR(100) NOT NULL,
    Mode ENUM(
        'Cash',
        'Bank Transfer',
        'Credit Card'
    ) NOT NULL DEFAULT 'Cash',
    PRIMARY KEY (RefundID),
    FOREIGN KEY (PaymentID) REFERENCES Payment (PaymentID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    Payment (
        DateTime,
        Amount,
        PayerID,
        Mode
    )
VALUES (NOW(), 150.00, 1, 'Cash'),
    (
        NOW(),
        200.50,
        1,
        'Bank Transfer'
    ),
    (
        NOW(),
        300.00,
        1,
        'Credit Card'
    ),
    (NOW(), 120.75, 1, 'Cash'),
    (
        NOW(),
        250.00,
        1,
        'Bank Transfer'
    ),
    (
        NOW(),
        180.00,
        1,
        'Credit Card'
    ),
    (NOW(), 220.25, 1, 'Cash'),
    (
        NOW(),
        170.50,
        1,
        'Bank Transfer'
    ),
    (
        NOW(),
        210.00,
        1,
        'Credit Card'
    ),
    (NOW(), 130.00, 1, 'Cash');

INSERT INTO
    Refund (PaymentID, Reason, Mode)
VALUES (
        1,
        'Overcharged amount',
        'Cash'
    ),
    (
        2,
        'Payment error',
        'Bank Transfer'
    ),
    (
        3,
        'Disputed transaction',
        'Credit Card'
    ),
    (
        4,
        'Incorrect payment mode',
        'Cash'
    ),
    (
        5,
        'Refund due to mistake',
        'Bank Transfer'
    ),
    (
        6,
        'Refund requested by customer',
        'Credit Card'
    ),
    (7, 'Payment canceled', 'Cash'),
    (
        8,
        'Service not rendered',
        'Bank Transfer'
    ),
    (
        9,
        'Duplicate payment',
        'Credit Card'
    ),
    (10, 'Billing issue', 'Cash');

CREATE TABLE SalaryPayment (
    PaymentID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    Salary DECIMAL(10, 2) NOT NULL,
    Date DATE NOT NULL,
    Bonus DECIMAL(10, 2) DEFAULT 0,
    Deductions DECIMAL(10, 2) DEFAULT 0,
    Mode ENUM('Cash', 'Bank Transfer') NOT NULL DEFAULT 'Cash',
    PRIMARY KEY (PaymentID),
    CHECK (
        (Salary + Bonus - Deductions) >= 0
    ),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Inserting rows for UserID from 14 to 24

INSERT INTO
    SalaryPayment (
        UserID,
        Salary,
        Date,
        Bonus,
        Deductions,
        Mode
    )
VALUES (
        14,
        3000.00,
        '2025-01-01',
        200.00,
        50.00,
        'Bank Transfer'
    ),
    (
        15,
        3500.00,
        '2025-01-01',
        300.00,
        100.00,
        'Credit Card'
    ),
    (
        16,
        2800.00,
        '2025-01-01',
        150.00,
        30.00,
        'Cash'
    ),
    (
        17,
        3200.00,
        '2025-01-01',
        250.00,
        70.00,
        'Bank Transfer'
    ),
    (
        18,
        4000.00,
        '2025-01-01',
        400.00,
        200.00,
        'Credit Card'
    ),
    (
        19,
        4500.00,
        '2025-01-01',
        500.00,
        150.00,
        'Cash'
    ),
    (
        20,
        3300.00,
        '2025-01-01',
        100.00,
        50.00,
        'Bank Transfer'
    ),
    (
        21,
        3700.00,
        '2025-01-01',
        350.00,
        200.00,
        'Credit Card'
    ),
    (
        22,
        3100.00,
        '2025-01-01',
        200.00,
        80.00,
        'Cash'
    ),
    (
        23,
        3400.00,
        '2025-01-01',
        300.00,
        90.00,
        'Bank Transfer'
    ),
    (
        24,
        3800.00,
        '2025-01-01',
        400.00,
        150.00,
        'Credit Card'
    );

CREATE TABLE Media (
    MediaID INT NOT NULL AUTO_INCREMENT,
    MediaType ENUM('Video', 'Book', 'Image') NOT NULL,
    Title VARCHAR(200) NOT NULL,
    Description TEXT,
    URL VARCHAR(200),
    AgeGroup ENUM(
        '2-3',
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15'
    ) NOT NULL DEFAULT '2-3',
    Image BLOB,
    DateTime DATE NOT NULL,
    UserID INT NOT NULL,
    PRIMARY KEY (MediaID),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE media
ADD COLUMN AgeGroup ENUM(
    '2-3',
    '4-5',
    '6-7',
    '8-9',
    '10-11',
    '12-13',
    '14-15'
) NOT NULL DEFAULT '2-3';

CREATE PROCEDURE AlterAndRandomizeDate()
BEGIN
    ALTER TABLE media
    CHANGE COLUMN Date DateTime DATETIME;
    UPDATE media
    SET DateTime = DATE_ADD('2020-01-01', INTERVAL FLOOR(RAND() * 1826) DAY);
END

INSERT INTO
    media (
        MediaID,
        MediaType,
        Title,
        Description,
        URL,
        Date,
        UserID,
        Size,
        Format,
        Views,
        Downloads
    )
VALUES (
        1,
        'Video',
        'Bleach - E10.mkv',
        'Dummy description for Bleach - E10',
        'http://localhost/MVC/Public/Funzone/Bleach_E10.mkv',
        '2025-01-29',
        1,
        500,
        'MKV',
        0,
        0
    ),
    (
        2,
        'Video',
        'Bleach - E11.mkv',
        'Dummy description for Bleach - E11',
        'http://localhost/MVC/Public/Funzone/Bleach_E11.mkv',
        '2025-01-29',
        1,
        550,
        'MKV',
        0,
        0
    ),
    (
        3,
        'Video',
        'Bleach - E12.mkv',
        'Dummy description for Bleach - E12',
        'http://localhost/MVC/Public/Funzone/Bleach_E12.mkv',
        '2025-01-29',
        1,
        600,
        'MKV',
        0,
        0
    ),
    (
        4,
        'Video',
        'Bleach - E13.mkv',
        'Dummy description for Bleach - E13',
        'http://localhost/MVC/Public/Funzone/Bleach_E13.mkv',
        '2025-01-29',
        1,
        620,
        'MKV',
        0,
        0
    ),
    (
        5,
        'Video',
        'Bleach - E14.mkv',
        'Dummy description for Bleach - E14',
        'http://localhost/MVC/Public/Funzone/Bleach_E14.mkv',
        '2025-01-29',
        1,
        590,
        'MKV',
        0,
        0
    ),
    (
        6,
        'Video',
        'Bleach - E15.mkv',
        'Dummy description for Bleach - E15',
        'http://localhost/MVC/Public/Funzone/Bleach_E15.mkv',
        '2025-01-29',
        1,
        610,
        'MKV',
        0,
        0
    ),
    (
        7,
        'Video',
        'Bleach - E16.mkv',
        'Dummy description for Bleach - E16',
        'http://localhost/MVC/Public/Funzone/Bleach_E16.mkv',
        '2025-01-29',
        1,
        530,
        'MKV',
        0,
        0
    ),
    (
        8,
        'Video',
        'Bleach - E17.mkv',
        'Dummy description for Bleach - E17',
        'http://localhost/MVC/Public/Funzone/Bleach_E17.mkv',
        '2025-01-29',
        1,
        575,
        'MKV',
        0,
        0
    ),
    (
        9,
        'Video',
        'Bleach - E18.mkv',
        'Dummy description for Bleach - E18',
        'http://localhost/MVC/Public/Funzone/Bleach_E18.mkv',
        '2025-01-29',
        1,
        590,
        'MKV',
        0,
        0
    ),
    (
        10,
        'Video',
        'Bleach - E19.mkv',
        'Dummy description for Bleach - E19',
        'http://localhost/MVC/Public/Funzone/Bleach_E19.mkv',
        '2025-01-29',
        1,
        600,
        'MKV',
        0,
        0
    ),
    (
        11,
        'Video',
        'Bleach - E20.mkv',
        'Dummy description for Bleach - E20',
        'http://localhost/MVC/Public/Funzone/Bleach_E20.mkv',
        '2025-01-29',
        1,
        550,
        'MKV',
        0,
        0
    ),
    (
        12,
        'Video',
        'Bleach - E21.mkv',
        'Dummy description for Bleach - E21',
        'http://localhost/MVC/Public/Funzone/Bleach_E21.mkv',
        '2025-01-29',
        1,
        580,
        'MKV',
        0,
        0
    ),
    (
        13,
        'Video',
        'Bleach - E22.mkv',
        'Dummy description for Bleach - E22',
        'http://localhost/MVC/Public/Funzone/Bleach_E22.mkv',
        '2025-01-29',
        1,
        605,
        'MKV',
        0,
        0
    ),
    (
        14,
        'Video',
        'Bleach - E23.mkv',
        'Dummy description for Bleach - E23',
        'http://localhost/MVC/Public/Funzone/Bleach_E23.mkv',
        '2025-01-29',
        1,
        590,
        'MKV',
        0,
        0
    ),
    (
        15,
        'Video',
        'Bleach - E24.mkv',
        'Dummy description for Bleach - E24',
        'http://localhost/MVC/Public/Funzone/Bleach_E24.mkv',
        '2025-01-29',
        1,
        560,
        'MKV',
        0,
        0
    ),
    (
        16,
        'Video',
        'Bleach - E25.mkv',
        'Dummy description for Bleach - E25',
        'http://localhost/MVC/Public/Funzone/Bleach_E25.mkv',
        '2025-01-29',
        1,
        615,
        'MKV',
        0,
        0
    ),
    (
        17,
        'Video',
        'Bleach - E26.mkv',
        'Dummy description for Bleach - E26',
        'http://localhost/MVC/Public/Funzone/Bleach_E26.mkv',
        '2025-01-29',
        1,
        580,
        'MKV',
        0,
        0
    ),
    (
        18,
        'Video',
        'Bleach - E27.mkv',
        'Dummy description for Bleach - E27',
        'http://localhost/MVC/Public/Funzone/Bleach_E27.mkv',
        '2025-01-29',
        1,
        600,
        'MKV',
        0,
        0
    ),
    (
        19,
        'Video',
        'Bleach - E28.mkv',
        'Dummy description for Bleach - E28',
        'http://localhost/MVC/Public/Funzone/Bleach_E28.mkv',
        '2025-01-29',
        1,
        590,
        'MKV',
        0,
        0
    ),
    (
        20,
        'Video',
        'Bleach - E29.mkv',
        'Dummy description for Bleach - E29',
        'http://localhost/MVC/Public/Funzone/Bleach_E29.mkv',
        '2025-01-29',
        1,
        580,
        'MKV',
        0,
        0
    ),
    (
        21,
        'Video',
        'Bleach - E30.mkv',
        'Dummy description for Bleach - E30',
        'http://localhost/MVC/Public/Funzone/Bleach_E30.mkv',
        '2025-01-29',
        1,
        575,
        'MKV',
        0,
        0
    ),
    (
        22,
        'Video',
        'Bleach - E31.mkv',
        'Dummy description for Bleach - E31',
        'http://localhost/MVC/Public/Funzone/Bleach_E31.mkv',
        '2025-01-29',
        1,
        620,
        'MKV',
        0,
        0
    ),
    (
        23,
        'Video',
        'Bleach - E32.mkv',
        'Dummy description for Bleach - E32',
        'http://localhost/MVC/Public/Funzone/Bleach_E32.mkv',
        '2025-01-29',
        1,
        595,
        'MKV',
        0,
        0
    ),
    (
        24,
        'Video',
        'Bleach - E33.mkv',
        'Dummy description for Bleach - E33',
        'http://localhost/MVC/Public/Funzone/Bleach_E33.mkv',
        '2025-01-29',
        1,
        610,
        'MKV',
        0,
        0
    ),
    (
        25,
        'Video',
        'Bleach - E34.mkv',
        'Dummy description for Bleach - E34',
        'http://localhost/MVC/Public/Funzone/Bleach_E34.mkv',
        '2025-01-29',
        1,
        600,
        'MKV',
        0,
        0
    ),
    (
        26,
        'Video',
        'Bleach - E35.mkv',
        'Dummy description for Bleach - E35',
        'http://localhost/MVC/Public/Funzone/Bleach_E35.mkv',
        '2025-01-29',
        1,
        570,
        'MKV',
        0,
        0
    ),
    (
        27,
        'Video',
        'Bleach - E36.mkv',
        'Dummy description for Bleach - E36',
        'http://localhost/MVC/Public/Funzone/Bleach_E36.mkv',
        '2025-01-29',
        1,
        610,
        'MKV',
        0,
        0
    ),
    (
        28,
        'Video',
        'Bleach - E37.mkv',
        'Dummy description for Bleach - E37',
        'http://localhost/MVC/Public/Funzone/Bleach_E37.mkv',
        '2025-01-29',
        1,
        580,
        'MKV',
        0,
        0
    ),
    (
        29,
        'Video',
        'Bleach - E08.mkv',
        'Dummy description for Bleach - E08',
        'http://localhost/MVC/Public/Funzone/Bleach_E08.mkv',
        '2025-01-29',
        1,
        605,
        'MKV',
        0,
        0
    ),
    (
        30,
        'Video',
        'Bleach - E09.mkv',
        'Dummy description for Bleach - E09',
        'http://localhost/MVC/Public/Funzone/Bleach_E09.mkv',
        '2025-01-29',
        1,
        590,
        'MKV',
        0,
        0
    );

INSERT INTO
    media (
        MediaID,
        MediaType,
        Title,
        Description,
        URL,
        Date,
        UserID,
        Size,
        Format,
        Views,
        Downloads
    )
VALUES (
        31,
        'Audio',
        'Track - 1.mp3',
        'Dummy description for Track 1',
        'http://localhost/MVC/Public/Funzone/1.mp3',
        '2025-01-29',
        2,
        3200,
        'MP3',
        0,
        0
    ),
    (
        32,
        'Audio',
        'Track - 2.mp3',
        'Dummy description for Track 2',
        'http://localhost/MVC/Public/Funzone/2.mp3',
        '2025-01-29',
        2,
        3100,
        'MP3',
        0,
        0
    ),
    (
        33,
        'Audio',
        'Track - 3.mp3',
        'Dummy description for Track 3',
        'http://localhost/MVC/Public/Funzone/3.mp3',
        '2025-01-29',
        2,
        3000,
        'MP3',
        0,
        0
    ),
    (
        34,
        'Audio',
        'Track - 4.mp3',
        'Dummy description for Track 4',
        'http://localhost/MVC/Public/Funzone/4.mp3',
        '2025-01-29',
        2,
        2950,
        'MP3',
        0,
        0
    ),
    (
        35,
        'Audio',
        'Track - 5.mp3',
        'Dummy description for Track 5',
        'http://localhost/MVC/Public/Funzone/5.mp3',
        '2025-01-29',
        2,
        3100,
        'MP3',
        0,
        0
    ),
    (
        36,
        'Audio',
        'Track - 6.mp3',
        'Dummy description for Track 6',
        'http://localhost/MVC/Public/Funzone/6.mp3',
        '2025-01-29',
        2,
        3150,
        'MP3',
        0,
        0
    ),
    (
        37,
        'Audio',
        'Track - 7.mp3',
        'Dummy description for Track 7',
        'http://localhost/MVC/Public/Funzone/7.mp3',
        '2025-01-29',
        2,
        2900,
        'MP3',
        0,
        0
    ),
    (
        38,
        'Audio',
        'Track - 8.mp3',
        'Dummy description for Track 8',
        'http://localhost/MVC/Public/Funzone/8.mp3',
        '2025-01-29',
        2,
        3050,
        'MP3',
        0,
        0
    ),
    (
        39,
        'Audio',
        'Track - 9.mp3',
        'Dummy description for Track 9',
        'http://localhost/MVC/Public/Funzone/9.mp3',
        '2025-01-29',
        2,
        3000,
        'MP3',
        0,
        0
    ),
    (
        40,
        'Audio',
        'Track - 10.mp3',
        'Dummy description for Track 10',
        'http://localhost/MVC/Public/Funzone/10.mp3',
        '2025-01-29',
        2,
        3150,
        'MP3',
        0,
        0
    ),
    (
        41,
        'Audio',
        'Track - 11.mp3',
        'Dummy description for Track 11',
        'http://localhost/MVC/Public/Funzone/11.mp3',
        '2025-01-29',
        2,
        3200,
        'MP3',
        0,
        0
    ),
    (
        42,
        'Audio',
        'Track - 12.mp3',
        'Dummy description for Track 12',
        'http://localhost/MVC/Public/Funzone/12.mp3',
        '2025-01-29',
        2,
        3100,
        'MP3',
        0,
        0
    ),
    (
        43,
        'Audio',
        'Track - 13.mp3',
        'Dummy description for Track 13',
        'http://localhost/MVC/Public/Funzone/13.mp3',
        '2025-01-29',
        2,
        3000,
        'MP3',
        0,
        0
    ),
    (
        44,
        'Audio',
        'Track - 14.mp3',
        'Dummy description for Track 14',
        'http://localhost/MVC/Public/Funzone/14.mp3',
        '2025-01-29',
        2,
        2950,
        'MP3',
        0,
        0
    ),
    (
        45,
        'Audio',
        'Track - 15.mp3',
        'Dummy description for Track 15',
        'http://localhost/MVC/Public/Funzone/15.mp3',
        '2025-01-29',
        2,
        3100,
        'MP3',
        0,
        0
    ),
    (
        46,
        'Audio',
        'Track - 16.mp3',
        'Dummy description for Track 16',
        'http://localhost/MVC/Public/Funzone/16.mp3',
        '2025-01-29',
        2,
        3150,
        'MP3',
        0,
        0
    ),
    (
        47,
        'Audio',
        'Track - 17.mp3',
        'Dummy description for Track 17',
        'http://localhost/MVC/Public/Funzone/17.mp3',
        '2025-01-29',
        2,
        2900,
        'MP3',
        0,
        0
    ),
    (
        48,
        'Audio',
        'Track - 18.mp3',
        'Dummy description for Track 18',
        'http://localhost/MVC/Public/Funzone/18.mp3',
        '2025-01-29',
        2,
        3050,
        'MP3',
        0,
        0
    ),
    (
        49,
        'Audio',
        'Track - 19.mp3',
        'Dummy description for Track 19',
        'http://localhost/MVC/Public/Funzone/19.mp3',
        '2025-01-29',
        2,
        3000,
        'MP3',
        0,
        0
    ),
    (
        50,
        'Audio',
        'Track - 20.mp3',
        'Dummy description for Track 20',
        'http://localhost/MVC/Public/Funzone/20.mp3',
        '2025-01-29',
        2,
        3150,
        'MP3',
        0,
        0
    );

INSERT INTO
    media (
        MediaID,
        MediaType,
        Title,
        Description,
        URL,
        Date,
        UserID,
        Size,
        Format,
        Views,
        Downloads
    )
VALUES (
        51,
        'Book',
        'L1.pdf',
        'Dummy description for L1',
        'http://localhost/MVC/Public/Funzone/L1.pdf',
        '2025-01-29',
        2,
        500,
        'PDF',
        0,
        0
    ),
    (
        52,
        'Book',
        'L2.pdf',
        'Dummy description for L2',
        'http://localhost/MVC/Public/Funzone/L2.pdf',
        '2025-01-29',
        2,
        600,
        'PDF',
        0,
        0
    ),
    (
        53,
        'Book',
        'L3.pdf',
        'Dummy description for L3',
        'http://localhost/MVC/Public/Funzone/L3.pdf',
        '2025-01-29',
        2,
        550,
        'PDF',
        0,
        0
    ),
    (
        54,
        'Book',
        'L4.pdf',
        'Dummy description for L4',
        'http://localhost/MVC/Public/Funzone/L4.pdf',
        '2025-01-29',
        2,
        700,
        'PDF',
        0,
        0
    ),
    (
        55,
        'Book',
        'L5.pdf',
        'Dummy description for L5',
        'http://localhost/MVC/Public/Funzone/L5.pdf',
        '2025-01-29',
        2,
        750,
        'PDF',
        0,
        0
    ),
    (
        56,
        'Book',
        'L6.pdf',
        'Dummy description for L6',
        'http://localhost/MVC/Public/Funzone/L6.pdf',
        '2025-01-29',
        2,
        650,
        'PDF',
        0,
        0
    ),
    (
        57,
        'Book',
        'L7.pdf',
        'Dummy description for L7',
        'http://localhost/MVC/Public/Funzone/L7.pdf',
        '2025-01-29',
        2,
        800,
        'PDF',
        0,
        0
    ),
    (
        58,
        'Book',
        'L8.pdf',
        'Dummy description for L8',
        'http://localhost/MVC/Public/Funzone/L8.pdf',
        '2025-01-29',
        2,
        680,
        'PDF',
        0,
        0
    ),
    (
        59,
        'Book',
        'L9.pdf',
        'Dummy description for L9',
        'http://localhost/MVC/Public/Funzone/L9.pdf',
        '2025-01-29',
        2,
        720,
        'PDF',
        0,
        0
    ),
    (
        60,
        'Book',
        'L10.pdf',
        'Dummy description for L10',
        'http://localhost/MVC/Public/Funzone/L10.pdf',
        '2025-01-29',
        2,
        770,
        'PDF',
        0,
        0
    );

INSERT INTO
    media (
        MediaID,
        MediaType,
        Title,
        Description,
        URL,
        Date,
        UserID,
        Size,
        Format,
        Views,
        Downloads
    )
VALUES (
        61,
        'Image',
        'p1.jpg',
        'Dummy description for p1',
        'http://localhost/MVC/Public/Funzone/p1.jpg',
        '2025-01-29',
        2,
        1200,
        'JPG',
        0,
        0
    ),
    (
        62,
        'Image',
        'p2.jpg',
        'Dummy description for p2',
        'http://localhost/MVC/Public/Funzone/p2.jpg',
        '2025-01-29',
        2,
        1300,
        'JPG',
        0,
        0
    ),
    (
        63,
        'Image',
        'p3.jpg',
        'Dummy description for p3',
        'http://localhost/MVC/Public/Funzone/p3.jpg',
        '2025-01-29',
        2,
        1100,
        'JPG',
        0,
        0
    ),
    (
        64,
        'Image',
        'p4.jpg',
        'Dummy description for p4',
        'http://localhost/MVC/Public/Funzone/p4.jpg',
        '2025-01-29',
        2,
        1400,
        'JPG',
        0,
        0
    ),
    (
        65,
        'Image',
        'p5.jpg',
        'Dummy description for p5',
        'http://localhost/MVC/Public/Funzone/p5.jpg',
        '2025-01-29',
        2,
        1500,
        'JPG',
        0,
        0
    ),
    (
        66,
        'Image',
        'p6.jpg',
        'Dummy description for p6',
        'http://localhost/MVC/Public/Funzone/p6.jpg',
        '2025-01-29',
        2,
        1350,
        'JPG',
        0,
        0
    ),
    (
        67,
        'Image',
        'p7.jpg',
        'Dummy description for p7',
        'http://localhost/MVC/Public/Funzone/p7.jpg',
        '2025-01-29',
        2,
        1450,
        'JPG',
        0,
        0
    ),
    (
        68,
        'Image',
        'p8.jpg',
        'Dummy description for p8',
        'http://localhost/MVC/Public/Funzone/p8.jpg',
        '2025-01-29',
        2,
        1550,
        'JPG',
        0,
        0
    ),
    (
        69,
        'Image',
        'p9.jpg',
        'Dummy description for p9',
        'http://localhost/MVC/Public/Funzone/p9.jpg',
        '2025-01-29',
        2,
        1250,
        'JPG',
        0,
        0
    ),
    (
        70,
        'Image',
        'p10.jpg',
        'Dummy description for p10',
        'http://localhost/MVC/Public/Funzone/p10.jpg',
        '2025-01-29',
        2,
        1300,
        'JPG',
        0,
        0
    ),
    (
        71,
        'Image',
        'p11.jpg',
        'Dummy description for p11',
        'http://localhost/MVC/Public/Funzone/p11.jpg',
        '2025-01-29',
        2,
        1200,
        'JPG',
        0,
        0
    ),
    (
        72,
        'Image',
        'p12.jpg',
        'Dummy description for p12',
        'http://localhost/MVC/Public/Funzone/p12.jpg',
        '2025-01-29',
        2,
        1350,
        'JPG',
        0,
        0
    ),
    (
        73,
        'Image',
        'p13.jpg',
        'Dummy description for p13',
        'http://localhost/MVC/Public/Funzone/p13.jpg',
        '2025-01-29',
        2,
        1400,
        'JPG',
        0,
        0
    ),
    (
        74,
        'Image',
        'p14.jpg',
        'Dummy description for p14',
        'http://localhost/MVC/Public/Funzone/p14.jpg',
        '2025-01-29',
        2,
        1450,
        'JPG',
        0,
        0
    ),
    (
        75,
        'Image',
        'p15.jpg',
        'Dummy description for p15',
        'http://localhost/MVC/Public/Funzone/p15.jpg',
        '2025-01-29',
        2,
        1500,
        'JPG',
        0,
        0
    ),
    (
        76,
        'Image',
        'p16.jpg',
        'Dummy description for p16',
        'http://localhost/MVC/Public/Funzone/p16.jpg',
        '2025-01-29',
        2,
        1550,
        'JPG',
        0,
        0
    ),
    (
        77,
        'Image',
        'p17.jpg',
        'Dummy description for p17',
        'http://localhost/MVC/Public/Funzone/p17.jpg',
        '2025-01-29',
        2,
        1600,
        'JPG',
        0,
        0
    ),
    (
        78,
        'Image',
        'p18.jpg',
        'Dummy description for p18',
        'http://localhost/MVC/Public/Funzone/p18.jpg',
        '2025-01-29',
        2,
        1300,
        'JPG',
        0,
        0
    ),
    (
        79,
        'Image',
        'p19.jpg',
        'Dummy description for p19',
        'http://localhost/MVC/Public/Funzone/p19.jpg',
        '2025-01-29',
        2,
        1250,
        'JPG',
        0,
        0
    ),
    (
        80,
        'Image',
        'p20.jpg',
        'Dummy description for p20',
        'http://localhost/MVC/Public/Funzone/p20.jpg',
        '2025-01-29',
        2,
        1350,
        'JPG',
        0,
        0
    );

INSERT INTO
    media (
        MediaID,
        MediaType,
        Title,
        Description,
        URL,
        DateTime,
        UserID,
        Size,
        Format,
        Views,
        Downloads
    )
VALUES (
        81,
        'Image',
        'p1.jpg',
        'Dummy description for p1',
        'http://localhost/MVC/Public/Funzone/p1.jpg',
        '2025-01-29',
        2,
        1200,
        'JPG',
        0,
        0
    ),
    (
        82,
        'Image',
        'p2.jpg',
        'Dummy description for p2',
        'http://localhost/MVC/Public/Funzone/p2.jpg',
        '2025-01-29',
        2,
        1300,
        'JPG',
        0,
        0
    ),
    (
        83,
        'Image',
        'p3.jpg',
        'Dummy description for p3',
        'http://localhost/MVC/Public/Funzone/p3.jpg',
        '2025-01-29',
        2,
        1100,
        'JPG',
        0,
        0
    ),
    (
        84,
        'Book',
        'L4.pdf',
        'Dummy description for L4',
        'http://localhost/MVC/Public/Funzone/L4.pdf',
        '2025-01-29',
        2,
        700,
        'PDF',
        0,
        0
    ),
    (
        85,
        'Book',
        'L5.pdf',
        'Dummy description for L5',
        'http://localhost/MVC/Public/Funzone/L5.pdf',
        '2025-01-29',
        2,
        750,
        'PDF',
        0,
        0
    ),
    (
        86,
        'Book',
        'L6.pdf',
        'Dummy description for L6',
        'http://localhost/MVC/Public/Funzone/L6.pdf',
        '2025-01-29',
        2,
        650,
        'PDF',
        0,
        0
    ),
    (
        87,
        'Audio',
        'Track - 17.mp3',
        'Dummy description for Track 17',
        'http://localhost/MVC/Public/Funzone/17.mp3',
        '2025-01-29',
        2,
        2900,
        'MP3',
        0,
        0
    ),
    (
        88,
        'Audio',
        'Track - 18.mp3',
        'Dummy description for Track 18',
        'http://localhost/MVC/Public/Funzone/18.mp3',
        '2025-01-29',
        2,
        3050,
        'MP3',
        0,
        0
    ),
    (
        89,
        'Audio',
        'Track - 19.mp3',
        'Dummy description for Track 19',
        'http://localhost/MVC/Public/Funzone/19.mp3',
        '2025-01-29',
        2,
        3000,
        'MP3',
        0,
        0
    ),
    (
        90,
        'Audio',
        'Track - 20.mp3',
        'Dummy description for Track 20',
        'http://localhost/MVC/Public/Funzone/20.mp3',
        '2025-01-29',
        2,
        3150,
        'MP3',
        0,
        0
    );

CREATE PROCEDURE UpdateDownloadsRandomNumbers()
BEGIN
    UPDATE Media
    SET Downloads = FLOOR(RAND() * 1000) + 1;  -- Random numbers between 1 and 1000
END

CREATE PROCEDURE UpdateviewsRandomNumbers()
BEGIN
    UPDATE Media
    SET Views = FLOOR(RAND() * 1000) + 1;  -- Random numbers between 1 and 1000
END

CREATE TABLE MediaWhishlist (
    WishlistID INT NOT NULL AUTO_INCREMENT,
    MediaID INT NOT NULL,
    ChildID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Reminder BOOLEAN DEFAULT 0,
    PRIMARY KEY (WishlistID),
    FOREIGN KEY (MediaID) REFERENCES Media (MediaID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    MediaWhishlist (
        MediaID,
        ChildID,
        Date,
        Time,
        Reminder
    )
VALUES (
        28,
        2,
        '2025-01-09',
        '05:08:52',
        0
    ),
    (
        5,
        2,
        '2025-01-22',
        '15:49:52',
        0
    ),
    (
        29,
        2,
        '2025-01-11',
        '20:26:52',
        1
    ),
    (
        77,
        2,
        '2025-01-01',
        '03:30:52',
        0
    ),
    (
        53,
        2,
        '2025-01-21',
        '01:37:52',
        0
    ),
    (
        64,
        2,
        '2025-01-04',
        '06:34:52',
        1
    ),
    (
        80,
        3,
        '2025-01-26',
        '19:54:52',
        1
    ),
    (
        60,
        3,
        '2025-01-05',
        '13:52:52',
        1
    ),
    (
        73,
        3,
        '2025-01-21',
        '22:20:52',
        0
    ),
    (
        75,
        3,
        '2025-01-29',
        '10:58:52',
        0
    ),
    (
        7,
        3,
        '2025-01-03',
        '17:55:52',
        0
    ),
    (
        30,
        4,
        '2024-12-31',
        '11:02:52',
        0
    ),
    (
        65,
        4,
        '2025-01-01',
        '15:40:52',
        1
    ),
    (
        5,
        4,
        '2025-01-13',
        '01:39:52',
        1
    ),
    (
        21,
        4,
        '2025-01-25',
        '10:20:52',
        0
    ),
    (
        51,
        4,
        '2025-01-10',
        '17:15:52',
        0
    ),
    (
        14,
        5,
        '2025-01-19',
        '16:40:52',
        0
    ),
    (
        61,
        5,
        '2025-01-14',
        '12:35:52',
        1
    ),
    (
        45,
        5,
        '2025-01-03',
        '11:10:52',
        0
    ),
    (
        32,
        5,
        '2025-01-18',
        '14:55:52',
        1
    ),
    (
        10,
        5,
        '2025-01-08',
        '08:00:52',
        1
    ),
    (
        42,
        4,
        '2025-01-13',
        '09:45:52',
        1
    ),
    (
        33,
        4,
        '2025-01-22',
        '07:50:52',
        0
    ),
    (
        54,
        4,
        '2025-01-20',
        '13:30:52',
        1
    ),
    (
        67,
        3,
        '2025-01-05',
        '11:20:52',
        0
    ),
    (
        48,
        3,
        '2025-01-26',
        '12:10:52',
        0
    ),
    (
        39,
        3,
        '2025-01-23',
        '19:00:52',
        0
    ),
    (
        17,
        5,
        '2025-01-28',
        '16:30:52',
        1
    );

CREATE TABLE MediaHistory (
    HistoryID INT NOT NULL AUTO_INCREMENT,
    MediaID INT NOT NULL,
    ChildID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Progress INT DEFAULT 0,
    PRIMARY KEY (HistoryID),
    FOREIGN KEY (MediaID) REFERENCES Media (MediaID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    MediaHistory (
        MediaID,
        ChildID,
        DateTime,
        Progress
    )
VALUES (
        28,
        1,
        '2025-01-09 05:08:52',
        60
    ),
    (
        5,
        1,
        '2025-01-22 15:49:52',
        80
    ),
    (
        29,
        1,
        '2025-01-11 20:26:52',
        40
    ),
    (
        77,
        1,
        '2025-01-01 03:30:52',
        90
    ),
    (
        53,
        1,
        '2025-01-21 01:37:52',
        50
    ),
    (
        64,
        1,
        '2025-01-04 06:34:52',
        30
    ),
    (
        80,
        1,
        '2025-01-26 19:54:52',
        10
    ),
    (
        60,
        1,
        '2025-01-05 13:52:52',
        70
    ),
    (
        73,
        1,
        '2025-01-21 22:20:52',
        40
    ),
    (
        75,
        1,
        '2025-01-29 10:58:52',
        60
    ),
    (
        7,
        1,
        '2025-01-03 17:55:52',
        80
    ),
    (
        30,
        1,
        '2024-12-31 11:02:52',
        50
    ),
    (
        65,
        1,
        '2025-01-01 15:40:52',
        20
    ),
    (
        5,
        1,
        '2025-01-13 01:39:52',
        70
    ),
    (
        21,
        1,
        '2025-01-25 10:20:52',
        40
    ),
    (
        51,
        1,
        '2025-01-10 17:15:52',
        30
    ),
    (
        14,
        1,
        '2025-01-19 16:40:52',
        60
    ),
    (
        61,
        1,
        '2025-01-14 12:35:52',
        90
    ),
    (
        45,
        1,
        '2025-01-03 11:10:52',
        50
    ),
    (
        32,
        1,
        '2025-01-18 14:55:52',
        80
    ),
    (
        10,
        1,
        '2025-01-08 08:00:52',
        40
    ),
    (
        42,
        1,
        '2025-01-13 09:45:52',
        60
    ),
    (
        33,
        1,
        '2025-01-22 07:50:52',
        90
    ),
    (
        54,
        1,
        '2025-01-20 13:30:52',
        70
    ),
    (
        67,
        1,
        '2025-01-05 11:20:52',
        50
    ),
    (
        48,
        1,
        '2025-01-26 12:10:52',
        40
    ),
    (
        39,
        1,
        '2025-01-23 19:00:52',
        60
    ),
    (
        17,
        1,
        '2025-01-28 16:30:52',
        20
    );

CREATE TABLE Tasks (
    TaskID INT NOT NULL AUTO_INCREMENT,
    MediaID INT NOT NULL,
    TeacherID INT NOT NULL,
    Deadline DATE,
    AgeGroup ENUM(
        '2-3',
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15'
    ) NOT NULL,
    PRIMARY KEY (TaskID),
    FOREIGN KEY (MediaID) REFERENCES Media (MediaID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (TeacherID) REFERENCES Teacher (TeacherID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE TaskCompletion (
    CompletionID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    TaskID INT NOT NULL,
    Completed BOOLEAN NOT NULL DEFAULT FALSE,
    CompletionDateTime DATETIME DEFAULT NULL,
    PRIMARY KEY (CompletionID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (TaskID) REFERENCES Tasks (TaskID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE PROCEDURE AssignExistingTasks()
BEGIN
    -- Insert missing TaskCompletion entries for all existing tasks
    INSERT INTO TaskCompletion (ChildID, TaskID, Completed, CompletionDateTime)
    SELECT 
        c.ChildID, 
        t.TaskID, 
        FALSE, 
        NULL
    FROM Tasks t
    JOIN Child c ON (
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 2 AND 3 THEN '2-3'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 4 AND 5 THEN '4-5'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 6 AND 7 THEN '6-7'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 8 AND 9 THEN '8-9'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 10 AND 11 THEN '10-11'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 12 AND 13 THEN '12-13'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 14 AND 15 THEN '14-15'
            ELSE NULL
        END
    ) = t.AgeGroup
    WHERE NOT EXISTS (
        SELECT 1 
        FROM TaskCompletion tc 
        WHERE tc.ChildID = c.ChildID AND tc.TaskID = t.TaskID
    );
END

CREATE TRIGGER AfterTaskInsert
AFTER INSERT ON Tasks
FOR EACH ROW
BEGIN
    -- Insert children who belong to the task's AgeGroup
    INSERT INTO TaskCompletion (ChildID, TaskID, Completed, CompletionDateTime)
    SELECT 
        c.ChildID, 
        NEW.TaskID, 
        FALSE, 
        NULL
    FROM Child c
    WHERE (
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 2 AND 3 THEN '2-3'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 4 AND 5 THEN '4-5'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 6 AND 7 THEN '6-7'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 8 AND 9 THEN '8-9'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 10 AND 11 THEN '10-11'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 12 AND 13 THEN '12-13'
            WHEN TIMESTAMPDIFF(YEAR, c.DOB, DATE_FORMAT(NOW(), '%Y-01-01')) BETWEEN 14 AND 15 THEN '14-15'
            ELSE NULL
        END
    ) = NEW.AgeGroup;
END

INSERT INTO
    Tasks (
        MediaID,
        TeacherID,
        Deadline,
        AgeGroup
    )
VALUES (28, 2, '2025-02-27', '2-3'),
    (23, 4, '2025-02-03', '2-3'),
    (46, 1, '2025-02-21', '2-3'),
    (56, 4, '2025-02-07', '2-3'),
    (72, 5, '2025-02-14', '2-3'),
    (76, 3, '2025-02-24', '2-3'),
    (41, 4, '2025-02-19', '2-3'),
    (76, 3, '2025-02-07', '2-3'),
    (32, 4, '2025-02-05', '2-3'),
    (21, 4, '2025-02-21', '2-3'),
    (24, 5, '2025-02-25', '2-3'),
    (48, 5, '2025-02-05', '2-3'),
    (78, 5, '2025-02-18', '2-3'),
    (27, 4, '2025-02-21', '2-3'),
    (20, 3, '2025-02-26', '2-3'),
    (45, 2, '2025-02-07', '2-3'),
    (71, 4, '2025-02-25', '2-3'),
    (16, 1, '2025-02-12', '2-3'),
    (32, 4, '2025-01-30', '2-3'),
    (30, 4, '2025-02-22', '2-3'),
    (8, 5, '2025-02-05', '2-3'),
    (18, 3, '2025-02-14', '2-3'),
    (37, 2, '2025-02-10', '2-3'),
    (52, 4, '2025-02-16', '2-3'),
    (40, 1, '2025-02-05', '2-3'),
    (11, 2, '2025-02-22', '2-3'),
    (60, 3, '2025-02-01', '2-3'),
    (47, 4, '2025-02-13', '2-3');

CREATE TABLE Posts (
    PostID INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(200) NOT NULL,
    Content TEXT NOT NULL,
    DatePosted DATE NOT NULL,
    AuthorID INT NOT NULL,
    PRIMARY KEY (PostID),
    FOREIGN KEY (AuthorID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PostImages (
    ImageID INT NOT NULL AUTO_INCREMENT,
    PostID INT NOT NULL,
    Image BLOB NOT NULL,
    Caption VARCHAR(255),
    PRIMARY KEY (ImageID),
    FOREIGN KEY (PostID) REFERENCES Posts (PostID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Comments (
    CommentID INT NOT NULL AUTO_INCREMENT,
    PostID INT NOT NULL,
    UserID INT NOT NULL,
    CommentText TEXT NOT NULL,
    DateCommented DATE NOT NULL,
    PRIMARY KEY (CommentID),
    FOREIGN KEY (PostID) REFERENCES Posts (PostID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    `comments` (
        `PostID`,
        `UserID`,
        `CommentText`,
        `DateCommented`
    )
VALUES (
        1,
        1,
        'Great post! I really enjoyed reading this.',
        '2025-02-20'
    ),
    (
        1,
        2,
        'I totally agree with your perspective.',
        '2025-02-20'
    ),
    (
        2,
        3,
        'Thanks for sharing this insightful article.',
        '2025-02-19'
    ),
    (
        3,
        4,
        'Interesting perspective on the topic.',
        '2025-02-18'
    ),
    (
        4,
        5,
        'Well explained, looking forward to more posts like this.',
        '2025-02-17'
    );

CREATE TABLE Ratings (
    RatingID INT NOT NULL AUTO_INCREMENT,
    PostID INT NOT NULL,
    UserID INT NOT NULL,
    Rating TINYINT NOT NULL CHECK (Rating BETWEEN 1 AND 5),
    DateRated DATE NOT NULL,
    PRIMARY KEY (RatingID),
    UNIQUE (PostID, UserID),
    FOREIGN KEY (PostID) REFERENCES Posts (PostID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    Posts (
        Title,
        Content,
        DatePosted,
        AuthorID
    )
VALUES (
        'Daycare Activities',
        '<h1>Daycare Activities</h1>
        <p>We had an <i>amazing</i> day with <b>arts and crafts</b>!</p>
        <p>Our kids enjoyed creating <b>colorful paintings</b> and <i>decorative items</i>.</p>',
        '2025-01-01',
        1
    ),
    (
        'New Learning Resources',
        '<h1>New Learning Resources</h1>
        <p>We are excited to introduce <b>new books</b> designed for <i>early learners</i>.</p>
        <p>These resources will help in enhancing <b>language skills</b> and fostering <i>creativity</i>.</p>',
        '2025-01-02',
        2
    ),
    (
        'Winter Carnival',
        '<h1>Winter Carnival</h1>
        <p>Join us for our <b>annual winter carnival</b> this weekend.</p>
        <p>Enjoy activities like <i>snowman contests</i>, <b>games</b>, and <i>hot chocolate</i>.</p>',
        '2025-01-03',
        3
    ),
    (
        'Parent-Teacher Meetings',
        '<h1>Parent-Teacher Meetings</h1>
        <p>The <i>next parent-teacher meeting</i> is scheduled for <b>Friday</b>.</p>
        <p>Please <i>register in advance</i> to discuss your child\'s <b>progress and needs</b>.</p>',
        '2025-01-04',
        1
    ),
    (
        'Healthy Eating Habits',
        '<h1>Healthy Eating Habits</h1>
        <p>Learn tips on promoting <b>healthy eating</b> habits for kids.</p>
        <p>We share ideas for creating <i>nutritious meals</i> and encouraging <b>healthy choices</b>.</p>',
        '2025-01-05',
        2
    ),
    (
        'Summer Camp Updates',
        '<h1>Summer Camp Updates</h1>
        <p>Sign-ups are now open for our <b>exciting summer camp</b>!</p>
        <p>Don\'t miss out on activities like <i>campfires</i>, <b>sports</b>, and <i>art workshops</i>.</p>',
        '2025-01-06',
        3
    ),
    (
        'Playground Renovation',
        '<h1>Playground Renovation</h1>
        <p>We\'re thrilled to announce that our playground is getting a <b>brand new look</b>.</p>
        <p>Enjoy new <i>play equipment</i> and a <b>safer environment</b> for the kids.</p>',
        '2025-01-07',
        1
    ),
    (
        'Celebrating Holidays',
        '<h1>Celebrating Holidays</h1>
        <p>We\'re spreading <b>holiday joy</b> with exciting activities for kids.</p>
        <p>From <i>craft sessions</i> to <b>holiday-themed stories</b>, there\'s fun for everyone!</p>',
        '2025-01-08',
        2
    ),
    (
        'New Safety Guidelines',
        '<h1>New Safety Guidelines</h1>
        <p>We\'ve updated our <b>safety policies</b> to ensure a <i>secure environment</i> for kids.</p>
        <p>Thank you for helping us maintain a <b>safe and happy daycare</b>.</p>',
        '2025-01-09',
        3
    ),
    (
        'Special Guest Visit',
        '<h1>Special Guest Visit</h1>
        <p>A <b>storyteller</b> will visit our daycare next week!</p>
        <p>Don\'t miss the chance for kids to <i>enjoy engaging stories</i> and <b>interactive sessions</b>.</p>',
        '2025-01-10',
        1
    );

INSERT INTO
    PostImages (PostID, Image, Caption)
VALUES (
        1,
        LOAD_FILE('/path/to/image1.jpg'),
        'Kids enjoying crafts'
    ),
    (
        1,
        LOAD_FILE('/path/to/image2.jpg'),
        'Colorful paintings by kids'
    ),
    (
        2,
        LOAD_FILE('/path/to/image3.jpg'),
        'New learning books'
    ),
    (
        3,
        LOAD_FILE('/path/to/image4.jpg'),
        'Carnival games setup'
    ),
    (
        3,
        LOAD_FILE('/path/to/image5.jpg'),
        'Snowman contest entries'
    ),
    (
        4,
        LOAD_FILE('/path/to/image6.jpg'),
        'Meeting schedule'
    ),
    (
        5,
        LOAD_FILE('/path/to/image7.jpg'),
        'Healthy snacks for kids'
    ),
    (
        6,
        LOAD_FILE('/path/to/image8.jpg'),
        'Summer camp registration'
    ),
    (
        7,
        LOAD_FILE('/path/to/image9.jpg'),
        'New playground equipment'
    ),
    (
        8,
        LOAD_FILE('/path/to/image10.jpg'),
        'Holiday celebrations'
    );

INSERT INTO
    Comments (
        PostID,
        UserID,
        CommentText,
        DateCommented
    )
VALUES (
        1,
        2,
        'Looks like the kids had a great time!',
        '2025-01-02'
    ),
    (
        1,
        3,
        'Love these creative activities for children!',
        '2025-01-03'
    ),
    (
        2,
        1,
        'These books look amazing for early learning.',
        '2025-01-04'
    ),
    (
        3,
        2,
        'Can’t wait for the carnival. My kids are excited!',
        '2025-01-05'
    ),
    (
        4,
        3,
        'Thanks for keeping us informed about the meetings.',
        '2025-01-06'
    ),
    (
        5,
        1,
        'Healthy eating is so important. Great tips!',
        '2025-01-07'
    ),
    (
        6,
        2,
        'We’ve signed up for summer camp already!',
        '2025-01-08'
    ),
    (
        7,
        3,
        'The new playground looks fantastic. Can’t wait!',
        '2025-01-09'
    ),
    (
        8,
        1,
        'Holiday celebrations are always fun. Great work!',
        '2025-01-10'
    ),
    (
        9,
        2,
        'Thanks for the safety updates. Really helpful!',
        '2025-01-11'
    );

INSERT INTO
    Ratings (
        PostID,
        UserID,
        Rating,
        DateRated
    )
VALUES (1, 1, 5, '2025-01-02'),
    (1, 2, 4, '2025-01-02'),
    (1, 3, 5, '2025-01-03'),
    (2, 1, 4, '2025-01-04'),
    (2, 3, 5, '2025-01-04'),
    (3, 1, 5, '2025-01-05'),
    (3, 2, 4, '2025-01-05'),
    (4, 3, 5, '2025-01-06'),
    (5, 2, 4, '2025-01-07'),
    (6, 1, 5, '2025-01-08'),
    (7, 3, 5, '2025-01-09'),
    (8, 2, 5, '2025-01-10'),
    (9, 1, 4, '2025-01-11'),
    (10, 3, 5, '2025-01-12');

CREATE TABLE InventoryItems (
    ItemID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Category VARCHAR(50),
    Quantity INT NOT NULL DEFAULT 0,
    Description TEXT,
    DateAdded DATE NOT NULL,
    PRIMARY KEY (ItemID)
);

CREATE TABLE InventoryTransactions (
    TransactionID INT NOT NULL AUTO_INCREMENT,
    ItemID INT NOT NULL,
    TransactionType ENUM(
        'CHECK_IN',
        'CHECK_OUT',
        'RESHELF'
    ) NOT NULL,
    Quantity INT NOT NULL,
    Date DATE NOT NULL,
    UserID INT NOT NULL,
    PRIMARY KEY (TransactionID),
    FOREIGN KEY (ItemID) REFERENCES InventoryItems (ItemID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    InventoryItems (
        Name,
        Category,
        Quantity,
        Description,
        DateAdded
    )
VALUES (
        'Building Blocks',
        'Toys',
        100,
        'Colorful building blocks for creative play',
        '2025-01-01'
    ),
    (
        'Story Books',
        'Books',
        50,
        'Educational books for early readers',
        '2025-01-02'
    ),
    (
        'Art Supplies',
        'Crafts',
        200,
        'Paints, brushes, markers for art activities',
        '2025-01-03'
    ),
    (
        'Play Mats',
        'Furniture',
        30,
        'Soft mats for kids to play on',
        '2025-01-04'
    ),
    (
        'Toy Cars',
        'Toys',
        150,
        'Assorted toy cars for group play',
        '2025-01-05'
    ),
    (
        'Outdoor Balls',
        'Sports',
        40,
        'Balls for outdoor activities',
        '2025-01-06'
    ),
    (
        'Stuffed Animals',
        'Toys',
        80,
        'Plush toys for cuddling and pretend play',
        '2025-01-07'
    ),
    (
        'Activity Tables',
        'Furniture',
        15,
        'Tables for arts and crafts activities',
        '2025-01-08'
    ),
    (
        'Drawing Paper',
        'Crafts',
        300,
        'Sheets of paper for drawing and coloring',
        '2025-01-09'
    ),
    (
        'Educational Puzzles',
        'Toys',
        60,
        'Puzzles that develop critical thinking',
        '2025-01-10'
    );

INSERT INTO
    InventoryTransactions (
        ItemID,
        TransactionType,
        Quantity,
        Date,
        UserID
    )
VALUES (
        1,
        'CHECK_IN',
        100,
        '2025-01-01',
        14
    ),
    (
        2,
        'CHECK_IN',
        50,
        '2025-01-02',
        15
    ),
    (
        3,
        'CHECK_IN',
        200,
        '2025-01-03',
        16
    ),
    (
        4,
        'CHECK_IN',
        30,
        '2025-01-04',
        17
    ),
    (
        5,
        'CHECK_IN',
        150,
        '2025-01-05',
        18
    ),
    (
        6,
        'CHECK_IN',
        40,
        '2025-01-06',
        19
    ),
    (
        7,
        'CHECK_IN',
        80,
        '2025-01-07',
        20
    ),
    (
        8,
        'CHECK_IN',
        15,
        '2025-01-08',
        21
    ),
    (
        9,
        'CHECK_IN',
        300,
        '2025-01-09',
        22
    ),
    (
        10,
        'CHECK_IN',
        60,
        '2025-01-10',
        23
    ),
    (
        1,
        'CHECK_OUT',
        10,
        '2025-01-11',
        24
    ),
    (
        2,
        'CHECK_OUT',
        5,
        '2025-01-12',
        25
    ),
    (
        3,
        'CHECK_OUT',
        20,
        '2025-01-13',
        26
    ),
    (
        5,
        'CHECK_OUT',
        30,
        '2025-01-14',
        27
    ),
    (
        7,
        'CHECK_OUT',
        10,
        '2025-01-15',
        28
    ),
    (
        9,
        'CHECK_OUT',
        50,
        '2025-01-16',
        29
    );

CREATE TABLE Parent_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Gender ENUM('M', 'F') NOT NULL,
    Language VARCHAR(30) NOT NULL,
    Last_Seen DATETIME NOT NULL,
    Date_Deleted DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Child_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    ParentID INT NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Last_Name VARCHAR(100) NOT NULL,
    DOB DATE NOT NULL,
    Relation VARCHAR(30) NOT NULL,
    Language VARCHAR(30) NOT NULL,
    Allergies VARCHAR(255),
    Gender ENUM('M', 'F') NOT NULL,
    PackageID INT,
    Date_Deleted DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Payment_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    PaymentID INT NOT NULL,
    DateTime DATETIME NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    PayerID INT NOT NULL,
    Mode ENUM(
        'Cash',
        'Bank Transfer',
        'Credit Card'
    ) NOT NULL DEFAULT 'Cash',
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Refund_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    RefundID INT NOT NULL,
    PaymentID INT NOT NULL,
    Reason VARCHAR(100) NOT NULL,
    Mode ENUM(
        'Cash',
        'Bank Transfer',
        'Credit Card'
    ) NOT NULL DEFAULT 'Cash',
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE SalaryPayment_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    PaymentID INT NOT NULL,
    UserID INT NOT NULL,
    Salary DECIMAL(10, 2) NOT NULL,
    Date DATE NOT NULL,
    Bonus DECIMAL(10, 2) DEFAULT 0,
    Deductions DECIMAL(10, 2) DEFAULT 0,
    Mode ENUM(
        'Cash',
        'Bank Transfer',
        'Credit Card'
    ) NOT NULL DEFAULT 'Cash',
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Teacher_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    TeacherID INT NOT NULL,
    UserID INT NOT NULL,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Gender ENUM('M', 'F') NOT NULL,
    Language VARCHAR(30) NOT NULL,
    Last_Seen DATETIME NOT NULL,
    AgeGroup INT NOT NULL,
    Subject VARCHAR(30) NOT NULL,
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Maid_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    MaidID INT NOT NULL,
    UserID INT NOT NULL,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Language VARCHAR(30) NOT NULL,
    Last_Seen DATETIME NOT NULL,
    AgeGroup INT NOT NULL,
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Receptionist_Archive (
    ArchiveID INT NOT NULL AUTO_INCREMENT,
    ReceptionistID INT NOT NULL,
    UserID INT NOT NULL,
    Last_Name VARCHAR(100) NOT NULL,
    First_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(12) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    NID VARCHAR(12) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Gender ENUM('M', 'F') NOT NULL,
    Language VARCHAR(30) NOT NULL,
    Last_Seen DATETIME NOT NULL,
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (ArchiveID)
);

CREATE TABLE Message_Archive (
    ArchiveID INT AUTO_INCREMENT PRIMARY KEY,
    ChatID INT NOT NULL,
    SenderID INT NOT NULL,
    RecieverID INT NOT NULL,
    Message VARCHAR(200),
    ImageURL VARCHAR(200),
    ChildID INT NOT NULL
);

CREATE TABLE Attendance_Archive (
    AttendanceID INT NOT NULL,
    ChildID INT NOT NULL,
    Start_Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    End_Date DATE,
    End_Time TIME,
    Status VARCHAR(100) NOT NULL,
    Date_Archived DATETIME NOT NULL,
    PRIMARY KEY (AttendanceID),
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ChildMedical_Archive (
    MedicalID INT NOT NULL,
    ChildID INT NOT NULL,
    DoctorID INT NOT NULL,
    Diagnosis VARCHAR(100),
    DateTime DATETIME NOT NULL,
    Notes VARCHAR(200),
    Date_Archived DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (MedicalID)
);

CREATE TRIGGER after_parent_delete
AFTER DELETE ON Parent
FOR EACH ROW
BEGIN
    INSERT INTO Parent_Archive (UserID, Last_Name, First_Name, Phone_Number, Address, NID, Email, Gender, Language, Last_Seen, Date_Deleted)
    VALUES (OLD.UserID, OLD.Last_Name, OLD.First_Name, OLD.Phone_Number, OLD.Address, OLD.NID, OLD.Email, OLD.Gender, OLD.Language, OLD.Last_Seen, NOW());
END;

-- Trigger for archiving Child record after deletion
CREATE TRIGGER after_child_delete
AFTER DELETE ON Child
FOR EACH ROW
BEGIN
    INSERT INTO Child_Archive 
        (ChildID, ParentID, First_Name, Last_Name, DOB, Relation, Language, Allergies, Gender, PackageID, Date_Deleted)
    VALUES 
        (OLD.ChildID, OLD.ParentID, OLD.First_Name, OLD.Last_Name, OLD.DOB, OLD.Relation, OLD.Language, OLD.Allergies, OLD.Gender, OLD.PackageID, NOW());
END;

ALTER TABLE Child ADD COLUMN PackageID INT NOT NULL DEFAULT 0;

-- Trigger for archiving Teacher record after deletion
CREATE TRIGGER after_teacher_delete
AFTER DELETE ON Teacher
FOR EACH ROW
BEGIN
    INSERT INTO Teacher_Archive 
        (TeacherID, UserID, Last_Name, First_Name, Phone_Number, Address, NID, Email, Gender, Language, Last_Seen, AgeGroup, Subject, Date_Archived)
    VALUES 
        (OLD.TeacherID, OLD.UserID, OLD.Last_Name, OLD.First_Name, OLD.Phone_Number, OLD.Address, OLD.NID, OLD.Email, OLD.Gender, OLD.Language, OLD.Last_Seen, OLD.AgeGroup, OLD.Subject, NOW());
END;

CREATE TRIGGER after_maid_delete
AFTER DELETE ON Maid
FOR EACH ROW
BEGIN
    INSERT INTO Maid_Archive (MaidID, UserID, Last_Name, First_Name, Phone_Number, Address, NID, Language, Last_Seen, AgeGroup, Date_Archived)
    VALUES (OLD.MaidID, OLD.UserID, OLD.Last_Name, OLD.First_Name, OLD.Phone_Number, OLD.Address, OLD.NID, OLD.Language, OLD.Last_Seen, OLD.AgeGroup, NOW());
END;

CREATE TRIGGER after_receptionist_delete
AFTER DELETE ON Receptionist
FOR EACH ROW
BEGIN
    INSERT INTO Receptionist_Archive (ReceptionistID, UserID, Last_Name, First_Name, Phone_Number, Address, NID, Email, Gender, Language, Last_Seen, Date_Archived)
    VALUES (OLD.ReceptionistID, OLD.UserID, OLD.Last_Name, OLD.First_Name, OLD.Phone_Number, OLD.Address, OLD.NID, OLD.Email, OLD.Gender, OLD.Language, OLD.Last_Seen, NOW());
END;

CREATE TRIGGER after_payment_delete
AFTER DELETE ON Payment
FOR EACH ROW
BEGIN
    INSERT INTO Payment_Archive (PaymentID, DateTime, Amount, PayerID, Mode, Date_Archived)
    VALUES (OLD.PaymentID, OLD.DateTime, OLD.Amount, OLD.PayerID, OLD.Mode, NOW());
END;

CREATE TRIGGER after_refund_delete
AFTER DELETE ON Refund
FOR EACH ROW
BEGIN
    INSERT INTO Refund_Archive (RefundID, PaymentID, Reason, Mode, Date_Archived)
    VALUES (OLD.RefundID, OLD.PaymentID, OLD.Reason, OLD.Mode, NOW());
END;

CREATE TRIGGER after_salarypayment_delete
AFTER DELETE ON SalaryPayment
FOR EACH ROW
BEGIN
    INSERT INTO SalaryPayment_Archive (PaymentID, UserID, Salary, Date, Bonus, Deductions, Mode, Date_Archived)
    VALUES (OLD.PaymentID, OLD.UserID, OLD.Salary, OLD.Date, OLD.Bonus, OLD.Deductions, OLD.Mode, NOW());
END;

CREATE TRIGGER after_message_delete
AFTER DELETE ON Chat
FOR EACH ROW
BEGIN
    INSERT INTO Message_Archive 
        (ChatID, SenderID, ReceiverID, ChildID, Message, ImageURL, DeletedAt)
    VALUES 
        (OLD.ChatID, OLD.SenderID, OLD.RecieverID, OLD.ChildID, OLD.Message, OLD.Image, NOW());
END;

CREATE TRIGGER after_attendance_delete
AFTER DELETE ON Attendance
FOR EACH ROW
BEGIN
    -- Insert the deleted record into Attendance_Archive
    INSERT INTO Attendance_Archive (AttendanceID, ChildID, Start_Date, Start_Time, End_Date, End_Time, Status, Date_Archived)
    VALUES (OLD.AttendanceID, OLD.ChildID, OLD.Start_Date, OLD.Start_Time, OLD.End_Date, OLD.End_Time, OLD.Status, NOW());
END;

CREATE TRIGGER after_childmedical_delete
AFTER DELETE ON ChildMedical
FOR EACH ROW
BEGIN
    INSERT INTO ChildMedical_Archive (MedicalID, ChildID, DoctorID, Diagnosis, DateTime, Notes, Date_Archived)
    VALUES (OLD.MedicalID, OLD.ChildID, OLD.DoctorID, OLD.Diagnosis, OLD.DateTime, OLD.Notes, NOW());
END;

CREATE TRIGGER after_emergency_delete
AFTER DELETE ON Emergency
FOR EACH ROW
BEGIN
    INSERT INTO Emergency_Archive (EmergencyID, ChildID, Description, DateTime, Informed, AssigneeID, Date_Archived)
    VALUES (OLD.EmergencyID, OLD.ChildID, OLD.Description, OLD.DateTime, OLD.Informed, OLD.AssigneeID, NOW());
END;

CREATE PROCEDURE ArchivePickupPerson()
BEGIN

    INSERT INTO PickupPerson_Archive (PersonID, Name, NID, ChildID, ImageURL, Date_Archived)
    SELECT PersonID, Name, NID, ChildID, ImageURL, NOW()
    FROM PickupPerson;

    DELETE FROM PickupPerson;
END

CREATE PROCEDURE ArchivePickup()
BEGIN
    INSERT INTO Pickup_Archive (PickupID, ChildID, Time, Person, OTP, Date_Archived)
    SELECT PickupID, ChildID, Time, Person, OTP, NOW()
    FROM Pickup;
    
    DELETE FROM Pickup;
END

CREATE EVENT ResetPickupPersonTable
    ON SCHEDULE EVERY 1 DAY
    STARTS '2024-12-10 00:00:00'
    DO
    CALL ArchivePickupPerson()
;

CREATE EVENT ResetPickup
    ON SCHEDULE EVERY 1 DAY
    STARTS '2024-12-10 00:00:00'
    DO
    CALL ArchivePickupPerson()
;

-- Inventory management Database Tables

DROP TABLE Inventory;

DROP TABLE Stock;

CREATE TABLE Stock (
    ItemID INT PRIMARY KEY AUTO_INCREMENT,
    Item VARCHAR(255) NOT NULL,
    Category ENUM(
        'Stationery',
        'Toys',
        'Books',
        'Cleaning',
        'Health',
        'Snacks',
        'Crafts',
        'Clothing'
    ) NOT NULL,
    Quantity INT NOT NULL DEFAULT 0,
    MinQuantity INT NOT NULL DEFAULT 5
);

INSERT INTO
    Stock (
        Item,
        Category,
        Quantity,
        MinQuantity
    )
VALUES (
        'Pens',
        'Stationaries',
        50,
        10
    ),
    (
        'Pencils',
        'Stationaries',
        40,
        10
    ),
    (
        'Markers',
        'Stationaries',
        30,
        5
    ),
    (
        'Erasers',
        'Stationaries',
        25,
        5
    ),
    (
        'Coloring Books',
        'Books',
        20,
        5
    ),
    ('Puzzle Toys', 'Toys', 15, 5),
    ('Board Games', 'Toys', 10, 3),
    (
        'Sanitizers',
        'Health & Safety',
        35,
        10
    ),
    (
        'Face Masks',
        'Health & Safety',
        60,
        15
    ),
    (
        'Gloves',
        'Health & Safety',
        45,
        10
    ),
    ('Chips', 'Snacks', 100, 20),
    ('Cookies', 'Snacks', 90, 20),
    ('Notebooks', 'Books', 60, 10),
    (
        'Detergents',
        'Cleaning Products',
        30,
        10
    ),
    (
        'Brooms',
        'Cleaning Products',
        20,
        5
    ),
    (
        'Dustbins',
        'Cleaning Products',
        10,
        2
    ),
    (
        'Staplers',
        'Stationaries',
        12,
        5
    ),
    (
        'Sketch Pens',
        'Stationaries',
        18,
        5
    ),
    (
        'Story Books',
        'Books',
        40,
        10
    ),
    (
        'Juice Packs',
        'Snacks',
        80,
        15
    );

CREATE TABLE Inventory (
    ActivityID INT AUTO_INCREMENT PRIMARY KEY,
    Activity ENUM(
        'Issued',
        'Returned',
        'Restocked'
    ) NOT NULL,
    UserID INT NOT NULL,
    ItemID INT NOT NULL,
    Quantity INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Notes VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ItemID) REFERENCES Stock (ItemID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    Inventory (
        Activity,
        UserID,
        ItemID,
        Quantity,
        Date,
        Time,
        Notes
    )
VALUES (
        'issued',
        14,
        1,
        5,
        '2025-04-10',
        '09:15:00',
        'Issued for classroom use'
    ),
    (
        'returned',
        18,
        2,
        3,
        '2025-04-09',
        '14:30:00',
        'Returned in good condition'
    ),
    (
        'Restocked',
        20,
        3,
        10,
        '2025-04-08',
        '11:00:00',
        'New stock arrived'
    ),
    (
        'issued',
        21,
        4,
        2,
        '2025-04-07',
        '13:20:00',
        'Used in art class'
    ),
    (
        'Restocked',
        24,
        5,
        15,
        '2025-04-06',
        '10:00:00',
        'Donation'
    ),
    (
        'issued',
        27,
        6,
        1,
        '2025-04-05',
        '15:45:00',
        'Issued for playtime'
    ),
    (
        'returned',
        14,
        6,
        1,
        '2025-04-05',
        '17:00:00',
        'Returned after play'
    ),
    (
        'Restocked',
        16,
        7,
        5,
        '2025-04-04',
        '08:30:00',
        'Restocked'
    ),
    (
        'issued',
        18,
        8,
        7,
        '2025-04-03',
        '09:00:00',
        'Issued for health checkup'
    ),
    (
        'Restocked',
        20,
        9,
        10,
        '2025-04-02',
        '16:15:00',
        'New delivery'
    ),
    (
        'issued',
        21,
        10,
        4,
        '2025-04-01',
        '12:10:00',
        'For medical kit'
    ),
    (
        'Restocked',
        24,
        11,
        20,
        '2025-03-30',
        '10:30:00',
        'Snacks restocked'
    ),
    (
        'issued',
        27,
        12,
        5,
        '2025-03-29',
        '11:45:00',
        'Party distribution'
    ),
    (
        'Restocked',
        14,
        13,
        10,
        '2025-03-28',
        '09:20:00',
        'New class materials'
    ),
    (
        'issued',
        16,
        14,
        3,
        '2025-03-27',
        '14:00:00',
        'Cleaning event'
    ),
    (
        'returned',
        18,
        15,
        2,
        '2025-03-26',
        '16:45:00',
        'Cleaning equipment returned'
    ),
    (
        'Restocked',
        20,
        16,
        2,
        '2025-03-25',
        '13:30:00',
        'New equipment'
    ),
    (
        'issued',
        22,
        17,
        4,
        '2025-03-24',
        '15:00:00',
        'Office supplies'
    ),
    (
        'Restocked',
        25,
        18,
        6,
        '2025-03-23',
        '08:50:00',
        'Arts supplies restocked'
    ),
    (
        'issued',
        27,
        19,
        5,
        '2025-03-22',
        '10:10:00',
        'Reading session'
    );

DROP TABLE inventory;

-- 100 new rows for Inventory table with each ItemID (1-20) having at least one
-- instance of "Issued", "Returned", and "Restocked" status

INSERT INTO
    Inventory (
        Activity,
        UserID,
        ItemID,
        Quantity,
        Date,
        Time,
        Notes
    )
VALUES (
        'Issued',
        15,
        1,
        3,
        '2025-04-15',
        '08:30:00',
        'Morning classroom activities'
    ),
    (
        'Returned',
        15,
        1,
        3,
        '2025-04-15',
        '14:45:00',
        'Returned after class'
    ),
    (
        'Restocked',
        20,
        1,
        8,
        '2025-04-16',
        '09:00:00',
        'Weekly restock'
    ),
    (
        'Issued',
        16,
        1,
        2,
        '2025-04-17',
        '10:15:00',
        'Teacher request'
    ),
    (
        'Returned',
        16,
        1,
        2,
        '2025-04-17',
        '15:30:00',
        'End of day return'
    ),
    (
        'Issued',
        17,
        2,
        5,
        '2025-04-12',
        '09:30:00',
        'Science experiment'
    ),
    (
        'Returned',
        17,
        2,
        5,
        '2025-04-12',
        '11:45:00',
        'Post-experiment return'
    ),
    (
        'Restocked',
        24,
        2,
        10,
        '2025-04-13',
        '13:00:00',
        'Monthly supply refresh'
    ),
    (
        'Issued',
        19,
        2,
        2,
        '2025-04-14',
        '14:15:00',
        'Student project'
    ),
    (
        'Returned',
        19,
        2,
        2,
        '2025-04-15',
        '08:45:00',
        'Overnight project completed'
    ),
    (
        'Issued',
        21,
        3,
        4,
        '2025-04-11',
        '10:00:00',
        'Art class materials'
    ),
    (
        'Returned',
        21,
        3,
        4,
        '2025-04-11',
        '12:30:00',
        'End of class return'
    ),
    (
        'Restocked',
        20,
        3,
        15,
        '2025-04-14',
        '09:15:00',
        'New shipment arrival'
    ),
    (
        'Issued',
        22,
        3,
        3,
        '2025-04-16',
        '13:45:00',
        'Special project'
    ),
    (
        'Returned',
        22,
        3,
        3,
        '2025-04-16',
        '16:00:00',
        'Project completed'
    ),
    (
        'Issued',
        14,
        4,
        6,
        '2025-04-10',
        '11:15:00',
        'Group activity'
    ),
    (
        'Returned',
        14,
        4,
        6,
        '2025-04-10',
        '15:30:00',
        'Activity concluded'
    ),
    (
        'Restocked',
        24,
        4,
        12,
        '2025-04-12',
        '08:00:00',
        'Weekend restock'
    ),
    (
        'Issued',
        16,
        4,
        2,
        '2025-04-15',
        '09:45:00',
        'Student request'
    ),
    (
        'Returned',
        16,
        4,
        2,
        '2025-04-15',
        '14:00:00',
        'Afternoon return'
    ),
    (
        'Issued',
        18,
        5,
        8,
        '2025-04-09',
        '10:45:00',
        'Field trip supplies'
    ),
    (
        'Returned',
        18,
        5,
        7,
        '2025-04-09',
        '16:15:00',
        'Return with 1 lost item'
    ),
    (
        'Restocked',
        20,
        5,
        10,
        '2025-04-11',
        '13:30:00',
        'Replacement stock'
    ),
    (
        'Issued',
        21,
        5,
        3,
        '2025-04-14',
        '11:00:00',
        'Classroom demonstration'
    ),
    (
        'Returned',
        21,
        5,
        3,
        '2025-04-14',
        '12:15:00',
        'Demo completed'
    ),
    (
        'Issued',
        23,
        6,
        4,
        '2025-04-08',
        '09:00:00',
        'Morning activities'
    ),
    (
        'Returned',
        23,
        6,
        4,
        '2025-04-08',
        '11:45:00',
        'Before lunch return'
    ),
    (
        'Restocked',
        24,
        6,
        6,
        '2025-04-10',
        '14:30:00',
        'Weekly refresh'
    ),
    (
        'Issued',
        25,
        6,
        2,
        '2025-04-13',
        '10:30:00',
        'Weekend program'
    ),
    (
        'Returned',
        25,
        6,
        2,
        '2025-04-13',
        '15:00:00',
        'Program concluded'
    ),
    (
        'Issued',
        14,
        7,
        5,
        '2025-04-07',
        '13:15:00',
        'Afternoon session'
    ),
    (
        'Returned',
        14,
        7,
        5,
        '2025-04-07',
        '16:30:00',
        'End of session'
    ),
    (
        'Restocked',
        20,
        7,
        10,
        '2025-04-09',
        '08:45:00',
        'Mid-week restock'
    ),
    (
        'Issued',
        17,
        7,
        3,
        '2025-04-12',
        '09:15:00',
        'Weekend workshop'
    ),
    (
        'Returned',
        17,
        7,
        3,
        '2025-04-12',
        '12:00:00',
        'Workshop completed'
    ),
    (
        'Issued',
        19,
        8,
        7,
        '2025-04-06',
        '10:00:00',
        'Health awareness day'
    ),
    (
        'Returned',
        19,
        8,
        7,
        '2025-04-06',
        '15:45:00',
        'Event concluded'
    ),
    (
        'Restocked',
        24,
        8,
        14,
        '2025-04-08',
        '09:30:00',
        'Bi-weekly restock'
    ),
    (
        'Issued',
        22,
        8,
        4,
        '2025-04-11',
        '11:30:00',
        'Student health check'
    ),
    (
        'Returned',
        22,
        8,
        4,
        '2025-04-11',
        '14:15:00',
        'Checks completed'
    ),
    (
        'Issued',
        15,
        9,
        6,
        '2025-04-05',
        '09:45:00',
        'Morning activities'
    ),
    (
        'Returned',
        15,
        9,
        6,
        '2025-04-05',
        '12:30:00',
        'Before lunch return'
    ),
    (
        'Restocked',
        20,
        9,
        12,
        '2025-04-07',
        '14:00:00',
        'Weekly supply refresh'
    ),
    (
        'Issued',
        16,
        9,
        3,
        '2025-04-10',
        '10:15:00',
        'Special project'
    ),
    (
        'Returned',
        16,
        9,
        3,
        '2025-04-10',
        '15:30:00',
        'Project completed'
    ),
    (
        'Issued',
        18,
        10,
        5,
        '2025-04-04',
        '11:00:00',
        'First aid training'
    ),
    (
        'Returned',
        18,
        10,
        5,
        '2025-04-04',
        '16:15:00',
        'Training completed'
    ),
    (
        'Restocked',
        24,
        10,
        10,
        '2025-04-06',
        '08:30:00',
        'Sunday morning restock'
    ),
    (
        'Issued',
        21,
        10,
        2,
        '2025-04-09',
        '13:45:00',
        'Medical demonstration'
    ),
    (
        'Returned',
        21,
        10,
        2,
        '2025-04-09',
        '15:00:00',
        'Demo completed'
    ),
    (
        'Issued',
        23,
        11,
        10,
        '2025-04-03',
        '09:15:00',
        'Class party'
    ),
    (
        'Returned',
        23,
        11,
        8,
        '2025-04-03',
        '14:30:00',
        'Some consumed'
    ),
    (
        'Restocked',
        20,
        11,
        15,
        '2025-04-05',
        '10:45:00',
        'Weekend restock'
    ),
    (
        'Issued',
        25,
        11,
        5,
        '2025-04-08',
        '11:15:00',
        'Snack time'
    ),
    (
        'Returned',
        25,
        11,
        0,
        '2025-04-08',
        '13:00:00',
        'All consumed'
    ),
    (
        'Issued',
        14,
        12,
        8,
        '2025-04-02',
        '10:30:00',
        'Birthday celebration'
    ),
    (
        'Returned',
        14,
        12,
        3,
        '2025-04-02',
        '15:45:00',
        'Leftover return'
    ),
    (
        'Restocked',
        24,
        12,
        10,
        '2025-04-04',
        '09:00:00',
        'End of week restock'
    ),
    (
        'Issued',
        17,
        12,
        4,
        '2025-04-07',
        '14:15:00',
        'Afternoon snack'
    ),
    (
        'Returned',
        17,
        12,
        0,
        '2025-04-07',
        '16:30:00',
        'All distributed'
    ),
    (
        'Issued',
        19,
        13,
        7,
        '2025-04-01',
        '08:45:00',
        'Morning class'
    ),
    (
        'Returned',
        19,
        13,
        7,
        '2025-04-01',
        '11:30:00',
        'Class completed'
    ),
    (
        'Restocked',
        20,
        13,
        15,
        '2025-04-03',
        '13:15:00',
        'New materials arrival'
    ),
    (
        'Issued',
        22,
        13,
        5,
        '2025-04-06',
        '09:30:00',
        'Weekend activity'
    ),
    (
        'Returned',
        22,
        13,
        5,
        '2025-04-06',
        '14:00:00',
        'Activity ended'
    ),
    (
        'Issued',
        15,
        14,
        4,
        '2025-03-31',
        '10:15:00',
        'Spring cleaning'
    ),
    (
        'Returned',
        15,
        14,
        4,
        '2025-03-31',
        '15:30:00',
        'Cleaning completed'
    ),
    (
        'Restocked',
        24,
        14,
        8,
        '2025-04-02',
        '09:45:00',
        'Monthly restock'
    ),
    (
        'Issued',
        16,
        14,
        2,
        '2025-04-05',
        '11:00:00',
        'Weekend maintenance'
    ),
    (
        'Returned',
        16,
        14,
        2,
        '2025-04-05',
        '16:15:00',
        'Maintenance completed'
    ),
    (
        'Issued',
        18,
        15,
        3,
        '2025-03-30',
        '09:30:00',
        'Cleaning duty'
    ),
    (
        'Returned',
        18,
        15,
        3,
        '2025-03-30',
        '14:45:00',
        'Duty completed'
    ),
    (
        'Restocked',
        20,
        15,
        6,
        '2025-04-01',
        '08:00:00',
        'Month start restock'
    ),
    (
        'Issued',
        21,
        15,
        2,
        '2025-04-04',
        '13:30:00',
        'Afternoon cleanup'
    ),
    (
        'Returned',
        21,
        15,
        2,
        '2025-04-04',
        '16:00:00',
        'Cleanup completed'
    ),
    (
        'Issued',
        23,
        16,
        2,
        '2025-03-29',
        '11:15:00',
        'Equipment check'
    ),
    (
        'Returned',
        23,
        16,
        2,
        '2025-03-29',
        '15:30:00',
        'Check completed'
    ),
    (
        'Restocked',
        24,
        16,
        4,
        '2025-03-31',
        '10:00:00',
        'Week start restock'
    ),
    (
        'Issued',
        25,
        16,
        1,
        '2025-04-03',
        '09:15:00',
        'Maintenance check'
    ),
    (
        'Returned',
        25,
        16,
        1,
        '2025-04-03',
        '12:30:00',
        'Check completed'
    ),
    (
        'Issued',
        14,
        17,
        5,
        '2025-03-28',
        '10:45:00',
        'Office work'
    ),
    (
        'Returned',
        14,
        17,
        5,
        '2025-03-28',
        '16:00:00',
        'Work completed'
    ),
    (
        'Restocked',
        20,
        17,
        10,
        '2025-03-30',
        '09:00:00',
        'Weekend restock'
    ),
    (
        'Issued',
        17,
        17,
        3,
        '2025-04-02',
        '13:45:00',
        'Administrative task'
    ),
    (
        'Returned',
        17,
        17,
        3,
        '2025-04-02',
        '15:15:00',
        'Task completed'
    ),
    (
        'Issued',
        19,
        18,
        4,
        '2025-03-27',
        '09:15:00',
        'Art project'
    ),
    (
        'Returned',
        19,
        18,
        4,
        '2025-03-27',
        '14:30:00',
        'Project completed'
    ),
    (
        'Restocked',
        24,
        18,
        8,
        '2025-03-29',
        '08:45:00',
        'Weekend supply refresh'
    ),
    (
        'Issued',
        22,
        18,
        2,
        '2025-04-01',
        '10:30:00',
        'Creative session'
    ),
    (
        'Returned',
        22,
        18,
        2,
        '2025-04-01',
        '15:45:00',
        'Session ended'
    ),
    (
        'Issued',
        15,
        19,
        8,
        '2025-03-26',
        '11:00:00',
        'Reading circle'
    ),
    (
        'Returned',
        15,
        19,
        8,
        '2025-03-26',
        '15:15:00',
        'Circle completed'
    ),
    (
        'Restocked',
        20,
        19,
        10,
        '2025-03-28',
        '09:30:00',
        'End of week restock'
    ),
    (
        'Issued',
        16,
        19,
        4,
        '2025-03-31',
        '13:00:00',
        'Monday reading group'
    ),
    (
        'Returned',
        16,
        19,
        4,
        '2025-03-31',
        '16:30:00',
        'Group session ended'
    ),
    (
        'Issued',
        18,
        20,
        6,
        '2025-03-25',
        '08:30:00',
        'Morning session'
    ),
    (
        'Returned',
        18,
        20,
        6,
        '2025-03-25',
        '11:45:00',
        'Session completed'
    ),
    (
        'Restocked',
        24,
        20,
        12,
        '2025-03-27',
        '10:15:00',
        'Weekly supply update'
    ),
    (
        'Issued',
        21,
        20,
        3,
        '2025-03-30',
        '14:00:00',
        'Weekend activity'
    ),
    (
        'Returned',
        21,
        20,
        3,
        '2025-03-30',
        '16:15:00',
        'Activity concluded'
    );

INSERT INTO
    Inventory (
        Activity,
        UserID,
        ItemID,
        Quantity,
        Date,
        Time,
        Notes
    )
VALUES (
        'Borrowed',
        14,
        6,
        1,
        '2025-04-10',
        '14:00:00',
        'Borrowed tablet for presentation'
    ),
    (
        'ReturnBorrowed',
        14,
        6,
        1,
        '2025-04-10',
        '17:00:00',
        'Returned after use'
    ),
    (
        'Borrowed',
        14,
        3,
        2,
        '2025-04-11',
        '09:45:00',
        'Borrowed markers for group work'
    ),
    (
        'ReturnBorrowed',
        14,
        3,
        2,
        '2025-04-11',
        '12:30:00',
        'Returned during lunch'
    ),
    (
        'Borrowed',
        14,
        7,
        5,
        '2025-04-15',
        '13:15:00',
        'Borrowed lab kits for week-long experiment'
    ),
    (
        'Borrowed',
        14,
        8,
        1,
        '2025-04-16',
        '08:00:00',
        'Borrowed camera for media club project'
    ),
    (
        'Borrowed',
        14,
        3,
        3,
        '2025-04-17',
        '10:30:00',
        'Used for creative writing poster'
    ),
    (
        'Borrowed',
        14,
        9,
        2,
        '2025-04-19',
        '15:00:00',
        'Sports gear for weekend tournament'
    ),
    (
        'Borrowed',
        14,
        2,
        1,
        '2025-04-12',
        '11:00:00',
        'Single item for solo study session'
    ),
    (
        'ReturnBorrowed',
        14,
        2,
        1,
        '2025-04-12',
        '14:00:00',
        'Returned same day'
    );

CREATE TABLE `visitor` (
    `VisitorID` int(11) NOT NULL,
    `FirstName` varchar(100) DEFAULT NULL,
    `LastName` varchar(100) DEFAULT NULL,
    `NID` varchar(12) NOT NULL,
    `Date` date NOT NULL,
    `Start_Time` time NOT NULL,
    `End_Time` time NOT NULL,
    `Purpose` varchar(100) NOT NULL,
    `Phone_Number` varchar(10) NOT NULL,
    `ParentID` int(11) DEFAULT NULL,
    `Role` varchar(20) DEFAULT NULL,
    `e_mail` varchar(50) NOT NULL DEFAULT '    --    '
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `visitor`
--

INSERT INTO
    `visitor` (
        `VisitorID`,
        `FirstName`,
        `LastName`,
        `NID`,
        `Date`,
        `Start_Time`,
        `End_Time`,
        `Purpose`,
        `Phone_Number`,
        `ParentID`,
        `Role`,
        `e_mail`
    )
VALUES (
        1,
        'John ',
        'Deo',
        '123456789012',
        '2025-01-24',
        '08:30:00',
        '09:00:00',
        'Pick Up',
        '9876543210',
        NULL,
        'Parent',
        'example1@gmail.com'
    ),
    (
        2,
        'Jane ',
        'Smith',
        '987654321098',
        '2025-01-26',
        '10:00:00',
        '10:30:00',
        'Drop Off',
        '1234567890',
        NULL,
        'Guardian',
        'example2@gmail.com'
    ),
    (
        3,
        'Mark ',
        'Johnson',
        '112233445566',
        '2025-01-25',
        '12:00:00',
        '12:30:00',
        'Meeting',
        '5551234567',
        NULL,
        '',
        'example3@gmail.com'
    ),
    (
        4,
        'Lucy ',
        'Brown',
        '223344556677',
        '2025-01-24',
        '14:00:00',
        '14:45:00',
        'Pick Up',
        '6669876543',
        NULL,
        '',
        'example4@gmail.com'
    ),
    (
        5,
        'Emily ',
        'White',
        '334455667788',
        '2025-01-26',
        '15:00:00',
        '15:30:00',
        'Emergency',
        '7776543210',
        NULL,
        'Parent',
        'example5@gmail.com'
    ),
    (
        6,
        'John',
        NULL,
        '200226002987',
        '2025-02-11',
        '14:27:56',
        '14:37:56',
        'give snacks',
        '0765442133',
        NULL,
        '',
        'example6@gmail.com'
    ),
    (
        7,
        'John ',
        'Doe',
        '123654789123',
        '2025-01-28',
        '15:20:13',
        '15:40:15',
        'Give food',
        '0778531847',
        NULL,
        'Parent',
        'example7@gmail.com'
    ),
    (
        8,
        '',
        NULL,
        '22001573',
        '2025-04-21',
        '13:51:00',
        '04:55:00',
        'Conduct a session',
        '0702513065',
        NULL,
        'Instructor',
        'arunaluprabhatha@gmail.com'
    ),
    (
        11,
        '',
        NULL,
        '22009876567',
        '2025-04-21',
        '03:09:00',
        '14:08:00',
        'Pre School Concert',
        '0786546789',
        NULL,
        'phi',
        'hasthadhnnjaya@gmail.com'
    ),
    (
        13,
        '',
        NULL,
        '22001574',
        '2025-04-21',
        '08:14:00',
        '11:15:00',
        'show',
        '0786543907',
        NULL,
        'Instructor',
        'malith@gmail.com'
    ),
    (
        14,
        'Malith',
        'Prabhatha',
        '34567890',
        '2025-04-21',
        '09:45:00',
        '14:25:00',
        'Conduct a session',
        '0702513065',
        NULL,
        'Instructor',
        'arunaluprabhatha@gmail.com'
    ),
    (
        15,
        'Arunalu',
        'Prabhatha',
        '22001573',
        '2025-04-22',
        '08:15:00',
        '15:18:00',
        'Conduct a session',
        '0702513065',
        NULL,
        'Instructor',
        'arunaluprabhatha@gmail.com'
    ),
    (
        16,
        '',
        'Prabhatha',
        '22001573',
        '2025-04-22',
        '05:24:00',
        '16:28:00',
        'ghkhgi',
        '0702513065',
        NULL,
        'ghjhg',
        'hjhkj'
    ),
    (
        17,
        '',
        'Dhananjaya',
        '22001573',
        '2025-04-22',
        '12:32:00',
        '16:31:00',
        'Pre School Concert',
        '0702513065',
        NULL,
        'ghjhg',
        'hjhkj'
    ),
    (
        18,
        '',
        'Deshan',
        '34567890',
        '2025-04-22',
        '05:35:00',
        '15:33:00',
        'Pre School Concert',
        '0702513065',
        NULL,
        'ghjhg',
        'hjhkj'
    ),
    (
        19,
        '',
        'Deshan',
        '22001573',
        '2025-04-22',
        '17:39:00',
        '18:40:00',
        'Conduct a session',
        '0702513065',
        NULL,
        'ghjhg',
        'lkjh'
    ),
    (
        20,
        '',
        'Deshan',
        '22001573',
        '2025-04-22',
        '13:33:00',
        '01:27:00',
        'Conduct a session',
        '0702513065',
        NULL,
        'Instructor',
        'hjhkj'
    ),
    (
        21,
        '',
        '',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        'hjhkj'
    ),
    (
        22,
        '',
        'Prabhatha',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        23,
        '',
        'Prabhatha',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        24,
        '',
        'sdsds',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        25,
        '',
        '',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        26,
        '',
        '',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        27,
        '',
        'fdf',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    ),
    (
        28,
        '',
        'dsds',
        '',
        '2025-04-22',
        '00:00:00',
        '00:00:00',
        '',
        '',
        NULL,
        '',
        ''
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
ADD PRIMARY KEY (`VisitorID`),
ADD KEY `ParentID` (`ParentID`),
ADD KEY `NID` (`NID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
MODIFY `VisitorID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visitor`
--
ALTER TABLE `visitor`
ADD CONSTRAINT `visitor_ibfk_1` FOREIGN KEY (`ParentID`) REFERENCES `parent` (`ParentID`) ON DELETE NO ACTION ON UPDATE CASCADE;

CREATE TABLE `timeslots` (
    `SlotID` int(11) NOT NULL,
    `DoctorID` int(11) DEFAULT NULL,
    `Slot_Date` date DEFAULT NULL,
    `Start_Time` time DEFAULT NULL,
    `EndT_time` time DEFAULT NULL,
    `Status` enum('available', 'booked') DEFAULT 'available'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `timeslots`
--

INSERT INTO
    `timeslots` (
        `SlotID`,
        `DoctorID`,
        `Slot_Date`,
        `Start_Time`,
        `EndT_time`,
        `Status`
    )
VALUES (
        1,
        1,
        '2025-04-24',
        '11:00:00',
        '11:30:00',
        'available'
    ),
    (
        2,
        1,
        '2025-04-24',
        '14:00:00',
        '14:30:00',
        'available'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
ADD PRIMARY KEY (`SlotID`),
ADD KEY `DoctorID` (`DoctorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
MODIFY `SlotID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `timeslots`
--
ALTER TABLE `timeslots`
ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`);

CREATE TABLE `skills` (
    `SkillId` int(11) NOT NULL,
    `Skill_Name` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO
    `skills` (`SkillId`, `Skill_Name`)
VALUES (1, 'Cognitive'),
    (2, 'Communicaiton'),
    (3, 'Critical_Thinking'),
    (4, 'Emotional_Control'),
    (5, 'Creativity');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skills`
--
ALTER TABLE `skills` ADD PRIMARY KEY (`SkillId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
MODIFY `SkillId` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 11;

CREATE TABLE `appointments` (
    `AppointmentID` int(11) NOT NULL,
    `SlotID` int(11) DEFAULT NULL,
    `ChildID` int(11) DEFAULT NULL,
    `Booked_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
ADD PRIMARY KEY (`AppointmentID`),
ADD KEY `SlotID` (`SlotID`),
ADD KEY `ChildID` (`ChildID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`SlotID`) REFERENCES `timeslots` (`SlotID`),
ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`);

CREATE TABLE `skill_scores` (
    `id` int(11) NOT NULL,
    `ObservationID` int(11) NOT NULL,
    `SkillID` int(11) NOT NULL,
    `Score` int(3) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `skill_scores`
--

INSERT INTO
    `skill_scores` (
        `id`,
        `ObservationID`,
        `SkillID`,
        `Score`
    )
VALUES (47, 82, 1, 1),
    (48, 82, 2, 1),
    (49, 83, 1, 2),
    (50, 83, 2, 2),
    (51, 84, 1, 3),
    (52, 84, 2, 3),
    (53, 85, 1, 1),
    (54, 85, 2, 1),
    (55, 86, 1, 2),
    (56, 86, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skill_scores`
--
ALTER TABLE `skill_scores`
ADD PRIMARY KEY (`id`),
ADD KEY `ObservationID` (`ObservationID`),
ADD KEY `SkillID` (`SkillID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skill_scores`
--
ALTER TABLE `skill_scores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 57;

ALTER TABLE `skill_scores`
ADD CONSTRAINT `skill_scores_ibfk_1` FOREIGN KEY (`ObservationID`) REFERENCES `observations` (`id`),
ADD CONSTRAINT `skill_scores_ibfk_2` FOREIGN KEY (`SkillID`) REFERENCES `skills` (`SkillID`);

CREATE TABLE `subjects` (
    `Subject_ID` int(11) NOT NULL,
    `Subject_Name` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO
    `subjects` (`Subject_ID`, `Subject_Name`)
VALUES (1, 'Maths'),
    (2, 'English'),
    (3, 'Esthetic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects` ADD PRIMARY KEY (`Subject_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

CREATE TABLE `report_marks` (
    `Mark_ID` int(11) NOT NULL,
    `Report_ID` int(11) NOT NULL,
    `Subject_ID` int(11) NOT NULL,
    `Teacher_ID` int(11) NOT NULL,
    `Marks` float DEFAULT NULL,
    `Submitted_at` datetime DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `report_marks`
--

INSERT INTO
    `report_marks` (
        `Mark_ID`,
        `Report_ID`,
        `Subject_ID`,
        `Teacher_ID`,
        `Marks`,
        `Submitted_at`
    )
VALUES (
        43,
        7,
        1,
        1,
        80,
        '2025-04-24 05:58:23'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report_marks`
--
ALTER TABLE `report_marks`
ADD PRIMARY KEY (`Mark_ID`),
ADD UNIQUE KEY `Report_ID` (`Report_ID`, `Subject_ID`),
ADD KEY `Subject_ID` (`Subject_ID`),
ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report_marks`
--
ALTER TABLE `report_marks`
MODIFY `Mark_ID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report_marks`
--
ALTER TABLE `report_marks`
ADD CONSTRAINT `report_marks_ibfk_1` FOREIGN KEY (`Report_ID`) REFERENCES `monthly_reports` (`ReportID`),
ADD CONSTRAINT `report_marks_ibfk_2` FOREIGN KEY (`Subject_ID`) REFERENCES `subjects` (`Subject_ID`),
ADD CONSTRAINT `report_marks_ibfk_3` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`TeacherID`);

CREATE TABLE `employeeattendance` (
    `AttendanceID` int(11) NOT NULL,
    `UserID` int(11) NOT NULL,
    `Start_Date` date NOT NULL,
    `Start_Time` time NOT NULL,
    `End_Date` date DEFAULT NULL,
    `End_Time` time DEFAULT NULL,
    `Status` enum('Present', 'Absent') NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--
-- Dumping data for table `employeeattendance`
--

INSERT INTO
    `employeeattendance` (
        `AttendanceID`,
        `UserID`,
        `Start_Date`,
        `Start_Time`,
        `End_Date`,
        `End_Time`,
        `Status`
    )
VALUES (
        1,
        29,
        '2025-01-01',
        '08:00:00',
        '2025-01-01',
        '15:00:00',
        'Present'
    ),
    (
        2,
        30,
        '2025-01-01',
        '08:30:00',
        '2025-01-01',
        '14:45:00',
        'Present'
    ),
    (
        3,
        31,
        '2025-01-01',
        '09:00:00',
        '2025-01-01',
        '13:30:00',
        'Absent'
    ),
    (
        4,
        32,
        '2025-01-01',
        '08:15:00',
        '2025-01-01',
        '12:45:00',
        'Absent'
    ),
    (
        5,
        33,
        '2025-01-01',
        '07:50:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        6,
        19,
        '2025-01-02',
        '08:10:00',
        '2025-01-02',
        '15:20:00',
        'Present'
    ),
    (
        7,
        20,
        '2025-01-02',
        '08:25:00',
        '2025-01-02',
        '14:30:00',
        'Present'
    ),
    (
        8,
        21,
        '2025-01-02',
        '08:50:00',
        '2025-01-02',
        '13:10:00',
        'Absent'
    ),
    (
        9,
        22,
        '2025-01-02',
        '08:00:00',
        '2025-01-02',
        '16:00:00',
        'Present'
    ),
    (
        10,
        23,
        '2025-01-02',
        '08:30:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        11,
        14,
        '2025-01-03',
        '08:00:00',
        '2025-01-03',
        '15:10:00',
        'Present'
    ),
    (
        12,
        15,
        '2025-01-03',
        '08:40:00',
        '2025-01-03',
        '14:00:00',
        'Absent'
    ),
    (
        13,
        16,
        '2025-01-03',
        '08:30:00',
        '2025-01-03',
        '14:15:00',
        'Present'
    ),
    (
        14,
        17,
        '2025-01-03',
        '07:55:00',
        '2025-01-03',
        '12:30:00',
        'Absent'
    ),
    (
        15,
        18,
        '2025-01-03',
        '08:00:00',
        '2025-01-03',
        '15:00:00',
        'Present'
    ),
    (
        16,
        1,
        '2025-01-04',
        '08:20:00',
        '2025-01-04',
        '14:50:00',
        'Absent'
    ),
    (
        20,
        5,
        '2025-01-04',
        '08:10:00',
        NULL,
        NULL,
        'Absent'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeattendance`
--
ALTER TABLE `employeeattendance`
ADD PRIMARY KEY (`AttendanceID`),
ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employeeattendance`
--
ALTER TABLE `employeeattendance`
MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeeattendance`
--
ALTER TABLE `employeeattendance`
ADD CONSTRAINT `employeeattendance_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `teacher_subject` (
    `id` int(11) NOT NULL,
    `teacher_id` int(11) NOT NULL,
    `subject_id` int(11) NOT NULL,
    `is_main_teacher` tinyint(1) DEFAULT 0,
    `assigned_date` date DEFAULT curdate()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO
    `teacher_subject` (
        `id`,
        `teacher_id`,
        `subject_id`,
        `is_main_teacher`,
        `assigned_date`
    )
VALUES (1, 1, 1, 1, '2025-02-11'),
    (2, 2, 2, 1, '2025-02-12'),
    (3, 4, 3, 1, '2025-02-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
ADD PRIMARY KEY (`id`),
ADD KEY `teacher_id` (`teacher_id`),
ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
ADD CONSTRAINT `teacher_subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`TeacherID`),
ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`Subject_ID`);

CREATE TABLE `observations` (
    `id` int(11) NOT NULL,
    `StudentID` int(11) NOT NULL,
    `TeacherID` int(11) NOT NULL,
    `Scored_Date` date DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `observations`
--

INSERT INTO
    `observations` (
        `id`,
        `StudentID`,
        `TeacherID`,
        `Scored_Date`
    )
VALUES (82, 1, 1, '2025-04-23'),
    (83, 2, 1, '2025-04-23'),
    (84, 1, 1, '2025-04-23'),
    (85, 5, 1, '2025-04-23'),
    (86, 5, 1, '2025-04-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `observations`
--
ALTER TABLE `observations`
ADD PRIMARY KEY (`id`),
ADD KEY `StudentID` (`StudentID`),
ADD KEY `TeacherID` (`TeacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `observations`
--
ALTER TABLE `observations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `observations`
--
ALTER TABLE `observations`
ADD CONSTRAINT `observations_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `child` (`ChildID`),
ADD CONSTRAINT `observations_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`TeacherID`);

CREATE TABLE `marks` (
    `mark_id` int(11) NOT NULL,
    `student_id` int(11) DEFAULT NULL,
    `subject_id` int(11) DEFAULT NULL,
    `teacher_id` int(11) DEFAULT NULL,
    `marks` decimal(5, 2) NOT NULL CHECK (`marks` between 0 and 100),
    `month` int(11) NOT NULL CHECK (`month` between 1 and 12),
    `year` int(11) NOT NULL CHECK (`year` >= 2024)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
ADD PRIMARY KEY (`mark_id`),
ADD UNIQUE KEY `student_id` (
    `student_id`,
    `subject_id`,
    `month`,
    `year`
),
ADD KEY `subject_id` (`subject_id`),
ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `child` (`ChildID`) ON DELETE CASCADE,
ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`Subject_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`TeacherID`) ON DELETE SET NULL;

CREATE TABLE `monthly_reports` (
    `ReportID` int(11) NOT NULL,
    `StudentID` int(11) NOT NULL,
    `Month` varchar(10) DEFAULT NULL,
    `Year` int(11) DEFAULT NULL,
    `Status` enum('pending', 'completed') DEFAULT 'pending',
    `Submitted_at` datetime DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `monthly_reports`
--

INSERT INTO
    `monthly_reports` (
        `ReportID`,
        `StudentID`,
        `Month`,
        `Year`,
        `Status`,
        `Submitted_at`
    )
VALUES (
        7,
        5,
        'April',
        2025,
        'completed',
        '2025-04-24 05:58:23'
    ),
    (
        8,
        70,
        'April',
        2025,
        'pending',
        '2025-04-22 19:32:07'
    ),
    (
        9,
        71,
        'April',
        2025,
        'pending',
        '2025-04-22 19:32:11'
    ),
    (
        10,
        72,
        'April',
        2025,
        'pending',
        '2025-04-22 19:32:14'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monthly_reports`
--
ALTER TABLE `monthly_reports` ADD PRIMARY KEY (`ReportID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monthly_reports`
--
ALTER TABLE `monthly_reports`
MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 11;

CREATE TABLE `teacher_leave` (
    `LeaveID` int(11) NOT NULL,
    `TeacherID` int(11) NOT NULL,
    `Leave_Type` enum(
        'Sick Leave',
        'Annual Leave',
        'Compassionate Leave'
    ) NOT NULL,
    `Start_Date` date NOT NULL,
    `End_Date` date NOT NULL,
    `Duration` int(11) DEFAULT NULL,
    `Description` varchar(100) NOT NULL,
    `Status` varchar(13) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `teacher_leave`
--

INSERT INTO
    `teacher_leave` (
        `LeaveID`,
        `TeacherID`,
        `Leave_Type`,
        `Start_Date`,
        `End_Date`,
        `Duration`,
        `Description`,
        `Status`
    )
VALUES (
        1,
        5,
        'Sick Leave',
        '2025-02-24',
        '2025-02-25',
        2,
        'sdfsdfsdfdsfdsf',
        'Pending'
    ),
    (
        2,
        1,
        'Annual Leave',
        '2025-02-28',
        '2025-02-27',
        3,
        'sd',
        'Pending'
    ),
    (
        3,
        2,
        'Annual Leave',
        '2025-02-27',
        '2025-02-28',
        2,
        'dfdgsdfgdfg',
        'Pending'
    ),
    (
        4,
        3,
        'Sick Leave',
        '2025-02-27',
        '2025-02-28',
        1,
        'dfsdfsdf',
        'Pending'
    ),
    (
        5,
        4,
        'Compassionate Leave',
        '2025-02-24',
        '2025-02-25',
        2,
        'dfdfdsf',
        'Approved'
    ),
    (
        6,
        5,
        'Compassionate Leave',
        '2025-02-25',
        '2025-02-28',
        3,
        'sadadsadasd',
        'Pending'
    ),
    (
        16,
        1,
        'Sick Leave',
        '2025-04-23',
        '2025-04-25',
        2,
        'sdsdsdsd',
        'Pending'
    ),
    (
        21,
        1,
        'Sick Leave',
        '2025-04-21',
        '2025-04-30',
        1,
        'Beach',
        'Approved'
    ),
    (
        22,
        1,
        'Compassionate Leave',
        '2025-04-25',
        '2025-04-26',
        1,
        'tttt',
        'Approved'
    ),
    (
        23,
        1,
        'Annual Leave',
        '2025-04-25',
        '2025-04-26',
        1,
        'sdsdsdsd',
        'Approved'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher_leave`
--
ALTER TABLE `teacher_leave` ADD PRIMARY KEY (`LeaveID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher_leave`
--
ALTER TABLE `teacher_leave`
MODIFY `LeaveID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 24;

CREATE TABLE `teacherleavebalance` (
    `id` int(11) NOT NULL,
    `TeacherID` int(11) NOT NULL,
    `LeaveType` enum(
        'Sick Leave',
        'Annual Leave',
        'Compassionate Leave'
    ) DEFAULT NULL,
    `TotalAllocated` int(11) DEFAULT NULL,
    `Used` int(11) DEFAULT NULL,
    `Remaining` int(11) DEFAULT NULL,
    `LastUpdate` date DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `teacherleavebalance`
--

INSERT INTO
    `teacherleavebalance` (
        `id`,
        `TeacherID`,
        `LeaveType`,
        `TotalAllocated`,
        `Used`,
        `Remaining`,
        `LastUpdate`
    )
VALUES (
        1,
        1,
        'Annual Leave',
        12,
        4,
        8,
        '2025-04-01'
    ),
    (
        2,
        1,
        'Sick Leave',
        10,
        2,
        8,
        '2025-03-20'
    ),
    (
        3,
        2,
        'Annual Leave',
        12,
        6,
        6,
        '2025-04-03'
    ),
    (
        4,
        2,
        'Sick Leave',
        10,
        6,
        4,
        '2025-03-12'
    ),
    (
        5,
        1,
        'Compassionate Leave',
        5,
        0,
        5,
        '2024-12-10'
    ),
    (
        6,
        2,
        'Compassionate Leave',
        5,
        1,
        4,
        '2025-01-13'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacherleavebalance`
--
ALTER TABLE `teacherleavebalance`
ADD PRIMARY KEY (`id`),
ADD KEY `TeacherID` (`TeacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacherleavebalance`
--
ALTER TABLE `teacherleavebalance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacherleavebalance`
--
ALTER TABLE `teacherleavebalance`
ADD CONSTRAINT `teacherleavebalance_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`TeacherID`);

CREATE TABLE `emergency` (
    `EmergencyID` int(11) NOT NULL,
    `ChildID` int(11) NOT NULL,
    `Description` varchar(200) NOT NULL,
    `Informed` tinyint(1) NOT NULL,
    `AssigneeID` int(11) NOT NULL,
    `Time` time DEFAULT curtime(),
    `Date` date DEFAULT curdate()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO
    `emergency` (
        `EmergencyID`,
        `ChildID`,
        `Description`,
        `Informed`,
        `AssigneeID`,
        `Time`,
        `Date`
    )
VALUES (
        5,
        5,
        'Child was seen fainting and unresponsive',
        0,
        1,
        '09:41:23',
        '2025-04-22'
    ),
    (
        6,
        2,
        'headache',
        0,
        1,
        '09:41:23',
        '2025-02-11'
    ),
    (
        7,
        1,
        'Child fell down while playing in the playground',
        1,
        3,
        '09:42:27',
        '2025-02-11'
    ),
    (
        8,
        2,
        'Child had an allergic reaction to peanuts',
        1,
        5,
        '09:42:27',
        '2025-02-11'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
ADD PRIMARY KEY (`EmergencyID`),
ADD KEY `ChildID` (`ChildID`),
ADD KEY `AssigneeID` (`AssigneeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
MODIFY `EmergencyID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency`
--
ALTER TABLE `emergency`
ADD CONSTRAINT `emergency_ibfk_1` FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `emergency_ibfk_2` FOREIGN KEY (`AssigneeID`) REFERENCES `maid` (`MaidID`) ON DELETE NO ACTION ON UPDATE CASCADE;

CREATE TABLE `meeting_request` (
    `Name` varchar(200) NOT NULL,
    `NIC` int(11) NOT NULL,
    `Email` int(11) NOT NULL,
    `PhoneNumber` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meeting_request`
--
ALTER TABLE `meeting_request` ADD PRIMARY KEY (`NIC`);

CREATE TABLE `maidleavebalance` (
    `id` int(11) NOT NULL,
    `MaidID` int(11) NOT NULL,
    `LeaveType` enum(
        'Sick Leave',
        'Annual Leave',
        'Compassionate Leave'
    ) DEFAULT NULL,
    `TotalAllocated` int(11) DEFAULT NULL,
    `Used` int(11) DEFAULT NULL,
    `Remaining` int(11) DEFAULT NULL,
    `LastUpdate` date DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `maidleavebalance`
--

INSERT INTO
    `maidleavebalance` (
        `id`,
        `MaidID`,
        `LeaveType`,
        `TotalAllocated`,
        `Used`,
        `Remaining`,
        `LastUpdate`
    )
VALUES (
        1,
        1,
        'Annual Leave',
        12,
        4,
        8,
        '2025-04-01'
    ),
    (
        2,
        1,
        'Sick Leave',
        10,
        2,
        8,
        '2025-03-20'
    ),
    (
        3,
        2,
        'Annual Leave',
        12,
        6,
        6,
        '2025-04-03'
    ),
    (
        4,
        2,
        'Sick Leave',
        10,
        6,
        4,
        '2025-03-12'
    ),
    (
        5,
        1,
        'Compassionate Leave',
        5,
        0,
        5,
        '2024-12-10'
    ),
    (
        6,
        2,
        'Compassionate Leave',
        5,
        1,
        4,
        '2025-01-13'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maidleavebalance`
--
ALTER TABLE `maidleavebalance`
ADD PRIMARY KEY (`id`),
ADD KEY `MaidID` (`MaidID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maidleavebalance`
--
ALTER TABLE `maidleavebalance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maidleavebalance`
--
ALTER TABLE `maidleavebalance`
ADD CONSTRAINT `teacherleavebalance_ibfk_1` FOREIGN KEY (`MaidID`) REFERENCES `maid` (`MaidID`);

CREATE TABLE `maid_leave` (
    `LeaveID` int(11) NOT NULL,
    `MaidID` int(11) NOT NULL,
    `Leave_Type` enum(
        'Sick Leave',
        'Annual Leave',
        'Compassionate Leave'
    ) NOT NULL,
    `Start_Date` date NOT NULL,
    `End_Date` date NOT NULL,
    `Duration` int(11) DEFAULT NULL,
    `Description` varchar(100) NOT NULL,
    `Status` varchar(13) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `maid_leave`
--

INSERT INTO
    `maid_leave` (
        `LeaveID`,
        `MaidID`,
        `Leave_Type`,
        `Start_Date`,
        `End_Date`,
        `Duration`,
        `Description`,
        `Status`
    )
VALUES (
        1,
        5,
        'Sick Leave',
        '2025-02-24',
        '2025-02-25',
        2,
        'sdfsdfsdfdsfdsf',
        'Pending'
    ),
    (
        2,
        1,
        'Annual Leave',
        '2025-02-28',
        '2025-02-27',
        3,
        'sd',
        'Pending'
    ),
    (
        3,
        2,
        'Annual Leave',
        '2025-02-27',
        '2025-02-28',
        2,
        'dfdgsdfgdfg',
        'Pending'
    ),
    (
        4,
        3,
        'Sick Leave',
        '2025-02-27',
        '2025-02-28',
        1,
        'dfsdfsdf',
        'Pending'
    ),
    (
        5,
        4,
        'Compassionate Leave',
        '2025-02-24',
        '2025-02-25',
        2,
        'dfdfdsf',
        'Approved'
    ),
    (
        6,
        5,
        'Compassionate Leave',
        '2025-02-25',
        '2025-02-28',
        3,
        'sadadsadasd',
        'Pending'
    ),
    (
        16,
        1,
        'Sick Leave',
        '2025-04-23',
        '2025-04-25',
        2,
        'sdsdsdsd',
        'Pending'
    ),
    (
        21,
        1,
        'Sick Leave',
        '2025-04-21',
        '2025-04-30',
        1,
        'Beach',
        'Approved'
    ),
    (
        22,
        1,
        'Compassionate Leave',
        '2025-04-25',
        '2025-04-26',
        1,
        'tttt',
        'Approved'
    ),
    (
        23,
        1,
        'Annual Leave',
        '2025-04-25',
        '2025-04-26',
        1,
        'sdsdsdsd',
        'Approved'
    ),
    (
        24,
        1,
        'Sick Leave',
        '2025-04-04',
        '2025-04-24',
        21,
        'joijoij',
        'Pending'
    ),
    (
        25,
        1,
        'Sick Leave',
        '2025-04-10',
        '2025-04-16',
        7,
        'I have to go to see my parents in Nuwara Eliya',
        'Pending'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maid_leave`
--
ALTER TABLE `maid_leave` ADD PRIMARY KEY (`LeaveID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maid_leave`
--
ALTER TABLE `maid_leave`
MODIFY `LeaveID` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 26;

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        16,
        2,
        'Aahil',
        'Arshad',
        '2022-03-04',
        'Ali',
        'Abu',
        '',
        'English',
        'Shrimp , Egg',
        'M',
        0xffd8ffe000104a46494600010101004800480000ffe109be687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d22584d5020436f726520342e342e302d4578697632223e203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e203c7264663a4465736372697074696f6e207264663a61626f75743d222220786d6c6e733a64633d22687474703a2f2f7075726c2e6f72672f64632f656c656d656e74732f312e312f223e203c64633a63726561746f723e203c7264663a5365713e203c7264663a6c693e566563746f7253746f636b2e636f6d2f34313536323034343c2f7264663a6c693e203c2f7264663a5365713e203c2f64633a63726561746f723e203c2f7264663a4465736372697074696f6e3e203c2f7264663a5244463e203c2f783a786d706d6574613e2020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020203c3f787061636b657420656e643d2277223f3effdb0043000403030303020403030304040405060a06060505060c0809070a0e0c0f0e0e0c0d0d0f1116130f1015110d0d131a131517181919190f121b1d1b181d16181918ffdb0043010404040605060b06060b18100d101818181818181818181818181818181818181818181818181818181818181818181818181818181818181818181818181818ffc000110801f401c503012200021101031101ffc4001d000100010501010100000000000000000000070304050608020109ffc4004e10000103030104060607050602090501000100020304051106071221311341516171810814223291a12342527282b1c1153362a2d124435392c2e116b2344463738393a3c3f0175455d2f164ffc4001c0101000202030100000000000000000000000506040701020308ffc400431100020102020607060404030803000000000102030405110612213141511361718191a1d1072232b1c1f0144252e1152333721662a217348292b2c2d2f14354e2ffda000c03010002110311003f00efe44440111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011110044440111789a6869e9df3d44ac8a2602e7c8f706b5a075927904dc72936f247b4518dff006d9a7edd33e9ecf492dd646f0320774517912093f0c77ad59db78bdf4996d8ede19d85cf27e39fd145d5c66d29bd573cfb36962b6d13c52bc35d52c975b4bc9ed2774511da76ed6d9a46c779b2cf4a0f0e969e4128f120e08f9a92acda82cda868fd6acd7186ae31ef061c399f79a788f30b26defe85c6ca53cdf9f81817f82ded86db8a6d2e7bd78acd19244508ed276a734b51369fd3152638584b2a2b633ed3cf5b587a87f175f570e6bdbda7694f5ea772e6309c22be275ba1a0bb5f04bef81bf6a6da5e98d3323e9a6a975656b781a6a5c38b4ff11ce1be19cf728dee3b75be4af22d768a1a567519cba577c8b47c9452492724e4a2a7dc63b7355fbaf55757a9b52c34330eb68ae923d24b9bf45b3c73240ffeb36b7dfcfac5163b3d5c63f3592a1dba6a385c057db2dd54cebdc0e89c7cf247c945a8b1638a5dc5e6aa324aa68e6193593a11ee597c8e8cd3fb62d2d7891b4f5e64b4ceee03d6083193f7c72f301482c7b248db246e6b9ae190e69c823b42e325bd680da3d7e94ac65156c9254d9deec3e127261cfd667eade47c54d5869037250b9ddcfd4a8e33a0d0507570f6f35f95f1ec7f47e274a22a54d534f5947155d2cad9a09581f1c8c390e6919042aaad49e7b51ad1a69e4c2222e4e022220088880222200888802222008888022220088880222200888802222008888022220088880222200888802222008888022220088880a55353051d1cb57552b62822617c9238e035a06492b9b75fed0ebb575c1f4b4cf7d3da2377d1419c1971f5dfda7b0721e3c56f7b70d49252db2934d53485aeaafa7a8c1e3b80e1adf02e04fe10a0d551c7b11939bb6a6f62dfd7d46d2d0ac0a11a4b10acb393f87a973ed7f2ed0888ab26c20aeadd73b85a2e0caeb655cb4b50cf76489d83e07b477156a8b94dc5e6b79d6708cd38c9669928dc36c971b8ecfa6b5be9cc17697113eaa2e0d74641de701f55c7976712463928b9117bdc5dd5b869d579e4b230ac30cb6b0528db475549e6fef975700888b1ccf0888802222026fd87ea692a28aab4bd5485c69c7ac5364f26138737c8907f1152adc2e56fb550bab2e5590d2c0de724cf0d1e1c799ee5caba57514fa5753c37aa7844ce89af6f44e7603f79a471eec907c952bf6a3bc6a5b91aebc563e77fd46726463b1ade407ff0e5592d31c56f6aa9b59c96c5d9c0d7f89e86bbdc4655a32d5a72c9be79f1c979e6f9f126bbb6dbf4d51c8e8ad947577123ebe044c3e04f1fe5589876f9119713e977b23ed6560711e4583f350aa2c39e3b79279a965dcbea4b52d0bc2a11d5941c9f37279f934bc8ea3d31b44d33aaa414f4554ea7ac23fe8b52031e7eef121de472b6b5c671c924333658a47472308735ed382d23910574c6ccb5749aaf486f56bc3ae146e10ce7edf0f65fe633e60a9ec27187752e8aaaf7b87594bd27d158e1d0fc4db36e9ee69ef5cb6f2fbda6e8888a78a4844440111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011150a9aea2a26875656414ed3d7348183e6570da5b59cc62e4f28acce6fdadd5beab6af7161396c0d8a26770dc04fcdc5690b6eda73e9a6da85cea28eaa1a982531bdb242f0f69fa3683c47782b515adaf9e77151f5bf99f40e0d151b0a092fc91f920888b1492088880222200888802222008888022220088880293762577a6b76b0ada4acac869a3aaa61b9d348181f235e30d193c4e1cee1e2a325aeeb1b7d7dcacd0d35053999e260f700e030035c3acf7a9ad1ca54eae2546156a2845bdb27924964f9e4bcc81d2784e785d78d38b94b2d892cdb79ae08ef045f9fd61d59b59d121bfb16ed78a7819ca9f7bd6211ff0086ede68f829574b7a5a5d699eda6d69a6e2aa68e0ea9b73ba2907798dc4827c0b56e19e8bd5a9173b1ab0ad15fa64b3f9e5e6682a956741eadcd3941f5a68eac45a3690dafecf75b747159b5040cac7f014559f41367b035def1fba4ade557abdb55b796a568b8be4d647ac67192ce2f30888bc4ec11110044440111100444401111004444011110044440111100444401111004444011110044440159dd6eb4165b4cd73b9d4360a685b973ddf2007593d415e2e78dafeac96f1aadf63a694fa8db9c585a0f07cdf589f0f74781ed58188df2b3a2ea6f7b9769358060f2c56e951cf28adb27d5eac6acdb05faf13c94d637bed5439c0730fd33c76977d5f06fc4a8f269e6a89dd3544d24b23b8b9f238b89f125534542b8baab712d6ab2ccddb6386db58c3a3b7828af37daf7b0888b1ccd088880222200888802222008888022220088880222200888802c7dcec96dbb445b594cd2fc604ade0f6f9ac822c8b5bbad695156b79b8c96e69e4cf0b9b6a5734dd2af1528be0d66889afda7aaac5543789969de7e8e6031e47b0adc7456ddb689a28c704176374b7b787a95c8999a07635d9de6f8038ee59fb850c172b74b4552dcb2418cf5b4f511de143b594b2d0d7cd4730c3e27961efc75afa374234969e93da4ad7108a955a7bf67c4bf52e4f83cba9adf92d07a67a35fc0ee235ad5be8a7bba9f2ece2bbf96676a684f492d0baacc5457979d3b717606e563c181e7f865e007e20df3531b1ec9236c91bdaf63865ae69c823b42fcc15bf681db16b7d9ecac8ad3723556d072eb6d6664848ebdde3961ef691df95938a6834259cec6593fd2f7773dfe39f6958a388b5b2a2ef3f4091459b39dbd68cd7fd150492fec6bcbb03d46ade3123bfeca4e01fe1c1ddca535afaeeceb5a5474abc5c65d7f7b4938548cd67179844458c77088880222200888802222008888022220088880222200888802222008888022a553554d45472d65654454f4f0b4be49a5706b58d1cc927800b9676b5e92f3d599f4f6ce667c14fc5935e7187c9da2107dd1fc678f6639993c2f08b8c4aa747416ce2f82edf4de78d6af0a4b391306d1b6d7a5b40cc2d2c905d2fd210c65040e1f444f232bbea0eee2e3d98e2b9fe69a4a8a892799e5f248e2f738f3249c92a13a7aa7b6ef156cf23a478984af7bce4b8ef64927aca9a0105a08390791513ed27048615f85841b79a966f9b5970e197d4d8feccabaad1b993df9c7c3de3ea222d5c6d3088880222200888802222008888022220088880222200888802222008888028e35ed2086ff0015534604f10cf7b9bc3f2dd523ad2b686c0692864eb0f7b7e207f457df667752a18fd18add3528bff95bf9a452fda05b46b60b564f7c5c5af1cbe4d9a12222fa8cf9d40241c8382a70d98fa486a3d2461b4eabe9afb666e1a2473b3534edfe1713ed81f65de4472507a2c3bec3edefa9f45711cd7cbb1f03d29d595379c59fa4fa5f5669fd65618ef3a6ee70d752bf812c38746efb2f69e2d77715995f9bba4759ea3d0da81978d3771929271812339c7337ecbdbc9c3f2e63078aecdd946dcb4f6d1e9d96eaae8ed7a81adf6e85eef666c73742e3ef0ebdde63bc0cad578ee8ad6c3f3ad47dfa7e6bb7d7c72266daf6357dd96c64aa888aa66684444011110044440111100444401111004444011110044440162352ea7b1e90d393df75057c7474508e2f7712f3d4d68e6e71c7001596b7d7160d01a565bedfea77236fb3140cc192a1fd4c60eb3f20389e0b85b68fb4cd43b4ad4aeb8dde531524648a4a08dc7a3a76ff00a9c7adc789ee1802c98068ed5c527af2f769adef9f52fbd8625cdd2a2b25bccfed676d97eda4d73e829cc96ed3d1bf3150b5ded4b83c1f291ef1ebdde43bcf1316a22dbf696746d292a34239457df890739ca6f5a4f6852868fbc32e5646d348ff00ed34c031c0f3737a9dfa28bd5cdbebea6d95ecaca49376467c08eb07b95734cb46638fd83a09e5523b62faf93ea7b9f73e058b4574825825eaacd67096c92eae6bad7aae24d28b0f63d45457b800638455207b7038f1f11da16617caf7f87dc585795b5d41c671de9fded5c9ad8cfa3ecaf685ed18d7b69a945f15f7bfa82222c332822220088880222200888802222008888022220088880222200888802d2f686e028a859daf71f801fd56e8b11aa74ad4dfb4d1afa22e754d1b9c5b08fef1a40de03bf80c7c15b7412e28db63b6d56bcb5629bdbdb16979b45634ca8d4ad8357a745672696cec926fc932244445f599f340444401548279e96a63a9a69a48668dc1ec923716b98e07208238823b553446b3d80eb0d8c7a464773741a5b68352c86b4e23a6bb3f0d64dd41b2f535dfc5c8f5e0f13d20bf2fd744ec3bd2025b23a9f486b9ab74b6c388e92e529cba97a83243d71f61fabe1eeebad23d12593bab15db1fac7d3c3912b697bf92a789d6e8bcb1ec9626c91bdaf6380735cd39041e4415e96b8254222200888802222008888022220088880222200b5cd6fadec7a0748cfa82fb3eec4cf66285bfbca893a98c1d64fc8649e015eea5d4968d25a5eaf505f2a853d152b379eee65c7a9ad1d6e27000ed2b82769bb48bc6d2b584976b8174347165945421d96d3c79f9b8f025dd7e000164d1dc0278a55d69eca71def9f52ebf91897572a8c725bcb6da0ed06fdb45d5925eaf52eeb065b4d48c27a3a68fecb7bfb4f327c80d51116e3a3461420a95259456e440ca4e4f37bc2222f538088b61d1b6b6dc75089256ef434c3a4703c89cfb23e3c7c947e2d8952c32ceade56f8609bede4bbdecef33b0cb0a9885d53b4a5f14de5d9cdf72da6cfa4b4cb2df4edb8d6c79ab78cb1ae1fba1fd56d488be44c6b19b9c5eee577752ce4fc12e09752fdded3e9ec270ab7c2eda36b6eb24bc5be2df5bfdb7044451449044440111100444401111004444011110044440111100444401111005b5dbe034f6e8e3230ec65de25616d3426a2a44cf1f44c39f13d8b6359f674f2ce6c8bbfaa9e54d10bed334a8b55d45ea8a3c5255bbe91ad1c239399f23c4f8e5682ba62f16ba6bd58ea6d9543e8e666ee71c5a7a9c3bc1c15ce170a1a8b6dd2a2df54ddd9a0798dc3bc758ee5f47fb3dd2278959bb5aef3a94b25db1e0fbb73eee6688d33c1558dcfe2292f72a794b8aefdebbf916c888b6114c088880222203a0760bb757e9a9e0d1bac2acbecaf219495b21c9a227935c7fc3ff97c3975f35cd7b03d8e0e6919041c8217e602e97f477db61a4969b67dab6af34ef223b656caefdd9ea81e4fd53f54f572e58c6bed2ad1a5352bdb45b77c973eb5d7cf9efdfbe52caef2fe5cfb8ea94445ad09608888022220088880222200888802a75151052524b555533218216192496476eb58d03249279000155172cfa4c6d68cd349b38d3d55f46c20dd678cfbcee62007b073777e07510a4f08c2ea62570a853ef7c973f4eb3c6bd654a0e4c8eb6dfb5ba8da46aaf54b749247a7a85e45244723a777106670ed3d40f21de4a8a9116f0b3b4a567463428aca2befc4af4e6e727296f0888b24e81111000093803254b9a774d3f4ed922755022b2ada2595a7ea0faadf119e3de56b9b32d362eda84dceaa3dea5a121c011c1f27d51e5cfe1daa57bec25d4f1ce07b8707c0ff00f3e6b497b54d21738ff09a0f62c9cfe6a3ddbdf77236c7b38c1946a2c46b2daf351f937dfb9779814445a30dcc111100444401111004444011110044440111100444401114c9a2edb6fb86cf6de6be829aa0e2400cb1071c748eed0b32cacddd4dc13cb25991b8a6251b0a4aaca39a6f2f27e84368a74934569690e5d67847dd2e6fe4523d17a5a2765b6680fdf2e77e65487f01adfa979fa10ffe2db6cbe09797a906c71c92c819146e7b8f26b464ac951d9a69487d4e6367d9fac7fa29da968286859b94547053b7ac4518667e0b1179d2f4d5e1d3d206c153cf80f65fe23abc57b7f02705adad9be463ad2b8d496a6aeaae7bfefcc8fa38d9144238da1ad1c000bd2ad534b3d1d4ba9ea62747237982a8af1cb2d865a9297bc9e6144db5bb108aae9b5040cf665fa09f1f680f64f980479052cac4ea5b436f9a56b6da402f92326327a9e38b7e602b0e8ae2ef0ac4a95c37eee794bfb5ec7e1bfb510fa4186ac42c6a514bdecb35dab778eeef39bd17d20b5c5ae0411c083d4be2fa8cd00111100444401391c844407647a3c6d88eaeb4b7476a3aadebe51c7fd9e790f1ac88769eb7b473eb238f5394f0bf32ad773afb2de696ed6baa929ab296412c33467058e0720ffb2efcd946d1e87695a0a1bbc5b915c20c435f4ad3fba971cc0fb2ee63cc73056a8d2dc03f0953f17417f2e5bd727e8fc9ece44d58dcebad496f46f2888a94480444401111004444011150adada5b75b6a2e15d3b20a5a78dd34d2bce1ac6346493dc005ca4dbc9023cdb5ed322d9c6cf9f35248c37aafde828233c774e3da948ec6820f792d1d6b83269a6a8a992a2a257cb2c8e2f7c8f39739c4e4924f324adc76a5afaaf68bb46acbf4a5eca369e828a077f750b49ddf3392e3de4f72d2d6ead1bc1961b6a9497f325b65f45ddf3ccafddd7e967b3720888ac26284444017d00b9c1ad0493c000be2d9b67f69176d77491bdbbd1539f5893c1bcbf9b742c4c42f21656d52e6a6e826fc17d4c9b3b595d5785086f934bc499749591b60d254b405a04dbbd24c7b643c4fc3979059992364b0ba278cb5c3042f48be4ebbb9a9775a75eb3ce526dbef3e89b6a10b6a51a54f628a49771aa56514b47316b812c3eebfa8ab65b93e3648c2c9181cd3cc119546974bc573ad6d3d247207bb9eebb834769ce7828995949cb2a64cc31184639d5d99713535569a96a6b2a1b4f490493caee4c8da5c4f9052dd16cd34f53b5a6abd66ade07b5bf26eb49f06e0fcd6d1436cb7db21e8adf470d3b7afa36804f89e67cd6751c0aac9e751a4bc590f73a594209aa31727d7b17a9015cad95b69ae3475f098a60d0e2dc83c08cf30ad14b9b43d36fba5b5b74a28cbeaa95a43d8d1c5f1f3e1de39f99511a8fbeb476d55c387026309c455f5baa9f9b735d7fb84445864984444017d735cc38734b4e01c118e078859dd27a6e7d457a6c45ae6d24443a793b07d91de7fdfa96ebaff00490aaa36dded70012c0c0c96260f79839103b40f9782cea56156ad19568ad8bcf9f8115718bd0a1731b693daf8f2e59f6fa1162222c12542222008888029fb4e50badba528289e375ec846f8ec71e247c49517683d3525e2f4daea88cfa8d2b839c48e123c710dfd4f778a99559b02b67152ad2e3b1145d2bbd8ce51b68bddb5f6f0fbeb0888ac053c2222031f76b4535da93a3986ec8df725038b4fea3b94755d43516fad7d354b375ede47a9c3b4772955636f5688aed4063386ccde31c9d87b0f715857768aaad68fc5f325b0dc45dbcb527f0bf223345526865a7a87c1330b2461dd734f5154d4135916d4d359a39f75e5aff656bcae898ddd8a677ac47e0fe27e7bc3c96b6a54db0dbbd8b75d9ade20ba9de7f99bfeb515afa8744710fc7e1142b37b72c9f6c7679e59f79a0f48ecbf0788d6a4b7679aec7b7cb3c82222b19081111004444016f3b27da2566cdf68305dd85f25be6c435f4edfef2227981f69bcc7c3912b4645e3716f4ee294a8d559c64b2676849c1a92de7e9c50d7525ced94f71a0a865452d446d9619a3396bd8e1904788570b98fd16f696658a4d9c5dea32e6074f6c7bcf31ce487cb8bc7e2ec0ba7168bc5b0d9e1d732b79f0dcf9ae0fef8963a1555582920888a34f5088880222200b9c3d29b688682cb4fb3eb64f8a8ad02a2bdcc3c5b083ec47f89c327b9a3a9ca7fbf5ea834e699afbf5ce5e8e928a074f2bbaf0d19c0ed27901d6485f9cfaaf5257eaed6771d4973766a2b663296e7218de4d60ee6b4068ee0ae5a19857e2ae5dcd45eed3f3970f0dfe0605fd6d486a2decc3a222db44204444011110052c6c7ade1b4772bab9bc5ef6d3b0f80de77e6df8289d4f9b38a4149b3aa1c8c3a6df99de6e38f900a83ed26f1d0c1dd35ff00c9251eedb2fa170d06b555b13537f9137f4fa9b52222f9e4dd056a5a69ab2ad94d4ec2f91e7002922cf6982d342218f0e91dc6493adc7fa2b0d2f6614143eb73b3fb4cc33c7ea37a87f559f537656dd1ad796f655315bf75a5d141fbabcc2222cf2182d1753ecee9ee533ebacef65354bb8be17708de7b463dd3f2f05bd22f0b8b6a7711d4a8b332ecef6b59cfa4a32c9fcfb4806bf4e5f2d8f22b2d950c03ebb5bbcdff0030c858bc60e0ae925e4b18e392c693da42859e0116fdd9f97fe8b3d2d2f9a5fcca49bea797d19cf14b6eafad706d1d1545413fe1465df92dbec9b35ba5648d96eef1450732c043a477e83cfe0a5a45ed4303a5079d47ade4635d695dc548ead18a8f5ef7e9e45a5b6db4569b7b28a8206c30b7a87327b49eb2aed114d462a2b28ad85627394e4e5279b647bab767beb524972b0b5ad95ded494bc838f6b7b0f772519cf4f3d2d43a0a986486561c399234b48f22ba39595c2d16cbac5d1dc6861a803917b788f03cc79286bcc1a155b9d27aafcbf62cd8669354b78aa75d6b4571e2bd7ef69cf48a629f669a6a579318ab8076472e47f302bec1b35d330bb3236ae71d924b8ff940517fc12e73cb67893dfe2ab2cb3f7bc3f721e631f248238d8e7b9c701ad19256e9a7767571af91951780ea2a6e7d19fdebfcbeaf9f1ee526dbecb69b53716fb7c101e45cd6fb47c5c78957ea42db03841eb5679f57021afb4aea544e16d1d5eb7bfd1799428e8e96df431d1d1c2d8618c61ac6f52ae88a75249648a9ca4e4db6f3611117270111100444406b1ab6cfeb14c6e74edfa58c7d201f59bdbe5f9782d214ba40734b5c01046083d6a34bedb4daef1242d07a277b719fe13d5e5c9446214355f48b8ef2cd82de6b45d09ef5bbb0d0f68b43ebdb3caec0cbe0dd9dbddba78ff297280d74edc6945759eaa89dca785f11fc408fd5731905ae2d230470216def65577af675ed9fe5927ff32fff002517da0db6adcd2aebf345af07fb9f11116d335f844440111100444405e5a2eb5d63bed1de2d93ba0aca499b3c320faae69c8f11ddd6bf44741eafa1d75a02dda9a870d1531fd2c40e4c328e0f61f020f88c1eb5f9c4ba03d16f5f1b36b4a8d135f3e28aedf494dbc7832a5a397e368c78b5a3ad5474c30afc5da74f05efd3dbdab8f86ff133ac2b6a4f55ee67602222d424e044440111789a68a9a9a4a89e46c7146d2f7bdc701ad03249f2089660e70f4aed70692cb6fd05453624ac22b2b434ff0074d2446d3e2e05df8076ae515b3ed0f564dadf69777d4b2177475339e81aefa90b7d98dbfe5033df95ac2deb8161cb0fb28517f16f7daf7f86eee2b97157a5a8e411114b9e011110044440174a69e8052e93b653e31b94b134f8ee8cae6b5d470c622a68e21f55a1bf00b51fb58aad52b5a7cdc9f825ea6c7f6774f3a9713e4a2bc73f43dacde97b58b85dfa495b9820c3dd9e44f50ffe762c229274ed00b7d8626b9b8924fa47f89e43c8616a2b2a3d254dbb917fc52eba0a2f2def619544453e5342222008888022220088880222200888802222008888022220088880222200888802c0eabb7fadd94d431b9969fdb1dedebfebe4b3cbe39ad7b0b1c016b86083d6179d5a6aa41c5f13dadeb3a351545c08897366a2a6f53d5d73a5030d8eaa40df0de38f96174edc690d0dd27a439fa379009eb1d47e185cf1b46a7e8368f70c0c0937241e6c19f9e55afd965670c42bd07c619ffcb24bea75d3fa6aa5952aeb84be69bfa1ab2222de66a7088880222200888802b8a1adaab65d29ae34333a1a9a695b3432b79b1ed39691e04056e8b869359307e8f684d554dadb6796ad4f4dbadf5c803a48da7f7720f65edf270216c4b96bd133596e555db4255cbecc83d7e8c13f5861b234788dc38ee715d4ab4563787fe02f2a505bb7aec7bbd3b8b1dbd5e969a904445127b85137a45ead3a636255b4d04bb9577770b7c583c431c0990f86e0737f1052cae37f4aad51fb536a549a6e1933059e986fb73ca6970f77f208be6ac1a3163f8cc429c5ad91f79f77ef918d775352937cf6103a222dd857822220088880222203d44333301fb43f35d48b9641c104752ea5690e6070e446569df6b2bfdd1ff7ff00d86ccf674ffde57f67fdc5fd9a8fd7af94f4c465a5f977dd1c4fe4a505a4e89a7dfb854d511fbb6060f127fd96ecb5c61d0d5a7adccb0635575ebea7e95f30888b3c87088880222200888802222008888022220088880222202dabee1476ca17d65754321859cdcefc80eb3dca36bced3eb2591d159299b047c84d30de79ef0390f9ac8eacd2daa7515f5ce6cd4a28a3e1031d21000c712460f15866ecb6fc47b55b6e1f8de7fd2a06f6bde5493850834971e2cb6e156b865182a975514a4f8705eaf9e66bf36acd4b3bcb9f7bac07fece42c1f06e17ba7d5fa9a99c1d1deaa9dff7aee907f36566dfb2ed40d196d55bdfdc2478ff004ab29f679aa6104b68a3980ff0e66fea4288742fa2f3ca5e658e375854d6aa70cbb97cccbdab6a35b1384778a28e7675c907b0f1df83c0fc948168bf5aaf94fd2dbaa9b2103da8cf07b3c47ebc941f5963bcd0026b2d7550b4737ba33bbf1e4ad696aaa68aa9953493be199872d7b0e085916f8b57a0f56b2cd75ef30aef476d2ea2e76cf55f56d5f7d874622d1b496bf8ae6e65baf2590d59f65937264a7b0f63be47e4b79566b7b8a7710d7a6f6146bcb2ad6953a3acb27f3ec0888bdcc5349d6949d1dc20ac68e12b375de23fd88f82e6cdacc3d1eb88a403f7b48c767bc39c3f40bab356d374da71d201930bdaff002e47f35cc3b618b17ab6cdf6a0737e0ecfeaa77415f45a4115faa32f967f43be904ba6c09b7f924be797c991b2222dfa6a80888802222008888022220362d05a9e5d1bb48b3ea588bb14752d74ad6f37447d991be6c2e1e6bf46e19a2a8a78e78246c9148d0f63da721c08c8217e612ef0f47dd51ff13ec2ad465937ea6db9b74dc7fc3c6e7fe9967cd6bed3bb1d6a74eee2b77bafb1ed5e79f892786d4c9b8779282222d684b9e259638607cd2bc323634b9ce3c801c495f9b9abafd2ea8d7977d432939aeab927683f55a5c775be4dc0f25dd1b6abf7fc3bb09d475cc7eecb2d29a48f1cf7a5223e1de0389f25f9fab656815a654eadcbe2d45776d7f3444e253daa011116c222c22220088880222200ba72d92f4f65a3987d7818ef8b415cc6ba33484feb3a12d326738a5630fe11bbfa2d51ed5a9676d6f57949af15fb1b13d9e54cabd7a7cd27e0ff007255d170ee58e597adf29f8003fdd6c6b0fa599b9a5a9cfda2e3fcc56616b5b659528aea26efa5ad7137d6c2222f73102228bb5c6b67d44b2d96d1316c0df6679d878c87adad3f67b4f5f873c5bbbb85b435e7dcb999f8761f56faaf474fbdf2466f51ed128ad923e92d4c656d4b781909fa361f11ef797c547771d557fba3c9aab9ce187fbb89db8cf80e7e6b0eb3965d237bbee1f4b4a6380ffd626f659e5d67cb2aa956f2e6f27ab1cfb11b06df0db1c369ebcb2fee97dfc8c26fbf7f7f78ef76e78accda7516a3a1a86b2dd5d5521ea84e6569fc273f2520da766568a4024b9cd25749f647d1b3e0389f8f92dba8edf436f87a2a1a3829d9d9130373e38e6b3ad706b84f5a52d5ecde45dfe92da34e10a7afdbb179edf22c74e5c6e773b28a8bb5b5f43501dbbb8e046f8c0f6803c4781ec59744564a71718a8b79be651eace339b9463927c3904445dcf308888022220088880222200888802c4dc74c586ea0fae5b2073cff0078c1b8ff0088c159645d274e33594d668f4a55a74a5ad4e4d3ead846977d96bdb996c95bbdff006353c0f9380fcc79a902d74d3d1d969696aa6e9a68a26b1f27da206095768bc285952a1273a6b2ccccbac4ee2ee9c69d679e5e211116511e5adca1f58b3d5418c97c4e03c7070b9636c8ce16793fef9a7f91758ae5adb541d153d0371fbba8959f21fd14ce8abd5c7ad65fdcbfd2ce3107ad845d43fb5ffa91102222fa04d5811110044440111100444401747fa23ea334faa2fba56593d8aaa76d64209e4f8ddbae03bc8783f817382deb6337eff8736e7a72e0e7eec4fab14b29eadd9418c93dc37b3e4a271db4fc55856a5c72cd76adabe47bdb4f52ac59fa0c888b4496339ebd2daf269b67f64b131f8756d73a7701d6d898463c332b4f92e4453f7a59dd7d676a369b4b5d9651db8484763e491d9f9318a015bab452dfa1c3297379bf17e9915fbd96b5661111588c50888802222008888029df66553d3ecea9599c98649233fe62efc9c1410a5dd8f55efd96e5439fdd4ed971f79b8ff42a07b4ab6e970673fd128bf9c7fee2e1a0b5fa3c4d47f545afafd0e93d3831a6293ee1fccaca2c569a3bda5a90ff00091fcc565569fa1fd38f622d775fd69f6bf984445ea781a56d07531b55b05aa8e4ddaba96fb4e078c71f2cf89e5f1ee5175b2d55f77ae6d1dbe9dd34879e39347693d416cf269abf6a6d795c2b63929da253d24cf69dd6b338686f6f0030a50b3d9adf63b78a3b7c218de6e79e2e79ed71eb55b76b5710acea54d905b11768dfd0c1ad552a594aa4966f96de7f446b7a776796db606d4dd376baab9ee91f44c3dc3afc4fc16e6000000000390088a7a85bd3a11d5a6b22a575795aea7af5a59bfbdc11117b18c111100444401111004444011110044440111100444401111004444017346de63dc0ce1cabe4f982574bae6fdbf37e881fff00dffe87297d1c796316affccffe9674bcdb87dcaff2affa9105ab9a0b757dd2b5b496ea39aaa77728e16171f1e1d5deb6dd0fb39b8eac94565417d1dada70e9c8f6a5c730c079f8f21dfc94f764d3f68d3b6e14568a28e9d9f59c065d21ed73b992b67e90e9a5b616dd0a2b5eaae1c176be7d4bbf22ad8368bd7bf4aad47a94f9f17d8bebf3211a0d8ceadab804b5325050e47eee694b9dfca08f9ab5b9ec93595ba3749152c15ec6f126924c9ff2b8027c815d14e7358d2e73835a39927002c7497fb444fdc756349fe06970f880a851f68989c6a6bcb532e596cf9e7e65c5683d9d486ad352cf9a79fd3239467a79e96a1f4f530490cac38747234b5cd3de0f254d7515f34de9cd696b2daa8e395e0623aa8b02588f71fd0f05cf7ab34a5c7495f0d0568e922765d0543461b2b7b7b88eb1d5f02b62e8e696db631fcbcb52a2e1cfad3e3d9bfe65231bd1baf85bd77ef439f2ed5c0c0a222b615d0888802f70cb253d432785e59246e0f6b873041c82bc2203f4bec17465f34a5b2f516372ba922a96e3961ec0efd5168db01bafed6f47bd3d239d9929e37d2b876747239ad1fe50df8a2f9f6fa87e1ee2a51fd326bc1967a72d682973395fd212e06e1e90f7f20e594e61a76f76ec4d07f9b79462b6ada6561afdb2eaaaace43aed521a7f844ae03e402d556f5c329745694a9f28c57915caaf39c9f5844459a798444401111004444016ff00b23ace875754d1b8e1b514c481dae6b811f22e5a02cf689adf50d7d6b9c9c033088f83f2cff5283d25b4fc5e1571456f717976adabcd12b815cfe1b10a3578292f07b1f91d95a4a4dfd311b7ec3dcdf9e7f559c5abe889b7adb55067dc903be231fe95b42f9e6d5e74a2cd97884756e66bafe7b42222c830c222200888802222008888022220088880222200888802222008888022a355574b43452d65754c34d4f134be49a678631807325c7800a0bd65e973b2ad315aea1b54b5da96a1a70e7db58042d3ff0078f203bc5a1c3bd323aca6a3bd93d22e7ed31e987b28be55b296ecdbb69f91c71d2d6c024873f7a37388f12d03bd4ef6eb95beef6b86e56aaea7aea39dbbf154d348248e46f6b5c09042642338cb732e91110ec1445acf4ad2eabbf18ae0e70a4a7ad333d8de065c0737773d43278fff000a97568952e0fad99e3eb48e77c495d3a6a942a42b5296528ee7dd912387d18555529d459c5a59f8e7f42de1861a6a7653d3c4c8a28da1ac63060340e40058ebadf29adad318fa59c8e1183cbbcf62a1a975053d8adc0ba402a25c88dbccf79c28c67d46e7cae7b6073c9392e91dc4a8cad55e7b37970b0b18d45af53e1e5cff006364adb9d65c242ea99896f5307068f2568b114d7d8a49032a23e8b3c9c0e479acb8c1191c9613cf8963a4a0a39437171455b51415427a77eeb8731d4e1d8566f5559a975be819638983d65ad32d39eb64a07bbe07979e56b8b64d2352454cf464fb2e6f480778e07f31f059d86ded4b4af0ad49e4e2f35da888c730fa7776d2535c327d9fb6f399c8209041047305167359d1b28768178a68c6eb1b56f2d03a812481f35835f54db5655e942aadd249f8accf98ebd274aa4a9bde9b5e011117b1e4111101d8de89b70351b22b95bdc72ea5b9bc8ee6be3611f30e45a97a265ea0a0a3d574d5526eb37e95ecf122507fe508b4ae935b4a389d6d55b334fc526582ce69d18e673bdfe7f5ad5773aace7a5ab964f8bc958e5ee5799277c879b9c5df12bc2dd108eac5479100f684445d8e022220088880222200bd4523e19992c6ec3d8e0e69ec217945c349ac99ca796d4761ecf6e2caa95b2b0fb1574cd95bf0047c89520a81764178ded35699dcfe34d21a790f60c91ff2b829e97ccb3b6769715ad1fe4935dd9ec3705dd4e9e14ae97e78a7df96d0888b930822220088880222200888802222008888022220088880222200a1ddb17a45690d954525b2322f5a8cb7d9b6c0fc0873c8ccfe3b83af778b8f0e001cad1fd25bd22aab4354cda034549b97e7c4d7565c39fa935e321ac1fe21690727834118c93ecf1450dbef9aa3500a4b751d7ddee956f2ee8e163a79a6713924e3249eb257648c5ab5f2f763bcda7689b5fd79b4fb8ba6d4f7991d481dbd15b69b31d343d9866789fe2765ddeb455d2fa0bd0d759dedb1576b8b9c1a7295d871a58b15154476100ee33e2e23ac2e90d1de8e5b23d16c6494da622bb5633feb778c553c9ed0d2371a7bc3426b247946dea54dacfcf8d3ba1759eae90334ce97bb5d46705f4b4cf7b1be2f03747995d99e8adb38daa6cf1f798b59530b7596ae263e0a092a592bc4e1def86b090ccb720f104fb3c382e8c8db1c30b62858c8e360c358c180d1d802fbbebab91974ad141e7995b797d0e56fbcbe87f7aeb9991a85773c36373bb065683d6b75a87e28a63d8c3f92d2978567b895c2e39293ec22dda54550dd4b04cf07a17401b19eac871c8f1e23e21696a78bada68af36e751d745bec3c5ae1c1cc3da0f5150fea3d3f51a7ae9ead2bc4b13c6f452818de19eb1d4547d4834f32e16371194553e28c3ad92c95066a031b8e4c4703c3abf55adace69e69dda877512d1f9af096e2528bf78cd2cde956937d247211127e216116c9a67a3a4a1aebad41dd8a26717760682e77e8b9a1072a8923ae235153b79b7c88275eccd9f6957a7b790aa733cdbec9fc96baabd6d5495d72a8ad97df9e574aef17124fe6a82fac2ca87416f4e8bfca92f0591f2bdcd5e96b4ea736df8b0888b24f008888090b65d7e364fdab876ef4dd0fcb7ff00aa2d228ab5d47d26e977b78e5dd9fea8a1aeb0a857aaea35bcc8a759c6391698c1c145715f174175aa808c74733d98f0710add4c279accc70888b901111004444015cd15b6e17298c36ea1a9ab9073641139e47900b78d9f6cd67d4fbb75ba97d3da9a7d90de0fa823986f637b4f90ed13c5b6d76fb3d03286d947152c0ce4c8db8f33da7bcf1547d20d37b7c366ede847a4a8b7edc92ed7c5f52f12d78368ad6be82ad55ea41eee6ff6eb39824d1dab228f7dfa6eea1a39914af38f92c4cd04d4f298aa219229073648d2d23c8aec056b5d6db7dca9cc171a1a7aa8cfd49a30f1f355eb7f697514bf9f4165d4fd53fa1335b416197f2ab3cfad7a10e6c76bb34b73b6b9deeb993b0788dd77e4d5d3f66acf5eb1d3d41397166ebbef0e054476fd9fd86cd7e7dd6ccc968df246627c01e5d1b8120e70788390391c772dfb484f253cb3db66e4efa48cf567911f97cd5231cbfa1798aceeed9350a896fe0d2c9f3e5e6582d6c2ad0c2e342b34e54dbddc537f7e06d8888b148f0888808736d9e909a736494e2d90c2dbbea4999bf15bd8fdd6c2d3c9f33bea8ec68e27b8715c8177f4a1db5dd6ecfad8f571b7309cb2968a9a264518ec1bcd24fe224abfbefa3efa406aad7376bb57e91a8aaaba9ab92496aa6ac818d792e3c5a5d20cb718c63ab0aa41e88bb6b95a0c967b6c07b24b8467fe5257659183395593d89e451b5fa59edb6def69a8d43457268fa959410807c4c61a7e6a48d37e9c3748dec8f57e88a4a869f7a7b5543a223bc4726f67fcc168327a20eda18dcb6df6893b9b5edfd4058aadf45adb951b4bbfe0c150d1d74f5f4cef97499f92e761d53acb99d95a23d23b64dae5f1d3516a36daeb9f8028aee0533c93d41c49638f735c4a958608c8e4bf2c6edb20da959039d72d9fea2898df7a5650c92307e26823e6a75f443da16b483698fd9c5ce4afacb3c94b248d86a379c6def60c8233c58c3eeeef2cb9b8c71cf191ed4ebb6f5648ed94445d4ca088880222200888802222039b75b7a26d26badbadc759dd356cd0da2bdec9a5a28211d3ef0635a5ad9092d0df6739dd2472c75a9ab466cf7466cf2cff00b3b48d8696dcc2009266b77a69b1d6f90fb4ef3381d585b42a4e28d9d614e29e691f0b9522e5f5c79aa2e72e99995189f4bd79df54cb978de5d733d940afbfdebe87ab7df5e9ae4cc6a15677668a61fc0efc96a0b6c3edc6e6f68c2d4d7955e04861eb25241463b4cab8e5bdd2523082e8622e777171e5f019f35272822f3515157a8ab66a924cae99c083d583803cb002c4aaf6645830ea79d472e4582daad74c696dcd6b861eef69cb1f6bb5383c54d53718e2d61fccace2c393e058e8c32dacfad6b9ef0c602e738e001d655ced1ae0dd35b2bfd971bc0a9ae3d070e783c643e18f67f1059dd33683bc2e552dc0fee9a7aff8bfa285f699a986a3d6b28a7937e8a8c182020f071cfb4ef33f2015d74130677d88c6a497bb0f79f76e5defc93285a798dc6dece5460f6cb67af82f36698888be86343844440111101f435cef75a4f8045b0696b53ae7eb7bac2ee8f73977ef7f4458952f214e4e2cef1a6dacca5ad294d16d235051118305cea62c7dd95c3f45835bd6d9e87f67edf355418c6f573a7ffcc024ff0052d1576b2a9d25bd39f38a7e42a2ca4d0444592740888802d8b4469a76a9d614f6d76f0a76fd2d438754639f99240f35aea9af6196f636d175ba96e5f24cda707b0346f1f8ef0f8281d26c4a58761b56bd3f8b72ed6f2cfbb7f712f80d8c6f6f69d19fc3bdf62dbe7b890ae371a5b0dba2a5a58580b58190c2d186b1a380f25ad3f515ddef24556e8ec6b1b81f2542ed54eacbc4f31396ef6eb7c0700ac97ccd56b4a726f33e93b2c3e952a6b5a29b32f1ea5bbc67da9d920ec7b07e98592a5d5c090dada5c7f1c47f43fd56a155531d25319a53c070007327b16026bd56c8e3d1b9b137a8019f995d61527c19deb5a5b3d8e3e1b09ba92b696ba1e929666c83af1cc7885794d3be9aa993b3de61cf8a81a92ff77a1aa6d4535639af1dc083dc7b94c963ba36f360a7b8b5bb8646fb4d1d4e07047c42cba5535bb480bcb354b76d8b24d86564d03268ce5af0085eb782c169fabdea77d238f167b4df03cfe7f9acb972918cb5966536b5074e6e054df5f37fbd51de5f37d7399d140ae1fdebe872b7df5e839331a85c020afaa8b5caa35cb94ce8e391e97cdd68797868de2305d8e242fa8b93a84444011110054e4a8a784e259e38cf639c02c6deae868e314f03be99e324fd91fd56ace739ee2e738b9c78924e495e33abaaf24485b583ab1d793c91beb1ec91bbd1bdae6f6b4e42f4b4eb636e6d9c3e863791d791ec9f1ea5b7b0bcc6d3200d76388072015de13d65b8f0b9b7e86592799e911177318f8792a2e3cd5572a0e5c33d208a4e2a838f3555fccaa0e5e6cca823c39ca917afae2a8172e99991189543fbd546b95a872aac2899d9c4ba6b96b9551f475b2b3b1c71e0b606158abbc5bb50d987270c1f10bad459accf4b496acdae663969d7fd36c8ebe4bad152b5c643bd2eeb72e0eeb3e056e28b1a705259326adae25427af12328e29259047146e7bcf26b464ad92d1a65c1cda8b90181c5b0f3cfdefe8b68000248038ad6b596b4b7690b499677366ad901f57a5078bcf69ec6f7af4b1c36a5d568d1a31d693dc8f7c431e54e8ca72f722b7bfbffd984da96b2669fd3e6cf4128171ac6168dd3c618b882eee2790f33d4b9f15e5d6e95b79bbcf73b8cc65a899dbce71f901d80720159afa2b46f02860f68a8adb37b64f9bf45c3c789a1b1bc5a7895c3aaf6456c4babd5f10888a7c870888802222026ff477d32fd45ff11eec7bfd07ab7567dee97ffd51489e88743d1e8fd4972c7efeb22833f7185dff00b88b5269262b569e2356107b165f244dda518ba49b231f49fb69a1dbe4f55bb815f4305467b700c5ff00b4a1a5d37e97b682dadd337e63783d935248eecc16bd83f99ff05cc8affa355fa6c328cb92cbc367d08cbb8ead5920888a70c708888029d761f3b1da36e34a08df6569908ee731a07fca5414a44d8e5f5b6cd6b25b277eec3718fa319e5d23725bf2de1e242abe9959caeb09ab186f8e52f079bf2cc9fd18b98dbe234dcb73d9e3bbccdc4821c41e7d6be2c8dee8cd15e66663d879e9187b8ffbe42c72f9a9ac9e47d354e6aa414d713037f9099e28b3c0377be7fecb0eb397f849115401c07b27f4fd560d7a47718d57e267a8e3926999144c2f7bc86b5ad19249e414e3a7ad86cfa6e96dee20bd8dcbc8fb44e4fcca8bf421a61ada9bd640248708f3c83f1c3f5f3c298d64518f121711a8f354f86f2e286a0d2d7c72e780387781e6b6b2fef5a62d92867e96dd1b89cb80dd3e4b3694b7a2b57d4b3ca65d97af3bfdea9972f3bfdebd7330540ae1fdebd35ead83d7b6bbb1330e05d35caab5cad18e55d8e5d933c6512e5a72bd2a4c2aa8e2176463b4111172701111016d2d051cd29925a763de79b88e6bd47434711cc74b0b4f6860caae8b8c91dfa49e596611117274088012700649ea0b13ac350d1688d252ea2bec733295af6c6c631a37e57bb935809193804f80257126a29c9ee476845ce6a11dadec48ca395b4ae6c6c73dee0d68e25ce38017356a7f487d4f7373e0d3b49059e9cf012b809a623c48dd1f038ed516dd2fd7bbdce66bc5dab6b9f9ce6a2673f1e009e1e4a2eae294e3b20b3f22d369a2f71359d6928f9bf4f33b5db75b5cd37450dca92490f0dc64cd27e19551dc970a2deb456d5351e92ac8e29aaa5b8daf2049473bcbb7476c6e3c5a7bb9772f2a78a45bca71c8ccada3338473a53cdf26b23aa5c39aa2e0a9da2ed417fb1d3dded9389a96a19bec775f7823a8839047685725aa4564d6688059c5b4f7a2835b855981035546357290723db16adb4baabadb76735778b348d6d4d0bd93eeb9bbcd9180e1cd23b3049f25b5b02b7bcdbdb74d3371b63c65b534b24247de691faaccb19c29d784ea2ce29acd3dcd67b57818573ace9c941e4f2d8fac80ed9b72a47461b79b24d1bc737d23c3c1fc2ec63e25655db6bd24d8f79b4b7571fb22167ffba80916e4aba07845496b2835d4a4f2f3cca353d2ec4611d5724fb5225abd6dbeae681d0d86d4da671e02a2a5dbee1e0d1c33e24f828babebeb6e75f2575c2a64a9a890e5d248724ffb772b6453b86607658626ad69a8b7bdef6fbdedeedc44dfe2b757cf3b89e6970dcbc1044452a478444401111004444076efa30db4d06c069aa4b71ebf5b3d4f8e1c22cffe922ddb65d68362d8ce99b639bbaf8edf13e46f63deddf70ff338a2d078ad7e9ef6b555c64fc33d8596847569c5751a4fa4dd8cddb60f515ac66f496cab86ac639ee9263779624cf92e225fa51aaec91ea4d0d77d3f26315f472d3827ea9734807c8e0f92fcda9629209df04cc2c92371639aee6d20e085b0f412eb5ed6a507be2f3ee7fba645e230ca6a5ccf0888af24704444017b866969aa63a88247472c6e0f63da705a41c8217845c349ac99ca796d474759aeb4faf743455f0ee36e107b1346386ebc0e23c1dcc7fb1586734b5c5ae04107041ea515e8dd5959a4750b6ba0cc94efc32a20cf0919fd47307fa953d4f4941a9ad315f2c5332413377b8700fee3d8e1c97cf7a67a2f3c2ee5d5a2bf952ddd5fe5eee1cd76337b685694c2f287415dfbf1dfebd8f8f27da6a9342ca8a774320cb5c30b55aba3968e731c8323eabba9c16e1246f8a4747231cc7b4e0b5c3042a52c314f118e5607b4f515484f2360ce0a6b3469d149243332689e59231c1cd734e082391530692d511ea0a230ce032ba16832347278e5bc3f51d4a399ec00b89a79b03ecbc7eab60d0569aba5d4efa87c9196081c1dba4f1c91dcbde94f6e488abeb6ce9b9496e24a595b449f432c7d841f8fff00c58a57f6a762a246f6b33f359b07932b1711ce9b328e72a7bc8e2a8972f6cc8f8c4aed72aac7655ab0aacc2899c4a25d30aacc2ad99d6ae18bba31a48b8615adea9da3e90d1a0c57abab45563229201d24a7c5a3ddf17602d776bbafe4d13a4990db5ed176af26381c78f44d1ef498ed1900779ee2b93e79e7aaa992a6a669269a4717be491c5ce713cc92799581777fd0bd482cd93584603f8c8f4d59e50e196f7fb1d115fe9336c8e422d9a52aea1bd4ea9a96c27e0d6bbf3575a43d21a82f7ac692d37fb4c566a2a97747ebc27e9444e3ee97821bece78139e19cf2cae69451cb12afad9b658e5a3762e0e2a3937c7379aebe5e47e8f7fc38fc65b58d70c73dcc7eabc8d393678d4c78f02b9e7617b7f86df4b4da2f5dd66e53b311d0dd253c231c84729fb2390775723c388ea68dec9626cb13daf6380735cd39041e441566b5ab4ae21af0f0e46a9c56def70cace8d6ddc1e5b1aeaf4e060469b79f7ab1a3c199fd5556e9b8c7bd54f3e0dc2cda2cae8e3c88a77b59fe6f9189669ea16fbcf99fe2e03f20ae23b45ba3e54c1c7b5c49fcd5f2b5b85cadf69a07d75d2ba9a8a963197cf532b63637c5c4809ab15b4e9d3d69bc949b2b32286069e8e38e30071dd002e21dbfed35baf35efeceb5546fd8ed45d153b9a7d99e4e4f97bc70c37b867eb15beedbbd2128ae567a8d21a06adf2c53831d65d1a0b4167231c59e273c8bbb380ce72b99957715bf8cd74349ece26cbd0fd1da96eff1d751ca5f953debadf5f05d41111411b002222026ff0047abfcdebf73d313485d0ba3f5c8413eeb810d781e3969f253d6e2e69f47fa7926dab492301dd8a864738f717347e642e9ddcee561c39b95159941c7e3185e3d5e2932806772f4d6aa9b9dcbd062cec884733cb5abecf332928a6aa94e19131d238f70192aab5ab46db0ea28f4eec9ee389036a6bdbea508cf125e0871f266f1f1c2cbb0b495ddc428437c9a5e2625d5c2a34a551f04720a222fa50d4e1111004444011110044440165b4b599fa875bda2c2c049aeac8a9ce3a839e013e40e56254c7e8c9a7cde76e705c1ecde86d34d255b891c3788e8da3c72fcfe1585895d7e16d6a57fd29befe1e67a5186bcd44edc631b1c6d8d8d0d6b46001c8045f516802cc1702edd74d1d31b75be53323dca7ac9057c1c300b65f69d8ee0fdf1e4bbe9736fa5ae9535160b36b2a78f2fa590d0d4b80e3b8fcb984f707070f17856bd0dbdfc3e20a9c9ec9acbbf7af4ef30afe9eb52cf91ca2888b709041111004444016d5a275c5c347dc896035141291d3d293cff0089bd8efcfafbb55458d776746f28ca8578eb45ef47bdb5cd4b6a8aad196524753515469fd656665c28a56ccc231bedf6648cfd970ea3dc5636ab49d5c649a4999337a83bd977f45cfd62d4376d397315d68ab7432727379b241d8e6f58536697daed8aecc653deb76d759cb79e730bcf73beafe2f895a4f48740ee2ce4eadaa7529f57c4bb571ed5de91b6b00d388d48aa55a5a93ebf85f63e1d9f32e1ba7aee64dcf5323bcb9b8fcd6d765b4b6d748e6b9c1f349c5ee1cbb8057f14b14f0b6682564b1b865af6383811dc42f6a8d1a0a9beb2df7188d4b886abcb2ea0af6d7ff4c77dc2b56bf6afd3da6e173ae971899281914ec3bf2bbc1a38f99c0ef5a8685da3d7eabdb352d1b59ea96d30ccd8a9f392f21bbdbcf3d6700f0e43bf9a9eb1c06f2ea8ceea30ca9c136dbd89e5cb9fde6566ff0017b6a12541cb39c9a592ebe7c89a9c39aa45bc55d39b95e373b946e4768c8a2d6aaec0be062aac6a2475948f6c0abb1526055d8177463cd9cb5b7ab8c959b5c968dce3b9434d142d6f50de1d213fcff20a305266de2df251ed8aaaa5ed21b5b4f0ccd3da037a3fce3519aac5d67d34f3e66cbc2f57f074b57f4afdfcc2222c733c2ddf47ed77681a1e9db4962bfca289bca8ea5a26887dd0ef77f090b4845de15254deb41e4cf1af6d4ae21d1d68a92e4d664f34fe965b428e30da8b2e9d9c8fadd0ccd27c712e179a8f4b1da1cad2d82cfa760fe2e825711f1971f250422c9fe2373bb5d913fe1ac333cfa044a375f488dacdd1ae8c6a46d146ee6da3a68e33e4ec170f8a8faed7ebddfaabd66f978aeb94dd5255cee948f02e270b1eae68682aee35629a8a074b21ea1c80ed27a82f09d7a953e393648dbd85b5b7f429c63d8922d914816dd9fd33230fba54be493fc384eeb479f33f257f2e84b0c8cc31b5111ed6499fcf2b854a465664608b72b86cfaae2697dbaad938ff000e41b8ef23c8fc96a9554755435060aba7921907d578c7c3b575716b79c941116e9b35d9f57ebdd50da70d7c56ca721d595407badfb0d3f68f57673ea5cd384aa49463bd9e55ebc2853752a3c9225df479d2d250e97add4d55196bee0f1153e471e8984e5de6e27fca14cdb8bd51d0d2dbedf0505142c869a08c45146c1c18d03000f255773b95aa85154a9a8723565edebbaaf2acf8fcb8143717d0c55b717d0c5eb9189ae52c358d2e710d681924f0017236d835db759eb631504bbd69b7e61a62394873edc9e64003b80ed2a44db8ed4990433e88d3b53995c0b2e15319f7075c2d3da7eb7672eb38e785b5b423479d05fc42e17bcd7bab927c7bf8757694dc7f13551fe1a9bd8b7fa04445b18ac044440111100444401111005d7de89ba68d06cf2e9a9e68f125cea84311239c5102323c5ee78fc2b9160826aaaa8a9a9e374934af11b18d192e71380079afd1ed13a722d23b3db3e9b8b74fa8d2b227b9bc9d2632f779b8b8f9aa569c5ef45671b74f6cdf92dbf3c890c3a9eb5472e46791116a82682d7b5de9887596ce6f1a666ddcd6533991b9dc9920f6a37793c34f92d8517a52ab2a538d483c9a79aed470d26b267e6254d3cf495935254c4e8a785e6392370c16b81c107bc10a9299fd25b451d33b5b7dee962dda1be34d53481c04c384a3cc96bff1a8616fcc3ef23796f0b886e92cfd5773d8566ad374e4e2f804445987408888022220088880bda1bbdd6d6e26db73aba3279f4133999f1c157751ab353d5c663a9d437391879b4d4bf07cb2b0e8b1e7694272d794137cf2599ed1b8ab18ea466d2e59b3e925ce249249e2495b2eceee8cb36d46c97091dbb1b6a9b1bdc7eab5f9613f0715aca723c173734235e8ce8cb74935e2b23ad1a8e9548d45bd34fc0eee2d5e777bd6a7b2fd6116b3d074f52f943ae14ad1056309e3be0707f83871f1c8ea5b9ee2f9beeed2a5a569d0aab2945e4cdb36f731ad4d5483d8ca01abdb5aaa062f6d62c7c8f5733cb1aaab1a8d6aaad6aec91e3291156dcf43cda974632f36e84c95f6bde7963465d2427df03b48c070f0776ae585fa02d181c573fed5361f349553ea3d134c1fbe4c9516c60c107add10ff0047c3b14562164e4fa5877969d1ec661497e16bbc9707f439f917b96296099f0cd1be39184b5cc78c1691cc107915756ab654ddee4ca3a56fb478b9c7931bd64a83cb817716ab4d65e2b852d1c793cdcf3eeb07692a49b4692b55ae20e7c2daaa8eb9656e78f70e43f3590b4daa92cf6e6d252b7bdef3cde7b4abe5950a6a3bce33299a7a773371d0445bf64b461616e1a3ec95e0b853fab487ebd3fb3f2e5f259e45ddc53de706990ecee8db36f4f719a48fecb581a7e3c7f25b4d05b68ad94beaf434ed899d78e6e3da4f5aba45c2825b804445d8056b5f6ea2b9529a7ad81b2b0f2cf36f783d4b67b568fbfddc874144e8a13fdf4fec37c46789f20548163d9ddaada5b3dc1debf38e3878c46d3f77afcfe0b2295acea70d844dee376b689a94b39725b7ff004413a7361776bfdf5b23aa8d2d8b3bceaa78fa470cfbac6f59fe2e5f92e94d3fa7ed3a62c30d9ecb48da6a58870038971eb738f5b8f6ac9001ad0d68000e000ea5f54a5b5a4287c3bf9944c4f17ad7f2f7b6456e5f7bd8445e259628207cf3cac8a2634b9ef790d6b40e6493c82ca4b3d888a3da84b6bdb658ecd1cfa5f49d487dc8831d4d6c67229bb5ac3d6feffabe3cb03b52dba3aadb3e9ed1150e64072c9ee8de0e7f6b62ec1fc5ccf56399818924e49c95b2f463439b6aef108f5a8bf9cbd3c79156c571b593a36efb5fa7af81f5ce73de5ef717389c924e492be222d9e55022220088880222200888802222025bf472d1e7546da692b678b7e8accdf5e9491c0bc1c443c77c877e02bb9543de8dba28e96d904574aa8b72bef6e15926460b62c6226ff94977e3530ad2fa5588fe32fe5aafdd87babbb7f993f654ba3a4b3def6844455b32c22220238db86843aef6475d474b0f4973a2fedb4581c5cf683960fbcdde18edddec5c0cbf50170d7a426cf8e8ada94b5d4506e5a6f05d554fba3d98e4cfd247e44e40ec701d4b6268362993958cdefdb1faafaf891788d1dd51779122222d904484444011110044440111100444406c5a2f595d3446a68eed6d3bed3ec4f4ee386ceccf169ec3d87a8fc0f5d692d5d64d69616dcecb521e0604d03b84903becb87ebc8f52e23593b06a1bce98bcb2e963af9292a59c3799c9e3ecb81e0e1dc555348f45e962d1e960f56aae3c1f53f5e1d64ce158c4ec9ea4b6c1f0e5d87746e2fa18a24d0bb79b0df5b1d06a811d9ee070de9c9fecf29fbc7dcf0770ef52fc4e8e589b2c4f6c8c70de6bda7208ed0569dbfc2ee70fa9d1dcc1c5f93ec7b9977b7bda5731d6a52ccf8d6aa81b85f5161647ab611110e0d5355ece348eb2697de6d6cf5ac6056539e8e61f887bde0e042d26976222c14f232c5716546fbb79c6a9bbaf23a865a0838f00a61458f52d695479b5b492b4c5eeed56ad39ece4f6afdbb884aa743ea8a6277ad6f900fad13dafcf903958f92c17d8b3d259abdb8eb34efc7c70a7d458ef0f8706c9886965c2f8e09f8af539fbf635dfff00c556ff00e43bfa2af1e9bd4129f62c95fe2e81cd1f30a7a45c2c3a3fa8eef4b6af0a6bc5909c1a1754ce462d6e8c76c9231bf2ce5656976617a9306aab29201d80b9eef8600f9a95d17a46c29adf9b316a6945e4be1c9777ab668b45b2fb54443ababea6a48ea6011b4fe67e6b66b769bb1da88750db6063c7291c37ddfe6392b288b221429c3e14455c6277571b2ad46d782f05b02222f530422a357594941452565754c34d4f10de7cd33c31ad1da49e01421aebd2168a8c4b6ed1308ac9f8b4dc27691133ee34f171ef381dc54961b845d6253d4b6867cdf05dafed98b757946da3ad56597cc95b55eb3d3da32d26befb5cd8720f45037da9663d8c6f5f8f21d642e5cda1ed6efdaea67d1b0badf670ef668e3771931c8c8efac7bb90f1e2b4abb5e2e97dbac972bc574d5b5521f6a599d93e03b0770e01592db580e88dbe1b955abefd5e7c1762faefec29d8863356eb3843dd8f9bedf40888adc43044440111100444401111004444016e7b2ad132ebfda95b6c1b8e349bfd3d6bc7d481841771eacf068ef705a62ed3f468d9f1d2db393a96e106e5cef61b280e1c63a71fbb1ddbd92f3dc5bd8a0b48b1458759caa27efbd91ed7c7bb79936b47a5a897026b8a28e18590c2c6c71b1a1ad63460340e0000bd222d20584222200888802d1f6b3a020da2ecd2b2c8031b5f1ff68a195dc3726683804f507025a7b8e7a96f08bdadee276f5635a9bca5179a3aca2a49c5ee67e6254d35451d6cd49550be19e17ba392278c398e070411d4410a92e91f49fd989a0b98da2d9a9ffb2d539b15c98c1c23979365f077007f8b1d6e5cdcb7b61588d3c42da3714f8ef5c9f15f7c0ae56a4e94dc5844452079044440111100444401111004444016d5a4f68dabb463c36cd757fab67268e7fa485df84fbbe2dc1ef5aaa2f1b8b6a571074eb454a2f83599de9d59d296b41e4fa8e99d2fe91b60ae0ca7d536e9ad7372351066684f791ef37c30ef152cd9f5058f50527acd92ed495f1e324c128716f88e60f715c1aab52d555515536a68ea66a7999c5b2c2f2c737c08e2152b10d02b3ad9cada4e9be5bd7af993b6da455a9ecaab597833bf9172058b6e1b43b206c6fbab2e70b7fbbb847d21ff003821e7cca912cfe93144f0d65ff4ccf11eb968660fcfe07631fe62a9f79a1189d0db08a9aea7f47979664dd1c7ad6a7c4dc5f5fec4f68a3db66dbb66f73001be1a290fd4ac85ecc7e2c16fcd6db41aa34d5d0036dd416cabcf2105531e7e00aaedc61b776ffd6a528f6a64953baa353e09a7de655111611ee111100445425ada487f7b53137bb7867e08de472a2e5b122ba2c4cda86863c88fa494ff0008c0f9ad5359eb9abb368bb95d29c32074309e8cfbc77cfb2de7fc44752e68c7a6ab1a30db2934976bd87b4adaa4612a925924b379f51bb5caeb6cb3d03ab6ed70a6a2a76f396a240c6f864f5f7287f56fa4558ede24a5d2744fbad40e02a6706381a7b40f79dfcbe2b9d2eb7abbdf2b4d65e2e5555d39fef2a242f23b86790ee0ac56dcc3340ad68e53bb96bbe4b62f57e5d851aeb486acfdda2b5573decd87546b7d4fac6afa6bf5d259d80e594edf6228feeb070f3e7deb5e44578a3429d082a74a2a315c16c4404ea4aa4b5a6f3611117a9d0222200888802222008888022220088ab52d2d4d7574345470be7a89ded8a28a31973dce38000eb24ae1b4966c1206c53674fda26d2e0a4a989c6d1438a9af7f51603ecc79ed79e1e1bc7a977cb18c8e36c71b4358d180d68c003b02d0f643b3ba7d9bece69ed4f6b1d73a8c545c266f1de948f741fb2d1ec8f33d6b7d5a5b49b18fe2374f51fb91d91fabeff964582ce87450dbbd844455d32822220088880222202ceeb6ba0bdd92aad174a6654d1d5c4e86689fc9cd2307ff00ef52fcfeda7ecf6e1b38d7d5163aadf9691ff4b45544709e124e0fde1c88ed1d842fd0d5a2ed5f66d6fda5e8596d536e43718332d055b87eea4c723fc0ee008f03cc0565d19c71e1b71ab51ff2e5bfabafd7a8c4bbb7e963b37a3f3e515e5dad371b1deeaacf76a59296b6964314d0bc716b87e63b0f58e2acd6e68c9492945e69900d64111172022220088880222200888802222008888022220088880cc69dbddcad3a86827a5afa98991d446e2c64ae68203864100f25d682beb5bcab271ff88571fda69dd577ea1a560cba5a88e303bcb80fd575c2d49ed2a308d5b771ded4b3f1597d4d8ba0e9ca9d652dab35f5fd8bafda35ff00fde4dfe72bc9afae773ac9ff00ce55ba2d63acf997ae8e1c91edf2caff007e47bbef1caf088b83ba596e0a35db5d6ba0d0f4b46d383515637bbdad6b8fe7baa4a513edcd8e364b4483dd13c80f8968c7e4558f442119e2f6ea5cf3f04daf3442691cdc70dace3cbe6d22134445f439a60222200888802222008888022220088880222200ba7fd18f652779bb48bfd370e2db54320f274f8f886f99ec2a2fd89eca6a3693ac8495b1c91d8281c1f5b30e1d21e62169ed775f60e3cf19eeca6a6a7a3a38a92961643042c11c7146375ac6818000ea000543d31c7ba183b1a0fde7f13e4b976bf976925616dacfa496ee0554445abc98088880222200888802222008888084b6fbb1b6eb9b33b53e9ea70350d1c78746c18f5d887d4fbe3ea9ebf77b31c5cf63e391d1c8c731ed38735c30411d442fd3e5cdfe903b0e3756d4ebcd1d479ae00c970a089bfbf1d72b07dbfb43eb73e79cdff44f48d51cacae9fbbf95f2ea7d5cb9766e8cbdb4d6fe6437f1393d1116cd2202222008888022220088880222200be805ce0d68249e0005b66cfb67d78da0ea4fd9d6ffa0a58b0eaaac7b72c85a7f371c1c37afb802575be8ed9a691d1348c6da2d91beac0f6ebea007cef3dbbd8f6477370150f4b7da05868f4ba069d4adbf553cb2fee7c33e1b1beac892b1c2eadd2d6dd1e7e871fdbf67bae6eb189283495de58cf290d33dad3e0e70016546c6f69ae6e4691abf37c63fd4bb6516aeabeda31272fe55bc12ebd67f55f22663a3f4b8cdf91c48fd8fed2e3f7b48571fba58efc8ab776caf68ad383a3aede5092bb8d1711f6cf89fe6b7a7feaff00c8e5e8fd1fd4fc8e3ed05b37d5343af68abb50586b68292989983ea632c0e781ec819ebc907c94e6b6ed574cf92822a8682444e21ddc0f5fc40f8ad4560df69357d21946eebc545a5964b3c964df3e79978d1db1a7696bab4de79b6dfdf604445824f04444016a1b49d3759a9b443e8edb4eea8ad8a664d044de6f3c5a40f271f82dbd5e5ae99f5576822603ef8738f600725645adfcf0fab1bba7be0f3dbbb673ea316fa842bdbd4a553734ce5d76cb368ad383a36ede5012beb7657b467f2d1d75f3848fcd771a296ff6d1897ff5e1feaf53597f87e97eb7e47123363db4c78cb748d68fbc58dfcdcbd3b637b4d6b72748d6793e33f93976ca2f2ff6cf8ae7fd0a7e12ff00c8edfe1fa1fa9f97a1c1b72d09ad2cf1ba5b9696bb53c6de72ba95e583f1018f9ad7d7e892d175b6c97486b6a595f5342ca1b8b865970a5606c9bdfc607078f1e3d8429fc23db3c27514312b7d54ff00345e797fc2f6e5d8f3ea662d7d1f69674a59f53f5389d16c3acf46de743ea896cb78886f01bf0cecf7276753da7cb9751e0b5e5baed6ea95d528d7a1252849669adcd15e9c250938c964d04445ee75088880222200b68d9fe84bd6d0f59c160b3c7ba0fb75152e6e594f103c5eefd0759c0563a534a5ef5a6aaa6d3f60a43515739e6783636f5bde7a9a3acf9712405de9b34d9c59b66ba3d967b6813554987d656b9b87d4498e7dcd1c837a877924d6b48b1f86194b521b6acb72e5d6fe9cccbb4b5759e6f7232da4349d9f44e90a4d396383a3a5a76f173bdf95e7de7bcf5b89fe83800b3888b4dd4a92a92739bcdbdad93c924b2411117439088880222200888802222008888022220399b6f1b02356eaad6da168fe9ce65afb5c2dfde75996203eb7596f5f31c781e58208383c0afd405cf7b6cf47c87519a8d59a1e9e382ee732555bdb86b2acf5b99d4d93b4727771e7b0b4674af512b4bd7b372972ea7d5d7c3891777659e73a7e0721a2a9514f5149572d2d5412413c4e2c92295a5ae6381c1041e208ec54d6ca4f3da889088880222200888802b8a0a1abb9dce9edd430ba6a9a891b1451b79b9ce3803e2add4f1e8dba2c575f2af5a57439868bfb3d26f0e06570f69df85a40fc7dca0f4931ba782e1d56faa6dd55b17393d8978efeacd993696eee2ac69ae3f2272d9f68ba2d09a1e96c74c18f9f1d2554e07efa523da778750ee016d088be34bcbbab795e7735e5ad39b6dbeb65fa9d38d38a8456c41111631dc222203cbd8c92374723439ae1820f2216a972d31346f74b6ffa48f9f464fb4df0ed5b6a2cab4bdab6d2ce9beee0645b5d54b779c191a4914b0c859346f8dc3a9c30578525c91452b77658d8f6f638642b47d9ad721cba8621f746efe4a729e3f0cbdf83ee25e18cc72f7e3e047e8b7d162b483c2899e649fd55cc343454e730d2c2c3da1833f15de58f525f0c5f97ee732c629fe58b348a2b35c2b9c3a380b19fe249ec8ff7f25b7daed305b2021877e577bf211cfb876059045117989d5b95aaf647911b738854aeb57720888a34c108888022220344dac681875e6839a9a18dbfb529019e8643c0efe38b09ec7018f1dd3d4b8aa48df14ae8a56398f612d735c30411cc10bf4417267a41e8b1a7f5f37505145bb4377cc8edd1c1938f7c7e2c877897762de1ec83499c2acb06af2f7659ca1d4f7ca3deb6f6a7ccaee3b679c55c4786c7f42204445f401570888802cde94d277cd69a9e9ec1a7e8dd535731e2793226f5bde7eab476f90c9202bfd05b3ed47b44d4adb4582972d6e0d455c8088a9d87eb38fe40713d4bb97673b35d3db35d342d9668ba5a9970eabae900e92a1c3acf6347534701de4926b58fe91d2c321a90f7aabdcb975bf4e265dada4ab3cdee2d765db2eb26ccb4bfa95106d4dca701d5b5ee6e1d33bb07d960ea1e678aded1169eb8b8a97352556b4b393dec9d841416ac7704445e27608888022220088880222200888802222008888022220227dadec36c7b46a692e74262b66a26b7d8ac0df62a31c9b301cfb038711de061717ea7d2b7ed1da866b26a2b74b45571f1dd78cb5edea731dc9cd38e617e942d735a684d33afb4fbad3a92deda860c98a76fb32c0e3f598eea3ddc8f582add8069555b0ca8d7f7a9f9aeceaeaf0306e6ca353de8ec67e71229536a1b0ad53b3c965b853b1f77b083915f0b3da84764ad1eefdef74f68270a2b5b56d2f28ddd35568494a2fefb8869d3941eac9044459274088880a9041354d5474d4f1ba4965786318de25ce27000f35ddda1f4cc3a4340db74fc21a5d4f08e99edfaf29e2f779b89f2c2e5ed816981a836b5056cf1ef52da59eb8fc8e064ce231e3bc77bf095d82be7bf6c98dba9714b0aa6f6416b4bb5ec8aee59bff88b4e016f942559f1d882222d2658422220088880222200888802222008888022220088880222200b4adabe921ac765b71b6c51efd642df5aa4c0c9e95809007de1bcdfc4b75459987df55b0b9a77545e52834d773ccf3ab4d548384b733f3b516f1b5dd3034a6d6ae945147b94b50ff5ca600606e499381dc1dbcdfc2b4ea2a2acb95c21a0b7d2cd5555338322820617bdee3d400e24afb5f0fbfa57d694ef29bf7671525d8d67e5c4d7b5693a7374def4f228294f651b10d43b48aa65c2a0496cd3ec77d2573dbed4d83c5b083ef1eadee43bc8c194b653e8c6c84c17eda435b23c61f15998ecb47674ce1cfee0e1da4f10ba5e0821a6a68e9e9a18e18636863238da1ad634700001c00ee54ec774c61493a160f397eae0bb39bebddda675b58397bd53772313a5749d8345e9c86c7a76823a4a48f89c71748eeb7bddcdce3da7c390c2cd222d6952a4aa49ce6f36f7b64ba492c904445d0e42222008888022220088880222200888802222008888022220088880f8f635f1b98f68735c305ae1904761502ed2fd19ac3a88cd76d12f86c972765cea420faacc7b80e319f0c8ee1cd4f68b3ac311b8b0a9d25bcf27e4fb5713cea528d459491f9b5a9f486a4d1b7975af52da6a282a06777a419648075b1c3838778256117e975f74f5935359e4b55fed74d70a37f38aa19bc01ed079b4f78c10b9bf5f7a293c196e3b3cb8ef0e2efd975efc1f08e5fc83bcdcb64e13a696f71942ed6a4b9fe57e9dfb3ac89ad87ce3b61b5799cc28b297ed377ed2f7575b750da2aedd523fbba88cb77876b4f270ef190ac692966adaf828a9985f34f23628da3eb39c7007c55c9558387489ad5df9f030355e791d59e8e5a73f656cbe4bd4b1e27bb4e64071c7a26658d1f1df3e6a6058fb15aa0b1699b7d969b1d151d3b29da71cf75a067cf195905f15690e28f15c4abdebfcf26d766e8aee592360dad1e868c69f241111439901111004444011110044440111100444401111004444011110045714f4551527e8d986fda7700b2f4d6a821c3a5fa57f7f21e4a56c706b9bcdb159479bfbda7854b8853dfbc8676a3b18aeda7dc2cb55415705bcd339f154d4ccd2e2613c46eb47bc410703207b478adfb67db28d1fb38a10db250f4b5ef6eecd72a9c3a793b403f55bfc2dc0edc9e2b7745b52ceeaeadb0fa786f4add38e7d59e6dbdbd5b762642d4842755d5cb6b0888bc8e422220088880222200888802222008888022220088880222200888802222008888022220088880c75eac164d476b75bafd6aa4b8d2bb9c553107807b46791ef1c544adf469d216eda05bb53e9eacaaa28e8ea0541b74c7a689c5bc5bbae3ed370ec1e25dcba94d68b2a8df5c51a73a34aa3519269acf664d64fbfaf79d1d38c9a935b51accd4553064c911dd1f58710add6dcade6a1a59b3bf0b41ed6f02a8775a29c6de7dcfd57a1270befd68d6516625b20e2619bc9e3f556525b2b23cfd16f8ed61ca80b8c1af287c54db5d5b7e46542e29cb732d117a731ec387b1cd3d84617951ad34f267b6f0888b80111100444401111004444011558e9a797f770bdc3b40e0aee2b3d53fdfdd8c779c9f92cba161715ff00a54dbeed9e3b8f39558477b31ebeb5ae73b75ad2e27a8059c8acd4ece32bdd21f8057d1430c231146d67805396da2d713db5a4a2bc5fa7998d3bd8af856660a0b5554b82f0226ff173f82c9d3dae960e2e6f4aeed772f82bd4565b3c0ad2db6a8eb3e6f6f96e312a5cce7c721c8611114c18e111100444401111004444011110044440111100444401111004444011110044440111100444401111004444011110044440111101f080e187004761541f4346ff007a9d9e431f9222f2a9469d459548a7dab3395271dcca0eb451bb907b7c1dfd563ea28a288fb2e79e3d64222a66316d4a9bf7209762448dbce4f7b2c07100a222aa3de6704445c03d46d0f9374f66782cad3dae9e5e2e7c9c3b08fe888a570da709c96b24cf0acda5b0bb65aa899ce22efbce2abb29a9e2fddc31b7bc35116c2b5b4a108a70824fa9222a73937b5955111669e61111004444011110044440111100444401111004444011110044440111101fffd9,
        3,
        'image/jpeg',
        '2025-04-05'
    );

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        12,
        2,
        'Ayyub',
        'Mahir',
        '2021-12-31',
        'Ayy',
        'Uncle',
        'Islam',
        'English',
        'None',
        'M',
        0xffd8ffe000104a46494600010100000100010000ffdb0084000906071312121513131316151515181519181518151815171615171718171718181a181f2822181e251d181721312225292b2e2e2e171f3338332d37282d2e2b010a0a0a0e0d0e1b10101b2f2620262d2d2d2d302f2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2f2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2dffc000110800e800d903012200021101031101ffc4001c0001000203010101000000000000000000000506020304010807ffc4004b10000103020304040b0407060407000000010002030411051221314151610613718122324255629194a1b1c1d2141652d115335382a2e1f00723247273925483b3f12534434563b2c3ffc4001a010001050100000000000000000000000000010203040506ffc400351100020102040404050304020300000000000102031104122131415171f06191a1b105132281e132c1d1061415f14243335282ffda000c03010002110311003f00fdc51110011110011110011110011171cd8846df2ae780d7f926ca718abc9d84724b56cec450d2e347c96f793f21f9ae57e2729f2add807cd56963692db520789a6b6d4b1a2ab3ab243e5bbd647c179f687fe23eb2a2ff00211ffd5fa0cfeee3c8b522ab7dae41e59f595b5b894a3cabf6809cb1f0e298ab171e2996445091634ef29a0f61b7c576c389c6edf94f3fcf629a18aa53d13f3d09635e9cb667722f02f55825088880088880088880088880088880088880088b54f33582ee36091bb6ac0daa3eaf126b341e11e4741da546d6e22e9341e0b786f3dbf92e259d5b1dc29f9ff08a55315c21e66fa9ac7bf69d380d07f35a1178e7000926c06a49d001cd674a4e4ef2772a4a4deacf5157a6e95c6eb8a68df536daf659908ed99fe09fdccca22af1cac76c9218f946c3291ff3247007fd88b6b67df95dfa1770ff000dc557d69c1db9bd17a97859068cb7beb7d8bf3474d3bbc6aca83d8e6c5ff4dad5ac44ff00f89abf6a9beb4b94d15fd398ae2e3e6ff83f4d45f9bb6a2a1be2564e393bab907f1b09f7aeea7e925647e3b6199bc8181f6edf09a4f735193c577e9ea4357e038d82ba4a5d1ff362f48bf3cc63a4af9e684432cf4e724b9e32d6821c0b0b5da8732469198684eed975dd41d2d96236ab0d7c7ff10c6e52ce72c7ae9c5cdd9f840d53be5bfc77fef95cadfe2f13f27e728e8af75c55b9a65ff0e95cd7684db86edbc14cc35a0f8da73ddb2fdcbf2de96d754472d3494f3011c81edca5ad7c6f781d63736f21cd0ed4116ca2db54df47b17155167cb91ed2592477be478b122fbc10410778214f4ab4e9415b55dfdc8e2aad3a31aa95e2db5f75c3c3f73f434559a3ae747cdbf84fcb829fa5aa6c82ed3da378ed5a347130aba2d1f22c53ad19f537a222b04a1111001111001111001116a9e60c6971d812376d42f630aaa86c6db9ee1bc955daaa87486eeee1b82cab2a4c8ebeedc382d0b1b1388751d97e9f733ab56ceecb6088b8718c4994f1191c09d435ac6f8d23dda358de64fab53b02ac936ec88126dd9186318b474cd05d773de6d1c4dd5f23b8347bc93a01a9558c41ae97c2ad21fbdb48c3fdcb38759fb5773769c1bbd6399d1b8cb290faa906a46ad859b4471f21fc4753b82e37389373a93bd353cdb6dcf9f4e4bc777cd2d0ecbe17f058d28aa9595e5cb8237545539fa1d1a3634680772e75d1248d31b5a078409b9b0d41d9aed3deb0869dced834e27627594568740b45c8d4bd5231d0b46d24fb82dad81a3c91eaba63aab808e68894532626fe11ea0b034cc3e48f87c127ce5c8339128a5e1a76343b4d4816d0100f7ea168a9a3045da2c786e29df3220aa6a57dce91a61a6009859299a33fb31d548c745fe5ccf047691b00539d149b256e5dd342e27fcf0b9994ff00b6477a82e35ab3cb1cac921731ae609012f6978b3c36fa02387153df33fb6bdfd91978cf872785ab4e8ad64f325a6ff4fa6973f4c59c32b987334d8fc7915f9c5274e6661bbfaba98ef626189ed7378906ee8df6e176f6abfd254b65636461bb1ed0e69d45dae1706c762638ca1aede27135f0f570f2cb3dfc1a7ea9fe4b4d155890702368feb72eb554a798b1c1c372b1d1d4891b98778e056b61713f315a5bfbf896a856ceacf73a11115b270888800888800abb8a55e775878add9ccf15238c54e46586d77b86f502b331d5bfeb5f7fe0a589a9ff0005f70888b38a61532a6b04f33ea0eb153974500dce97c5965f5dd80f06bcef539d29ae7454eeeaff005b216c51729243943bf745ddd8d2a1ab70e11411b1be0c71b4017da6c006f6efd79a6cde8973f6fce8bccdff0080e12352afcd9ed1dbafe1110f792493a93b5116da780bcf2de548dd8edb6308f6e82fc97636394ed765feb92e98a20d16017af900da40504a77d911395de8790c646d713dab35ceead60e27b07e6bc359a660c36bdafbae9b964f808d33a5172c5585c6c19eff00e4ba9234d6e234d6e16aaa9b2b6fbf72d8f7802e76287abab05ed04d8bae1a38d85ca7538393163cdec6da5a6cf7d6c07c5798860a25616171b1b72bdb71db71c885271461a001b9661a4dec09201361c92fcd966bc5f4126d4934f623a9717aba6b37309983c87b5b1bede83e3b37b8b7bc2b760f8b47531f591136b96b9a459ec78dad78dc47cc1170553e7aacc2c40e4782d58655fd9eaa3901b3257361946e3988113fb5af205f83cab11fa96ab5efbebd74e7fe2bf05a4a93ad41656b56b835c7a3e87e88ba286a4c6ebee3b4725ce89b1938b525b9c926d3ba2dad7022e37ac94460b5371d59dda8ecde14badfa3515482923569cd4e2a4822229078445c789cb9637713a0effe574d949462e4f809279536c83ae9f3bc9ddb0760feafdeb4222e7a52726e4f766436dbbb088890429dd3d7d434c72c51b5cca764b2973dd66894811b0651ab9d62f00682ef1a85e63754e22363ad76b466b0b0becfcfd6a4fa67ac31b3f69514cd3cc0944847a98557f1193348e3cedead3e48766d7dfcafa7ee75ff00d389ca9c9bd93d3cb57d75b7d8e75d8daa0c680d17e2760bae35c7fa458490ccf2106c7ab8df2d8f02580809ce198e8e728c6d99dbee484952e3bfb868b5ad71b6a1de2d24ddaf2c8c7f13afee5be2c22addb4c1177be63ea0183de9ca16e4bbf322fee29ad17b335af60ae0e0e85a41b16975b713b05f66ed9bbbd316c13aa85f23dd354b85b2c4c06361713604b62198b46d3a9d028ac3e6a78630ccf9779ccc730971da6c40b7629153795b5af4f5eedaf32358a8ca693b25bfd4d5fc1257f5d6db5b5b9698f2b05ae399bed584b5cd1b35f705043128cf8ae73b93237bcff0b4ae8863a893f574ee68fc731ea9a3f77579ff0068507f6ed7eaf5d3dc7bab456b9afd1dfdae675d5a002f91d603fa000de4f0da547b6924654432ca0b4c91cc5b1fecdad745941f4887127b86e565c2fa3ed6384b33bad9478a6d95919f419ad8fa4493d8b0e96d3b8c6c99a093038b9c06a4c6e696c96e240b3ade8a9a292d171baff5dfa6f5ea5772927b4534fd75bfdb64b4e3d33a994b45c711ea5d14b516f09bbc6fe6a29b561f10d6fa02d235046ef72ebc38f83d855371caafc516e515975386a9b679feb6eab9f0bc0dd552ced13be3c869dd6ca1ecb1b9d01b169bc7b41dfa82b7d4baee279fc3452dd056de4ab77a50b3bdb1e7ff00f40acd26e2aeb92f7466fc72a4a9e0f3276774bdeebc74be85b8a2228ce08ce094b1c1c371ff00b85698de08046c22e154d4ee0b35d9977b4fb8ea3e7ea57f0152d270e7fb7e3d8b7859d9b8924888b54bc14363d26ad6f69f90f9a9955bc59f794f2b0f75fe6aa63656a56e657c4bb53b7339174454e08beba8feacb9d64243c4fad6445a5b94134b737fd94713eee03f35ae78f2fbfdc6cb5f58ee27d6bd9242eb5f72749c5ad10adc5ad8aef4bc694a7855c77ef8e603de42ad486e4f69f8ab474d5bfe15d20ffd17c537eec5235cff00e00e551c5663187968bbaf9583f13dcecac1de484c8c5b969c74efcceb7fa72a4550a89bd9ddf4b7e0f29290543de243969e1fd66b6eb1f6cc5848f25a2c4db692071584fd2095e7aaa48f230680359775bb00b307f57565a0c218ca614eef086521e761739dabdda71712574d050470b72c6d0d1bf7927993a95654e2b4b5f972ebdf4e05c9e7a92ccddafddba14b9682b835925e72e7122de1dc5b7def6b2b9e1a64ea99d6feb2de16cdbdda5d74dd1367533ab5ac2429e57b84ba228c94f6eab98f7497a893ab63039c002493602e2e00036e8ac4b96af0d865379236b8f1235b76a741c53fa90c9e66b4643615d27eb1b23a48f288c024b4e6db7dc7b38a9ea4aa64ad0f8dc1cd3bc7c0f03c9714980539696f5405f7b6e0fac2e2c0f02929a671120744e16b6a1c4df4b8d9a6baf34f97cb92d346323f313b3d57b1c38ce1bf652658c7f70e3e1b3f60e27c76fa04ed1baf7d975b59505ad206fdeacd2c41ed2d70bb5c0820ef04588547c2ae23c84926373e324ed3d5bcb2e7b434151cd292bbef91770b2ffadedbaf0e6bd74e5b6d6b762b2ff67b4ffe1fac23f5f2cb276b7c461ef631a7bd546bdcec8433c7796c6cff003c8431bef37ee5fa461f4a218e3899a3636358dec680d1f04dd12d7b5dd8c5fea4aead0a3ffd3f65fb92869473edef2b1fb28e2777cbf359d1d70635c1cdb92343c791e5bd7336720dfddadbe2a56e9593f3f03987934eec6b5218249692df881f58d7f351eb750bed230fa5f1d3e6a3a32cb522fc50ca6ed34fc4b4a222e80d60aad5c6f23fb4fb8d95a5556b3f58fed3f12b3fe21fa23d7f62a62ff4aea6a459c1117b835bb4ac1cd20d8e842ccb3b5ca56d2e141e3789c9d60a6a720485b9e4908cc218c921b66f94f7106c0e9e0927819c555c3759eb1e4dc9a8cbd8d6471b5a3e27f793a16bdcbdf0dc3c6bd7cb3d92b9aa6c133821f5354e2e05a49a870041163e00b32dcb2a80c26073aae2a792e4d3667b89f2c340640ee770fcddac3c14b4f2173893c7d5c96fc27ab3512b9babc454e1c75d3594db5f969a2963b3efc3f7f63ae7878d1b64495f47656f1fdbc9be64c283e93f491946d6dda5f23ef9580db41b4b8ee1ddf3538ab7897459b5159d7cc6f1358c6b6317bb9c0b89cdc1baec1b6feb29e4cdf5edde836ab9e5fa37f6f123f04e9fb259047347d5662035e1d99b73b03ae05bb75ee574548e99743a374465a68c31ec07346c160f6efb346c70e5b7b6cadf8639c6188bfc631b335f6e6ca2fef4faaa9b4a50f223a2ea26e1535e4f99d08baa8dec0097168d45af607b895d79a3db761dbae9bcb7f9fbd3142eaf724752ced62296334ad634b9ce0d68dae24003b49d8a46a5adc84803c9d806ddebf2be96367aead34b10f021cb7be8c0e2012f79efb0dfa1b6f4e852bcacde96bb7e03275f2c6e95ddec97897aa1c560989114d1c846d0d78240e361b975afc9f1be8ecf8764a86bc3c34839da0b72bb7070b9f04ecbefbdb7ebfabb1d700f1011569c63671774ff0060a356536e33566adea7aa92d706c953720015126a4d80be577cd5d95664c1e9bf480335dcc7c52cc58f24b3ae0e8980868dba13b6e9904a4ecd9615474de64afc3cce0e8e6234d2d631ce9a36b2105ccccf0deb267780dcb988cd95a5c7b5cd5fa72adb658a41d5968208b657346523858e8b0c149a69c53027a895ae742d26fd548cd5f136fe4169cc06ecae1b2d649252db877e1d4c0f8c60eaca4f11277daead6b2db4df42ce888a139e080d8df82eff00d18eeaf35bc2db9797e6a3fb53ea53942d996eae3a5071dd1704445d0b35d8556ad1691fda7e2ad2ab78ab6d2bb9d8fb951c7afa13f12ae2d7d29f88c3ab7ab3af8a76e9aad3555064766361d9c3e6b52dcda7bb0bee34205afaff005fcd6729d49432705a9514a4e39781a555e76f515af69d195769187775d1b032467696358e1c6cfe0ad0b8f14c3a3a88cc72036241041b398e1ab5ec3e4b81d85320d27aec4b84c43c3d5553cfa32bd5f446e5cd170768de0ae0c074ab9c7e28a023f75f2b4fff0060a449aaa7f06588d4306c9a1033dbff00922b837e6cb83c028d9b1561aba77b5b2b6e2485f9e096203accae65cbda05f3b0346be5a962afa77df5b1d7c71f46b4165927aaebcb6df893d3d406f33c16b6d70de3deb9eb1a438f3d8b526d8bd1845a259ae045c2f569a2690dd779d157b16c5c475ec8a69e4821744d224606383642f70bc8d734e6658006d6236df6a7d3a6e72ca8ad566a9a6f7e84ecf4e5c6f70b3a688b6f7d8bbe2e8dd6168747534b331dab5dd5c8cb8dc6ed7bc1ed0b1acc02ae361925aaa3858dd5cf74723801df23029bfb5abb5bd5107f90a4d5afe8cd598dad7d382d71c2d69716b402f37710002e7580b9e26c00ee50bd1ec58cf2ced6c9d6c51f561b2f55d4e771cd9ecdcce21b60db5f5d4dd4bd54b9469b4a8270706e2c9e9c95449a467342d7b4b5cd0e69dad22e0f682b3510493cd74d1cc6f94ea0fb935933a76573b956b1675eb00fc106bff32436ff00a6acaab34703a79a799a06573fab61bf9308c87f8fac4b11b1fd4bbef5b1be9c12e6db6dc7c576e202f534206debde7f7453cd9be23d6b7d352b6305ce22e06a4e81a37edf8ac7a3d19a898d61168c34c74f7d3335c41926b70716b437936fe523837df7f9297c5f13185092e7a2f1b96659c32969bb4d88582289369dd1c627626ff4a0eaf35bc2d99798dfd8a1a690bdd73b4f2b7c162b6d1b2f2307a5f35354ad3ad68cba7e492756552c996a4445bccd40a131e8fc26bb8823d5afcd4dae1c5a2cd19e235f56df75d56c5433d26975f222ad1cd068af2222c332cce57e6375822256efab15bb85c38ce1e2a217c24db30d1dbd8f04398f1cdae00f72ee4427677409d9dcac615566661123409632592b3f0c8ddb6f44e8e0778705d2da768dcbdc73097978a9a7b75c006bd84d9b3c6350c71f25c35caedd720e874d387622c981cb70e69b3e370cb246efc2f6eeedd8768ba95d9accb6f6ef879703afc063962216bfd5c57ee8ee74b7686db65f5ed555e9be02ea98daf8c5e58af66fe361dad1cf404778deacc896339464a48bb28271ca7e37438a54417114d343626ed648f8f5df99a08d7b424f575154f6b5f24b50f27c16b9ee90df966272f6e802fd56bf05a798e696163ddf888b3adfe61aadb4186c300222898cbedcad009ed3b4f7abaf1aada22aff006f2beebadbbf738ba2f83fd9600c362f71cd211b0bcdb41c8000772939e2cc2cb622a129393bb2dc56549238e38ded0e6daf985af7d8b3a6a6ca6e76ae95c788e24d8b2b6c5f23ff00570b357bcf21b80dee3a0de52abbd10e9d4514dbd17130c66a9ed6b638b59e639231c0dbc290fa2c1771ec03785ae8709ad863644c14b958d0d0e324b736de5b9769da7c2dea4f02c29cc73a79c87543c58db56451dee228efbafa97794790004ca6b9db45df7de872f8af8ad4755ba2ecb6db7f1fbfb58aec7d1b32106ae5eb80d7a96b7ab82fbb336e5d27639d6e4ac4022263937b99956b4eacb34ddd9dd87363b38bcd881eae6389fcd7093a9444e94ef151b6debd46395d256d82eec163bc97fc209f97cd70a9bc0e1b30bbf11f70bfceea5c2433555e1af97e4928473545df7a928888b70d30bc5ea200aad54191e5bc36766e5a94de334d99b9c6d6edecfe5f9a8458388a5f2e6e3c387432aad3c92b0444509185eb996b73d578bd2e27b9029e28bc5b038a721e7332568b3668ce591a385f639be8b811c94a2254da7742c64e2ef176655e48ab61f198daa60f2a322297be379caeed0e1d8b4bba43037494be03c268df17f138653dc4ab7286c4fa4b4d0dda656be4b690b0892473b70c8dbdbb4d804f52cced6bf4eff846ad0f8be217d2d66f7f439e1c4617eac9637763da7e05748232e6ccdb036da15670ec1231044c9a189cf0c6e7258d77856bbb5235d6eba460f4e1858208b21372deadb94bb4d6d6dba0f5295c237ddfa1d2294edc092a8c4e08c5df346d1e948d1f12b95b8f42ed21eb272767531be41fef0320ef7051df668296a219fa963616b65648591b6cccf90b647003c5058413bb35f65d5ea099af68731c1cd3b0b482d23911a26c928db4bfa1958df8955c3cf2282eba95b65356cdb9b48c3bdc44d3db934780c3cc9776297c27068a9ee580b9eef1e579cf23ff00cce3bbd11603705228a2726d58c2c462eb57ff00c8f4e5c3cbf933863cc6cb69a5e7fd5aeb4c7216ec59fda1dc7dddc9d1c96d48565b6a7afa6b0bdf8fbaff0092d2b6fda0d883adfe7ff75a936597fe224adc0222268d3d8e32e21a3693656a8a30d6868d805944e094bb643d83e67e5eb534b5b034b2c73be3eddea5fc2c2d1cdcfd82222bc5a0888803c55ac4293ab77a2751f9772b32d1574c246969ee3c0f155f1347e6c2cb75b1156a79e3e255d16dab83238b56a588d34ecccc6acecc222241028a762324d23a1a38c4af61b49238da084f07b86ae7fa0d04f1ca988192795b470b8b1cf6e79a56ed820bd8907748f376b7859cef255c30da08e08db142c0c8d82cd68d83f32769275255dc361949679edc1732e61f0ca6b34b62bf0f435b26b59349527f67730d38e42261f0c7fa8e727493a2cd7c0cfb1c71c52c0ecf135ad11b1f7195f13b28d039bbf710d3b95a978b41452564b434a2b27e9d0fca29f12639c58ebc52b7c6864f02469e6d3b47a42e0ee2b655574518cd248c60e2e701f15fa3e2385c15032cf0c7281b0491b5e0766606cb8e97a2b4513b3454b0c6efc4c898d3ebb68abbc2abe8cbcb1b2b6ab52874787c95de086be2a53e3c8e058f99bf82207c26b4ef79b69e2edb8b154f44183fbca5bd2c9c6203ab7ffa90f8af1cf477a4adaca668e7dab6a9a34e2965e055ab3753f56a5128f15736414f54c114c6f90824c5381b4c4e3bf7961f08731aa9752b8be110d544e8e66dc1b1041cae6b86ad731c356b81d411b15568e696197ec95273480174335ac2a221b4db748db80e6f30e1a1d286230d91668eddf7e1d36c9c461943ea86dec4aa222a6530888800b6d2c0647068ef3c07158411e6701c558a868c46db6d27695670d877565aecb7fe09e8d2737e074471868006c0b3445b6690444400444400444401c95b48241c08d87fadcabb3c25872b858ff5b15b573d552b64167771de154c4e1554faa3bfbf52bd6a0a7aadcac2e5c4ab5b044f95f7cac17b0d493b0340de49b003890a4aae8dd19d751b9c367f25094f07daeb9b1ed868f2cb2707543bf5119e3905e5238f54b329d194aa647a73e854a749ca791935d11c25d0445f37fe627775931db95c459b10f4636d9a3b09dea7517261f39933bafe0e77359a792cf009e777879ecb2d8361249591d6888814222200222d359067639b72d2468e1b5ae1ab5c3b0807b9006e513d23c185543903b24ac21f0cb6b98a56f8aee6368237b490bb30daaeb630e22ced43dbf864692d7b79d9c08befdaba9286e52f06af33464bdb925638c7347fb3959e30e60e8e077b5c0ef520b8fa4b4ff66aa8ea8691d416413f0126ca794f7ff744fa4ce0bb163e2297cb9d96dc0c6af4fe5cedc02f58c248005c9dcb653d3ba43668ed3b876a9fa2a26c634d4ef3f970096861a555df65cff80a545d4e86bc3a84462e7571dfc3905de88b6a108c23963b1a318a8ab208889c38222200222200222200222200c5cd0458ea1715261b1c41dd534373b9cf77a4f75ae49dfa003b005de892c83c484e90563a185ee68bbf29c80ef79d183bdc5a3bd7450d288a3646350c6b5b7de72802e799dabba48c3859c011706c45f506e0ebbc100f72f4c413728f533422ccc4562587826d875d1e22f578905088b20d3c1004440feaeadf1ee9d9d6b7fd48f2c728e57698481c9e54aa8ec4f0b924921918435d0c8d76a4ead21cc91ba6dbb1eeb730de0a5db084ecac4cc88dc5f0e6d4c1240ff16561692368bec70e60d88e602e3e8ee172f5319aacbd6e40246b4dc1781626fcf6e9c55880b2f524a8c24d392bd886718cda6d6c611c61a2c0587059a2294508888008888008888008be3afbe588f9c2b3daa6fa95da9b04c71f1b1ffa4a5064742d67f8e7e53d6366241787f8cd7441b94037320e05007d1e8be6c9305c7db1ba435f300d8dd239bf6e90b9ad6c42575c076d0d733fde156316e90e2b4d3490495f579e27b98eb554c46669b1b1cdaa00fae917c75f7cb11f38567b54df527df2c47ce159ed537d4803ec545f1d7df2c47ce159ed537d49f7cb11f38567b54df5200fb1517c75f7cb11f38567b54df527df2c47ce159ed537d4803ec545f1d7df2c47ce159ed537d49f7cb11f38567b54df5200fb1517c75f7cb11f38567b54df527df2c47ce159ed537d4803ec545f1d7df2c47ce159ed537d49f7cb11f38567b54df5200fb1517c75f7cb11f38567b54df527df2c47ce159ed537d4803ec545f1d7df2c47ce159ed537d49f7cb11f38567b54df5200fb1517c75f7cb11f38567b54df527df2c47ce159ed537d4803ec545f1d7df2c47ce159ed537d4bbe9b1bc524682dc46a0dc1394d73c3b436d85e803eb645f25b71bc4eedff00c4e719b36dac96cdca6c73785a0e7c35590c5f13f3ac9bff00f707eefdf401f5922f8f24e97e24091fa42acd8917155311a7039b558fdf2c47ce159ed537d4802097e8517f6b756d0d021a6b3725bc1985b231cc16b4be08b3c8b36c2da5ad70488032a3fed466748454450f52f6bd920631e5c58f8638486de51b5b13778f19dcad50e93e242aaaea2a1ad2d6cd2c8f0d3b40738900db7d9110045222200222200222200222200222200222200222200222200222200297a2c5db1b1ac34b4f2117bbded7973b5bea43c0d9a68111006c663ac008fb1d31b926e5af245dc5d61e1ec17b0e402f463918248a3a6d72e85af3620341b785b0904dbd2217a88021e67e67175836e49ca360b9bd85f705a911007fffd9,
        NULL,
        'image/jpeg',
        '2025-04-05'
    ),
    (
        13,
        2,
        'Farha',
        'Fazloon',
        '2021-04-05',
        'pilaka',
        'Cousin',
        '',
        'English',
        NULL,
        'M',
        0x0000001c667479706176696600000000617669666d6966316d696166000000ea6d657461000000000000002168646c72000000000000000070696374000000000000000000000000000000000e7069746d00000000000100000022696c6f630000000044400001000100000000010e000100000000000026c50000002369696e6600000000000100000015696e6665020000000001000061763031000000006a697072700000004b6970636f00000013636f6c726e636c780001000d0006800000000c6176314381040c000000001469737065000000000000027200000272000000107069786900000000030808080000001769706d61000000000000000100010401820304000026cd6d64617412000a0a19266719c782021a0d0832b44d11400104104140f4bacdcb2f4897a2cc596702a06eea98f366a32ea28aea988b11e0e304e18f75a564de9ed42989b6f69031142d2c99c4c9ba738925ca97255edd32d4dd89630e0543d10e3ff00d31280d80e25aabb092271c393c51eb749acc997a32e9d9d1a263cbc94d79faa7dff996d0f10f33656251e347fde69fee98bad3cbebc5640649af81591a34a8a60745ebb184948654b2e178e50408b09a69e60e648b3b938e5644cca0fa380ad33df79fb0106c4cae238658410c156b15172ce74422c437880d4a02c46a14e9882e3bf270c4e384f678e9fe9be5a38ce6400b0e148861713c16b4ae2a349c0cfc617277a101eb43b2c697d39e32f8a2a623990a8e513ebd1e33d0113d77d267c2c372250fdf35f71170f3c0a149ecfd18597a35b1067479ac03394c5280ff541c44c7f8da31824dc07397a05ddbf1c20039c86ea1cda9b7aeb044970a20c7b787933c567230947c7b3a02897090a24c36df5902bb1fd8a8515c846dcc096d097d3ba9f403d638e9a34d6535cbf654ef427965e8780ea6b2439b3a4aa09d92dffbe2fbdf2b606e4178c2da8a0392633165de6da9a690d4460c6a23069714d70dd17ff1f685e9014dc24f26afb134a9ca3baee9ce80215bc46c50642fefe5f3a9d236025e37c2909cc71fd65d7c43888551c09e13342e8233aafc2ac4c0dfc13af2e3bbf36dc7855128f9ddd281e639d82ee7c8942d306fe12ac5d9cf8d056892998e8a802f3db3ccfb6df2fa95da16c411e1bbffb3682a3adad5f41e9eb97cb7bea2ebf9f48d8453413e2151d004eb5f2b8d3cef2cd5695aba24378eb3310d08dfa41e9fbd401bc5197342a2eb5740c85d9c98fc0e125276c8890fa5f7f0baeaea97eb871c83ad8d9fc64b76834b6ec75950bc997da1edcf3e8c2bb8ad25e392a8b9921ed74bd713db4c3214649aeeea549f77acbb89fe4698be1ddacb763ec46e688ad6ca0310a750a4c3bb7e8f4853d5dcb8bd139eefb0e43589663708642f21af88ba0631ec76cdce831d7cebce1f23e33d7e527dae73f1ac243d64807046a3e8b1de7ed3cc7e729e5ba7063a9dd3978f0ff86772477afdaf129ae7610507e755bd239bf08b6cac4eb4596a74e8f3c4531d0ad612c1e11f6b5c8c48ea4d77d6ddca63e8db21a9fa5f22f75931274b3e3601269f2a25b914483293997c1408a57461595f42fd36f77adf2f9782625b2558d8a3c2069bd6efecf4701571113b4d650f83dd514afd0e9efcd0dd2fe4ddc302445cd97f68c5e61fcca6d752f38481116f7321f88fd8143bcfe747ef7760b46bd147284769c9b56f08a4fcac48265edc80858231ce82a005dd10694de5ec23bae5171ef1785a97cc8a81101294110d4ec62de0de9fac3d55992127e5331fa9ad04585d11b23e15d2c994fae6e222977d5ef85afc889825b040962bd4f8a0c56b3fe7dbfd6eb9c21775f025b9d357c8a27c413ac87ab07c5ff4edfa9aeb4b29f01ddcea7792ccb2958d0f4a12ee922da55c04002a7b0700dd0f3c8d6d29fd399b887b07dc7b870af0f2896b349cf63f0e478ceeb87a9957c39441a3ff92acff2e61c45be0adecd3503f3f118616f13eed76f388b9f9f2d5880e2c710bc3d004033ee775aff4506347cb904e11306401cec148b30d68e56e388d265b2f8123fc5d4a55fcbe806e70106cb23d7e14cf02228308231e5f09f08b5771530b8c1e6bd29c15c25904408603749983f51293b6c24a8d3287f2243ee6a7911bb232739dc0cbca3a283da8f8692673ba1ac193e9ef6df1ca01fe66bfe872deeb2e4fac81014eb39eb128a141978c264addf83ce2fd385b51b8d06f2d5d6709266aec32020d97f9c9934a2ec106032e8605748bd97afd8dc193433553bc767fe146a987127d99278da45036438f3955d7006befc729d541b2e049147117ad8d8eadb41834799543a2ee00bfb11b94d0b447c143102656401d7d40a0f9ca5e90fd4550e7b6fbd8d0e81d9c7e4c682469d11f4bf2008c84b23261b1ec10423c8dadb510d396f26c96b95ee48025dbea600d08472a67bbc9e38fa6b3a779173e7c8397e0aa744d5404fbd0f25edf4646144503d774d56e4fa5bfc0011f31cfb0b0314a4902f78ab7cdc07c122e3c85ac1cffb60fe1207e0730b5424c02f77c7cde5c2817e8ed185e436b90000cc70ac8ca521f62c241f7178321f09a4d0b5b48a8c80a521c4ae3c6d89fe962635c2e7ff7805d24971bd43464e19b4f08cceb39e6183397b6b2086cfba423d6dfd3c9ddabd96c35ef218ec0003994b31761bd1dde537df4d0f0f3a5b5c45cc1da28dc64cb7fdc74d44f043d560a2bc44d39a24bdcfaff136dc3cf0909dc9d8db7ad82b166873715a41dd7f76cfc5991d2ec56966f86253838f446c68df1af84e8af6d6016b37860d73a368d27fee467a337256c07c9dcbfeb318f1b77f17936e064aebb1ee7254668d87f739a37c2c1673362960f9c0d21ff521e3a8239d4cf2ab07c23e0b38d09b4a87548c570205fd6141b7a91ca1c0d93875b385f0b550d1f01e29050ad398fbfa3ae9792bee54911e842fe4edc88c6efcf9052a12ea2c6954c71a869d8a300a7b1025e8f0b993d259473b08cea9d537bc8f9e29fa86e83f875967aaa645ac24bb74f86d38f5aa719c690ef18a1a256a9ff8a64ee9886162224be54d9210448c0a6bbcb7f99025cc6b32f3071676438837bb38be439f7e009f5fa00d266ff1c33fdaff012d2635c2f5b88e32035f64b831bc4d7965b44baa3fed62bcd75d858435cf799846085d84e9030a7a2576740586dd78645f3cc1164538075f58efbb24e741526a8b1081928d6b350cea258796bae6804e4e409fdbb5cf78af5532e9ded6fea76712e3ba5a44c191a20bdba611678cc69b7f240eab57554d0e7cb4f5a161281db4b2c32ff240f07861b7ae7984268577f0aa7d9a5694c310afd702bd8c2d1f1e08b565ed8fa45d3ab67b09aefc667250e76c27d9ca0cc2380d326bd2d7b6497c7236dfb03b20293efc0508006843c9a09fa2abe00f5a55c2321b6153c3c05512c2ee212c0188d01e1df26cf9e8e64ca2bb261e795b41071c99b15e71441a6aa40b17d5f3cf4d9d28557cbe681d68e639e32cc399d7bf37f8ddbd084a5f3f6ac3e1a296d05fc3756ad8160a8ac11b078b8d87afb7ba10bf8832dfaefa589ea6cf5ed74a3216cc10227dcc22d6f999c66b300e6e83684e54a289e58590d31c3cb4501d143909d0e41206687036055c05a5faaa9955e936eb7963f63aec5f54cc5a8ae8aa6de6640f4a0ca893a127a65e1bf3649be6b1e04ac3a463c52ddf08f2abde6ffc33059debe167f64ec5904053bb96d51af1f7ae3cbc2405d717dc54cc01a7438d67d8d90bd0ceb55ae1f84310fad33914496582c7c5569fc9939120af11d8f198e7c1b782ce12a29be780fdb22751144b126492300bb3170c881d0b626eb4ab9fb2879ee1639e3e02237fdabe69dd47ff454f770fb8858a1f3a3254f71fd5aa1c6435763c536410a5567f90346bdb575a4bb03b0e683aa625741bc4cfbdf2be5ee4800b9b174ff330e7a1a7feb0588bffdfa82477a09ea78e5d06a1d6f9c4524c241a7eb2c9b6e13eab6a60d363bd252086c6643f1aca591882fb2ee004c49f427bd1544c7f25e529f143319da2ed125219abc11fe8b808d9683aadf67f467de65c437d45f91f150779b1fbd1efb1f0120d60c60bdc07f91b2494614af7a26b2a2fba58841859839dc9c3a20c195513a0f20bdc00051ea80e7861d866eca8145e1e7686596c9be8e088818f750a33860c0586e96bf0a39af936c5d6b569aa5ac24f086b4337d9c4080828ca23cb7aef90cad81d66b1bdfc1c6aeb5a90967588c3c1c9d25d896d79b6326f9d6426bd14fa5890519fbdf27280dff734c09ac22f19b59b3c6b0bd79648410017a8a249fe383af4bdb47007168558625ee93782c3e261b8af7e214a7ebeae4a12067756cdb1df1d28fc391dddfa34fb4373f13cd111fee7bf94643870bd02190aa986de807588e6a645a93248eed4fefb9f896fb6913c87aba6165ff99fa6cec739d43ca3c3a4bfc1997a94d493f39b1c2c9c9a9d091fe769f4ef7151576c43da21cc7c3a8d6b82f1f7ff8e425fdf3cd2c6d6a5f46e61091dd5ded7303ea19e10abeb2f1143ec12b3a4d98fa9bf46e37464d0a8f79bfe1a1df77d5ba4e3bbce6b713016c6f243ab6d62f259475c94599f0a76406448774a790e29fca2ce5d38dd5df44da8682706f63d5d0396437e16de6b35237d605788c8e1e33ccd22763b0e33f6f4d54f4919cf8b15a55339ed379ba4a61f689769f83534019654c6ef6a662b11f952d5e07c71264ed35f00f633b48a3c763ab358bde7d18ee99ea790f94b5aac45009138dec8dec50418ac5556e7e3b86040a7a5f1dc71a9dff60542eff85dab620e7e37e9a01da0f91f5b55c7d79a76334e8d5faa5d75c094215e7bc94b321fda31f179c0fa1fe250664551e2fd6a62d0eae81082d1fb8bcd2e49f5a0c9519aedf467e56be25385ff0cec51257e23de928272af8cc6cd17137b0956ee75ae1fb235a12f243e2747e339639447c521b5b746857f64465468e67666ae8efd1923486e3ffe9a240f189837f39b06e738f450c5c8232a3f52558c6bee4451728b641708a789013a5c18599126ef3e8aa0155e4d5773d4a1082f922a5db3f1288b613e74907673178e5298aa8c0870372d63c92380755fee55e98b317ea7631340396ffeb951fb3b1ef728f29c37c81dc9bee46e19a7e9130ade51f0b90c31fb293fc65fbc4f5d68daa40c9b02c0acfcc9c2f4752b575bed3f9e3228a78f9a54e0ff26760dc0f40e2c844b4f3ab7168ad9f1ce8c48bf9c2c3f28a838476352a72dc00eeb762e30d015b43f6fd02172c11d7186a561fabeb02176c7749848d808a34d435cb00a24690b7c5d8ab02af7a00a30d21d01d815ac02c110893558ea51c1e1bf843e0f0efefe6f3da5bf1e20fbb5815be5b1113eb1a723f531474bde62639d9a5eca6e5b8010e93e16b973e4629beabba886c8f05e30edcc6de67a7214a5c19ba6b0909181eedd22446a022a1a0f64c45e347986abe0b725f848d019263f8de3349af0752a53e76610a9361e3cce2e233da1a704a12715920be364e6ea7cdbf70f601f32dd338d27ce37159acec91ad479fd2fbdaa1fb9f92c1f684a6fef12fdf7f84b5af3ab3c35047ff291b0c00d11d320f00ba95635fa85be27eac3c271970167c9f8bc7d0838f9822e891b482518f3d2d8b8b6e8f77f8a5d378a74adcc9a0e13695777e1df968b3f5cc3bd97a8cbda79cdf16854ed1b9ed5d7c9f648d9e1410c17766c51c9366eebb8772d2612977c077ec0852fdb6435e99a51aca5b1f941326aeb3ad20fc6d1446681bed0e794969318cbec00923ca572fa2f7c205112135155b04406ca252d521d38e0d31b6fb1e5cf052ebcee8b74f8f4c31a55bb754939d18b6aa4f175061deeccbf42c141b144a93fb856caccb03c75b4fe758b656a13e1723d11b04b0dcbd879dbec7a0a38da27940a56da2e83bb9c5e9571852064b23e402e7eee43519d344437d82409b709f56ca16c85b291311db080656d46d38238223733fee810422a2ad4acf6dd865d3e6723a2d93ddd1d975d703eb7367ecc538f9bd47298f96703559e5b4dde00f274eb4032fb63ab0f7b24b4ed531a909205fece39390d893227cfb6d486aee9b1bb97076fd883ba029f392b571ddd7a8442821549628059028657ffc240b82b890036ff25daea6a9f50da5ed972e0fb8fa5e69d86dbac6937f2e32c20d64029e4e889ef0c52e88670d854b224fb64b88b1923d3d7ce13745c22b9238a290a120f2a042503acc3308de2cb415ecf4b1288600be5fbc6ac3d6b169540eaa976c0697fe241473fea08643a5608d4890c93324ffb369e4709185adfbb41c3b189b53cf247a8a3ccd898bec5e958a449f828b1162ba62e610bc12292063b61a739b5d2aa2f5d8685bf8c69180bb9d32dc25eb5a3008643653458516482613400154dd73c821dbb9ec41752277aa865642224a01f3374872819a684dfe1236f034bd36d4ecdcefc29bc537a2e83d02684a0abc6b6dd0013389e20b9a0ec3305afa951d48c59ad03e088918d72389c957b557f0de2c406508057b5e9cc06f16f27ff65b7ad30145c35661312355c9c1c69c0afc14615277e961bed7811479a4131815ea8124bd3e733aa28ed3845d6210061a322abbd8d75f361d88350639c7f4ecbff92d2dabf10598d8964f005c89e0c12f76a553cf96face99e71e99db71aab8e8b71298b557754d02547830ee7bebe7ba59e32359b467694cdea67ac8b1073cced1ff432633a5d18eca659f7128257a4e0d2ae91f5481770b5589360c3a1335dc7e668c7cdd84acbd641c5fc736eb79f174f95d3965e98237b734f79a1b3401fd91e8be34154de39f3690e69253c9bd622ddf3fc2d0a26e1484e58247ac87ba5ced817043316f21082119be319f20ccbb67b042d62cde7dd7900bde6240063c7a0a84d3f36035743d5c3cdb8004cc73e53d41e163b6de1a847f26064c0fd3c123513ddc5bc61a097441f30dce7d7de2ea77e0156baacba6ad1292558c4bb5d9ad1a36f843a2a059c8aa9efc0059ef240087fa92275c60d427afb78bf3c167f8ccebf2ba31d250ab289e0ecb30ce1e317cf209837ce49361a96e465b54afbb4363995999bdb45b702e6f1a11fe49213f8f43023644f248d2dff884f9f57c7bcc1be3c1ee5d2106651ea1b3c34aa2e07cb2d1664db5563604285a5080689857a6b3ff2ffe5b791707f7bbba3e7da519ea87472e5d2a829b9fe3285d27e9608b91434ffc286a768c5d4ab1043f3387b63069e37f5c7503d55a2b8b6d6f060453b439f5c53f912281cbbc1ebdcced67ef536e74135e1e2850a071ee372a77d8fd274f580b43e77908bc1a2781b7a9e9788b4f153e42cfe422c15d2d9fcccfbedfb1ca7e8329d300334b7c50cd3e6c88b2a3e1931d9a0f4ffd7e9a5722e7f53e622c37e128c740f8b8aac25583f8746991570a31608325f0fd7567b4803e725b8d4463276ec36a2469dee091db1b219fac28018131bd43f6970655b54a33cfecb96f0ad65d41c16dab8b937e063a044610dd1f7e34eccdb5b63bde370d33566eee5f1c2de3e87515c8d8084f69bfc85add9f5b7a039f0d7184aca32c01403457ac233a158333b8a22ab7388a071e4760eb30382bae495460aff3c34a71aca465fb7f2097f29978b52a6838858e48a214058ad0db26e189d7e2da175aca5adf956c6059dc33fdf24975c16ebbc06361cadcaee76c1a17dbddd2f01a59d10bb0a3eeef3a13d76f5d904fb9c2d77d972ea31b9f2e657998292788e8072c36b9dfcfc49c5331343c665a41f33aa6edf573163a9e7eaa6717ebbde418068ad746e9fe717fa2b3502d5acdaa01577dadf21bbff5501861d41ccacb99f0e8c4c09951a0274a31047119f127413c4251899bb1971d049fbb1ee68f96e038518e1d5954664d0b547620bdd47beb231a5716cfa4c09f5ad71f869b88000fc61d6cd3df9c9a01b54fd003cdd1fecb1dd0dab96f2c2dbca2119db572d15047ef39b9e1c7ed2a02554a8fa7634f841508c6101b3ab3a7f1d6264dede2b61645fe1e3aa8818bc087dc130353ad99fca1443f3eed464332126591f62a26d8bfffcfa93a13ee4e05c14196c129cc3de22f2fb5f2a9c03499b042028779db45f50904835498983e677015c0cec67b53a5576c82a629392726aca5ecb529af1857ade944e47fc7152801f1bf2dbeea789889c42570a64b116108eee88dff67f2bf15b9577d161f39c2f4e691940e2292f91d9589245b3d8dca44ae1abec3c597e2d2fc62c4d0c8b9cdc8e445d3ae7b1355946e1f0449f8edc7e4a4c64869ce3a72914e1f2d15dfc8dab83f40bbbca286c07c0f8fc179e28380d4739e2ce386ddfc47823c12d285703ee32439fb0db2303ca7eab3ac1d82b9e2a4e7195f699684cac84aeb49d0a86647cbe0b7b293aa084f58c53ebe0057b7c589226d201a30ffefeb67b993a477e7a2cdfbb0b56694728f2f5630767d556aa620bfc22d9b31a95973d8ea72d9be03f9b5b9a23afd91faf1d292cb6b8b44de57a49aaa7b0c25637ea1ca6101ce4831e0eba26c490cdc516fcb6b73d6f40e796aa4b93245ec5287da2a8d7f3855f8b22381b4105f79c2257abec1ca5357caa137cc1f8ac55f7e42386bf41bf54c098a756d36f423f3c272752e3441858accfe389f89d99f6721f1059979afd4371a2263c3079f52e3ca0edf52446ecd1e12793f816d7f83c540e50d623f41cecf3477f6fb3446084fa8706a2b9da97483637604ece15a8b861a70c661e09bb508c83703f9f24998b118268bb58540e93a2c159b9829cb6f298541240ddeb20260614df8298140dd44227227d5d434486472c2388b89a73c5aad0cc9ca30c3a00bf587e80235f8c49b2dffc1a8f72e8b816304fbf2db0f70f3e08216b0f497d56e38591f10326cfb069cfb644b384295667d279c5afdba3124608c0a0db578950f465c489fe4f9a154da146b2ef53288fff259152f0a8843351d27b3f0f9a2f1553cb84cc57b8947ed5224ae37fd6790e7bea4dc21b54dc187808f095e4fd5f6e4ed8faffcf9c70a93c2175feb73e4755fb263e424854149248a37da8fb2382129e39b6cd7502459ed6b2ee8a25154327b72661987c95f8d08c8550b4e1f0c2946754f72305119b484d1e01d4d3dac5b859e3cfe916fa6272facfbedfe12eb4684e71a2698efda4c885bb908da4f212af505155da917516fb40617d863e20b134bc372e19585338ba3e7fef588bcc747a1bd61b965b87ace2e6dbec4d81a16f010a5531fbf7495bab86cd77dbe05e1dfee9c9652be66d2b26491ef88b250aeb3669093bcbc733406b60f4c571725baa137b18636949176044188ce975a5c45b4b9ea21758f01269d1505eb1364354c01421a46ed9643f992867faf922eca0487303edcd49dd11e8cc06fe174232c5f16912a245dab305294f2bd0e070c8bd1a08f64f4598c8e2e150e9854306270da82011b22d46410c2602622325f68bbb49c68ac0584e11cfa6496c8cce460e6508ab4c332025802cb1334fd09164203d690be47c8c258264e9f68cfb6e7a6558b7fee68bf4c68cae7cbcef3b98fa13c4b07319e0bb27f65e27fd1d65e2ffd1d69315052483636794b2f9d6c71b2223a5526eb2bf5516f7c813a0ce4fd89b2b6bee06264c50a9e4417f6be79fbaeae902e70392ab8279c29497a04f3ecfd4ccd09f0c3a33defbcb1bd6f513ab9399b02f99a0a1046250598221cf1ebb402537e6021fe6d07f3d3952789eae87efecfead65c387a4e68ac826f2a4cd4e70b48d59893731e734846ca03c1ceeaeac51d76bedb869b9ff7c735da4797dc5a4ca850b4c62fe587f183a18a8f80777f488128169b14d60bcc7be41d735f09b8018006e1fb757395e84938a0dde3fc890137b6d948a0aee69f9ca109f3336d62333e835d6bc62e0dba6f21267f6bec62abcaabd9a7c523597c2cc0cb2c5bfaf575db05e4e030268bb50fa247f13f3d6769aa58b6013ee71ced6201035af69f0952dbcfae7a7606852440a14dcbcc318d2270e644fc0c062db9a440b2fe16022a74deb29180b30273d942ba1660eed46cfaf18df81f9249cd01c148987a614344dbd180532a811eb3273d39ba20d5ec45c4fc58595f5239bc6a331670440f7fc0d94417ffe0e7d7ce9718ab612e44471a4ff0fbc93dc89fcc46b598ce93f3aabdd3b369caf717fc750017ba5c9b46f2e29e339649e47a92976256a87f12614104465b796713229e0036642d0a6d4cf819e15857df4dfdbb2667c78163b96fac5b0c2c96a78d53965db518c1012904b603c1614f05df11b7360aaaa4b40fd9bf515cd00eb55e388d4d5585ce9894ac88366eb1a7447edf902bfce6ae5408692456ed5ec6244879aee22149f40da0a2ae24b0756c2081fa8482f2105988e68c70603b67edada79154c2df345b65c9488efbe4e03ad39ed69572d96e9ad0beea74d80851fcccf19dbeaa59c002ef22d488b64ec4edea115a3e67af23b6dacbaf853a5e9bc6c4e4f051ed791cc112ea2daecf4c49f9ffc4f192075bec3cad5edd000e847246df4d90e68d75d53ea4cde527d45681e73c084c6fae2ebb80fcd3db2fcb37edba7046a5a708b61729936e14f18999c1614b6c4f6e2d66ceb947c05e5fdca7a0ec8a691c34297d1d2b8cbf348136ff561bdb9efd103acfb0d2cc909c4064ee58d3de7c85cfc0a9ef12a3a765d7f0c8c9e5d35b42f4a7ce2e74e8ad481c4e203405820186f4662021c858e0a43a257cd079d83526a7c35aa2bd90e9ee3405f64075dd6762df01bb05c97a3333a80d5b160ffd4b89f33dc6b2a834fdcc7c3f9627a7add823613f3b0f5328058383f0c797c8dc8948ca4568b9758e95257f8ea18eeab38c9703ad0f22e1a531be6687bf495cfe0a6557c91d6bdc61568abec696d1fa710c157c22e535620a7e338986509b10432f6549ea7e06796cc67d55d592440dd66f61556dbf3f45f3f04222aa7dec1c59907775c66d19ea3cd2b190d7602788d4867ff5a13cdaca2571976a78af19529dc7c3aa213b7add11daa08ad752dcbede2b19e61cb6d55f2cd86b0e6c3c9dc1349f661f45e302e79554a8e1753c53735817a22a5b4b2cafcf77ee39ee02132e332149e81c043ace09ff67662fc0dd0a27313915d6f12f374cc5091ecf439c09799733bc1b767c5a74f464ae03113ff2f4ed33fa8c9cf6fb4165d852084308a04e4cf23fb58c7c4f3a06240fd05bdda6d08e48db1925d8b060fbe2c2c5d2a6735a00e12a398133f862a4ed02c80ad4ba749cd29b46f27bc13008111730a78ccaad81823c61c458adb6ee1d60712fdd824a6412125b618d6285f1395793d88fa31fb1baa1337625c971ca3e7eeeb3c6e5fcfc4beecb857146ba4b3f006ad2f735fd57d64a442521a09028ae46c736786256a317ba1a5e64b29e6c6bce01f5ef8b121a8bee406ccccf2ebf7351400446ecba3ce1c6fc81f2161041834fc90446122d18a0ecd05d40e831a0194f49e582aa2545a2355aa9b571a9fa1ab3dee0cbc100ffc4f84818e3f1a27afc8172ee716101dee343d286de45a827bf9e06b1f0abaf7d9df9052f07364a56e56d9791dec4218e807ad23e6d355f44fc7484b028587d701235146f4a0e82148a06936a4d15018ce61af7b0a75c9678d39b382a6af117d7aff31ac5dcdeda468c04699c5374f9e0e9c57b28ac244732fe9f6380c6abeac574f6e5e6e2da5328fa791fa26d4e70f824df0d47b25ccb922d35068cba5b13b3bd5f88bbb854921e9bce25459d6477e77a08d9ae1ce96c97cec4ec40e7887a8d8315af3c72935664a7038e676d437e38aef3b041b261b1ac512ce8463b2253e9be5f10979585ac9d9ead6c56cc934694b83431c6fbe057c00eda20cea1973d09f29ecd45f0afb101e802f12059f4c33c484d3f6c81d0faeede78a4beb11f8a98fbeebacac2a9bee1a8d1f96e836e0925e305cc67ce48380987442494285a571202fb358f7ffb0252c2cc0e9a015fe3050066ace58edf0f53069d04d0533927474803c193c60d2f4b64ae301938c724ef7d0715ea722bed61609707806f12d1b996a5415d294b5af4bc2051912ce7f088d9a9d6b29a9f216d0ba6a6c80030746a59326a414ed7b6b8642e773b88dd36830aee3ef2f84b0ebe53350d6dca1cc3a3ecd7ce1d0e36499c4562b24697861cc1a4cac4dd9f962b61b871101289af27863371d544fba1d94f5d323c0bf177bcb1bba1c47ede2eeaa38153e651beb8ec831f4ff112309eff2ebb205737fef748b7ea1adce9c7e2ca0be2ee09e343feb41d314dc41ed8251085eba70d76d56b34b349208e5282610ac873f2d4479db1459805d6f8d84a415daeec1eeab7606b737262f9d59c1e43848e6c0eca147230b20774ea36ceb9d31ba0eff92c610abdc7fe25bfeeadbee39000113664753667c702ed08ec648c387ab3ca2f08323bd57d9a5cf9e6a45554deeaf47329894901ecbea1b3432b6202f7c21f73d7cecf2ec1edc338f1c98c6717248ac10271d648787cf21f357c39297d6264b9568ad48e04dc4087584c22b17558cb4e6eacc6fdc82bb3c9bced25128dab25324cee9333c966834a88ec1e7074cd64dc48eb72d10cb589158f182afe0ecc3b2b3364ca6fcfa28d71345ebbd717adb5e135582e79e72fb844e22f08635149b3eaf41ffbe4843c8dda68a5bf31af4cf961dd1249a4e22b109cbe32ca4f6311d7f7256702c3654851590c1cf608e17544abda3d9099e66af6ffba97eed10c18ad2828c51a9d06251e28f9a4dbf0c115ae93146d51759239da5757c6b7c641dc758ba399961d0ca8cfc081ec0b1bb2883174bc4af91f8d8b61b7de11daed5e488000f651c01eb902dd51f4a6793ddf68a6e9c637767924f6ac36a39f7fd7a05c1d7ed2da9e4ed9707587474719b002795bae2ec868fcbc4f368c35b7ba11be7af33c738ca990b3510c15ef30954274b61dd7a6f67ccb42e7a95a5ae976a04aac06e529bad678eab6ce98085e69c637c77877d384a74c1b1918b6dbfc941aac7921992f5d605d5a4be848d78088a1828829b939cf8fa062243f63af5ea6355faba06508affdb35f9490fe49215570ea958a7607ac75de6a4ecdf4c559526dcc2da87cd94dcfa37a19cd49001b6a2306c1461235b20c604363d1db7646bfd7fdc4e57c71f874b91f123a1a13811cffef31e8be9d7321117970b9c5d96972b37a0d626865d423fab5c72075f0dbd2553f5e540e6fbde790ce1afc33e5f9d67e91d9318f8bdde0cf149d785310851b95f5ae73c8e74493965b2fda1817472c9e01e794c6206a58c9b04c29bed8396a5a4c73b647201282cc5ec221aeb728df2967362a817308c58b022e580bfd3c9c8550867ad7e629353f3c67cc7f403e645de660adf55ea008c3632adf2b0a68b7a6587f1037e70f6d8314ce15b72aaea794521296bfdca62e147a799b9d31d34fbb7ec6d230d7973ad39af20adaae63f2f2728ab50ce16697851cebe397f74f001e274859c15e4dff3f7661fe4bc576c9254043ed3e5b00bfe092e56d2e0cd8e757d187243838fcee7ccca7eaab23255e49440d49299611798b1d3937d2e8d3bee637ab1d06b62ad0e343ce474618fa7389b24d1dfd10016f329f1e5b672093543e939bee6744f65965329177446dc981696ac4f0608813e2f72bab8f1c2a9d6f74f7019d3da7146791f6bf6eab7652e1a7848afed04c48eb6c174bf6932b7a61b0211caa032eafb9698f7a02bad4ca4558782314af0020d63d7ef16e2a1259e485ab4cca8ead4dd225b7a48748f05773f04646f420612eda014391ba1a34d2413f8090c55523716c737229407e1a275af5d3b8536bd8b2ee4a88e97b049541065bda7e3ddc149715dc5b73efb46117753a9bd35f1b8db1e9b55561143b5cd3a07e8bfe9a9b415dfa5d429f9c7458506c045df05a3e6f75bbe15335a0085128e939950993eedf5e7beae91279a2aafd03aea7a48af9c2116d4ca6c2829235ab444682461792d7abdf253086911058ace640d035581f5409a4b10181029030a28e8f58d7aa66452d5ace61e367dac485aaf419af73bbe721a6ee7e833bbfdd59d86cad3593dd6792490d6deaae944ef41ceb09b5fb047ff197da2bd71d9f8d88426e3587d7ee4db616c85343a35deb20c862d8a8f98b9471870159cc79a83b3355c39b65afe61ae50fed57224e0c452b452aa9738255366a53a927734d3cd4258ab0da842423871caffd9953d2ff73b3fee8e7e009bd3125555c6bba64a1f69bcec0571053c4fc0731bfa835b12458584e8c4e6e16be11d34ada4b50137dfd98bf3b911a3d3182ee334e37911b47e10a505ad8a3a28a0fbdc54a8bd0392936b616ab7a1c4eec0f42ee5e31d49fc1e18ebea7470de380,
        NULL,
        'image/jpeg',
        '2025-04-05'
    ),
    (
        14,
        2,
        'Manha',
        'Mahir',
        '2021-05-08',
        'Man',
        'Uncle',
        'Islam',
        'English',
        NULL,
        'M',
        0xffd8ffe000104a46494600010100000100010000ffdb008400090607080706090807080a0a090b0d160f0d0c0c0d1b14151016201d2222201d1f1f2428342c242631271f1f2d3d2d3135373a3a3a232b3f443f384334393a37010a0a0a0d0c0d1a0f0f1a37251f253737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737ffc00011080094009a03011100021101031101ffc4001c0000010501010100000000000000000000000304050607010208ffc4004010000103030006050a0308010500000000010203040005110612213141711322516181071423324291a1b1c1d12452e1153343536272b2f0163463829293ffc4001b01000203010101000000000000000000000005020304010607ffc40032110002020103020403070403000000000000010203110412210531132241513271a1142342618191b1153352f0c1d1e1ffda000c03010002110311003f00dc6800a002800a002800a004de79b61056f3894247b4a20015c6d2e5928c653788ac90f274a6d8c1212ea9e23f969d9efacf2d5d71f5c9b6be99a89f38c7cc8e774d53fc184a3d856e01f2154bd72f489ae3d1a5f8a623ff00347f3ff44d7ff43f6a8bd73f62dfe8b1ff003fa7fe9edbd3557f1608ff00c1cfd2bab5def1212e8aff000cfe83e8fa5f6f7301e4bccf7a9391f0ab63acadf7e0cd3e93a88f6c326624e8b30131a436e0fe95027dd5a2338cbb330594d95bc4e381cd4cac2800a002800a002800a002800a002800a00464486a334a75f5a5b6d3bd4a3802b92928acb2518ca6f6c565953ba69728e5bb63600fe6b83e43ef582dd6fa4077a6e91f8ae7fa22b52643f29de924bce3aafeb567158a5394fbb1cd545752c41604aa05a14005001400500752a5216148514286e524e0d7536bb11942325892c93d6dd2999170895f8868713eb8f1e35aebd64a3c4b942bd4749ae7cd7e57f42e16db9c5b8b3d245735b1eb24ec52798a610b6362cc5882fd3d944b1343dab0a42800a002800a002800a0028018ddee8c5ae3f4af9c93ea206f51aaedb635c72cbf4fa79df3db133eba5d255cdfd790ac207aada4f553faf7d29b6e958f93d4e97495e9e388f7f7195526b0a00e294120a947091bc9dc2ba937c2392928acb239fbf5ad827a49cce46f09ca8fc2b4434774bb4598a7d474b0ef3422349ece4e3cf3ded2c7d2a7f60bff00c7f82b5d5f48ff0017d18e59bd5b1ed8dce609ec2b03e755cb49747bc596c3a869a7f0cd0f92a0a485248293b8839cd50d35dcd719292ca676b848280158d21e8afa5e8ee29b713b8a4fc3954a337079895db4c2d8b8cd6517ad1fd2045cc065e01b9406e1b97de3ed4d68d42b387dcf31add0cb4ef72e624ed691785001400500140050033ba5c19b7435c87cec1eaa78a8f002a1658a11cb2da2995d350899c5c273d7094a9120e5477246e48ec149adb1d92cb3d7e9f4f0a21b2236aacbc28021aff7e66d49e8d00392543aade7013deaff0076d6ed2e8e573cbe10b35fd461a55b573228b70b84bb92f5a63ca7067211b929e43753caa9854b104794bf536ea1e6c791ad5a5014005002919f7a2af5a2bab689dfa8ac546708cd799649d764ea7983c13d034b6730426584c9476faaaf78ac36f4daa7f070c6b4759be1c59e645b2d77787734fe19df480654d2b628787d694dfa6b297e65c1e874daea753f03e7d87f598d8752a5214168514a92721437835d4f0f288ca2a51717d8d0346af49b9472dbd84ca6c7580f68768a6da7bfc5587dcf2bafd13d3cf2be164dd6930050014005007952b579769a00cef48ee86e53c841fc3b44a5befed5528d4dbe24b8ec8f55d3b4be05797f13ff007044eeacc310a0065789e8b6407252b04a76213f994770abf4f4bbac50465d6ea569a97633327de71f796f3eb2b71672a51e35e9e31515b5763c34e729c9ca4f2d9ee2c395314530e1c992a071aac32a708f7034369028b7d909ba85b2e2da7925b71b5142d2b18295038208e1835d225fec5a0a1bd1b9979bc36a2f79ab8e458a766af54e14b1dbc40e1c76eecf3b7cd889aa14793748cf46d15a0ca76800a00f4dbab65c4b8d2d48712729524e0835c71525868ec64e0f745f28be68cdfbf6920c793aa99484e723607076f3ed14875ba3f05ee8f63d674cea5f685e1cfe25f527e978e05a1ca7614a6e43070b41cf711c454e137096514df4c6e8384bd4d36df31b9d11a90d11aab19c761e229d426a7152478ebaa955370977439a9958500140105a5d7030ed85b6c90ec83a831c0713f4f1acdaab3643e630e9ba7f1aecbecb92814a0f56140050052b4ea595cb62203d56d3aeae6777c07c69df4ca92839bf5e0f2fd72fcd91ad765c933e4ff40d37461bba5e52af3456d623e71d28fccaec4f771e5bf65b763cabb8b28a372dd23588b19886c25888c36cb29184b6d242529e405646dbee6f514b846616dd0f54af2957454c6f5a0c77d533ac36385c515253cb2559fedefad52b12a960c51a5bb9e4d46434890cbacb9ea3a9285723beb2e70f26d6b8c1f35cf84edba6c8832461d8ee16d7de471e477f8d334f2b284f25b5b4765c3762b715c713e8e4b3d334ac6c527247c083f0ae269835849fb9e1c8cfb51d990e32e2587890dba53d551070403bb3dd5dca0c3c644a8382b19f722c86e432ad571b50524fd2a33829c5c5965764ab9a9c5f28d4604944d86cca6fd575014076775796b6b75cdc1fa1eef4f6abaa8d8bd45eab2e2cfa11702dc95c1709d473aedf7286ff007fd2b7e8acc3d8c47d634f94ae5f265d41cd3110050070ec14019fe97caf39bc29b07286121039ef3f3f8529d5cf7598f63d4749a7651bbd59095946614001a00a740b5ffc9b4f1c86bc98e97545f20e3d1a3008cf79d9e35e928fbbd347e478ad57df6b25f3fe0dc42528484a404a52300018000acdcb34f62351a4365725f9a22ef0152338e88484eb67966a5b258ce0e6f4496a80a27032779eda8923b41d33bf297a1afdcde6eed6964b92894b721a1ed8dc958ef1c7bb9569a6dc70cc7a8a773dc89bb8e85c3b868a43b33ae6abb11a4a599206d4b80609238851ce47e9508dad4f2592a54ab51f614d0bd1f72d7a2ffb2eecdb2ea94e2cb8dfae8502767c003e35cb279966276aaf10db2291a77a002dad3973b1a54a889197a36492d0e2a493b4a7bb872dd7d576ee2466bb4fb7cd133dad0642f9a0ef972cea689fdcbca48e4403f5a43d4e1b6ecfb9eafa1d9bb4ee3eccb0d2e1d0ac47d5165332107acd2c2aa7096d9268aafad595ca0fd4d5195a5c6d2e20e52a0083dd4f13cac9e29a69e19eeba70f2b212924ee143e017265321d2fc875e3bdc5a95ef39a433799367b6a61b2b8c7d9213a8968ab4d24a4b8f2f51a071b064a8f60ab6bab772ca6cb1c5ed8f71d222c6908cc574eb8f6546ae74471e528f1e717e7447f92db62d89f7f9921a536f79d741850db8f5c91dc7593b69b592fbb8c7f23cd420d5b393f56cb4693da255ee2b709b9a61c359265291b56b1c103860edcf80c1a8424a3c964937c1191fc9c68d34d80e477df3f9dc90bdbe09c0f70a9bbe6455712c96f86d5be2222c72e969b184071c2b207664e4e2aa6f3c962581cd44905001f5ae811efdf6d11a488d22eb05a7cff000dc9284abdc4d494258ce08ee43f3aab4ed014950e60d47b1de1981e9dd91361d257e332088cf27a7607e54a89eaf810472c530aa7ba39155d0d93c129a023f012cffdf1fe2294755fee47e47a2e83fda9fcff00e1168a563e0a00d1f45dee9ac71493b529d43e1b3e94eb4f2dd52678fd7c366a66bf5256ae320dae4be8edf25637a5a51f85466f116594acd915f9a32c1b85213db8500cf720fa060676007df9dbf4ad95fc08cdf8e44731225aa6244504af5b0948fad5ca253391a0daf0969790028ab6e38ec15744557af314b76c9334ff004b6eecbf72970acb6a5a23a447560baeea82ac676641de483b315a23c216d926e44c33a2713475f0ab36944d69d47ad166ba1e61c1d8a4e014f31baa12b209e1b29f1d41f72cecafa5690bd9d619202b5803cf8d4729f637c26a51ca3dd70985000402082320efa0e32b776d06d1fb936b020b711e564f4d1121b39ed206c3e22ad8db2441d71635d0b8175b0cc91659cbe9e086fa5852123663385271ecef071cf15db1c64b723904d3c3203cb5474f476a9200d7d671acf7601fa55ba67dd19b58970c8ed0b63a2b225647ef5c52fe9f4a53d467baec7b1e8ba357b34d9f7276b00d82802f7a10bd6b42d3f91e50f91fad35d13fba3cbf568e3519f748b0d6b160ceee336a9807f217f2355dbf032ed3ff007a3f3465e2919ed505002eca3ce192c8d8e27ac8efed15a6879f299adf24b709da61bccdd8b81243652ad7c8c63fd35a639335a96328b64556ab5cd59ab6260b566431b595d9747aeeb00a1f7ae4eacafb95820ffeb53b65887024d5b70cfe66377dd34b8dd9b8894fe10c7d7c2d859497124e53adc0948d99e356c698a5868e2aa2961a35bf269325ced0f89227a8ade52dc1ac40054028807672a838a8bc23651151861169a8978500349735b655d1079a6dd23617428a4779c0fa8e75c738278666b7510ade1be481bc1d38b63267c24da6f11523594cc76d6db9abdd951cf87baad4a2d1157b63bd10d2887a536f5ca8a8534eb6a087985ed283c36f10781ae4a382f84f7153f2ccbe95167848daeadd5a827b77247c4d5f43514e4fb19f54b738c57767a851d3122331d2763480807b702bcfdb3f126e5ee7b0a2a5557182f417aacb82802f1a0a316a78f6be7e429a68bfb6cf33d61fdfaf97fd964ad82a13908e91871bfcc923de2b8d6560945e2499941052754ef1b0d216b0f07b783cc531290fb51d953cf2d286d23254a35d8425396d8f7236591ae2e53784546e1a64f6be2d6df4601d8eba32af01bbdf4e69e9918f363e4f39a9eb729e552b8f763f81e5127ac34c3d0197642d41095a56521449c0c8e7d95a65a48f74cc90ea53c24d726a6105294a4f0001c56337a79e59d5b21f614c3bac5b560900f1ae359586537d50b5624511ff0024701c92a718b9c8658528aba3e8d24a41e00fe95a158f18337818f52fd66b63366b546b7452a2d4746a852fd65779c0de73506f25d15b560769710a596c2d05637a42b245472992e4e3ae21a696eace10849528f70ae9c6f83e6cb8dfa6dc2f322e4a972505d7cb83a370828493d548e1b06055fb238c34609252cb68df7c9d5f59bd4452e1c77588a412da1d5eb2b295149271b36efd9b2a88adb3704510f2cdc110de4eda69cfdb97560252cdc6e4ead829dca6d2a290a1cceb54a6c614278c8a690b76a3756ae53dae95f423a2601ca8240249206e07277f2aaa563dbb7d0614e9a2e4a6fb887ed38ef27063a4b4788359da8be1a192ae5dd31bc86ba179480723783da2b1591db2c1aea9ef8e44ea058683a1cd16ec6d1231d2294af8fe94df4ab1523c9f5396ed4cbf226eb4980e1a00cd2fd1bcd2f129b1ea9595a792b6fd692ea23b6c68f5fa0b7c4d3c5fe9fb156d22b448bba1a6da94969a41c942924eb1edf0abf49a985196d64cfd47456ea928c65848aedcf47a3da20aa4ca92a79c2421b6d09d50a51ed3b4ecdfe14ca8d6caf9ed8478136aba6c349539d92cbf4441c353a8991d6c235dd4ba85369c6f502081efadf36945b7d85504dc925dcfa3232d325843c8dcb19c76775294d35943c6a507b65dc4aed24db6d72e684eb18eca9cd5edc0cd75f0b2760b7cd47dccd2c77398f6935bdd932df51765b495fa420105606396ddd596126e6b230beb8c69928af43697608392d1d9f94d6f711046e6be22211a3ccb32d325965c6dc073d451c1e63b2aaf0927934fda538e323e311d5a4a56d65246085636f3a9e195bb61ee64777d00d1f957e7e25b2eca84f073d244d4d64a4ef210767bb6e28f1f1c7a927a494a1be3d9977b65a9ab5589db5c1756c1751d117903ac8471d5fea393b7bf75570cc5b93eeca2ad0b4dca4fb8f58699816f6e3446d2db2d2036d213b923850d8c2105948abe94bcc94b51c759f49d6e43f5d955b37c10ca0c75f4696fdb51ce3b2ab66a8f963c8f642c2dd2527290024780ac76cb74b25f545c63c898054401bcec18a825978272692c9a95b6388b0588ff00cb6c24f3c53c8476c523c4dd678964a7eec73532b0340151d3983b189c81bbd1af1f03f4ac1adafb4877d1efc49d4fe68a8d2e3d0156d3965f902034c36b70952f0940ce4e07eb4d7a64a117272620eb909cfc38c567b8ae8d68f180bf3b98019247511bc379f99f95475badf13c90ec4fa6f4c74bf16df8bdbd8bb59ee660b850e64b0b3b40f67beb25176c787d8ddacd2f8ab72ee59de698b84271a5616c3e829383bc114cb89212665097b3454b45740c9bac95ddd2171639c33aaa29e98ef0ad9b463e7caaaaa9f36597eab5ed56a35f77dcd16145762a3a354a71f6c7abd280540766b71e676f7d6a4b028949379c60775d2246de644f661beab6c54bcf86c946b2f0338ece351936970595a8b92527c18225c7dd961e4952a4adcd70a07ac5c2739e64d2ccb6cf5388a8e3d11b1842b035c75b1d6c76d6d156e2174aaff1ac0884662565325d28252325000f5b1c46703c6ac8d4e69e0aa5a88d525b88c7ae5619eeb6eb7748c5c73aa94a5c1aca3d98df9aa674ce29b6bb1ba9d5d6ded834d9d5ba848288c92949dea27acafb0ac165b9e2232854f39988d506825b45a0f9ede1bca7d1b3e917e1bbe3f2ad3a686fb3e42eea57f85434bbbe0d140a6e7953b400500379d1913233b1ddf55c4e3954671528b4cb2ab1d53535e86632e3390e5391de1d76d58e7dfe34927070938b3d8d1746e829c7d446a05d84140602801e5bae4fc05fa33acd9f59b3b8fdaaeaae956f8ec65d4696172e7b969b6de1893abd12fa3771ea2ce0feb4c2bbe33ec25bf493afe25944cb73b8389f14d68dc2f951ec2c25b27dbc7315ddc8add73f638a96c8dc4a8f70ae6e4755536542dba2d6f837493704a54e3ce3cb71b0bdcc851ce123bb3bea855c54b70ca5a89ca0a0fd09099322c41979d015c103693e15c9d90872ced54d963f2a31df29931f9d788ceb8486032434df04eddbefd95af436f8907f331755d3ba6c8a7ce51501b0eb0d87b456e7cf02cfccd1f462e46e56c4adc565e68f46e1e24f6f8823e35e735b47836f1d99ecba66abed14acf75c325ab20c5bc1a168b5b7f675bc175387deebafbbb07fbdb4db4d57870e7bb3c9ebf53e3dadaecbb1355a4c2140050014015dd2bb299cc79d474e64b43681eda7b39d64d551bd6e5dd0cba76b3c096c9bf2bfa14514a8f5282800a002800aee19c7864e59a5c90c281754a015b358e71b2b769e72dbc8af554d7bf844989ef71083e15a37b32fd9e231b95e2547d40d06c057129cd5175d386305f468eb9e77112fdd273fb1725601e08eafcab2caeb25ea6e86928876434cf12726aa66a492ec5734da197ed889081d68ebc9fed3b0fd298f4db76dbb1fa893add1be8535f87f823746acc8b959a579c0d50e39e8978da9291bf964e3c0d69d66a9d37476fea62e9ba057e9e7bfd5f0c91d13b7cbb6489acca4612750a569da951dbb4567d7df5dd18ca3f99b7a4e96dd34e719ae38346d13b3196f267484fa06cfa307db57d87cea9d2d1b9ef97625d535bb178507cfa9791ba999e74ed00140050014001a00a9e9368f170aa65bd1e90ed71a1ed778efeeac3a9d36ef3c473d3fa8ecc55676f47ec53f9d2d3d127941400d9f70eb6a83802bd8747e975c6b56dab2dfd04fabd4c9c9c22f811c9ed3efa7fe143b6d5fb18774bdc95b55cdb8ed742f02139c85819f78a4fafe992b65beafd8b6bb71c489237584139e9c72c1fb52bfe99aace36fd4b7c58fb91176b80965086810849ce4ef34e7a7f4ef0332b30db299d99ec47e4f69a67e143fc57ec57be5ee2ac3842802720d22eb1d2eb9d4eda9624bdbd4dba4d4c94b6c9f0c5de690fb4b69d4eb36b494a9278835e3a3271794379c2338b8cbb3065a6d8690d3480842000948dc057652727967215c6b8a8c561227747ac2e5c961e7c14441ed7173b87777d69d3e9dd9e67d85daed7aa16c87c5fc17e65b434d25b6d212848c048dc05344925847997272797dc52ba702800a002800a002800a0081be68e33712a7d821993f9b1d55f3fbd65bb4d1b395dc63a3ea13a3cb2e63fef628f72852adaa2994d290af64fb2ae46a8d268e76ea63535dff0081efdb2a9d4e70644efafa12492c212642ba01400500140050015c78c619d448464ae494219429c717b92919cd7cef5ba5746a655a5feb1f577c7c2539bc16db2e8a1052fdcf6f10c83fe5f6ab29d27e298a357d55c96ca7f72da8484242520048dc056f121ea800a002800a002800a002800a00280127e3b321b536fb6871b56f4ad208f757549c5e533a9b5d8ac5cb42213e4ae0bab8eafc846b27ee298d5d4ed8f135945d1d449772bd2f442ef1c9e8da43e9e0a697f438a615f52a25df82f57c1916f5b2e0c7efa1484f7f44715aa3a8aa5da489a9c5fa8dcb6e0382db80ff0069ab3c48fb9dca146a14b7bf7515f5ff006b6a3f4a8bbab8f7920dcbdc918da3178938d5865b078bca09fd7e159e7d434f1f5cfc8addd044f5bf41402157196558dba8c8c0f79fb560b7ab3ed5c71f32a96a3d916ab7db21db9ae8e13086871206d3ccef34aec9cac96f9f2ca25394b86c7950221400500140050014005001400500140050014005001400500140050014005001400500140050014005001401ffd9,
        NULL,
        'image/jpeg',
        '2025-04-05'
    );

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        15,
        2,
        'Yunus',
        'Mahir',
        '2017-09-03',
        'Yunu',
        'Uncle',
        'Islam',
        'English',
        'none',
        'M',
        0xffd8ffe000104a46494600010100000100010000ffdb0084000906071112121512121212121510101010151515150f101510101511161615151515181d2820181a251b151521312125292b2e2e2e171f3338332d37282d2e2b010a0a0a0e0d0e1b10101b2d2520252d2b2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2dffc000110800e100e103012200021101031101ffc4001c0000000701010000000000000000000000000102030405060708ffc4004b100001030204030505040605090900000001000203041105122131064151132261718107324291a11452b1c115236272d1e192a2b2b3f02435637382a3b4c2f1081633344474758393ffc4001a010002030101000000000000000000000003040102050006ffc4002c110002020104010303030501000000000000010203110412213141132251053271334261142391a1b181ffda000c03010002110311003f00c423412805a80c4a09485971c251255912e382411a25c7094d109f6b093a0bab7a3e16a896c4372836d4e9a7543b2c841664f05e154e7f6a33c506c64ec095d1b0fe0a85963212f3bdb60afe930b859eec6d1e97fc5665bf53a9711e47ebfa74dfdcf072da3e1ca996d96336ea7bbf8ab18b822a8ef947995d39b194b1092927f51b1be10c2fa7d4972ce6f4bc0531f7dcd6f96a9f9380643a0731baef7274f15d262a429f6d075578eb2e6565a4a170736a7f677f79ff002205b4dc7e362abab380ead9b33b416f79a5a6daf369d765d75987b473522386db128f5eaaccfb9009e96bc7b59e7faec0e7885dd13c580be84db4bdfc954cd19001b6ebd3a2db10d75fa807459ac7780286a012d8fb093521d1dc37378c77b5afd16855ab8fee42366964ba381b764d4ad5b8c6fd9c55c07f5769da6fde6f76de60ac85752be2367820fa2d285909af6b1670947b4573a14914c96e96c9b33a159b3c92b23cc813a230a20992db22b56d3e8e68936085c28c5c85d1304127384145ba0bb071a575c1b594da7a07b85ecb54fc1db7bd92c4194580e4b3ddaf3c0f2a518a9632d3629b563894243892abdc8e9e404961812484a4a6477365cf8210d00aef04e1e926373dd68dc9075f2575c3dc33b3e400f8725b3a7a46b400068162eb3ea8a398d5dfc9aba7d07eeb3fc1558670fc115b2b2e7a9d55b362521ac4b0c58965939bcc9e4d14e31585c1144374e766a4088a71b1ebeaa8915760cc515cd94d8a9c04b899609c4cc2290bce6d80208ae85d19306289402241162c8160a504809413302ac75a01599e2ce0c86b18ebf71e468f6f23e23a2d230a7d8e4749e7745e18292f0cf31e3dc135d4d98be12e6b49ef47fac05bd74d5655c57afebe81b231cd3b39a5ba686c45b45e69e3de0d9b0f9ac5b78a427b37b6f623a1fbaef0f50afebce4f13eff00e8a4ea515989966b9498d4522c96244d5166d7c80689285d46322232261eaa246d24e64145ed1055fea91db4f43862069c14f06a34b21a7232b8e612f76ad593a8a7730d9c175279bac4f1547676dcd1a0fc149e5f25035a4ad970af0d977eb5e34f8414cf03f0e19dfda3c598cfeb1e8baa53533580000580b792cafa86a9b7e9c3ff0058e69aa50f7cbbf055c14840db4f000052194fe6ac9058be9a1c77c990db0258604fa4962ef4caef6fb1a07fc72468cc7e286452a2cec8bba04a2411510046905c905eac89c0e664039328c23449da3c0a587264146133028d12014fc6e508393f13d33003326b0aa9e2ce1e8aba9df0483de17079b1e3670566c2a446a6c8650b378678f31cc35f4d3c90482ce89e5a7423c8dba282baff00fda0301cb24558d1a49fa97fef004b4fcaeb90d9745e572024b0c2411d90b292a26c8234171c7a41a89c8a37a54a74474c2b5c8d39ca8714a3ede564605cb9c02b2aaa90c049e4ac3836973dea1dd4b59f9941d45de9c1b41e986e7cf834384d03608db1b790d7c4f35310ba22e582de46fb0d0482e444aa9d815745749ba49729c96c0b2524b920b916652996da2dce492526e90f7a944a88a7393524c00b9200ea74492e5127a46bcddf770e4df847a7356c7c0551435363b18366074876b009071797953bff00adfc14c635ad1dd00790011f68af14fe49697c11063a5befc328ea6db29f438a4528ee38791d08f448122667a48a4f7982fd468e1ea9a865029245b8727a32a8a274b17333307ffa34787277d15b52ca1c0381d0a760256f05944a5c614288a9b09569742ad996f6a98536a30e99a46ac6f6ad3d1ccd6ff2baf2d386abd938b401f0c8c3f1c6f6fcda42f1d55c45923daeddaf734fa1438f60e5d8d2096d0839a8bb1e325723682195055c338ef30d5295dbdc6eb0f0d7bc2b5c3eacbcea51636c5f00271b17bb241c72694ca19a90e7017f35d6b0aa71144c60f85a07adb55918291ae2d2403a8d7d56cd8e59bf537b64a269fd3e6e75b6fe476e85d233a4972cac8fed164a49726e59001726c02ac9ab647e90b74fbeed07a28722f183659c9281b903cf450df8a443e307cae543186026f23dcf3d392951c0c6ecd68f40a3730aa1143d0d4b5fee9ba773260255d4e4e711d25209457448d0792120129a7391bca69e51922c1172417a4b8a497222440e674b6bd47cc94d28b16524898c7a954dbdc697dc723e3e6abda54ba676a9ca9f023744bb80a9f0aafa65631224c445c8342bc7bc43116d5d434eedaa9dbf295c17b0dfb2f22f17ff00e7eaff00f773ff0078552b599149154023b2174abad08a58c031bca827105db1106e62dd5bd253ece0554b429d4150415975c929721ad8bdbc1b1c2dfb7985a88deb1b86cc2e0ad4c6f4afd5573190cfd2798ce24ccc89cfb6bb59340a44eccd669db9f8f82c9c9adb48a5865377e8c1eeb7eff8bbc149240d07246f29a7150112c865c8ae904a2cca4be07414b694d34a534aec90d0e224688a256ca0db9312393ef2a1554960b42b867a0729606e596ca2beac0e615362988e5b9bd875597a9c7c5ecd25e49b002e6e79580477563b03eba3a0b2b9a79a9515403cd61e8a9b1291b765154eb6b131b982dfedd93861c562399f49501a08bda3749a5f5f76fc90b0fc13eb43c9bf88a9512e730717c8c759ccb58ead21cd20721d56db87f16654b0b9a082d20386f6247546aace7052c49ae0d551956912a9a156d126a7d199258638fd9790b8b0debaab4ffd54e3fde397af1fb2f2863f134d5541bea6aa73ebdab95a8af7c81592c144184a5c709e8a7b1ad09c6d93be83f905bc81d8141586882bfa6c8dc8d0b5c9c63d476b9380ac1f23a69f0b9b65b1a692ed69eba7a8580c2655b2c265bb4b7d4226b21ea69b2bb5c94d0d9e96a70fa9705c31c97751e2727dabcfe4f4325810e4db8a79c16731ec7d91021a439c34b72df5d7a8564b24c4b29aa0377202af9318886ef0b9ae39c5a6fde7dfc1baacbc98f12763e64ffd5370d2ca4b9053d6550fe4eef4d8b46ed03c1f556b13eeb8870ace6799b1f6cd84c872b1efcc633213a31ce1ab2fb5ec5752c359554cf10d533293ee3c1ccc7f80775f0d0a1db43ac9ab535ddc47b3481114186e8dc10a0f0cb0cbd50e3751941babe902c171fd5e489fe47f9fe6b674bd645750f08e71c4d8f3a590804e506cd6ea2ffb45514758e0737306e2c48b7911b2bfe31c2e8606d39a5abfb53e6873cf60d0d8a4b36cd6db6ddc329b91947559828cf9329bcf675bf679ed3ea202d6543df3d3dc35e1e4be5801f8daf3ab9a3a1f4b2f41c3235cd0e69043807023505a45c10bc79c1f117d4b596b87325cde4184fe202f507b367b8e1b4d9b711968fdc6bdcd6fd0043ea5807178782d318c0a9aa9b9678992742459cdf16bc6ad3e4572ce23e189b0d78961924753e7b8b1b189c4e81e068472cde8bb2a62b699b231d1bc0735ed2d20f3055a50520f0b1c594982548923648d26cf6876ba1d7a8e4af62591e1589d09969dd73d84966936d6270bb4fe3f55ad88a22798f24dab9e071fb2f28e3d8257769533fd9a6ec8544ee2fc86c1bdabb5b6f97c6d65eaf76ca9590b2327316dde49b1b6a09dbc55aa938be0a46b53ecf230a829d65515a9f6a7c36da2ae73636da19dbdbc406cdb921ec1e01d7f42163d33ba7f201ac3c12bed25051d05deff0092383641e427d8fba0d682132f66559db78ca0dbb92d2825b396c709a9b106eb9fc52ad1e0f5bb046a249fb58bea22d626bc1be66ff50a546ab2827ccc07ee9b7a15650ac0bea755ae1f07a4a6d56d519af25471657f6509b3dad73ae0026c5cdf8837c560788b0e30500a99afda563b253c66ff00ab872973e577525a2c072cc0efb6db8870afb455d2c441cb23fbfd3234e670f0b807e6a17b7da173a2a5701dd1f6887c039ec6167d23704c69a09f229adb9c23b57938ed7e0f08a08ab3ed71ba69a67b3ecadb17c51b7377dc41b8d81d40d1c16791b858d8ee112d5338b8e1887b494c5c9f1bcf939a3303f45ea4e1eff2bc3e9dd30cc65a788b8ec7386819c743717bae0bc07c332ef9489eb1a6281846ac8891da4ef1c9a00d2ff985e91c3e8db0c51c2cf7628d91b7c9ad007e0979e1c9a22b6f7368ceb20730963b52d36bfde1c8fa84a2d5638ab350ef0b28791654e3b66d1b55d9ba29b224ad5cdbda5c44c4fb7dc27e5fc9750918b2fc4384b66eeb81cae6b9a6da1b39a41b78ad1d3d9b51d6437c708f39b8254719710d00924800004924f2006ebb7567b1b94f7a19a9e66900b7b66be37869d81732e0ab5c07d95cf13839d2d3d3f534f197c96f091f6cbf2298f5518af7758317c0dc232b3b96ff002baa6f661bbfd929c919e493a13a69bf2e6bd0b85d1b20863859a36263636f9345942c0b02829185b0b4ddc6ef7b897be47757b8ea7f05677548b79cb2630c72fb17742e919946a8aa036d4ff8dd1d17dadf4429630272e1f131a0fa1365650b957b7ef1d495269e45748bb8bda89e16531d6097b488fbcdef30ed6205c2d530aa8c6e945db201de0f66bd412010a23d96d349466717f6ad79a829a676afa7a97404f3c92464ebeac0b9405d97da6c5930e9c72fb7c21be7df27e8b8d808b1ce12235e92bded0ee823b2345c3133694d229120b854f87d4e600ab589f74875c046b230f610a451d4e528dcd51decb152d794553f0ce9fc2cc73a3ce4e8f0401d6dcd5fc0b1d83d7399041945f33469ebaad8c05636a6c73b1b67a0ab4ea9a62974f91ea6801aa81ff75b30f2bb47f02aef1cc1e1ab85f04cdccc78e5a16b86ce69e4415594e40735df74ff002fcd5fb1e084c699fb5a33b549b92670cc6fd8ed487f71b1d4b39383fecf25b90703a13b6b74ff000f7b27a963c38c54f05be395e6a9cdf16b0776fe6576ecc8b326b2df1913f4d14dc3bc370d2025a5d24b201da4cfb17bedcba35bfb23456ef288b93324b6519482c61e111711d40f3515ad52247e62900242de65943b0e2381873144a8a7bebd14f7b804d17044a9f80d19325e1151958187e1bdbcba2b2ed075544cf04a2e3d6cafea3870c5e7426f28b97481312d6347354efcdf78a60b4a957b2d1d2af2cb29f14e4144fb412a36508c3d161673961d5314b8270914ba67aaa6caa751bb54e57272016c14625d44545c45b9ac2f623bdfc14985720f6b7c7953435bd85388c175344fcee05c5a5ce9068dbdb903aa22fb8463251796527b72c498dec68587339ae7554dfbce196307c6c5e6de21727053d5954f95ee924739ef91c5ce738dcb9c799299440339b9cb731799048415b73064cc2eab29b15a682558b57f84d5dc58ee12d647c858b346d75d2646a66091480a8991246df83acea76f58dce6f9735aca52b9ff0004d7064ae89c74905c7ef0fe4b774eeb13e2b1f550db6337b4d67a942fe382c189e8eadcd51e27259210936ba2b28a7c344c6e2c79840e2de0a0101000227ab3f929e857f04b7624e3b0480e73bde3e89b6909c6b973949f6ceda974879a99a99c3479a582a2e2149da8b662d3d42acb38e08825bbdc5655e2a07350ff004d5b5e4373c925fc2449bf6ce75cdfbdaa9f4dc3e1a2ce75c7c823513507963d274a8e131dc32b33dc8d8ab225311f631f77335bea0254920dae997fdc59c0abc6780dcf4c3de89ef51a59528de0342029f3268cca2c93264d422d796c338e116914aae30e75d6519562eb47843ee02d7a618465eae7e0d1c3b2f30fb64afedb17a8b6a22eca01e6c8c66feb172f45e3b8cc7474b2d5487bb0465f6d06776cc60f1738803cd7912aeadd2c8f91e6ef95ef91c7abdee2e71f992a7c99921a477492e46a725300ba08905c70a4e52cd95d74da22171c6b68e6b8055844f597c1eaeddd2b430b92f28e184ce5135a482083623507c56a705e267f6b1b1e3de70617798d3eb6595694991dcc6e36f02876d71b2386169be753f6f476092b5ac02e7576c3aa784c08b8595a0a97564032ff00e2b2c48e771a1f43a2baa78e66b06661bf300b2fe7bacc552d8d7ee5fecdb5b658927c327f68876aa1cd2b18d2e91c5b61b68132da8b807a8050f0d72c2a8265ab654e364552264e32a54112a4b76c88fb455eca946671d573605d5c962d982a8e29c73b08bba7befd0787528dee79f72dea6cb398de0ce7bf3cce0e197286b49b01e24a98cb9e42d54477a72ff073fc478a4ba4b0cf238bada75e83aadaf0e6295196d2b5e5a1b7693625a7ee92a2536054b13b33236b4f5b6a15d7681b10039dcfd56b695a93c2e88d5ee84333f9e0b6a7af0e6dd335150b32da973526a312364b5943dfc115cd60b5a8ab0157c95f7d955c950e71e6a4d2404909ba28c72c1dda8e0b7c39ae73879adde0f0e8150e03877321633da57b4b6b1aea3a07ddc4164d50d3a31bb18e170dddb82fe5cb5d43ade11936d9b995bedb78d454c8286075e1a776695c0e92d40b8ca3ab59afa93d015cb5acba5323ba772d90bbe45db13910b2994948e772561fa28f429dab4ce51c8bced49e0a2c882befd127a2089fd1c8afad1281041112910e2a27e575d6aa8a6ccd056495be0953f09549c728b45f269e17a7a9a3cef03a9506372d070d53667dfa21d71dd2488b65b22d9b9e1ac3c44c396c1cfb126dd0683ea9da875693dd6c405f72f26e3a8164a8a40001e36fa213d3ca7564e19e0e6e71f88486b311d4b4bf8367e96dcb4b193fe7fe99dc59933a68fed01b68eee1a117e7aeba8ba71d888ea14eac82523f5ae64845ec5adcba795cae738dcb253c96d4b1db1dcb7c0a6351a69598920f4eaa1526a5f26dbf498ea118c507558486bf3ecefaa9d13cf549ca8c7634b5119731362316094dc5095988d4a8e5b2a3823b72668c62760a9313ae95d7b129427090e75d44609b21cf1d0de19048e3795e48fba34bfaab89466e5b0b01d026a91bc82b1642b52ac46384236c9c9e64ca9929aea29a15a17c239d80ea745163aca7cf93366237b0d07aa22adcba40a57420b96575361649d07d16a308c06da909da1a98ed768015ac3504ec99852d76675bac52fb4e53ed3eaf190d747f667d3d26a0ba13db76adff004b233dd1fb3603add7250bd7d4f3b872041dd6278d7d95d256874b4a1b4b506e6c05a195dbf7da3dd27ef0f5055670c0bab73d9c0186c1069d7552b16c227a495d0544663919b83b11c9cd2342d3c8850c34a849966d1a9c325606f2560daa6f82ca533ec13fdaf8adaaadf6a129d09b34ff00696f820b31da1ea8d13d529fd3af9295028040ac13404a769a4cae053482e24d7c125c02b57c355618d37df5585c227bb6dd15dd34846c50a12f4e793adafd48619d262b9a56ca0f7a5748e1e4d76403e87e6b15fa7e674a6391ce6b41b5af949f33badec705a8298ffa1d7cc92eff009be8b97e302d3dfc567c65bb5127246dd5ecd2c6316742c32405ba7e67f1555c4940d91bb6b7d3c0a18255774792935f266161a93a0f171d005b51e4cab1e33931588e05dd12447292d0f1cf95ecaaa9f1499a3501de7a15d325a36b581bbe5606fc82c3d5d200ed022dda684b9c19da7d55916d26370f117588fa109d1c48cfb8f1fd1fe2abe781448a3d3d4a45e8ebcf468c75f72f25c49c5513742c97e4dfe296ce30847c327c9bfc565eae56b9fd9e9a0dff006ba28474427a7845f01a3adb5ae4dbbf8f72fb9113fbc40fa0517fef7d74e7246e1103a5da05c7a9595823cc7c00b9f00ae292a3b38eed63ae37711665bcf7babc2115d82b6f9cba34ec99d1b3bcf73de752e712e24faa85455a6fbeae77d1418eadd234170b5c6dd14da6898366dcfcd352ba2b842d1d34e7cb36183e259b40e176f2574caf70e656230907b50d02c24fa3c0d0aded161c74beaaeae8b5906f4b352c1368abe4f123c569282b336fbaa8829eca640d2155d8a45de9da13c61c274f8943d9ca2cf6826294005d13bf369e6de6bce18fe073514efa79db67b0e847baf61f75ed3cda7f8f42bd4b4f2fd7f1594f6b3c2c2b690cb1b7f5f4ad748c206af8c6af8fe42e3c40eaad5cf6bc3e994dad1e75011a011d93c9140d04682be0e2a823441058e3204a494a52413f0493bd65aa8678e21da3c8d350162f0e932bd3b89d4173ad7bf4087c279674936b0776f67f8c3710a17467ba6291d1ebcbe263bcac6de8565f8f7871d4c639448d91b2b9cc3605b91ed00db7d6e09fe89541ec9b1834d58617dd8daa664ef5dbfad6eacdfaddc3d42ecd8ad71869e6963caecb18985f505a3de23fd924fa24251feffe4d0aec71a71e17672ac26a6c2c353d06a56930c85c4e6769d3f67af99fc35511f8bbe6198e5041d43400082742b5bc26d8ded717b03fe1d6d61a5f6eab55591a2bdf3e442c53be5b23c22ae678d42c5e2128b95b6e31ae818c698632c739ef8ed60012034dc007c5739a9a4a879d801e2e08f1d42b20a4bc8a2d3ec93443a89858a8903f4b7453bf404c779183fa4548838748de51fd1fe68396d87513278941639c7af9f54db4179d39efe6b692f0bb5e08321d7a008a0e19318b32406dd5b6bfc90669f80f5479f71518760e438122e09008b96dc1dc5c6a168a5c3dae665c8c003da0771ae2d1626cd91c73b469cb7f0d94694cacd0b1da736f7bf0d42b09eaa3ecc3c59ae700e2d765616bc139bded4df5b5b7b8f208d8e69a6d1a31857e05d360c3a2b3a7c1c05170ec598ee615ec152d3cc25ecb269f23b5d706b82345876521c06ac7070f4375bf82116594ed4596da9d966b7f747e0a69b1b6f20b5104b013234f35896d625654fc6424d01814aa69391e4a21900f149354c6074af395b1b0b9e4f26345eff44c439425a9f6f28f32712d1886aea2268b362a9998d1d1a243947c957abfc46613cb24ae16334b24a7c33b8badf550a4a00765a719212c95c829bf6028226e4764cea30820b206c24a4105620283de1e6bb27b32e5fe3923412f6741eafb8dd7137bbea157537f9b9bff00c7cbff000f22082565f743f2332fb25f839de07b7ff59fec2e81c15f1f98fc0a0826753fa0c0e9ff0051149c4ff07fad9ffb31aa308208da6fd28fe05dfdd2fcb025b10411d9c87989f6208214ba0b11ba95024fcca082af822645c43e1f4fc959e1fb20824b526968fa2ef0ef7d9fbecfed05d35a82093a7c85d4f81326ca3a0827e1d09c837aa0e39ff37557fab67f7ad4104f53e0cfd57dace22138c4104d2157d0fa0820ac50ffd9,
        NULL,
        'image/jpeg',
        '2025-04-05'
    ),
    (
        62,
        21,
        'Akash',
        'Abdulla',
        '2014-11-11',
        'Yunus',
        'Father',
        '',
        'English',
        '',
        'M',
        0x0000001c667479706176696600000000617669666d6966316d696166000000ea6d657461000000000000002168646c72000000000000000070696374000000000000000000000000000000000e7069746d00000000000100000022696c6f630000000044400001000100000000010e000100000000000026c50000002369696e6600000000000100000015696e6665020000000001000061763031000000006a697072700000004b6970636f00000013636f6c726e636c780001000d0006800000000c6176314381040c000000001469737065000000000000027200000272000000107069786900000000030808080000001769706d61000000000000000100010401820304000026cd6d64617412000a0a19266719c782021a0d0832b44d11400104104140f4bacdcb2f4897a2cc596702a06eea98f366a32ea28aea988b11e0e304e18f75a564de9ed42989b6f69031142d2c99c4c9ba738925ca97255edd32d4dd89630e0543d10e3ff00d31280d80e25aabb092271c393c51eb749acc997a32e9d9d1a263cbc94d79faa7dff996d0f10f33656251e347fde69fee98bad3cbebc5640649af81591a34a8a60745ebb184948654b2e178e50408b09a69e60e648b3b938e5644cca0fa380ad33df79fb0106c4cae238658410c156b15172ce74422c437880d4a02c46a14e9882e3bf270c4e384f678e9fe9be5a38ce6400b0e148861713c16b4ae2a349c0cfc617277a101eb43b2c697d39e32f8a2a623990a8e513ebd1e33d0113d77d267c2c372250fdf35f71170f3c0a149ecfd18597a35b1067479ac03394c5280ff541c44c7f8da31824dc07397a05ddbf1c20039c86ea1cda9b7aeb044970a20c7b787933c567230947c7b3a02897090a24c36df5902bb1fd8a8515c846dcc096d097d3ba9f403d638e9a34d6535cbf654ef427965e8780ea6b2439b3a4aa09d92dffbe2fbdf2b606e4178c2da8a0392633165de6da9a690d4460c6a23069714d70dd17ff1f685e9014dc24f26afb134a9ca3baee9ce80215bc46c50642fefe5f3a9d236025e37c2909cc71fd65d7c43888551c09e13342e8233aafc2ac4c0dfc13af2e3bbf36dc7855128f9ddd281e639d82ee7c8942d306fe12ac5d9cf8d056892998e8a802f3db3ccfb6df2fa95da16c411e1bbffb3682a3adad5f41e9eb97cb7bea2ebf9f48d8453413e2151d004eb5f2b8d3cef2cd5695aba24378eb3310d08dfa41e9fbd401bc5197342a2eb5740c85d9c98fc0e125276c8890fa5f7f0baeaea97eb871c83ad8d9fc64b76834b6ec75950bc997da1edcf3e8c2bb8ad25e392a8b9921ed74bd713db4c3214649aeeea549f77acbb89fe4698be1ddacb763ec46e688ad6ca0310a750a4c3bb7e8f4853d5dcb8bd139eefb0e43589663708642f21af88ba0631ec76cdce831d7cebce1f23e33d7e527dae73f1ac243d64807046a3e8b1de7ed3cc7e729e5ba7063a9dd3978f0ff86772477afdaf129ae7610507e755bd239bf08b6cac4eb4596a74e8f3c4531d0ad612c1e11f6b5c8c48ea4d77d6ddca63e8db21a9fa5f22f75931274b3e3601269f2a25b914483293997c1408a57461595f42fd36f77adf2f9782625b2558d8a3c2069bd6efecf4701571113b4d650f83dd514afd0e9efcd0dd2fe4ddc302445cd97f68c5e61fcca6d752f38481116f7321f88fd8143bcfe747ef7760b46bd147284769c9b56f08a4fcac48265edc80858231ce82a005dd10694de5ec23bae5171ef1785a97cc8a81101294110d4ec62de0de9fac3d55992127e5331fa9ad04585d11b23e15d2c994fae6e222977d5ef85afc889825b040962bd4f8a0c56b3fe7dbfd6eb9c21775f025b9d357c8a27c413ac87ab07c5ff4edfa9aeb4b29f01ddcea7792ccb2958d0f4a12ee922da55c04002a7b0700dd0f3c8d6d29fd399b887b07dc7b870af0f2896b349cf63f0e478ceeb87a9957c39441a3ff92acff2e61c45be0adecd3503f3f118616f13eed76f388b9f9f2d5880e2c710bc3d004033ee775aff4506347cb904e11306401cec148b30d68e56e388d265b2f8123fc5d4a55fcbe806e70106cb23d7e14cf02228308231e5f09f08b5771530b8c1e6bd29c15c25904408603749983f51293b6c24a8d3287f2243ee6a7911bb232739dc0cbca3a283da8f8692673ba1ac193e9ef6df1ca01fe66bfe872deeb2e4fac81014eb39eb128a141978c264addf83ce2fd385b51b8d06f2d5d6709266aec32020d97f9c9934a2ec106032e8605748bd97afd8dc193433553bc767fe146a987127d99278da45036438f3955d7006befc729d541b2e049147117ad8d8eadb41834799543a2ee00bfb11b94d0b447c143102656401d7d40a0f9ca5e90fd4550e7b6fbd8d0e81d9c7e4c682469d11f4bf2008c84b23261b1ec10423c8dadb510d396f26c96b95ee48025dbea600d08472a67bbc9e38fa6b3a779173e7c8397e0aa744d5404fbd0f25edf4646144503d774d56e4fa5bfc0011f31cfb0b0314a4902f78ab7cdc07c122e3c85ac1cffb60fe1207e0730b5424c02f77c7cde5c2817e8ed185e436b90000cc70ac8ca521f62c241f7178321f09a4d0b5b48a8c80a521c4ae3c6d89fe962635c2e7ff7805d24971bd43464e19b4f08cceb39e6183397b6b2086cfba423d6dfd3c9ddabd96c35ef218ec0003994b31761bd1dde537df4d0f0f3a5b5c45cc1da28dc64cb7fdc74d44f043d560a2bc44d39a24bdcfaff136dc3cf0909dc9d8db7ad82b166873715a41dd7f76cfc5991d2ec56966f86253838f446c68df1af84e8af6d6016b37860d73a368d27fee467a337256c07c9dcbfeb318f1b77f17936e064aebb1ee7254668d87f739a37c2c1673362960f9c0d21ff521e3a8239d4cf2ab07c23e0b38d09b4a87548c570205fd6141b7a91ca1c0d93875b385f0b550d1f01e29050ad398fbfa3ae9792bee54911e842fe4edc88c6efcf9052a12ea2c6954c71a869d8a300a7b1025e8f0b993d259473b08cea9d537bc8f9e29fa86e83f875967aaa645ac24bb74f86d38f5aa719c690ef18a1a256a9ff8a64ee9886162224be54d9210448c0a6bbcb7f99025cc6b32f3071676438837bb38be439f7e009f5fa00d266ff1c33fdaff012d2635c2f5b88e32035f64b831bc4d7965b44baa3fed62bcd75d858435cf799846085d84e9030a7a2576740586dd78645f3cc1164538075f58efbb24e741526a8b1081928d6b350cea258796bae6804e4e409fdbb5cf78af5532e9ded6fea76712e3ba5a44c191a20bdba611678cc69b7f240eab57554d0e7cb4f5a161281db4b2c32ff240f07861b7ae7984268577f0aa7d9a5694c310afd702bd8c2d1f1e08b565ed8fa45d3ab67b09aefc667250e76c27d9ca0cc2380d326bd2d7b6497c7236dfb03b20293efc0508006843c9a09fa2abe00f5a55c2321b6153c3c05512c2ee212c0188d01e1df26cf9e8e64ca2bb261e795b41071c99b15e71441a6aa40b17d5f3cf4d9d28557cbe681d68e639e32cc399d7bf37f8ddbd084a5f3f6ac3e1a296d05fc3756ad8160a8ac11b078b8d87afb7ba10bf8832dfaefa589ea6cf5ed74a3216cc10227dcc22d6f999c66b300e6e83684e54a289e58590d31c3cb4501d143909d0e41206687036055c05a5faaa9955e936eb7963f63aec5f54cc5a8ae8aa6de6640f4a0ca893a127a65e1bf3649be6b1e04ac3a463c52ddf08f2abde6ffc33059debe167f64ec5904053bb96d51af1f7ae3cbc2405d717dc54cc01a7438d67d8d90bd0ceb55ae1f84310fad33914496582c7c5569fc9939120af11d8f198e7c1b782ce12a29be780fdb22751144b126492300bb3170c881d0b626eb4ab9fb2879ee1639e3e02237fdabe69dd47ff454f770fb8858a1f3a3254f71fd5aa1c6435763c536410a5567f90346bdb575a4bb03b0e683aa625741bc4cfbdf2be5ee4800b9b174ff330e7a1a7feb0588bffdfa82477a09ea78e5d06a1d6f9c4524c241a7eb2c9b6e13eab6a60d363bd252086c6643f1aca591882fb2ee004c49f427bd1544c7f25e529f143319da2ed125219abc11fe8b808d9683aadf67f467de65c437d45f91f150779b1fbd1efb1f0120d60c60bdc07f91b2494614af7a26b2a2fba58841859839dc9c3a20c195513a0f20bdc00051ea80e7861d866eca8145e1e7686596c9be8e088818f750a33860c0586e96bf0a39af936c5d6b569aa5ac24f086b4337d9c4080828ca23cb7aef90cad81d66b1bdfc1c6aeb5a90967588c3c1c9d25d896d79b6326f9d6426bd14fa5890519fbdf27280dff734c09ac22f19b59b3c6b0bd79648410017a8a249fe383af4bdb47007168558625ee93782c3e261b8af7e214a7ebeae4a12067756cdb1df1d28fc391dddfa34fb4373f13cd111fee7bf94643870bd02190aa986de807588e6a645a93248eed4fefb9f896fb6913c87aba6165ff99fa6cec739d43ca3c3a4bfc1997a94d493f39b1c2c9c9a9d091fe769f4ef7151576c43da21cc7c3a8d6b82f1f7ff8e425fdf3cd2c6d6a5f46e61091dd5ded7303ea19e10abeb2f1143ec12b3a4d98fa9bf46e37464d0a8f79bfe1a1df77d5ba4e3bbce6b713016c6f243ab6d62f259475c94599f0a76406448774a790e29fca2ce5d38dd5df44da8682706f63d5d0396437e16de6b35237d605788c8e1e33ccd22763b0e33f6f4d54f4919cf8b15a55339ed379ba4a61f689769f83534019654c6ef6a662b11f952d5e07c71264ed35f00f633b48a3c763ab358bde7d18ee99ea790f94b5aac45009138dec8dec50418ac5556e7e3b86040a7a5f1dc71a9dff60542eff85dab620e7e37e9a01da0f91f5b55c7d79a76334e8d5faa5d75c094215e7bc94b321fda31f179c0fa1fe250664551e2fd6a62d0eae81082d1fb8bcd2e49f5a0c9519aedf467e56be25385ff0cec51257e23de928272af8cc6cd17137b0956ee75ae1fb235a12f243e2747e339639447c521b5b746857f64465468e67666ae8efd1923486e3ffe9a240f189837f39b06e738f450c5c8232a3f52558c6bee4451728b641708a789013a5c18599126ef3e8aa0155e4d5773d4a1082f922a5db3f1288b613e74907673178e5298aa8c0870372d63c92380755fee55e98b317ea7631340396ffeb951fb3b1ef728f29c37c81dc9bee46e19a7e9130ade51f0b90c31fb293fc65fbc4f5d68daa40c9b02c0acfcc9c2f4752b575bed3f9e3228a78f9a54e0ff26760dc0f40e2c844b4f3ab7168ad9f1ce8c48bf9c2c3f28a838476352a72dc00eeb762e30d015b43f6fd02172c11d7186a561fabeb02176c7749848d808a34d435cb00a24690b7c5d8ab02af7a00a30d21d01d815ac02c110893558ea51c1e1bf843e0f0efefe6f3da5bf1e20fbb5815be5b1113eb1a723f531474bde62639d9a5eca6e5b8010e93e16b973e4629beabba886c8f05e30edcc6de67a7214a5c19ba6b0909181eedd22446a022a1a0f64c45e347986abe0b725f848d019263f8de3349af0752a53e76610a9361e3cce2e233da1a704a12715920be364e6ea7cdbf70f601f32dd338d27ce37159acec91ad479fd2fbdaa1fb9f92c1f684a6fef12fdf7f84b5af3ab3c35047ff291b0c00d11d320f00ba95635fa85be27eac3c271970167c9f8bc7d0838f9822e891b482518f3d2d8b8b6e8f77f8a5d378a74adcc9a0e13695777e1df968b3f5cc3bd97a8cbda79cdf16854ed1b9ed5d7c9f648d9e1410c17766c51c9366eebb8772d2612977c077ec0852fdb6435e99a51aca5b1f941326aeb3ad20fc6d1446681bed0e794969318cbec00923ca572fa2f7c205112135155b04406ca252d521d38e0d31b6fb1e5cf052ebcee8b74f8f4c31a55bb754939d18b6aa4f175061deeccbf42c141b144a93fb856caccb03c75b4fe758b656a13e1723d11b04b0dcbd879dbec7a0a38da27940a56da2e83bb9c5e9571852064b23e402e7eee43519d344437d82409b709f56ca16c85b291311db080656d46d38238223733fee810422a2ad4acf6dd865d3e6723a2d93ddd1d975d703eb7367ecc538f9bd47298f96703559e5b4dde00f274eb4032fb63ab0f7b24b4ed531a909205fece39390d893227cfb6d486aee9b1bb97076fd883ba029f392b571ddd7a8442821549628059028657ffc240b82b890036ff25daea6a9f50da5ed972e0fb8fa5e69d86dbac6937f2e32c20d64029e4e889ef0c52e88670d854b224fb64b88b1923d3d7ce13745c22b9238a290a120f2a042503acc3308de2cb415ecf4b1288600be5fbc6ac3d6b169540eaa976c0697fe241473fea08643a5608d4890c93324ffb369e4709185adfbb41c3b189b53cf247a8a3ccd898bec5e958a449f828b1162ba62e610bc12292063b61a739b5d2aa2f5d8685bf8c69180bb9d32dc25eb5a3008643653458516482613400154dd73c821dbb9ec41752277aa865642224a01f3374872819a684dfe1236f034bd36d4ecdcefc29bc537a2e83d02684a0abc6b6dd0013389e20b9a0ec3305afa951d48c59ad03e088918d72389c957b557f0de2c406508057b5e9cc06f16f27ff65b7ad30145c35661312355c9c1c69c0afc14615277e961bed7811479a4131815ea8124bd3e733aa28ed3845d6210061a322abbd8d75f361d88350639c7f4ecbff92d2dabf10598d8964f005c89e0c12f76a553cf96face99e71e99db71aab8e8b71298b557754d02547830ee7bebe7ba59e32359b467694cdea67ac8b1073cced1ff432633a5d18eca659f7128257a4e0d2ae91f5481770b5589360c3a1335dc7e668c7cdd84acbd641c5fc736eb79f174f95d3965e98237b734f79a1b3401fd91e8be34154de39f3690e69253c9bd622ddf3fc2d0a26e1484e58247ac87ba5ced817043316f21082119be319f20ccbb67b042d62cde7dd7900bde6240063c7a0a84d3f36035743d5c3cdb8004cc73e53d41e163b6de1a847f26064c0fd3c123513ddc5bc61a097441f30dce7d7de2ea77e0156baacba6ad1292558c4bb5d9ad1a36f843a2a059c8aa9efc0059ef240087fa92275c60d427afb78bf3c167f8ccebf2ba31d250ab289e0ecb30ce1e317cf209837ce49361a96e465b54afbb4363995999bdb45b702e6f1a11fe49213f8f43023644f248d2dff884f9f57c7bcc1be3c1ee5d2106651ea1b3c34aa2e07cb2d1664db5563604285a5080689857a6b3ff2ffe5b791707f7bbba3e7da519ea87472e5d2a829b9fe3285d27e9608b91434ffc286a768c5d4ab1043f3387b63069e37f5c7503d55a2b8b6d6f060453b439f5c53f912281cbbc1ebdcced67ef536e74135e1e2850a071ee372a77d8fd274f580b43e77908bc1a2781b7a9e9788b4f153e42cfe422c15d2d9fcccfbedfb1ca7e8329d300334b7c50cd3e6c88b2a3e1931d9a0f4ffd7e9a5722e7f53e622c37e128c740f8b8aac25583f8746991570a31608325f0fd7567b4803e725b8d4463276ec36a2469dee091db1b219fac28018131bd43f6970655b54a33cfecb96f0ad65d41c16dab8b937e063a044610dd1f7e34eccdb5b63bde370d33566eee5f1c2de3e87515c8d8084f69bfc85add9f5b7a039f0d7184aca32c01403457ac233a158333b8a22ab7388a071e4760eb30382bae495460aff3c34a71aca465fb7f2097f29978b52a6838858e48a214058ad0db26e189d7e2da175aca5adf956c6059dc33fdf24975c16ebbc06361cadcaee76c1a17dbddd2f01a59d10bb0a3eeef3a13d76f5d904fb9c2d77d972ea31b9f2e657998292788e8072c36b9dfcfc49c5331343c665a41f33aa6edf573163a9e7eaa6717ebbde418068ad746e9fe717fa2b3502d5acdaa01577dadf21bbff5501861d41ccacb99f0e8c4c09951a0274a31047119f127413c4251899bb1971d049fbb1ee68f96e038518e1d5954664d0b547620bdd47beb231a5716cfa4c09f5ad71f869b88000fc61d6cd3df9c9a01b54fd003cdd1fecb1dd0dab96f2c2dbca2119db572d15047ef39b9e1c7ed2a02554a8fa7634f841508c6101b3ab3a7f1d6264dede2b61645fe1e3aa8818bc087dc130353ad99fca1443f3eed464332126591f62a26d8bfffcfa93a13ee4e05c14196c129cc3de22f2fb5f2a9c03499b042028779db45f50904835498983e677015c0cec67b53a5576c82a629392726aca5ecb529af1857ade944e47fc7152801f1bf2dbeea789889c42570a64b116108eee88dff67f2bf15b9577d161f39c2f4e691940e2292f91d9589245b3d8dca44ae1abec3c597e2d2fc62c4d0c8b9cdc8e445d3ae7b1355946e1f0449f8edc7e4a4c64869ce3a72914e1f2d15dfc8dab83f40bbbca286c07c0f8fc179e28380d4739e2ce386ddfc47823c12d285703ee32439fb0db2303ca7eab3ac1d82b9e2a4e7195f699684cac84aeb49d0a86647cbe0b7b293aa084f58c53ebe0057b7c589226d201a30ffefeb67b993a477e7a2cdfbb0b56694728f2f5630767d556aa620bfc22d9b31a95973d8ea72d9be03f9b5b9a23afd91faf1d292cb6b8b44de57a49aaa7b0c25637ea1ca6101ce4831e0eba26c490cdc516fcb6b73d6f40e796aa4b93245ec5287da2a8d7f3855f8b22381b4105f79c2257abec1ca5357caa137cc1f8ac55f7e42386bf41bf54c098a756d36f423f3c272752e3441858accfe389f89d99f6721f1059979afd4371a2263c3079f52e3ca0edf52446ecd1e12793f816d7f83c540e50d623f41cecf3477f6fb3446084fa8706a2b9da97483637604ece15a8b861a70c661e09bb508c83703f9f24998b118268bb58540e93a2c159b9829cb6f298541240ddeb20260614df8298140dd44227227d5d434486472c2388b89a73c5aad0cc9ca30c3a00bf587e80235f8c49b2dffc1a8f72e8b816304fbf2db0f70f3e08216b0f497d56e38591f10326cfb069cfb644b384295667d279c5afdba3124608c0a0db578950f465c489fe4f9a154da146b2ef53288fff259152f0a8843351d27b3f0f9a2f1553cb84cc57b8947ed5224ae37fd6790e7bea4dc21b54dc187808f095e4fd5f6e4ed8faffcf9c70a93c2175feb73e4755fb263e424854149248a37da8fb2382129e39b6cd7502459ed6b2ee8a25154327b72661987c95f8d08c8550b4e1f0c2946754f72305119b484d1e01d4d3dac5b859e3cfe916fa6272facfbedfe12eb4684e71a2698efda4c885bb908da4f212af505155da917516fb40617d863e20b134bc372e19585338ba3e7fef588bcc747a1bd61b965b87ace2e6dbec4d81a16f010a5531fbf7495bab86cd77dbe05e1dfee9c9652be66d2b26491ef88b250aeb3669093bcbc733406b60f4c571725baa137b18636949176044188ce975a5c45b4b9ea21758f01269d1505eb1364354c01421a46ed9643f992867faf922eca0487303edcd49dd11e8cc06fe174232c5f16912a245dab305294f2bd0e070c8bd1a08f64f4598c8e2e150e9854306270da82011b22d46410c2602622325f68bbb49c68ac0584e11cfa6496c8cce460e6508ab4c332025802cb1334fd09164203d690be47c8c258264e9f68cfb6e7a6558b7fee68bf4c68cae7cbcef3b98fa13c4b07319e0bb27f65e27fd1d65e2ffd1d69315052483636794b2f9d6c71b2223a5526eb2bf5516f7c813a0ce4fd89b2b6bee06264c50a9e4417f6be79fbaeae902e70392ab8279c29497a04f3ecfd4ccd09f0c3a33defbcb1bd6f513ab9399b02f99a0a1046250598221cf1ebb402537e6021fe6d07f3d3952789eae87efecfead65c387a4e68ac826f2a4cd4e70b48d59893731e734846ca03c1ceeaeac51d76bedb869b9ff7c735da4797dc5a4ca850b4c62fe587f183a18a8f80777f488128169b14d60bcc7be41d735f09b8018006e1fb757395e84938a0dde3fc890137b6d948a0aee69f9ca109f3336d62333e835d6bc62e0dba6f21267f6bec62abcaabd9a7c523597c2cc0cb2c5bfaf575db05e4e030268bb50fa247f13f3d6769aa58b6013ee71ced6201035af69f0952dbcfae7a7606852440a14dcbcc318d2270e644fc0c062db9a440b2fe16022a74deb29180b30273d942ba1660eed46cfaf18df81f9249cd01c148987a614344dbd180532a811eb3273d39ba20d5ec45c4fc58595f5239bc6a331670440f7fc0d94417ffe0e7d7ce9718ab612e44471a4ff0fbc93dc89fcc46b598ce93f3aabdd3b369caf717fc750017ba5c9b46f2e29e339649e47a92976256a87f12614104465b796713229e0036642d0a6d4cf819e15857df4dfdbb2667c78163b96fac5b0c2c96a78d53965db518c1012904b603c1614f05df11b7360aaaa4b40fd9bf515cd00eb55e388d4d5585ce9894ac88366eb1a7447edf902bfce6ae5408692456ed5ec6244879aee22149f40da0a2ae24b0756c2081fa8482f2105988e68c70603b67edada79154c2df345b65c9488efbe4e03ad39ed69572d96e9ad0beea74d80851fcccf19dbeaa59c002ef22d488b64ec4edea115a3e67af23b6dacbaf853a5e9bc6c4e4f051ed791cc112ea2daecf4c49f9ffc4f192075bec3cad5edd000e847246df4d90e68d75d53ea4cde527d45681e73c084c6fae2ebb80fcd3db2fcb37edba7046a5a708b61729936e14f18999c1614b6c4f6e2d66ceb947c05e5fdca7a0ec8a691c34297d1d2b8cbf348136ff561bdb9efd103acfb0d2cc909c4064ee58d3de7c85cfc0a9ef12a3a765d7f0c8c9e5d35b42f4a7ce2e74e8ad481c4e203405820186f4662021c858e0a43a257cd079d83526a7c35aa2bd90e9ee3405f64075dd6762df01bb05c97a3333a80d5b160ffd4b89f33dc6b2a834fdcc7c3f9627a7add823613f3b0f5328058383f0c797c8dc8948ca4568b9758e95257f8ea18eeab38c9703ad0f22e1a531be6687bf495cfe0a6557c91d6bdc61568abec696d1fa710c157c22e535620a7e338986509b10432f6549ea7e06796cc67d55d592440dd66f61556dbf3f45f3f04222aa7dec1c59907775c66d19ea3cd2b190d7602788d4867ff5a13cdaca2571976a78af19529dc7c3aa213b7add11daa08ad752dcbede2b19e61cb6d55f2cd86b0e6c3c9dc1349f661f45e302e79554a8e1753c53735817a22a5b4b2cafcf77ee39ee02132e332149e81c043ace09ff67662fc0dd0a27313915d6f12f374cc5091ecf439c09799733bc1b767c5a74f464ae03113ff2f4ed33fa8c9cf6fb4165d852084308a04e4cf23fb58c7c4f3a06240fd05bdda6d08e48db1925d8b060fbe2c2c5d2a6735a00e12a398133f862a4ed02c80ad4ba749cd29b46f27bc13008111730a78ccaad81823c61c458adb6ee1d60712fdd824a6412125b618d6285f1395793d88fa31fb1baa1337625c971ca3e7eeeb3c6e5fcfc4beecb857146ba4b3f006ad2f735fd57d64a442521a09028ae46c736786256a317ba1a5e64b29e6c6bce01f5ef8b121a8bee406ccccf2ebf7351400446ecba3ce1c6fc81f2161041834fc90446122d18a0ecd05d40e831a0194f49e582aa2545a2355aa9b571a9fa1ab3dee0cbc100ffc4f84818e3f1a27afc8172ee716101dee343d286de45a827bf9e06b1f0abaf7d9df9052f07364a56e56d9791dec4218e807ad23e6d355f44fc7484b028587d701235146f4a0e82148a06936a4d15018ce61af7b0a75c9678d39b382a6af117d7aff31ac5dcdeda468c04699c5374f9e0e9c57b28ac244732fe9f6380c6abeac574f6e5e6e2da5328fa791fa26d4e70f824df0d47b25ccb922d35068cba5b13b3bd5f88bbb854921e9bce25459d6477e77a08d9ae1ce96c97cec4ec40e7887a8d8315af3c72935664a7038e676d437e38aef3b041b261b1ac512ce8463b2253e9be5f10979585ac9d9ead6c56cc934694b83431c6fbe057c00eda20cea1973d09f29ecd45f0afb101e802f12059f4c33c484d3f6c81d0faeede78a4beb11f8a98fbeebacac2a9bee1a8d1f96e836e0925e305cc67ce48380987442494285a571202fb358f7ffb0252c2cc0e9a015fe3050066ace58edf0f53069d04d0533927474803c193c60d2f4b64ae301938c724ef7d0715ea722bed61609707806f12d1b996a5415d294b5af4bc2051912ce7f088d9a9d6b29a9f216d0ba6a6c80030746a59326a414ed7b6b8642e773b88dd36830aee3ef2f84b0ebe53350d6dca1cc3a3ecd7ce1d0e36499c4562b24697861cc1a4cac4dd9f962b61b871101289af27863371d544fba1d94f5d323c0bf177bcb1bba1c47ede2eeaa38153e651beb8ec831f4ff112309eff2ebb205737fef748b7ea1adce9c7e2ca0be2ee09e343feb41d314dc41ed8251085eba70d76d56b34b349208e5282610ac873f2d4479db1459805d6f8d84a415daeec1eeab7606b737262f9d59c1e43848e6c0eca147230b20774ea36ceb9d31ba0eff92c610abdc7fe25bfeeadbee39000113664753667c702ed08ec648c387ab3ca2f08323bd57d9a5cf9e6a45554deeaf47329894901ecbea1b3432b6202f7c21f73d7cecf2ec1edc338f1c98c6717248ac10271d648787cf21f357c39297d6264b9568ad48e04dc4087584c22b17558cb4e6eacc6fdc82bb3c9bced25128dab25324cee9333c966834a88ec1e7074cd64dc48eb72d10cb589158f182afe0ecc3b2b3364ca6fcfa28d71345ebbd717adb5e135582e79e72fb844e22f08635149b3eaf41ffbe4843c8dda68a5bf31af4cf961dd1249a4e22b109cbe32ca4f6311d7f7256702c3654851590c1cf608e17544abda3d9099e66af6ffba97eed10c18ad2828c51a9d06251e28f9a4dbf0c115ae93146d51759239da5757c6b7c641dc758ba399961d0ca8cfc081ec0b1bb2883174bc4af91f8d8b61b7de11daed5e488000f651c01eb902dd51f4a6793ddf68a6e9c637767924f6ac36a39f7fd7a05c1d7ed2da9e4ed9707587474719b002795bae2ec868fcbc4f368c35b7ba11be7af33c738ca990b3510c15ef30954274b61dd7a6f67ccb42e7a95a5ae976a04aac06e529bad678eab6ce98085e69c637c77877d384a74c1b1918b6dbfc941aac7921992f5d605d5a4be848d78088a1828829b939cf8fa062243f63af5ea6355faba06508affdb35f9490fe49215570ea958a7607ac75de6a4ecdf4c559526dcc2da87cd94dcfa37a19cd49001b6a2306c1461235b20c604363d1db7646bfd7fdc4e57c71f874b91f123a1a13811cffef31e8be9d7321117970b9c5d96972b37a0d626865d423fab5c72075f0dbd2553f5e540e6fbde790ce1afc33e5f9d67e91d9318f8bdde0cf149d785310851b95f5ae73c8e74493965b2fda1817472c9e01e794c6206a58c9b04c29bed8396a5a4c73b647201282cc5ec221aeb728df2967362a817308c58b022e580bfd3c9c8550867ad7e629353f3c67cc7f403e645de660adf55ea008c3632adf2b0a68b7a6587f1037e70f6d8314ce15b72aaea794521296bfdca62e147a799b9d31d34fbb7ec6d230d7973ad39af20adaae63f2f2728ab50ce16697851cebe397f74f001e274859c15e4dff3f7661fe4bc576c9254043ed3e5b00bfe092e56d2e0cd8e757d187243838fcee7ccca7eaab23255e49440d49299611798b1d3937d2e8d3bee637ab1d06b62ad0e343ce474618fa7389b24d1dfd10016f329f1e5b672093543e939bee6744f65965329177446dc981696ac4f0608813e2f72bab8f1c2a9d6f74f7019d3da7146791f6bf6eab7652e1a7848afed04c48eb6c174bf6932b7a61b0211caa032eafb9698f7a02bad4ca4558782314af0020d63d7ef16e2a1259e485ab4cca8ead4dd225b7a48748f05773f04646f420612eda014391ba1a34d2413f8090c55523716c737229407e1a275af5d3b8536bd8b2ee4a88e97b049541065bda7e3ddc149715dc5b73efb46117753a9bd35f1b8db1e9b55561143b5cd3a07e8bfe9a9b415dfa5d429f9c7458506c045df05a3e6f75bbe15335a0085128e939950993eedf5e7beae91279a2aafd03aea7a48af9c2116d4ca6c2829235ab444682461792d7abdf253086911058ace640d035581f5409a4b10181029030a28e8f58d7aa66452d5ace61e367dac485aaf419af73bbe721a6ee7e833bbfdd59d86cad3593dd6792490d6deaae944ef41ceb09b5fb047ff197da2bd71d9f8d88426e3587d7ee4db616c85343a35deb20c862d8a8f98b9471870159cc79a83b3355c39b65afe61ae50fed57224e0c452b452aa9738255366a53a927734d3cd4258ab0da842423871caffd9953d2ff73b3fee8e7e009bd3125555c6bba64a1f69bcec0571053c4fc0731bfa835b12458584e8c4e6e16be11d34ada4b50137dfd98bf3b911a3d3182ee334e37911b47e10a505ad8a3a28a0fbdc54a8bd0392936b616ab7a1c4eec0f42ee5e31d49fc1e18ebea7470de380,
        101,
        'image/mp4',
        '2025-04-05'
    ),
    (
        66,
        21,
        'Sam',
        'Abdulla',
        '2015-07-18',
        'Yunus',
        'Father',
        '',
        'English',
        '',
        'M',
        0xffd8ffe000104a46494600010100000100010000ffdb008400090607080706090807080a0a090b0d160f0d0c0c0d1b14151016201d2222201d1f1f2428342c242631271f1f2d3d2d3135373a3a3a232b3f443f384334393a37010a0a0a0d0c0d1a0f0f1a37251f253737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737373737ffc00011080094009a03011100021101031101ffc4001c0000010501010100000000000000000000000304050607010208ffc4004010000103030006050a0308010500000000010203040005110612213141711322516181071423324291a1b1c1d12452e1153343536272b2f0163463829293ffc4001b01000203010101000000000000000000000005020304010607ffc40032110002020103020403070403000000000000010203110412210531132241513271a1142342618191b1153352f0c1d1e1ffda000c03010002110311003f00dc6800a002800a002800a004de79b61056f3894247b4a20015c6d2e5928c653788ac90f274a6d8c1212ea9e23f969d9efacf2d5d71f5c9b6be99a89f38c7cc8e774d53fc184a3d856e01f2154bd72f489ae3d1a5f8a623ff00347f3ff44d7ff43f6a8bd73f62dfe8b1ff003fa7fe9edbd3557f1608ff00c1cfd2bab5def1212e8aff000cfe83e8fa5f6f7301e4bccf7a9391f0ab63acadf7e0cd3e93a88f6c326624e8b30131a436e0fe95027dd5a2338cbb330594d95bc4e381cd4cac2800a002800a002800a002800a002800a00464486a334a75f5a5b6d3bd4a3802b92928acb2518ca6f6c565953ba69728e5bb63600fe6b83e43ef582dd6fa4077a6e91f8ae7fa22b52643f29de924bce3aafeb567158a5394fbb1cd545752c41604aa05a14005001400500752a5216148514286e524e0d7536bb11942325892c93d6dd2999170895f8868713eb8f1e35aebd64a3c4b942bd4749ae7cd7e57f42e16db9c5b8b3d245735b1eb24ec52798a610b6362cc5882fd3d944b1343dab0a42800a002800a002800a0028018ddee8c5ae3f4af9c93ea206f51aaedb635c72cbf4fa79df3db133eba5d255cdfd790ac207aada4f553faf7d29b6e958f93d4e97495e9e388f7f7195526b0a00e294120a947091bc9dc2ba937c2392928acb239fbf5ad827a49cce46f09ca8fc2b4434774bb4598a7d474b0ef3422349ece4e3cf3ded2c7d2a7f60bff00c7f82b5d5f48ff0017d18e59bd5b1ed8dce609ec2b03e755cb49747bc596c3a869a7f0cd0f92a0a485248293b8839cd50d35dcd719292ca676b848280158d21e8afa5e8ee29b713b8a4fc3954a337079895db4c2d8b8cd6517ad1fd2045cc065e01b9406e1b97de3ed4d68d42b387dcf31add0cb4ef72e624ed691785001400500140050033ba5c19b7435c87cec1eaa78a8f002a1658a11cb2da2995d350899c5c273d7094a9120e5477246e48ec149adb1d92cb3d7e9f4f0a21b2236aacbc28021aff7e66d49e8d00392543aade7013deaff0076d6ed2e8e573cbe10b35fd461a55b573228b70b84bb92f5a63ca7067211b929e43753caa9854b104794bf536ea1e6c791ad5a5014005002919f7a2af5a2bab689dfa8ac546708cd799649d764ea7983c13d034b6730426584c9476faaaf78ac36f4daa7f070c6b4759be1c59e645b2d77787734fe19df480654d2b628787d694dfa6b297e65c1e874daea753f03e7d87f598d8752a5214168514a92721437835d4f0f288ca2a51717d8d0346af49b9472dbd84ca6c7580f68768a6da7bfc5587dcf2bafd13d3cf2be164dd6930050014005007952b579769a00cef48ee86e53c841fc3b44a5befed5528d4dbe24b8ec8f55d3b4be05797f13ff007044eeacc310a0065789e8b6407252b04a76213f994770abf4f4bbac50465d6ea569a97633327de71f796f3eb2b71672a51e35e9e31515b5763c34e729c9ca4f2d9ee2c395314530e1c992a071aac32a708f7034369028b7d909ba85b2e2da7925b71b5142d2b18295038208e1835d225fec5a0a1bd1b9979bc36a2f79ab8e458a766af54e14b1dbc40e1c76eecf3b7cd889aa14793748cf46d15a0ca76800a00f4dbab65c4b8d2d48712729524e0835c71525868ec64e0f745f28be68cdfbf6920c793aa99484e723607076f3ed14875ba3f05ee8f63d674cea5f685e1cfe25f527e978e05a1ca7614a6e43070b41cf711c454e137096514df4c6e8384bd4d36df31b9d11a90d11aab19c761e229d426a7152478ebaa955370977439a9958500140105a5d7030ed85b6c90ec83a831c0713f4f1acdaab3643e630e9ba7f1aecbecb92814a0f56140050052b4ea595cb62203d56d3aeae6777c07c69df4ca92839bf5e0f2fd72fcd91ad765c933e4ff40d37461bba5e52af3456d623e71d28fccaec4f771e5bf65b763cabb8b28a372dd23588b19886c25888c36cb29184b6d242529e405646dbee6f514b846616dd0f54af2957454c6f5a0c77d533ac36385c515253cb2559fedefad52b12a960c51a5bb9e4d46434890cbacb9ea3a9285723beb2e70f26d6b8c1f35cf84edba6c8832461d8ee16d7de471e477f8d334f2b284f25b5b4765c3762b715c713e8e4b3d334ac6c527247c083f0ae269835849fb9e1c8cfb51d990e32e2587890dba53d551070403bb3dd5dca0c3c644a8382b19f722c86e432ad571b50524fd2a33829c5c5965764ab9a9c5f28d4604944d86cca6fd575014076775796b6b75cdc1fa1eef4f6abaa8d8bd45eab2e2cfa11702dc95c1709d473aedf7286ff007fd2b7e8acc3d8c47d634f94ae5f265d41cd3110050070ec14019fe97caf39bc29b07286121039ef3f3f8529d5cf7598f63d4749a7651bbd59095946614001a00a740b5ffc9b4f1c86bc98e97545f20e3d1a3008cf79d9e35e928fbbd347e478ad57df6b25f3fe0dc42528484a404a52300018000acdcb34f62351a4365725f9a22ef0152338e88484eb67966a5b258ce0e6f4496a80a27032779eda8923b41d33bf297a1afdcde6eed6964b92894b721a1ed8dc958ef1c7bb9569a6dc70cc7a8a773dc89bb8e85c3b868a43b33ae6abb11a4a599206d4b80609238851ce47e9508dad4f2592a54ab51f614d0bd1f72d7a2ffb2eecdb2ea94e2cb8dfae8502767c003e35cb279966276aaf10db2291a77a002dad3973b1a54a889197a36492d0e2a493b4a7bb872dd7d576ee2466bb4fb7cd133dad0642f9a0ef972cea689fdcbca48e4403f5a43d4e1b6ecfb9eafa1d9bb4ee3eccb0d2e1d0ac47d5165332107acd2c2aa7096d9268aafad595ca0fd4d5195a5c6d2e20e52a0083dd4f13cac9e29a69e19eeba70f2b212924ee143e017265321d2fc875e3bdc5a95ef39a433799367b6a61b2b8c7d9213a8968ab4d24a4b8f2f51a071b064a8f60ab6bab772ca6cb1c5ed8f71d222c6908cc574eb8f6546ae74471e528f1e717e7447f92db62d89f7f9921a536f79d741850db8f5c91dc7593b69b592fbb8c7f23cd420d5b393f56cb4693da255ee2b709b9a61c359265291b56b1c103860edcf80c1a8424a3c964937c1191fc9c68d34d80e477df3f9dc90bdbe09c0f70a9bbe6455712c96f86d5be2222c72e969b184071c2b207664e4e2aa6f3c962581cd44905001f5ae811efdf6d11a488d22eb05a7cff000dc9284abdc4d494258ce08ee43f3aab4ed014950e60d47b1de1981e9dd91361d257e332088cf27a7607e54a89eaf810472c530aa7ba39155d0d93c129a023f012cffdf1fe2294755fee47e47a2e83fda9fcff00e1168a563e0a00d1f45dee9ac71493b529d43e1b3e94eb4f2dd52678fd7c366a66bf5256ae320dae4be8edf25637a5a51f85466f116594acd915f9a32c1b85213db8500cf720fa060676007df9dbf4ad95fc08cdf8e44731225aa6244504af5b0948fad5ca253391a0daf0969790028ab6e38ec15744557af314b76c9334ff004b6eecbf72970acb6a5a23a447560baeea82ac676641de483b315a23c216d926e44c33a2713475f0ab36944d69d47ad166ba1e61c1d8a4e014f31baa12b209e1b29f1d41f72cecafa5690bd9d619202b5803cf8d4729f637c26a51ca3dd70985000402082320efa0e32b776d06d1fb936b020b711e564f4d1121b39ed206c3e22ad8db2441d71635d0b8175b0cc91659cbe9e086fa5852123663385271ecef071cf15db1c64b723904d3c3203cb5474f476a9200d7d671acf7601fa55ba67dd19b58970c8ed0b63a2b225647ef5c52fe9f4a53d467baec7b1e8ba357b34d9f7276b00d82802f7a10bd6b42d3f91e50f91fad35d13fba3cbf568e3519f748b0d6b160ceee336a9807f217f2355dbf032ed3ff007a3f3465e2919ed505002eca3ce192c8d8e27ac8efed15a6879f299adf24b709da61bccdd8b81243652ad7c8c63fd35a639335a96328b64556ab5cd59ab6260b566431b595d9747aeeb00a1f7ae4eacafb95820ffeb53b65887024d5b70cfe66377dd34b8dd9b8894fe10c7d7c2d859497124e53adc0948d99e356c698a5868e2aa2961a35bf269325ced0f89227a8ade52dc1ac40054028807672a838a8bc23651151861169a8978500349735b655d1079a6dd23617428a4779c0fa8e75c738278666b7510ade1be481bc1d38b63267c24da6f11523594cc76d6db9abdd951cf87baad4a2d1157b63bd10d2887a536f5ca8a8534eb6a087985ed283c36f10781ae4a382f84f7153f2ccbe95167848daeadd5a827b77247c4d5f43514e4fb19f54b738c57767a851d3122331d2763480807b702bcfdb3f126e5ee7b0a2a5557182f417aacb82802f1a0a316a78f6be7e429a68bfb6cf33d61fdfaf97fd964ad82a13908e91871bfcc923de2b8d6560945e2499941052754ef1b0d216b0f07b783cc531290fb51d953cf2d286d23254a35d8425396d8f7236591ae2e53784546e1a64f6be2d6df4601d8eba32af01bbdf4e69e9918f363e4f39a9eb729e552b8f763f81e5127ac34c3d0197642d41095a56521449c0c8e7d95a65a48f74cc90ea53c24d726a6105294a4f0001c56337a79e59d5b21f614c3bac5b560900f1ae359586537d50b5624511ff0024701c92a718b9c8658528aba3e8d24a41e00fe95a158f18337818f52fd66b63366b546b7452a2d4746a852fd65779c0de73506f25d15b560769710a596c2d05637a42b245472992e4e3ae21a696eace10849528f70ae9c6f83e6cb8dfa6dc2f322e4a972505d7cb83a370828493d548e1b06055fb238c34609252cb68df7c9d5f59bd4452e1c77588a412da1d5eb2b295149271b36efd9b2a88adb3704510f2cdc110de4eda69cfdb97560252cdc6e4ead829dca6d2a290a1cceb54a6c614278c8a690b76a3756ae53dae95f423a2601ca8240249206e07277f2aaa563dbb7d0614e9a2e4a6fb887ed38ef27063a4b4788359da8be1a192ae5dd31bc86ba179480723783da2b1591db2c1aea9ef8e44ea058683a1cd16ec6d1231d2294af8fe94df4ab1523c9f5396ed4cbf226eb4980e1a00cd2fd1bcd2f129b1ea9595a792b6fd692ea23b6c68f5fa0b7c4d3c5fe9fb156d22b448bba1a6da94969a41c942924eb1edf0abf49a985196d64cfd47456ea928c65848aedcf47a3da20aa4ca92a79c2421b6d09d50a51ed3b4ecdfe14ca8d6caf9ed8478136aba6c349539d92cbf4441c353a8991d6c235dd4ba85369c6f502081efadf36945b7d85504dc925dcfa3232d325843c8dcb19c76775294d35943c6a507b65dc4aed24db6d72e684eb18eca9cd5edc0cd75f0b2760b7cd47dccd2c77398f6935bdd932df51765b495fa420105606396ddd596126e6b230beb8c69928af43697608392d1d9f94d6f711046e6be22211a3ccb32d325965c6dc073d451c1e63b2aaf0927934fda538e323e311d5a4a56d65246085636f3a9e195bb61ee64777d00d1f957e7e25b2eca84f073d244d4d64a4ef210767bb6e28f1f1c7a927a494a1be3d9977b65a9ab5589db5c1756c1751d117903ac8471d5fea393b7bf75570cc5b93eeca2ad0b4dca4fb8f58699816f6e3446d2db2d2036d213b923850d8c2105948abe94bcc94b51c759f49d6e43f5d955b37c10ca0c75f4696fdb51ce3b2ab66a8f963c8f642c2dd2527290024780ac76cb74b25f545c63c898054401bcec18a825978272692c9a95b6388b0588ff00cb6c24f3c53c8476c523c4dd678964a7eec73532b0340151d3983b189c81bbd1af1f03f4ac1adafb4877d1efc49d4fe68a8d2e3d0156d3965f902034c36b70952f0940ce4e07eb4d7a64a117272620eb909cfc38c567b8ae8d68f180bf3b98019247511bc379f99f95475badf13c90ec4fa6f4c74bf16df8bdbd8bb59ee660b850e64b0b3b40f67beb25176c787d8ddacd2f8ab72ee59de698b84271a5616c3e829383bc114cb89212665097b3454b45740c9bac95ddd2171639c33aaa29e98ef0ad9b463e7caaaaa9f36597eab5ed56a35f77dcd16145762a3a354a71f6c7abd280540766b71e676f7d6a4b028949379c60775d2246de644f661beab6c54bcf86c946b2f0338ece351936970595a8b92527c18225c7dd961e4952a4adcd70a07ac5c2739e64d2ccb6cf5388a8e3d11b1842b035c75b1d6c76d6d156e2174aaff1ac0884662565325d28252325000f5b1c46703c6ac8d4e69e0aa5a88d525b88c7ae5619eeb6eb7748c5c73aa94a5c1aca3d98df9aa674ce29b6bb1ba9d5d6ded834d9d5ba848288c92949dea27acafb0ac165b9e2232854f39988d506825b45a0f9ede1bca7d1b3e917e1bbe3f2ad3a686fb3e42eea57f85434bbbe0d140a6e7953b400500379d1913233b1ddf55c4e3954671528b4cb2ab1d53535e86632e3390e5391de1d76d58e7dfe34927070938b3d8d1746e829c7d446a05d84140602801e5bae4fc05fa33acd9f59b3b8fdaaeaae956f8ec65d4696172e7b969b6de1893abd12fa3771ea2ce0feb4c2bbe33ec25bf493afe25944cb73b8389f14d68dc2f951ec2c25b27dbc7315ddc8add73f638a96c8dc4a8f70ae6e4755536542dba2d6f837493704a54e3ce3cb71b0bdcc851ce123bb3bea855c54b70ca5a89ca0a0fd09099322c41979d015c103693e15c9d90872ced54d963f2a31df29931f9d788ceb8486032434df04eddbefd95af436f8907f331755d3ba6c8a7ce51501b0eb0d87b456e7cf02cfccd1f462e46e56c4adc565e68f46e1e24f6f8823e35e735b47836f1d99ecba66abed14acf75c325ab20c5bc1a168b5b7f675bc175387deebafbbb07fbdb4db4d57870e7bb3c9ebf53e3dadaecbb1355a4c2140050014015dd2bb299cc79d474e64b43681eda7b39d64d551bd6e5dd0cba76b3c096c9bf2bfa14514a8f5282800a002800aee19c7864e59a5c90c281754a015b358e71b2b769e72dbc8af554d7bf844989ef71083e15a37b32fd9e231b95e2547d40d06c057129cd5175d386305f468eb9e77112fdd273fb1725601e08eafcab2caeb25ea6e86928876434cf12726aa66a492ec5734da197ed889081d68ebc9fed3b0fd298f4db76dbb1fa893add1be8535f87f823746acc8b959a579c0d50e39e8978da9291bf964e3c0d69d66a9d37476fea62e9ba057e9e7bfd5f0c91d13b7cbb6489acca4612750a569da951dbb4567d7df5dd18ca3f99b7a4e96dd34e719ae38346d13b3196f267484fa06cfa307db57d87cea9d2d1b9ef97625d535bb178507cfa9791ba999e74ed00140050014001a00a9e9368f170aa65bd1e90ed71a1ed778efeeac3a9d36ef3c473d3fa8ecc55676f47ec53f9d2d3d127941400d9f70eb6a83802bd8747e975c6b56dab2dfd04fabd4c9c9c22f811c9ed3efa7fe143b6d5fb18774bdc95b55cdb8ed742f02139c85819f78a4fafe992b65beafd8b6bb71c489237584139e9c72c1fb52bfe99aace36fd4b7c58fb91176b80965086810849ce4ef34e7a7f4ef0332b30db299d99ec47e4f69a67e143fc57ec57be5ee2ac3842802720d22eb1d2eb9d4eda9624bdbd4dba4d4c94b6c9f0c5de690fb4b69d4eb36b494a9278835e3a3271794379c2338b8cbb3065a6d8690d3480842000948dc057652727967215c6b8a8c561227747ac2e5c961e7c14441ed7173b87777d69d3e9dd9e67d85daed7aa16c87c5fc17e65b434d25b6d212848c048dc05344925847997272797dc52ba702800a002800a002800a0081be68e33712a7d821993f9b1d55f3fbd65bb4d1b395dc63a3ea13a3cb2e63fef628f72852adaa2994d290af64fb2ae46a8d268e76ea63535dff0081efdb2a9d4e70644efafa12492c212642ba01400500140050015c78c619d448464ae494219429c717b92919cd7cef5ba5746a655a5feb1f577c7c2539bc16db2e8a1052fdcf6f10c83fe5f6ab29d27e298a357d55c96ca7f72da8484242520048dc056f121ea800a002800a002800a002800a00280127e3b321b536fb6871b56f4ad208f757549c5e533a9b5d8ac5cb42213e4ae0bab8eafc846b27ee298d5d4ed8f135945d1d449772bd2f442ef1c9e8da43e9e0a697f438a615f52a25df82f57c1916f5b2e0c7efa1484f7f44715aa3a8aa5da489a9c5fa8dcb6e0382db80ff0069ab3c48fb9dca146a14b7bf7515f5ff006b6a3f4a8bbab8f7920dcbdc918da3178938d5865b078bca09fd7e159e7d434f1f5cfc8addd044f5bf41402157196558dba8c8c0f79fb560b7ab3ed5c71f32a96a3d916ab7db21db9ae8e13086871206d3ccef34aec9cac96f9f2ca25394b86c7950221400500140050014005001400500140050014005001400500140050014005001400500140050014005001401ffd9,
        101,
        NULL,
        '2025-04-05'
    );

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        67,
        21,
        'Ragendra',
        'Soyza',
        '2013-04-10',
        'Yunus',
        'Father',
        '',
        'English',
        'Shrimp, Egg',
        'M',
        0xffd8ffe000104a46494600010100000100010000ffdb0084000906071112121512121212121510101010151515150f101510101511161615151515181d2820181a251b151521312125292b2e2e2e171f3338332d37282d2e2b010a0a0a0e0d0e1b10101b2d2520252d2b2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2d2dffc000110800e100e103012200021101031101ffc4001c0000000701010000000000000000000000000102030405060708ffc4004b100001030204030505040605090900000001000203041105122131064151132261718107324291a11452b1c115236272d1e192a2b2b3f02435637382a3b4c2f1081633344474758393ffc4001a010002030101000000000000000000000003040102050006ffc4002c110002020104010303030501000000000000010203110412213141132251053271334261142391a1b181ffda000c03010002110311003f00c423412805a80c4a09485971c251255912e382411a25c7094d109f6b093a0bab7a3e16a896c4372836d4e9a7543b2c841664f05e154e7f6a33c506c64ec095d1b0fe0a85963212f3bdb60afe930b859eec6d1e97fc5665bf53a9711e47ebfa74dfdcf072da3e1ca996d96336ea7bbf8ab18b822a8ef947995d39b194b1092927f51b1be10c2fa7d4972ce6f4bc0531f7dcd6f96a9f9380643a0731baef7274f15d262a429f6d075578eb2e6565a4a170736a7f677f79ff002205b4dc7e362abab380ead9b33b416f79a5a6daf369d765d75987b473522386db128f5eaaccfb9009e96bc7b59e7faec0e7885dd13c580be84db4bdfc954cd19001b6ebd3a2db10d75fa807459ac7780286a012d8fb093521d1dc37378c77b5afd16855ab8fee42366964ba381b764d4ad5b8c6fd9c55c07f5769da6fde6f76de60ac85752be2367820fa2d285909af6b1670947b4573a14914c96e96c9b33a159b3c92b23cc813a230a20992db22b56d3e8e68936085c28c5c85d1304127384145ba0bb071a575c1b594da7a07b85ecb54fc1db7bd92c4194580e4b3ddaf3c0f2a518a9632d3629b563894243892abdc8e9e404961812484a4a6477365cf8210d00aef04e1e926373dd68dc9075f2575c3dc33b3e400f8725b3a7a46b400068162eb3ea8a398d5dfc9aba7d07eeb3fc1558670fc115b2b2e7a9d55b362521ac4b0c58965939bcc9e4d14e31585c1144374e766a4088a71b1ebeaa8915760cc515cd94d8a9c04b899609c4cc2290bce6d80208ae85d19306289402241162c8160a504809413302ac75a01599e2ce0c86b18ebf71e468f6f23e23a2d230a7d8e4749e7745e18292f0cf31e3dc135d4d98be12e6b49ef47fac05bd74d5655c57afebe81b231cd3b39a5ba686c45b45e69e3de0d9b0f9ac5b78a427b37b6f623a1fbaef0f50afebce4f13eff00e8a4ea515989966b9498d4522c96244d5166d7c80689285d46322232261eaa246d24e64145ed1055fea91db4f43862069c14f06a34b21a7232b8e612f76ad593a8a7730d9c175279bac4f1547676dcd1a0fc149e5f25035a4ad970af0d977eb5e34f8414cf03f0e19dfda3c598cfeb1e8baa53533580000580b792cafa86a9b7e9c3ff0058e69aa50f7cbbf055c14840db4f000052194fe6ac9058be9a1c77c990db0258604fa4962ef4caef6fb1a07fc72468cc7e286452a2cec8bba04a2411510046905c905eac89c0e664039328c23449da3c0a587264146133028d12014fc6e508393f13d33003326b0aa9e2ce1e8aba9df0483de17079b1e3670566c2a446a6c8650b378678f31cc35f4d3c90482ce89e5a7423c8dba282baff00fda0301cb24558d1a49fa97fef004b4fcaeb90d9745e572024b0c2411d90b292a26c8234171c7a41a89c8a37a54a74474c2b5c8d39ca8714a3ede564605cb9c02b2aaa90c049e4ac3836973dea1dd4b59f9941d45de9c1b41e986e7cf834384d03608db1b790d7c4f35310ba22e582de46fb0d0482e444aa9d815745749ba49729c96c0b2524b920b916652996da2dce492526e90f7a944a88a7393524c00b9200ea74492e5127a46bcddf770e4df847a7356c7c0551435363b18366074876b009071797953bff00adfc14c635ad1dd00790011f68af14fe49697c11063a5befc328ea6db29f438a4528ee38791d08f448122667a48a4f7982fd468e1ea9a865029245b8727a32a8a274b17333307ffa34787277d15b52ca1c0381d0a760256f05944a5c614288a9b09569742ad996f6a98536a30e99a46ac6f6ad3d1ccd6ff2baf2d386abd938b401f0c8c3f1c6f6fcda42f1d55c45923daeddaf734fa1438f60e5d8d2096d0839a8bb1e325723682195055c338ef30d5295dbdc6eb0f0d7bc2b5c3eacbcea51636c5f00271b17bb241c72694ca19a90e7017f35d6b0aa71144c60f85a07adb55918291ae2d2403a8d7d56cd8e59bf537b64a269fd3e6e75b6fe476e85d233a4972cac8fed164a49726e59001726c02ac9ab647e90b74fbeed07a28722f183659c9281b903cf450df8a443e307cae543186026f23dcf3d392951c0c6ecd68f40a3730aa1143d0d4b5fee9ba773260255d4e4e711d25209457448d0792120129a7391bca69e51922c1172417a4b8a497222440e674b6bd47cc94d28b16524898c7a954dbdc697dc723e3e6abda54ba676a9ca9f023744bb80a9f0aafa65631224c445c8342bc7bc43116d5d434eedaa9dbf295c17b0dfb2f22f17ff00e7eaff00f773ff0078552b599149154023b2174abad08a58c031bca827105db1106e62dd5bd253ece0554b429d4150415975c929721ad8bdbc1b1c2dfb7985a88deb1b86cc2e0ad4c6f4afd5573190cfd2798ce24ccc89cfb6bb59340a44eccd669db9f8f82c9c9adb48a5865377e8c1eeb7eff8bbc149240d07246f29a7150112c865c8ae904a2cca4be07414b694d34a534aec90d0e224688a256ca0db9312393ef2a1554960b42b867a0729606e596ca2beac0e615362988e5b9bd875597a9c7c5ecd25e49b002e6e79580477563b03eba3a0b2b9a79a9515403cd61e8a9b1291b765154eb6b131b982dfedd93861c562399f49501a08bda3749a5f5f76fc90b0fc13eb43c9bf88a9512e730717c8c759ccb58ead21cd20721d56db87f16654b0b9a082d20386f6247546aace7052c49ae0d551956912a9a156d126a7d199258638fd9790b8b0debaab4ffd54e3fde397af1fb2f2863f134d5541bea6aa73ebdab95a8af7c81592c144184a5c709e8a7b1ad09c6d93be83f905bc81d8141586882bfa6c8dc8d0b5c9c63d476b9380ac1f23a69f0b9b65b1a692ed69eba7a8580c2655b2c265bb4b7d4226b21ea69b2bb5c94d0d9e96a70fa9705c31c97751e2727dabcfe4f4325810e4db8a79c16731ec7d91021a439c34b72df5d7a8564b24c4b29aa0377202af9318886ef0b9ae39c5a6fde7dfc1baacbc98f12763e64ffd5370d2ca4b9053d6550fe4eef4d8b46ed03c1f556b13eeb8870ace6799b1f6cd84c872b1efcc633213a31ce1ab2fb5ec5752c359554cf10d533293ee3c1ccc7f80775f0d0a1db43ac9ab535ddc47b3481114186e8dc10a0f0cb0cbd50e3751941babe902c171fd5e489fe47f9fe6b674bd645750f08e71c4d8f3a590804e506cd6ea2ffb45514758e0737306e2c48b7911b2bfe31c2e8606d39a5abfb53e6873cf60d0d8a4b36cd6db6ddc329b91947559828cf9329bcf675bf679ed3ea202d6543df3d3dc35e1e4be5801f8daf3ab9a3a1f4b2f41c3235cd0e69043807023505a45c10bc79c1f117d4b596b87325cde4184fe202f507b367b8e1b4d9b711968fdc6bdcd6fd0043ea5807178782d318c0a9aa9b9678992742459cdf16bc6ad3e4572ce23e189b0d78961924753e7b8b1b189c4e81e068472cde8bb2a62b699b231d1bc0735ed2d20f3055a50520f0b1c594982548923648d26cf6876ba1d7a8e4af62591e1589d09969dd73d84966936d6270bb4fe3f55ad88a22798f24dab9e071fb2f28e3d8257769533fd9a6ec8544ee2fc86c1bdabb5b6f97c6d65eaf76ca9590b2327316dde49b1b6a09dbc55aa938be0a46b53ecf230a829d65515a9f6a7c36da2ae73636da19dbdbc406cdb921ec1e01d7f42163d33ba7f201ac3c12bed25051d05deff0092383641e427d8fba0d682132f66559db78ca0dbb92d2825b396c709a9b106eb9fc52ad1e0f5bb046a249fb58bea22d626bc1be66ff50a546ab2827ccc07ee9b7a15650ac0bea755ae1f07a4a6d56d519af25471657f6509b3dad73ae0026c5cdf8837c560788b0e30500a99afda563b253c66ff00ab872973e577525a2c072cc0efb6db8870afb455d2c441cb23fbfd3234e670f0b807e6a17b7da173a2a5701dd1f6887c039ec6167d23704c69a09f229adb9c23b57938ed7e0f08a08ab3ed71ba69a67b3ecadb17c51b7377dc41b8d81d40d1c16791b858d8ee112d5338b8e1887b494c5c9f1bcf939a3303f45ea4e1eff2bc3e9dd30cc65a788b8ec7386819c743717bae0bc07c332ef9489eb1a6281846ac8891da4ef1c9a00d2ff985e91c3e8db0c51c2cf7628d91b7c9ad007e0979e1c9a22b6f7368ceb20730963b52d36bfde1c8fa84a2d5638ab350ef0b28791654e3b66d1b55d9ba29b224ad5cdbda5c44c4fb7dc27e5fc9750918b2fc4384b66eeb81cae6b9a6da1b39a41b78ad1d3d9b51d6437c708f39b8254719710d00924800004924f2006ebb7567b1b94f7a19a9e66900b7b66be37869d81732e0ab5c07d95cf13839d2d3d3f534f197c96f091f6cbf2298f5518af7758317c0dc232b3b96ff002baa6f661bbfd929c919e493a13a69bf2e6bd0b85d1b20863859a36263636f9345942c0b02829185b0b4ddc6ef7b897be47757b8ea7f05677548b79cb2630c72fb17742e919946a8aa036d4ff8dd1d17dadf4429630272e1f131a0fa1365650b957b7ef1d495269e45748bb8bda89e16531d6097b488fbcdef30ed6205c2d530aa8c6e945db201de0f66bd412010a23d96d349466717f6ad79a829a676afa7a97404f3c92464ebeac0b9405d97da6c5930e9c72fb7c21be7df27e8b8d808b1ce12235e92bded0ee823b2345c3133694d229120b854f87d4e600ab589f74875c046b230f610a451d4e528dcd51decb152d794553f0ce9fc2cc73a3ce4e8f0401d6dcd5fc0b1d83d7399041945f33469ebaad8c05636a6c73b1b67a0ab4ea9a62974f91ea6801aa81ff75b30f2bb47f02aef1cc1e1ab85f04cdccc78e5a16b86ce69e4415594e40735df74ff002fcd5fb1e084c699fb5a33b549b92670cc6fd8ed487f71b1d4b39383fecf25b90703a13b6b74ff000f7b27a963c38c54f05be395e6a9cdf16b0776fe6576ecc8b326b2df1913f4d14dc3bc370d2025a5d24b201da4cfb17bedcba35bfb23456ef288b93324b6519482c61e111711d40f3515ad52247e62900242de65943b0e2381873144a8a7bebd14f7b804d17044a9f80d19325e1151958187e1bdbcba2b2ed075544cf04a2e3d6cafea3870c5e7426f28b97481312d6347354efcdf78a60b4a957b2d1d2af2cb29f14e4144fb412a36508c3d161673961d5314b8270914ba67aaa6caa751bb54e57272016c14625d44545c45b9ac2f623bdfc14985720f6b7c7953435bd85388c175344fcee05c5a5ce9068dbdb903aa22fb8463251796527b72c498dec68587339ae7554dfbce196307c6c5e6de21727053d5954f95ee924739ef91c5ce738dcb9c799299440339b9cb731799048415b73064cc2eab29b15a682558b57f84d5dc58ee12d647c858b346d75d2646a66091480a8991246df83acea76f58dce6f9735aca52b9ff0004d7064ae89c74905c7ef0fe4b774eeb13e2b1f550db6337b4d67a942fe382c189e8eadcd51e27259210936ba2b28a7c344c6e2c79840e2de0a0101000227ab3f929e857f04b7624e3b0480e73bde3e89b6909c6b973949f6ceda974879a99a99c3479a582a2e2149da8b662d3d42acb38e08825bbdc5655e2a07350ff004d5b5e4373c925fc2449bf6ce75cdfbdaa9f4dc3e1a2ce75c7c823513507963d274a8e131dc32b33dc8d8ab225311f631f77335bea0254920dae997fdc59c0abc6780dcf4c3de89ef51a59528de0342029f3268cca2c93264d422d796c338e116914aae30e75d6519562eb47843ee02d7a618465eae7e0d1c3b2f30fb64afedb17a8b6a22eca01e6c8c66feb172f45e3b8cc7474b2d5487bb0465f6d06776cc60f1738803cd7912aeadd2c8f91e6ef95ef91c7abdee2e71f992a7c99921a477492e46a725300ba08905c70a4e52cd95d74da22171c6b68e6b8055844f597c1eaeddd2b430b92f28e184ce5135a482083623507c56a705e267f6b1b1e3de70617798d3eb6595694991dcc6e36f02876d71b2386169be753f6f476092b5ac02e7576c3aa784c08b8595a0a97564032ff00e2b2c48e771a1f43a2baa78e66b06661bf300b2fe7bacc552d8d7ee5fecdb5b658927c327f68876aa1cd2b18d2e91c5b61b68132da8b807a8050f0d72c2a8265ab654e364552264e32a54112a4b76c88fb455eca946671d573605d5c962d982a8e29c73b08bba7befd0787528dee79f72dea6cb398de0ce7bf3cce0e197286b49b01e24a98cb9e42d54477a72ff073fc478a4ba4b0cf238bada75e83aadaf0e6295196d2b5e5a1b7693625a7ee92a2536054b13b33236b4f5b6a15d7681b10039dcfd56b695a93c2e88d5ee84333f9e0b6a7af0e6dd335150b32da973526a312364b5943dfc115cd60b5a8ab0157c95f7d955c950e71e6a4d2404909ba28c72c1dda8e0b7c39ae73879adde0f0e8150e03877321633da57b4b6b1aea3a07ddc4164d50d3a31bb18e170dddb82fe5cb5d43ade11936d9b995bedb78d454c8286075e1a776695c0e92d40b8ca3ab59afa93d015cb5acba5323ba772d90bbe45db13910b2994948e772561fa28f429dab4ce51c8bced49e0a2c882befd127a2089fd1c8afad1281041112910e2a27e575d6aa8a6ccd056495be0953f09549c728b45f269e17a7a9a3cef03a9506372d070d53667dfa21d71dd2488b65b22d9b9e1ac3c44c396c1cfb126dd0683ea9da875693dd6c405f72f26e3a8164a8a40001e36fa213d3ca7564e19e0e6e71f88486b311d4b4bf8367e96dcb4b193fe7fe99dc59933a68fed01b68eee1a117e7aeba8ba71d888ea14eac82523f5ae64845ec5adcba795cae738dcb253c96d4b1db1dcb7c0a6351a69598920f4eaa1526a5f26dbf498ea118c507558486bf3ecefaa9d13cf549ca8c7634b5119731362316094dc5095988d4a8e5b2a3823b72668c62760a9313ae95d7b129427090e75d44609b21cf1d0de19048e3795e48fba34bfaab89466e5b0b01d026a91bc82b1642b52ac46384236c9c9e64ca9929aea29a15a17c239d80ea745163aca7cf93366237b0d07aa22adcba40a57420b96575361649d07d16a308c06da909da1a98ed768015ac3504ec99852d76675bac52fb4e53ed3eaf190d747f667d3d26a0ba13db76adff004b233dd1fb3603add7250bd7d4f3b872041dd6278d7d95d256874b4a1b4b506e6c05a195dbf7da3dd27ef0f5055670c0bab73d9c0186c1069d7552b16c227a495d0544663919b83b11c9cd2342d3c8850c34a849966d1a9c325606f2560daa6f82ca533ec13fdaf8adaaadf6a129d09b34ff00696f820b31da1ea8d13d529fd3af9295028040ac13404a769a4cae053482e24d7c125c02b57c355618d37df5585c227bb6dd15dd34846c50a12f4e793adafd48619d262b9a56ca0f7a5748e1e4d76403e87e6b15fa7e674a6391ce6b41b5af949f33badec705a8298ffa1d7cc92eff009be8b97e302d3dfc567c65bb5127246dd5ecd2c6316742c32405ba7e67f1555c4940d91bb6b7d3c0a18255774792935f266161a93a0f171d005b51e4cab1e33931588e05dd12447292d0f1cf95ecaaa9f1499a3501de7a15d325a36b581bbe5606fc82c3d5d200ed022dda684b9c19da7d55916d26370f117588fa109d1c48cfb8f1fd1fe2abe781448a3d3d4a45e8ebcf468c75f72f25c49c5513742c97e4dfe296ce30847c327c9bfc565eae56b9fd9e9a0dff006ba28474427a7845f01a3adb5ae4dbbf8f72fb9113fbc40fa0517fef7d74e7246e1103a5da05c7a9595823cc7c00b9f00ae292a3b38eed63ae37711665bcf7babc2115d82b6f9cba34ec99d1b3bcf73de752e712e24faa85455a6fbeae77d1418eadd234170b5c6dd14da6898366dcfcd352ba2b842d1d34e7cb36183e259b40e176f2574caf70e656230907b50d02c24fa3c0d0aded161c74beaaeae8b5906f4b352c1368abe4f123c569282b336fbaa8829eca640d2155d8a45de9da13c61c274f8943d9ca2cf6826294005d13bf369e6de6bce18fe073514efa79db67b0e847baf61f75ed3cda7f8f42bd4b4f2fd7f1594f6b3c2c2b690cb1b7f5f4ad748c206af8c6af8fe42e3c40eaad5cf6bc3e994dad1e75011a011d93c9140d04682be0e2a823441058e3204a494a52413f0493bd65aa8678e21da3c8d350162f0e932bd3b89d4173ad7bf4087c279674936b0776f67f8c3710a17467ba6291d1ebcbe263bcac6de8565f8f7871d4c639448d91b2b9cc3605b91ed00db7d6e09fe89541ec9b1834d58617dd8daa664ef5dbfad6eacdfaddc3d42ecd8ad71869e6963caecb18985f505a3de23fd924fa24251feffe4d0aec71a71e17672ac26a6c2c353d06a56930c85c4e6769d3f67af99fc35511f8bbe6198e5041d43400082742b5bc26d8ded717b03fe1d6d61a5f6eab55591a2bdf3e442c53be5b23c22ae678d42c5e2128b95b6e31ae818c698632c739ef8ed60012034dc007c5739a9a4a879d801e2e08f1d42b20a4bc8a2d3ec93443a89858a8903f4b7453bf404c779183fa4548838748de51fd1fe68396d87513278941639c7af9f54db4179d39efe6b692f0bb5e08321d7a008a0e19318b32406dd5b6bfc90669f80f5479f71518760e438122e09008b96dc1dc5c6a168a5c3dae665c8c003da0771ae2d1626cd91c73b469cb7f0d94694cacd0b1da736f7bf0d42b09eaa3ecc3c59ae700e2d765616bc139bded4df5b5b7b8f208d8e69a6d1a31857e05d360c3a2b3a7c1c05170ec598ee615ec152d3cc25ecb269f23b5d706b82345876521c06ac7070f4375bf82116594ed4596da9d966b7f747e0a69b1b6f20b5104b013234f35896d625654fc6424d01814aa69391e4a21900f149354c6074af395b1b0b9e4f26345eff44c439425a9f6f28f32712d1886aea2268b362a9998d1d1a243947c957abfc46613cb24ae16334b24a7c33b8badf550a4a00765a719212c95c829bf6028226e4764cea30820b206c24a4105620283de1e6bb27b32e5fe3923412f6741eafb8dd7137bbea157537f9b9bff00c7cbff000f22082565f743f2332fb25f839de07b7ff59fec2e81c15f1f98fc0a0826753fa0c0e9ff0051149c4ff07fad9ffb31aa308208da6fd28fe05dfdd2fcb025b10411d9c87989f6208214ba0b11ba95024fcca082af822645c43e1f4fc959e1fb20824b526968fa2ef0ef7d9fbecfed05d35a82093a7c85d4f81326ca3a0827e1d09c837aa0e39ff37557fab67f7ad4104f53e0cfd57dace22138c4104d2157d0fa0820ac50ffd9,
        101,
        NULL,
        '2025-04-05'
    );

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        117,
        32,
        'fadhiya',
        'cgfgh',
        '2018-06-21',
        '',
        'ghjk',
        '',
        'English',
        '',
        'M',
        0xffd8ffe000104a46494600010101004800480000ffdb0043000302020302020303030304030304050805050404050a070706080c0a0c0c0b0a0b0b0d0e12100d0e110e0b0b1016101113141515150c0f171816141812141514ffdb00430103040405040509050509140d0b0d1414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414ffc000110801d201d303012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fd159a6f261a28a3cea002a6a861a9a800a28a87fe5b5004d50d4d50d004d454345004d4543e7514005145140135150d140135150d140135150d4d4005145140051451e4d00145137efa8a00968a2a1fb645ff003d63a009a8a8bce8a1ff0059479d40054b454540051479d45001451450043479dfbda289a800a8a8a96800a8aa5a28022a28a2800a28a21a0096a2a968a008a8a28a0028a28a0028a28a008a8a96a2a0028f268a28021a28a2803428a28a002a6a868a0028a28a0028a21a2800a28a28022a968a2800a28a2800a28a2800a28a28026a28a2800a28a8669bc98bcd93fd5454013515534fbc8b52b58ae63ff552d177a94567179b24b1c517fd3696802dcd5c7f887e2d7843c2b7ff0066d5bc4363a74bfeb6586697fd57fd75ac4f137c7ef08786e5fb37f69c7a8ddf95e6f9369fbdf2abf33ff6ecf891e1af1b78ded3c4ba0ea71cd69756bf65ba861baff96b14b41afb33ed6fdaebf6bad37e167836ead7c3975fdafaddd5b4be57d963f37caffa6b5f9b3a1fed51f11bfb2f55b693c437d34b752fdaa2fdeffaa96bcab50f126a7ac7fa4c97327fcf2ff5b5cfda5e4b0c5e5472c7591a9f4d6a1fb667c46f15784bfb0f51d72487558a5ff908432ffad8bfe794b5f5dfeccbfb665b5e5ae95a3f89efa3f37ecdfbdbb9a5ff0055ff005d6bf2926bcab70eb12fdabcdff96bff003dab203f7d743f8f1e15d6354feccb7d4e39a5ff009ed0fef62af40fb6473435fcff00f84fe2a789741bfbbd4f49d5ee6d2ebcaf2a59abe8bf84ff00b6978974dd1aef4dd7b57b9b49628bfd166ff5b14bff004ca5ad3da197b23f5d7ce8ff00e7a515f949e1efdaea2d7a5f375ad4f56b4965ff005535ddd4b2c517fd72af7bf80dfb697f63eb3ff08f78f6fa3bbd3e597cab1f10ff00ed2969fb40f647dc14567da6b115e5ac5736d2c53452ff00aa9a1ff96b55756f127f63daff00a358dcea32ff00cf1b4f2ab53236aaacdfeb7f77ff002cabc53c59fb485b7856d6ee5d5ac7fb2258a2fdd437775fbdaf45f87be30b6f1b68d16a765731ddda5d7fcf197fd55007570ffd34a968a2800a28a2800a28a8a800a28a96800a2a2a96800a8aa5a8a8025a8a8ffa654500145145001514d52d14011543534d0f9d450044b36545151af4a28034e8a28a0028a28a0028a28a0028a28a0028a28a008aa5a8aa5a00289aa2ff005d52d0010d14514005145140054d50d4d4005733f10ace5d63c11add8db5cfd92eaead658a29bfe9ad741e77935e3ffb4568f6de36f01ea1a647abc9a46a1e57fa2ddc32f95e54b401e4bf05ff006c0d32cf41ff00847bc4ff00e89e25d33fd16ea1ff00a6b157c89fb52fed45e21d7bc792ff00c231e21925d3e2b9fb5450cdfbd8a297fe9957857c5ed37c4ba0f8a350b6d7a5926d43cdff008fbff9ebff004d6bcea5d62e7cd965fddf9bff003d66fded64751ea1f10fe305f78da6fb76a36365697fe57ef26b5925ff00dab5e5377e248a68bcaf2bed7ff4da6aa9a85e7db3fd6799e6d1a7e8373792feee2a06559af2e66ff96bfbaa21f361ff009655d8693e0ffdeffa6c5e4d775a4fc3db19ad7ca8ff007dff004c6b1f683f66792e9fa3fdb25f2bfe7ad741a77857fd165f322af409be18fef7cdd3ae7c99a2ff00a6556a1865ff008f6bdb6f26effe98d1ed0d7d99c5787bc2b17dabecdff3f5fbafdf545378565b39658a4ff552d76bfd8f7334de5795e4ddc5fbd8bfe7ad685a5e47a979ba66a317fa5ffcb2a0471fa4d9c7f6596da4ff005b17fcb1ff009eb157a0786618af3c39e6db5cfef6d7f75e4cd58bab6836dfd8de6d97fc7ddaff00aaff00e35589a7ebdfd8f7535cc9fb9965ff005b0ffed5ac80fad7e0dfed397df07e5d2ac75696e6efc097dfeb6187fd6d8cbff3d62afb2ffb4a5d7a5b4b9d3bc4b243692c5feba18a297feb957e4ce93e2afed8d2eef48b997ce96297cd8a6afa2ff670f8c12f86f5097c35ad5cc9fd952ffaaf3bfe5956b4c75299f5878f3c1fabf8aa2b4b1b9f10d8ea3e6ffaa86eed7caf36bcff00f665fb4fc3df88369a649f699b4fd4ed65ff0096bfbaf2a2f2bca97ff46d549be39691a6fc418a5fb7470cb636b2dacb34d2ff00ad96ba0f0f5e58f893e2368973a4df7daed2c6c7fd75a4bff4d6b6303ebb866a96b3f4ff00f8f5ad0ad4e50a26a28a0028a8a8a002a5a8a8a00968a2a2a00968a28a0028a28a002a2a96a2a0028a28a008a89a8a87f7b34bff004ca80124fbc68a99adfcc62deb45005ba2a2866fded4b4005145140051451400514514005151514012d4552d140051451400514514007fcb6a21ff005d454d4010d4d50d70bf17bc792f827c07ab5f595cd8da6a1145fe8bf6b97fe5ad0074be2cf2a6d2e6b6925921f37fe78d7e6ffc7ff89de2af01dfea1e66a773abdaff00cb28750fdd795ffa2a5ae2be26fedbdf176cf5ebb8a4beff00897f95e54be4c5fba8a5ff00a652c55f327c48f8b5ae78db54fb75edf4934bff003d66fded6475d322f1978dafbc552ffa6f9934517fcb69ab899a6fdd795e6f9d514d34b79fbafde7fcf5a96d61ff0055e5fefaee8026b487c9fdef951c35daf86747bed625ff009690d65693e1b97ed5fbcff5bff2cab7f50f155b7856d65b1b2ff4bd43fe5acd589d74cf46b4f0ddb69b6bfbdbeb6f37febad67ea10cb0ff00c7b496d0cbff006ca2af14bbd7ae6f24965d46fa49bfe98d4da7ebd730ff00c7b4524317fe45ac7d98fda1daeade30d7341962964963bb8a8ff859d16a517fa4d73536a5737917faa8ff00efed67cd6773e6ff00aaff00c854cd8f40d5bc6d6da95afef25fb5ff00d36ff96b5ccddf8dbcef2bcc97f7b17faa9ab9a86196a6fb1c57917ef3fd6d065a9d2ddf8f2e6697f7927fadff005b2d43a86b115e7dae5f37c9ff009e55cd43672fd9658a4ff96552c3672795e556a739a1e13bc93ed52fef7f7b5e8169e24966bf8a28e5fdef95e579d5e75a7de7d8fcd97cafdeff00aaa2d358f26596593cd9a5f2a803bbf0f6a57335ff009ba8dcc9fbaff5be4ffcf5af50d0fc6dae783e6b5d734eb9b9b4bb8bfe58f9bfeb6bc3fc3da945a96b3149a8c5e745e6f9b5f40693a0d8eb1a5ff6647249a74bfeb65866ff0055e55007e807ec9ff1e3fe16d784bfd262f2750b5fdd4b0d7d0b5f9a9fb06ea573a0fc50d4228ffe3d3ca962961865afd2bffd155ad2396a12d45437fcb1a2b6310a28a2800a96a2a28025a28a2800a28a2800a28a2800a21a28f26800a28a28022a3c9a28a008a8a968a002a5a8aa5a008aa5a2a2a00968a28a0028a8a8a0028a28a0021a97fe5b54545004b451515004b45145001451450015f157edc5f122db4d965b1d46e7c9d3ed62f362b487fe5ea5afb56bf26bf6f2f185cffc2cbf15db471c937d97cab5966ff9e5595436a47cbff14be2d6a7e3cd525f33f73179bfea7caf2abcebf7b354b343e7510c3e4c341a8793fbaadbd0fcd87ca97fe5acbff2dab9f9a6fdeffd32ad5d0fcdbcbf8bfefed2a83a6777a84d2e8f612f97feba5ff96d589a4fc3dd4f58fdefef2bd2f43f0dff00c2497515affdfdafa57c11f0ae28628bf775e4d4c4fb33e870d86f6a7c9f67f036e669628bcaaec343fd9a753bcff96527fdb6afb9743f86f6de545e65b475db69fe0f8a18bf771571fd66a9d9f52a67c1f0fec977d37faba866fd97757b397fe3da4afd16b4f0ac5ff3cab6ad3c2b14dff3ce8f69505ece91f9b5a7fecaf7d79179bf6192a1d73f651d4f478bed3e557ea0ff00c2376d0d675df8562bcff9651d3f6950cff747e587fc29397f7bfe8dfbdf36ba0d0ff675b9d62d62ff0041fded7e884df09748ff005b25b79d2f9be6d4b77f0f6dbecb2f974bda5434f6748fccaf137eceb2e9be6cbfbc9a2ff9ed5e49e37f01dcf86e5f2ae6297caff9655fac137c31b6b3b5fde7efa5ff009ed5f3d7c79f83f6d79a5dddcdbdb7fcb2ff00bf54e9e242a60a955a47c1da7c36d3795feb3f75feaabbbb4d6353d36d7cd8ee649ad25ff9ed5cd5de8f1437f7517fcb5aed7c11e6ea56b2db6a3e67fd76af5cf9ef6563ea1fd8626b6d4be23452cb2ffc4c2ebfd6ff00d72f2abf4abfe58d7e357c3df155cfc31f19695a9d949e4cb6b2f9b17fd72afd60f84ff10ac7e2178374fd5eca5ff8fa8abaa91c750ed68a28ad8e40a28a968022a28f27f73e554b401154b451400514514005145140054d50d4d400543535434005145140115152d140117fcb6a28a96800a8aa5a8a8025a8aa5a28022a3c9a968a008aa5a28a0028a28a008a8868a28025a2a286a5a00289bf7dfbaa28a003fe58d7e42ffc14ba1b1d37e34c3fd8b2c9fbdb58bfb4fc997fd6cb5faeb357e47ffc1437c37ff08df8cbcdd465f3aeefbfd2e2ff00b6b595436a47c69773450ffc7b7fadff00a6d557ce97fe5a512ffd33fdcd4b343f6c8bfe9ad0233e6aeafc1f04a2de6923ff005d245fbaa8bc3de09b9d7a6ff55fbaaf7af047c25fb1c514b245fe97feaa286b8f13569d33d7c161aa553d2fe05f827fe24d6b7373feb6eabeb0f0ce831436b17eeabcd3e1be83f63d3ed22ff9f58bcaaf6bd0e1ff00555f3c7d77f0a99d069f675d05a59d67e9d5b76bfeaeb5a471d42d5a59c55ab0c35561ad086ba8f3ea12f935179345140886686b3e6ff535ad34d59f356550da99ccead0f9d5c5789b41b6d4ad658a48bcef362af40d421f3ab135086b90eca67e5d7c7ef01cbe0ff194b2db5b7eebcdff00535ca693ac7fc7a5cc7fb996beb0fdaefc1ff6cb096e638bfe5957c95e7450c52dcf95fe897517fe45af5f0d53f767918da7fbc34350d7bfd2a28a4ff555f62fec05f19bec7aa5df842f6fbcefb57fa55ac35f07ead37ef7f77feb62aeafe10f8abfb1fe25f83f538ff73fe9d179be557a28f22a1fba10d151693379d6114bff004caa5ff965fbbaeb3ce0a28a28025a28a2800a28a2800a28a2800a28a2800a9aa1a9a1a0028a28a00868a28a008a8a968a0028a28a002a2ff96d52d14005145140051451400514514011514514012d45451fbdff00b6b400793e4d4b44d4500145453514012d7e487fc151358f3be39fd9a4ff00556363145143ff00916bf5aabf193fe0a53677d67fb48f883edbff002d7ca962ff00ae5e545591b523e4ff00f9652cb56f49b396f2ea28a3ff0096b553fe5b576df0f6cfcebf8a955d8da953f6b54f7af86fe09b6fb05a451f995ef7e13f0dc7a6f952f95e74bff3dabcff00c110f936b157b2f87bf7de557c9d5a9a9f7b4a9fb2a4761a4d9f932feeff00735e81a1c31435c7e87dabb6d3ab10a874b69e556ada5655a568435d748e4a86ac3355b866acff0026b421ff00535a9c84be7545e74b5179d47934016bceaab354be4d549a1f268033e686b2b50ff9e55ab7758b7737935c875d33ca7e3468316b1e17bb964ff965157e77ea1672e83e2396c64fdf5a79b5fa57e32ff4cd2eee2ffa655f9fff0017ace2d3754f3648ff00e99576618e4c6ff0cf1fd5ace5d3754962ff0032d6afc1cd1ffb7bc79a558c9ff2d6fa2ae575cd6259bf7be6fef6bd97f649b3ff008493e32786a5fddc3e55cc5752ff00dfdaf711f387ed2e8767fd9ba35a5b7fcf28bcaad0a8a1a2bacf3c968a28a002a287fd754b4793400514514005145140051535140051451400514514010d1535434005145140054d50d14005144d450014514500145145001451450015154b450015151515004b47ef28a28025a8a8a2800afc9aff0082a7e9b7367f1cfed3247fe892e8f6b2c5357eb2c3fbe8abe1aff82aa7c2cbaf117c3ad13c57631e0e972cb15cfeebfe594b41b533f2526ff5d157a5fc3787fd3e2f32bcff00c98e1ff595ea1f09ece59afeb9311fc23d1c0ff14fa57c33fb98a2af60f0f4d1795e6d787e9fa945a3dac52c92d67eadf13afaf3fd06dbccf2bfe98d7ce9f65ed7d99f55e9fe30d361ff0057731cd5d5693e3cd33cd8a292fa387febb4b5f0fda6bda9cd1ffa34b27fdfaac5d435ed5f4793cdb98a4f37fe9b51ecce4a954fd3ad3f5eb19a2fddcb1cd5a10ea517eea5f36bf32bc3dfb426b9a6feeada4961af6bf06fc7ed5f528bfd265f3a5ff5b4053fde9f72da6a514d56fcefdd5784f823e2745a94b157ade9fa979d17eeeb5f68655299abe7450d1fda51435caf88758fecdaf24f137c48be86ebcd8ffd551ed03d99f42c3ac45e57ef25ac5d43c6da6432f95f698ebe09f891f1e357d36ea58eda5ff55feb7f7b5c2e93f153c43e2abff2adbedde6ff00d72a03d9d33f46a6f1b69979feaee6aaff00695b6a5179b6d2f9d157c89a1ffc24335afda7cab987ff00215741e1ff001b6a7e1bba965b997f75ff004dab92a1d74cf7ad4218af2d65ff00ae55f0afc63b3961d7a5d32e7f7de54bff0090abec5f09f8aadbc496be6472ff00d7586be65fdadb47fecdd674fbe8ff00e5ad6d86fe298e269fee8f8ff5cf2b4dd5258ada2f27f7be54bfbdaf75ff00827ed9c537ed0fa7db5cfee7cdff00555e1fab4dfe9fe549ff003d7caafa03fe09efa6ea7a97ed05e1fb6b6fdcfd96296ea59bfe7ac5ff003cabe891f187ec8514510ffcb5aeb39021a968ff0096d450014545e754b400514514005145140054d4514005145140051451400514514010d15663fb828a00ad451450014514500145151500152d4552d0014514500145454500145145001451450014514434005715f1bb47b6f127c25f15d8dec7fba96c65aed6bcbff694f891ff000ac7e106b7a9c76d1ddddcbfe8b14337faaf365a0da9fef4fc24f1359f93acdd45ff003ca5af4bf839feb2bcff00c650cb67af6a1149feb6596596bd17e08d9ffadf32bcec4ff08f5b03fef2777e32fdf450dac7e679bff4c62ad5f06f86ff00b362ff00498bf7b5d369fe1b96f3548a5f2a39a2ff00a6d5abe26ff890f95e5c51f9bff5d6bc3f687d47b336f49d7b43d06d62fed1f2fcdff9e3feb6ba5fed2d23c496be5ff61feebfe597dafca8abe6fbbd1fc5579af4b2db451c3e6ffcb69aadeadf007c5de30ff8f7d73fd2bcdfdd7f684b2d6becfda9954a9ecffe5d9e81e32f01c534be6d96876337fd7a5f455c25a6a51e8375f6692da4d3a58bfe58cd5eb7e09fd9d756fb5cda9f89bfb3750bafb379421d3ffd162f37fe7afeeaa59be03eaf0cbe55eeb96d77a7ff00cfa5dc5fbdff00bfb5954fdd1ad2a9ed48be1bf8dbced521b6afb6bc070f9da5c52d7c2be19f04ff0066f8f228adbfe3d2296bef0f047ee74b8bcaac69ff0010788fe1993f122ce2fb04b2f9be4d7c9fe3cd63fd6f99ff002cabec0f1bd9ff00695af955e1fe3cf83fe7683ff129fb343a84bff2daee8a86986a87cbf0de45f6af364d32c6d2d3fe7b6a12f955ed7f0f752d226b5ff42b9f0dcd2ffcf186fa2f36b85d73e03c579e17bbd32f628e6d6fcdf37fb42697cdaf39d27f651f19c361fd91278974d874af37cd8a1862965962ff00b6be556d4e9d3aa6588a9529ff00cbb3eb09be2458e9b27d9756b1feceff009e537fcb2aa9e2cd1ec7c4961e547fb9f37fd54d0d78ff00fc2a5f1c683e55b683a9fdb2d3caf2a58756fded7ab7c3df0dea7a6dafd86f6c7c98bfe78ffcf2ff00ae558d4fdd1ad3a6733e03d36fbc1fe2896dbcdf3ad2e7fe5b5657ed81a6f9de17b4be93fd5452fef6bdeeefc13fe8b14bf66b9ffaed3579a7ed29a3fdb3e1cddcbfebbecbfbda297f10cab7f08fce4d5a1ff45b4beffb652cd5f787fc12d7c137336a9adf8abcaff44b5b6fecf8bf755f0aeadff12dfdd795e7452cbfea6bf543fe09d9ac58ff00c2b497c3d651793f61fdecbff6d6be9e9543e36ad3fdd9f5ad14515d879a4b515145004b5154b51500152d14500145145004d451450014514500145dcd159dacb7327faa8a8a3fd77eea800ff5d45147fcb6a008a3fba28a4a2800a8a69bc9a968a0028a8a8a00968a8a1a2800a968a28022a968a8a800a28a28025a8bfe5b5144d4005145454012d145140057927ed55e09ff0084f3e03f8af4c8e2f3aea2b5fb545ff6cbf7b5eb7515df9535acbe67faaf2bf7b41b52a9ecea9fcfcf8df4d93edfe6c917fdb5af4bf8390f9361e6ff00cf596a5f8fda6d8cdaceab2e9d1793a7c5752f950ffd32f37f7547c329bc9d2e28abc3abfc33e9f0d4fd9e24fa83e1bd9db4d6bfbc8a39abd2e1f01d8ebd1795f668e68abc93e1bcd27fcf4af7bf0cde7eeabc33e8ce12efe06df69b2f9ba4ff00a5ff00d319a5ab7a4f86fc5567ff0032d49ff6c65af75d26b6fc98bcaad7d9b31f69eccf1ad3fc37e2fbc8bf7915b69117fd75f365a875cf0ddb68314dfbd92eeeff00e5acd357adea137eebf775e5fe37bc8a18a5f32835a750f3ad0f4d8bfb67cdf2abe8af044d2cd615f3fe8779e76a95f4378221ff0045ff00555b5231a8686a1379d2d1696716a5179773151ae7ee6aa69fa950719cff0088be12f9dfbdd3ae7c9ffa635cd7fc2bdf10c337fcb3ff003ff6d6bdc2d7fd5d1343e77fac8a8f643a789a878fe9fe03d5fcdff49963aeeb4fd1e5b38bcaf2bf75ff003c6b6fc9a8a6a3d90ea55326ee18becbe5578ffc4db3fed2f0beab6d27fcb5b5962af60d43fd54b5e55e329bfd16eeb235a67e626ada0cbac5fdd6911c5e75df9bfe8b5faa1fb14f80e5f01f8725b1b98a386efecb1452d7c2bf08747fb67c7dd2bcb8bceff4a97cdffbf55fa81f0b6cfec77fa87eebc9fdd79b5edffcbca6787569fb2c3543d168a2a5af5cf970a28a28022a968a2800a28a2800a28a28026a26a87fe5a7955379dfbaff00a654005150ff00cb1a9a800a28a2800a26ff009eb451400793451450043451450045451343e74352d00145145001451450015154b517fa9a0028a28a002a2a96897f7340114d479dfbda3cea2800a96a2a28025a8aee1fb65acb6dff003d62f2aa5a2819f8a9f1bb4db9d075ed574cb98bc996d6ea5b597fed94b5cffc329a5fb2c5157d61fb73fc3db687e2b6ab27951c3f6eb58aeffd57fad97fcc55f22f823cdd36fe58a4fdcd78757fe7d9f634aa7b4a94aa1f50780a6f2628abdc3c27795f34f84f52f2628abd9bc1baf7fd35af24f78f7ad266f3aba0fb6579d693ac7eea8d5bc61e4feeadbf7d2cbff2c697b531f6674be21f125b59c5feb6bc426f1858ebdacea1e6dcc7fbaff555abe26865fb04b2dcdcf9d2ff00cf1af93be21437367aa4b2c7a9dce9de6ffd35a3f8a6bfbba54cfa1b49f1258d9ea9f65925fdec55f4af823c496335ac52f9b5f96bff000956a7677515cc5abc9772c5ff002c66af65f87bfb484ba6dac515cc5279bff4c6bafd9d4a4727b4a754fbef5cd62dbcdff5b5cff9d14d179bfea6be44d73e3678ab5897fd0becda745145ff002f7feb6b6fe1eeb1e2fd7b548bfb6bc551cb69ff003e90feeab2a86b4e99f52e9fe30f27caff0057e5575769af5b5e579fcde158b52b08bcb97c996b94875eb9f0aeb3f61bd968f69ecc7ece9d43dd7ceacfd426ae6b4ff1845345fbba26d4bcead7da9c9ec896ee6af2ff001e4de4c577e64bfeb62af40d426af1ff008a5ac456761a84b27faa8ad6b94d4f35fd93f4db19bc51e26d5ee7fe3eed658ad6d6bef5f86ffe9916a173ff002cbf75157c69fb19c3630f837c57abff00cb596ebca8abed6f865672d9f836d3ed3feba5fdecb5ede1bf887878eabfecfecceaa8a28af5cf970a28a2800a2a2a96800a28a2800a2a6a28021a3fe58d1ff2daa6a0086a6a28a0028a289bcdf2a800a28a2800a28a28021a8aa5a2800a28a2800a28a2800a28a8a800a28a2800a28a2800a26a2a2a0028a28a0028868a28025a28a2803e4ffdbcbc2be7683a2789638bfe3d65fecf97fedad7e6d79df63f195dcb257ed87c4df87b63f13bc11a8787af65f262baff005537fcf296bf27ff006a5f803a9fc07f883a7c525d47a8c57d179b14d0c5e5579d5699ebe16a7eecd5d27fe3c22963aec3c27ac4bf6a8bf7b5e7ff000cb588af2d7ca93fe7956dfc3dbcf3bc6f776327fdb2af9eaa7d952a87b843e2a96ced7cbff96b58977e3c8b47fdecb73e76a152fc52bcff00843fc2515cc7ff002d3f755f256ade3cb9fb54bff2c65922f37feb952a54bda862313ec8fa03c59f1822862bb97cdffae50d7ce9e20f155ceb1752f992ff00a5ff00ad96b166f125b5e4517db6593fd6d4369a6fdb25965b28bce965af469d3f6479352a55ac67cd0cb0cbe6fef26f37ff0022d761a4de5f683a35ddcc7feb7fe78f9556fc3de03f10de5d5a797637335a79bfba861afa0356f0adf69be11feccb9f87d25a5ddf45e54577ff003d6b6a950d69e0ea1f3ff8675ebe9aebf79ff2d62adbb4f1b5cf86f598ae63b99218a2ff00963ff3caba5d5be0ff008cfc13616973a8f87ae61f37fd54d3455cfea1e15d5e1bafb36a3a1dcff684b17ef61f2ab036a787a87d21f09ff68ab9865fb36a32f9d17fcb2aeafc79af691e2ad2e2f2efbec977e6f9b14d34b5f24c3e2ad334797fd36292d3ca8bff0022d45ab7c48b1d4ad628acafbce96ebfd6ff00d32f2ab2f646dfc23ea0f01f8db52d3759fec8d4658fcdff00965343feaa5af6b86f3ce8bcdaf867e1bf892fb52d534a8a4b9926fdefeeabed6bb9bec761e6f95e4cbe5572d4fdd1afb4f6a685dea5fe812d7cf3fb456a5e4e97e5472ffadaf46ff8493ceb5f2a397ce97cafdd7fdfdaf9a7e31f893ed92cb6de6f9de55d79514d5a52fded4392afeea99eedfb27e9bff16bff00d1a5f27edd7de6d7de16967f63b08ada3ff96517955f34fec7ff000662d1fe1f695a95eea7f6b8bcdfb54569e57eeabea0afa2c352f647c963aad3abecfd98514515d879c145144d0d0014514500153514500145150d001479d451feba6ffa6b401351451400524bfeabf774adff002c6a19a8026ff96d50cd37eebf77454d400f3cd14c5f2f68c74a28021a28a2800a28a2800a28a8a8025a28a8a800a28a2800a2a5a8a800a28a28022f268a3fd754b40054552d14005145140057c1ff00f053fd1e586c3c1fabc7ff002ca5962fdcd7deb5f3d7edc5e038bc6df06e5ff46fb5dddacb14b1793595436a47e5ff0080f588b4dba8a2925fdd4b5d0693e24fec1f88da4df7ef3ca97f752d79a69337f63ea9f66925ff004bb596b5bc59792cdaa69f2f9bff002d6bc7a94ff787d452c4feecfb43e31e9bff000987c1b96e6dbfd6c5179b157c33a4e832ebd75145e6ff00a5cbff003dabed6f817e2a8b58d062b1b99639a2af1ab4f87b630fc4bd422d3a293fb3e296597ceff9e55c94ea7b23d0a94fdad4f6878a5dfc31d5f47bff00f49f33caff00ae55ee1f0b741f0d4d6ba85b5cdcc7e55d5afdaa29bfd54b17fcf5af40fecdb6fdd5b5ec51795ff2ca6a3fe155e87a94be6c9a65b5dffcb2a3da7b53d1a74ffe7d9e8be0df89df08b47d07c352def886c7ed7fba962f2bf7b2ff00db5f2abd6f50fda2be115e5869ff0069d5e4d47cab98a58bec9632cbe57fe42af1af09f83ec7c372c5f66fdd45145e545e75af9b5eaba1c32fd8258a3d5e387fed953a750e4a99754fe27b52d7c48fda8be116b16169149737da8f957514be4da6992d71fa87c6cf869ac7892ef53b6fb4c32dd699e6daddcd632c5e6c5ff3ca2ffa6b5e97fd8f73a945fbcf10dcf95ff4c62ac487e1be9967feae2ffb6d356b50ca9e0e9d2ff97a7cff00e37f86fa1f8c34bfeccd174897cd96d7ca8aee68bfd57fd35ffaeb5e5fe37fd92ffe158f80e5d4eda5fb66a117ef65afb9ad34dd334d962fb1797e6ffcf6ae67e2f59db43f0fb56fb4fefa5962ac4eaf694cf92bf655f04dcebde2396fa4ff0055632ffe45afa57e296bdfd8fa0cb15b451f9bfeaa2fded792fecf7e2ab1d0746d43cbff009ebe6dd4b5ca7c52f89dff00092788ed228ffe3d22baf365f26b2fe29e7ff0cec350d622d07418becd2f9d7714517ff6daf9ff00c43a94b79e2db4b68e2f3a58a5fdeffd75aeefc41e24b9d36d61bef37f7b6b179be4ff00e42aa9fb35fc3dd4fe277c5ab48a38a4f2bcdf365bbff9e5ff004d6baf0d4ce3c755fdd1fa61f017c377de1bf86ba558ea5e5c377145fbdf26bd16aae9f67169b6115b47ff002caad57d11f2415154b45001443fea68a2800a28a28026a86a6a86800a28a2800a2a6a2800a28a2800a28a28021ff963537fcb6a28a0028a28a00868a8a8a00968a2a2a0096a2a28a0028a3fe58d14005145140051451ff5d2800a28a3fd74540117fcb6a96a29aa586800a96a2a961a0028a28a002b2bc4da3c5af6837763245e779b156ad1401f86bfb45783e5f01fc5ad56da48a487f7bfbaf3a2f2ab89fed2fb645fe93ff3d6bf483fe0a31fb37cbe36f0945e2ed06c649b50b597fd2a1862ff005b157e5aff00a4e9b2c5e64bfeaa5ff535c95299e8d2aa7bafc27f88573a0f9bfeb3cdfdd7fa9aed7c0fe3c8b4dd66eee6e7cbfdedd7ef66af9ab44d7a586ea596ba5f0f6b12cd2f9524bfba965ff5d5e6d4c31e8d3c49f634d35b6b161f698ffed956243ac5f68f14b2c72c9ff3d65ae2bc1be3cf27f75732f9dff2cbfe79574be2cd62da6b5962b6f321f36bcff67ec8fa2a557dad33a5d3fe366a7676b1799147feb6babd27e394be4ffa6db470ff00ed2af9bf50d7a58648a28e2fb5cb17fe45ae7f56f154b0cb77631f9934b5a997b53ec587e3f5ccde6fd8a5b6f2bfe5956569ff0013b5cd4b5e8a2bd964862baaf96b43f155cfdabec31fee6597f755efff000cbed3e24ba8b53fb3793696bfba97f7bfeb6b2a86b4cfa2fc27e6fd962d4ef65fdd45fbaffb6b5e4bfb47fc549747d2e5b68e2ffaeb357a078b3c616da0d879b1cb1f95ff002ca1f2abe29f8bde309752d5258a29649b4f8a5ad69d338f1350343f1545a6e837717ef3cebebaf365f26b9ad3f5ef275e8ae6e7fd2ff7be6d62c37917fd76ff009652c359377a97d8e5bb8bfed95767b23c9f6a74be26d625d63caf325f3bcdbaf2abef6ff82767c37b9d1fc2faaf896e629218afbf756be745ff002cabe1ff00803f09757f8cde37d3f43b68a4fb279bfe95343ff2ca2afd9af0ce8363e1bd1ad34cd3ada3b4b4b58bca8a186bd1c3533c9c455f6a68514515d6718514545e75004b4514500145145004d4543e75140051454d4005145140051451400513514500145145001451450054a28a2800a28a2800a28a2800a28a2800a28a2800ff009634510d14005145140114dff4d2a5ff00965feb6a29aa5a002a5a8a8a0096a287fe7ad4b45001451450055d5b4d8b58b096c6e7fd54b5f873fb587c37ff008563f1a7c4ba6c7ff1e9f6a97caafdd0afca5fdbb3478b52f8e7e258bcaf3bfd57fe8aae4a953d91d787a7ed4f89219a5d365f2bcdad5b4bc8a1f2bcbf326fded55d6f47974d97f791554866f26ea296397febad03fe11eb7a1f892586ea6ff9eb2ffaaaeabfe130d4ef25b4b18ffe597fad861af1a8758fb1c5a7cb6dfbef2a2fdeff00dfdae83c33e24f3afe5b9b997c9b4ae3a94cf470d893defc1da3db5e5d4b2decbe77ef7cdfdf4b5a10f856c61d53ed3f66f3bfd6cbfb9af3ff000f78dbec775f668ffe5ad6d43af5cc3e6c5e6f9dfeaa2fdcff00cf2ff3e5579dec8fa1a75299d5f87b41d321d66ef53fb0f9d2ff00cb59abb58758fec7bf962b297f751452fdaa186bc97c3daf7ef7fd27fe3d22ff00c8b59fe26f154b0cba845e6c9e6dcffcf1a3d907b5fdd9d078cbe2a4ba95fcb179b24dfbafdd57926a1a94ba94b2f992feea5fded549b5297fd2e4922ff5575ff2dab9fd7352b99a28bcb965fb5f9be6cbe4d7a34a99f3d56afb50d5b5296ce5f2bcdf3a2f37fe58d5bd274797c49ace9f636de64d2cb75e57fd75acafb679d2cd147e5f9b75ff004cbcdfded7d81fb1ff00c198acfc65e1fd5f5a8bfd2fedd14be74d5b54a9eccc69d3f6a7dd5fb35fc07d33e09f822d2da38a3fed5ba8bfd2aefcafdeff00d72af66a86a6af411e4854353514c454a2a5ff005d2d1401154b45140051451e4d001454d45001451450014514500145152d00454514500145150cd40135150d14011514514005145454012d14434500145147fcb6a0028a28a0028a28ff009634005147fcb4ff00a6544d4004d45145001fbca28a28025a2a2a28025a28ae7fe2178dac7e1bf83750f10ea3fbe8ac62ff0053ff003d65ff009651500797fed6dfb425b7c01f8692df5bfefbc4b7dfbad32d3ff6affdb2afcc5d3f52bef1268d16a77b7325dea175e6cb2cd37fcb5a97f6a4f891e20f8a9ad6a1e2ad6a58fcdff556d690ff00aab58bfe79545e08b3f27c396917fcf28abc8c4d4f687d460b0dec8f3ff1be83fba97cc97ff21579a4d67f63ff00595f45f88747f3bfd67faaaf2ff107856da1f362f2fceaca95435c4e18f3486f2587f75ff2cab5ad3cdfb2cbe5ff00d75ac9bbb396196a6b4bc9618bfe5a57a2785b1bf0f893c9ba8a58ebd034ff0018470dd452c92ffd35ff00c8b5e4b0d9ff00cbcc7fbe8ab43fd75af9524bfbd8bf7b58fb337a750f50d3fc6d1432cb1472ff00db6ff9e5fbdac9d43c492de6a92cb1fefa597fd5571f359dccdfbd8fcb862a9ad2ce5fb57951c7e77fd71ac7d99b7ef0b779af4b792c5147feb6596a1d274dbed4a5962b6f33f7bffa2aba5f0f7c37b9d4a5ff00498bc9fdef955f507c27f8336da3c514b2451f9b2fef7cea2a623d91b52c17b538af82ff0001ee7ed515f6ad6d1cde557bdfc42bc97c13f0e755beb68bc996d7f7b17fdfdaeebc33e1b8ace3fddc55cffc79d1e4bcf869adc51c7e74be57fa9af27da7b53e830f4a9525eccb7fb32fed99abebdacff64788e5b69b498bf75e74dfeb62afbae29bf75e6c75f8c9fb3acde4f8f350ff00590c51c5fbdf27f752d7ea5fc11f885ff0925aea1a1dccbe76a1a64bff007f62af730d50f9ecdb0d4a97b3a948f50a28a2bd13e74868a9aa1a0028a2a6a00868a9a8a0028a28a0028a28a003cea2a1ff0096d535001ff2daa5a8a8a0028a3fe5b514005435354340034e118ab7de1d68a28a00ab0ffd75a968a2800a28a2800a28a2800a2a2f3bc9a97cea0028a289a6a0028a21a2800a28ff005d52d004545152d004552d145001517fd32a2eef22b38bcd9258e18bfe7b4d5e3fe2cfdabbe1f7857ed71c7a9c9e22bbb5ff005b0e93179b41b53a556aff000cf609a68a18bcd925f2628abf3abf684fdaa25f8d9e37bbf0af873f73e0fd1ff7be77fcff004bff00c6ab6be3a7ed8d7df122d62f0ae8b63fd91a56a77514575379bfe972c5e6ff00aaaf983e1eff00a678f3558bcaf26597cdac6ad4fdd1db85c37ef7f7a627c52d0659ad74af2ffe3d3cdfded74be1387ced2ed6ba5f1978565bcf0bf9b1ff00cbacbe6cb0d73fe0d87ec7fbaff9e55f3ded3f767e818ca5ecaba34350d1ff00755caeb9e1b8bfe797ef6bd57ec7e7567ea3a3f9d589c2787ea1e158a697f791572977e03b6f365ff9635f404da0d559bc2b17fcf2adbda9c7530d4ea9f3a5d7c3db9b397fd1a5fdd79b56ecfc13abcd2c5fbaf36be85b4f0adb7fcf2ae9749f0adb43ff002ca3adbeb261f523e7fd3fe12ea7a95fff00a6cbe4c5e6d7a87837e06c5e77ef22f3bff6ad7b069fe1b8bfd6c95d8693a3c50c5fba8bc9ac6a624eca786a748e7fc27f0dedb4dba8a5922f3a5ff965ff004cabd6f43d07c9f2a8d0f47aec2d2ceb1362286cfc9ac4f1369bf6cb596293fd55761e4d656ad0ff00a04bff004ca2a067cc9fb32fc2bf27e2af8d7ed317fc4aa2ba8a2b69abe80b4bc97e15fc64d1357b28bcdd12fbcdb5bef2a5ff005514bfeaab3ff67bb3ff00895ff69c9feb6ea596ea5ae53e31de793e28d2bf7b2432c5179be75a7fd75ffd155e8e0aa7ef0f3736c1ff000e9d33eebd3ef2db58b086e6da5f3ad258bcd8a6ab75f27fc01f8f1ff08aebde20f08789fcc86d3edd2dd699343fbdf2a2ff009e55f4d693e2ad23588a2fb36a76d379bff4d6bdc3e36ccd6a28868a04145144340051451400514514005145140051351351fea68025a8aa5a8a800a28a2800a86a6a87cea0028a28a008a8a28a0028ff96d45140051451401154b51514012d14545e77ef68025fdeffcb4a28fde514004352d4552d0322a96b8af107c60f0d786ff0075f6efed1bbff9e3a7fef6bc53e217ed45756714b15bdcdb687179be57fcfd5d563ed4f429e5d88aa7d2dab6b163a0dafda751b98ed2d3fe7acd2d784fc48fda8adb478bcaf0e451cd2cbfeab50bbfdd45ff007ebfe5ad7cd5f163e2d5ce83af6a163712c9a8ea16b6bff1f7772f9bfbdae13e16d9dd78c3c5b36a7ab5cc9772dac5e6fefbfe5956552a54f667a3fd9b4e99db78cb5ef19f8dbfd3b5ed72e6ee2965ff0045866ff55ff7eab89d47ed3f6a965b697c997caf2a5f2bf75e6d7a8fc42f2b4d962b68ff00e5d62f2ab8e9b4df274bff00b655e454ab50fd272dca70deca9fb43c17c4337d8fc4715cff00aefb2cb14b5ab7737fc21ff1f6ee2ff5514b75e6c5ff006d7f7b517c42d37ec7acddc5ff004ca2a87e2f79bff09269fa9c7feb65d1ed6ebceffae517ff006aaf469eb48f93cc69f2e26a58fa0343f0dff695aea115ccb1c3692feebce9abcd66f0dcba0ea92db49ff2ca5ff5d5a10f8da5d4b4bd3fec52c90c52dac5fea6ba08741be9ac3edd73149ff5da6af22a53f667a0b11f5aa5ed0cfd26b57fb37ceacf86cfec72d741a7fefab90ccca9b478bfe79543fd835db5a59c534556bfb1ff00e79d6c2385fec1f27fe5956869fa3ffaaaeaa1d37c9a9a1b3fdeff00aaac4643a7d9c55d8693a3ff00aafdd567e9f0ff00d32aeaf4ff00f546831d4dbd3ecff755d05a4359f690feeab56186b63888ab94f1bde7eea2d22397c996fbf75ff6caba5d42f22d36d65b993fe59562e87a3ff6c5d7f6bc92c7f6b97fd5433507661bf897a868786747b6f0df85fcab68bc98bca8ad62af993c6fac4baf78b6eee63f37fd6f9517ff006aafa43e26ea5ff08af85eeffe58cb145e57fdb596be64d26cfcebf8bccff5517ef65ffb655ee61a97b231a953eb588d0eef49d4a59bc51fbcf2e6ff004eff005de557a043672c32cb6df6992d3f7be6c53435e69e13b3f3bc59a7c5ff004fd2cbe77fd728abd9a6b3f3bf7bff003cab1c4bfde9ee65d85c355a7fbda6741a7f8f3c55a6ea969e5cbe75a795ff003d7fe5ad74be1ef8fd6335d7d9b56b692d25ff003ff2cab8a87f7d15729f1a347fb67872eee638bf7be57daa2ffdab453c4d43e7b32ca6952fe11f5869fa958ea517fa35cc7355baf827c07f19b578658ac64b9fb5f9bfeaa69bfd6f9bff005d6bdc3c1bfb424b0e8369a9eadff1e92cbf65fdf7fad8a5ff00aeb5e8fb53e76a65b54fa1a8ae53c3df12343d7bfd5dcf932ffd36aeafce8e68bcc8ff007d5b1e754a55697f1028a28a0c428a2a5f2680229bf7d52d1450045351451400514514010d1451e75001454545001454552d00145145004535152d140115144dfeba8868025a28ae7fc59f10b43f04daf9baadf470ff00d31ff5b2d03a549d6d8e96b2b5cf12691e15b5fb4ead7d6da745ff004da5af04f1bfc7ed72f3f75a0c51d9e9f2ff00cb6f37fd2bff00b557954da3cbaf4b2dcdedcff68cbff3daee5ae4a9883e870d92d4abfc53e8bd43e3c5b5e79b17872dbed7ff004f777fba8abca7c4de36b9d7bed72eb5ae4977145ff2e9a7ff00aaaf3ff3ac6ce2fb3497d1c3145ff2ca1ad0d5bc49e1ef0df873fe59feeed65baf3a6ff9eb5c9ed2a553d6c4d2c36574bda1e2be32f8a9ae6bd7f776da74bfd91a27faaf26d3fd6cbff6d6a5f01f86eda6f16f852daf7fe3d2d62fed5beffd1b5ca7fc249a1de5fdac5e558c3fbdff00a6b5e83a878c3c3da3e8df117538fcbfb5c5145a7dafef7cdff5b2f95ffa2abd0f6479f4f32a7ecfda1e73e329a5f156b32eaf73ff00313965baff00b65ff2cabd6ff675d1fcefed097fe7acb1455e73a87c42b1865d3ec7f77e5476b145e4ddc5ff004cabe86f8170e9167e12b4be922fb279be6dd7ee65fdd56589a7fbb1acca9fb5548e53c59ff13ef144b147ff002d6eaa5f1969b2e9ba5cb14917fcb5ae6bc4de2a8a1f14795a4cbfbdff005bff003d6ba0d73e2158ff00c21b692dcfd9bfb43cdff9635e47b33f47a598fb299e35f17b41961d434abe922fdd5d45e54b5535cd1edaf3e12f83f57bd97ce96c65974aba8a1ff3ff003cabbbf167893fe130f046a114915cff00a0c5f6a8a6ff005b5e1fa7ea52f8abc2fe25d223f33fd57f6adac3ff005cbfd6d7af86a7fbb3e0b3ac6df13fba25f843af7fc4e6ef43ff005d2dacbfe8b0ff00cf5afa6e1d374cf0ad879bad4b26b9e20ffa07c32feea2ff00aeb5f1ff00866697c2bf11bc35abc72f93f6efdd4bff00a2abe85d5af2e61bf9743b697f7b2cb14b2ddffcb596b1c4d336cb6afeefd91d5dde8fe745e6795e4ffd31f37cdf2a8b4d36587fd5ff00aaa3499b4cd06fe2b6bdd4eda1bbbaff00974f37f7b5dd43a0f932ff00aafdd57875299e8d432b49b3ae96d34dfdd51a7e8fe4cb5d5e9fa6d232d4c4fec18aa2fec1fdf7b576bf63fdf7faaa8bec7ff4ca998fb43948747f26b5b4f86b57ec71d5bb4b3f265a03da12da435a1fea6a2861ae7fc65e248b4db5f2bcdad4c7f8a71ff133c492de7fa0db45fe89ff002d6aa783bc49a9e8f75f6992e7ced3ed62f365866ab769a3dcfdaa59745d723bb965ff00987cdfba965aa9e3cbcb6d07c2f37da6dbfb235b8a2fb54b69ff002caebfe79455e8e1a90b1d53d961ad4ce7fe297c5ab6f125fda68727fcbafef6ebfe7ac52cb58969a0ff0066e8de6db4bf6b8b5397ecb14dff003ca28bfd6d7cf5a4c3a9ebde2df37cdf26eeea5fdeff00d32af70f0478f229ad756d4f51fdce9f6b17f62e99fbdff5b2cbff00dabcdaf72a61cf93c1e26ae1b73d03e18c32de788e297cafdd7952dd7fe45af4b87f7d2cb589f0774dd32cff00b56593f7dfeaa28bf7bfeabcaad0bbf891a66837d776dfbbff005bfea618bcdaf9ec4d3f6950fd3f038da74f0c6ac356f56862d4bc392c72fefbca97ff0021567e9ff12343bcff0059e5c3ff005da2f2ab6f43f12687a979b147751ffa57eebfd6d65eccc71b89a75699f155dfda7c37af5ddb492fef6d65f2abd6bc330ffc249a5eaba47eeffe2796bfda16bff4caea2ff32d735fb455e691e03f16c5abdb797e55f45feba6fdefef6b3bc33f1e2dacf46d275392293cdd32fbfd77d962ff0096b5edd3a5ed3f787c97f6b5226bbd62fb4dfecfd4ecaeae619658bca97c997fe5ac55ee1f02fe306a7a9452db497d243776bff2dbfe7ac55e5ff10b58f0ad9eb3e25d33ca8e1fb2dd45a845fbd962fdd4b59ff09fe21786acfc656b1472db43f6afdd7fad96b3a94ff762c466386abb9f68693f16bc9bafb36ad6de4cdff3da1aeef4fd7ac752ff008f7b98fcdff9e35f3ceb9e24f0f4d169f2fda6387cd8bcafdccb45a4d637917fa16a7587d62a5236fecec362a97b5a47d2dff2c68af19d13c79ae68f245149731ddda7fcf19bf7b5e81e1ef1e58ebdfeb3fe25d2ff00cf19abae9d5f6a78788c154a4757451456c79c454514500150cd535434005145135001451450055a2a5a28022a96a2a28025a28a8a8009ab3fc43af58f86ec3edd7b2f9317fe8dacff001978f34cf04e972df6a327fd72861ff5b2d7c09f1fbf6a2d4f52bfd43ec52ffc4c22fdd45e4ffaab5ac7febd9e8e1f0ded3f7b57f867bafc48fda2b53d4b54feccd36fa3d0ed25ff00c0baf2af10f8dadb4797ca8e59357d425fdecb34d5e55f02f47ff84aaeb50d4f5ad4e5bbd42faea28bfe7acb2d7aac3e0fbebcbababe8f4c8ed22ffa086adfbaae4a87d0e53355aa7eebf7671f7779ae6bd7f17fac86d25ff9630feeab6e6d1f57ff00967e67fe055686b90e8767e54b7babdcf88a58bfd55a5a7eea2ad5d27ecda95af9bff08647e57fd31bafded647d49ca69fe15be87cdfb4f970ff00d76baad0f8c7e1bb9b3f045dfd9becd3795a64517ee65aeae6874386ea2f33c217de6ffd7d573ff1faf3c19ff08bea1e65b6ada74be6c517eea58a5aebc31f2f9fd4a7ece99f2ff84fc2ba9de78bb4f8becdff002f5156ddde83733780f5bb993cbb486fb588bf7d34bff3cbcdff00e3b5a1e039bc2b0ebd2dcfd875bbb862b5965f3a697fe995755a87fc23d0fc2ff0a7d9bc357d77f6ed4eea5ff4b97fed957b47cc2f67eccf2ff891a3dce9baf5df97e5de45feabce87f7b5eede0df0ddf43e08f2a3b693f756b1455e69ae43a1eb1e23d425d275c9343965baff008f4d43fd57fdfdafa02ef4dd22cfc2f77fdade2e8ffe597fc7a79b2d79f89f69eccebc2aa7531a79d784fc3773378caee2fec8fed79628bfd4c35abe26f0af9daa45fbdb6b48bfe78cd2fef6a2f06de58ff6f5dcba76a773a445ff002ca6f37f7b2d761e21d4b43b3d53fd2743b9d5f50f2bf7b37daa5fded795a9fa19ca787b4dd32cf4bbbb693578fcd9658bcdfdd79b157cd5a7de4be1bf1bf9ba745e74b15d7eea187fd57d965afa83c43e2a8b47d0750b9d3bc216d0cbff004f7fbdaf9a7c4df66f37edd652ff00614d7517d96fb4f9bfe797fd32af5b0c7c0e65fef21e3cd1f4cf01ebd2d8e9de5eb92f9b16ab16a1ff002cbcaffa655e9779e30ff846fc1bff0009549e64d777d17d974c866af24d5b58b6d4bc11fd99feab50d1e5f36d66ff009fa8bfe5ac55d0789af3ec7ff0aeb4cb9f2fca96c7cd8bfefed658832c354f6557da9b7f05ff00b4fc37e2dbbbed7bcc9aeefbf7b16a15f52f84fe24699af6a9fd912c5feabf75f6bffa6bff003cabcd750d36da6d074fd0f4efb37d92ea58bcdbbbbff9652d79ce93a6cba3f8f2d34c92fbcebbbaba96d6fa1865f362ff00aeb15785fbbf69eccfb8a9529e297ee8fb826f04df59ff00cb8c9e55685a69be4ffac8fc9ffaed5d07c11d7a5f1578222fdef9d2d8cbf65966ff00ae55e81e4dcffcb48abafea47cc6271b52954f6550f2ff00b1d4577675ec10d9c537facb68ff00efd54bfd8f6dff003e36dff7ea9fd48e3fed13c6a1d36b42d347966ff576d24bff006cabd821d1eda1ff00576d1c3ff6caadc30d6bf520fed13c7ef3c2ba9c36b2dcc914769145fbd9669abe64d43c6d2ebdaa4b73a75f7fa25acbfbaafac3e2f78da2d363fec8b2fdf5dcbfeb7fe9957e7cfc52f0acbf0af5e97c4be189649bfe7fb49bbff552d7254f674aa1f5b9561b1189a5f5a67bb787a6b1f1245ff13697f756bfbdfb5c3ffb57ff008ed79ffc74f155cde7d97c2bad5cf9d2cb2f9b6ba879bfeabfe7954be0df885a1f8abc072f88745b9f27cafdedf5a4bfeb6c7caaf9fed352b9d7bc45e55ef9935a6a775fea7fe797fd72af6f054ffe5e9f1d9b621e2313ec8f46b5d06e61b0b4b6d5ac64fed5d63fd16c6eed3fe5ac5ff2d6ad7c4dd362f0ddd69fe1ed3ae63d4744d0a2ff008fb87fd54b7f2ff9ff00c855d0784f58bef01e97e20f12fd9a3d73c35a67fc4ab47b4bb8bf7be6d71fae7d874d8b4f9749befb24b752c5757d69a87fcb2f36bb0e2a9ff4f0f60d0f41bed37c25a24524527dabecbfbdfdd5450f83efbed5f69922fb245ff3daeff755e8b369bff12bb4ff008aceda1b4ff9edfbdac5d42cfc2367179b73abea5abcbff3c618bcaaf0ea7b43ee72ea94fead4cc9ff0084565ff972b9b6bbff00a630cb469fe1bd5f4dba8a5fb0c9fba97cdadb86f3c2b791795fd917da445ff3f70cbe6d4bfd9be15fb57eefc5f7d0cbff005eb2d2fde1e85654ec7857ed61e15b9874bd3e5fb3490f957f2c5feaabcd3c33a0c579e0dd6edbfb4ec7cd8bca97fd6ffd35ff00edb5f45fed55a6e8f37826596f7c4b26a31457514bf6486297f7b5e29f0f752d32f2d750b18fc0ff00ba96c65fdf7daa5f37f755ec52fe11f99429d3f6a74df10b41fb678df4a964d4ec61fed8f0ec5ff2d7fe997ff6aaf29d0fc377367ace9f736d736334515d452f9de6d7b8788752d0e1bff869731f83259bed563f65fdf5d4bfbaf2a5af2fbb9ac7cdff00910bcaf2a5ff009fe96ba7a1ad4a7ed29ff0cfa5a1f0af9da0fef2fac61f2aebfe7aff00cf58ab3e5f0dea70fef6cbcbbbff00a6d692f9b5d8786752fed2f0979b6fe0cb1f2a5b58a5ff004b97cda8aefec3e57fc4c7c2b73692f95febb4996bc03ecb29ff0076fe19ca43ff0009559ffabfb75741a4f8f2fbfe3c75a8a49ad3fefd4b1554d3ff00b226ff0057a47883febb7daab561b3b6d621963b2b9935797fe81fa87eeaeffed9565a9ebd4a54cf5bf09fc66fec79a28f5197fb474497fd55dc3feb62ff00aeb5ecb69796da95ac5736d2c73452ff00aa9a1af8aaeb41b99b4bd42daca592196397fe3d26fdd4b15741fb32fed21e77fc53daf4be4dddafeebc9ff9ebff004d6bbe91f0d89c3afac7b3ff009787d7752d55b39a2bc87cc8e5f3a297fd54d52d6c788f4766145145020a86a69aa1a0028a28a00ab454b45001451450015e5ffb427c60b6f833e08fed7b996386eaeaebecb6be77fcf5af509bfe7aff00cb2afccafda97e365b7c48f16eaba9dcc5f6bf0fe99e6e95a15a4dff002d65ff0096b7541ad3fe219fa87c4ebef8e5e3cd2adae6fae61d2afaebca965ff96b751455e69e26d37fd165d4ef7ccd222babe965f266ff008fb97feb9455b7f01a6966f19787edb4e923d3a2ba8a5f2b519a2fdecb2f952d735e21bc8bfe11cd3ee7cc92eeefed52f9b7777ff6cab6a54fd91e8d4a952a7ef2a1ef5fb32eb17d0e8d17d8a5b6f0eda7dbbfedad74b77fd91f6a97edb737dabcbff4dabc57f67bbcb99aeb508bf7934be6c52d7bacdf0f7579b5ebbff468e18bcdff009eb5e6e27f887a590d5a74fda1cd6ade24f26d658acada3b48bff22d627866f259a2f37cd93fd6d7a06a1f0c7ce8bcdb9b9ffbf3156afc11d1ec61d1aeed6e658e1f2aea58bf7d15727b5a67d6fb4ab54cad2758d4fed5696d1dcc9feb62ff0096b5e75fb4a78f353bcb0b4b69258ffd2aea597fd557d4ba7fc3db6bcd522b98eda39bcaf365f3ad25af9ffe3a7c378a6d7b4ab6fb0f9dfe8dff002da5aecc37b3f687c667788abed29d23e74f0cebd7d0daf8825fb749ff001e3e557a06a1ac5f4361f0bf4cfb749feabed5ff007f65ad687e15db59f85f5bff008967ef649628bf732d775e2cf8576d0f8b7c2963f61b9ff89668517efbcdff00a652cb5e8fb4a67914e757f767cdff00dbd16a57ff00f131b18eee5965ff005dfeaa5afa43c4dac58d9f84a5fb36991c3fe95feba697cdff009655e2b69f0c7cef11e9f147732c3e6dd45fb9962ffa6b5ef5e26f87b2c3a34514973ff2d6597c986b931becceccbaa54a98ea679ffc3dd36fb5ebabbbe8eda4bbfdeffcb18abb0d735ed4f4d8ad2da396487cafdd793e57faaaeafe05d9d8e9b632c52799feb6bbbf197c3db1f125afdba3f326ff00a6b0d791ed0fbfb55a5fbc3e59f89ba95f5e782350f32e64ff005b5e3fa7de4ba9585ddb5ec51ea31456375e579dff002cbf755f55fc42f86317fc2bed57cb8ae66fff00755e49e0df86f1f89346d57ecd6d24377fd9975e54d0ff00d72af5b0d529fb33e171d52afd74e2be1be9b15e785e5b6b9d0e4fb5df45fbad4268bfe597fada35cf0de87f10ad6d2e7edd25a7f6645f65b5f3bfefed657c52d07e2359e97e1ab19648e1d3e5b1965f2ad3fcff00d32af40f865e039752f06c52dbc5f6bb497fd6f9347b3ff97a7054c453bd3389b4f157887c37acfd86f7cb9bed51795fbeff0055755e8da4e9b73a6cb16af25cc7e6cbff001e3e4c5fbaf2bfe7ad794ff694be1bd53fb0fc576d24da55d4bfba9a68bfd557adfc37d36e61bfb48b4ebe8fc45a57fcb2d26eff00d6d79fece9dfda9f57877f555fbb3ee5fd99747ff846fc07e57eee2f365f365af66f3a29abce7c07a3df68fe1cd3edae7fd6f95fbdaeae1f361af5a91f3189a9ed6afb43a087f7356fceae7e19a5ad086696838cd0f3ab3fc43ac7f63e8d777dff003ca2a96b9af8a5e6cdf0fb5b8adbfd6cb6b40e97f151e1fab432ea52dddf7da7ceb5965f36597fe5ac55e73e26f87b73e30b096c74ebafec88aebfe78fef6596adfc3df1b4b792c515effc7a4bfba966f2bcdffbfb5daf8dfc61a4783f41965b2b68e1962ff5569ff2d6eabc3f6550fd26b6754e8d258647c8bf163e09ea7f006d65f12f872fa49a2ff557d0ff00cfd554f06c3a478abc39a878bfc392c914b145e57d921ff9652cb5e8ba869babfc4eff0049f15ea71c3a7cbff2c6be7af885a6df7ecf7f1434ad73c176d2cba7cbe54b2da5dcbfbabaaf470f7a7fba3e5f30552ff59a87d17e27f0dd8ffc2bef0fdf7f69c90cb6b2f9b2e9f0ff00adff00a6b5e09e21f127f6c6b315ceb517fa5cb752cb2c30feea597febad5bf197c7ed5fc5516a1ae49e158e1bbba97cdf3bcdf2bca965ff00f755cfda69bae78abc472cb73fbe962fdd79d37fcb28abaf074ea53fe29e6e32a69ed4fb6e1d6348bcf0be8973269924de6c5ff3d6b3a6f15450c3fe85a65b5a4bff005caade87e09d5ef3e1f786bcbfb37fc7affcf5ab70fc2bb99bfe3e6e7c9ffa630c55e7d5f6773ea72dc47fb353312d3c61a9cd75e55ccbe745ff003c658aadcde2ab6f37f79a458cd5d85a7c2bb1862ff5573ff5dab3eefe12fef3f777de4ffd768ab1bd33d17883ce7f68ad622bcf873a84b6da65b432fd96297ceaf9abe1eebd7d3788e2ff004993cd962962ff005bff004cabecbf89bf0aff00b4be1f5dc5f69926ff004197f730c55e09f0b3c1fa669baa695f6db5b187f7b17fc7dffadaf5b0d529fb33f3caaaafd64caf167892faf3e1a7c3ab992fa4ff0045d4eea2f3bcdffa6b5e5fab4d2ff6f6a1179b27fad96beb0f10fc31d326f82d2c51d8db4dfd99e22ff9ebff004cab89f10f86f4cd37c51a87ef6c6d22965f37f73fbdff005b5d7ed0cfd9d5a94ce9be195e4b79e08b4ff96de6e995ab69797d6717eea5921ffb6b5eb7f05f4db1bcf06da797736dfeaa58bfd556d69f0e877914b6d25cc737fd758abc3ab50fa6c93dafb3a88f9ead352bebc9a5ff0049b99bfedad74b69ac79d1795a8c525dc5ff003dbfe5ac55e97a1d9e9167a85dc5e6c7ff006c62ac4f137827ed92cb73651470ddff00e8dac69d43e9ea54a94bf8a45a1eb1fda5a5ea115cff00c54569145ff5caee2fded7cdfae69b6d0fc41bbbeb2befb5da7dbfcafb5ffcb5b5ff00aebffc76bd96d34dd4f41fb5cb73149692d7cf5378aa5d4be235ddf5b4b1da6a12df79514dff002caebf7bff002d6bd7c31f0d98d5ff006efdd1f5dfc0bfda2a3d1ed74ad235eb9f3a6ba8bff22c5feb7caafaaad2f22bcb58ae6da5f3a2922f362afcd5fb1e99368de20d5ee6c7fb0f50d3358f2a2ff96b69fbdf37fd57fcf2afb3ff00665f184baf780e2d32f64f3b50b18a2ffb6b14bfe65a7ecfd998e27d9d45ed3fe5e1ec34514523c921a28a2800a28a28022a28a2800a28a2803c93f6a0f184be15f855a85b5b4be4ea1ac7fc4bed7fedaffadafce5f0f7856e7c61e3286e6cadbcef0d6992f956bff3ca5afa03f6e7f89d73378f22f0f69d2f9df61b5fb2f93ff4d65ff5bff90ab43c27a0e99e09f85517972fd93508ad7fd4cdff002d6596b92a55f647652c155abfc33e69b4ff00890fc50f0d5cc7ff0020ff00ed397caffb6b2d5bd5bc072f9bade997bfb9fb2ea7fbaffae55e81f123e1bc5a3f8234ad723fdccb17ef6ebfe9956878f3528af3c5b2dce9dfb98758d1e2d4229bfe7acbff00ef62ada9626f4cf42a60aafd63d9d32a7ecf7676de15f194ba65ccb1da7daad7fd4ffcb5afa5b56d7adaceea2963b1f3a2962fdef9d5f14f86758fec1f895a25f492cbe54b2ffae9abecbd42cfed9a0c52ff00cb58a5ae3c69ebe4b86a74b13fbd22f10f892e7fb2e5fb37970c5e57fcb18abce7e0bde4b7961a84b24be77fa74b5d06ad79e4e8d2f992feeab95f817ff201bbff00a6b752cbff00916bc83f50f654a9d3fdd1ed5a1cdff1f72ffd3acb5f2ffc74bc96f3c792c5fbdff45b58abe96d27cdfb06a12ffd328a2af927e2f5e79df1075bff00a652d7a3863e1b354beb2169e6ff00c225696dff003fda9f95fb9ffae5ff00db6bbbf1e6a52c3f11bc6b7df69ff8f1b5fb2c5ff90a2ae53c2767f6cd63e1fd8f95fbabad4fed5e4ffd32f362ff00e35536ada94b7961e30d4e4ff97ed4ff00f6acb2d7698597392fc3dd7afaf3c65a25b79be77ef7fe5b45e6d7b2fc48f125cff6345179be4feea5ff00535e2bf0861f3be20c5ff4ca2965af4af8b179e4d8795ff3cad6b8b1b50db29c353fae9a1f086cff00e243149ff3d6bd1bce961b097cb96486b8ff0086f0fd8f41b48bfe995761feba2af38fb438ff0010cd7d79e17d42292e64fdecb5f2cfc1cd4a587fb6ff007be54b158cb5f5b6a10f9da0ddff00d7d57c69e089bfb375ef12db7fd3297ff46d7a3863e431c97d74f75f13795ac7873c292dedac777ff127bafdf7faaff9eb595fb1febd6da94bade877b147e545e5795e4d74b770f9de07f05797ff002d74cbf8bff46d78d7c17d7bfe103f8b514b27fc7a5f7fa24b5d953f867cfd4c352e43d6fe297c37f0f78aa5d434cb9fb4ff00d32fdd57cd3a1de6aff04fc6f692c92dccd696375e6c537955f65fc4d87ec7e28b4be8e2fdd5d45e6d549bc07a478dac3fd2628ffebb5791ed3d91f7b4b0386ab4a9d43d83e0e7ed21e0cf891616915b6a76d69a84bfbafb24d2d7b5f93e757c29a87ecf7a668fe56a7a2fee6eed7fe78d7d77f0df5eb9d4bc25a54b7bff001f7e57952d7a386c4fb53e373bca69e069fb5a47610c3e4d5b86a1ff005dff002d6a686bd13e2c96b13c430fdb2c258bfe7ad6b4dfea6a1f27f7540cfcf0f8b1e1bd4fe1bf8b6eee6da2ff008955ccbfbdff00a65ff4d6b6bc27e0fb9d7b4b8b5cfb4db5df9bfeaa69bfe5957d37f17bc136daf584be6455e49f0de18bc37e1cb4d33ecd6de55b4b2ffae8bfe9ad79d88fdd1f5994d2fad5439a87c2ba9ffcfb4934bff4c6bca7e2c78565bcf16f86ac6f628ff75e6cb2c334b5f5843e24d3268aeffd07fefccb5f32fc7e9bed9f1574a8adbfd545a679b4b0d53f7876e6d82a9529fef0d5d5be18e99ac7c39d56fbcab19becb2d87efa1ffb7aae53509b4dd07c51a8456d6d1cdfeabfeb9576de77fc59bf15ff00d32fecb97ff46d79cead379de23965ff0096be545ffa2abd2f6a78f4f2ea763ec6f01ebd14df0d34497ec36dfeaa2ffd1556aeb5eb9ff9768e3b4ffae55cafc2d9bcef84ba57fdb2ff00dab5ab5f3b57f887da65386a5f572dc3a95cf9bff1f327fdfdad5875ebe87fe5ad73f0d5bf3ab13dca94a91a1e26d4afaf3c25e579bff3d62af83fc3b37d8f5097f7bfbd8a5afbaa6fdf6832ff00d3296be1ad46ce5d1fc6faddb49ff2caea5af5f0c7c662297b2c4d43dc2ee1fed2f097c45d33f77fba96d7508bfcff00db5af24f1643e4ea9692f95feb2d6d7ff4557adf87bfd32eb5bb6f37f75a9f852597fedac5ff00eeabcbfc590f9d61e1f964ff009f5f2bff0022d760aa7fcbc3e80fd97f528af34196293fe595f56df89e1b9d0754fb4c7feabcdfded79a7ecdfa9793fdab6de57fcb58a5af6bf194315e4b771578f89fe29e8e4953f7950e6749bc8af2ea5962ff0096b5d5e93ac7d8e2f2a48bcd8bfe78d79a78666f2754962aeeff00e9ad721f51569d2a8bf7a5bf1943633781f50b98e293fe5acbe4ff00cb5af83ffe103b9b3f11da4b1f997769f6af37ceff009e55f557c79f124ba0e8d6ba65b4be4cb2f95fea7fefed79af87b58b6bcb0d42faf62fb25dc56be579dff2ca5965fdd57d1e1aa7b2a67e4b8ec17b4c4fb5a4713a4ebd2d9fc25d422ff5d16a7e22b58a2866ff003ff4d6be90f839af5f780f59d1353bd8a4fb27fc785f7fd7297fd57fe45ae3e6f8576ba96a9f0eb48ff46862b18a5d6aea687fe9affaaf36bd6f5cb3b19ac350b1f3649bed56bff916954c4fef030f85ab89c354a87d3750d735f0b7c49ff0987c3ed1353f37ce9658bca97febac55d2d6c7ce84d5154b517faea0028a28a008a8a28a002a1bbbc8b4db596e6e3fd545179b2d4d5e3ffb5878f3fe103f80fe25b98e5f26eeea2fb2c5ff006d681adcfcff009b5897e277c789753b9fdf7daafa597fcffe42af6af8d179f63b0d2b48ff00ae52cbff006d6bc97f65fd07fb63c79777d27efad2c62f2bceff00c8b2d755f163529352f16dacbff3d6eabc2c4ff14fd3787f0ded554a87b5eb90db6bde03fb0ead17eebcaf2bce86be7fd43cdff857de14be925ff4bd0f539745ba9bfe997fad8abe80b4ff004cd07caffa655e350e9bf6c9bc61e1affa09d8fdaad7febead7ffb553c3543d3cd703eca9fb5a478ff008ca1fecdbaf2a4ff005b6b75febabed0f86fac7f6f784a2964ff0097ab1f37fedad7c69e3cff00899785f4abe8ff00e3ee58becb2ffd758bff00b557d21fb2d78922d63c1ba7ff00d3acbf65aebc47f08f97a3fbac4a343e214df63d1aee5aa9f05e1f27c1ba7ffd358bcdaabf1a2f3fb3741d42dbfe5aff00aaadaf01c3fd9be17d3e2ff9e56b1455e41faa2fe11e976937fc486eff00e9a4b157c7fe3c9a39bc5badcbfbdfdedf4bff00a36beb0fb6793e1c8bfe9acb2cb5f1fead37db2fe597fe7acb2d7a5823f37cc7fde6a1ddf80bf73e28b497f77ff123f0cdd6a1fbeff9ebe57ff6dae7e69bec7e08d3e2ff009faba965ad5d27fd0e2f88b7327ee7cad32d74ff00fd15ff00c6ab13c43fb9d2fc3f6de6ff00aab1f37fefecb5d828ff00cbc3abf8170f9de28d42e7caff00556be5574bf17a6f3aebecdff2d659628aaafeceba6f9d16ab73ff003d6ea28aa5f1e4dfda5e32d3edbfe7add579989fe29eb648bf7952a9e8be1987c9d2e2f2eba0866fded67e930f936b14545e4de4cb15721f525bd421f2741ffb7aaf83f50ff896f8deee5f37fe3ebed5157e806a10c5fd8369ff004d65965afcff00f134324d7515cffcf297cdaf470c7c063aa7fb49f45e9f379df0e7e1a4b1f97fbd8afe2af1fbbd1e5fedeb4fddfef7ed5157a0786758ff008b5ff0ebfe995f5d45ff009162ac4f1943fd9baccbe5fee7cabaaf44e4ff009767b86ad34baf7c3ed3ff00e82163fbaaa9e07d63ed917951d7417767ff0012596e6dab959ace5d36ea2d5eca2fdd4bfeb61af9d3ee32da9fecc7a04de6f952c5ff004cabd17e195e7fc5391799ff003d6bcaa1d62da6962fdeff00adaf55f86567ff001497ef3fe595d4b5d782fe21e467ff00ee47a2da4d5a10d73f6935741695ee9f95134d52cdfea6887fd7517740ce2bc650f9d612d7ce934d6df6a96293fd54b2d7bafc4dd4bfb3746bb96be7f8752b6b38bcd922f3bfebad79d8da9ff2ecfd1385f0dfc4aa6dcd7914317d9aca2ff5b2d7cf5f162f3ed9f15755f2ff00e5dad628abdd7c3d0c5a94bf6eff00bf55f3d789a6fb678dfc4b2f9bff002d6b9305fc43d7cdbf867a2da432ff00c2aaf1dffcf58ad74baf34d5bf737f14bff4ed6bff00a2abd2f43ff910fe25db7fd432c25ffd155e5fae7fadd13f75fba96c62af5cf9c5b543e9bf82379f6cf85517fd3297ff006ad74b5c57ecf7379df0f7558e4ff9652d76b5e1623f887d1e53fc20a9619aaad4b0cd589ee1a169fbed2f508bfeb94b5f1d7c52b3fb1fc4bd6fcbff009ebe6d7d95a4ff00aad422ff009eb6b5f27fc68b3ff8b8d77ff4d628abd1c31f17997fbc9d37c37d4a28759f054b27faa965974f97fcff00db5ae53c6f672d9e8369149feb6c6faead65ff00c855169379f63f0e6952ff00cb5b5d63cdff003ff7eabbaf8bda3f9dacf8c228fcbf2bed516a117fdb5fff007b5da67a98bf006f2587c51a845ff2ca5b5afa2b5cbc8a697fe9acb1455f32fc179bec7e3cd3e293fe5af9b157d21e26b3fb1fd92e63ff009f5af371bfc43ab29ff793cff43f37fe123bbffaeb5e95a1f9534b14b27faa8bf7b2d797e89fbed7aee5ff00a6b5ddeadac45e1bf06dddf492ff00fba8ab9291f4f9954f6548f04f8d1af7f6f78de58bcdff008f58bf7bff005d6aae87a6cbac7fc23fa47fcb5d4eebcd97feb97f9f36b94d3e1b9f15788ffe78dddf5d79b5e97e0d87fb4b54f106a565e65a79b17f62e99e77fcf597ff00b579b5ee1f114ff774cf45f0443fda5acf883c43ff002cafaebcab5ffaf58bf75157417737932c527fd35ab7369b6da3dae9f15b45e4da7d962f2ab27569bceb5af22a54fde9f6386a54beaa74dfb2febdfd9be23f15f856497fd55d7daa2afa2abe2ad0fc49ff00084fc73d2b53f37c98afad62f37fe9affcf5afb43fe58d7bb4ff00867e438ea5ecaa92d45451356a79a4545145004344d45140057c4bff00051ef1e79317853c2b1cbff2d7ed575ffb4bff006ad7db55f975fb666bd2f8dbf696bbb18ff7d15aff00a2c5ff00a2ab236a4775fb3868ff00d83f0d2ef53922fdedf7fcb6ff00aeb5c87c42bcff008aa34fff00aeb5eb50f95e1bf09695631c5e4ffa2f9b5e35e329bcef11da7fd75af0aa54f6b50fdaf24c3fb2c11f48787a6f3b4b8bfeb95792789bcdd1fc5135f4714934ba65d45a87ee7fe797fcb5ff00c855e97e139bceb08ab94d7218bfe13296da4ff8f4bab596d65ffb6b58d3fe21d78dff0076a8792f8df41fb1df7897488e2fdd7fc856c7fe9ac5ff00eea5ad0fd9135efb1eb3ade8724bff004f714352f886f3ced1bc29ae492f9d0d8f9ba2df4d0ffcb5f2bfd57fe42ae53e0bd9cbe0ff008fb158decbf64865f36d7ceff9eb5eeffcbb3f31c4d5b429d53ddbf68a87ed97f696d1ff00cbf4b17fe45af40d3fc37730d845fbdb6ff55ff3d6b89fda126d32197c1f247149772fdabcafdf7fd32acaff0085a917d962ff008967fe4d5791eccfb2a79b7b4c2d3f647a878cb4dd4f4df0bf9b1c71feeac6597f732d7ca9a7f83f539b54b48a4b693f7b2c5157a07c6ef8c16d0e83a85b7d864ff9656bfb996bc5749f891e4dd4b2c715cfeea2965af730d4bf747e6d5b36a957127ad4da3dcffc2b9d6efbf7717f6e788a28a2f3a5ff009651567f8df47b98759bbb68fcb9becb1456bfeb7fe7945595ab78dbec7a0fc34d0fec3feb3fe2612fef7fe7acbffc6abcff005cf89d2ea575772fd87f7d2cbe6ffadadbd907f6954f667d81f007c2b7367e128a593ecd0ffadbaff5b5cd5d69bff171b4ff00b4f973795e6cbe4c32d1e13f1e4ba0f80e2f2ec62fdd58c517efa5af3487c5573af78b6ee5ff0053145ff3c6bc8ab4ff00787d3e498da9f56a87d61a7c3a65e45e57ef2d3ff22d45ae786e59a2f36dae6da6ff00b6b5e29a1f89353d36ebf777d27fdb6ad5d43e275cf952c5258c737fd7196b2fab1ee53c76229a3d6fc59a6df59f836297caf3bfd16597f735f126a1e1bb9f2bf796d27ef7fe9957d01f123e2d4567e0897fd1a487fe259145feb6bc17c3df10ac752bfb4b6fb4df432cb2c55e8e1b0c7c0d5ccaa7d66a1abe19fb4ff65e95a679527fa2ebb7517faaff00ae55b7e3287ed9acea1ff3d62ba97ff46d733378dada1d525b98f5393caff849bff46d757a4f8db4cf156a977149731ddfef65ff00a652d75fb235fed23dd74f9bc9d06ee293fe997faeaf2ff1378abfe273a7f87a397ec9f6aff55ff4d6bdc66b3d221b097f7b730ffaaffdab5c278dfe09f86be215845f69be921bb8bf7b14d1455f315691f7594e370d5704794f8875eb9b3f14695a669363a95a45ff002f5f6b96297cdafb2fe0bcdf6cf06ddc527fcb2baaf9ff00c33f0c6c7c2b14bf68d5ee75197fe7b4d179b5eebf05ef2dbcad56da39649bfd54bfbe8ab5c0d3f6750e3ccbd9fd4bd9fb43bb87f732d741a7ff00aa35cfcdff001f55d069ff00ea8d7d11f9a9a10ffa9aa97737eeaadcdfb98ab2b509bc98a81efa1e13f1d35e966bab4d323fdf7fcb596bc174386fbc55e2c96c6e65f274f8bfe58c32fef6bd57c4d79fdb1e2dbb97fe9af955cfda783edb4df16e95abdb7fadfb2dd4575ff7f7f75ffb56be7b13fbda87ed594ffb0e0a9d33a586ced6cec3cab6ff00965feaabe5af10fee7c6fad7fdb2ff00d155f4dc30f932cb17fcb2f37f755f3d6b9a0cb378cb5596496da18bf75e579dff005cab5c17f10f273eaaa97b3f6877fe07ff004c8bc4b6dff3fde19f37fefd5797eb734b3586892ffd3acb17fe45af66f86fa3c536a9a7c5f6e8ff00d2b42bfb5ff552ff00d35af34d73fb32cfc25a7cbfbcd4658aea58bfe7945ff2cabd7f667c9d4c761bf787aafecd7379da36b717f9ff00555e970c3e74bfbbaf34fd97fc556dfda9a858f9563feaa2fdcffdfdaf4bd43e215b69bff2fd6d0ffd31b4af37134ff787ad94e6bfbba85b8741be9bfe5da4a961f0ddcffcf58e1ffb6b5c55dfc5ab1f365fdddccd5930fc5a97cdfddd8c7ff7f6b2f667aff5eaa7ade93a0df7dbff00d57fad8a58abe74f8fde0f97fe123d3ee64b9b687cdb5f2bfd6d7a343f16bec77569fe8327fad8bfe5ad78a7ed15e3cb9fb2da797631ff00a2dd4b17fadaebc353fde1f239de36a7b4a667ff0060db7fc21ba87fc4cadbfd16ea297fd57fd75af55f1bc3a65e78a34aff00899ffc863428bfe597fd32af96b43f885a9de697e20b6fb35b43fe8be6ff00e45aec35cf891abfd83e14ea7e6c70feebecb2feebfe794b5ebfd5cf23fb4b11fbb3abf0f69ba668faf69f7dfda7feaaea297fd557d55ae59db5e69717977d1ffcb5ff005d5f9dfa878db5cfed496dbed3feaa5f2bfd557d41e21f89da9e9b63145e54737eeabcec6d23b329c7627eb274de1fd07ceba965fb75b7fadff9eb5ca7c79d625d1f41b4d0fcdfdedd4bff002c7fe79573fa1fc4e96cff00d658c737fdb5ae53e276bd2ebdacda5f476d243e6c5e545ff5d6b8f0d4ff00787d6e371553154fd9957c3d34ba6e8daaeaff00bb9a58bfe25f6bff005d65ff005bff0090abb09b52ff00843eff00c15e1e93fd6d8dd45757dff5d65ffed559fe19d365ff0084a34ad32f658ffb1343fdedf4dff4d7fe797fdfdf2a2ae3f5cbcb9d4bc47a85cdccbff130fb54b2cb5d879d5363ebad72f3ced1ad3fe7ac52cb1573ff00ea6d658a8d0f52fedef095a5f7fcf5f2bff455450fefbcdaf08fb3ca7fdc8e13e2c4dfd9b6be14d5ff00e7d6ea5b4afb43e13ebdff000927c3ed12e7cdf3a58a2fb2cbff006cabe3af8a567f6cf873a84bff003e32c52d7b07ec73e30fb6787350d0e497f7b17fa545ff00a2bff6957b987fe19f9de754ff007b50fa428a8aa5aec3e488a8a28a00a947fcb1a968a00aba86a5169b6177732fee628e2f36bf27fc277917c48fda0b55beb9f32687ed5ffa36bf483f694d7bfe115f823e30beff00532fd87ecb17fdb5fdd57e5ffecd779730f88b50d5e3964865fb579b58d5378ee8fb03c65a0c534b2ff675cc734517eea286be79f1643259ebd69e645fbdf36bd026f89173fd972fdb6da39bfe9b435e75a878aa2d7b548adbcdf3bf7bff002dbfe595787eccfd930b8df654952a87d01e08bcff00458ab94f8f3ff127d07edd1ffadba97f755d36870cb6761179917935ca7ed4137d8fc25a7ffd328a2ffc8b5952fe2866b89f6786d0e3fc11796d37823c61a6496de75df9516ab6be77fd32ff005bff0090abc7fc6fe3cfb1f8f3c29e25b297ce97f75e6ffd758bfcc55ddf867cab3d2ed35c93fd54575169f2c3ff003d6297f752d78a78f34796ced750b1ff0096ba3df79bff006cbfd57ff1aafa6e87e5589a757da1f4af8df58d4fc6da8787e2925f3bcabaf362861ffae55d5e93e03d5ef2eb4f8becdff2d7fe7ad79d7866cedb5ebaf07ffc4f2dad3ccb1fdef9dff2cabdab4ff0ad8d9cbe6c9e38b1fdd7fcf1fded701eee55fbbc0bf687857c74d06fbfe25f1795e74b2cb2dd4bfbdaf3ab4f0adf43a0ea173fbb87cd962b58bf7bff006d6bb5f8b10f87af3c5be549e2593f756b145ff1eb52f84fc37e11d4affc15a649ae5ccdf6ebef365ff45ffa6bff00daabd6a5fc23e4e1ecee6878f3c2b7367f11aeeda3b9b6f2b42d1fca8bf7bff4cbff00b6d797e87e0fb9d4b5ed3ec6496dbf7b2c517fadaf46f167fc21979acf8eefbfb5efbf7b75f65ff55ff4d7ff00b5564fc27d1fc21378f2d3cc9752bb8ada2f37f731569d02a7b3f667d01ab683e4f84a28bfb4ec7f7b2ffa9f36bcebc1bfd9967aa5dfda7ccbb97cdff974af50f1e5e780a1d2e2b6fb36b7fbab5ff9eb15729f0f75ebed36297fb27c356d3452ff00cfdc5e6cb5f3f5373ef72eff0076a7ece99d05a59f87b52fdd477373a74bff004f7feaaaaeade09befdefd9a5b6bb8bfe98cb5d5ff00c261a65e7eeb5ef06793ff004dad3f752d675de9be02d4a5fddeb97da74bff003c6eed68d4f45d4a7ff2f299c2fc68f0aeaf67e0dbafdd47ff002eb17fadaf14f04786efa1f11e95fe8327fc7d452fee6bdc3e3f68fe15874b96da3f17f93e6df7fcb6b596bcebe1ef85628759f374ef19d8cd2c514b2fefa5f2bfe5957b94bf867e6d2f675712ce5350b3f27e1cdd6a7fea7fe2a28bfe597fd32ae7f43d4bec7ac4bff4ca5af70d73c1fe2f87e06695fbab6bc8aeb5d965f3a1f2bfe7957957d8fc4ba6f8b755b69348f3bfd2a5fdcfd97cdad3fe5e18fb3a5eccfa56efc61a9c36114bf6e926f37caff5dff5caa2d27e216af0dafef2e7ff00215687d8f4cbcf01e95737bf69d22eff0075e6c3e57fd32ae66d21f0f59cbfbcd5e4ff00bf55e255fe21f7194e1d7d58dbd43c79abcdfbaf363ffbf55e81fb3af8ab539be25fd86e6e7ce8aeac6bcebc9f0d5e7fcc4ee7fefd57a2fc118748b3f8aba54b657d24d2cb14b17faaff00a65452dcebc6e1ff00d9aa1f42cd37fa7d761a7ffaa8ab8ad5bf73aa455dae93fea62af44fcecb775feaeb9ad5bfe3da5ffae55d2ea137eeab94d5a6ff00895ddffd72a06b73e7ab4d62c66d53f79f61865f37fe5b56ac5fd99fda9a86a7fe8d77e6c5fea61ff9655f3aea134bf6a965f2aad5a5e4b3452f99ff003cabc8f667e934aa55a68fa1aef58d321fb24bf61b6ffbfb5f17fc4df8852d9fc41d43ecd179de6f95febabd2ad3fe58d78af8df41b99bc5b2cbfbbb48becb17efa697caaebc153fde9f319dfb5abecee7a57c2df891a9ff00c25be0afdd47fbdfb55ad797f89bc49a9ea5e12962b9b9ff0055a9ff00ed2ffed55d5fc3dd36dacf5ef025cc9abdb43e56a72ffa9ffb65595e32d3748d1ffe130b1fb4cb772daea7feaa18bcaff96b2d7b1fbb3c2fab9a1fb385e793e3297fe9ac55ecba843e4ea92c5fbcff005b5e49f01af2fbfe132d3fecde1aff004497cd8bfe3d7fe9957d4dab68fe2fbcd52eff00b3b488ece297f7be7795e57fe8daf3711fc43d7c9153f6953f7879cda786f57bcfde476325687fc2137dff002d3cb862ff00a6d2d6dcde09b987fe43de2fb1b4ff00a630cbe6cb514de1bf064317fa4f896e6eff00eb8dad729f67fba33e6f07dccdfeaeeadbfefed713f1fbc132cda0ea12c97d630f952c52ff00adff003ff3d6bd1bec7e029a2ff90bea5ff7eab3fe2c68fe029bc1377fe9da95dffa0c52ff00aaff009e55ad2f687cc675ecfd9d3fdd9f2ff84fc3717f6a4b17f6bd8fef6d658bff00215741ae6836d37c20f0a5f7f6bdb7fa0eb17517fdfdfded54f09de780a1f1269fe65b6b7379b2f95feb62aec21bcf014df0475bb6fec8d4a6fb0eb117fcb5ff009eb157b47cefb4a7ecff00867090e83a64df12e2f2f578a5f3753ff9e5ff004d6bdefc79e1bfdecbf66beb1ffbfb5e3ffdbde07ff858da24b1e877d0f9b2dacbe77dabfeb957adf8c6f3c05a94bff1f3a95a4bff004dabcbc41f4f947b3f6952a7b239487c13abf9514b1c51cdff005c65a2ef52ff0084575e8a4d4658ed25b1b5f36d6d2eff00e5acbff2cab6ed3c2be15bcff906f8cfec92ff00d3dc55e73f163418b52f88de1af0f5eea71eafa7ff00c7dcb35a4bff002cbcdac696e7a5997b3fab7ee8f46d5acfec7f0aa2d5e3fdcea12ea714b7de4ffaaff55e6c55e7fe37ff0043f11ea12ffcf597cd8bfedad7a2f867c377dac7c2ff0088b63245e4c3637d6b75179bfbaff96be5571fe37b3b187fb3ee6e6e7ed92cb6317ee61ffbf55aff00cbc3c7fad53c361bd9d43e80f85b0cb79f0834ff002e2f3bca8a2ff535a1a7e8ff00babbfb4dd470d73fe03f8856d67f083ecdf69f27fd17fd4c3ff5d6b8ad3fe245cc3e6fd9a28e18bfe9b57935699eee539954ab86fdd1e8be21d1f4cbcf06f882dbcd926f36d7fe79571ffb2ff8922d07c65e1fb9fb77fa24b2fd965f3bfe9ac5ff00c762acfd3fc49a9de4b776df69fdd4b17fa9af0ff06f8aafb4db5d562f37f7b6b2f9b17fdb296297ff008ed7ad86a7fba3e5f36a953eb27eb8554b487c98bca8eb17e1ef8aa2f1b782344d723ff97eb58a5ffb6b5d056c7ce8514c79be63450057a28a26ff0053401f2fff00c1423c492e9bf0462d32da5fdedf5d7fe428a2ff00f755f1a7ece1a3c5ff0008bea12dedf7f674b5ecdff053af154536a9a2687e6ffc7adaf9bff7f7ff00dd5797feceba9691a6fc34bb8b5ad23fb47cdba8a2fb5c32f952d62ff867a585fe2d33b5f10f8565fec6965b6963d462ff009ed0d7825dcd2e9be238a5f2bc9fdeff00cb5afa5b56d1f43d6346965f0e6af269d2ff00adf275097caffc8b5e13e3cd3757d36ea28b56b6f3a2f37f75775e7ea7e93529d3a948fa9be10f8c2db5eb5d3f4dfb4fef65f2bfd12eeb89fdaeef2c752f0e7951ff00a24b7375fbaff9e5e5455c57c2dbcf27cdfb4fee7ecb14be579d5c27c7ef186a7f6f8ac7cdf3a28ad7fd4cd5ad3c31f0f9ae2aad2a9ec8f40f865a3db78dac3c29e15b9ff557dfbdbaff003ff5ca2af3af8c7a6ea7af4d16af6d631da6957d14b6b7537fcb2f362fdd4b5d07c32f1b793f0fb55f12db79736a163a6456b1793feb62f37f75595e2c862f12784aefc3d1ea7e77956bfdab143e6feebcdff96b17fdfaf2abd130a989facff0cb5f0caf3c3d79a0f8522b98ae66bb8ad65fb54dff006d6bdae6bcf0f59d879b1db5cffaafdd79d2d7cd5f01a69758b0b4b6b6b6926fb2f9bfea62ff00a6b5f406a1a0ea7fd97e6fd86e7fd54bff002cabcea9fc53d7c1d4f6581aa7cffe3cd7b4cbcf1beab2ff00667fcb5f2bfd6ffd32aeebe196a5630fc46f07c5fd911f956b63e6cbfbdffa652cb5e55ae683a9de78a350fdd7fcbd57b07837c1fa9d9ebde25b9f2a387fb3342962ff005bfeabf751455ebfeecf92a788a879d5df8922ff00844fcdfec8b6ff004abe965ff3ff007f6bb5fd9ef5297fb5355be8ec6dbfe5945feaab8fd5bc1f7d0e83a24524b6dfeaa597fd6ffd35af65fd9afe18cb358457325cc70f9b75ff003cab2a9ecfd984f1153da9d07c4df1e5ccd75771476d63e57faaf3bcaac0f0f6b17d0c514b1dcdcc3ff5ca5adaf19780e586fbfd22fbcef37f7bfb98aba0f0f7c31b69ac3cdf36e6bc7f6b4cfd268d4abec8a9a7f8f35387f75f69fb5ffd319aadff00c249a65e5fc5e6787adbfd6ffcb1fdd5687fc2abff0055f66beffbfd1554d3fe1beaf0ebda7c5fbb9a2f37fe58cb4ff762ad88a9ec8f2afda2b58d23ed517fc4b24fdedd4b2ffadaf3ff0006de687345aacb25b5cc3fe832fefabb0fda13c37abfdbf4ff00f46fdecbe6ff00cb5ae13c33e1bd5ecf46d6e5fb0c9ff1eb145fb9ff00aeb5ee52f67eccfcde188fdeb3d2f5cb38bfe157fc3ab6d3b5c92d3ed375752f9337eebfe5ac55e55ae4dae59f8cb5092dbc43ff002f52fefbed5ff4d6bd03c4d672d9dafc2fb1922f27fd07cdff00bfb2d78a6b90f9d752cb5a07b5a7ecff00867e80687af5f7fc2b4b48bc47a1db788bca8ad7ca9ab8fd4358f0af95e6c7e108fcdf2bfe7eab2be1bebd7367e0d962b696487fd162a962f1e6a7e57951dcff00e428abc4a9b9f6992ba7570c4569e3cf0f69b2ff00c8991ffe054b5ea1f047c79a3ea5f12f44b6b2f0adb5a4b2cb2ffa5ffadf2bf755e5377af6a734bfeb63ff00bf55db7c17d63539be2d786bccb9fdd4b75ff3ca8a47ab89f67ecaa1f55789a1f26fe2aec749ff008f68ab99f1643fe9514b5d2e87feaa2af44fcd8350ff00542b9abbfdf697a87fd7296ba5d5bfd4cb5cd7faed2f5097fe994b40e3ba3e34866b9fdd4b6de158e68bfe9b5af9b534dac5cffcb4f087fe4acb155afed2f155e4b2f97e218ed25f2bfd4f9be554d0de78ce1f37cbd5fceffb6b15793fbb3f518fd62c8cfb4bc96f2ead22b6f0ac7e6ffd72af09f891e1bd32cfc51e6f89f5c921bbfb2c5fe8969fbd96bdee6d4bc5f35ff9573ae470c5ff005d6be74f89b79a669baf5a7976df6b97ecbfeba5aeac17f10f99cfbda7eefda1b7e19d4bc05a3d86897df66d5aefecda9ffcb697caff009e55d2fc42f1258e9be3cf1ddb68be15b6f365fdec535dfef7fe5ac55e5f6be2a97fe112bbfb35b58da7d96ea297fd5576df14bc49a9ea5e3cd42e65b993fd3b478a5ff9e5e6ff00a2d7ae7ccfeeccaf01f8abc5f0f8b744964d5fec717daa2fdcf9be557d3fe32fed3bc9629756f1579317d97fd4f9be6d7c1fa7de7937f15cf9bfeaa5f36bebbd726f3ac34a97fe997955c989a67a194d4a5f592dc3ff0008d59ffcb5bed465ff00bf552ffc249a443feaf438ff00edb4b5cfd9e8f7d37fc7b58dccdff5c62ad587c13ae795ff001ede4ffdb5af3bf767dcfd609bfe124b1ff969a1d8d5af10f892daf3c1bfbbd1f4dff8f5962ff555561f87babc3ff2cadbfefed6d5a7c37d4ffe11c8a2f36dbfe3ebfe7ad3a5eccf0f3aa953eac7c7fa7f8dae61d52d258edadbcd8a5f37fd557a5da78aae66f09fc50b18edadbf752dadd7faaffa6b5c25dfc31beb3d52ee2fb4db7eea5f2abd4343f86f73fda1f102dbedd1ff00a5685f6aff00d152d7b9fbb3e31622a7b33cd66f125cde6bde14fdd5b795e55aff00cb2ffa6be557aaf8cb5eb69a5fdee876dff6cbf755e7fa7f80ee66d53c15fe931cde6feebff22d7a878b3e1beafe6c5e5f9737fdb5af3b13eccfb2ca31152d50c48752f0f4d143e669925a7fd7196b3fc4de24d33c2bace9f2d94be4f9b17faebbff005b46a1e15d5f4dff00596324d17fd31fded797fc5e87c9d674ff00322ff975ac30d4ff00783cd6a7fb39ee1a7fc48b69b54f8a1636de65dfdab4c965fdf7fd75af0ff1978c353d7b41f0ff00992f9317952c5fb9ff00aeb5d87c32d1efb58f88daac5f669218afb4297f7d37eebfe5d6b8ad434db1b3f06e9f2c97df6b962ba962f26d3fed957af4fd99f23f57a9fbcb9ecbf09fcdbcf873e547fbeff45ba8ab5bc3da0cb796be6c9736d69ff5da5ab5f0474df10ea5f0e628bca8f43d2bfd2bfd77eeaa6f09d9f856cec3fe263737d7777ff4e9feaabc3abfc43ea387fd9fb3a86d6870e910ea9e5497324d2f952ffa98bfe99578569f67a67fc279add8fda64f2a5be962ff0055ff003d7cd8bff6ad7d17e19d7ac61d5228adbc2be6ff00d3696bc13c43af45a6fc4bd6e593c351c3fbd8aebc9ffb6b14b5d78331cebfde29feecfb43f623f1545ac7c2abbd23ed3e74ba65d7fe4297f7bffc76be8b9abe24fd913c61a6786fe376abe1a8ec64d3bfb4ed658bfd6feea596297ff8d57db75b1f3153f8843e4d152375a28312b5151545a85e45a6d85ddf5cff00aab58bcd96819f93dfb7978925f127c6ed562ff96515d7d962ff00b65fbaa3e05ebd7da6fc3e8a28fcbf2a5baff533455c57c63d63fe124f197dba497f7b732cb752ff00db5af50f84fe0f96f3c2569147731c3e54bff3cbfeb957254a9fbb3dbc0fb4a78d3bbd4352b1d6341f36f6da38658a5ff5d695e29e219aeacfcdfeced4fed769ff003e9357b87887c1f7da6f8725f33f7dff005c6be7af1643fbd97ccfdccb5c87dffb4fddfef0f60f865a9450f85ffe26363e74575e54514b5e3ff122cedbc55e23d565b2bef3a2f37ca8bceae97e1678f353f0de9777f66f2eee28bf7b2da4dfbd8a5ac4d3ef3c21e2afdd5ec573a1ddcbff002da1fdec55eb60cfcef36a9fed3fbc2afc1cb3fec7d2fc61a66a31490f9ba67daa2ffb652d797ea1e24b9f0af8a3ca925926f2aebcd8a6ff009eb157d2169f0af5cb3f11eab2e8b736de22d3ec74297cdf265f37fe595784fc48d065d62c344befb0ff00675dc5e6c52c3ff5cab6f6871d4a7ff3e8f66fd956cec61d675597ed3e4da79be6c5e4c5ff002cabeb0f10ff00647f60cbfbdb99bf752d7c73fb24cde75aea1e67efbca97caafa9b50ff00902cdff5ca5af9ec454fde9fa4e5d96d3ab96fb5aa7cb3a8de6990f8df508bcab99bfd2abd6f4ff1269967a5fc50b98ec64ff9656b17ef7fe9ad787ea1fbef8972ff00d7f577735e7fc5bdf1acbfea7ed5aec514bff916bd53e3a9e0a972153c59af45e6c5147a65b7fa2d8c5feb7feb957d21fb3debdf63f0969f2fd86c61fdd4b2ff00aaaf92bc59ff00231ea117fcf2fdd57d4bf073f73e03b4ff00a65631572626a7eeceaa382a5571becc3c6fe2ab99b54ff468eda1f2bfe78c55b7e19f156a70d845fe935e7fae5e79dacf9b5d8687ff0020f8abc83f55a585a563bab4f185ccdfeb22b69bfebb455a1a1eb16336bd69249a67fcf597f732d71f695ada1cdfe952cbff004eb2d3a750e3c6e1b0df56a878cfed15ac691fdbda545f66b9ff00552cbfeb6b9af0f4da44de12d6ff007b730fef62a97f68aff91b74f8bfe7958ffed596b95d0ef3c9f06ea1ff005fd145ff0090a5af729ff0cfcc69e070ded0f75f1669b633788fc096d1df47fe8be1d8bf7337fd7296bc2aefe1bdb6a514be5d8db4dff5e92d7aaf8f3fe4a0f87e2ff9e5e1d8bff4965af1a87fe99cb5ad3a865572aa7eccfa6fc11f0c6c7fe10dbbff0046b9b4f2e28a2ac497e1bc5feb63be93fefd576be13d62fb4dd2eefcbba93f7b15ad5b87c55a9cd6b17ef63ffbf55e4d5a87d3e5396d4fab6879ff00fc2bd8bc9ff909c9ff007eabaaf84fe098b4df88da25cfdba49a58ae6b5a6f155f7fcf58ff00efd56d784fc497d378a34af3248ffe3ebfe79514aa1e86272ea9ecaa9ee1e26fdf7955b7a1ff00a9ae7f56fdf5d451574ba4ff00abaf70fcad9575c9bf752d73ff00f32e6a12ff00d3296b43c4ff00eaeaa7fccaf77ff5ca5ad471dd1f9ff343f6c97f7952c3fb98a5f2e5ff005b5ea169e038a68bf77636de6f95ff002dab6ed3e1bc7ff2d34cb69abc3f687e92af63c53c98fedfe6d7957c42f0aea736a9a54b1d8c9ff1ebff002dabebb87e1edb43aa45fe8d6d0fef7fe5b579a7c689b48d36eb44ff0059772f952ffd32adb0d53f7a7cbe774ead5f67eccf0fd0fc077d79e1cd6fcd96387caf2a5ffc8b5ea1e26f86f6d79e2df054b25cc93457de1db58bf7317fd758aaa787bc4914da5f8822b6d323ff008f1ffdab15777e2cf155ccda37c2abef36387f75e57ee62ffa6b5e8d4aa79d4f2da9fbb3c3f49f86f6d0ff00cc3249bfebb57db7e1ef07db7fc21ba55cfd86dad3fd54be74dff5cabe34d72f25b3d52efed32c9fba965ff96b5f507c2dd7adb58f873a7db79bfe9717eeab931353f767a382cbbd9624ec26874cb3ff00597d24dff5c62a8a6bcd23fe7dae66ff00aed2d64f9d14dff2d63a8abc3f687e934b2da66dff006c58ff00d033ff0022d6843ac5b7f635df95a647fba962ff005d2d729356ae9ffbeb0d422ffa6514bff916b5a550e4cc70387fab543e65f1e6bd143e32d562feccb1ff008fa97fe595775e03f157db3c51ff001e36dfe95e19962ff55ff4cbff00b5579ffc5eb3f27c79aacbff005ca5ff00c855b7f0ca6966f16f853fd67ef74cba8bff0046d7b9ed4f86a786a5ecedecccff000cebdfda5af782a2fb0db43fe952ff00a98bfe9ad7b86b9ac58cd2fef348ff00c8b5f3d780ff00e463f0a799fb9f2a5ba96bdef50b38bcafb4dc5cc70c5feb6bc9c6d43ecf29c361bd995350bcd226962ff8f9b4ff00c8b5e13fb42785753d63c51a249a0f97a8ff00a2fef66ff55e57ef6bd9aeecf4dbcf2a58ee7cef37fed9578a7ed29676d676ba27fa74969145e6f9bff4d68c0d4fde0f3ecb69d2c154ab4cd0f865a0d8d9fc55f07dcebde258e1965b1f2a5b487fd2a5ff00552c55e5fa86a5a643a37d9bc39a64934bf6f97fe261775a1f0cb58d32cfe25f813cbb6926fdd7fcb6ff00b6b5ca78875eb9bcd0750b6fddc3145a9cbfb98abe98fcba7ecfda54f687adfc2dd4a2ff008473fe26dabc97777f6aff00530fef6ba0f06ebdf63d2fca8ec6dbfebb4d5e29f09ef2e7ecba8451c524de54b14b5ee1e0df04ea779a3457324b1c51579389fe21eee4153f89ec8dbd275ed4ff00b7ad3cbbaf262f36bc53e26de5cc3f11a6ff004993fd2ad6be8bd0fc076df6fb4fdec937ef7fe58d78ff00c6ef07c567f12f4afdd5cffaa8bff46d3c354a6659f54abed290693f10ae7c2bf1a7c29e21925fdd45a9dacb2ffd729628bcdffdab5fa97e779d157e4a78dfc37e4e97a7dcc7e6432c76b6b2ff00dfaf362ffda55fa8bf0df52fedef87de1abeff009fab1b597ff2157a150f9daa74145145646255ff00ae75e73fb486bdff0008dfc11f15df7fcb596d7ecb17fdb5fdd57a357cf3fb6e5e793f0822b6ff009fad4e28ab2a875e1ff887e67f8b3fd33c5b2c5ff3ca28a2afa03e00f8aa5b3d07cafddcd17daa5ff5dff5d6be7fff005de2dbbb9ffa7aff00edbffb4abd6fe00cdff14bf95ff3ca5ae3c47f08fadca69fb5c6d3f6a7d5735e58eb1612c5245f63ff00a6d0d787fc42f07db6a52cbfeaeeff00eb8ffadaf55d3ff7d612ff00d72af34f167ee65af23da9fa2d3c0d2aa782eada0cba3c7a87d9fccff555cf780fc4916a5aa695637b6d1ddc52cb145ff4d6bd6f5087cefed08ae7fd5795febabc5743d065b3d7bcdb297f7b179bfb9ffb655eee0aa1f9ae7f86faae24f6ad0ef2287c2ff103c43a2ea7269d2dd4b15ac5e77fd3597fe7ad792fc58f885a9c31689a46ad2c777e545e6f9dff005d6ba09af2e74df837696d731490cb7da9f9bff7ea2af3ff00899a3c779accb17fcfac517fe8aaf42a1f31ed3dad33dabf65ab38a1b0d57cb97ce8bed55f485dcde76972ff00d7acbffa2abe65fd927cdff845eefccff9faafa4269a5fb2cb17fd3296be6711fc53f5ecba9ffc261f24ea1ff252ff00edfabb09a6961f84be20fdeffcc762ff00d152d7157537fc5cbf37fe9fa2aedb51ff009253e25ffb0ec5ff00a2a5af596c7c27d8399f164de76bda84be6ffcb596beabf87bfb9f01ff00dbac55f22789a6ff008a8f55fdd7fcbd4b5f58787a6fb1f80e5ffae517fe8aac713fc23bf03ff2313949a6f3b54ffb6b5e8da1cdfe8b5e6917fcb2aeef499bfd16bc83f4f47410cdfbdadad0ff00e6212ffd3ad72b0cd5d2e9337fa06adff5ca28bff22d079f98ff00bb543e7af8e934b378dffeb95ac55ccda79b0f8225ff00afe8bff455687c639bed9e37d43fe9945156543ff226f9527fad96fbff006957bb4ff847e754cf5bf88537fc5d0d3e2ffa817fedacb5e290cdfbdff5b5ec1f1226ff008bb5e57fcf2d1fff006d6bc5269bfe5a52a66d57f847d8da7fefbc39e6ff00d328ab2619bfd16b43c3337db3c2537fd7ac559f690f9d0d78954faec97fdd83ceff009e72d6df84e6ff008aa34a97fe9ea2ae6bf75f65962f37f7b5a1e18bcff89f695e67fcfd454523dbc57f06a9f505dcde75d574ba7ffaa35cff00fcb6ad5b49bf755f4cb63f9fe5bb317c4d37ef7caa96eff73e17bbff00af596b2b5cbcf3afe28ab4356fdcf83750ff00af5968638fc48f9261fb4feea5ff00a655a1a7de4be6feefccacab4bcf2658a5f37fe5956ac3af5b7955f32f73fa0a2972a087cdfed48bcc97cefded797fc79f2bfe255ff6d6bd06d26f3b598bfd67952cb5e73f1f7fe615ff005d65aebc37f10f8fcfff00e5d9cd7837fd56ab179bff0030c96bb0f134dff1697e1d5cff00cf2baba8bff22d79ff008366fdeeab179bff002e32d76bae7efbe03f83e5ff009e5a9dd455e89e27fcbba679ff00c5287c9d675097f79e57f69ffed5af60f817792cd6baaf97e67eeaea296bc7fe2f4dff00134d43fe9a5d455eabfb32cdff00139d56d64fdf7ef62a553f86653ff7a47a5d9cd14d154be77fcb4ac5d0ff00d0e5bbb693fe5d65f2ab6a6af0cfd4a3b079d2cde6d1f6cbeb3f37cb96aafef61a961bcfdef95e5506667f8b34dd2358f0bc57d7ba65b4d772db4b179d345fbdaf99749f186af0d86a12c72f932dac517d96687fe597ef6be9af194de4f8362f33fe795d57c9fa4cde4f8735b97cbff96517fe8daf5f0dfc33f35c6ffbed43b0f8a5ac5f43aceab1472f930c52daff00a9ff009ebf65fded7a87c2d9a49be1f695f6997cefdd7fae9abc7fe325e4bfdb3a87fd35d4e58bfefd45157b2f80ecff00b37c1ba7c5245feaad62f369633f867ad92ffbc9ad37fc7ada451ffcf5af0ffda6ace59ad7c3fe5c524de6cb2ffed2af70fdd7daa2af3ff8bd35b59ff654b7373f64fdecbfea6b9305fef27bfc45ff0022ea879a7c38f04ea7378cbe1fdcfd9bc9fdeffcb6ff00aeb5a1a87c31ff004af104527fa5f95aeffd728bfe5ad761e13f15699a6ea9e0496dac7cdf2afbcaf3aeff00ebad62fc52d62e752d7bc616d24b2f9516bbfea62ff55ff2d6bddf687e4f4f2ea956a6a43e19874cd1e5d42dbedd1f9be579be4c35f42f87b588a1f0bda5b47631ff00aaff005d5f22f81ff7de2dfb349ff3cabea5b4fdce97691475e1e27f8a7dae4181a74a9d43a5d3f5ebe86ead228a5f261f36bc2bf684d7afbfe160da7fa4c9e7795ffb56bd83439bfd3ed3cc8bfe5aff00aeaf0ffda121f27c6f692c7ff3ebff00b56b5c17f1059f52a7fba25f196b17dff08e69ff00bd93cafb2cbff90afe5afbc3f65ad7bfe124f80fe1496497ce9628becbff007ea5af82bc430f9de1cb4f2ffe7aea917fe8a96beb0fd80b58fed2f84baad8ff00cf8ea7ff00a36bd73e3331a47d2b45145078655af967f6f2d4bc9f01f86ad7fe7adf79bff90abe9bf3abe3ff00f82876a5e4e8be0f8bcdff009fa97ff4556553f8675e1ff887c1fa4fefad75097fe995d4bff90bff00b6d7a2fc01bcfdd6ab17fd3596b85d261f2741d425ff009e763145ff007f65aeabe037efa5bbf2e5fdef9b2d6188fe11f5d94ffbf533ebbf0f7fc7a7fdb2ae13c650c735757e139bceb5b4ff00ae55cff8ca6fdecb157cf1fad61ff8879a6a10fd8ed6eee64ff55fbaaf0fd0e696cf54f363fdf7fad96be80f10c3159f85ff00d27fe5acb2cbff007eabe6ff000ceb1143757715cffcfacbe557ad863e073ba94ab634f769a6b1d7bc07f0eac7cd8e6f365ba965866ffaeb5e49f1a347fecdd6755b9b68a38bcd965ff535d8793fd9bff0afe293fd57d97ed5ff009165af3af1bde79d179bff004d6bd23e37ea54e93f687b2fecbf0f93e08b593fe7acb2cbff00916be80861f3a58a2af1afd9d747b99bc11a54b1db49feabcdaf75d3fc377df6fb4f33cb87f7bff2da5af0aa7f10fd4b0f56952c01f1578b3fd0fe20cbff005d62aeea6fdf7c2af1845ff3cb588bff006ad72bf12347f27c792f972c7ff2cbfe5ad76b0e8fff0016e7e207fa4db7eeb53b5ff96bff004d65af5e9ff0cfccde2695cf34f137fc8c777ff5d6bea6866ff8b732ff00db2ffd155f34f8b34db6ff00848e5f2ee63afa421d36da1f87dff2138ffd6c5fb9f2bfe9956389fe11d396e2697f689950cdfe8b15761e1e9bceb5ae7e1d374c9a28bfe267ff0090ababd0f4db1ff967a9ff00e42af20fd2e9e3b0c4b0ff00aeae9b4fff00900ddffd359628ab261d0629a5fddea76d5d5c3e1bb9ff00845e2f2e58e6f36ebfe58cb4fd99e766d8da5f56fe21f24fc489bed9e32d6ffebebcaa2d21ff00893787e2ff0096b757d2ff00ed2aabe26d1efa6d7b55b9f2bfd6dd4b2d755e19d06fa6d7be1fd8c96d27ef6ea297fd57fd3d57b87c2d3ab4bf786b7c48bcff008bbfe2b97fe7c6c7caff00c85e557927fae97caaeefc65792cde23f88b7dfbcfdedd4b17fe45ae274387ed9ace9f17fcf5962a0daaff000e99f58787bfd0fc39a845e6ff00cbac515715e21f88517856d7f79feb6ea5fdd576134de4f872effe7acb755e49f14be1eea5e2ad2e2fb14be4cb14be6c55e1d53ed32aa6fea5fba34350f1b4b0e8d697d2eaf6334b7dff002e90cbfbd8abd1bc11e55e6bda27fcf59658abc27c1bf0c75cd4ad628b5e8ac618a297cdf3ad3fd6cb5f437c3787cef16e956d1c5feaa5a2953fde9a43eb34b0b56a624fa83cead0866ff45ac9b3f36696adddcde4dad7d39f8b3dce52ee6fb66bd5d078b26f27c0faaffd7acb5cae93379dacd74be3887cef01eb7147ff003eb2d27b1ad1fe2a3e448747fb67fac97c9f2a2ff5d5cac3358e9be32fecdf37fd6fef629a597cdae82d26f3b54962ff009eb145593e21b3ff00895c52db5b47fdb7fda7fea66ff9e5e557ccbdcfdee553d9d1474da7ea52ff006f5a7da7cbfdd4b5c27ed0937fc83ffebea5aec3508629aff4f97fe5af9b179b5c27c7e9bc9d2ed3febfab5c37f10f92cfff00e5d9c2f84ef3fd3eee2ff5de6dadd7fe8aaed669bcefd9f744965ff965aecb17fe42af3af0c5e4bfda917eebfe5d65ff00d152d7610de79dfb3c695ff6314bff00a2abd73e797c0627c5efdf5fea1ff6eb2ffe8aaed7e006a5f63f146a1f66963bbfdd79bfb997fe9ad79d7c4dbcf3b54bbffb65ff00a2abd2ff00675d362fb7eb72feeffe594558d5fe18a7fef333d17c43792d9f8cb50f2eda49a2965a966d63c9ff0059149ff7eab43c79a6d8cdaf5dcb25b79d2f9b59fa7d9d8ea56be549e679bff5d7fd6d7907e9f47f8489a1d7ada6b5f2aa18758b19bfe5e63fdd567ea1e1b974d97fd1ae6e7fefed1a7f95a945e5fdba4f37fe9ee2a0d8cff89be24ff8a0e5fdeffcbadd57cd5e189bed9a3ea16de6fef65bab58abe85f8f3a3fd8fe1f7eefec3ff1eb145e77d97fe9ad78d7c27d37fe269a24573731ff00a56b16b17ee62af5f0dfc33f2bc4d4ff006da85bf1bffc4fbc65158dbfefbcdd62ea5ffb65e6d7b54dac7eea5b6b6ff55e57fcb18bcdaf3af86fe1bb6f1278f22bebdb9fb645f659658a1ff9e5fbd96bd974ff000adf59c5fbb8a5f2bfe594d58e30fa2c87d9d2f6954e6a1ff5514524b2437717fcf6ff0096b5e75f1a3cdbcb5f0fff00db596bdc26d1efa1965f3228e5ff00b6b5e13fb424375a6dd787edbca8ff00d54b5c986fe21ee66d89a4f0462e93e559e83a24be6ffc7aea7ffc6ab6be2ede7d8fc47e3bb68e2ff989c52d70ba7f9b3784aefccff9657514b5dafc5e862ff84cbc61ff004d6c62ba8bff002157b07c66b6384f8390ff00697c46ff00a651455f535dfee6d6be74fd9c218a6d6755b9ff00a6b1455f42ea137931455e6627f8a7d464b4ff00d88d0d0e697edf14bff4d6bc7ff68f9a2ff84a2d3feb94bffa36bd6f499bc9bf8a4ffa6b5e35fb4a4dff00156da7fdb5ff00d1b4f05fc43c8cff00fe5d84dfbef0e7ef3fe831e57fdfdb5afa03fe09cfac7eefc61a679bff002d6297c9af9ff4f9bcef06ea1ff4ceeb4bbaff00c85e557aafec0579fd9bf12fc4163ff3d6d6bd73e4731fe19f7ad152375a2b53e60c69abe25ff828f7fc7af853febdaebff695145655363b30ff00c43e3eb3ff00912350ff00afab0ad0f817ff001f577ff5d68a2b0abfc23eb72dff007ea67d57e0eff8f0b4acff001676a28af9e3f54a7f19e7df10bfe458ff00b8657ccdff0031097feb94b4515eb618fcdf1ffef47a25af3ff08d679ff8967ff1daf3bf167fc81e8a2bd23c8a9fc33ea1fd9fddbfe103d2be63ff001ebeb5eb369ff1fd6bff005d68a2bc77fc43d9a9fee87c89f10bfe46d9bfeb9576da77fc887f117febad87fe8da28af4e9ff000a99f9dfd83cd3c51ff21497fcff00cb2afa162ff9136d3febafff001aa28ac713fc33bb03fefa685a56de9fff002c68a2bcc3efce821ff53ff6d2ba09bfe457d3ff00ebacb4514d6e7879d7fbb1f23cd349f6f97e76fccd7b27c2dbc9cfc4bf87f99e43fe8dfdf3ff004d68a2be80f8fa5d4b5aa7efec3c61e67ef3fd3a2fbdcffcb596b8ed0ec6dbfe128d3ffd1e2ff8fafee0a28acaa1ec436a67adeadff20187febacbff00a2a887fe3c28a2be7ea6e7eb7947fb9530b5ff00595d87c1cff92856bff6d7ff004551456d87fe21b66dfee354fa43fe5b567eadff001ed2d1457d09f841ca7867fe3fe5aed75cff00915f50ff00af5968a293d8a87c48f87e1ff918f49ffae5ff00c76ba1bcff0091a3fed951457ccbdcfe82a7f0a21d43fe3eb4ff00faf9ff00da55c2fed09ff201ff00b7affda54515ae1ff887cae7ff00c3a6792787bfe43117fdb5ff00d152d757a6ff00c9bbe95ff6314bff00a2a8a2bdce87ca2fe198fe3d553e23bbca83f87fd328abdf3f675b1b7ff89b7fa3c5feb7fb828a2b92a7f0ce5adfc5a87a77c42863fed8d43e45ff005be82b82d3ff00e3ea5a28af20fd5f05fc236eeffe3c26af3f9bfe43d45141d70d83e3ff00fc9348bfeb945ffa36bc3fe18ffc8dbe1aff00b0c51457b986fe19f93627fdeaa9e8bf00ff00e46cbb3dff00b1e5ff00d1b5ec177cdac59e68a2b9313fc43d2c0ff08e7eebfd5ddd7927c6eff90c695ff5eb45158e1ff8a6d8afe09c55a7fc8b9ab7fd758bff0046d757f177fe46c9bfec5db5ff00d154515e91ccf6a667fecc1feab50ffafaff00da55ed7ab7fc7d454515e4e23f887d5e53ff0022f34349ff005d17fd75af24fda3ff00e463b4ff00b7aa28ad70dfc43c6cfbfe5d94f4ff00f914bc41ff005e361ffa36bd33f62eff009382bbff00b6bffb568a2bd73e5b1dfc23f42a8a28ad4f933fffd9,
        3,
        'image/jpeg',
        '2025-04-26'
    );

INSERT INTO
    `child` (
        `ChildID`,
        `ParentID`,
        `First_Name`,
        `Last_Name`,
        `DOB`,
        `Nickname`,
        `Relation`,
        `Religion`,
        `Language`,
        `Allergies`,
        `Gender`,
        `Image`,
        `PackageID`,
        `ImageType`,
        `EnrollDate`
    )
VALUES (
        118,
        32,
        'SA',
        'Savith',
        '2017-12-04',
        'fghj',
        'Father',
        '',
        'English',
        'Shrimp, Egg',
        'M',
        0xffd8ffe000104a46494600010101004800480000ffdb0043000302020302020303030304030304050805050404050a070706080c0a0c0c0b0a0b0b0d0e12100d0e110e0b0b1016101113141515150c0f171816141812141514ffdb00430103040405040509050509140d0b0d1414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414141414ffc000110801d201d303012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fd159a6f261a28a3cea002a6a861a9a800a28a87fe5b5004d50d4d50d004d454345004d4543e7514005145140135150d140135150d140135150d4d4005145140051451e4d00145137efa8a00968a2a1fb645ff003d63a009a8a8bce8a1ff0059479d40054b454540051479d45001451450043479dfbda289a800a8a8a96800a8aa5a28022a28a2800a28a21a0096a2a968a008a8a28a0028a28a0028a28a008a8a96a2a0028f268a28021a28a2803428a28a002a6a868a0028a28a0028a21a2800a28a28022a968a2800a28a2800a28a2800a28a28026a28a2800a28a8669bc98bcd93fd5454013515534fbc8b52b58ae63ff552d177a94567179b24b1c517fd3696802dcd5c7f887e2d7843c2b7ff0066d5bc4363a74bfeb6586697fd57fd75ac4f137c7ef08786e5fb37f69c7a8ddf95e6f9369fbdf2abf33ff6ecf891e1af1b78ded3c4ba0ea71cd69756bf65ba861baff96b14b41afb33ed6fdaebf6bad37e167836ead7c3975fdafaddd5b4be57d963f37caffa6b5f9b3a1fed51f11bfb2f55b693c437d34b752fdaa2fdeffaa96bcab50f126a7ac7fa4c97327fcf2ff5b5cfda5e4b0c5e5472c7591a9f4d6a1fb667c46f15784bfb0f51d72487558a5ff908432ffad8bfe794b5f5dfeccbfb665b5e5ae95a3f89efa3f37ecdfbdbb9a5ff0055ff005d6bf2926bcab70eb12fdabcdff96bff003dab203f7d743f8f1e15d6354feccb7d4e39a5ff009ed0fef62af40fb6473435fcff00f84fe2a789741bfbbd4f49d5ee6d2ebcaf2a59abe8bf84ff00b6978974dd1aef4dd7b57b9b49628bfd166ff5b14bff004ca5ad3da197b23f5d7ce8ff00e7a515f949e1efdaea2d7a5f375ad4f56b4965ff005535ddd4b2c517fd72af7bf80dfb697f63eb3ff08f78f6fa3bbd3e597cab1f10ff00ed2969fb40f647dc14567da6b115e5ac5736d2c53452ff00aa9a1ff96b55756f127f63daff00a358dcea32ff00cf1b4f2ab53236aaacdfeb7f77ff002cabc53c59fb485b7856d6ee5d5ac7fb2258a2fdd437775fbdaf45f87be30b6f1b68d16a765731ddda5d7fcf197fd55007570ffd34a968a2800a28a2800a28a8a800a28a96800a2a2a96800a8aa5a8a8025a8a8ffa654500145145001514d52d14011543534d0f9d450044b36545151af4a28034e8a28a0028a28a0028a28a0028a28a0028a28a008aa5a8aa5a00289aa2ff005d52d0010d14514005145140054d50d4d4005733f10ace5d63c11add8db5cfd92eaead658a29bfe9ad741e77935e3ffb4568f6de36f01ea1a647abc9a46a1e57fa2ddc32f95e54b401e4bf05ff006c0d32cf41ff00847bc4ff00e89e25d33fd16ea1ff00a6b157c89fb52fed45e21d7bc792ff00c231e21925d3e2b9fb5450cdfbd8a297fe9957857c5ed37c4ba0f8a350b6d7a5926d43cdff008fbff9ebff004d6bcea5d62e7cd965fddf9bff003d66fded64751ea1f10fe305f78da6fb76a36365697fe57ef26b5925ff00dab5e5377e248a68bcaf2bed7ff4da6aa9a85e7db3fd6799e6d1a7e8373792feee2a06559af2e66ff96bfbaa21f361ff009655d8693e0ffdeffa6c5e4d775a4fc3db19ad7ca8ff007dff004c6b1f683f66792e9fa3fdb25f2bfe7ad741a77857fd165f322af409be18fef7cdd3ae7c99a2ff00a6556a1865ff008f6bdb6f26effe98d1ed0d7d99c5787bc2b17dabecdff3f5fbafdf545378565b39658a4ff552d76bfd8f7334de5795e4ddc5fbd8bfe7ad685a5e47a979ba66a317fa5ffcb2a0471fa4d9c7f6596da4ff005b17fcb1ff009eb157a0786618af3c39e6db5cfef6d7f75e4cd58bab6836dfd8de6d97fc7ddaff00aaff00e35589a7ebdfd8f7535cc9fb9965ff005b0ffed5ac80fad7e0dfed397df07e5d2ac75696e6efc097dfeb6187fd6d8cbff3d62afb2ffb4a5d7a5b4b9d3bc4b243692c5feba18a297feb957e4ce93e2afed8d2eef48b997ce96297cd8a6afa2ff670f8c12f86f5097c35ad5cc9fd952ffaaf3bfe5956b4c75299f5878f3c1fabf8aa2b4b1b9f10d8ea3e6ffaa86eed7caf36bcff00f665fb4fc3df88369a649f699b4fd4ed65ff0096bfbaf2a2f2bca97ff46d549be39691a6fc418a5fb7470cb636b2dacb34d2ff00ad96ba0f0f5e58f893e2368973a4df7daed2c6c7fd75a4bff4d6b6303ebb866a96b3f4ff00f8f5ad0ad4e50a26a28a0028a8a8a002a5a8a8a00968a2a2a00968a28a0028a28a002a2a96a2a0028a28a008a89a8a87f7b34bff004ca80124fbc68a99adfcc62deb45005ba2a2866fded4b4005145140051451400514514005151514012d4552d140051451400514514007fcb6a21ff005d454d4010d4d50d70bf17bc792f827c07ab5f595cd8da6a1145fe8bf6b97fe5ad0074be2cf2a6d2e6b6925921f37fe78d7e6ffc7ff89de2af01dfea1e66a773abdaff00cb28750fdd795ffa2a5ae2be26fedbdf176cf5ebb8a4beff00897f95e54be4c5fba8a5ff00a652c55f327c48f8b5ae78db54fb75edf4934bff003d66fded6475d322f1978dafbc552ffa6f9934517fcb69ab899a6fdd795e6f9d514d34b79fbafde7fcf5a96d61ff0055e5fefaee8026b487c9fdef951c35daf86747bed625ff009690d65693e1b97ed5fbcff5bff2cab7f50f155b7856d65b1b2ff4bd43fe5acd589d74cf46b4f0ddb69b6bfbdbeb6f37febad67ea10cb0ff00c7b496d0cbff006ca2af14bbd7ae6f24965d46fa49bfe98d4da7ebd730ff00c7b4524317fe45ac7d98fda1daeade30d7341962964963bb8a8ff859d16a517fa4d73536a5737917faa8ff00efed67cd6773e6ff00aaff00c854cd8f40d5bc6d6da95afef25fb5ff00d36ff96b5ccddf8dbcef2bcc97f7b17faa9ab9a86196a6fb1c57917ef3fd6d065a9d2ddf8f2e6697f7927fadff005b2d43a86b115e7dae5f37c9ff009e55cd43672fd9658a4ff96552c3672795e556a739a1e13bc93ed52fef7f7b5e8169e24966bf8a28e5fdef95e579d5e75a7de7d8fcd97cafdeff00aaa2d358f26596593cd9a5f2a803bbf0f6a57335ff009ba8dcc9fbaff5be4ffcf5af50d0fc6dae783e6b5d734eb9b9b4bb8bfe58f9bfeb6bc3fc3da945a96b3149a8c5e745e6f9b5f40693a0d8eb1a5ff6647249a74bfeb65866ff0055e55007e807ec9ff1e3fe16d784bfd262f2750b5fdd4b0d7d0b5f9a9fb06ea573a0fc50d4228ffe3d3ca962961865afd2bffd155ad2396a12d45437fcb1a2b6310a28a2800a96a2a28025a28a2800a28a2800a28a2800a21a28f26800a28a28022a3c9a28a008a8a968a002a5a8aa5a008aa5a2a2a00968a28a0028a8a8a0028a28a0021a97fe5b54545004b451515004b45145001451450015f157edc5f122db4d965b1d46e7c9d3ed62f362b487fe5ea5afb56bf26bf6f2f185cffc2cbf15db471c937d97cab5966ff9e5595436a47cbff14be2d6a7e3cd525f33f73179bfea7caf2abcebf7b354b343e7510c3e4c341a8793fbaadbd0fcd87ca97fe5acbff2dab9f9a6fdeffd32ad5d0fcdbcbf8bfefed2a83a6777a84d2e8f612f97feba5ff96d589a4fc3dd4f58fdefef2bd2f43f0dff00c2497515affdfdafa57c11f0ae28628bf775e4d4c4fb33e870d86f6a7c9f67f036e669628bcaaec343fd9a753bcff96527fdb6afb9743f86f6de545e65b475db69fe0f8a18bf771571fd66a9d9f52a67c1f0fec977d37faba866fd97757b397fe3da4afd16b4f0ac5ff3cab6ad3c2b14dff3ce8f69505ece91f9b5a7fecaf7d79179bf6192a1d73f651d4f478bed3e557ea0ff00c2376d0d675df8562bcff9651d3f6950cff747e587fc29397f7bfe8dfbdf36ba0d0ff675b9d62d62ff0041fded7e884df09748ff005b25b79d2f9be6d4b77f0f6dbecb2f974bda5434f6748fccaf137eceb2e9be6cbfbc9a2ff9ed5e49e37f01dcf86e5f2ae6297caff9655fac137c31b6b3b5fde7efa5ff009ed5f3d7c79f83f6d79a5dddcdbdb7fcb2ff00bf54e9e242a60a955a47c1da7c36d3795feb3f75feaabbbb4d6353d36d7cd8ee649ad25ff9ed5cd5de8f1437f7517fcb5aed7c11e6ea56b2db6a3e67fd76af5cf9ef6563ea1fd8626b6d4be23452cb2ffc4c2ebfd6ff00d72f2abf4abfe58d7e357c3df155cfc31f19695a9d949e4cb6b2f9b17fd72afd60f84ff10ac7e2178374fd5eca5ff8fa8abaa91c750ed68a28ad8e40a28a968022a28f27f73e554b401154b451400514514005145140054d50d4d400543535434005145140115152d140117fcb6a28a96800a8aa5a8a8025a8aa5a28022a3c9a968a008aa5a28a0028a28a008a8868a28025a2a286a5a00289bf7dfbaa28a003fe58d7e42ffc14ba1b1d37e34c3fd8b2c9fbdb58bfb4fc997fd6cb5faeb357e47ffc1437c37ff08df8cbcdd465f3aeefbfd2e2ff00b6b595436a47c69773450ffc7b7fadff00a6d557ce97fe5a512ffd33fdcd4b343f6c8bfe9ad0233e6aeafc1f04a2de6923ff005d245fbaa8bc3de09b9d7a6ff55fbaaf7af047c25fb1c514b245fe97feaa286b8f13569d33d7c161aa553d2fe05f827fe24d6b7373feb6eabeb0f0ce831436b17eeabcd3e1be83f63d3ed22ff9f58bcaaf6bd0e1ff00555f3c7d77f0a99d069f675d05a59d67e9d5b76bfeaeb5a471d42d5a59c55ab0c35561ad086ba8f3ea12f935179345140886686b3e6ff535ad34d59f356550da99ccead0f9d5c5789b41b6d4ad658a48bcef362af40d421f3ab135086b90eca67e5d7c7ef01cbe0ff194b2db5b7eebcdff00535ca693ac7fc7a5cc7fb996beb0fdaefc1ff6cb096e638bfe5957c95e7450c52dcf95fe897517fe45af5f0d53f767918da7fbc34350d7bfd2a28a4ff555f62fec05f19bec7aa5df842f6fbcefb57fa55ac35f07ead37ef7f77feb62aeafe10f8abfb1fe25f83f538ff73fe9d179be557a28f22a1fba10d151693379d6114bff004caa5ff965fbbaeb3ce0a28a28025a28a2800a28a2800a28a2800a28a2800a9aa1a9a1a0028a28a00868a28a008a8a968a0028a28a002a2ff96d52d14005145140051451400514514011514514012d45451fbdff00b6b400793e4d4b44d4500145453514012d7e487fc151358f3be39fd9a4ff00556363145143ff00916bf5aabf193fe0a53677d67fb48f883edbff002d7ca962ff00ae5e545591b523e4ff00f9652cb56f49b396f2ea28a3ff0096b553fe5b576df0f6cfcebf8a955d8da953f6b54f7af86fe09b6fb05a451f995ef7e13f0dc7a6f952f95e74bff3dabcff00c110f936b157b2f87bf7de557c9d5a9a9f7b4a9fb2a4761a4d9f932feeff00735e81a1c31435c7e87dabb6d3ab10a874b69e556ada5655a568435d748e4a86ac3355b866acff0026b421ff00535a9c84be7545e74b5179d47934016bceaab354be4d549a1f268033e686b2b50ff9e55ab7758b7737935c875d33ca7e3468316b1e17bb964ff965157e77ea1672e83e2396c64fdf5a79b5fa57e32ff4cd2eee2ffa655f9fff0017ace2d3754f3648ff00e99576618e4c6ff0cf1fd5ace5d3754962ff0032d6afc1cd1ffb7bc79a558c9ff2d6fa2ae575cd6259bf7be6fef6bd97f649b3ff008493e32786a5fddc3e55cc5752ff00dfdaf711f387ed2e8767fd9ba35a5b7fcf28bcaad0a8a1a2bacf3c968a28a002a287fd754b4793400514514005145140051535140051451400514514010d1535434005145140054d50d14005144d450014514500145145001451450015154b450015151515004b47ef28a28025a8a8a2800afc9aff0082a7e9b7367f1cfed3247fe892e8f6b2c5357eb2c3fbe8abe1aff82aa7c2cbaf117c3ad13c57631e0e972cb15cfeebfe594b41b533f2526ff5d157a5fc3787fd3e2f32bcff00c98e1ff595ea1f09ece59afeb9311fc23d1c0ff14fa57c33fb98a2af60f0f4d1795e6d787e9fa945a3dac52c92d67eadf13afaf3fd06dbccf2bfe98d7ce9f65ed7d99f55e9fe30d361ff0057731cd5d5693e3cd33cd8a292fa387febb4b5f0fda6bda9cd1ffa34b27fdfaac5d435ed5f4793cdb98a4f37fe9b51ecce4a954fd3ad3f5eb19a2fddcb1cd5a10ea517eea5f36bf32bc3dfb426b9a6feeada4961af6bf06fc7ed5f528bfd265f3a5ff5b4053fde9f72da6a514d56fcefdd5784f823e2745a94b157ade9fa979d17eeeb5f68655299abe7450d1fda51435caf88758fecdaf24f137c48be86ebcd8ffd551ed03d99f42c3ac45e57ef25ac5d43c6da6432f95f698ebe09f891f1e357d36ea58eda5ff55feb7f7b5c2e93f153c43e2abff2adbedde6ff00d72a03d9d33f46a6f1b69979feaee6aaff00695b6a5179b6d2f9d157c89a1ffc24335afda7cab987ff00215741e1ff001b6a7e1bba965b997f75ff004dab92a1d74cf7ad4218af2d65ff00ae55f0afc63b3961d7a5d32e7f7de54bff0090abec5f09f8aadbc496be6472ff00d7586be65fdadb47fecdd674fbe8ff00e5ad6d86fe298e269fee8f8ff5cf2b4dd5258ada2f27f7be54bfbdaf75ff00827ed9c537ed0fa7db5cfee7cdff00555e1fab4dfe9fe549ff003d7caafa03fe09efa6ea7a97ed05e1fb6b6fdcfd96296ea59bfe7ac5ff003cabe891f187ec8514510ffcb5aeb39021a968ff0096d450014545e754b400514514005145140054d4514005145140051451400514514010d15663fb828a00ad451450014514500145151500152d4552d0014514500145454500145145001451450014514434005715f1bb47b6f127c25f15d8dec7fba96c65aed6bcbff694f891ff000ac7e106b7a9c76d1ddddcbfe8b14337faaf365a0da9fef4fc24f1359f93acdd45ff003ca5af4bf839feb2bcff00c650cb67af6a1149feb6596596bd17e08d9ffadf32bcec4ff08f5b03fef2777e32fdf450dac7e679bff4c62ad5f06f86ff00b362ff00498bf7b5d369fe1b96f3548a5f2a39a2ff00a6d5abe26ff890f95e5c51f9bff5d6bc3f687d47b336f49d7b43d06d62fed1f2fcdff9e3feb6ba5fed2d23c496be5ff61feebfe597dafca8abe6fbbd1fc5579af4b2db451c3e6ffcb69aadeadf007c5de30ff8f7d73fd2bcdfdd7f684b2d6becfda9954a9ecffe5d9e81e32f01c534be6d96876337fd7a5f455c25a6a51e8375f6692da4d3a58bfe58cd5eb7e09fd9d756fb5cda9f89bfb3750bafb379421d3ffd162f37fe7afeeaa59be03eaf0cbe55eeb96d77a7ff00cfa5dc5fbdff00bfb5954fdd1ad2a9ed48be1bf8dbced521b6afb6bc070f9da5c52d7c2be19f04ff0066f8f228adbfe3d2296bef0f047ee74b8bcaac69ff0010788fe1993f122ce2fb04b2f9be4d7c9fe3cd63fd6f99ff002cabec0f1bd9ff00695af955e1fe3cf83fe7683ff129fb343a84bff2daee8a86986a87cbf0de45f6af364d32c6d2d3fe7b6a12f955ed7f0f752d226b5ff42b9f0dcd2ffcf186fa2f36b85d73e03c579e17bbd32f628e6d6fcdf37fb42697cdaf39d27f651f19c361fd91278974d874af37cd8a1862965962ff00b6be556d4e9d3aa6588a9529ff00cbb3eb09be2458e9b27d9756b1feceff009e537fcb2aa9e2cd1ec7c4961e547fb9f37fd54d0d78ff00fc2a5f1c683e55b683a9fdb2d3caf2a58756fded7ab7c3df0dea7a6dafd86f6c7c98bfe78ffcf2ff00ae558d4fdd1ad3a6733e03d36fbc1fe2896dbcdf3ad2e7fe5b5657ed81a6f9de17b4be93fd5452fef6bdeeefc13fe8b14bf66b9ffaed3579a7ed29a3fdb3e1cddcbfebbecbfbda297f10cab7f08fce4d5a1ff45b4beffb652cd5f787fc12d7c137336a9adf8abcaff44b5b6fecf8bf755f0aeadff12dfdd795e7452cbfea6bf543fe09d9ac58ff00c2b497c3d651793f61fdecbff6d6be9e9543e36ad3fdd9f5ad14515d879a4b515145004b5154b51500152d14500145145004d451450014514500145dcd159dacb7327faa8a8a3fd77eea800ff5d45147fcb6a008a3fba28a4a2800a8a69bc9a968a0028a8a8a00968a8a1a2800a968a28022a968a8a800a28a28025a8bfe5b5144d4005145454012d145140057927ed55e09ff0084f3e03f8af4c8e2f3aea2b5fb545ff6cbf7b5eb7515df9535acbe67faaf2bf7b41b52a9ecea9fcfcf8df4d93edfe6c917fdb5af4bf8390f9361e6ff00cf596a5f8fda6d8cdaceab2e9d1793a7c5752f950ffd32f37f7547c329bc9d2e28abc3abfc33e9f0d4fd9e24fa83e1bd9db4d6bfbc8a39abd2e1f01d8ebd1795f668e68abc93e1bcd27fcf4af7bf0cde7eeabc33e8ce12efe06df69b2f9ba4ff00a5ff00d319a5ab7a4f86fc5567ff0032d49ff6c65af75d26b6fc98bcaad7d9b31f69eccf1ad3fc37e2fbc8bf7915b69117fd75f365a875cf0ddb68314dfbd92eeeff00e5acd357adea137eebf775e5fe37bc8a18a5f32835a750f3ad0f4d8bfb67cdf2abe8af044d2cd615f3fe8779e76a95f4378221ff0045ff00555b5231a8686a1379d2d1696716a5179773151ae7ee6aa69fa950719cff0088be12f9dfbdd3ae7c9ffa635cd7fc2bdf10c337fcb3ff003ff6d6bdc2d7fd5d1343e77fac8a8f643a789a878fe9fe03d5fcdff49963aeeb4fd1e5b38bcaf2bf75ff003c6b6fc9a8a6a3d90ea55326ee18becbe5578ffc4db3fed2f0beab6d27fcb5b5962af60d43fd54b5e55e329bfd16eeb235a67e626ada0cbac5fdd6911c5e75df9bfe8b5faa1fb14f80e5f01f8725b1b98a386efecb1452d7c2bf08747fb67c7dd2bcb8bceff4a97cdffbf55fa81f0b6cfec77fa87eebc9fdd79b5edffcbca6787569fb2c3543d168a2a5af5cf970a28a28022a968a2800a28a2800a28a28026a26a87fe5a7955379dfbaff00a654005150ff00cb1a9a800a28a2800a26ff009eb451400793451450043451450045451343e74352d00145145001451450015154b517fa9a0028a28a002a2a96897f7340114d479dfbda3cea2800a96a2a28025a8aee1fb65acb6dff003d62f2aa5a2819f8a9f1bb4db9d075ed574cb98bc996d6ea5b597fed94b5cffc329a5fb2c5157d61fb73fc3db687e2b6ab27951c3f6eb58aeffd57fad97fcc55f22f823cdd36fe58a4fdcd78757fe7d9f634aa7b4a94aa1f50780a6f2628abdc3c27795f34f84f52f2628abd9bc1baf7fd35af24f78f7ad266f3aba0fb6579d693ac7eea8d5bc61e4feeadbf7d2cbff2c697b531f6674be21f125b59c5feb6bc426f1858ebdacea1e6dcc7fbaff555abe26865fb04b2dcdcf9d2ff00cf1af93be21437367aa4b2c7a9dce9de6ffd35a3f8a6bfbba54cfa1b49f1258d9ea9f65925fdec55f4af823c496335ac52f9b5f96bff000956a7677515cc5abc9772c5ff002c66af65f87bfb484ba6dac515cc5279bff4c6bafd9d4a4727b4a754fbef5cd62dbcdff5b5cff9d14d179bfea6be44d73e3678ab5897fd0becda745145ff002f7feb6b6fe1eeb1e2fd7b548bfb6bc551cb69ff003e90feeab2a86b4e99f52e9fe30f27caff0057e5575769af5b5e579fcde158b52b08bcb97c996b94875eb9f0aeb3f61bd968f69ecc7ece9d43dd7ceacfd426ae6b4ff1845345fbba26d4bcead7da9c9ec896ee6af2ff001e4de4c577e64bfeb62af40d426af1ff008a5ac456761a84b27faa8ad6b94d4f35fd93f4db19bc51e26d5ee7fe3eed658ad6d6bef5f86ffe9916a173ff002cbf75157c69fb19c3630f837c57abff00cb596ebca8abed6f865672d9f836d3ed3feba5fdecb5ede1bf887878eabfecfecceaa8a28af5cf970a28a2800a2a2a96800a28a2800a2a6a28021a3fe58d1ff2daa6a0086a6a28a0028a289bcdf2a800a28a2800a28a28021a8aa5a2800a28a2800a28a2800a28a8a800a28a2800a28a2800a26a2a2a0028a28a0028868a28025a28a2803e4ffdbcbc2be7683a2789638bfe3d65fecf97fedad7e6d79df63f195dcb257ed87c4df87b63f13bc11a8787af65f262baff005537fcf296bf27ff006a5f803a9fc07f883a7c525d47a8c57d179b14d0c5e5579d5699ebe16a7eecd5d27fe3c22963aec3c27ac4bf6a8bf7b5e7ff000cb588af2d7ca93fe7956dfc3dbcf3bc6f776327fdb2af9eaa7d952a87b843e2a96ced7cbff96b58977e3c8b47fdecb73e76a152fc52bcff00843fc2515cc7ff002d3f755f256ade3cb9fb54bff2c65922f37feb952a54bda862313ec8fa03c59f1822862bb97cdffae50d7ce9e20f155ceb1752f992ff00a5ff00ad96b166f125b5e4517db6593fd6d4369a6fdb25965b28bce965af469d3f6479352a55ac67cd0cb0cbe6fef26f37ff0022d761a4de5f683a35ddcc7feb7fe78f9556fc3de03f10de5d5a797637335a79bfba861afa0356f0adf69be11feccb9f87d25a5ddf45e54577ff003d6b6a950d69e0ea1f3ff8675ebe9aebf79ff2d62adbb4f1b5cf86f598ae63b99218a2ff00963ff3caba5d5be0ff008cfc13616973a8f87ae61f37fd54d3455cfea1e15d5e1bafb36a3a1dcff684b17ef61f2ab036a787a87d21f09ff68ab9865fb36a32f9d17fcb2aeafc79af691e2ad2e2f2efbec977e6f9b14d34b5f24c3e2ad334797fd36292d3ca8bff0022d45ab7c48b1d4ad628acafbce96ebfd6ff00d32f2ab2f646dfc23ea0f01f8db52d3759fec8d4658fcdff00965343feaa5af6b86f3ce8bcdaf867e1bf892fb52d534a8a4b9926fdefeeabed6bb9bec761e6f95e4cbe5572d4fdd1afb4f6a685dea5fe812d7cf3fb456a5e4e97e5472ffadaf46ff8493ceb5f2a397ce97cafdd7fdfdaf9a7e31f893ed92cb6de6f9de55d79514d5a52fded4392afeea99eedfb27e9bff16bff00d1a5f27edd7de6d7de16967f63b08ada3ff96517955f34fec7ff000662d1fe1f695a95eea7f6b8bcdfb54569e57eeabea0afa2c352f647c963aad3abecfd98514515d879c145144d0d0014514500153514500145150d001479d451feba6ffa6b401351451400524bfeabf774adff002c6a19a8026ff96d50cd37eebf77454d400f3cd14c5f2f68c74a28021a28a2800a28a2800a28a8a8025a28a8a800a28a2800a2a5a8a800a28a28022f268a3fd754b40054552d14005145140057c1ff00f053fd1e586c3c1fabc7ff002ca5962fdcd7deb5f3d7edc5e038bc6df06e5ff46fb5dddacb14b1793595436a47e5ff0080f588b4dba8a2925fdd4b5d0693e24fec1f88da4df7ef3ca97f752d79a69337f63ea9f66925ff004bb596b5bc59792cdaa69f2f9bff002d6bc7a94ff787d452c4feecfb43e31e9bff000987c1b96e6dbfd6c5179b157c33a4e832ebd75145e6ff00a5cbff003dabed6f817e2a8b58d062b1b99639a2af1ab4f87b630fc4bd422d3a293fb3e296597ceff9e55c94ea7b23d0a94fdad4f6878a5dfc31d5f47bff00f49f33caff00ae55ee1f0b741f0d4d6ba85b5cdcc7e55d5afdaa29bfd54b17fcf5af40fecdb6fdd5b5ec51795ff2ca6a3fe155e87a94be6c9a65b5dffcb2a3da7b53d1a74ffe7d9e8be0df89df08b47d07c352def886c7ed7fba962f2bf7b2ff00db5f2abd6f50fda2be115e5869ff0069d5e4d47cab98a58bec9632cbe57fe42af1af09f83ec7c372c5f66fdd45145e545e75af9b5eaba1c32fd8258a3d5e387fed953a750e4a99754fe27b52d7c48fda8be116b16169149737da8f957514be4da6992d71fa87c6cf869ac7892ef53b6fb4c32dd699e6daddcd632c5e6c5ff3ca2ffa6b5e97fd8f73a945fbcf10dcf95ff4c62ac487e1be9967feae2ffb6d356b50ca9e0e9d2ff97a7cff00e37f86fa1f8c34bfeccd174897cd96d7ca8aee68bfd57fd35ffaeb5e5fe37fd92ffe158f80e5d4eda5fb66a117ef65afb9ad34dd334d962fb1797e6ffcf6ae67e2f59db43f0fb56fb4fefa5962ac4eaf694cf92bf655f04dcebde2396fa4ff0055632ffe45afa57e296bdfd8fa0cb15b451f9bfeaa2fded792fecf7e2ab1d0746d43cbff009ebe6dd4b5ca7c52f89dff00092788ed228ffe3d22baf365f26b2fe29e7ff0cec350d622d07418becd2f9d7714517ff6daf9ff00c43a94b79e2db4b68e2f3a58a5fdeffd75aeefc41e24b9d36d61bef37f7b6b179be4ff00e42aa9fb35fc3dd4fe277c5ab48a38a4f2bcdf365bbff9e5ff004d6baf0d4ce3c755fdd1fa61f017c377de1bf86ba558ea5e5c377145fbdf26bd16aae9f67169b6115b47ff002caad57d11f2415154b45001443fea68a2800a28a28026a86a6a86800a28a2800a2a6a2800a28a2800a28a28021ff963537fcb6a28a0028a28a00868a8a8a00968a2a2a0096a2a28a0028a3fe58d14005145140051451ff5d2800a28a3fd74540117fcb6a96a29aa586800a96a2a961a0028a28a002b2bc4da3c5af6837763245e779b156ad1401f86bfb45783e5f01fc5ad56da48a487f7bfbaf3a2f2ab89fed2fb645fe93ff3d6bf483fe0a31fb37cbe36f0945e2ed06c649b50b597fd2a1862ff005b157e5aff00a4e9b2c5e64bfeaa5ff535c95299e8d2aa7bafc27f88573a0f9bfeb3cdfdd7fa9aed7c0fe3c8b4dd66eee6e7cbfdedd7ef66af9ab44d7a586ea596ba5f0f6b12cd2f9524bfba965ff5d5e6d4c31e8d3c49f634d35b6b161f698ffed956243ac5f68f14b2c72c9ff3d65ae2bc1be3cf27f75732f9dff2cbfe79574be2cd62da6b5962b6f321f36bcff67ec8fa2a557dad33a5d3fe366a7676b1799147feb6babd27e394be4ffa6db470ff00ed2af9bf50d7a58648a28e2fb5cb17fe45ae7f56f154b0cb77631f9934b5a997b53ec587e3f5ccde6fd8a5b6f2bfe5956569ff0013b5cd4b5e8a2bd964862baaf96b43f155cfdabec31fee6597f755efff000cbed3e24ba8b53fb3793696bfba97f7bfeb6b2a86b4cfa2fc27e6fd962d4ef65fdd45fbaffb6b5e4bfb47fc549747d2e5b68e2ffaeb357a078b3c616da0d879b1cb1f95ff002ca1f2abe29f8bde309752d5258a29649b4f8a5ad69d338f1350343f1545a6e837717ef3cebebaf365f26b9ad3f5ef275e8ae6e7fd2ff7be6d62c37917fd76ff009652c359377a97d8e5bb8bfed95767b23c9f6a74be26d625d63caf325f3bcdbaf2abef6ff82767c37b9d1fc2faaf896e629218afbf756be745ff002cabe1ff00803f09757f8cde37d3f43b68a4fb279bfe95343ff2ca2afd9af0ce8363e1bd1ad34cd3ada3b4b4b58bca8a186bd1c3533c9c455f6a68514515d6718514545e75004b4514500145145004d4543e75140051454d4005145140051451400513514500145145001451450054a28a2800a28a2800a28a2800a28a2800a28a2800ff009634510d14005145140114dff4d2a5ff00965feb6a29aa5a002a5a8a8a0096a287fe7ad4b45001451450055d5b4d8b58b096c6e7fd54b5f873fb587c37ff008563f1a7c4ba6c7ff1e9f6a97caafdd0afca5fdbb3478b52f8e7e258bcaf3bfd57fe8aae4a953d91d787a7ed4f89219a5d365f2bcdad5b4bc8a1f2bcbf326fded55d6f47974d97f791554866f26ea296397febad03fe11eb7a1f892586ea6ff9eb2ffaaaeabfe130d4ef25b4b18ffe597fad861af1a8758fb1c5a7cb6dfbef2a2fdeff00dfdae83c33e24f3afe5b9b997c9b4ae3a94cf470d893defc1da3db5e5d4b2decbe77ef7cdfdf4b5a10f856c61d53ed3f66f3bfd6cbfb9af3ff000f78dbec775f668ffe5ad6d43af5cc3e6c5e6f9dfeaa2fdcff00cf2ff3e5579dec8fa1a75299d5f87b41d321d66ef53fb0f9d2ff00cb59abb58758fec7bf962b297f751452fdaa186bc97c3daf7ef7fd27fe3d22ff00c8b59fe26f154b0cba845e6c9e6dcffcf1a3d907b5fdd9d078cbe2a4ba95fcb179b24dfbafdd57926a1a94ba94b2f992feea5fded549b5297fd2e4922ff5575ff2dab9fd7352b99a28bcb965fb5f9be6cbe4d7a34a99f3d56afb50d5b5296ce5f2bcdf3a2f37fe58d5bd274797c49ace9f636de64d2cb75e57fd75acafb679d2cd147e5f9b75ff004cbcdfded7d81fb1ff00c198acfc65e1fd5f5a8bfd2fedd14be74d5b54a9eccc69d3f6a7dd5fb35fc07d33e09f822d2da38a3fed5ba8bfd2aefcafdeff00d72af66a86a6af411e4854353514c454a2a5ff005d2d1401154b45140051451e4d001454d45001451450014514500145152d00454514500145150cd40135150d14011514514005145454012d14434500145147fcb6a0028a28a0028a28ff009634005147fcb4ff00a6544d4004d45145001fbca28a28025a2a2a28025a28ae7fe2178dac7e1bf83750f10ea3fbe8ac62ff0053ff003d65ff009651500797fed6dfb425b7c01f8692df5bfefbc4b7dfbad32d3ff6affdb2afcc5d3f52bef1268d16a77b7325dea175e6cb2cd37fcb5a97f6a4f891e20f8a9ad6a1e2ad6a58fcdff556d690ff00aab58bfe79545e08b3f27c396917fcf28abc8c4d4f687d460b0dec8f3ff1be83fba97cc97ff21579a4d67f63ff00595f45f88747f3bfd67faaaf2ff107856da1f362f2fceaca95435c4e18f3486f2587f75ff2cab5ad3cdfb2cbe5ff00d75ac9bbb396196a6b4bc9618bfe5a57a2785b1bf0f893c9ba8a58ebd034ff0018470dd452c92ffd35ff00c8b5e4b0d9ff00cbcc7fbe8ab43fd75af9524bfbd8bf7b58fb337a750f50d3fc6d1432cb1472ff00db6ff9e5fbdac9d43c492de6a92cb1fefa597fd5571f359dccdfbd8fcb862a9ad2ce5fb57951c7e77fd71ac7d99b7ef0b779af4b792c5147feb6596a1d274dbed4a5962b6f33f7bffa2aba5f0f7c37b9d4a5ff00498bc9fdef955f507c27f8336da3c514b2451f9b2fef7cea2a623d91b52c17b538af82ff0001ee7ed515f6ad6d1cde557bdfc42bc97c13f0e755beb68bc996d7f7b17fdfdaeebc33e1b8ace3fddc55cffc79d1e4bcf869adc51c7e74be57fa9af27da7b53e830f4a9525eccb7fb32fed99abebdacff64788e5b69b498bf75e74dfeb62afbae29bf75e6c75f8c9fb3acde4f8f350ff00590c51c5fbdf27f752d7ea5fc11f885ff0925aea1a1dccbe76a1a64bff007f62af730d50f9ecdb0d4a97b3a948f50a28a2bd13e74868a9aa1a0028a2a6a00868a9a8a0028a28a0028a28a003cea2a1ff0096d535001ff2daa5a8a8a0028a3fe5b514005435354340034e118ab7de1d68a28a00ab0ffd75a968a2800a28a2800a28a2800a2a2f3bc9a97cea0028a289a6a0028a21a2800a28ff005d52d004545152d004552d145001517fd32a2eef22b38bcd9258e18bfe7b4d5e3fe2cfdabbe1f7857ed71c7a9c9e22bbb5ff005b0e93179b41b53a556aff000cf609a68a18bcd925f2628abf3abf684fdaa25f8d9e37bbf0af873f73e0fd1ff7be77fcff004bff00c6ab6be3a7ed8d7df122d62f0ae8b63fd91a56a77514575379bfe972c5e6ff00aaaf983e1eff00a678f3558bcaf26597cdac6ad4fdd1db85c37ef7f7a627c52d0659ad74af2ffe3d3cdfded74be1387ced2ed6ba5f1978565bcf0bf9b1ff00cbacbe6cb0d73fe0d87ec7fbaff9e55f3ded3f767e818ca5ecaba34350d1ff00755caeb9e1b8bfe797ef6bd57ec7e7567ea3a3f9d589c2787ea1e158a697f791572977e03b6f365ff9635f404da0d559bc2b17fcf2adbda9c7530d4ea9f3a5d7c3db9b397fd1a5fdd79b56ecfc13abcd2c5fbaf36be85b4f0adb7fcf2ae9749f0adb43ff002ca3adbeb261f523e7fd3fe12ea7a95fff00a6cbe4c5e6d7a87837e06c5e77ef22f3bff6ad7b069fe1b8bfd6c95d8693a3c50c5fba8bc9ac6a624eca786a748e7fc27f0dedb4dba8a5922f3a5ff965ff004cabd6f43d07c9f2a8d0f47aec2d2ceb1362286cfc9ac4f1369bf6cb596293fd55761e4d656ad0ff00a04bff004ca2a067cc9fb32fc2bf27e2af8d7ed317fc4aa2ba8a2b69abe80b4bc97e15fc64d1357b28bcdd12fbcdb5bef2a5ff005514bfeaab3ff67bb3ff00895ff69c9feb6ea596ea5ae53e31de793e28d2bf7b2432c5179be75a7fd75ffd155e8e0aa7ef0f3736c1ff000e9d33eebd3ef2db58b086e6da5f3ad258bcd8a6ab75f27fc01f8f1ff08aebde20f08789fcc86d3edd2dd699343fbdf2a2ff009e55f4d693e2ad23588a2fb36a76d379bff4d6bdc3e36ccd6a28868a04145144340051451400514514005145140051351351fea68025a8aa5a8a800a28a2800a86a6a87cea0028a28a008a8a28a0028ff96d45140051451401154b51514012d14545e77ef68025fdeffcb4a28fde514004352d4552d0322a96b8af107c60f0d786ff0075f6efed1bbff9e3a7fef6bc53e217ed45756714b15bdcdb687179be57fcfd5d563ed4f429e5d88aa7d2dab6b163a0dafda751b98ed2d3fe7acd2d784fc48fda8adb478bcaf0e451cd2cbfeab50bbfdd45ff007ebfe5ad7cd5f163e2d5ce83af6a163712c9a8ea16b6bff1f7772f9bfbdae13e16d9dd78c3c5b36a7ab5cc9772dac5e6fefbfe5956552a54f667a3fd9b4e99db78cb5ef19f8dbfd3b5ed72e6ee2965ff0045866ff55ff7eab89d47ed3f6a965b697c997caf2a5f2bf75e6d7a8fc42f2b4d962b68ff00e5d62f2ab8e9b4df274bff00b655e454ab50fd272dca70deca9fb43c17c4337d8fc4715cff00aefb2cb14b5ab7737fc21ff1f6ee2ff5514b75e6c5ff006d7f7b517c42d37ec7acddc5ff004ca2a87e2f79bff09269fa9c7feb65d1ed6ebceffae517ff006aaf469eb48f93cc69f2e26a58fa0343f0dff695aea115ccb1c3692feebce9abcd66f0dcba0ea92db49ff2ca5ff5d5a10f8da5d4b4bd3fec52c90c52dac5fea6ba08741be9ac3edd73149ff5da6af22a53f667a0b11f5aa5ed0cfd26b57fb37ceacf86cfec72d741a7fefab90ccca9b478bfe79543fd835db5a59c534556bfb1ff00e79d6c2385fec1f27fe5956869fa3ffaaaeaa1d37c9a9a1b3fdeff00aaac4643a7d9c55d8693a3ff00aafdd567e9f0ff00d32aeaf4ff00f546831d4dbd3ecff755d05a4359f690feeab56186b63888ab94f1bde7eea2d22397c996fbf75ff6caba5d42f22d36d65b993fe59562e87a3ff6c5d7f6bc92c7f6b97fd5433507661bf897a868786747b6f0df85fcab68bc98bca8ad62af993c6fac4baf78b6eee63f37fd6f9517ff006aafa43e26ea5ff08af85eeffe58cb145e57fdb596be64d26cfcebf8bccff5517ef65ffb655ee61a97b231a953eb588d0eef49d4a59bc51fbcf2e6ff004eff005de557a043672c32cb6df6992d3f7be6c53435e69e13b3f3bc59a7c5ff004fd2cbe77fd728abd9a6b3f3bf7bff003cab1c4bfde9ee65d85c355a7fbda6741a7f8f3c55a6ea969e5cbe75a795ff003d7fe5ad74be1ef8fd6335d7d9b56b692d25ff003ff2cab8a87f7d15729f1a347fb67872eee638bf7be57daa2ffdab453c4d43e7b32ca6952fe11f5869fa958ea517fa35cc7355baf827c07f19b578658ac64b9fb5f9bfeaa69bfd6f9bff005d6bdc3c1bfb424b0e8369a9eadff1e92cbf65fdf7fad8a5ff00aeb5e8fb53e76a65b54fa1a8ae53c3df12343d7bfd5dcf932ffd36aeafce8e68bcc8ff007d5b1e754a55697f1028a28a0c428a2a5f2680229bf7d52d1450045351451400514514010d1451e75001454545001454552d00145145004535152d140115144dfeba8868025a28ae7fc59f10b43f04daf9baadf470ff00d31ff5b2d03a549d6d8e96b2b5cf12691e15b5fb4ead7d6da745ff004da5af04f1bfc7ed72f3f75a0c51d9e9f2ff00cb6f37fd2bff00b557954da3cbaf4b2dcdedcff68cbff3daee5ae4a9883e870d92d4abfc53e8bd43e3c5b5e79b17872dbed7ff004f777fba8abca7c4de36b9d7bed72eb5ae4977145ff2e9a7ff00aaaf3ff3ac6ce2fb3497d1c3145ff2ca1ad0d5bc49e1ef0df873fe59feeed65baf3a6ff9eb5c9ed2a553d6c4d2c36574bda1e2be32f8a9ae6bd7f776da74bfd91a27faaf26d3fd6cbff6d6a5f01f86eda6f16f852daf7fe3d2d62fed5beffd1b5ca7fc249a1de5fdac5e558c3fbdff00a6b5e83a878c3c3da3e8df117538fcbfb5c5145a7dafef7cdff5b2f95ffa2abd0f6479f4f32a7ecfda1e73e329a5f156b32eaf73ff00313965baff00b65ff2cabd6ff675d1fcefed097fe7acb1455e73a87c42b1865d3ec7f77e5476b145e4ddc5ff004cabe86f8170e9167e12b4be922fb279be6dd7ee65fdd56589a7fbb1acca9fb5548e53c59ff13ef144b147ff002d6eaa5f1969b2e9ba5cb14917fcb5ae6bc4de2a8a1f14795a4cbfbdff005bff003d6ba0d73e2158ff00c21b692dcfd9bfb43cdff9635e47b33f47a598fb299e35f17b41961d434abe922fdd5d45e54b5535cd1edaf3e12f83f57bd97ce96c65974aba8a1ff3ff003cabbbf167893fe130f046a114915cff00a0c5f6a8a6ff005b5e1fa7ea52f8abc2fe25d223f33fd57f6adac3ff005cbfd6d7af86a7fbb3e0b3ac6df13fba25f843af7fc4e6ef43ff005d2dacbfe8b0ff00cf5afa6e1d374cf0ad879bad4b26b9e20ffa07c32feea2ff00aeb5f1ff00866697c2bf11bc35abc72f93f6efdd4bff00a2abe85d5af2e61bf9743b697f7b2cb14b2ddffcb596b1c4d336cb6afeefd91d5dde8fe745e6795e4ffd31f37cdf2a8b4d36587fd5ff00aaa3499b4cd06fe2b6bdd4eda1bbbaff00974f37f7b5dd43a0f932ff00aafdd57875299e8d432b49b3ae96d34dfdd51a7e8fe4cb5d5e9fa6d232d4c4fec18aa2fec1fdf7b576bf63fdf7faaa8bec7ff4ca998fb43948747f26b5b4f86b57ec71d5bb4b3f265a03da12da435a1fea6a2861ae7fc65e248b4db5f2bcdad4c7f8a71ff133c492de7fa0db45fe89ff002d6aa783bc49a9e8f75f6992e7ced3ed62f365866ab769a3dcfdaa59745d723bb965ff00987cdfba965aa9e3cbcb6d07c2f37da6dbfb235b8a2fb54b69ff002caebfe79455e8e1a90b1d53d961ad4ce7fe297c5ab6f125fda68727fcbafef6ebfe7ac52cb58969a0ff0066e8de6db4bf6b8b5397ecb14dff003ca28bfd6d7cf5a4c3a9ebde2df37cdf26eeea5fdeff00d32af70f0478f229ad756d4f51fdce9f6b17f62e99fbdff5b2cbff00dabcdaf72a61cf93c1e26ae1b73d03e18c32de788e297cafdd7952dd7fe45af4b87f7d2cb589f0774dd32cff00b56593f7dfeaa28bf7bfeabcaad0bbf891a66837d776dfbbff005bfea618bcdaf9ec4d3f6950fd3f038da74f0c6ac356f56862d4bc392c72fefbca97ff0021567e9ff12343bcff0059e5c3ff005da2f2ab6f43f12687a979b147751ffa57eebfd6d65eccc71b89a75699f155dfda7c37af5ddb492fef6d65f2abd6bc330ffc249a5eaba47eeffe2796bfda16bff4caea2ff32d735fb455e691e03f16c5abdb797e55f45feba6fdefef6b3bc33f1e2dacf46d275392293cdd32fbfd77d962ff0096b5edd3a5ed3f787c97f6b5226bbd62fb4dfecfd4ecaeae619658bca97c997fe5ac55ee1f02fe306a7a9452db497d243776bff2dbfe7ac55e5ff10b58f0ad9eb3e25d33ca8e1fb2dd45a845fbd962fdd4b59ff09fe21786acfc656b1472db43f6afdd7fad96b3a94ff762c466386abb9f68693f16bc9bafb36ad6de4cdff3da1aeef4fd7ac752ff008f7b98fcdff9e35f3ceb9e24f0f4d169f2fda6387cd8bcafdccb45a4d637917fa16a7587d62a5236fecec362a97b5a47d2dff2c68af19d13c79ae68f245149731ddda7fcf19bf7b5e81e1ef1e58ebdfeb3fe25d2ff00cf19abae9d5f6a78788c154a4757451456c79c454514500150cd535434005145135001451450055a2a5a28022a96a2a28025a28a8a8009ab3fc43af58f86ec3edd7b2f9317fe8dacff001978f34cf04e972df6a327fd72861ff5b2d7c09f1fbf6a2d4f52bfd43ec52ffc4c22fdd45e4ffaab5ac7febd9e8e1f0ded3f7b57f867bafc48fda2b53d4b54feccd36fa3d0ed25ff00c0baf2af10f8dadb4797ca8e59357d425fdecb34d5e55f02f47ff84aaeb50d4f5ad4e5bbd42faea28bfe7acb2d7aac3e0fbebcbababe8f4c8ed22ffa086adfbaae4a87d0e53355aa7eebf7671f7779ae6bd7f17fac86d25ff9630feeab6e6d1f57ff00967e67fe055686b90e8767e54b7babdcf88a58bfd55a5a7eea2ad5d27ecda95af9bff08647e57fd31bafded647d49ca69fe15be87cdfb4f970ff00d76baad0f8c7e1bb9b3f045dfd9becd3795a64517ee65aeae6874386ea2f33c217de6ffd7d573ff1faf3c19ff08bea1e65b6ada74be6c517eea58a5aebc31f2f9fd4a7ece99f2ff84fc2ba9de78bb4f8becdff002f5156ddde83733780f5bb993cbb486fb588bf7d34bff3cbcdff00e3b5a1e039bc2b0ebd2dcfd875bbb862b5965f3a697fe995755a87fc23d0fc2ff0a7d9bc357d77f6ed4eea5ff4b97fed957b47cc2f67eccf2ff891a3dce9baf5df97e5de45feabce87f7b5eede0df0ddf43e08f2a3b693f756b1455e69ae43a1eb1e23d425d275c9343965baff008f4d43fd57fdfdafa02ef4dd22cfc2f77fdade2e8ffe597fc7a79b2d79f89f69eccebc2aa7531a79d784fc3773378caee2fec8fed79628bfd4c35abe26f0af9daa45fbdb6b48bfe78cd2fef6a2f06de58ff6f5dcba76a773a445ff002ca6f37f7b2d761e21d4b43b3d53fd2743b9d5f50f2bf7b37daa5fded795a9fa19ca787b4dd32cf4bbbb693578fcd9658bcdfdd79b157cd5a7de4be1bf1bf9ba745e74b15d7eea187fd57d965afa83c43e2a8b47d0750b9d3bc216d0cbff004f7fbdaf9a7c4df66f37edd652ff00614d7517d96fb4f9bfe797fd32af5b0c7c0e65fef21e3cd1f4cf01ebd2d8e9de5eb92f9b16ab16a1ff002cbcaffa655e9779e30ff846fc1bff0009549e64d777d17d974c866af24d5b58b6d4bc11fd99feab50d1e5f36d66ff009fa8bfe5ac55d0789af3ec7ff0aeb4cb9f2fca96c7cd8bfefed658832c354f6557da9b7f05ff00b4fc37e2dbbbed7bcc9aeefbf7b16a15f52f84fe24699af6a9fd912c5feabf75f6bffa6bff003cabcd750d36da6d074fd0f4efb37d92ea58bcdbbbbff9652d79ce93a6cba3f8f2d34c92fbcebbbaba96d6fa1865f362ff00aeb15785fbbf69eccfb8a9529e297ee8fb826f04df59ff00cb8c9e55685a69be4ffac8fc9ffaed5d07c11d7a5f1578222fdef9d2d8cbf65966ff00ae55e81e4dcffcb48abafea47cc6271b52954f6550f2ff00b1d4577675ec10d9c537facb68ff00efd54bfd8f6dff003e36dff7ea9fd48e3fed13c6a1d36b42d347966ff576d24bff006cabd821d1eda1ff00576d1c3ff6caadc30d6bf520fed13c7ef3c2ba9c36b2dcc914769145fbd9669abe64d43c6d2ebdaa4b73a75f7fa25acbfbaafac3e2f78da2d363fec8b2fdf5dcbfeb7fe9957e7cfc52f0acbf0af5e97c4be189649bfe7fb49bbff552d7254f674aa1f5b9561b1189a5f5a67bb787a6b1f1245ff13697f756bfbdfb5c3ffb57ff008ed79ffc74f155cde7d97c2bad5cf9d2cb2f9b6ba879bfeabfe7954be0df885a1f8abc072f88745b9f27cafdedf5a4bfeb6c7caaf9fed352b9d7bc45e55ef9935a6a775fea7fe797fd72af6f054ffe5e9f1d9b621e2313ec8f46b5d06e61b0b4b6d5ac64fed5d63fd16c6eed3fe5ac5ff2d6ad7c4dd362f0ddd69fe1ed3ae63d4744d0a2ff008fb87fd54b7f2ff9ff00c855d0784f58bef01e97e20f12fd9a3d73c35a67fc4ab47b4bb8bf7be6d71fae7d874d8b4f9749befb24b752c5757d69a87fcb2f36bb0e2a9ff4f0f60d0f41bed37c25a24524527dabecbfbdfdd5450f83efbed5f69922fb245ff3daeff755e8b369bff12bb4ff008aceda1b4ff9edfbdac5d42cfc2367179b73abea5abcbff3c618bcaaf0ea7b43ee72ea94fead4cc9ff0084565ff972b9b6bbff00a630cb469fe1bd5f4dba8a5fb0c9fba97cdadb86f3c2b791795fd917da445ff3f70cbe6d4bfd9be15fb57eefc5f7d0cbff005eb2d2fde1e85654ec7857ed61e15b9874bd3e5fb3490f957f2c5feaabcd3c33a0c579e0dd6edbfb4ec7cd8bca97fd6ffd35ff00edb5f45fed55a6e8f37826596f7c4b26a31457514bf6486297f7b5e29f0f752d32f2d750b18fc0ff00ba96c65fdf7daa5f37f755ec52fe11f99429d3f6a74df10b41fb678df4a964d4ec61fed8f0ec5ff2d7fe997ff6aaf29d0fc377367ace9f736d736334515d452f9de6d7b8788752d0e1bff869731f83259bed563f65fdf5d4bfbaf2a5af2fbb9ac7cdff00910bcaf2a5ff009fe96ba7a1ad4a7ed29ff0cfa5a1f0af9da0fef2fac61f2aebfe7aff00cf58ab3e5f0dea70fef6cbcbbbff00a6d692f9b5d8786752fed2f0979b6fe0cb1f2a5b58a5ff004b97cda8aefec3e57fc4c7c2b73692f95febb4996bc03ecb29ff0076fe19ca43ff0009559ffabfb75741a4f8f2fbfe3c75a8a49ad3fefd4b1554d3ff00b226ff0057a47883febb7daab561b3b6d621963b2b9935797fe81fa87eeaeffed9565a9ebd4a54cf5bf09fc66fec79a28f5197fb474497fd55dc3feb62ff00aeb5ecb69796da95ac5736d2c73452ff00aa9a1af8aaeb41b99b4bd42daca592196397fe3d26fdd4b15741fb32fed21e77fc53daf4be4dddafeebc9ff9ebff004d6bbe91f0d89c3afac7b3ff009787d7752d55b39a2bc87cc8e5f3a297fd54d52d6c788f4766145145020a86a69aa1a0028a28a00ab454b45001451450015e5ffb427c60b6f833e08fed7b996386eaeaebecb6be77fcf5af509bfe7aff00cb2afccafda97e365b7c48f16eaba9dcc5f6bf0fe99e6e95a15a4dff002d65ff0096b7541ad3fe219fa87c4ebef8e5e3cd2adae6fae61d2afaebca965ff96b751455e69e26d37fd165d4ef7ccd222babe965f266ff008fb97feb9455b7f01a6966f19787edb4e923d3a2ba8a5f2b519a2fdecb2f952d735e21bc8bfe11cd3ee7cc92eeefed52f9b7777ff6cab6a54fd91e8d4a952a7ef2a1ef5fb32eb17d0e8d17d8a5b6f0eda7dbbfedad74b77fd91f6a97edb737dabcbff4dabc57f67bbcb99aeb508bf7934be6c52d7bacdf0f7579b5ebbff468e18bcdff009eb5e6e27f887a590d5a74fda1cd6ade24f26d658acada3b48bff22d627866f259a2f37cd93fd6d7a06a1f0c7ce8bcdb9b9ffbf3156afc11d1ec61d1aeed6e658e1f2aea58bf7d15727b5a67d6fb4ab54cad2758d4fed5696d1dcc9feb62ff0096b5e75fb4a78f353bcb0b4b69258ffd2aea597fd557d4ba7fc3db6bcd522b98eda39bcaf365f3ad25af9ffe3a7c378a6d7b4ab6fb0f9dfe8dff002da5aecc37b3f687c667788abed29d23e74f0cebd7d0daf8825fb749ff001e3e557a06a1ac5f4361f0bf4cfb749feabed5ff007f65ad687e15db59f85f5bff008967ef649628bf732d775e2cf8576d0f8b7c2963f61b9ff89668517efbcdff00a652cb5e8fb4a67914e757f767cdff00dbd16a57ff00f131b18eee5965ff005dfeaa5afa43c4dac58d9f84a5fb36991c3fe95feba697cdff009655e2b69f0c7cef11e9f147732c3e6dd45fb9962ffa6b5ef5e26f87b2c3a34514973ff2d6597c986b931becceccbaa54a98ea679ffc3dd36fb5ebabbbe8eda4bbfdeffcb18abb0d735ed4f4d8ad2da396487cafdd793e57faaaeafe05d9d8e9b632c52799feb6bbbf197c3db1f125afdba3f326ff00a6b0d791ed0fbfb55a5fbc3e59f89ba95f5e782350f32e64ff005b5e3fa7de4ba9585ddb5ec51ea31456375e579dff002cbf755f55fc42f86317fc2bed57cb8ae66fff00755e49e0df86f1f89346d57ecd6d24377fd9975e54d0ff00d72af5b0d529fb33e171d52afd74e2be1be9b15e785e5b6b9d0e4fb5df45fbad4268bfe597fada35cf0de87f10ad6d2e7edd25a7f6645f65b5f3bfefed657c52d07e2359e97e1ab19648e1d3e5b1965f2ad3fcff00d32af40f865e039752f06c52dbc5f6bb497fd6f9347b3ff97a7054c453bd3389b4f157887c37acfd86f7cb9bed51795fbeff0055755e8da4e9b73a6cb16af25cc7e6cbff001e3e4c5fbaf2bfe7ad794ff694be1bd53fb0fc576d24da55d4bfba9a68bfd557adfc37d36e61bfb48b4ebe8fc45a57fcb2d26eff00d6d79fece9dfda9f57877f555fbb3ee5fd99747ff846fc07e57eee2f365f365af66f3a29abce7c07a3df68fe1cd3edae7fd6f95fbdaeae1f361af5a91f3189a9ed6afb43a087f7356fceae7e19a5ad086696838cd0f3ab3fc43ac7f63e8d777dff003ca2a96b9af8a5e6cdf0fb5b8adbfd6cb6b40e97f151e1fab432ea52dddf7da7ceb5965f36597fe5ac55e73e26f87b73e30b096c74ebafec88aebfe78fef6596adfc3df1b4b792c515effc7a4bfba966f2bcdffbfb5daf8dfc61a4783f41965b2b68e1962ff5569ff2d6eabc3f6550fd26b6754e8d258647c8bf163e09ea7f006d65f12f872fa49a2ff557d0ff00cfd554f06c3a478abc39a878bfc392c914b145e57d921ff9652cb5e8ba869babfc4eff0049f15ea71c3a7cbff2c6be7af885a6df7ecf7f1434ad73c176d2cba7cbe54b2da5dcbfbabaaf470f7a7fba3e5f30552ff59a87d17e27f0dd8ffc2bef0fdf7f69c90cb6b2f9b2e9f0ff00adff00a6b5e09e21f127f6c6b315ceb517fa5cb752cb2c30feea597febad5bf197c7ed5fc5516a1ae49e158e1bbba97cdf3bcdf2bca965ff00f755cfda69bae78abc472cb73fbe962fdd79d37fcb28abaf074ea53fe29e6e32a69ed4fb6e1d6348bcf0be8973269924de6c5ff3d6b3a6f15450c3fe85a65b5a4bff005caade87e09d5ef3e1f786bcbfb37fc7affcf5ab70fc2bb99bfe3e6e7c9ffa630c55e7d5f6773ea72dc47fb353312d3c61a9cd75e55ccbe745ff003c658aadcde2ab6f37f79a458cd5d85a7c2bb1862ff5573ff5dab3eefe12fef3f777de4ffd768ab1bd33d17883ce7f68ad622bcf873a84b6da65b432fd96297ceaf9abe1eebd7d3788e2ff004993cd962962ff005bff004cabecbf89bf0aff00b4be1f5dc5f69926ff004197f730c55e09f0b3c1fa669baa695f6db5b187f7b17fc7dffadaf5b0d529fb33f3caaaafd64caf167892faf3e1a7c3ab992fa4ff0045d4eea2f3bcdffa6b5e5fab4d2ff6f6a1179b27fad96beb0f10fc31d326f82d2c51d8db4dfd99e22ff9ebff004cab89f10f86f4cd37c51a87ef6c6d22965f37f73fbdff005b5d7ed0cfd9d5a94ce9be195e4b79e08b4ff96de6e995ab69797d6717eea5921ffb6b5eb7f05f4db1bcf06da797736dfeaa58bfd556d69f0e877914b6d25cc737fd758abc3ab50fa6c93dafb3a88f9ead352bebc9a5ff0049b99bfedad74b69ac79d1795a8c525dc5ff003dbfe5ac55e97a1d9e9167a85dc5e6c7ff006c62ac4f137827ed92cb73651470ddff00e8dac69d43e9ea54a94bf8a45a1eb1fda5a5ea115cff00c54569145ff5caee2fded7cdfae69b6d0fc41bbbeb2befb5da7dbfcafb5ffcb5b5ff00aebffc76bd96d34dd4f41fb5cb73149692d7cf5378aa5d4be235ddf5b4b1da6a12df79514dff002caebf7bff002d6bd7c31f0d98d5ff006efdd1f5dfc0bfda2a3d1ed74ad235eb9f3a6ba8bff22c5feb7caafaaad2f22bcb58ae6da5f3a2922f362afcd5fb1e99368de20d5ee6c7fb0f50d3358f2a2ff96b69fbdf37fd57fcf2afb3ff00665f184baf780e2d32f64f3b50b18a2ffb6b14bfe65a7ecfd998e27d9d45ed3fe5e1ec34514523c921a28a2800a28a28022a28a2800a28a2803c93f6a0f184be15f855a85b5b4be4ea1ac7fc4bed7fedaffadafce5f0f7856e7c61e3286e6cadbcef0d6992f956bff3ca5afa03f6e7f89d73378f22f0f69d2f9df61b5fb2f93ff4d65ff5bff90ab43c27a0e99e09f85517972fd93508ad7fd4cdff002d6596b92a55f647652c155abfc33e69b4ff00890fc50f0d5cc7ff0020ff00ed397caffb6b2d5bd5bc072f9bade997bfb9fb2ea7fbaffae55e81f123e1bc5a3f8234ad723fdccb17ef6ebfe9956878f3528af3c5b2dce9dfb98758d1e2d4229bfe7acbff00ef62ada9626f4cf42a60aafd63d9d32a7ecf7676de15f194ba65ccb1da7daad7fd4ffcb5afa5b56d7adaceea2963b1f3a2962fdef9d5f14f86758fec1f895a25f492cbe54b2ffae9abecbd42cfed9a0c52ff00cb58a5ae3c69ebe4b86a74b13fbd22f10f892e7fb2e5fb37970c5e57fcb18abce7e0bde4b7961a84b24be77fa74b5d06ad79e4e8d2f992feeab95f817ff201bbff00a6b752cbff00916bc83f50f654a9d3fdd1ed5a1cdff1f72ffd3acb5f2ffc74bc96f3c792c5fbdff45b58abe96d27cdfb06a12ffd328a2af927e2f5e79df1075bff00a652d7a3863e1b354beb2169e6ff00c225696dff003fda9f95fb9ffae5ff00db6bbbf1e6a52c3f11bc6b7df69ff8f1b5fb2c5ff90a2ae53c2767f6cd63e1fd8f95fbabad4fed5e4ffd32f362ff00e35536ada94b7961e30d4e4ff97ed4ff00f6acb2d7698597392fc3dd7afaf3c65a25b79be77ef7fe5b45e6d7b2fc48f125cff6345179be4feea5ff00535e2bf0861f3be20c5ff4ca2965af4af8b179e4d8795ff3cad6b8b1b50db29c353fae9a1f086cff00e243149ff3d6bd1bce961b097cb96486b8ff0086f0fd8f41b48bfe995761feba2af38fb438ff0010cd7d79e17d42292e64fdecb5f2cfc1cd4a587fb6ff007be54b158cb5f5b6a10f9da0ddff00d7d57c69e089bfb375ef12db7fd3297ff46d7a3863e431c97d74f75f13795ac7873c292dedac777ff127bafdf7faaff9eb595fb1febd6da94bade877b147e545e5795e4d74b770f9de07f05797ff002d74cbf8bff46d78d7c17d7bfe103f8b514b27fc7a5f7fa24b5d953f867cfd4c352e43d6fe297c37f0f78aa5d434cb9fb4ff00d32fdd57cd3a1de6aff04fc6f692c92dccd696375e6c537955f65fc4d87ec7e28b4be8e2fdd5d45e6d549bc07a478dac3fd2628ffebb5791ed3d91f7b4b0386ab4a9d43d83e0e7ed21e0cf891616915b6a76d69a84bfbafb24d2d7b5f93e757c29a87ecf7a668fe56a7a2fee6eed7fe78d7d77f0df5eb9d4bc25a54b7bff001f7e57952d7a386c4fb53e373bca69e069fb5a47610c3e4d5b86a1ff005dff002d6a686bd13e2c96b13c430fdb2c258bfe7ad6b4dfea6a1f27f7540cfcf0f8b1e1bd4fe1bf8b6eee6da2ff008955ccbfbdff00a65ff4d6b6bc27e0fb9d7b4b8b5cfb4db5df9bfeaa69bfe5957d37f17bc136daf584be6455e49f0de18bc37e1cb4d33ecd6de55b4b2ffae8bfe9ad79d88fdd1f5994d2fad5439a87c2ba9ffcfb4934bff4c6bca7e2c78565bcf16f86ac6f628ff75e6cb2c334b5f5843e24d3268aeffd07fefccb5f32fc7e9bed9f1574a8adbfd545a679b4b0d53f7876e6d82a9529fef0d5d5be18e99ac7c39d56fbcab19becb2d87efa1ffb7aae53509b4dd07c51a8456d6d1cdfeabfeb9576de77fc59bf15ff00d32fecb97ff46d79cead379de23965ff0096be545ffa2abd2f6a78f4f2ea763ec6f01ebd14df0d34497ec36dfeaa2ffd1556aeb5eb9ff9768e3b4ffae55cafc2d9bcef84ba57fdb2ff00dab5ab5f3b57f887da65386a5f572dc3a95cf9bff1f327fdfdad5875ebe87fe5ad73f0d5bf3ab13dca94a91a1e26d4afaf3c25e579bff3d62af83fc3b37d8f5097f7bfbd8a5afbaa6fdf6832ff00d3296be1ad46ce5d1fc6faddb49ff2caea5af5f0c7c662297b2c4d43dc2ee1fed2f097c45d33f77fba96d7508bfcff00db5af24f1643e4ea9692f95feb2d6d7ff4557adf87bfd32eb5bb6f37f75a9f852597fedac5ff00eeabcbfc590f9d61e1f964ff009f5f2bff0022d760aa7fcbc3e80fd97f528af34196293fe595f56df89e1b9d0754fb4c7feabcdfded79a7ecdfa9793fdab6de57fcb58a5af6bf194315e4b771578f89fe29e8e4953f7950e6749bc8af2ea5962ff0096b5d5e93ac7d8e2f2a48bcd8bfe78d79a78666f2754962aeeff00e9ad721f51569d2a8bf7a5bf1943633781f50b98e293fe5acbe4ff00cb5af83ffe103b9b3f11da4b1f997769f6af37ceff009e55f557c79f124ba0e8d6ba65b4be4cb2f95fea7fefed79af87b58b6bcb0d42faf62fb25dc56be579dff2ca5965fdd57d1e1aa7b2a67e4b8ec17b4c4fb5a4713a4ebd2d9fc25d422ff5d16a7e22b58a2866ff003ff4d6be90f839af5f780f59d1353bd8a4fb27fc785f7fd7297fd57fe45ae3e6f8576ba96a9f0eb48ff46862b18a5d6aea687fe9affaaf36bd6f5cb3b19ac350b1f3649bed56bff916954c4fef030f85ab89c354a87d3750d735f0b7c49ff0987c3ed1353f37ce9658bca97febac55d2d6c7ce84d5154b517faea0028a28a008a8a28a002a1bbbc8b4db596e6e3fd545179b2d4d5e3ffb5878f3fe103f80fe25b98e5f26eeea2fb2c5ff006d681adcfcff009b5897e277c789753b9fdf7daafa597fcffe42af6af8d179f63b0d2b48ff00ae52cbff006d6bc97f65fd07fb63c79777d27efad2c62f2bceff00c8b2d755f163529352f16dacbff3d6eabc2c4ff14fd3787f0ded554a87b5eb90db6bde03fb0ead17eebcaf2bce86be7fd43cdff857de14be925ff4bd0f539745ba9bfe997fad8abe80b4ff004cd07caffa655e350e9bf6c9bc61e1affa09d8fdaad7febead7ffb553c3543d3cd703eca9fb5a478ff008ca1fecdbaf2a4ff005b6b75febabed0f86fac7f6f784a2964ff0097ab1f37fedad7c69e3cff00899785f4abe8ff00e3ee58becb2ffd758bff00b557d21fb2d78922d63c1ba7ff00d3acbf65aebc47f08f97a3fbac4a343e214df63d1aee5aa9f05e1f27c1ba7ffd358bcdaabf1a2f3fb3741d42dbfe5aff00aaadaf01c3fd9be17d3e2ff9e56b1455e41faa2fe11e976937fc486eff00e9a4b157c7fe3c9a39bc5badcbfbdfdedf4bff00a36beb0fb6793e1c8bfe9acb2cb5f1fead37db2fe597fe7acb2d7a5823f37cc7fde6a1ddf80bf73e28b497f77ff123f0cdd6a1fbeff9ebe57ff6dae7e69bec7e08d3e2ff009faba965ad5d27fd0e2f88b7327ee7cad32d74ff00fd15ff00c6ab13c43fb9d2fc3f6de6ff00aab1f37fefecb5d828ff00cbc3abf8170f9de28d42e7caff00556be5574bf17a6f3aebecdff2d659628aaafeceba6f9d16ab73ff003d6ea28aa5f1e4dfda5e32d3edbfe7add579989fe29eb648bf7952a9e8be1987c9d2e2f2eba0866fded67e930f936b14545e4de4cb15721f525bd421f2741ffb7aaf83f50ff896f8deee5f37fe3ebed5157e806a10c5fd8369ff004d65965afcff00f134324d7515cffcf297cdaf470c7c063aa7fb49f45e9f379df0e7e1a4b1f97fbd8afe2af1fbbd1e5fedeb4fddfef7ed5157a0786758ff008b5ff0ebfe995f5d45ff009162ac4f1943fd9baccbe5fee7cabaaf44e4ff009767b86ad34baf7c3ed3ff00e82163fbaaa9e07d63ed917951d7417767ff0012596e6dab959ace5d36ea2d5eca2fdd4bfeb61af9d3ee32da9fecc7a04de6f952c5ff004cabd17e195e7fc5391799ff003d6bcaa1d62da6962fdeff00adaf55f86567ff001497ef3fe595d4b5d782fe21e467ff00ee47a2da4d5a10d73f6935741695ee9f95134d52cdfea6887fd7517740ce2bc650f9d612d7ce934d6df6a96293fd54b2d7bafc4dd4bfb3746bb96be7f8752b6b38bcd922f3bfebad79d8da9ff2ecfd1385f0dfc4aa6dcd7914317d9aca2ff5b2d7cf5f162f3ed9f15755f2ff00e5dad628abdd7c3d0c5a94bf6eff00bf55f3d789a6fb678dfc4b2f9bff002d6b9305fc43d7cdbf867a2da432ff00c2aaf1dffcf58ad74baf34d5bf737f14bff4ed6bff00a2abd2f43ff910fe25db7fd432c25ffd155e5fae7fadd13f75fba96c62af5cf9c5b543e9bf82379f6cf85517fd3297ff006ad74b5c57ecf7379df0f7558e4ff9652d76b5e1623f887d1e53fc20a9619aaad4b0cd589ee1a169fbed2f508bfeb94b5f1d7c52b3fb1fc4bd6fcbff009ebe6d7d95a4ff00aad422ff009eb6b5f27fc68b3ff8b8d77ff4d628abd1c31f17997fbc9d37c37d4a28759f054b27faa965974f97fcff00db5ae53c6f672d9e8369149feb6c6faead65ff00c855169379f63f0e6952ff00cb5b5d63cdff003ff7eabbaf8bda3f9dacf8c228fcbf2bed516a117fdb5fff007b5da67a98bf006f2587c51a845ff2ca5b5afa2b5cbc8a697fe9acb1455f32fc179bec7e3cd3e293fe5af9b157d21e26b3fb1fd92e63ff009f5af371bfc43ab29ff793cff43f37fe123bbffaeb5e95a1f9534b14b27faa8bf7b2d797e89fbed7aee5ff00a6b5ddeadac45e1bf06dddf492ff00fba8ab9291f4f9954f6548f04f8d1af7f6f78de58bcdff008f58bf7bff005d6aae87a6cbac7fc23fa47fcb5d4eebcd97feb97f9f36b94d3e1b9f15788ffe78dddf5d79b5e97e0d87fb4b54f106a565e65a79b17f62e99e77fcf597ff00b579b5ee1f114ff774cf45f0443fda5acf883c43ff002cafaebcab5ffaf58bf75157417737932c527fd35ab7369b6da3dae9f15b45e4da7d962f2ab27569bceb5af22a54fde9f6386a54beaa74dfb2febdfd9be23f15f856497fd55d7daa2afa2abe2ad0fc49ff00084fc73d2b53f37c98afad62f37fe9affcf5afb43fe58d7bb4ff00867e438ea5ecaa92d45451356a79a4545145004344d45140057c4bff00051ef1e79317853c2b1cbff2d7ed575ffb4bff006ad7db55f975fb666bd2f8dbf696bbb18ff7d15aff00a2c5ff00a2ab236a4775fb3868ff00d83f0d2ef53922fdedf7fcb6ff00aeb5c87c42bcff008aa34fff00aeb5eb50f95e1bf09695631c5e4ffa2f9b5e35e329bcef11da7fd75af0aa54f6b50fdaf24c3fb2c11f48787a6f3b4b8bfeb95792789bcdd1fc5135f4714934ba65d45a87ee7fe797fcb5ff00c855e97e139bceb08ab94d7218bfe13296da4ff8f4bab596d65ffb6b58d3fe21d78dff0076a8792f8df41fb1df7897488e2fdd7fc856c7fe9ac5ff00eea5ad0fd9135efb1eb3ade8724bff004f714352f886f3ced1bc29ae492f9d0d8f9ba2df4d0ffcb5f2bfd57fe42ae53e0bd9cbe0ff008fb158decbf64865f36d7ceff9eb5eeffcbb3f31c4d5b429d53ddbf68a87ed97f696d1ff00cbf4b17fe45af40d3fc37730d845fbdb6ff55ff3d6b89fda126d32197c1f247149772fdabcafdf7fd32acaff0085a917d962ff008967fe4d5791eccfb2a79b7b4c2d3f647a878cb4dd4f4df0bf9b1c71feeac6597f732d7ca9a7f83f539b54b48a4b693f7b2c5157a07c6ef8c16d0e83a85b7d864ff9656bfb996bc5749f891e4dd4b2c715cfeea2965af730d4bf747e6d5b36a957127ad4da3dcffc2b9d6efbf7717f6e788a28a2f3a5ff009651567f8df47b98759bbb68fcb9becb1456bfeb7fe7945595ab78dbec7a0fc34d0fec3feb3fe2612fef7fe7acbffc6abcff005cf89d2ea575772fd87f7d2cbe6ffadadbd907f6954f667d81f007c2b7367e128a593ecd0ffadbaff5b5cd5d69bff171b4ff00b4f973795e6cbe4c32d1e13f1e4ba0f80e2f2ec62fdd58c517efa5af3487c5573af78b6ee5ff0053145ff3c6bc8ab4ff00787d3e498da9f56a87d61a7c3a65e45e57ef2d3ff22d45ae786e59a2f36dae6da6ff00b6b5e29a1f89353d36ebf777d27fdb6ad5d43e275cf952c5258c737fd7196b2fab1ee53c76229a3d6fc59a6df59f836297caf3bfd16597f735f126a1e1bb9f2bf796d27ef7fe9957d01f123e2d4567e0897fd1a487fe259145feb6bc17c3df10ac752bfb4b6fb4df432cb2c55e8e1b0c7c0d5ccaa7d66a1abe19fb4ff65e95a679527fa2ebb7517faaff00ae55b7e3287ed9acea1ff3d62ba97ff46d733378dada1d525b98f5393caff849bff46d757a4f8db4cf156a977149731ddfef65ff00a652d75fb235fed23dd74f9bc9d06ee293fe997faeaf2ff1378abfe273a7f87a397ec9f6aff55ff4d6bdc66b3d221b097f7b730ffaaffdab5c278dfe09f86be215845f69be921bb8bf7b14d1455f315691f7594e370d5704794f8875eb9b3f14695a669363a95a45ff002f5f6b96297cdafb2fe0bcdf6cf06ddc527fcb2baaf9ff00c33f0c6c7c2b14bf68d5ee75197fe7b4d179b5eebf05ef2dbcad56da39649bfd54bfbe8ab5c0d3f6750e3ccbd9fd4bd9fb43bb87f732d741a7ff00aa35cfcdff001f55d069ff00ea8d7d11f9a9a10ffa9aa97737eeaadcdfb98ab2b509bc98a81efa1e13f1d35e966bab4d323fdf7fcb596bc174386fbc55e2c96c6e65f274f8bfe58c32fef6bd57c4d79fdb1e2dbb97fe9af955cfda783edb4df16e95abdb7fadfb2dd4575ff7f7f75ffb56be7b13fbda87ed594ffb0e0a9d33a586ced6cec3cab6ff00965feaabe5af10fee7c6fad7fdb2ff00d155f4dc30f932cb17fcb2f37f755f3d6b9a0cb378cb5596496da18bf75e579dff005cab5c17f10f273eaaa97b3f6877fe07ff004c8bc4b6dff3fde19f37fefd5797eb734b3586892ffd3acb17fe45af66f86fa3c536a9a7c5f6e8ff00d2b42bfb5ff552ff00d35af34d73fb32cfc25a7cbfbcd4658aea58bfe7945ff2cabd7f667c9d4c761bf787aafecd7379da36b717f9ff00555e970c3e74bfbbaf34fd97fc556dfda9a858f9563feaa2fdcffdfdaf4bd43e215b69bff2fd6d0ffd31b4af37134ff787ad94e6bfbba85b8741be9bfe5da4a961f0ddcffcf58e1ffb6b5c55dfc5ab1f365fdddccd5930fc5a97cdfddd8c7ff7f6b2f667aff5eaa7ade93a0df7dbff00d57fad8a58abe74f8fde0f97fe123d3ee64b9b687cdb5f2bfd6d7a343f16bec77569fe8327fad8bfe5ad78a7ed15e3cb9fb2da797631ff00a2dd4b17fadaebc353fde1f239de36a7b4a667ff0060db7fc21ba87fc4cadbfd16ea297fd57fd75af55f1bc3a65e78a34aff00899ffc863428bfe597fd32af96b43f885a9de697e20b6fb35b43fe8be6ff00e45aec35cf891abfd83e14ea7e6c70feebecb2feebfe794b5ebfd5cf23fb4b11fbb3abf0f69ba668faf69f7dfda7feaaea297fd557d55ae59db5e69717977d1ffcb5ff005d5f9dfa878db5cfed496dbed3feaa5f2bfd557d41e21f89da9e9b63145e54737eeabcec6d23b329c7627eb274de1fd07ceba965fb75b7fadff9eb5ca7c79d625d1f41b4d0fcdfdedd4bff002c7fe79573fa1fc4e96cff00d658c737fdb5ae53e276bd2ebdacda5f476d243e6c5e545ff5d6b8f0d4ff00787d6e371553154fd9957c3d34ba6e8daaeaff00bb9a58bfe25f6bff005d65ff005bff0090abb09b52ff00843eff00c15e1e93fd6d8dd45757dff5d65ffed559fe19d365ff0084a34ad32f658ffb1343fdedf4dff4d7fe797fdfdf2a2ae3f5cbcb9d4bc47a85cdccbff130fb54b2cb5d879d5363ebad72f3ced1ad3fe7ac52cb1573ff00ea6d658a8d0f52fedef095a5f7fcf5f2bff455450fefbcdaf08fb3ca7fdc8e13e2c4dfd9b6be14d5ff00e7d6ea5b4afb43e13ebdff000927c3ed12e7cdf3a58a2fb2cbff006cabe3af8a567f6cf873a84bff003e32c52d7b07ec73e30fb6787350d0e497f7b17fa545ff00a2bff6957b987fe19f9de754ff007b50fa428a8aa5aec3e488a8a28a00a947fcb1a968a00aba86a5169b6177732fee628e2f36bf27fc277917c48fda0b55beb9f32687ed5ffa36bf483f694d7bfe115f823e30beff00532fd87ecb17fdb5fdd57e5ffecd779730f88b50d5e3964865fb579b58d5378ee8fb03c65a0c534b2ff675cc734517eea286be79f1643259ebd69e645fbdf36bd026f89173fd972fdb6da39bfe9b435e75a878aa2d7b548adbcdf3bf7bff002dbfe595787eccfd930b8df654952a87d01e08bcff00458ab94f8f3ff127d07edd1ffadba97f755d36870cb6761179917935ca7ed4137d8fc25a7ffd328a2ffc8b5952fe2866b89f6786d0e3fc11796d37823c61a6496de75df9516ab6be77fd32ff005bff0090abc7fc6fe3cfb1f8f3c29e25b297ce97f75e6ffd758bfcc55ddf867cab3d2ed35c93fd54575169f2c3ff003d6297f752d78a78f34796ced750b1ff0096ba3df79bff006cbfd57ff1aafa6e87e5589a757da1f4af8df58d4fc6da8787e2925f3bcabaf362861ffae55d5e93e03d5ef2eb4f8becdff2d7fe7ad79d7866cedb5ebaf07ffc4f2dad3ccb1fdef9dff2cabdab4ff0ad8d9cbe6c9e38b1fdd7fcf1fded701eee55fbbc0bf687857c74d06fbfe25f1795e74b2cb2dd4bfbdaf3ab4f0adf43a0ea173fbb87cd962b58bf7bff006d6bb5f8b10f87af3c5be549e2593f756b145ff1eb52f84fc37e11d4affc15a649ae5ccdf6ebef365ff45ffa6bff00daabd6a5fc23e4e1ecee6878f3c2b7367f11aeeda3b9b6f2b42d1fca8bf7bff4cbff00b6d797e87e0fb9d4b5ed3ec6496dbf7b2c517fadaf46f167fc21979acf8eefbfb5efbf7b75f65ff55ff4d7ff00b5564fc27d1fc21378f2d3cc9752bb8ada2f37f731569d02a7b3f667d01ab683e4f84a28bfb4ec7f7b2ffa9f36bcebc1bfd9967aa5dfda7ccbb97cdff974af50f1e5e780a1d2e2b6fb36b7fbab5ff9eb15729f0f75ebed36297fb27c356d3452ff00cfdc5e6cb5f3f5373ef72eff0076a7ece99d05a59f87b52fdd477373a74bff004f7feaaaaeade09befdefd9a5b6bb8bfe98cb5d5ff00c261a65e7eeb5ef06793ff004dad3f752d675de9be02d4a5fddeb97da74bff003c6eed68d4f45d4a7ff2f299c2fc68f0aeaf67e0dbafdd47ff002eb17fadaf14f04786efa1f11e95fe8327fc7d452fee6bdc3e3f68fe15874b96da3f17f93e6df7fcb6b596bcebe1ef85628759f374ef19d8cd2c514b2fefa5f2bfe5957b94bf867e6d2f675712ce5350b3f27e1cdd6a7fea7fe2a28bfe597fd32ae7f43d4bec7ac4bff4ca5af70d73c1fe2f87e06695fbab6bc8aeb5d965f3a1f2bfe7957957d8fc4ba6f8b755b69348f3bfd2a5fdcfd97cdad3fe5e18fb3a5eccfa56efc61a9c36114bf6e926f37caff5dff5caa2d27e216af0dafef2e7ff00215687d8f4cbcf01e95737bf69d22eff0075e6c3e57fd32ae66d21f0f59cbfbcd5e4ff00bf55e255fe21f7194e1d7d58dbd43c79abcdfbaf363ffbf55e81fb3af8ab539be25fd86e6e7ce8aeac6bcebc9f0d5e7fcc4ee7fefd57a2fc118748b3f8aba54b657d24d2cb14b17faaff00a65452dcebc6e1ff00d9aa1f42cd37fa7d761a7ffaa8ab8ad5bf73aa455dae93fea62af44fcecb775feaeb9ad5bfe3da5ffae55d2ea137eeab94d5a6ff00895ddffd72a06b73e7ab4d62c66d53f79f61865f37fe5b56ac5fd99fda9a86a7fe8d77e6c5fea61ff9655f3aea134bf6a965f2aad5a5e4b3452f99ff003cabc8f667e934aa55a68fa1aef58d321fb24bf61b6ffbfb5f17fc4df8852d9fc41d43ecd179de6f95febabd2ad3fe58d78af8df41b99bc5b2cbfbbb48becb17efa697caaebc153fde9f319dfb5abecee7a57c2df891a9ff00c25be0afdd47fbdfb55ad797f89bc49a9ea5e12962b9b9ff0055a9ff00ed2ffed55d5fc3dd36dacf5ef025cc9abdb43e56a72ffa9ffb65595e32d3748d1ffe130b1fb4cb772daea7feaa18bcaff96b2d7b1fbb3c2fab9a1fb385e793e3297fe9ac55ecba843e4ea92c5fbcff005b5e49f01af2fbfe132d3fecde1aff004497cd8bfe3d7fe9957d4dab68fe2fbcd52eff00b3b488ece297f7be7795e57fe8daf3711fc43d7c9153f6953f7879cda786f57bcfde476325687fc2137dff002d3cb862ff00a6d2d6dcde09b987fe43de2fb1b4ff00a630cbe6cb514de1bf064317fa4f896e6eff00eb8dad729f67fba33e6f07dccdfeaeeadbfefed713f1fbc132cda0ea12c97d630f952c52ff00adff003ff3d6bd1bec7e029a2ff90bea5ff7eab3fe2c68fe029bc1377fe9da95dffa0c52ff00aaff009e55ad2f687cc675ecfd9d3fdd9f2ff84fc3717f6a4b17f6bd8fef6d658bff00215741ae6836d37c20f0a5f7f6bdb7fa0eb17517fdfdfded54f09de780a1f1269fe65b6b7379b2f95feb62aec21bcf014df0475bb6fec8d4a6fb0eb117fcb5ff009eb157b47cefb4a7ecff00867090e83a64df12e2f2f578a5f3753ff9e5ff004d6bdefc79e1bfdecbf66beb1ffbfb5e3ffdbde07ff858da24b1e877d0f9b2dacbe77dabfeb957adf8c6f3c05a94bff1f3a95a4bff004dabcbc41f4f947b3f6952a7b239487c13abf9514b1c51cdff005c65a2ef52ff0084575e8a4d4658ed25b1b5f36d6d2eff00e5acbff2cab6ed3c2be15bcff906f8cfec92ff00d3dc55e73f163418b52f88de1af0f5eea71eafa7ff00c7dcb35a4bff002cbcdac696e7a5997b3fab7ee8f46d5acfec7f0aa2d5e3fdcea12ea714b7de4ffaaff55e6c55e7fe37ff0043f11ea12ffcf597cd8bfedad7a2f867c377dac7c2ff0088b63245e4c3637d6b75179bfbaff96be5571fe37b3b187fb3ee6e6e7ed92cb6317ee61ffbf55aff00cbc3c7fad53c361bd9d43e80f85b0cb79f0834ff002e2f3bca8a2ff535a1a7e8ff00babbfb4dd470d73fe03f8856d67f083ecdf69f27fd17fd4c3ff5d6b8ad3fe245cc3e6fd9a28e18bfe9b57935699eee539954ab86fdd1e8be21d1f4cbcf06f882dbcd926f36d7fe79571ffb2ff8922d07c65e1fb9fb77fa24b2fd965f3bfe9ac5ff00c762acfd3fc49a9de4b776df69fdd4b17fa9af0ff06f8aafb4db5d562f37f7b6b2f9b17fdb296297ff008ed7ad86a7fba3e5f36a953eb27eb8554b487c98bca8eb17e1ef8aa2f1b782344d723ff97eb58a5ffb6b5d056c7ce8514c79be63450057a28a26ff0053401f2fff00c1423c492e9bf0462d32da5fdedf5d7fe428a2ff00f755f1a7ece1a3c5ff0008bea12dedf7f674b5ecdff053af154536a9a2687e6ffc7adaf9bff7f7ff00dd5797feceba9691a6fc34bb8b5ad23fb47cdba8a2fb5c32f952d62ff867a585fe2d33b5f10f8565fec6965b6963d462ff009ed0d7825dcd2e9be238a5f2bc9fdeff00cb5afa5b56d1f43d6346965f0e6af269d2ff00adf275097caffc8b5e13e3cd3757d36ea28b56b6f3a2f37f75775e7ea7e93529d3a948fa9be10f8c2db5eb5d3f4dfb4fef65f2bfd12eeb89fdaeef2c752f0e7951ff00a24b7375fbaff9e5e5455c57c2dbcf27cdfb4fee7ecb14be579d5c27c7ef186a7f6f8ac7cdf3a28ad7fd4cd5ad3c31f0f9ae2aad2a9ec8f40f865a3db78dac3c29e15b9ff557dfbdbaff003ff5ca2af3af8c7a6ea7af4d16af6d631da6957d14b6b7537fcb2f362fdd4b5d07c32f1b793f0fb55f12db79736a163a6456b1793feb62f37f75595e2c862f12784aefc3d1ea7e77956bfdab143e6feebcdff96b17fdfaf2abd130a989facff0cb5f0caf3c3d79a0f8522b98ae66bb8ad65fb54dff006d6bdae6bcf0f59d879b1db5cffaafdd79d2d7cd5f01a69758b0b4b6b6b6926fb2f9bfea62ff00a6b5f406a1a0ea7fd97e6fd86e7fd54bff002cabcea9fc53d7c1d4f6581aa7cffe3cd7b4cbcf1beab2ff00667fcb5f2bfd6ffd32aeebe196a5630fc46f07c5fd911f956b63e6cbfbdffa652cb5e55ae683a9de78a350fdd7fcbd57b07837c1fa9d9ebde25b9f2a387fb3342962ff005bfeabf751455ebfeecf92a788a879d5df8922ff00844fcdfec8b6ff004abe965ff3ff007f6bb5fd9ef5297fb5355be8ec6dbfe5945feaab8fd5bc1f7d0e83a24524b6dfeaa597fd6ffd35af65fd9afe18cb358457325cc70f9b75ff003cab2a9ecfd984f1153da9d07c4df1e5ccd75771476d63e57faaf3bcaac0f0f6b17d0c514b1dcdcc3ff5ca5adaf19780e586fbfd22fbcef37f7bfb98aba0f0f7c31b69ac3cdf36e6bc7f6b4cfd268d4abec8a9a7f8f35387f75f69fb5ffd319aadff00c249a65e5fc5e6787adbfd6ffcb1fdd5687fc2abff0055f66beffbfd1554d3fe1beaf0ebda7c5fbb9a2f37fe58cb4ff762ad88a9ec8f2afda2b58d23ed517fc4b24fdedd4b2ffadaf3ff0006de687345aacb25b5cc3fe832fefabb0fda13c37abfdbf4ff00f46fdecbe6ff00cb5ae13c33e1bd5ecf46d6e5fb0c9ff1eb145fb9ff00aeb5ee52f67eccfcde188fdeb3d2f5cb38bfe157fc3ab6d3b5c92d3ed375752f9337eebfe5ac55e55ae4dae59f8cb5092dbc43ff002f52fefbed5ff4d6bd03c4d672d9dafc2fb1922f27fd07cdff00bfb2d78a6b90f9d752cb5a07b5a7ecff00867e80687af5f7fc2b4b48bc47a1db788bca8ad7ca9ab8fd4358f0af95e6c7e108fcdf2bfe7eab2be1bebd7367e0d962b696487fd162a962f1e6a7e57951dcff00e428abc4a9b9f6992ba7570c4569e3cf0f69b2ff00c8991ffe054b5ea1f047c79a3ea5f12f44b6b2f0adb5a4b2cb2ffa5ffadf2bf755e5377af6a734bfeb63ff00bf55db7c17d63539be2d786bccb9fdd4b75ff3ca8a47ab89f67ecaa1f55789a1f26fe2aec749ff008f68ab99f1643fe9514b5d2e87feaa2af44fcd8350ff00542b9abbfdf697a87fd7296ba5d5bfd4cb5cd7faed2f5097fe994b40e3ba3e34866b9fdd4b6de158e68bfe9b5af9b534dac5cffcb4f087fe4acb155afed2f155e4b2f97e218ed25f2bfd4f9be554d0de78ce1f37cbd5fceffb6b15793fbb3f518fd62c8cfb4bc96f2ead22b6f0ac7e6ffd72af09f891e1bd32cfc51e6f89f5c921bbfb2c5fe8969fbd96bdee6d4bc5f35ff9573ae470c5ff005d6be74f89b79a669baf5a7976df6b97ecbfeba5aeac17f10f99cfbda7eefda1b7e19d4bc05a3d86897df66d5aefecda9ffcb697caff009e55d2fc42f1258e9be3cf1ddb68be15b6f365fdec535dfef7fe5ac55e5f6be2a97fe112bbfb35b58da7d96ea297fd5576df14bc49a9ea5e3cd42e65b993fd3b478a5ff9e5e6ff00a2d7ae7ccfeeccaf01f8abc5f0f8b744964d5fec717daa2fdcf9be557d3fe32fed3bc9629756f1579317d97fd4f9be6d7c1fa7de7937f15cf9bfeaa5f36bebbd726f3ac34a97fe997955c989a67a194d4a5f592dc3ff0008d59ffcb5bed465ff00bf552ffc249a443feaf438ff00edb4b5cfd9e8f7d37fc7b58dccdff5c62ad587c13ae795ff001ede4ffdb5af3bf767dcfd609bfe124b1ff969a1d8d5af10f892daf3c1bfbbd1f4dff8f5962ff555561f87babc3ff2cadbfefed6d5a7c37d4ffe11c8a2f36dbfe3ebfe7ad3a5eccf0f3aa953eac7c7fa7f8dae61d52d258edadbcd8a5f37fd557a5da78aae66f09fc50b18edadbf752dadd7faaffa6b5c25dfc31beb3d52ee2fb4db7eea5f2abd4343f86f73fda1f102dbedd1ff00a5685f6aff00d152d7b9fbb3e31622a7b33cd66f125cde6bde14fdd5b795e55aff00cb2ffa6be557aaf8cb5eb69a5fdee876dff6cbf755e7fa7f80ee66d53c15fe931cde6feebff22d7a878b3e1beafe6c5e5f9737fdb5af3b13eccfb2ca31152d50c48752f0f4d143e669925a7fd7196b3fc4de24d33c2bace9f2d94be4f9b17faebbff005b46a1e15d5f4dff00596324d17fd31fded797fc5e87c9d674ff00322ff975ac30d4ff00783cd6a7fb39ee1a7fc48b69b54f8a1636de65dfdab4c965fdf7fd75af0ff1978c353d7b41f0ff00992f9317952c5fb9ff00aeb5d87c32d1efb58f88daac5f669218afb4297f7d37eebfe5d6b8ad434db1b3f06e9f2c97df6b962ba962f26d3fed957af4fd99f23f57a9fbcb9ecbf09fcdbcf873e547fbeff45ba8ab5bc3da0cb796be6c9736d69ff5da5ab5f0474df10ea5f0e628bca8f43d2bfd2bfd77eeaa6f09d9f856cec3fe263737d7777ff4e9feaabc3abfc43ea387fd9fb3a86d6870e910ea9e5497324d2f952ffa98bfe99578569f67a67fc279add8fda64f2a5be962ff0055ff003d7cd8bff6ad7d17e19d7ac61d5228adbc2be6ff00d3696bc13c43af45a6fc4bd6e593c351c3fbd8aebc9ffb6b14b5d78331cebfde29feecfb43f623f1545ac7c2abbd23ed3e74ba65d7fe4297f7bffc76be8b9abe24fd913c61a6786fe376abe1a8ec64d3bfb4ed658bfd6feea596297ff8d57db75b1f3153f8843e4d152375a28312b5151545a85e45a6d85ddf5cff00aab58bcd96819f93dfb7978925f127c6ed562ff96515d7d962ff00b65fbaa3e05ebd7da6fc3e8a28fcbf2a5baff533455c57c63d63fe124f197dba497f7b732cb752ff00db5af50f84fe0f96f3c2569147731c3e54bff3cbfeb957254a9fbb3dbc0fb4a78d3bbd4352b1d6341f36f6da38658a5ff5d695e29e219aeacfcdfeced4fed769ff003e9357b87887c1f7da6f8725f33f7dff005c6be7af1643fbd97ccfdccb5c87dffb4fddfef0f60f865a9450f85ffe26363e74575e54514b5e3ff122cedbc55e23d565b2bef3a2f37ca8bceae97e1678f353f0de9777f66f2eee28bf7b2da4dfbd8a5ac4d3ef3c21e2afdd5ec573a1ddcbff002da1fdec55eb60cfcef36a9fed3fbc2afc1cb3fec7d2fc61a66a31490f9ba67daa2ffb652d797ea1e24b9f0af8a3ca925926f2aebcd8a6ff009eb157d2169f0af5cb3f11eab2e8b736de22d3ec74297cdf265f37fe595784fc48d065d62c344befb0ff00675dc5e6c52c3ff5cab6f6871d4a7ff3e8f66fd956cec61d675597ed3e4da79be6c5e4c5ff002cabeb0f10ff00647f60cbfbdb99bf752d7c73fb24cde75aea1e67efbca97caafa9b50ff00902cdff5ca5af9ec454fde9fa4e5d96d3ab96fb5aa7cb3a8de6990f8df508bcab99bfd2abd6f4ff1269967a5fc50b98ec64ff9656b17ef7fe9ad787ea1fbef8972ff00d7f577735e7fc5bdf1acbfea7ed5aec514bff916bd53e3a9e0a972153c59af45e6c5147a65b7fa2d8c5feb7feb957d21fb3debdf63f0969f2fd86c61fdd4b2ff00aaaf92bc59ff00231ea117fcf2fdd57d4bf073f73e03b4ff00a65631572626a7eeceaa382a5571becc3c6fe2ab99b54ff468eda1f2bfe78c55b7e19f156a70d845fe935e7fae5e79dacf9b5d8687ff0020f8abc83f55a585a563bab4f185ccdfeb22b69bfebb455a1a1eb16336bd69249a67fcf597f732d71f695ada1cdfe952cbff004eb2d3a750e3c6e1b0df56a878cfed15ac691fdbda545f66b9ff00552cbfeb6b9af0f4da44de12d6ff007b730fef62a97f68aff91b74f8bfe7958ffed596b95d0ef3c9f06ea1ff005fd145ff0090a5af729ff0cfcc69e070ded0f75f1669b633788fc096d1df47fe8be1d8bf7337fd7296bc2aefe1bdb6a514be5d8db4dff5e92d7aaf8f3fe4a0f87e2ff9e5e1d8bff4965af1a87fe99cb5ad3a865572aa7eccfa6fc11f0c6c7fe10dbbff0046b9b4f2e28a2ac497e1bc5feb63be93fefd576be13d62fb4dd2eefcbba93f7b15ad5b87c55a9cd6b17ef63ffbf55e4d5a87d3e5396d4fab6879ff00fc2bd8bc9ff909c9ff007eabaaf84fe098b4df88da25cfdba49a58ae6b5a6f155f7fcf58ff00efd56d784fc497d378a34af3248ffe3ebfe79514aa1e86272ea9ecaa9ee1e26fdf7955b7a1ff00a9ae7f56fdf5d451574ba4ff00abaf70fcad9575c9bf752d73ff00f32e6a12ff00d3296b43c4ff00eaeaa7fccaf77ff5ca5ad471dd1f9ff343f6c97f7952c3fb98a5f2e5ff005b5ea169e038a68bf77636de6f95ff002dab6ed3e1bc7ff2d34cb69abc3f687e92af63c53c98fedfe6d7957c42f0aea736a9a54b1d8c9ff1ebff002dabebb87e1edb43aa45fe8d6d0fef7fe5b579a7c689b48d36eb44ff0059772f952ffd32adb0d53f7a7cbe774ead5f67eccf0fd0fc077d79e1cd6fcd96387caf2a5ffc8b5ea1e26f86f6d79e2df054b25cc93457de1db58bf7317fd758aaa787bc4914da5f8822b6d323ff008f1ffdab15777e2cf155ccda37c2abef36387f75e57ee62ffa6b5e8d4aa79d4f2da9fbb3c3f49f86f6d0ff00cc3249bfebb57db7e1ef07db7fc21ba55cfd86dad3fd54be74dff5cabe34d72f25b3d52efed32c9fba965ff96b5f507c2dd7adb58f873a7db79bfe9717eeab931353f767a382cbbd9624ec26874cb3ff00597d24dff5c62a8a6bcd23fe7dae66ff00aed2d64f9d14dff2d63a8abc3f687e934b2da66dff006c58ff00d033ff0022d6843ac5b7f635df95a647fba962ff005d2d729356ae9ffbeb0d422ffa6514bff916b5a550e4cc70387fab543e65f1e6bd143e32d562feccb1ff008fa97fe595775e03f157db3c51ff001e36dfe95e19962ff55ff4cbff00b5579ffc5eb3f27c79aacbff005ca5ff00c855b7f0ca6966f16f853fd67ef74cba8bff0046d7b9ed4f86a786a5ecedecccff000cebdfda5af782a2fb0db43fe952ff00a98bfe9ad7b86b9ac58cd2fef348ff00c8b5f3d780ff00e463f0a799fb9f2a5ba96bdef50b38bcafb4dc5cc70c5feb6bc9c6d43ecf29c361bd995350bcd226962ff8f9b4ff00c8b5e13fb42785753d63c51a249a0f97a8ff00a2fef66ff55e57ef6bd9aeecf4dbcf2a58ee7cef37fed9578a7ed29676d676ba27fa74969145e6f9bff4d68c0d4fde0f3ecb69d2c154ab4cd0f865a0d8d9fc55f07dcebde258e1965b1f2a5b487fd2a5ff00552c55e5fa86a5a643a37d9bc39a64934bf6f97fe261775a1f0cb58d32cfe25f813cbb6926fdd7fcb6ff00b6b5ca78875eb9bcd0750b6fddc3145a9cbfb98abe98fcba7ecfda54f687adfc2dd4a2ff008473fe26dabc97777f6aff00530fef6ba0f06ebdf63d2fca8ec6dbfebb4d5e29f09ef2e7ecba8451c524de54b14b5ee1e0df04ea779a3457324b1c51579389fe21eee4153f89ec8dbd275ed4ff00b7ad3cbbaf262f36bc53e26de5cc3f11a6ff004993fd2ad6be8bd0fc076df6fb4fdec937ef7fe58d78ff00c6ef07c567f12f4afdd5cffaa8bff46d3c354a6659f54abed290693f10ae7c2bf1a7c29e21925fdd45a9dacb2ffd729628bcdffdab5fa97e779d157e4a78dfc37e4e97a7dcc7e6432c76b6b2ff00dfaf362ffda55fa8bf0df52fedef87de1abeff009fab1b597ff2157a150f9daa74145145646255ff00ae75e73fb486bdff0008dfc11f15df7fcb596d7ecb17fdb5fdd57a357cf3fb6e5e793f0822b6ff009fad4e28ab2a875e1ff887e67f8b3fd33c5b2c5ff3ca28a2afa03e00f8aa5b3d07cafddcd17daa5ff5dff5d6be7fff005de2dbbb9ffa7aff00edbffb4abd6fe00cdff14bf95ff3ca5ae3c47f08fadca69fb5c6d3f6a7d5735e58eb1612c5245f63ff00a6d0d787fc42f07db6a52cbfeaeeff00eb8ffadaf55d3ff7d612ff00d72af34f167ee65af23da9fa2d3c0d2aa782eada0cba3c7a87d9fccff555cf780fc4916a5aa695637b6d1ddc52cb145ff4d6bd6f5087cefed08ae7fd5795febabc5743d065b3d7bcdb297f7b179bfb9ffb655eee0aa1f9ae7f86faae24f6ad0ef2287c2ff103c43a2ea7269d2dd4b15ac5e77fd3597fe7ad792fc58f885a9c31689a46ad2c777e545e6f9dff005d6ba09af2e74df837696d731490cb7da9f9bff7ea2af3ff00899a3c779accb17fcfac517fe8aaf42a1f31ed3dad33dabf65ab38a1b0d57cb97ce8bed55f485dcde76972ff00d7acbffa2abe65fd927cdff845eefccff9faafa4269a5fb2cb17fd3296be6711fc53f5ecba9ffc261f24ea1ff252ff00edfabb09a6961f84be20fdeffcc762ff00d152d7157537fc5cbf37fe9fa2aedb51ff009253e25ffb0ec5ff00a2a5af596c7c27d8399f164de76bda84be6ffcb596beabf87bfb9f01ff00dbac55f22789a6ff008a8f55fdd7fcbd4b5f58787a6fb1f80e5ffae517fe8aac713fc23bf03ff2313949a6f3b54ffb6b5e8da1cdfe8b5e6917fcb2aeef499bfd16bc83f4f47410cdfbdadad0ff00e6212ffd3ad72b0cd5d2e9337fa06adff5ca28bff22d079f98ff00bb543e7af8e934b378dffeb95ac55ccda79b0f8225ff00afe8bff455687c639bed9e37d43fe9945156543ff226f9527fad96fbff006957bb4ff847e754cf5bf88537fc5d0d3e2ffa817fedacb5e290cdfbdff5b5ec1f1226ff008bb5e57fcf2d1fff006d6bc5269bfe5a52a66d57f847d8da7fefbc39e6ff00d328ab2619bfd16b43c3337db3c2537fd7ac559f690f9d0d78954faec97fdd83ceff009e72d6df84e6ff008aa34a97fe9ea2ae6bf75f65962f37f7b5a1e18bcff89f695e67fcfd454523dbc57f06a9f505dcde75d574ba7ffaa35cff00fcb6ad5b49bf755f4cb63f9fe5bb317c4d37ef7caa96eff73e17bbff00af596b2b5cbcf3afe28ab4356fdcf83750ff00af5968638fc48f9261fb4feea5ff00a655a1a7de4be6feefccacab4bcf2658a5f37fe5956ac3af5b7955f32f73fa0a2972a087cdfed48bcc97cefded797fc79f2bfe255ff6d6bd06d26f3b598bfd67952cb5e73f1f7fe615ff005d65aebc37f10f8fcfff00e5d9cd7837fd56ab179bff0030c96bb0f134dff1697e1d5cff00cf2baba8bff22d79ff008366fdeeab179bff002e32d76bae7efbe03f83e5ff009e5a9dd455e89e27fcbba679ff00c5287c9d675097f79e57f69ffed5af60f817792cd6baaf97e67eeaea296bc7fe2f4dff00134d43fe9a5d455eabfb32cdff00139d56d64fdf7ef62a553f86653ff7a47a5d9cd14d154be77fcb4ac5d0ff00d0e5bbb693fe5d65f2ab6a6af0cfd4a3b079d2cde6d1f6cbeb3f37cb96aafef61a961bcfdef95e5506667f8b34dd2358f0bc57d7ba65b4d772db4b179d345fbdaf99749f186af0d86a12c72f932dac517d96687fe597ef6be9af194de4f8362f33fe795d57c9fa4cde4f8735b97cbff96517fe8daf5f0dfc33f35c6ffbed43b0f8a5ac5f43aceab1472f930c52daff00a9ff009ebf65fded7a87c2d9a49be1f695f6997cefdd7fae9abc7fe325e4bfdb3a87fd35d4e58bfefd45157b2f80ecff00b37c1ba7c5245feaad62f369633f867ad92ffbc9ad37fc7ada451ffcf5af0ffda6ace59ad7c3fe5c524de6cb2ffed2af70fdd7daa2af3ff8bd35b59ff654b7373f64fdecbfea6b9305fef27bfc45ff0022ea879a7c38f04ea7378cbe1fdcfd9bc9fdeffcb6ff00aeb5a1a87c31ff004af104527fa5f95aeffd728bfe5ad761e13f15699a6ea9e0496dac7cdf2afbcaf3aeff00ebad62fc52d62e752d7bc616d24b2f9516bbfea62ff55ff2d6bddf687e4f4f2ea956a6a43e19874cd1e5d42dbedd1f9be579be4c35f42f87b588a1f0bda5b47631ff00aaff005d5f22f81ff7de2dfb349ff3cabea5b4fdce97691475e1e27f8a7dae4181a74a9d43a5d3f5ebe86ead228a5f261f36bc2bf684d7afbfe160da7fa4c9e7795ffb56bd83439bfd3ed3cc8bfe5aff00aeaf0ffda121f27c6f692c7ff3ebff00b56b5c17f1059f52a7fba25f196b17dff08e69ff00bd93cafb2cbff90afe5afbc3f65ad7bfe124f80fe1496497ce9628becbff007ea5af82bc430f9de1cb4f2ffe7aea917fe8a96beb0fd80b58fed2f84baad8ff00cf8ea7ff00a36bd73e3331a47d2b45145078655af967f6f2d4bc9f01f86ad7fe7adf79bff90abe9bf3abe3ff00f82876a5e4e8be0f8bcdff009fa97ff4556553f8675e1ff887c1fa4fefad75097fe995d4bff90bff00b6d7a2fc01bcfdd6ab17fd3596b85d261f2741d425ff009e763145ff007f65aeabe037efa5bbf2e5fdef9b2d6188fe11f5d94ffbf533ebbf0f7fc7a7fdb2ae13c650c735757e139bceb5b4ff00ae55cff8ca6fdecb157cf1fad61ff8879a6a10fd8ed6eee64ff55fbaaf0fd0e696cf54f363fdf7fad96be80f10c3159f85ff00d27fe5acb2cbff007eabe6ff000ceb1143757715cffcfacbe557ad863e073ba94ab634f769a6b1d7bc07f0eac7cd8e6f365ba965866ffaeb5e49f1a347fecdd6755b9b68a38bcd965ff535d8793fd9bff0afe293fd57d97ed5ff009165af3af1bde79d179bff004d6bd23e37ea54e93f687b2fecbf0f93e08b593fe7acb2cbff00916be80861f3a58a2af1afd9d747b99bc11a54b1db49feabcdaf75d3fc377df6fb4f33cb87f7bff2da5af0aa7f10fd4b0f56952c01f1578b3fd0fe20cbff005d62aeea6fdf7c2af1845ff3cb588bff006ad72bf12347f27c792f972c7ff2cbfe5ad76b0e8fff0016e7e207fa4db7eeb53b5ff96bff004d65af5e9ff0cfccde2695cf34f137fc8c777ff5d6bea6866ff8b732ff00db2ffd155f34f8b34db6ff00848e5f2ee63afa421d36da1f87dff2138ffd6c5fb9f2bfe9956389fe11d396e2697f689950cdfe8b15761e1e9bceb5ae7e1d374c9a28bfe267ff0090ababd0f4db1ff967a9ff00e42af20fd2e9e3b0c4b0ff00aeae9b4fff00900ddffd359628ab261d0629a5fddea76d5d5c3e1bb9ff00845e2f2e58e6f36ebfe58cb4fd99e766d8da5f56fe21f24fc489bed9e32d6ffebebcaa2d21ff00893787e2ff0096b757d2ff00ed2aabe26d1efa6d7b55b9f2bfd6dd4b2d755e19d06fa6d7be1fd8c96d27ef6ea297fd57fd3d57b87c2d3ab4bf786b7c48bcff008bbfe2b97fe7c6c7caff00c85e557927fae97caaeefc65792cde23f88b7dfbcfdedd4b17fe45ae274387ed9ace9f17fcf5962a0daaff000e99f58787bfd0fc39a845e6ff00cbac515715e21f88517856d7f79feb6ea5fdd576134de4f872effe7acb755e49f14be1eea5e2ad2e2fb14be4cb14be6c55e1d53ed32aa6fea5fba34350f1b4b0e8d697d2eaf6334b7dff002e90cbfbd8abd1bc11e55e6bda27fcf59658abc27c1bf0c75cd4ad628b5e8ac618a297cdf3ad3fd6cb5f437c3787cef16e956d1c5feaa5a2953fde9a43eb34b0b56a624fa83cead0866ff45ac9b3f36696adddcde4dad7d39f8b3dce52ee6fb66bd5d078b26f27c0faaffd7acb5cae93379dacd74be3887cef01eb7147ff003eb2d27b1ad1fe2a3e448747fb67fac97c9f2a2ff5d5cac3358e9be32fecdf37fd6fef629a597cdae82d26f3b54962ff009eb145593e21b3ff00895c52db5b47fdb7fda7fea66ff9e5e557ccbdcfdee553d9d1474da7ea52ff006f5a7da7cbfdd4b5c27ed0937fc83ffebea5aec3508629aff4f97fe5af9b179b5c27c7e9bc9d2ed3febfab5c37f10f92cfff00e5d9c2f84ef3fd3eee2ff5de6dadd7fe8aaed669bcefd9f744965ff965aecb17fe42af3af0c5e4bfda917eebfe5d65ff00d152d7610de79dfb3c695ff6314bff00a2abd73e797c0627c5efdf5fea1ff6eb2ffe8aaed7e006a5f63f146a1f66963bbfdd79bfb997fe9ad79d7c4dbcf3b54bbffb65ff00a2abd2ff00675d362fb7eb72feeffe594558d5fe18a7fef333d17c43792d9f8cb50f2eda49a2965a966d63c9ff0059149ff7eab43c79a6d8cdaf5dcb25b79d2f9b59fa7d9d8ea56be549e679bff5d7fd6d7907e9f47f8489a1d7ada6b5f2aa18758b19bfe5e63fdd567ea1e1b974d97fd1ae6e7fefed1a7f95a945e5fdba4f37fe9ee2a0d8cff89be24ff8a0e5fdeffcbadd57cd5e189bed9a3ea16de6fef65bab58abe85f8f3a3fd8fe1f7eefec3ff1eb145e77d97fe9ad78d7c27d37fe269a24573731ff00a56b16b17ee62af5f0dfc33f2bc4d4ff006da85bf1bffc4fbc65158dbfefbcdd62ea5ffb65e6d7b54dac7eea5b6b6ff55e57fcb18bcdaf3af86fe1bb6f1278f22bebdb9fb645f659658a1ff9e5fbd96bd974ff000adf59c5fbb8a5f2bfe594d58e30fa2c87d9d2f6954e6a1ff5514524b2437717fcf6ff0096b5e75f1a3cdbcb5f0fff00db596bdc26d1efa1965f3228e5ff00b6b5e13fb424375a6dd787edbca8ff00d54b5c986fe21ee66d89a4f0462e93e559e83a24be6ffc7aea7ffc6ab6be2ede7d8fc47e3bb68e2ff989c52d70ba7f9b3784aefccff9657514b5dafc5e862ff84cbc61ff004d6c62ba8bff002157b07c66b6384f8390ff00697c46ff00a651455f535dfee6d6be74fd9c218a6d6755b9ff00a6b1455f42ea137931455e6627f8a7d464b4ff00d88d0d0e697edf14bff4d6bc7ff68f9a2ff84a2d3feb94bffa36bd6f499bc9bf8a4ffa6b5e35fb4a4dff00156da7fdb5ff00d1b4f05fc43c8cff00fe5d84dfbef0e7ef3fe831e57fdfdb5afa03fe09cfac7eefc61a679bff002d6297c9af9ff4f9bcef06ea1ff4ceeb4bbaff00c85e557aafec0579fd9bf12fc4163ff3d6d6bd73e4731fe19f7ad152375a2b53e60c69abe25ff828f7fc7af853febdaebff695145655363b30ff00c43e3eb3ff00912350ff00afab0ad0f817ff001f577ff5d68a2b0abfc23eb72dff007ea67d57e0eff8f0b4acff001676a28af9e3f54a7f19e7df10bfe458ff00b8657ccdff0031097feb94b4515eb618fcdf1ffef47a25af3ff08d679ff8967ff1daf3bf167fc81e8a2bd23c8a9fc33ea1fd9fddbfe103d2be63ff001ebeb5eb369ff1fd6bff005d68a2bc77fc43d9a9fee87c89f10bfe46d9bfeb9576da77fc887f117febad87fe8da28af4e9ff000a99f9dfd83cd3c51ff21497fcff00cb2afa162ff9136d3febafff001aa28ac713fc33bb03fefa685a56de9fff002c68a2bcc3efce821ff53ff6d2ba09bfe457d3ff00ebacb4514d6e7879d7fbb1f23cd349f6f97e76fccd7b27c2dbc9cfc4bf87f99e43fe8dfdf3ff004d68a2be80f8fa5d4b5aa7efec3c61e67ef3fd3a2fbdcffcb596b8ed0ec6dbfe128d3ffd1e2ff8fafee0a28acaa1ec436a67adeadff20187febacbff00a2a887fe3c28a2be7ea6e7eb7947fb9530b5ff00595d87c1cff92856bff6d7ff004551456d87fe21b66dfee354fa43fe5b567eadff001ed2d1457d09f841ca7867fe3fe5aed75cff00915f50ff00af5968a293d8a87c48f87e1ff918f49ffae5ff00c76ba1bcff0091a3fed951457ccbdcfe82a7f0a21d43fe3eb4ff00faf9ff00da55c2fed09ff201ff00b7affda54515ae1ff887cae7ff00c3a6792787bfe43117fdb5ff00d152d757a6ff00c9bbe95ff6314bff00a2a8a2bdce87ca2fe198fe3d553e23bbca83f87fd328abdf3f675b1b7ff89b7fa3c5feb7fb828a2b92a7f0ce5adfc5a87a77c42863fed8d43e45ff005be82b82d3ff00e3ea5a28af20fd5f05fc236eeffe3c26af3f9bfe43d45141d70d83e3ff00fc9348bfeb945ffa36bc3fe18ffc8dbe1aff00b0c51457b986fe19f93627fdeaa9e8bf00ff00e46cbb3dff00b1e5ff00d1b5ec177cdac59e68a2b9313fc43d2c0ff08e7eebfd5ddd7927c6eff90c695ff5eb45158e1ff8a6d8afe09c55a7fc8b9ab7fd758bff0046d757f177fe46c9bfec5db5ff00d154515e91ccf6a667fecc1feab50ffafaff00da55ed7ab7fc7d454515e4e23f887d5e53ff0022f34349ff005d17fd75af24fda3ff00e463b4ff00b7aa28ad70dfc43c6cfbfe5d94f4ff00f914bc41ff005e361ffa36bd33f62eff009382bbff00b6bffb568a2bd73e5b1dfc23f42a8a28ad4f933fffd9,
        101,
        'image/jpeg',
        '2025-04-26'
    );

CREATE TABLE behaviours (
    BehaviourID INT AUTO_INCREMENT PRIMARY KEY,
    ChildID INT NOT NULL,
    Description TEXT NOT NULL,
    AssigneeID INT NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL
);

INSERT INTO
    behaviours (
        ChildID,
        Description,
        AssigneeID,
        Date,
        Time
    )
VALUES (
        1,
        'Pushed another student during recess.',
        5,
        '2025-05-10',
        '10:30:00'
    ),
    (
        2,
        'Refused to follow instructions in class.',
        3,
        '2025-05-09',
        '11:45:00'
    ),
    (
        1,
        'Helped clean up after art session.',
        4,
        '2025-05-08',
        '14:00:00'
    ),
    (
        3,
        'Interrupted repeatedly during group activity.',
        5,
        '2025-05-07',
        '09:15:00'
    );