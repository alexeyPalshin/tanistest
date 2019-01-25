-- we don't know how to generate schema tanis (class Schema) :(
create table brands
(
	brand_id int auto_increment
		primary key,
	id int null,
	name varchar(255) not null,
	brand_logo varchar(255) null
)
;

create table categories
(
	category_id int auto_increment
		primary key,
	id varchar(40) null,
	name varchar(255) null
)
;

create table products
(
	product_id int auto_increment
		primary key,
	id int null,
	name varchar(255) not null,
	image varchar(255) null,
	brand_id int null,
	category_id int null,
	constraint brand_id
		foreign key (brand_id) references brands (brand_id),
	constraint category_id
		foreign key (category_id) references categories (category_id)
)
;

create index brand_id
	on products (brand_id)
;

create index category_id
	on products (category_id)
;

INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (1, 1, 'Samsung', null);
INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (2, 2, 'Sony', null);
INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (3, 3, 'Huawei', null);
INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (4, 4, 'Apple', null);
INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (5, 5, 'Microsoft', null);
INSERT INTO tanis.brands (brand_id, id, name, brand_logo) VALUES (6, 1, 'Canon', null);
INSERT INTO tanis.categories (category_id, id, name) VALUES (116, '57b42bfe31b6f0132cb96836', 'Mobile phones');
INSERT INTO tanis.categories (category_id, id, name) VALUES (117, '57b42bfe7e7298611b333652', 'Computers');
INSERT INTO tanis.categories (category_id, id, name) VALUES (118, '57b42bfe250111078dadcd03', 'Cameras');
INSERT INTO tanis.categories (category_id, id, name) VALUES (119, 'c98598f20626af33431614c0', 'Tablets');
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (2, 12345, 'Galaxy S4', null, 1, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (3, 23456, 'Galaxy S5', null, 1, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (4, 34567, 'Galaxy S6', null, 1, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (5, 45678, 'XPeria Z3', null, 2, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (6, 56789, 'XPeria Z5', null, 2, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (7, 67890, 'Vegas', null, 2, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (8, 44444, 'Honor 7', null, 3, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (9, 55555, 'P8', null, 3, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (10, 66666, 'P9', null, 3, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (11, 12222, 'IPhone 5S', null, 4, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (12, 23333, 'IPhone 6S', null, 4, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (13, 543534, 'Lumia 650', null, 5, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (14, 456457, 'Lumia 630', null, 5, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (15, 7564534, 'Lumia 640 XL', null, 5, 116);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (16, 7564534, 'Sony Vaio', null, 2, 117);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (17, 7560001, 'MacBook Pro', null, 4, 117);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (18, 665451, 'MacBook Air', null, 4, 117);
INSERT INTO tanis.products (product_id, id, name, image, brand_id, category_id) VALUES (19, 345611, 'EOS 1000D', null, 6, 118);