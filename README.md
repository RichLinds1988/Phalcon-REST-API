# Demo RESTful API on Phalcon

by Richard Lindsay

## Technical Specs

* Phalcon 3.2.3
* PHP 7.1
* MongoDB
* Built on DigitalOcean Droplet - Ubuntu 16.04

Base URL: http://45.55.45.146:8600

## Authentication

This API is protected by a very basic authentication system. The only requirement is that the request must contain  
an `Authorization` header with a value equal to `1234`.  

## Routes

### Users

#### POST /products  
Creates a new product

request JSON:
```
{
  "userId": 1,
  "itemName": "test product"
}
```

response JSON:
```
{
    "status": "success",
    "message": "successfully added new item test product for user 1"
}
```
#### GET /products  
Gets all products


response JSON:
```
[
    {
        "uuid": "39ea052136dbb50089c31be16a5f4e735aa1fe78606c7",
        "userId": 1,
        "itemName": "test product",
        "dateIn": 1520565880,
        "status": 0,
        "_id": {
            "$oid": "5aa1fe780bec920001355232"
        }
    },
    {
        "uuid": "de55b9810e2b6f4fdab7d9db6b50a3f25aa1fe94c1346",
        "userId": 2,
        "itemName": "test product 2",
        "dateIn": 1520565908,
        "status": 0,
        "_id": {
            "$oid": "5aa1fe940bec920001355233"
        }
    },
    {
        "uuid": "2804be5400cbcb741f5c1e22331d5d575aa1fe9ad7f5b",
        "userId": 3,
        "itemName": "test product 3",
        "dateIn": 1520565914,
        "status": 0,
        "_id": {
            "$oid": "5aa1fe9a0bec920001355234"
        }
    }
]
```