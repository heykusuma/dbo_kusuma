## About The Project

DBO Kusuma. Componen didalamnya:

- Auth: Login, Register, Profile Login, Logout
- Customer Management (Get with paginate, Get Detail, Insert, Update, Delete,
Search)
- Order Management (Get with paginate, Get Detail, Insert, Update, Delete,
Search)
- Running in docker
- File DB Migration

How to run:

- Composer update/install
- Change .env.example to .env
- build and run docker with sail command -> ./vendor/bin/sail up
- Run migration inside docker using sail, open new terminal(dont stop the container) and run command -> ./vendor/bin/sail artisan migrate
- Project already start, just open localhost for the 

What's good?
- Design Pattern
- Using JWT
- Search with Laravel Scoout(Algolia)
- Running in Docker with laravel sail
## Contributor Laravel
-- Just me --