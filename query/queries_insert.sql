/* Insert Information into 'Location' Table */
INSERT INTO locations (state, state_code) VALUES
('Alaska', 'AK'), 
('Alabama', 'AL'), 
('Arkansas', 'AR'), 
('Arizona', 'AZ'), 
('California', 'CA'), 
('Colorado', 'CO'), 
('Connecticut', 'CT'), 
('District of Columbia', 'DC'), 
('Delaware', 'DE'), 
('Florida', 'FL'), 
('Georgia', 'GA'),
('Hawaii', 'HI'),
('Iowa', 'IA'), 
('Idaho', 'ID'), 
('Illinois', 'IL'), 
('Indiana', 'IN'), 
('Kansas', 'KS'), 
('Kentucky', 'KY'), 
('Louisiana', 'LA'), 
('Massachusetts', 'MA'), 
('Maryland', 'MD'), 
('Maine', 'ME'), 
('Michigan', 'MI'), 
('Minnesota', 'MN'), 
('Missouri', 'MO'),
('Mississippi', 'MS'), 
('Montana', 'MT'),
('North Carolina', 'NC'),
('North Dakota', 'ND'),
('Nebraska', 'NE'),
('New Hampshire', 'NH'),
('New Jersey', 'NJ'),
('New Mexico', 'NM'),
('Nevada', 'NV'),
('New York', 'NY'),
('Ohio', 'OH'),
('Oklahoma', 'OK'),
('Oregon', 'OR'),
('Pennsylvania', 'PA'),
('Rhode Island', 'RI'),
('South Carolina', 'SC'),
('South Dakota', 'SD'),
('Tennessee', 'TN'),
('Texas', 'TX'),
('Utah', 'UT'),
('Virginia', 'VA'),
('Vermont', 'VT'),
('Washington', 'WA'),
('Wisconsin', 'WI'),
('West Virginia', 'WV'),
('Wyoming', 'WY');

/* Insert Information into 'types' Table */
INSERT INTO types (type) VALUES
('Bistro'), 
('Fast Food'), 
('Bar'), 
('Cafe'), 
('Bakery'), 
('Diner'),
('Fine Dine'),
('Italian'),
('American'),
('Korean'),
('Seafood'),
('GastroPub'),
('Desserts'),
('Food Truck'),
('Coffee & Tea'),
('Mexican'),
('French');

INSERT INTO priceRanges (price) VALUES
('$'), ('$$'), ('$$$'), ('$$$$'), ('$$$$$');


/* Insert Information into 'restaurants' Table */
INSERT INTO restaurants (name, street, city, location_id, note) VALUES
('Common Theory Public House', '4805 Convoy St', 'San Diego', '5','Casual brewhouse with a spacious, dark-wood interior serving pub grub with an Asian twist'),                       /* gastro, american */
('The Crack Shack', '2266 Kettner Blvd', 'San Diego', '5', 'Fun spot for chicken & egg dishes with stylish outdoor seating, a full bar & a bocce court.'),                             /* bar, fast food */
('Pardon My French Bar & Kitchen', '3797 Park Blvd', 'San Diego', '5', 'Casually sophisticated locale serving Californian-French bistro fare, wine & cocktails.'),                /* french, bar */
('Pacific Beach Fish Shop','1775 Garnet Ave', 'San Diego', '5','Cheery restaurant serving fresh fish & seafood in tacos, sandwiches & salads, with local microbrews.'),            /* seafood */
('The Barking Dog Alehouse', '705 NW 70th St', 'Seattle', '48', 'Boisterous pub offering imaginative American fare & weekly rotating taps in eco-minded environs.'),             /* american, bar*/
('PaPa Haydn', '701 NW 23rd Ave', 'Portland', '38', ''),                    /* desserts, cafe, bakery */
('Urth Caffe', '267 S Beverly Dr', 'Beverly Hills', '5',''),                /* cafe, desserts, coffee */
('Bistro Milano', '1350 6th Ave', 'New York', '35',''),                      /* italian */
('Truck Yard', '5624 Sears St', 'Dallas', '44',''),                         /* food truck */
('PublicUs', '1126 Fremont St', 'Las Vegas', '34',''),                       /* cafe, coffee */
('Dos Urban Cantina','2829 W Armitage Ave', 'Chicago','15',''),             /* Mexican, bar */
('Stellas Diner', '3042 N Broadway St', 'Chicago','15',''),                 /* diner */
('Lokal', '3190 Commodore Plz', 'Miami', '10', 'Laid-back place for burgers & sandwiches made with local, sustainable ingredients, plus craft beers');                                  /* gastropub, american */     

/* Insert Information into 'restaurants+type' Table */
INSERT INTO restaurant_type (rest_id, type_id) VALUES
('1','12'), ('1', '9'), 
('2','3'), ('2','2'),
('3','3'),('3','17'),
('4', '11'), 
('5','3'),('5','9'),
('6','13'), ('6','4'),('6','5'),
('7','4'), ('7','13'), ('7','15'),
('8','8'),
('9', '13'),
('10', '4'), ('10', '15'),
('11', '3'), ('11', '16'),
('12', '6'),
('13', '9'), ('13', '12');
