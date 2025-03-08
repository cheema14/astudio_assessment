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
