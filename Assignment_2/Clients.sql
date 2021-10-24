-- Registered Users
CREATE TABLE Clients (
                           loginName   VARCHAR(20)                 NOT NULL,
                           password    VARCHAR(20)                 NOT NULL,
                           firstName   VARCHAR(20)                 NOT NULL,
                           lastName    VARCHAR(20)                 NOT NULL,
                           birthDate   DATE                         NOT NULL,
                           gender      VARCHAR(1)                  NOT NULL,
                           contact     VARCHAR(15)                     NOT NULL,
                           email       VARCHAR(20)                 NOT NULL,
                           PRIMARY KEY (loginName)
);



INSERT INTO Clients VALUE ('userlogin', 'password', 'firstname', 'lastname', '2000-01-01', 'F', '123456789', '444283027@qq.com') ;
-- SELECT * FROM Clients;
-- drop table Clients;


-- DELETE FROM Clients WHERE loginName = 'WZ';

-- SELECT password FROM Clients WHERE loginName = 'z';

-- Concatenate user information
-- SELECT CONCAT(firstName,' ',lastName) AS fullname FROM clients;

-- Update client info
-- UPDATE clients SET lastName = 'changedLastName' WHERE loginName = 'user';