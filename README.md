## Overview about the project:
The project uses a Node.js application to call the vehicles api and fetch the result in to a laravel. Laravel stores each vehicle in to redis cache and compares if has to store the ride in to SQLite database or not. Then if ride is stored redis cache entry is updated.

### Docker containers
- Node.js application to call api every minute
- Laravel 11.x Framework used to process api information from Node.js application 
- Nginx to handle Laravel
- Redis cache to store vehicles
- SQLite for database

### Done in project
- Fully dockerized the environment under a single network to ensure api connectivity (Php 8.3 (Laravel 11), Nginx, SQLite and Node.js application)
- Modeled domain in to DDD architecture
- Created migrations for database
- Extracted and pushed entity logic in to value objects
- Extracted repositories with domain interfaces
- Created a Makefile with commands to execute the project easily
- Created unit tests and application tests
- Created main application to store rides

## What could have been added:
- Some seeders to fill rides database
- Create a rabbit queue to send api vehicles

## How to run the task
### Makefile
You have a Makefile created where you can execute some commands, here is a list of what you need to execute:

- With these commands you can get the docker ready and running:
  - make build
  - make up


- If you want to enter in to php machine:
  - make ssh


- Install composer dependencies:
  - make composer-install


- With this these commands you get your database ready:
  - make migrate


- If you want to execute tests:
  - make run-tests


- If you want to check redis keys you can use:
  - make get-all-keys

  
- If you want to search for specific redis key for example 123:
  - make search-key 123


- To execute the statistic command without date:
  - make statistics


- To execute the statistic command with date:
  - make statistics 2024-07-30