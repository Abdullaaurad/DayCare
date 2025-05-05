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
        1,
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
        7,
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
    UNIQUE (OriginalName, ChildID),
    FOREIGN KEY (`ChildID`) REFERENCES `child` (`ChildID`) ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE Child_Medication_documents
ADD CONSTRAINT unique_child_document UNIQUE (ChildID, OriginalName);

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


CREATE TABLE Reminder(
    ReminderID INT NOT NULL AUTO_INCREMENT,
    ChildID INT NOT NULL,
    Description VARCHAR(200) NOT NULL,
    Date DATE NOT NULL,
    PRIMARY KEY (ReminderID),
    FOREIGN KEY (ChildID) REFERENCES Child(ChildID)
    ON UPDATE CASCADE
    ON DELETE CASCADE 
)

INSERT INTO Reminder (ChildID, Description, Date) 
VALUES 
    (1, 'Submit homework', CURDATE()),
    (2, 'Attend parent-teacher meeting', CURDATE()),
    (3, 'Bring signed permission slip', CURDATE()),
    (4, 'Complete science project', CURDATE()),
    (5, 'Prepare for spelling bee', CURDATE())
;

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
    FOREIGN KEY (`ChildID`) REFERENCES `child`(`ChildID`)
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
VALUES
    (1, '2025-01-20', '08:00:00', '10:00:00', 'Approved', NULL, 1),
    (1, '2025-01-22', '09:00:00', '11:00:00', 'Pending', NULL, 0),
    (1, '2025-01-23', '08:30:00', '10:30:00', 'Canceled', NULL, 1),
    (1, '2025-01-24', '09:15:00', '11:15:00', 'Approved', NULL, 1),
    (1, '2025-01-25', '08:45:00', '10:45:00', 'Pending', NULL, 0),
    (1, '2025-01-26', '09:00:00', '11:00:00', 'Canceled', NULL, 1),
    (1, '2025-01-27', '08:00:00', '10:00:00', 'Approved', NULL, 1),
    (1, '2025-01-28', '09:30:00', '11:30:00', 'Pending', NULL, 0),
    (1, '2025-01-29', '08:15:00', '10:15:00', 'Canceled', NULL, 1),
    (1, '2025-01-30', '09:45:00', '11:45:00', 'Approved', NULL, 1),
    (1, '2025-02-24', '08:00:00', '10:00:00', 'Approved', NULL, 0),
    (1, '2025-02-25', '09:00:00', '11:00:00', 'Pending', NULL, 1),
    (1, '2025-02-16', '08:30:00', '10:30:00', 'Canceled', NULL, 1),
    (1, '2025-02-17', '09:15:00', '11:15:00', 'Approved', NULL, 0),
    (1, '2025-02-18', '08:45:00', '10:45:00', 'Pending', NULL, 1),
    (1, '2025-02-19', '09:00:00', '11:00:00', 'Canceled', NULL, 1),
    (1, '2025-02-20', '08:00:00', '10:00:00', 'Approved', NULL, 0),
    (1, '2025-02-21', '09:30:00', '11:30:00', 'Pending', NULL, 1);

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
    AllHours BOOLEAN DEFAULT 0,               -- 24 hours allowed
    FoodAddons BOOLEAN DEFAULT 0,      -- All food add-ons allowed
    Everything BOOLEAN DEFAULT 0,
    AgeGroup ENUM(
        '4-5',
        '6-7',
        '8-9',
        '10-11',
        '12-13',
        '14-15',
        'All'
    )NO NULL,

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
    )
;

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

