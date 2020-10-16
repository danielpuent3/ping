# Channels

---
- [Create Channel](#create)
- [List Channels From Current Workspace](#list)


<a name="create"></a>
## Create Channel

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.channels.store')}}** | ApiChannelsController@store | api.channels.store |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

### Data Params

```json
{
  "name" : "required, unique within workspace",
  "description" : "optional"
}
```

<a name="list"></a>
## List Channels From Current Workspace

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.channels.index')}}** | ApiChannelsController@index | api.channels.index |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

