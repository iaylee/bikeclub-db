DROP TABLE Student CASCADE CONSTRAINTS;
DROP TABLE Member CASCADE CONSTRAINTS;
DROP TABLE Facility CASCADE CONSTRAINTS;
DROP TABLE LockersIn CASCADE CONSTRAINTS;
DROP TABLE BikeHas CASCADE CONSTRAINTS;
DROP TABLE Duration CASCADE CONSTRAINTS;
DROP TABLE Booking CASCADE CONSTRAINTS;
DROP TABLE MerchandisePurchased CASCADE CONSTRAINTS;
DROP TABLE Lesson CASCADE CONSTRAINTS;
DROP TABLE Instructor CASCADE CONSTRAINTS;
DROP TABLE Teaches CASCADE CONSTRAINTS;
DROP TABLE Enrolled CASCADE CONSTRAINTS;
DROP TABLE SocialEvents CASCADE CONSTRAINTS;
DROP TABLE Registered CASCADE CONSTRAINTS;
DROP TABLE Volunteer CASCADE CONSTRAINTS;
DROP TABLE Shift CASCADE CONSTRAINTS;

CREATE TABLE Student(
    StudentID CHAR(8),
    StudentName CHAR(20),
    DateRegistered DATE,
    StudentPhoneNo CHAR(12) UNIQUE,
    PRIMARY KEY (StudentID)
);

CREATE TABLE Member(
    StudentID CHAR(8),
    StudentName CHAR(20),
    DateRegistered DATE,
    StudentPhoneNo CHAR(12),
    MembershipStatus CHAR(12),
    BankingInfo CHAR(19),
    PRIMARY KEY (StudentID),
    FOREIGN KEY (StudentID) REFERENCES Student ON DELETE CASCADE
);

CREATE TABLE Facility(
    UnitNumber INT,
    PostalCode CHAR(6),
    City CHAR(20),
    StreetName CHAR(20),
    CapacityOfPeople INT,
    NumberOfBikes INT,
    PRIMARY KEY (UnitNumber, PostalCode)
);

CREATE TABLE LockersIn(
    Booked CHAR(1) not null,
    LockerNumber INT,
    PostalCode CHAR(6),
    UnitNumber INT,
    PRIMARY KEY (LockerNumber, UnitNumber, PostalCode),
    FOREIGN KEY (UnitNumber, PostalCode) REFERENCES Facility ON DELETE CASCADE
); 

CREATE TABLE BikeHas(
    BikeSerialNumber INT,
    Model CHAR(20),
    BookedStatus CHAR(1) not null,
    Condition CHAR(8),
    PostalCode CHAR(6),
    UnitNumber INT,
    PRIMARY KEY (BikeSerialNumber),
    FOREIGN KEY (UnitNumber, PostalCode) REFERENCES Facility
); 

CREATE TABLE Duration(
    StartTime TIMESTAMP,
    EndTime TIMESTAMP,
    Duration INT,
    PRIMARY KEY (StartTime, EndTime)
);

CREATE TABLE Booking(
    StudentID CHAR(8),
    BikeSerialNumber INT,
    StartTime TIMESTAMP,
    EndTime TIMESTAMP,
    DateBooked DATE,
    PRIMARY KEY (StudentID, BikeSerialNumber),
    FOREIGN KEY (StudentID) REFERENCES Member,
    FOREIGN KEY (StartTime, EndTime) REFERENCES Duration,
    FOREIGN KEY (BikeSerialNumber) REFERENCES BikeHas ON DELETE CASCADE
); 

CREATE TABLE MerchandisePurchased(
    Cost FLOAT,
    Type CHAR(20),
    UPC CHAR(12),
    DatePurchased DATE,
    StudentID CHAR(8),
    PRIMARY KEY (UPC),
    FOREIGN KEY (StudentID) REFERENCES Student
);

CREATE TABLE Lesson(
    LessonID CHAR(8),
    LessonDate DATE,
    LessonStartTime TIMESTAMP,
    LessonEndTime TIMESTAMP,
    NumberOfRegistrants INT,
    Location CHAR(20),
    PRIMARY KEY (LessonID)
);

CREATE TABLE Instructor(
    InstructorID CHAR(8),
    Age INT,
    Name CHAR(20),
    DateHired DATE,
    Income INT,
    InstructorPhoneNo CHAR(12),
    PRIMARY KEY (InstructorID)
);

CREATE TABLE Teaches(
    InstructorID CHAR(8), 
    LessonID CHAR(8), 
    LessonDate DATE,
    StartTime TIMESTAMP,
    EndTime TIMESTAMP,
    Location CHAR(20),
    NumberOfRegistrants INT,
    PRIMARY KEY (InstructorID, LessonID),
    FOREIGN KEY (InstructorID) REFERENCES Instructor ON DELETE CASCADE, 
    FOREIGN KEY (LessonID) REFERENCES Lesson ON DELETE CASCADE
);

CREATE TABLE Enrolled(
    StudentID CHAR(8),
    LessonID CHAR(8),
    LessonDate DATE,
    StartTime TIMESTAMP,
    EndTime TIMESTAMP,
    Location CHAR(20),
    NumberOfRegistrants INT,
    PRIMARY KEY (StudentID, LessonID),
    FOREIGN KEY (StudentID) REFERENCES Student,
    FOREIGN KEY (LessonID) REFERENCES Lesson ON DELETE CASCADE
);

CREATE TABLE SocialEvents(
    SocialEventName CHAR(20),
    EventDate DATE,
    StartTime TIMESTAMP,
    Capacity INT,
    NumberOfRegistrants INT,
    Location CHAR(20),
    PRIMARY KEY (SocialEventName, EventDate)
);

CREATE TABLE Registered(
    SocialEventName CHAR(20),
    EventDate DATE,
    StudentID CHAR(8),
    StudentName CHAR(20),
    DateRegistered DATE,
    StudentPhoneNo CHAR(12),
    MembershipStatus CHAR(12),
    BankingInfo CHAR(19),
    PRIMARY KEY (SocialEventName, EventDate, StudentID),
    FOREIGN KEY (SocialEventName, EventDate) REFERENCES SocialEvents,
    FOREIGN KEY (StudentID) REFERENCES Member
);

CREATE TABLE Volunteer(
    StudentID CHAR(8),
    StudentName CHAR(8),
    DateRegistered DATE,
    StudentPhoneNo CHAR(12),
    TotalVolunteerHours INT,
    PRIMARY KEY (StudentID),
    FOREIGN KEY (StudentID) REFERENCES Student
);

CREATE TABLE Shift(
    StudentID CHAR(8),
    ShiftID CHAR(8),
    Duration INT,
    StartTime TIMESTAMP,
    Location CHAR(20),
    ShiftDate DATE,
    PRIMARY KEY (ShiftID),
    FOREIGN KEY (StudentID) REFERENCES Volunteer
);