<<<<<<< HEAD
CREATE TABLE EmployeeAttendance (
    AttendanceID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    Start_Date DATE NOT NULL,
    Start_Time TIME NOT NULL,
    End_Date DATE,
    End_Time TIME,
    Status ENUM('Present', 'Absent') NOT NULL,
    PRIMARY KEY (AttendanceID),
    FOREIGN KEY (UserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO
    EmployeeAttendance (
        UserID,
        Start_Date,
        Start_Time,
        End_Date,
        End_Time,
        Status
    )
VALUES (
        29,
        '2025-01-01',
        '08:00:00',
        '2025-01-01',
        '15:00:00',
        'Present'
    ),
    (
        30,
        '2025-01-01',
        '08:30:00',
        '2025-01-01',
        '14:45:00',
        'Present'
    ),
    (
        31,
        '2025-01-01',
        '09:00:00',
        '2025-01-01',
        '13:30:00',
        'Absent'
    ),
    (
        32,
        '2025-01-01',
        '08:15:00',
        '2025-01-01',
        '12:45:00',
        'Absent'
    ),
    (
        33,
        '2025-01-01',
        '07:50:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        19,
        '2025-01-02',
        '08:10:00',
        '2025-01-02',
        '15:20:00',
        'Present'
    ),
    (
        20,
        '2025-01-02',
        '08:25:00',
        '2025-01-02',
        '14:30:00',
        'Present'
    ),
    (
        21,
        '2025-01-02',
        '08:50:00',
        '2025-01-02',
        '13:10:00',
        'Absent'
    ),
    (
        22,
        '2025-01-02',
        '08:00:00',
        '2025-01-02',
        '16:00:00',
        'Present'
    ),
    (
        23,
        '2025-01-02',
        '08:30:00',
        NULL,
        NULL,
        'Absent'
    ),
    (
        14,
        '2025-01-03',
        '08:00:00',
        '2025-01-03',
        '15:10:00',
        'Present'
    ),
    (
        15,
        '2025-01-03',
        '08:40:00',
        '2025-01-03',
        '14:00:00',
        'Absent'
    ),
    (
        16,
        '2025-01-03',
        '08:30:00',
        '2025-01-03',
        '14:15:00',
        'Present'
    ),
    (
        17,
        '2025-01-03',
        '07:55:00',
        '2025-01-03',
        '12:30:00',
        'Absent'
    ),
    (
        18,
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


=======
>>>>>>> origin/main
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
    FOREIGN KEY (MaidID) REFERENCES Maid(MaidID)
    ON UPDATE CASCADE
    ON DELETE NO ACTION,
    FOREIGN KEY (AttendanceID) REFERENCES Attendance(AttendanceID)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)

DROP TABLE Teacherreport;

INSERT INTO MaidReport (ReportID, AttendanceID, Viewed, MaidID) VALUES
(1, 1, 0, 1),
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
    FOREIGN KEY (TeacherID) REFERENCES Teacher(TeacherID) 
    ON UPDATE CASCADE
    ON DELETE NO ACTION,
    FOREIGN KEY (ChildID) REFERENCES Child (ChildID) 
    ON UPDATE CASCADE 
    ON DELETE CASCADE
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
    ('2025-01-13', 'Breakfast', 'Strawberries', 1.75),
    ('2025-01-13', 'Breakfast', 'Granola Bar', 1.50),
    ('2025-01-13', 'Breakfast', 'Banana', 0.75),
    ('2025-01-13', 'Lunch', 'Energy Ball', 2.00),
    ('2025-01-13', 'Lunch', 'Muffin', 2.50),
    ('2025-01-13', 'Lunch', 'Yogurt', 1.50),
    ('2025-01-13', 'Dinner', 'Graham Crackers', 1.25),
    ('2025-01-13', 'Dinner', 'Trail Mix', 2.25),
    ('2025-01-13', 'Dinner', 'Cheese Crackers', 1.75),
    ('2025-01-14', 'Breakfast', 'Peach Slices', 1.50),
    ('2025-01-14', 'Breakfast', 'Apple Slices', 1.25),
    ('2025-01-14', 'Breakfast', 'Carrot Sticks with Hummus', 2.50),
    ('2025-01-14', 'Lunch', 'Cupcake', 3.00),
    ('2025-01-14', 'Lunch', 'Protein Bar', 2.50),
    ('2025-01-14', 'Lunch', 'Pretzels', 1.00),
    ('2025-01-14', 'Dinner', 'Hot Cocoa', 2.50),
    ('2025-01-14', 'Dinner', 'Ice Cream Cup', 2.75),
    ('2025-01-14', 'Dinner', 'Fruit Smoothie', 3.50),
    ('2025-01-15', 'Breakfast', 'Mixed Nuts', 2.00),
    ('2025-01-15', 'Breakfast', 'Hard-Boiled Egg', 1.00),
    ('2025-01-15', 'Breakfast', 'Granola with Milk', 2.00),
    ('2025-01-15', 'Lunch', 'Cheese Sticks', 1.50),
    ('2025-01-15', 'Lunch', 'Veggie Chips', 1.50),
    ('2025-01-15', 'Lunch', 'Popcorn', 1.00),
    ('2025-01-15', 'Dinner', 'Rice Cake with Almond Butter', 2.00),
    ('2025-01-15', 'Dinner', 'Mini Sandwich', 2.75),
    ('2025-01-15', 'Dinner', 'Chocolate Chip Cookie', 1.50);


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
    SnackRequest (
        SnackID,
        ChildID,
        Quantity
    )
VALUES
    (1, 1, 2),
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
        '2025-01-05',
        '08:30:00',
        '2-3',
        'Math'
    ),
    (
        14,
        '2025-01-05',
        '10:00:00',
        '4-5',
        'Science'
    ),
    (
        14,
        '2025-01-06',
        '08:30:00',
        '6-7',
        'English'
    ),
    (
        14,
        '2025-01-06',
        '10:00:00',
        '8-9',
        'History'
    ),
    (
        14,
        '2025-01-07',
        '08:30:00',
        '10-11',
        'Geography'
    ),
    (
        14,
        '2025-01-07',
        '10:00:00',
        '12-13',
        'Arts'
    ),
    (
        14,
        '2025-01-08',
        '08:30:00',
        '14-15',
        'Physical Education'
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
    RecieverID INT NOT NULL,
    Message VARCHAR(200),
    Image BLOB,
    ChildID INT NOT NULL,
    SentDate DATETIME DEFAULT CURRENT_TIMESTAMP, -- Date and time when the message was sent
    Seen BOOLEAN DEFAULT 0, -- If the receiver has seen the message (0 = No, 1 = Yes)
    DeletedBySender BOOLEAN DEFAULT 0, -- If the sender has deleted the message (0 = No, 1 = Yes)
    Delivered BOOLEAN DEFAULT 0, -- If the message has been delivered (0 = No, 1 = Yes)
    PRIMARY KEY (ChatID),
    FOREIGN KEY (SenderID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (RecieverID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
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
    )
;

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
    FOREIGN KEY (TeacherID) REFERENCES Teacher(TeacherID) 
    ON UPDATE CASCADE
    ON DELETE NO ACTION
);

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
    FOREIGN KEY (EventID) REFERENCES Event(EventID)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (ChildID) REFERENCES Child(ChildID)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

INSERT INTO Event (EventName, Date, TeacherID, Description, Image, BlogID)
VALUES 
('Art Workshop', '2024-12-15', 1, 'Learn painting skills.', 'BLOB data here', NULL),
('Science Fair', '2023-05-20', 2, 'Explore innovations.', 'BLOB data here', 1),
('Music Fest', '2025-06-10', 1, 'Enjoy live music.', 'BLOB data here', NULL),
('Sports Day', '2023-08-05', 2, 'Participate in sports.', 'BLOB data here', 2),
('Coding Camp', '2023-11-01', 1, 'Intro to programming.', 'BLOB data here', NULL),
('Drama Workshop', '2024-03-15', 2, 'Acting skills training.', 'BLOB data here', NULL),
('Math Olympiad', '2023-09-10', 1, 'Challenge your math skills.', 'BLOB data here', 3),
('History Seminar', '2025-01-20', 2, 'Learn about history.', 'BLOB data here', NULL),
('Robotics Fair', '2024-07-25', 1, 'Explore robotics.', 'BLOB data here', 4),
('Chess Tournament', '2023-10-12', 2, 'Competitive chess.', 'BLOB data here', NULL);

INSERT INTO EventEnrollment (EventID, ChildID, Reason, Review, Rating)
VALUES 
(1, 1, 'Interested in art.', 'Amazing workshop!', 5),
(1, 2, 'Loves painting.', 'Good experience.', 4),
(2, 3, 'Curious about science.', 'Informative event.', 5),
(2, 4, 'Loves experiments.', 'Great event for kids.', 4),
(3, 1, 'Loves music.', 'Incredible!', 5),
(3, 5, 'Interested in live music.', 'Enjoyable concert.', 4),
(4, 2, 'Sports enthusiast.', 'Well-organized.', 4),
(4, 3, 'Participates in sports.', 'Fun and engaging.', 5),
(5, 4, 'Interested in coding.', 'Great experience.', 5),
(5, 5, 'Wants to learn coding.', 'Very informative.', 4),
(6, 1, 'Passionate about acting.', 'Loved it!', 5),
(6, 2, 'Interested in drama.', 'Good workshop.', 4),
(7, 3, 'Math lover.', 'Challenging and fun.', 5),
(7, 4, 'Competes in math.', 'Very well-organized.', 4),
(8, 5, 'Enjoys history.', 'Insightful seminar.', 4),
(8, 1, 'Loves historical topics.', 'Highly educational.', 5),
(9, 2, 'Interested in robotics.', 'Super informative.', 5),
(9, 3, 'Likes robotics.', 'Great for beginners.', 4),
(10, 4, 'Chess lover.', 'Very competitive.', 5),
(10, 5, 'Wants to improve skills.', 'Great atmosphere.', 4);

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
    Image BLOB,
    DateAdded DATE NOT NULL,
    AddedUserID INT NOT NULL,
    PRIMARY KEY (MediaID),
    FOREIGN KEY (AddedUserID) REFERENCES User (UserID) ON UPDATE CASCADE ON DELETE CASCADE
);

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