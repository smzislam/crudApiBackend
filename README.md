# crudApiBackend using Lumen PHP Framework

It's a restful api with Jwt Authentication using Laravel Lumen.

use php -S localhost:8000 -t public to run the api

## End point

# To create user: http://localhost:8000/api/register, method: post
{
    "name":"xxx",
    "email":"xxx@gmail.com",
    "password":"xxx"
}
# To get jwt token, login: http://localhost:8000/api/login, method: post
{
    "email":"xxx@gmail.com",
    "password":"xxx"
}

# Products End point:
    1. http://localhost:8000/api/product, method: get
    2. http://localhost:8000/api/product/:id, method: get
    3. http://localhost:8000/api/product, method: post
    4. http://localhost:8000/api/product/:id, method: put
    5. http://localhost:8000/api/product/:id, method: delete


## License

This software is licensed under the [MIT license](https://opensource.org/licenses/MIT).
