# Auth

---
- [Authenticate](#authenticate)
- [Current User](#current)
- [Register](#register)


<a name="authenticate"></a>
## Authenticate

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.auth.login')}}** | ApiAuthController@authenticate | api.auth.login |

### Data Params

```json
{
  "email" : "required, Valid Email",
  "password" : "required"
}
```

> {info} Response will return an `authorization_token`. Authenticated requests will need to pass this bearer token via the Authorization header. ex. Authorization: Bearer {token}


<a name="current"></a>
## Get Current User

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| GET | **{{route('api.auth.current')}}** | api.php | api.auth.login |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

<a name="register"></a>
## Register

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.auth.register')}}** | ApiAuthController@register | api.auth.register |

### Data Params

```json
{
  "name" : "required",
  "email" : "required, Valid Email",
  "password" : "required, Must contain Numeric, Must contain Uppercase, Min Length: 8",
  "password_confirmation" : "required, must match password"
}
```
