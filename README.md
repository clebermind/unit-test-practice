# Unit Test Practice
![PHP Unit](https://www.ashleysheridan.co.uk/img/articles/PHP_Logo_PHP_Unit.png)

This is a basic PHP 8.2, Symfony 6 and MySQL project using Docker.<br>
The purpose of this project is to implement unit tests for the controller and service classes.<br>
There is also an improvement to be done, ensuring the tests are properly executed.

---

## Installation

1. Clone the repository:
    ```bash
    git clone git@github.com:clebermind/unit-test-practice.git
    ```

2. Navigate to the project directory:
    ```bash
    cd unit-test-practice
    ```

3. Run the Docker containers:
    ```bash
    docker-compose up -d
    ```

4. Log into the PHP container:
    ```bash
    docker exec -it php-unit-test /bin/bash
    ```

5. Install dependencies:
    ```bash
    composer install
    ```

6. Run the database migrations:
    ```bash
    php bin/console doctrine:migrations:migrate
    ```

---

## Usage

To run the project locally:

1. Access the app at `http://localhost:8000`.

### API Endpoints

| Method | Endpoint          | Description            |
|--------|-------------------|------------------------|
| GET    | `/users`           | Fetch all users        |
| GET    | `/user/{id}`       | Fetch a user by ID     |

### Filters

You can filter the list of users using query parameters:

1. **Filter by first letter**:
   - Example: `http://localhost:8080/users?filter=first-letter&letter=t`
   - Returns:
     ```json
     [
       {
         "id": 3,
         "name": "Thilini"
       }
     ]
     ```

2. **Filter by ODD IDs**:
   - Example: `http://localhost:8080/users?filter=odd`

3. **Filter by EVEN IDs**:
   - Example: `http://localhost:8080/users?filter=even`

---

## Running Unit Tests

First, make sure you're inside the PHP container:
   ```bash
   docker exec -it php-unit-test /bin/bash
   ```

1. Run all the tests:
   ```bash
   php vendor/bin/phpunit
   ```

2. Run a specific test file:
   ```bash
   php vendor/bin/phpunit tests/YourTestFile.php
   ```

3. Run a specific unit test method:
   ```bash
   php vendor/bin/phpunit --filter testName tests/YourTestFile.php
   ```
- Replace `testName` with the name of the test method you want to run, and `YourTestFile.php` with the path to the test file.

## Stopping the containers
Once you're done, you can stop the containers with:

```bash
docker-compose down
```