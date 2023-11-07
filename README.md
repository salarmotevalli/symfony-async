# Symfony Queue

A sample implementation of async messenger in Symfony frameworke and integrate it with Docker

## Run Server

```bash
make build_server
make i
make up
```

## Usage 

```curl
curl -H "Content-type: application/json" 'http://0.0.0.0:8080/report/orders' -X POST -d '{"name": "salar", "email": "salar.mo.ro@gmail.com"}'
```
### Response 
```json
{"message":"report sent to salar email: salar.mo.ro@gmail.com"}
```
Then open and check http://0.0.0.0:1080/ the Mailcatcher endpoin

