# astudio_assessment

# Astudio API Documentation

This document provides detailed information about the Astudio API endpoints as defined in the Postman collection. The API is organized into several categories: **User**, **Attribute**, **Attribute Values**, and **Project**. Each endpoint requires authentication unless specified otherwise, using a Bearer token stored in the `astudio_token` environment variable.

-   **Base URL**: `{{base_url}}` (replace with your actual API base URL, e.g., `http://127.0.0.1:3131/api`)
-   **Authentication**: Bearer Token (`{{astudio_token}}`) unless noted
-   **Date**: Generated on March 08, 2025

---

## Installation

1. composer install
2. modify .env file with you db credentials
3. php artisan migrate --seed
4. php artisan serve --port=3131
   I am using this specific port because it will always be available also, I have used the base_url in my POSTMAN collection.

## Table of Contents

1. [User Endpoints](#user-endpoints)
    - [Login](#login)
    - [Create User](#create-user)
    - [Logout](#logout)
    - [Get User](#get-user)
    - [Get All Users](#get-all-users)
    - [Update User](#update-user)
    - [Delete User](#delete-user)
2. [Attribute Endpoints](#attribute-endpoints)
    - [Show All Attributes](#show-all-attributes)
    - [Store Attribute](#store-attribute)
3. [Attribute Values Endpoints](#attribute-values-endpoints)
    - [Store Attribute Value](#store-attribute-value)
    - [Filter Projects by Attribute](#filter-projects-by-attribute)
4. [Project Endpoints](#project-endpoints)
    - [Save Project](#save-project)
    - [Get Project](#get-project)
    - [Update Project](#update-project)
    - [Delete Project](#delete-project)

---

## User Endpoints

### Login

Authenticates a user and returns an access token.

-   **Method**: `POST`
-   **URL**: `{{base_url}}/login`
-   **Authentication**: None
-   **Request Body** (form-data):
    -   `email` (string, required): User's email (e.g., `ali@gmail.com`)
    -   `password` (string, required): User's password (e.g., `Pakistan@123`)
-   **Response**: JSON containing `access_token` (stored in `astudio_token`)
-   **Example**:
    ```bash
    curl -X POST {{base_url}}/login \
    -F "email=ali@gmail.com" \
    -F "password=Pakistan@123"
    ```

## Create User

Creates a new user account.

-   Method: POST
-   URL: {{base_url}}/users
-   Authentication: Bearer Token
-   Request Body (form-data):
    -   email (string, required): User's email (e.g., hassan@gmail.com)
    -   password (string, required): User's password (e.g., Pakistan@123)
    -   password_confirmation (string, required): Password confirmation (e.g., Pakistan@123)
    -   name (string, required): User's name (e.g., ali hassan)
-   Example:

    ```bash
    curl -X POST {{base_url}}/users \
    -H "Authorization: Bearer {{astudio_token}}" \
    -F "email=hassan@gmail.com" \
    -F "password=Pakistan@123" \
    -F "password_confirmation=Pakistan@123" \
    -F "name=ali hassan"


    ```

### Logout

### Logs out the authenticated user.

-   Method: POST
-   URL: http://127.0.0.1:3131/api/logout
-   Authentication: OAuth2 (header token)
-   Request Body: None

```bash
curl -X POST http://127.0.0.1:3131/api/logout \
-H "Authorization: Bearer {{astudio_token}}"
```

### Get User

### Retrieves details of a specific user by ID.

-   Method: GET
-   URL: {{base_url}}/users/{id}
-   Authentication: Bearer Token
-   Path Parameters:
-   id (integer, required): User ID (e.g., 1)

```bash
curl -X GET {{base_url}}/users/1 \
-H "Authorization: Bearer {{astudio_token}}"
```

### Get All Users

### Retrieves a list of all users.

-   Method: GET
-   URL: {{base_url}}/users
-   Authentication: Bearer Token
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X GET {{base_url}}/users \
-H "Authorization: Bearer {{astudio_token}}"
```

-   Update User
-   Updates an existing user's details.

-   Method: PUT
-   URL: {{base_url}}/users/{id}
-   Authentication: Bearer Token
-   Path Parameters:
-   id (integer, required): User ID (e.g., 4)
-   Request Body (raw JSON):
-   name (string, optional): Updated name (e.g., "Ali Hassan Cheema Saab")
-   email (string, optional): Updated email (e.g., "ali@hotmail.com")
-   password (string, optional): New password (e.g., "Pakistan@123")
-   password_confirmation (string, optional): Password confirmation (e.g., "Pakistan@123")
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X PUT {{base_url}}/users/4 \
-H "Authorization: Bearer {{astudio_token}}" \
-H "Content-Type: application/json" \
-d '{"name":"Ali Hassan Cheema Saab","email":"ali@hotmail.com","password":"Pakistan@123","password_confirmation":"Pakistan@123"}'
```

### Delete User

### Deletes a user by ID.

-   Method: DELETE
-   URL: {{base_url}}/users/{id}
-   Authentication: Bearer Token
-   Path Parameters:
-   id (integer, required): User ID (e.g., 5)
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X DELETE {{base_url}}/users/5 \
-H "Authorization: Bearer {{astudio_token}}"
```

### Attribute Endpoints

### Show All Attributes

### Retrieves a list of all attributes.

-   Method: GET
-   URL: {{base_url}}/get-all-attributes
-   Authentication: Bearer Token
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X GET {{base_url}}/get-all-attributes \
-H "Authorization: Bearer {{astudio_token}}"
```

### Store Attribute

### Creates a new attribute.

-   Method: POST
-   URL: {{base_url}}/store-attributes
-   Authentication: Bearer Token
-   Request Body (form-data):
-   name (string, required): Attribute name (e.g., "attribute 3")
-   type (string, required): Attribute type (e.g., "date")
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X POST {{base_url}}/store-attributes \
-H "Authorization: Bearer {{astudio_token}}" \
-F "name=attribute 3" \
-F "type=date"
```

### Attribute Values Endpoints

### Store Attribute Value

### Associates attribute values with a project.

-   Method: POST
-   URL: {{base_url}}/projects/{project_id}/attributes
-   Authentication: Bearer Token
-   Path Parameters:
-   project_id (integer, required): Project ID (e.g., 1)
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X POST {{base_url}}/projects/1/attributes \
-H "Authorization: Bearer {{astudio_token}}" \
-H "Content-Type: application/json" \
-d '{"attributes":[{"attribute_id":2,"value":123},{"attribute_id":1,"value":"Test is test"}]}'
```

### Project Endpoints

### Save Project

### Creates a new project.

-   Method: POST
-   URL: {{base_url}}/save-project
-   Authentication: Bearer Token
-   Request Body (form-data):
-   name (string, required): Project name (e.g., "New Project")
-   status (string, required): Project status (e.g., "new status")
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X POST {{base_url}}/save-project \
-H "Authorization: Bearer {{astudio_token}}" \
-F "name=New Project" \
-F "status=new status"
```

### Get Project

### Retrieves details of a specific project by ID.

-   Method: GET
-   URL: {{base_url}}/get-project/{id}
-   Authentication: Bearer Token
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X GET {{base_url}}/get-project/1 \
-H "Authorization: Bearer {{astudio_token}}"
```

### Update Project

### Updates an existing project's details.

-   Method: PUT
-   URL: {{base_url}}/update-project/{id}
-   Authentication: Bearer Token
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X PUT "{{base_url}}/update-project/1?name=new name&status=changed" \
-H "Authorization: Bearer {{astudio_token}}"
```

### Delete Project

### Deletes a project by ID.

-   Method: DELETE
-   URL: {{base_url}}/delete-project/{id}
-   Authentication: Bearer Token
-   Example Request (cURL)
-   bash
-   Copy
-   Edit

```bash
curl -X DELETE {{base_url}}/delete-project/1 \
-H "Authorization: Bearer {{astudio_token}}"
```
