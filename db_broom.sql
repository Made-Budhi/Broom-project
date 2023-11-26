CREATE DATABASE db_broom;

-- DROP DATABASE db_broom;

USE db_broom;

/*
convention yang aku pakek
https://courses.cs.washington.edu/courses/cse154/18au/resources/styleguide/sql/naming-conventions-sql.html
*/

CREATE TABLE Account (
	account_id 		INT AUTO_INCREMENT,
	email 			VARCHAR(254) NOT NULL,
	password 		VARCHAR(254) NOT NULL,
	role			ENUM('Peminjam', 'Pimpinan', 'Pengelola') NOT NULL,

	PRIMARY KEY (account_id)
);

CREATE TABLE Peminjam
(
	id  			CHAR(18)  NOT NULL UNIQUE,
	name     		VARCHAR(254) NOT NULL,
	phone    		VARCHAR(15)  NOT NULL,
	role     		ENUM ('Mahasiswa', 'Pegawai') NOT NULL,
	account_id		INT UNIQUE NOT NULL,

	FOREIGN KEY (account_id) REFERENCES Account(account_id),
	PRIMARY KEY (id)
);

CREATE TABLE Pimpinan
(
	id 				CHAR(18)     NOT NULL UNIQUE,
	name        	VARCHAR(254) NOT NULL,
	position		VARCHAR(254) NOT NULL,
	account_id		INT UNIQUE NOT NULL,

	FOREIGN KEY (account_id) REFERENCES Account(account_id),
	PRIMARY KEY (id)
);

CREATE TABLE Pengelola (
   id				CHAR(18) NOT NULL,
   name				VARCHAR(254) NOT NULL,
   account_id		INT UNIQUE NOT NULL,

   FOREIGN KEY (account_id) REFERENCES Account(account_id),
   PRIMARY KEY (id)
);

CREATE TABLE Ruangan
(
	id		 	INT NOT NULL AUTO_INCREMENT,
	name   		VARCHAR(254) NOT NULL,
	status  	BOOLEAN DEFAULT TRUE NOT NULL,

	PRIMARY KEY (id)
);

CREATE TABLE Reservasi
(
	reservasi_id		INT NOT NULL UNIQUE AUTO_INCREMENT,
	peminjam_id			VARCHAR(18),
	ruangan_id      	INT,
	pimpinan_id     	CHAR(18),
	document_number 	VARCHAR(20) NOT NULL,
	date_start      	DATETIME NOT NULL,
	date_end        	DATETIME NOT NULL,
	purpose         	VARCHAR(254) NOT NULL,
	status          	ENUM ('Diterima', 'Ditolak', 'Menunggu') NOT NULL,

	PRIMARY KEY (reservasi_id),
	FOREIGN KEY (peminjam_id) REFERENCES Peminjam (id),
	FOREIGN KEY (ruangan_id) REFERENCES Ruangan (id),
	FOREIGN KEY (pimpinan_id) REFERENCES Pimpinan (id)
);

-- INSERT INTO account-- VALUES('', '2215354023@pnb.ac.id', '123', 'peminjam');

-- INSERT INTO account
-- VALUES('', 'budhi@gmail.com', '123', 'pimpinan');

-- INSERT INTO pimpinan
-- VALUES('565774878659087654', 'Prof. Dr. Budhi Jago, Ph.D.', 'Wakil Direktur III', '2');

-- INSERT INTO peminjam
-- VALUES('2215354023', 'I Made Bagus Mahatma Budhi', '08113978683', 'mahasiswa', '1');

-- SELECT * FROM account;
-- SELECT * FROM peminjam;
