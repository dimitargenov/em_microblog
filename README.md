

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Install
Clone the git repository on your computer
```
$ git clone https://github.com/dimitargenov/em_microblog.git
```
You can also download the entire repository as a zip file and unpack in on your computer if you do not have git

After cloning the application, you need to install it's dependencies.
```
$ cd <project_name>
$ composer install
```
## Setup
When you are done with installation, copy the .env.example file to .env
```
$ cp .env.example .env
```
Migrate the application
```
$ vendor/bin/phinx migrate
``` 
Run the application
```
$ php -S localhost:9090 -t public
```
