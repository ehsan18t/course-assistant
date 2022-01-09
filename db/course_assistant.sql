CREATE TABLE users (
    f_name varchar(30) NOT NULL,
    l_name varchar(30) NOT NULL,
    university varchar(100) NOT NULL,
    department varchar(100) NOT NULL,
    email varchar(50) NOT NULL,
    u_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    domain varchar(20) NOT NULL,
    password varchar(100) NOT NULL,
    date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    CONSTRAINT pk_users PRIMARY KEY(email)
);

--  Relational Table -- (users - trimesters)
CREATE TABLE users_creates_trimesters (
    email varchar(50),
    t_id INT,
    CONSTRAINT fk_users FOREIGN KEY (email) REFERENCES users(email),
    CONSTRAINT fk_trimesters FOREIGN KEY (t_id) REFERENCES trimesters(t_id)
);


CREATE TABLE trimesters (
    t_id INT NOT NULL,
    t_name varchar(20) NOT NULL,
    is_running BOOLEAN NOT NULL,
    start_date timestamp,
    end_date timestamp,
    fees decimal(8, 2),
    scholarship INT,
    CONSTRAINT pk_trimesters PRIMARY KEY (t_id)
);

CREATE TABLE courses (
    c_id INT NOT NULL,
    c_name varchar(20) NOT NULL,
    credit INT NOT NULL,
    section varchar(2),
    auto_add_to_group BOOLEAN NOT NULL,
    expected_marks decimal(5, 2),
    total_marks decimal(5, 2),
    obtained_marks decimal(5, 2),
    CONSTRAINT pk_courses PRIMARY KEY (c_id)
);

--  Relational Table -- (trimester - courses)
CREATE TABLE trimesters_has_courses (
    email varchar(50),
    c_id INT,
    t_id INT,
    CONSTRAINT fk_users FOREIGN KEY (email) REFERENCES users(email),
    CONSTRAINT fk_trimesters FOREIGN KEY (t_id) REFERENCES trimesters(t_id),
    CONSTRAINT fk_courses FOREIGN KEY (c_id) REFERENCES courses(c_id)
);

CREATE TABLE assessments (
    assess_id INT NOT NULL,
    expected_marks decimal(5, 2),
    total_marks decimal(5, 2),
    obtained_marks decimal(5, 2),
    type varchar(15) NOT NULL,
    -- how many asses will happen
    count INT,
    CONSTRAINT pk_assessment PRIMARY KEY (assess_id)
);