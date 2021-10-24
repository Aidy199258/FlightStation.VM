
CREATE TABLE Week(
        ID  INT PRIMARY KEY NOT NULL,
        DayOfWeek VARCHAR(9) NOT NULL
);

INSERT  INTO   Week   VALUE (0,'Sunday');
INSERT  INTO   Week   VALUE (1,'Monday');
INSERT  INTO   Week   VALUE (2,'Tuesday');
INSERT  INTO   Week   VALUE (3,'Wednesday');
INSERT  INTO   Week   VALUE (4,'Thursday');
INSERT  INTO   Week   VALUE (5,'Friday');
INSERT  INTO   Week   VALUE (6,'Saturday');

/*
CREATE TABLE Timetable (
    DepartPort VARCHAR(10)  NOT NULL ,
    ArrivePort VARCHAR(10)  NOT NULL ,
    DepartTime  VARCHAR(20)    NOT NULL ,
    ArriveTime  VARCHAR(20)    NOT NULL ,
    FlightTime  VARCHAR(10) NOT NULL,
    Aircraft    VARCHAR(10) NOT NULL


);*/

CREATE TABLE DairyFlatFlights(
                               RouteCode       VARCHAR(3)      NOT NULL ,
                               DepartDOW       INT(1)          NOT NULL ,
                               DepartPort      VARCHAR(4)      NOT NULL ,
                               ArrivePort      VARCHAR(4)      NOT NULL ,
                               DepartTime      VARCHAR(10)     NOT NULL ,
                               ArriveTime      VARCHAR(10)     ,
                               FlightTime      VARCHAR(10)     ,
                               AircraftCode    VARCHAR(20) NOT NULL

);

INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R01','5','NZNE','YSSY','1500', 'A01');

INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','1','NZNE','NZRO','0830', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','1','NZNE','NZRO','1600', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','2','NZNE','NZRO','0830', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','2','NZNE','NZRO','1600', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','3','NZNE','NZRO','0830', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','3','NZNE','NZRO','1600', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','4','NZNE','NZRO','0830', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','4','NZNE','NZRO','1600', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','5','NZNE','NZRO','0830', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','5','NZNE','NZRO','1600', 'A02');

INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','1','NZNE','NZGB','0900', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','3','NZNE','NZGB','0900', 'A02');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','5','NZNE','NZGB','0900', 'A02');

INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','2','NZNE','NZCI','1000', 'A03');
INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','5','NZNE','NZCI','1000', 'A03');

INSERT INTO DairyFlatFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','1','NZNE','NZTL','1300', 'A03');


CREATE TABLE SydneyFlights(
                               RouteCode       VARCHAR(3)      NOT NULL ,
                               DepartDOW       INT(1)          NOT NULL ,
                               DepartPort      VARCHAR(4)      NOT NULL ,
                               ArrivePort      VARCHAR(4)      NOT NULL ,
                               DepartTime      VARCHAR(10)     NOT NULL ,
                               ArriveTime      VARCHAR(10)     ,
                               FlightTime      VARCHAR(10)     ,
                               AircraftCode    VARCHAR(20) NOT NULL

);
INSERT INTO SydneyFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R01','0','YSSY','NZNE','1500 ', 'A01');


CREATE TABLE RotoruaFlights(
                             RouteCode       VARCHAR(3)      NOT NULL ,
                             DepartDOW       INT(1)          NOT NULL ,
                             DepartPort      VARCHAR(4)      NOT NULL ,
                             ArrivePort      VARCHAR(4)      NOT NULL ,
                             DepartTime      VARCHAR(10)     NOT NULL ,
                             ArriveTime      VARCHAR(10)     ,
                             FlightTime      VARCHAR(10)     ,
                             AircraftCode    VARCHAR(20) NOT NULL

);

INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','1','NZRO','NZNE','1200 ', 'A02');
INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','1','NZRO','NZNE','2000 ', 'A02');

INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','2','NZRO','NZNE','1200 ', 'A02');
INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','2','NZRO','NZNE','2000 ', 'A02');

INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','3','NZRO','NZNE','1200 ', 'A02');
INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','3','NZRO','NZNE','2000 ', 'A02');

INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','4','NZRO','NZNE','1200 ', 'A02');
INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','4','NZRO','NZNE','2000 ', 'A02');

INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','5','NZRO','NZNE','1200 ', 'A02');
INSERT INTO RotoruaFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R02','5','NZRO','NZNE','2000 ', 'A02');

