# Simple Blog Application

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [File Structure](#file-structure)
- [API Endpoints](#api-endpoints)
- [Screenshots](#screenshots)

## Introduction

This is a simple blog application built with PHP 8.1, jQuery 3, MySQL, and styled with Bootstrap. The application supports CRUD operations for users, posts, and comments.

## Installation

1. **Clone the repository**:
   ```sh
   git clone https://github.com/jovanalekksic/php-js-blog-app.git
   ```
2. **Navigate to the project directory**:
   ```sh
   cd Blog
   ```
3. **Set up your database and import the provided SQL file**:
   ```sh
   mysql -u username -p password your_database < database.sql
   ```
4. **Configure your database connection in `database.php`**:
   ```php
   <?php
   $connection = new mysqli('localhost', 'username', 'password', 'your_database');
   if ($connection->connect_error) {
       die("Connection failed: " . $connection->connect_error);
   }
   ?>
   ```
5. **Start your PHP server**:
   ```sh
   php -S localhost:3000
   ```

## Usage

1. **Open your browser and navigate to `http://localhost:3000/Blog/src/index.php`.**
2. **Create a new account using the sign-in link.**
3. **Create, read, update, and delete posts and comments.**

## Features

- User authentication (login and registration)
- Create, read, update, and delete posts
- Comment on posts
- Simple and responsive design using Bootstrap

## API Endpoints

- `POST /login.php` - Login a user
- `POST /signin.php` - Register a new user
- `GET /home.php` - Display all posts
- `GET /read.php?id={post_id}` - View a specific post
- `POST /addPost.php` - Create a new post
- `POST /updatePost.php` - Update a post
- `POST /deletePost.php` - Delete a post
- `POST /addComment.php` - Create a new comment
- `POST /updateComment.php` - Update a comment
- `POST /deleteComment.php` - Delete a comment

## Screenshots

### Home Page

![Home Page](screenshots/Home.png)

### Login Page

![Login Page](screenshots/Login.png)

### Create Post

![Create Post](screenshots/NewPost.png)

### Update Post

![Create Post](screenshots/UpdatePost.png)

### Add a comment

![Home Page](screenshots/AddComment.png)

### View a post and it's comments

![Login Page](screenshots/readPost.png)

### Update a comment

![Create Post](screenshots/UpdateComment.png)
