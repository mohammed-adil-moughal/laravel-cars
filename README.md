Getting started
 1) Clone repo
 2) Composer install
 3) run command to create db `php artisan database:create`
 4) run `php artisan migrate:install`
 5) run `php artisan migrate`
 6) run `php artisan db:seed` to seed data
 
 CAR Endpoints
 
 GET
 `http://127.0.0.1:8000/api/cars` `http://127.0.0.1:8000/api/cars/1` `http://127.0.0.1:8000/api/cars?brand=teal`  
 
 POST 
`http://127.0.0.1:8000/api/cars`
```
{
        "name": "Corbin",
        "color": "LightYellow",
        "brand": 1
}
```
PATCH
`http://127.0.0.1:8000/api/cars/1`
```
{
        "color": "LightYellow",
        "brand": 1
}

```

 DELETE

`http://127.0.0.1:8000/api/cars/1`




 CARBRAND Endpoints
 
 GET
 `http://127.0.0.1:8000/api/car-brands` `http://127.0.0.1:8000/api/car-brands/1`  
 

 POST 
`http://127.0.0.1:8000/api/car-brands`
```
{
        "name": "Corbin",
        "description": "nice mane nice"
}
```

PATCH
`http://127.0.0.1:8000/api/car-brands/1`
```
{
        "description": "llasaow"
}

```


 DELETE

`http://127.0.0.1:8000/api/car-brands/1`
