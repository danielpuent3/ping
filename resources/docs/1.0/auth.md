# Auth

---
- [Authenticate](#authenticate)
- [Register](#register)


<a name="authenticate"></a>
## Authenticate

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.auth.login')}}** | ApiAuthController@authenticate | api.auth.login |

### URL Params

```json
none
```

### Data Params

```json
{
  "email" : "required, Valid Email",
  "password" : "required"
}
```

> {info} Response will return an `authorization_token`. Authenticated requests will need to pass this token via the Authorization header.

<a name="register"></a>
## Register

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.auth.register')}}** | ApiAuthController@register | api.auth.register |

### URL Params

```json
none
```

### Data Params

```json
{
  "name" : "required",
  "email" : "required, Valid Email",
  "password" : "required, Must contain Numeric, Must contain Uppercase, Min Length: 8",
  "password_confirmation" : "required, must match password"
}
```
