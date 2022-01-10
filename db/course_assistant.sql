CREATE TABLE users (
    f_name varchar(30) NOT NULL,
    l_name varchar(30) NOT NULL,
    profile_pic_url varchar(300),
    university varchar(100) NOT NULL,
    department varchar(100) NOT NULL,
    email varchar(50) NOT NULL,
    u_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    domain varchar(20) NOT NULL,
    password varchar(100) NOT NULL,
    date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    CONSTRAINT pk_users PRIMARY KEY(email)
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



--  Relational/Junction Table -- (trimester - courses)
CREATE TABLE trimesters_has_courses (
    u_id INT NOT NULL,
    c_id INT NOT NULL,
    t_id INT NOT NULL,
    CONSTRAINT pk_trimesters_has_courses PRIMARY KEY (
            u_id,
            c_id,
            t_id
        ),
    CONSTRAINT fk_t_c_uid FOREIGN KEY (u_id) REFERENCES users(u_id),
    CONSTRAINT fk_t_c_tid FOREIGN KEY (t_id) REFERENCES trimesters(t_id),
    CONSTRAINT fk_t_c_cid FOREIGN KEY (c_id) REFERENCES courses(c_id)
);

--  Relational/Junction Table -- (courses - assessments)
CREATE TABLE courses_has_assessments (
    c_id INT NOT NULL,
    u_id INT NOT NULL,
    assess_id INT NOT NULL,
    CONSTRAINT pk_trimesters_has_courses PRIMARY KEY (
            assess_id,
            c_id
        ),
    CONSTRAINT fk_c_a_cid FOREIGN KEY (c_id) REFERENCES courses(c_id),
    CONSTRAINT fk_c_a_uid FOREIGN KEY (u_id) REFERENCES users(u_id),
    CONSTRAINT fk_c_a_assess_id FOREIGN KEY (assess_id) REFERENCES assessments(assess_id)
);
