# api-groceries
This is the API server for the [rn-groceries](https://github.com/julianburr/rn-groceries) app, a basic personal playground for React Native development.

The API server is kept very basic and built with Laravel.

## Get started
```bin
git clone https://github.com/julianburr/api-groceries.git
cd api-groceries

composer install

# After setting up .env for db connection etc
php artisan migrate --seed
php artisan serve
```

## Endpoints

All api endpoints are grouped under `api/v1`.

### Auth

`POST /auth`  
Send email and password to receive a valid user token for further requests

### Lists

`GET /lists`  
All lists associated with the current user (using the pivot table `list_user`)
  
`GET /lists/{id}`  
A specific list defined by id for the current user

## Status Codes
 - `200`: Successful request, the requested data can be found under the data attribute
 - `401`: Unauthorized request (either the requested source is not associated with the current user or the passed api token is invalid)
 - `404`: Resource not found
 - `422`: Invalid user input (e.g. invalid credentials for the auth endpoint)
 - `500`: Internal server error