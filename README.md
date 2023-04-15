### University Bike Club

## Project Summary

An on-campus bike sharing club/program for university students. Students can pay an annual membership fee to become a member which will allow them to book the club’s bicycles and facilities. Students can also volunteer at the club while members can attend member-only social events or lessons.

Built with Oracle, PHP, HTML and CSS.

Tables implemented: Student, Member, Bikes, Facility and Volunteer + Shift

Commands implemented:
- Projection: user is able to choose attributes that they want to see in the table
   - Done on the BikeHas table, with its attributes BikeSerialNumber, Model, BookedStatus, Condition, PostalCode and UnitNumber.

- Join: find the phone number of volunteers who have volunteered for a shift at a location
   - Done on the Volunteer and Shift table, looking for volunteer's name and phone number.

- Aggregation with GROUP BY: sum of bikes per city
    ```sql
    SELECT City, SUM(NumberOfBikes) AS total_bikes FROM Facility GROUP BY City;
    ```
- Expected output: 

| City | Total # of Bikes |
| :---:   | :---: | 
| Vancouver | 20   |
| Richmond | 58   | 
| Burnaby | 60   | 

- Aggregation with HAVING: cities with avg no of bikes > 25 in facilities 
    ```sql
    SELECT City, AVG(NumberOfBikes) as avg_bikes FROM Facility GROUP BY City HAVING AVG(NumberOfBikes) > 25;
    ```
- Expected output:

| City |  Total # of Bikes|
| :---:   | :---: |
| Richmond | 29   | 
| Burnaby | 30   | 

- Nested Aggregation with GROUP BY: avg number of people for each city where avg number of people is greater than the avg number of facilities across all cities
    ```sql
    SELECT City, AVG(CapacityOfPeople) AS avg_capacity FROM Facility GROUP BY City HAVING COUNT(*) > (SELECT AVG(num_facilities) FROM (SELECT COUNT(*) AS num_facilities FROM Facility GROUP BY City));
    ```
- Expected Output:

| City |  Total # of Bikes |
| :---:   | :---: |
| Vancouver | 28   | 

- Division:
    ```sql
    SELECT COUNT(*) AS num_non_volunteers FROM Student WHERE StudentID NOT IN (SELECT StudentID FROM Member);
    SELECT COUNT(*) AS num_non_volunteers FROM Student WHERE StudentID NOT IN (SELECT StudentID FROM Volunteer);
    ```
- Expected output:

| Count | 
| :---:   | 
| 3 | 
| 2 | 


## Schema Changes Made
- Volunteer and Member do not need DateRegistered and Name as the FK (resolved in CREATE statements)
- Instructors is missing a PhoneNo attribute (resolevd in CREATE statements)
- Shift needs to be merged with Assigned and reference Volunteer's StudentID as the FK (cardinality constraint) (resolved in CREATE statements which do not have a SHIFT table and FK is assigned)

## CREATE Tables Changes Made
- All ON UPDATE CASCADE removed (No Oracle support)
- All StartTime/EndTime converted to TIMESTAMP variable
- All PhoneNo converted to CHAR(12) variable
- Member:
    - StudentID is a FK of Student
    - DateRegistered -> EnrolDate
    - ON DELETE CASCADE added for FK
- Booking: 
    - StartTime and EndTime should be FK of Duration
    - Date -> DateBooked
    - Booked BOOLEAN -> CHAR(1) (Y/N) -- Oracle has no BOOLEAN datatype
- Duration: 
    - Duration TIME -> INT**
- Instructor: 
    - DateRegistered -> DateHired
- Teaches: 
    - Date -> LessonDate
    - Removed StartTime, EndTime**
- Enrolled: 
    - StudentID is a FK of Student
    - Date -> LessonDate
    - Removed StartTime, EndTime**
- SocialEvents: Date -> EventDate
- Registered: 
    - Date -> EventDate
- Shift: 
    - Date -> ShiftDate
- Lesson:
    - Date -> LessonDate
    - StartTime -> LessonStartTime
    - EndTime -> LessonEndTime
