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
	token			VARCHAR(6),
	role			ENUM('Peminjam', 'Pimpinan', 'Pengelola') NOT NULL,
	is_verif		BOOLEAN DEFAULT FALSE,

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
	image		TINYTEXT,
	description	TEXT,

	PRIMARY KEY (id)
);

CREATE TABLE Reservasi
(
	reservasi_id	INT          		AUTO_INCREMENT,
	peminjam_id		VARCHAR(18),
	ruangan_id      INT,
	pimpinan_id     CHAR(18),

	organization_choice		BOOLEAN 	NOT NULL, 	-- Pilihan untuk menyertakan nama organisasi atau tidak
	organization_name		TINYTEXT, 				-- Berisi nilai apabila `organization_choice` == true. Else null
	head_committee_name		TINYTEXT 	NOT NULL,
	head_committee_id		VARCHAR(18) NOT NULL,
	head_committee_sign		TINYTEXT	NOT NULL,

	date_start      	DATE     		NOT NULL,
	time_start			TIME			NOT NULL,
	date_end        	DATE    		NOT NULL,
	time_end			time			NOT NULL,

	document_number 	VARCHAR(100)  	NOT NULL,
	reservation_date	DATE 			NOT NULL,
	purpose         	VARCHAR(254) 	NOT NULL,
	attachment			VARCHAR(5)		NOT NULL,
	event				TINYINT			NOT NULL,
	organizer			VARCHAR(254)	NOT NULL,
	copy				MEDIUMTEXT,

	pnb_logo_choice		BOOLEAN 		NOT NULL,
	left_logo			TINYTEXT,					-- Opsional
	right_logo			TINYTEXT,					-- Opsional

	status ENUM ('Diterima', 'Ditolak', 'Menunggu') NOT NULL,

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
