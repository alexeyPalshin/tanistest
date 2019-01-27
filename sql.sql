-- we don't know how to generate schema tanis (class Schema) :(
create table brands
(
	item_id int auto_increment
		primary key,
	id int null,
	name varchar(255) not null,
	brand_logo varchar(255) null
)
;

create table categories
(
	item_id int auto_increment
		primary key,
	id varchar(40) null,
	name varchar(255) null
)
;

create table products
(
	item_id int auto_increment
		primary key,
	id int null,
	name varchar(255) not null,
	image varchar(255) null,
	brand_id int null,
	category_id int null,
	constraint brand_id
		foreign key (brand_id) references brands (item_id)
			on update set null on delete set null,
	constraint category_id
		foreign key (category_id) references categories (item_id)
			on update set null on delete set null
)
;

create index brand_id
	on products (brand_id)
;

create index category_id
	on products (category_id)
;

UPDATE tanis.brands SET id = 1, name = 'Samsung', brand_logo = null WHERE item_id = 1;
UPDATE tanis.brands SET id = 2, name = 'Sony', brand_logo = null WHERE item_id = 2;
UPDATE tanis.brands SET id = 3, name = 'Huawei', brand_logo = null WHERE item_id = 3;
UPDATE tanis.brands SET id = 4, name = 'Apple', brand_logo = null WHERE item_id = 4;
UPDATE tanis.brands SET id = 5, name = 'Microsoft', brand_logo = null WHERE item_id = 5;
UPDATE tanis.brands SET id = 1, name = 'Canon', brand_logo = null WHERE item_id = 6;
UPDATE tanis.categories SET id = '57b42bfe31b6f0132cb96836', name = 'Mobile phones' WHERE item_id = 116;
UPDATE tanis.categories SET id = '57b42bfe7e7298611b333652', name = 'Computers' WHERE item_id = 117;
UPDATE tanis.categories SET id = '309d2eb80790d05ef2a624e0', name = 'Cameras' WHERE item_id = 173;
UPDATE tanis.products SET id = 12345, name = 'Galaxy S4', image = null, brand_id = 1, category_id = 116 WHERE item_id = 2;
UPDATE tanis.products SET id = 23456, name = 'Galaxy S5', image = null, brand_id = 1, category_id = 116 WHERE item_id = 3;
UPDATE tanis.products SET id = 34567, name = 'Galaxy S6', image = null, brand_id = 1, category_id = 116 WHERE item_id = 4;
UPDATE tanis.products SET id = 45678, name = 'XPeria Z3', image = null, brand_id = 2, category_id = 116 WHERE item_id = 5;
UPDATE tanis.products SET id = 56789, name = 'XPeria Z5', image = null, brand_id = 2, category_id = 116 WHERE item_id = 6;
UPDATE tanis.products SET id = 67890, name = 'Vegas', image = null, brand_id = 2, category_id = 116 WHERE item_id = 7;
UPDATE tanis.products SET id = 44444, name = 'Honor 7', image = null, brand_id = 3, category_id = 116 WHERE item_id = 8;
UPDATE tanis.products SET id = 55555, name = 'P8', image = null, brand_id = 3, category_id = 116 WHERE item_id = 9;
UPDATE tanis.products SET id = 66666, name = 'P9', image = null, brand_id = 3, category_id = 116 WHERE item_id = 10;
UPDATE tanis.products SET id = 12222, name = 'IPhone 5S', image = null, brand_id = 4, category_id = 116 WHERE item_id = 11;
UPDATE tanis.products SET id = 23333, name = 'IPhone 6S', image = null, brand_id = 4, category_id = 116 WHERE item_id = 12;
UPDATE tanis.products SET id = 543534, name = 'Lumia 650', image = null, brand_id = 5, category_id = 116 WHERE item_id = 13;
UPDATE tanis.products SET id = 456457, name = 'Lumia 630', image = null, brand_id = 5, category_id = 116 WHERE item_id = 14;
UPDATE tanis.products SET id = 7564534, name = 'Lumia 640 XL', image = null, brand_id = 5, category_id = 116 WHERE item_id = 15;
UPDATE tanis.products SET id = 7564534, name = 'Sony Vaio', image = null, brand_id = 2, category_id = 117 WHERE item_id = 16;
UPDATE tanis.products SET id = 7560001, name = 'MacBook Pro', image = null, brand_id = 4, category_id = 117 WHERE item_id = 17;
UPDATE tanis.products SET id = 665451, name = 'MacBook Air', image = null, brand_id = 4, category_id = 117 WHERE item_id = 18;
UPDATE tanis.products SET id = 345611, name = 'EOS 1000D', image = null, brand_id = 6, category_id = 173 WHERE item_id = 19;
UPDATE tanis.products SET id = 3456757, name = 'test', image = null, brand_id = null, category_id = 173 WHERE item_id = 20;