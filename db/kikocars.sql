PRAGMA foreign_keys=ON;
BEGIN TRANSACTION;
CREATE TABLE cars(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name nchar not null,
    category int default 0,
    img nchar default 'default.png',
    passengers int default 5,
    baggage int default 1,
    automatic binary default 0,
    fuel binary default 0,
    ac binary default 1,
    lock binary default 0,
    price int default 30,
    extras nchar
);
CREATE TABLE reservations (
    name nchar not null,
    lastname nchar not null,
    email nchar not null,
    phone nchar not null,
    address nchar,
    zipcode int,
    city nchar,
    country nchar,
    birthdate date not null,
    travelingfrom nchar,
    flight nchar,
    notes nchar,
    datestart date not null,
    dateend date not null,
    promo nchar,
    car,
    confirmed binary default 0,
    code nchar not null,
    FOREIGN KEY(car) REFERENCES cars(id)
);
CREATE TABLE availability (
    car,
    datestart date not null,
    dateend date not null /*cronjob: DELETE FROM availability WHERE dateend < CURRENT_DATE*/,
    FOREIGN KEY(car) REFERENCES cars(id)
);
INSERT INTO cars(id, name, img) VALUES(0, 'FIAT PANDA','fiat-panda.png');
/*id, name, category, img, passengers, baggage, auto, fuel, ac, lock, price */
/*categories: 0 economy, 1 standard, 2 compact, 3 compact suv, 4 van, 5 luxury, 6 luxury van*/
INSERT INTO cars(name, img) VALUES('TOYOTA AYGO 2DOOR','toyota-aygo-2door.png');
INSERT INTO cars(name, img) VALUES('TOYOTA AYGO','toyota-aygo.png');
INSERT INTO cars(name, img) VALUES('HYUNDAI I10','i10.png');
INSERT INTO cars(name, img, category, baggage) VALUES('SKODA FABIA','skoda-fabia.png',1,2);
INSERT INTO cars(name, img, category, baggage) VALUES('HYUNDAI I20','i20.png',1,2);
INSERT INTO cars(name, img, category, baggage) VALUES('NISSAN MICRA','micra.png',1,2);
INSERT INTO cars(name, img, category, baggage, automatic) VALUES('NISSAN MICRA','micra.png',1,2,1);
INSERT INTO cars(name, img, category, baggage) VALUES('RENAULT CLIO','clio.png',1,2);
INSERT INTO cars(name, img, category, baggage) VALUES('CITROEN C1 CABRIO','c1.png',1,3);
INSERT INTO cars(name, img, category, baggage, fuel) VALUES('CITROEN C4','c4.png',2,3,1);
INSERT INTO cars(name, img, category, baggage, fuel) VALUES('PEUGEOT 301','301.png',2,4,1);
INSERT INTO cars(name, img, category, baggage, fuel, automatic) VALUES('PEUGEOT 301','301-auto.png',2,4,1,1);
INSERT INTO cars(name, img, category, baggage) VALUES('TOYOTOTA COROLLA','corola.png',2,4);
INSERT INTO cars(name, img, category, baggage, fuel) VALUES('DACIA SANDERO','sandero.png',3,4,1);
INSERT INTO cars(name, img, category, baggage, passengers, fuel) VALUES('NISSAN EVALIA','evalia.png',4,5,8,1);
INSERT INTO cars(name, img, category, baggage, fuel) VALUES('MERCEDES VIANO','viano.png',6,5,1);
INSERT INTO cars(name, img, category, baggage, fuel, automatic, extras, lock) VALUES('MERCEDES E-CLASS', 'eclass.png', 5, 4, 1, 1, 'diesel-hybrid', 1);
INSERT INTO cars(name, img, category, baggage, fuel, automatic, lock) VALUES('RANGE ROVER', 'rangerover.png', 5, 4, 1, 1, 1); /*clima: when it's a luxury car, change if inappropriate*/
COMMIT;
