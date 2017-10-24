/* Create 'Locations' Table */
CREATE TABLE locations (
	l_id INT NOT NULL AUTO_INCREMENT,
	state VARCHAR(255) NOT NULL,
    state_code VARCHAR(255) NOT NULL,
	UNIQUE (state, state_code),
	PRIMARY KEY (l_id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* Create 'types' Table */
CREATE TABLE types (
    t_id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) NOT NULL,
    PRIMARY KEY (t_id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8;



/* Create 'priceRanges' Table */
CREATE TABLE priceRanges(
    pr_id INT NOT NULL AUTO_INCREMENT,
    price VARCHAR(255),
    PRIMARY KEY (pr_id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8;


/* Create 'restaurants' Table */
CREATE TABLE restaurants (
    r_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    street VARCHAR(255),
    city VARCHAR(255),
    location_id INT NOT NULL,
    note VARCHAR(255),
    photo VARCHAR(3000),
    price_id INT NOT NULL,
    PRIMARY KEY (r_id),
    FOREIGN KEY (location_id) REFERENCES locations (l_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (price_id) REFERENCES priceRanges (pr_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* Create 'restaurant_type' Table (Many to Many) */
CREATE TABLE restaurant_type (
    rest_id INT NOT NULL,
    type_id INT NOT NULL,
    PRIMARY KEY (rest_id, type_id),
    FOREIGN KEY (rest_id) REFERENCES restaurants(r_id) ON DELETE CASCADE,
    FOREIGN KEY (type_id) REFERENCES types(t_id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB DEFAULT CHARSET = utf8;
