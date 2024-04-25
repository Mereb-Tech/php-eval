## Setting up
- `composer install`

### Running Tests
- `./vendor/bin/phpunit tests/TestUtils.php`

### Running server
- `php -S localhost:8000 server.php`
- It will give you url like `http://localhost:8000`
- Open the URL and navigate to `http://localhost:8000/getSecureRandom?min=1&max=100`
- You can change query parameters, `min` and `max`.
- If you send without the query parameters, it will generate random secure number between 1 - 100.