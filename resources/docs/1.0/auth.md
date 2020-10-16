# Auth

---
- [Register](#register)

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
