# Giphy API V2 Application

Hi! This is a technical challenge for Prex, implemented using Laravel 10, PHP 8.2, and MySQL.

## Prerequisites

To run this application, you must have Docker and docker-compose installed on your system.

## Steps to Run the Application

1. Clone the repository:

   ```bash
   git clone https://github.com/cerkvenihaxel/giphy_api_v2

2. Start the application using docker-compose:

    ```bash
    docker compose up --build

3. In a new console copy the .env.example file to .env inside the Nginx container:

    ```bash
    docker compose exec nginx sh -c 'cd /var/www/html && cp .env.example .env'

4. Run migrations and install Passport inside the PHP container:

    ```bash
    docker compose exec php sh -c 'php artisan migrate --force && php artisan passport:install'

5. After these steps your application will be located at:

   ```bash
    http:localhost:90

### This application utilizes the Giphy API to retrieve and display GIFs. A .env file is required to configure the application's environment variables. Additionally, Laravel Passport is used for authentication and authorization.

# API Endpoints

Below are the details of the endpoints included in the Postman collection:

### 1. Login

**Endpoint:** `POST /api/login`

**Description:** Authenticates a user and returns an access token.

**Body Parameters:**
- `email`: User's email address.
- `password`: User's password.

**Example Request:**
```json
{
    "email": "prex@test.com",
    "password": "prex1234"
}
```

### 2. Sign Up

**Endpoint:** `POST /api/signup`

**Description:** Registers a new user.

**Body Parameters:**
- `name`: User's name.
- `email`: User's email.
- `password`: User's password.

**Example Request:**
```json
{
    "email": "Prex prueba",
    "email": "prex2@test.com",
    "password": "prex1234"
}
```

### 3. Search GIFs

**Endpoint:** `GET /api/gifs/search`

**Description:** Searches for GIFs based on a query.

**Query Parameters:**
- `query`: Search term.
- `limit`: Number of results to return.
- `offset`: Offset for pagination.

**Example Request:**

   ```bash
      GET http://localhost:90/api/gifs/search?query=mermaid&limit=3&offset=0
   ```

### 4. Search GIFs by ID

**Endpoint:** `GET /api/gifs/searchById`

**Description:** Retrieves a GIF by its ID.

**Query Parameters:**
- `id`: ID of the GIF.

  ```bash
      GET http://localhost:90/api/gifs/searchById?id=QfC29SAXu2EGeHX1JM
  ```

### 5. Save GIFs

**Endpoint:** `GET /api/gifs/saveGif`

**Description:** Saves a GIF with an alias for a user.

**Body Parameters:**
- `user_id`: User's id.
- `alias`: Alias for the GIF.
- `gif_id`: ID of the GIF.

**Example Request:**
```json
{
    "gif_id": "QfC29SAXu2EGeHX1J321313",
    "alias": "mermaid",
    "user_id": "2"
}
```

## Postman Collection

You can access and import the Postman collection for this API using the following link:
[Donwload Postamn Collection](https://drive.google.com/drive/folders/1ZxWetVlPx1PDV_zgyHHlEIIMZqiA7TYD?usp=sharing)

## Database Entity-Relationship Diagram (ERD)

![ERD](https://i.ibb.co/MSgMSYN/DER.png)

## UML Diagram

![UML Diagram](https://i.ibb.co/dG68g1B/DIAGRAMA-UML-API-GIPHY.png)


## Use Case Diagram

![Use case diagram](https://i.ibb.co/7VV9GVq/Diagrama-casos-de-uso.png)

## Sequence Diagram

![Sequence Diagram](https://i.ibb.co/JvLM4sf/diagrama-secuencia-uml.png)

