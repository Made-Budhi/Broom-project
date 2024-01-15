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
  id         VARCHAR(18)                      NOT NULL UNIQUE,
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
  peminjam_id         VARCHAR(18),
  ruangan_id          INT,
  pimpinan_id         CHAR(18),

  -- Pilihan untuk menyertakan nama organisasi atau tidak
  organization_choice BOOLEAN                                                NOT NULL,

  -- Berisi nilai apabila `organization_choice` == true. Else null
  organization_name   TINYTEXT,

  head_committee_name TINYTEXT                                               NOT NULL,
  head_committee_id   VARCHAR(18)                                            NOT NULL,
  head_committee_sign TINYTEXT                                               NOT NULL,

  date_start          DATE                                                   NOT NULL,
  time_start          TIME                                                   NOT NULL,
  date_end            DATE                                                   NOT NULL,
  time_end            TIME                                                   NOT NULL,

  document_number     VARCHAR(100)                                           NOT NULL,
  reservation_date    DATE                                                   NOT NULL,
  purpose             VARCHAR(254)                                           NOT NULL,
  attachment          VARCHAR(5)                                             NOT NULL,
  event               VARCHAR(254)                                           NOT NULL,
  organizer           VARCHAR(254)                                           NOT NULL,
  copy                MEDIUMTEXT,

  pnb_logo_choice     BOOLEAN                                                NOT NULL,
  -- Opsional
  left_logo           TINYTEXT,
  -- Opsional
  right_logo          TINYTEXT,

  status              ENUM ('Diterima', 'Ditolak', 'Menunggu', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  date_assigned       DATE                                                   NOT NULL,
  status_message      TEXT,

  PRIMARY KEY (reservasi_id),
  FOREIGN KEY (peminjam_id) REFERENCES Peminjam (id),
  FOREIGN KEY (ruangan_id) REFERENCES Ruangan (id),
  FOREIGN KEY (pimpinan_id) REFERENCES Pimpinan (id)
);

CREATE TABLE Notification
(
  id           INT AUTO_INCREMENT,
  type         INT,
  reservasi_id INT,

  PRIMARY KEY (id)
);

# For testing purpose

INSERT INTO Ruangan
VALUES (DEFAULT, 'Widya Guna-Guna', DEFAULT, '',
        'Gedung berukuran 50 meter persegi yang keren'),
       (DEFAULT, 'Widya Padma', DEFAULT, '',
        'Gedung yang biasa digunakan sebagai gedung merayakan puncak acara suatu kegiatan'),
       (DEFAULT, 'Widya Graha', DEFAULT, '','Gedung rapat');


-- Inserting peminjam account
-- Default test pass: 123
INSERT INTO Account
VALUES (DEFAULT, '2215354023@pnb.ac.id',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', DEFAULT, TRUE),
       (DEFAULT, 'made@gmail.com',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', DEFAULT, TRUE),
       (DEFAULT, 'broom@gmail.com',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', DEFAULT, TRUE);

-- Inserting pimpinan account
-- Default test pass: 123
INSERT INTO Account
VALUES (DEFAULT, 'budhi@gmail.com',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', 'Pimpinan', TRUE),
       (DEFAULT, 'pakbudhi@gmail.com',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', 'Pimpinan', TRUE),
       (DEFAULT, 'gibran@gmail.com',
        '661fbc4e2d6b6d1497e55610a0b7dce028618dcc513dbe40b26b1f02fb668ce17a33e78ab4c995aae95c1658b5aa827ad08cbdef53d5d7fae3cd43f1a7ac569ffSjYvABg1KO/MJSbpvkhX0fXmfxWrDqnLwDS5UDcAPDz9QAh2XcRBuQCIyUKNGRQjTCDgOhrbJQs/sQNHJdIzosv8GTZlCu57IPWfMTNpPU=',
        '', 'Pimpinan', TRUE);

-- Inserting pengelola account
-- Default test pass: admin
INSERT INTO Account
VALUES (DEFAULT, 'admin',
        'db27078cfff84d796346ebc9c234c553cb916b54bccbcbe762c8059570e66675aaa374627c113bf5a612409a4a9447f025989d784bc797f90241ff7857e2bb75TKf+YpBQHdzJxqWR0oy4t64pf8/d9zeKGo/irLzW7keIrst+DLID6SDe6R/LPyawwS8wqTobgehWC5BJIzYidwzAQ3YNc4IT006T92eYJcI=',
        '', 'Pengelola', TRUE);

INSERT INTO Peminjam
VALUES ('2215354023', 'I Made Bagus Mahatma Budhi', '08113978683', 'Mahasiswa',
        '1'),
       ('2215354043', 'Kadek Faraday Bhaskara Tantra', '08113978695',
        'Mahasiswa', '2'),
       ('221535406390123222', 'Sir Aliffian Alexander, S. T., M.T.',
        '08113978483', 'Pegawai', '3');


INSERT INTO Pimpinan
VALUES ('565774878659087654', 'Prof. Dr. Budhi Jago, Ph.D.',
        'Wakil Direktur III', '4', 'Tanda_Tangan.jpg'),
       ('565774878659056654', 'Dr. Stephen Strange, Ph.D.', 'Wakil Direktur II',
        '5', 'Tanda_Tangan.jpg'),
       ('565774878349087654', 'Gibran Rakabuming', 'Wakil Presiden RI', '6',
        'Tanda_Tangan.jpg');


INSERT INTO Pengelola
VALUES ('788980098765744342', 'Akmin Budhi', '7');

-- SELECT * FROM account;
-- SELECT * FROM peminjam;
