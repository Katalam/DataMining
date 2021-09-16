# DataMining

<p align="center">
<a href="https://github.com/Katalam/DataMining/actions/workflows/test.yml"><img src="https://github.com/Katalam/DataMining/actions/workflows/test.yml/badge.svg" alt="Test Status"></a>
<a href="https://github.com/Katalam/DataMining/actions/workflows/styleci.yml"><img src="https://github.com/Katalam/DataMining/actions/workflows/styleci.yml/badge.svg" alt="Test Status"></a>
</p>

DataMining is a code challenge from SPACE SQUAD as part of the application process. The challenge was to create a laravel application as a data miner from the unsplash API. As soon as a registered user enters a username, a link to a photo (from unsplash) or a profile url, the data mining application should start to track the result from the API. As a second task, it was a requirement to have a dashboard with the top 10 of tracked images with the most downloads, likes and views. In addition, the top 10 tracked user with the most downloads and views respectively. The API request should be limited to a minimal. Each result should be saved in a database and the application should serve the saved results, if the saved result is not outdated.

Jetstream as a backend-framework was allowed, and frontend was not intended to be judged.

In addition, there are a couple of bonus tasks:
* 2-factor authentication
* Caching (for example with redis)
* User data tracking via cronjob/ queue
* List of all features thumbnails with links from a user
* Representation of followers and followings
* Self track of users with cross connection inside the database (for example via followers of a tracked user)
* Representation of the remaining API calls to not exceed the free contingent
* (Special) Rotating of multiple API keys to push the API requests limit higher

## Requirements

* PHP >= 8.0
* Unsplash developer account

## Installation

### Install project dependencies backend
```
composer install
```

### Install project dependencies frontend
```
npm i
```

### Copy the env file
```
cp .env.example .env
```
Fill out the db credentials and the unsplash API key. (Get your key [here](https://unsplash.com/developers))

### Generate the app encryption key
```
php artisan key:generate
```

### Create an empty database
The database needs to be named the same as the value of the key DB_DATABASE from the `.env` file, the standard is datamining, but you are free to change.
```
mysql

Welcome to the MySQL monitor.
mysql> CREATE DATABASE datamining;
```

### Migrate the database
```
php artisan migrate
```

## Usage

After you successfull registered yourself as a new user, you can start passing usernames or links to the search bar. You will be redirected if the username or link is valid. Checkout the dashboard to see it updating after you added a new tracked user by simply search for him.

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits
The wrapper for the unsplash API is mostly from [Shweshi](https://github.com/shweshi/Laravel-Unsplash-Wrapper) under the [MIT license](https://opensource.org/licenses/MIT). I needed the get the full response to access the api request limit informations.
