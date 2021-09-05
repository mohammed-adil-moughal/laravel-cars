Getting started
 1) Clone repo
 2) Composer install
 3) run command to create db `php artisan database:create`
 4) run `php artisan migrate:install`
 5) run `php artisan migrate`
 6) run `php artisan db:seed` to seed data
 7) run `php artisan serve`
 CAR Endpoints
 
 GET
 
 `http://127.0.0.1:8000/api/cars`
![image](https://user-images.githubusercontent.com/10894677/132135240-ec1fb8db-7ff4-4e85-93fa-9bb3a8e90dd2.png)

 `http://127.0.0.1:8000/api/cars/1` 
![image](https://user-images.githubusercontent.com/10894677/132135224-17d6e3e5-3c56-4f68-ad07-ba0f35b5ec9b.png)

 GET FILTERS
 `http://127.0.0.1:8000/api/cars?brand=teal` `http://127.0.0.1:8000/api/cars?color=teal`   
 ![image](https://user-images.githubusercontent.com/10894677/132135264-3bd0987d-1498-4ef0-8c24-8f7927c17fe9.png)

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


UPLOAD IMAGE
```
curl --location --request POST 'http://127.0.0.1:8000/api/car-image' \
--header 'Accept: application/json' \
--form 'description="carimages"' \
--form 'car="2"' \
--form 'file=@"/home/adil/Pictures/DK/download.jpeg"'
```
