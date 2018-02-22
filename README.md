Task
===
Web Development API Task
Your task is to create an API to manage a user persistence layer.
We would expect this task to take a few hours, however there is no strict time limit and you won't be judged on how long it took you to complete. Please find a few pointers below:

Your solution must expose a user model and it's reasonable to expect that an individual user would have the following attributes:

id - A unique user id
email - A users email address
forename - A users first name
surname - A users last name
created - The date and time the user was added

It must have the ability to persist user information for at least the lifetime of the test.

You API must expose functionality to create, read, update and delete (CRUD) models.

Although the main outcomes of the task are listed above, if you feel like you want to go that extra mile and show us what you're capable of, here is a list of potential enhancements that we have come up with:

How your API is to be consumed (a custom interface or something like Google Chrome's "Postman" or Swagger).
Use of an industry standard data exchange format.
Sanitization checks of inputs.
Implementation of test coverage.
Alternatively if you can think of any other features that you feel would further enhance your API, then we'd love to see what you can come up with!

Installation and Setup
----------------

You need composer and git for download and install the repository.

 git clone https://github.com/IvelinaT/userAPI.git

Change database setting bootstrap/setting.php

Navigate to your root project directory from a terminal and run:
composer install
composer dump-autoload -o
php vendor/robmorgan/phinx/bin/phinx  migrate


Run & Test Project
----------------
Once you have successfully done the initial migration, you can insert test data by running the following from your root project directory:

php vendor/robmorgan/phinx/bin/phinx  seed:run

You may use PHP's built in web server to test your application by running the following from your root project directory:
php -S localhost:8181 -t public

Navigate to http://localhost:8181/users to view all users.
Navigate to http://localhost:8181/users/{id} to show user with id {id}.

You can also use Postman app to call the API.For Example:

GET  http://localhost:8181/users to view all users
GET  http://localhost:8181/users/1 to info for user with id 1
POST http://localhost:8181/users with parameters [forename, surname, email] to insert new user
POST http://localhost:8181/users/1  with one or more of the following parameters [forename, surname, email] to update info for user with id 1
DELETE http://localhost:8181/users/1 to delete user with id 1


Key files
----------------
    bootstrap/
        dependencies.php: Register services in application container
        routes.php: Register routes
        settings.php: Application configuration
    src/
        Controller/: Application controller
        Model/: Eloquent models
        Repository/: Model Repository
        Factory/: Model Factory
        Validation/: Custom validation rules
        Test/: Tests


Created Using
----------------
    Slim - Slim is a PHP micro framework
    Slim Validation - A validator for Slim micro-framework using Respect\Validation
    Illuminate Database - The Illuminate Database component is a full database toolkit for PHP
    Phinx Database Migrations -  manage the database migrations for the app.

