# Workspaces

---
- [Create Workspace](#create)
- [List Workspaces](#list)


<a name="create"></a>
## Create Workspace

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.workspaces.store')}}** | ApiWorkspacesController@store | api.workspaces.store |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

### Data Params

```json
{
  "name" : "required, unique"
}
```

<a name="list"></a>
## List Workspaces

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.workspaces.index')}}** | ApiWorkspacesController@index | api.workspaces.index |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

