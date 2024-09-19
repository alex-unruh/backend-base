# BACKEND BASE
## Start Point to backend Rest API system builded with PHP (8.2+) and Laravel Framework (11)

### Features

- Rest API's only. It has no visual interface
- Complete CRUD with form request validation for users 
- First user record automatically created during migration
- Postman Collection available in root
- Basic authentication configured to route api/login (to get token)
- Sanctum authentication configured for all other routes (with bearer token)

### How to configure

1. Clone this repository
2. To install dependecies run:
```
composer install
```
3. Configure database connection in .env file
4. Run: 
```
php artisan migrate
```
5. Import thunder-collection.json file in Thunder Client extension (VSCode) or Postman
6. To start server, run:
```
php artisan serve
```
7. Run the auth/login request in your client. This request need basic authentication with headers **username**: "_admin@backend.com_" and **password**: "_admin01_"
8. Get the token returned in response and add into other requests as header Bearer Token
9. By default a user must have the following attributes:
```json
{
  "name": "John Doe",
  "email": "johndoe@backend.com",
  "password": "johndoe123",
  "profile": "Collaborator"
}
```
- Profile attribute is optional
- The password is needed only in store requests, but is optional in updates
- By default, the profile attribute can be: "Administrator" (default) or "Collaborator". This can be configured in _lang/en/auth.php_ file.
- Only Administrators can manage users
- A logged user cannot remove your own user

Enjoy.
