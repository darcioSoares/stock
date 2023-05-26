create database one_stock;
use one_stock;

#crete table users
create table users (
id int unsigned auto_increment primary key,
name varchar(256),
email varchar (256)unique,
password varchar(256),
professional_position varchar(256),
active tinyint DEFAULT 1,
path_image varchar(256) DEFAULT "/images/user/user.png",
id_responsible int unsigned,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
desc users;
###########################
#ALTER TABLE users
#ADD column fk_companies int unsigned after id_responsible;

#ALTER TABLE users
#MODIFY column path_image DEFAULT "/images/user/user.png";


ALTER TABLE users
ADD foreign key (fk_companies) references companies (id);
############################

ALTER TABLE users
DROP COLUMN path_image;

ALTER TABLE users
ADD column path_image varchar(255) DEFAULT "/images/user/user.png";

##################

#create table categories;
create table categories(
id int unsigned auto_increment primary key,
name varchar(255),
description varchar(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
desc categories;

#create table lots
create table lots(
id int unsigned auto_increment primary key,
number int unsigned unique,
name varchar(255),
description varchar(255),
observation varchar (255),
validity date,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

fk_suppliers int unsigned,
foreign key (fk_suppliers) references suppliers (id)
);
desc lots;
#drop table lots;

#create table suppliers
create table suppliers(
id int unsigned auto_increment primary key,
name varchar(255),
cnpj varchar(25),
description varchar(255),
code int unsigned unique,
active tinyint DEFAULT 1,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

#create table tax invoices
create table tax_invoices(
id int unsigned auto_increment primary key,
number int unsigned unique,
serie int unsigned,
key_access varchar(150) unique,
product_code varchar(255),
name varchar(255),
description varchar(255),
date_issue date,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

fk_suppliers int unsigned,
foreign key (fk_suppliers) references suppliers (id)
);
desc tax_invoices;
#ALTER TABLE tax_invoices
#ADD column key_access varchar(150) unique after serie;

#ALTER TABLE tax_invoices
#DROP COLUMN fkey_access;

#create table products
create table products(
id int unsigned auto_increment primary key,
name varchar(255),
description varchar(255),
code int unsigned unique,
validity date,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

fk_categories int unsigned,
fk_lots int unsigned,
fk_tax_invoices int unsigned,

foreign key (fk_categories) references categories (id),
foreign key (fk_lots) references lots (id),
foreign key (fk_tax_invoices) references tax_invoices (id) 
);

#create table companies
create table companies(
id int unsigned auto_increment primary key,
name varchar(255),
cnpj varchar(25),
description varchar(255),
active tinyint DEFAULT 1,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

#create table addresses
create table addresses(
id int unsigned auto_increment primary key,
road varchar(255),
number varchar(15),
district varchar(255),
city varchar(255),
state varchar(255),
country varchar(255),
zip_code varchar(30),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

fk_companies int unsigned,
fk_suppliers int unsigned,
foreign key (fk_companies) references companies (id),
foreign key (fk_suppliers) references suppliers (id)
);

#create table companies_suppliers
#table pivo or pivot
create table companies_suppliers(
fk_companies int unsigned,
fk_suppliers int unsigned,

primary key (fk_companies,fk_suppliers),

foreign key (fk_companies) references companies (id),
foreign key (fk_suppliers) references suppliers (id),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
desc companies_suppliers



###########################
#ALTER TABLE exemplo
#ADD CONSTRAINT fk_exemplo FOREIGN KEY (exemplo) REFERENCES exemplo (ID_exemplo)
############################
