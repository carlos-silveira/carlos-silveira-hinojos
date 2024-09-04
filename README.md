
# Products API

Basic Laravel API to do CRUD of products, register/login/logout users.

## Requirements

- PHP >= 8.0
- Composer
- MySQL

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/carlos-silveira-hinojos.git
   cd carlos-silveira-hinojos
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Create database**

    We need to create the schema in MySQL with:

    ```sql
    CREATE DATABASE IF NOT EXISTS inventory;
    USE inventory;
    ```

    Or use the command I put to simplify this:
    ```bash
    chmod +x create-db.sh
    ./create-db.sh
    ```


4. **Set up environment variables:**

   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

   Then update the database credentials in the `.env` file:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventory
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```

5. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

6. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

7. **Serve the application:**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://127.0.0.1:8000`.



## Using the API with Postman

### 1. Register a New User

- **URL:** `http://127.0.0.1:8000/api/register`
- **Method:** `POST`
- **Headers:**
  - `Content-Type: application/json`
- **Body (JSON):**
  ```json
  {
      "name": "Juan Lopez",
      "phone": "123456789",
      "img_profile": "https://images.com/profile.jpg",
      "email": "juan@gmail.com",
      "password": "password12345",
      "password_confirmation": "password12345"
  }
  ```

### 2. Login with an Existing User

- **URL:** `http://127.0.0.1:8000/api/login`
- **Method:** `POST`
- **Headers:**
  - `Content-Type: application/json`
- **Body (JSON):**
  ```json
  {
      "email": "juan@gmail.com",
      "password": "password12345"
  }
  ```

- **Response:**
  - You will receive a token to be used for authenticated requests.

### 3. Get All Products

- **URL:** `http://127.0.0.1:8000/api/products`
- **Method:** `GET`
- **Headers:**
  - `Authorization: Bearer <your_token_here>`

### 4. Create a New Product

- **URL:** `http://127.0.0.1:8000/api/products`
- **Method:** `POST`
- **Headers:**
  - `Authorization: Bearer <your_token_here>`
  - `Content-Type: application/json`
- **Body (JSON):**
  ```json
  {
      "name": "Banana",
      "description": "Fruit",
      "height": 10.5,
      "length": 20.3,
      "width": 15.0
  }
  ```

### 5. Update an Existing Product

- **URL:** `http://127.0.0.1:8000/api/products/{id}`
- **Method:** `PUT`
- **Headers:**
  - `Authorization: Bearer <your_token_here>`
  - `Content-Type: application/json`
- **Body (JSON):**
  ```json
  {
      "name": "Avocado",
      "description": "Fruit",
      "height": 12.5,
      "length": 22.3,
      "width": 18.0
  }
  ```

### 6. Delete a Product

- **URL:** `http://127.0.0.1:8000/api/products/{id}`
- **Method:** `DELETE`
- **Headers:**
  - `Authorization: Bearer <your_token_here>`

### 7. Logout

- **URL:** `http://127.0.0.1:8000/api/logout`
- **Method:** `POST`
- **Headers:**
  - `Authorization: Bearer <your_token_here>`

## Notes

- Ensure that you replace `<your_token_here>` with the actual token received after login or registration.
- The token has a 1-hour expiration time. After that, you will need to log in again to get a new token.
