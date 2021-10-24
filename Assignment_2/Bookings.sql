CREATE TABLE Flights(
    Reference      VARCHAR(10)     PRIMARY KEY     NOT NULL ,
    username    VARCHAR(20)                         NOT NULL,
    totalCost   INT(8)                          NOT NULL
);

CREATE TABLE Prices(
    RouteID VARCHAR(4)  NOT NULL ,
    Price   Int(4)      NOT NULL,
    PRIMARY KEY (RouteID)
);

INSERT INTO Prices VALUE ('R01',329);
INSERT INTO Prices VALUE ('R02',109);
INSERT INTO Prices VALUE ('R03',219);
INSERT INTO Prices VALUE ('R04',129);
INSERT INTO Prices VALUE ('R05',199);


CREATE TABLE TimetableFull
AS
SELECT * FROM Timetable
                  INNER JOIN Week ON Timetable.DepartDOW =Week.ID
                  INNER JOIN Destinations ON Timetable.ArrivePort = Destinations.code
-- INNER JOIN Destinations.airport AS DepartPortName ON Timetable.DepartPort = Destinations.code
                  INNER JOIN Aircraft ON Timetable.AircraftCode = Aircraft.craftID
                  INNER JOIN Prices ON Timetable.RouteCode= Prices.RouteID
ORDER BY DepartDOW,Departtime ASC;

ALTER TABLE TimetableFull
    CHANGE COLUMN airport ArrivePortName VARCHAR(55);

# SELECT Destinations.airport
# INTO DepartPortName
# FROM TimetableFull
# WHERE TimetableFull.DepartPort = Destinations.code;
UPDATE TimetableFull SET DepartPortName = ('Dairy Flat Airport') WHERE DepartPort = 'NZNE' ;
UPDATE TimetableFull SET DepartPortName = ('Sydney') WHERE DepartPort = 'YSSY' ;
UPDATE TimetableFull SET DepartPortName = ('Rotorua') WHERE DepartPort = 'NZRO' ;
UPDATE TimetableFull SET DepartPortName = ('Chatham Islands') WHERE DepartPort = 'NZCI' ;
UPDATE TimetableFull SET DepartPortName = ('Great Barrier Island') WHERE DepartPort = 'NZGB' ;
UPDATE TimetableFull SET DepartPortName = ('Lake Tekapo Airport') WHERE DepartPort = 'NZTL' ;
