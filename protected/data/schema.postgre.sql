CREATE TABLE tbl_organization(
    id SERIAL PRIMARY KEY,
    name varchar(255),
    director varchar(255)
);

CREATE TABLE tbl_building(
    id SERIAL PRIMARY KEY,
    organization_id integer REFERENCES tbl_organization(id),
    address varchar(255)
);

CREATE TABLE tbl_porch(
    id SERIAL PRIMARY KEY,
    building_id integer REFERENCES tbl_building(id),
    number varchar(250),
    elder varchar(250)
);

CREATE TABLE tbl_user(
    id SERIAL PRIMARY KEY,
    name varchar(255),
    username varchar(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email varchar(128) NOT NULL,
    account varchar(250),
    phone varchar(250),
    role varchar(250) NOT NULL DEFAULT 'occupant'
);

CREATE TABLE tbl_flat(
    id SERIAL PRIMARY KEY,
    building_id integer REFERENCES tbl_building(id),
    number varchar(10),
    user_id integer REFERENCES tbl_user(id)
);


CREATE TABLE tbl_counter(
    id SERIAL PRIMARY KEY,
    type varchar(255) NOT NULL,
    serial_number varchar(255),
    date_check date NOT NULL DEFAULT now(),
    date_sealing date NOT NULL DEFAULT now(),
    building_id integer REFERENCES tbl_building(id),
    flat_id integer REFERENCES tbl_flat(id)
);

CREATE TABLE tbl_statement(
    id SERIAL PRIMARY KEY,
    counter_value integer,
    counter_date date NOT NULL DEFAULT now(),
    flat_id integer REFERENCES tbl_flat(id),
    counter_id integer REFERENCES tbl_counter(id)
);
