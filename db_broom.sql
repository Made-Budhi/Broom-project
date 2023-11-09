CREATE DATABASE pbl_test;

USE pbl_test;

/*
convention yang aku pakek
https://courses.cs.washington.edu/courses/cse154/18au/resources/styleguide/sql/naming-conventions-sql.html
*/

CREATE TABLE User
(
  /*
   aku malah keinget kalimat pak ambara tadi (30/10/2023), klo data yang di
   input manual user mendingan jangan dijadiin PK, tapi dibuatin id AI aja
   tergantung diskusi kita nanti sih
   */
  user_id  VARCHAR(18)  NOT NULL UNIQUE,
  name     VARCHAR(254) NOT NULL,
  phone    VARCHAR(15)  NOT NULL,
  role     ENUM (
    'Mahasiswa', 'Pegawai'
    )                   NOT NULL,
  email    VARCHAR(254) NOT NULL,
  password VARCHAR(32)  NOT NULL,

  PRIMARY KEY (user_id)
);



CREATE TABLE Room
(
  room_id INT                  NOT NULL AUTO_INCREMENT,
  name    VARCHAR(254)         NOT NULL,
  status  BOOLEAN DEFAULT TRUE NOT NULL,

  PRIMARY KEY (room_id)
);

CREATE TABLE Director
(
  director_id CHAR(18)     NOT NULL UNIQUE,
  name        VARCHAR(254) NOT NULL,
  email       VARCHAR(254) NOT NULL,
  password    VARCHAR(32)  NOT NULL,
  position    ENUM (
    'Direktur', 'Direktur 1', 'Direktur 2', 'Direktur 3'
    /*masih kurang tau*/
    ),

  PRIMARY KEY (director_id)
);

CREATE TABLE Reservation
(
  reserve_id      INT          NOT NULL UNIQUE AUTO_INCREMENT,
  user_id         VARCHAR(18),
  room_id         INT,
  director_id     CHAR(18),
  document_number VARCHAR(20)  NOT NULL, /*gak tau panjangnya*/
  date_start      DATETIME     NOT NULL,
  date_end        DATETIME     NOT NULL,
  purpose         VARCHAR(254) NOT NULL,
  status          ENUM (
    'Diterima', 'Ditolak', 'Menunggu'
    )                          NOT NULL,

  PRIMARY KEY (reserve_id),
  FOREIGN KEY (user_id) REFERENCES User (user_id),
  FOREIGN KEY (room_id) REFERENCES Room (room_id),
  FOREIGN KEY (director_id) REFERENCES Director (director_id)
);

CREATE TABLE Manager
(
  manager_id CHAR(18)     NOT NULL UNIQUE,
  name       VARCHAR(254) NOT NULL,
  email      VARCHAR(254) NOT NULL,
  password   VARCHAR(32)  NOT NULL,

  PRIMARY KEY (manager_id)
);

