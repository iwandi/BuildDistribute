# Wolpertinger Build Distribution

iOS/Android build distribution service and web client

## REST API Reference
### Authorization routes (api/auth/*)
| HTTP verb | JSON body | URI | Action |
| ------------- | ------------- | ------------- | ------------- |
| POST  | /authenticate  | "email", "password"  | Authenticate and obtain JWT  |
| GET  | /me  | -  | Returns data from valid JWT from headers  |
### API V1 routes (api/v1/*)
All these routes require JWT attached as an 'Authorization' header with a value of 'Bearer *YOUR_TOKEN*'.

| HTTP verb | JSON body | URI | Action |
| ------------- | ------------- | ------------- | ------------- |
| POST  | /authenticate  | "email", "password"  | Authenticate and obtain JWT  |
