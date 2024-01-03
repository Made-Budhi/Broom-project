CREATE DATABASE db_broom;

-- DROP DATABASE db_broom;

USE db_broom;

CREATE TABLE Account
(
  account_id INT AUTO_INCREMENT,
  email      VARCHAR(254)                               NOT NULL,
  password   VARCHAR(254)                               NOT NULL,
  token      VARCHAR(6),
  role       ENUM ('Peminjam', 'Pimpinan', 'Pengelola') NOT NULL,
  is_verif   BOOLEAN DEFAULT FALSE,

  PRIMARY KEY (account_id)
);

CREATE TABLE Peminjam
(
  id         CHAR(18)                      NOT NULL UNIQUE,
  name       VARCHAR(254)                  NOT NULL,
  phone      VARCHAR(15)                   NOT NULL,
  role       ENUM ('Mahasiswa', 'Pegawai') NOT NULL,
  account_id INT UNIQUE                    NOT NULL,

  FOREIGN KEY (account_id) REFERENCES Account (account_id),
  PRIMARY KEY (id)
);

CREATE TABLE Pimpinan
(
  id         CHAR(18)     NOT NULL UNIQUE,
  name       VARCHAR(254) NOT NULL,
  position   VARCHAR(254) NOT NULL,
  account_id INT UNIQUE   NOT NULL,
  signature  VARCHAR(254) NOT NULL,

  FOREIGN KEY (account_id) REFERENCES Account (account_id),
  PRIMARY KEY (id)
);

CREATE TABLE Pengelola
(
  id         CHAR(18)     NOT NULL,
  name       VARCHAR(254) NOT NULL,
  account_id INT UNIQUE   NOT NULL,

  FOREIGN KEY (account_id) REFERENCES Account (account_id),
  PRIMARY KEY (id)
);

CREATE TABLE Ruangan
(
  id          INT                  NOT NULL AUTO_INCREMENT,
  name        VARCHAR(254)         NOT NULL,
  status      BOOLEAN DEFAULT TRUE NOT NULL,
  image       TINYTEXT,
  description TEXT,

  PRIMARY KEY (id)
);

CREATE TABLE Reservasi
(
  reservasi_id        INT AUTO_INCREMENT,
  peminjam_id         CHAR(18),
  ruangan_id          INT,
  pimpinan_id         CHAR(18),

  -- Pilihan untuk menyertakan nama organisasi atau tidak
  organization_choice BOOLEAN                                  NOT NULL,

  -- Berisi nilai apabila `organization_choice` == true. Else null
  organization_name   TINYTEXT,

  head_committee_name TINYTEXT                                 NOT NULL,
  head_committee_id   VARCHAR(18)                              NOT NULL,
  head_committee_sign TINYTEXT                                 NOT NULL,

  date_start          DATE                                     NOT NULL,
  time_start          TIME                                     NOT NULL,
  date_end            DATE                                     NOT NULL,
  time_end            TIME                                     NOT NULL,

  document_number     VARCHAR(100)                             NOT NULL,
  reservation_date    DATE                                     NOT NULL,
  purpose             VARCHAR(254)                             NOT NULL,
  attachment          VARCHAR(5)                               NOT NULL,
  event               TINYINT                                  NOT NULL,
  organizer           VARCHAR(254)                             NOT NULL,
  copy                MEDIUMTEXT,

  pnb_logo_choice     BOOLEAN                                  NOT NULL,
  -- Opsional
  left_logo           TINYTEXT,
  -- Opsional
  right_logo          TINYTEXT,

  status              ENUM ('Diterima', 'Ditolak', 'Menunggu', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  date_assigned       DATE                                     NOT NULL,
  status_message 	  TEXT,

  PRIMARY KEY (reservasi_id),
  FOREIGN KEY (peminjam_id) REFERENCES Peminjam (id),
  FOREIGN KEY (ruangan_id) REFERENCES Ruangan (id),
  FOREIGN KEY (pimpinan_id) REFERENCES Pimpinan (id)
);

CREATE TABLE Notification_Master
(
	id		INT,
    name 	TINYTEXT,
    
    PRIMARY KEY (id)
);

CREATE TABLE Notification
(
	id				INT AUTO_INCREMENT,
    type			INT,
    reservasi_id	INT,
    
    PRIMARY KEY (id),
    FOREIGN KEY (type) REFERENCES Notification_Master (id)
);

INSERT INTO Notification_Master
VALUES
('101', 'peminjam_mengajukan'),
('102', 'peminjam_disetujui'),
('103', 'peminjam_ditolak'),
('104', 'peminjam_dibatalkan'),

('201', 'pimpinan_diajukan'),

('301', 'pengelola_dinotifikasi'),
('302', 'pengelola_membatalkan');

# For testing purpose

INSERT INTO Ruangan
VALUES ('', 'Widya Guna-Guna', true, 'Gedung berukuran 50 meter persegi yang keren', ''),
	   ('', 'Widya Padma', true, 'Gedung yang biasa digunakan sebagai gedung merayakan puncak acara suatu kegiatan', ''),
	   ('', 'Widya Graha', true, 'Gedung rapat', '');

-- Inserting peminjam account
INSERT INTO Account
VALUES ('', '2215354023@pnb.ac.id', '123', '', 'Peminjam', ''),
       ('', 'made@gmail.com', '123', '', 'Peminjam', ''),
	   ('', 'broom@gmail.com', '123', '', 'Peminjam', '');

-- Inserting pimpinan account
INSERT INTO Account
VALUES ('', 'budhi@gmail.com', '123', '', 'Pimpinan', ''),
       ('', 'pakbudhi@gmail.com', '123', '', 'Pimpinan', ''),
       ('', 'gibran@gmail.com', '123', '', 'Pimpinan', '');

-- Inserting pengelola account
INSERT INTO Account
VALUES ('', 'admin', 'admin', '', 'Pengelola', '');

INSERT INTO Peminjam
VALUES ('2215354023', 'I Made Bagus Mahatma Budhi', '08113978683', 'Mahasiswa', '1'),
	   ('2215354043', 'Kadek Faraday Bhaskara Tantra', '08113978695', 'Mahasiswa', '2'),
	   ('221535406390123222', 'Sir Aliffian Alexander, S. T., M.T.', '08113978483', 'Pegawai', '3');

INSERT INTO Pimpinan
VALUES ('565774878659087654', 'Prof. Dr. Budhi Jago, Ph.D.', 'Wakil Direktur III', '4', 'Tanda_Tangan.jpg'),
	   ('565774878659056654', 'Dr. Stephen Strange, Ph.D.', 'Wakil Direktur II', '5', 'Tanda_Tangan.jpg'),
	   ('565774878349087654', 'Gibran Rakabuming', 'Wakil Presiden RI', '6', 'Tanda_Tangan.jpg');

INSERT INTO Pengelola
VALUES ('788980098765744342', 'Akmin Budhi', '7');

-- SELECT * FROM account;
-- SELECT * FROM peminjam;
