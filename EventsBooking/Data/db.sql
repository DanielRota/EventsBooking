CREATE DATABASE IF NOT EXISTS EventsBooking;
USE EventsBooking;
CREATE TABLE IF NOT EXISTS Events (
    pkEvent INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    EventName VARCHAR(50) NOT NULL,
    EventDescription VARCHAR(50) NOT NULL,
    PeopleNumber INT NOT NULL
);