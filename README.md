# WorldSkills UK: Simple Todo REST API Example

This is a minimalistic REST API for managing todos and todo categories.\
It includes:
- todo CRUD
- categories CRUD
- basic auth (login, register, logout)

[OpenAPI doc](api_spec.yaml)\
Open it with a swagger viewer (if you use vscode, there is a `swagger viewer` extension).

## Auth
Each route except login and register are protected behind login. Once you login or register, you will receive a token. This token has to be passed as an Authorization bearer token: Authorization: Bearer \<token>.\
If you are unfamiliar with the concept [you can read more here.](https://swagger.io/docs/specification/v3_0/authentication/bearer-authentication/)\
[More here](https://apidog.com/articles/how-to-add-pass-bearer-token-header/)\

## Frontend Task Description
During a competition in a "frontend development" module, you will often get a consume-ready API (like this), and you need to build a frontend application around it. Therefore, it is important to understand how to use API routes, and how to call them in JavaScript. You can either use fetch, or an npm package called axios. Fetch is default, while axios needs to be installed. [Read the differences, and pick the one you prefer](https://scrapingant.com/blog/axios-vs-fetch)

## How to use this api?
I will assume you are familiar with git. First you will have to clone this repo, then in the folder run "composer install"(You need to have PHP and composer installed).\
You need to have a database available, preferably mysql(as it'll be available during competition as well). You can get a local install with ampps or xampp, note that ampps is more recommended, and very user friendly.

Once you ran the install command, change the name of [.env.example](.env.example) to `.env`. Then, change your database credentials.(If you are unsure how to, please contact me for explanation or do your own research.) No need to touch anything else.

If that's done, run in the terminal (obviously in the folder of the project...) `php artisan migrate:fresh --seed`. That will roll up the tables and provide with basic data (a user, and some categories for them). [Basic data here](database/seeders/DatabaseSeeder.php)

If that is successful (should be, if you entered your db details correctly), run `php artisan serve`. It will start the development server, by default on `127.0.0.1:8000`.

And that's it. You have the api ready. For detailed route specifications, [read the doc](api_spec.yaml). There is also a [db_schema.png](db_schema.png).

Note: all routes are prefixed with api/v1. So for example, the full login route is `127.0.0.1:8000/api/v1/auth/login`.

## Other resources
You are expected to have a minimal understanding of HTTP status codes, especially ones that are commonly used in REST APIs. You will the following status codes in this API: 200, 201, 204, 401, 403, 422, 404\
I recommend reading through [this](https://restfulapi.net/http-status-codes/) website.

If you have any question, feel free to reach out. You can find my contact methods [here](https://markkiss.netlify.app/#contact).
