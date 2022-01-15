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

CREATE TABLE posts (
    p_id INT PRIMARY KEY AUTO_INCREMENT,
    course_code varchar(30) NOT NULL,
    course_name varchar(30) NOT NULL,
    course_des varchar(15000) DEFAULT NOT NULL,
    file_link varchar(100) NOT NULL,
    post_author varchar(50) NOT NULL,
    department varchar(20) NOT NULL,
    date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

CREATE TABLE trimesters (
    t_id INT NOT NULL AUTO_INCREMENT,
    t_name varchar(20) NOT NULL,
    u_id INT NOT NULL,
    is_running BOOLEAN NOT NULL,
    cgpa decimal(3,2),
    expected_cgpa decimal(3, 2),
    start_date timestamp NULL Default NULL,
    end_date timestamp NULL Default NULL,
    fees decimal(8, 2),
    scholarship INT,
    CONSTRAINT pk_trimesters PRIMARY KEY (t_id),
    CONSTRAINT fk_user FOREIGN KEY (u_id) REFERENCES users(u_id)
);

CREATE TABLE courses (
    c_id INT NOT NULL AUTO_INCREMENT,
    t_id INT NOT NULL,
    c_name varchar(100) NOT NULL,
    c_code varchar(10) NOT NULL UNIQUE,
    credit INT NOT NULL,
    section varchar(2),
    auto_add_to_group BOOLEAN NOT NULL,
    expected_marks decimal(5, 2),
    total_marks decimal(5, 2),
    obtained_marks decimal(5, 2),
    CONSTRAINT pk_courses PRIMARY KEY (c_id),
    CONSTRAINT fk_trimester FOREIGN KEY (t_id) REFERENCES trimesters(t_id)
);

CREATE TABLE assessments (
    assess_id INT NOT NULL AUTO_INCREMENT,
    course_id INT NOT NULL,
    expected_marks decimal(5, 2),
    total_marks decimal(5, 2),
    obtained_marks decimal(5, 2),
    type varchar(15) NOT NULL,
    -- how many asses will happen
    count INT,
    CONSTRAINT pk_assessment PRIMARY KEY (assess_id),
    CONSTRAINT fk_courses FOREIGN KEY (course_id) REFERENCES courses(c_id)
);

CREATE TABLE study_group (
    group_id INT AUTO_INCREMENT,
    course_id INT NOT NULL,
    group_name varchar(100),
    open_date timestamp NOT NULL DEFAULT current_timestamp(),
    close_date timestamp NULL Default NULL,
    CONSTRAINT pk_group PRIMARY KEY (group_id),
    CONSTRAINT fk_course FOREIGN KEY (course_id) REFERENCES courses(c_id)
);

CREATE TABLE massages (
    msg_id int(11) NOT NULL AUTO_INCREMENT,
    msg varchar(1000) NOT NULL,
    sender INT NOT NULL,
    receiver INT NOT NULL,
    group_id INT NOT NULL ,
    time timestamp NOT NULL DEFAULT current_timestamp(),
    CONSTRAINT pk_massages PRIMARY KEY (msg_id),
    CONSTRAINT fk_group FOREIGN KEY (group_id) REFERENCES study_group(group_id),
    CONSTRAINT fk_sender FOREIGN KEY (sender) REFERENCES users(u_id),
    CONSTRAINT fk_receiver FOREIGN KEY (receiver) REFERENCES users(u_id)
);

CREATE TABLE study_group (
    group_id INT AUTO_INCREMENT,
    course_id INT NOT NULL,
    group_name varchar(100),
    open_date timestamp NOT NULL DEFAULT current_timestamp(),
    close_date timestamp NULL Default NULL,
    CONSTRAINT pk_group PRIMARY KEY (group_id),
    CONSTRAINT fk_course FOREIGN KEY (course_id) REFERENCES courses(c_id)
);

CREATE TABLE massages (
    msg_id int(11) NOT NULL AUTO_INCREMENT,
    msg varchar(1000) NOT NULL,
    sender INT NOT NULL,
    receiver INT NOT NULL,
    group_id INT NOT NULL ,
    time timestamp NOT NULL DEFAULT current_timestamp(),
    CONSTRAINT pk_massages PRIMARY KEY (msg_id),
    CONSTRAINT fk_group FOREIGN KEY (group_id) REFERENCES study_group(group_id),
    CONSTRAINT fk_sender FOREIGN KEY (sender) REFERENCES users(u_id),
    CONSTRAINT fk_receiver FOREIGN KEY (receiver) REFERENCES users(u_id)
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

--  Relational/Junction Table -- (user - massages)
CREATE TABLE user_has_massages(
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    msg_id INT NOT NULL,
    CONSTRAINT pk_user_has_massages PRIMARY KEY (
            msg_id,
            group_id,
            user_id
        ),
    CONSTRAINT fk_relational_massages Foreign KEY(msg_id) REFERENCES massages(msg_id),
    CONSTRAINT fk_relational_group FOREIGN KEY(group_id) REFERENCES study_group(group_id),
    CONSTRAINT fk_relational_user FOREIGN KEY(user_id) REFERENCES users(u_id)
);