CREATE TABLE GreatBarrierFlights(
    RouteCode       VARCHAR(3)      NOT NULL ,
    DepartDOW       INT(1)          NOT NULL ,
    DepartPort      VARCHAR(4)      NOT NULL ,
    ArrivePort      VARCHAR(4)      NOT NULL ,
    DepartTime      VARCHAR(10)     NOT NULL ,
    ArriveTime      VARCHAR(10)     ,
    FlightTime      VARCHAR(10)     ,
    AircraftCode    VARCHAR(20) NOT NULL
);

INSERT INTO GreatBarrierFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','2','NZGB','NZNE','0900', 'A02');
INSERT INTO GreatBarrierFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','4','NZGB','NZNE','0900', 'A02');
INSERT INTO GreatBarrierFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R04','6','NZGB','NZNE','0900', 'A02');

CREATE TABLE ChathamIslFlights(
                                    RouteCode       VARCHAR(3)      NOT NULL ,
                                    DepartDOW       INT(1)          NOT NULL ,
                                    DepartPort      VARCHAR(4)      NOT NULL ,
                                    ArrivePort      VARCHAR(4)      NOT NULL ,
                                    DepartTime      VARCHAR(10)     NOT NULL ,
                                    ArriveTime      VARCHAR(10)     ,
                                    FlightTime      VARCHAR(10)     ,
                                    AircraftCode    VARCHAR(20) NOT NULL
);

INSERT INTO ChathamIslFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','3','NZCI','NZNE','1000', 'A03');
INSERT INTO ChathamIslFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','6','NZCI','NZNE','1000', 'A03');

CREATE TABLE LakeTekapoFlights(
                                  RouteCode       VARCHAR(3)      NOT NULL ,
                                  DepartDOW       INT(1)          NOT NULL ,
                                  DepartPort      VARCHAR(4)      NOT NULL ,
                                  ArrivePort      VARCHAR(4)      NOT NULL ,
                                  DepartTime      VARCHAR(10)     NOT NULL ,
                                  ArriveTime      VARCHAR(10)     ,
                                  FlightTime      VARCHAR(10)     ,
                                  AircraftCode    VARCHAR(20) NOT NULL
);

INSERT INTO LakeTekapoFlights  (RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode)
VALUES ('R03','5','NZTL','NZNE','1300', 'A03');

-- SELECT * FROM DairyflatFlights;
-- SELECT * FROM SydneyFlights;
-- DROP TABLE DairyFlatFlights;
-- DROP TABLE Week;
-- DROP TABLE sydneyflights;

-- Combine two ports and order by DepartDOW
-- SELECT DepartDOW, RouteCode, DepartPort,DepartTime FROM sydneyflights INNER JOIN
-- SELECT * FROM DairyFlatFlights INNER JOIN Week ON DairyFlatFlights.DepartDOW = Week.ID where ID = 2 ORDER BY DepartTime ASC ;
-- union all
-- SELECT DepartDOW, RouteCode, DepartPort,DepartTime FROM  DairyFlatFlights order by DepartDOW;
-- SELECT * FROM DairyFlatFlights
--                  INNER JOIN Week ON DairyFlatFlights.DepartDOW = Week.ID
--                  INNER JOIN Destinations ON dairyflatflights.DepartPort = Destinations.code
  --                 INNER JOIN aircraft ON dairyflatflights.AircraftCode = aircraft.craftID
-- where ID = '5'
-- ORDER BY DepartTime ASC ;

CREATE TABLE Timetable
AS
    SELECT * FROM DairyFlatFlights
UNION
    SELECT * FROM SydneyFlights
UNION
    SELECT * FROM RotoruaFlights
UNION
    SELECT * FROM GreatBarrierFlights
UNION
    SELECT * FROM ChathamIslFlights
UNION
    SELECT * FROM LakeTekapoFlights;


#
#
# ALTER TABLE TimetableFull ADD airport VARCHAR(55);


#
# UPDATE TimetableFull
#
# SET airport = Destinations.airport FROM Destinations WHERE TimetableFull.ArrivePort = Destinations.code;
#
# INSERT INTO TimetableFull
# SELECT airport FROM destinations
# WHERE Destinations.code=TimetableFull.ArrivePort ;
# AS DepartPortName
#  INNER JOIN Destinations AS ArrivePortName ON Timetable.ArrivePort = Destinations.code
#
# INSERT INTO TimetableFull (FlightTime, ArriveTime)
# VALUES (value1, value2, value3, ...);
#
# SELECT * FROM TimetableFull;
#
# SELECT * FROM timetablefull
# WHERE DepartDOW = 5 AND DepartPort = 'NZNE' AND ArrivePort = 'YSSY' ORDER BY DepartTime ASC;
#
# INSERT INTO TimetableFull AS DepartAirport WHERE Timetable.DepartPort = Destinations.code