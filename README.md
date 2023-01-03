# todo_gsa

## Dev Environment

- MySQL 5.7.34
- PHP 7.4.21
- Apache 2.4.46

## Features

- User registration
- User login
- user logout
- todo create
- todo edit
- create categories and have each todo belong to a category
- show the list of todos by category

## Features for future development

- complete or delete todo
- styling

## Database Schema

### users

- id INT PRIMARY KEY AUTO_INCREMENT
- username varchar(255) UNIQUE
- password varchar(255)
- updated TIME_STAMP

### categories

- cat_id INT PRIMARY KEY AUTO_INCREMENT
- cat_name varchar(255)
- user_id INT FOREIGN KEY REFERENCES users(id)
- updated TIME_STAMP

### todos

- todo_id INT PRIMARY KEY AUTO_INCREMENT
- todo varchar(255)
- category_id INT FOREIGN KEY REFERENCES categories(id)
- user_id INT FOREIGN KEY REFERENCES users(id)
- updated TIME_STAMP
