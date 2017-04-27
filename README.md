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
The endpoints that are currently work in progress are marked with a 🚧.

### Auth

`POST /auth`  
Send email and password to receive a valid user token for further requests

### Lists

`GET /lists`  
All lists associated with the current user (using the pivot table `list_user`)  
  
`GET /lists/{id}`  
A specific list defined by id for the current user, including all the lists items and all associated category information with these items.  
  
🚧 `GET /lists/{listID}/item/{itemID}` (do I really need this?!)  
Get detailed item information  
  
🚧 `POST /users`  
Create a new user after successful registration.  
  
🚧 `DELETE /users`  
If a user wants to delete it's account...  
  
🚧 `POST /lists`  
Create a new list for the currently active user. Needs the following data passed in as parameters: `name`, `users` (ids of additional users that should be related to this list besides the owner)  
  
🚧 `POST /items`  
Create a new item (unrelated to any list). The following fields need to be defined: `name`, `category_id`.  
  
🚧 `POST /lists/{id}/items`  
Add an existing item to the specified list. The following fields need to be defined: `item_id`.  

🚧 `DELERE /lists/{id}/items/{id}`  
Remove an item from a list.  
  
🚧 `PUT /lists/{id}` 
  
🚧 `PUT /me`  
Change details of the currently logged in user
  
🚧 `PUT /items/{id}` 

## Status Codes
 - `200`: Successful request, the requested data can be found under the data attribute
 - `401`: Unauthorized request (either the requested source is not associated with the current user or the passed api token is invalid)
 - `404`: Resource not found
 - `422`: Invalid user input (e.g. invalid credentials for the auth endpoint)
 - `500`: Internal server error