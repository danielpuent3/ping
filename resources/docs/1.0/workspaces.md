# Workspaces

---
- [Create Workspace](#create)
- [List Workspaces](#list)
- [Set Current Workspace](#current)


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

<a name="current"></a>
## Set Current Workspace

### Endpoint

| Method | URL   | Action | Route Name |
| : |   :-   |  :  | : |
| POST | **{{route('api.workspaces.set_current', [':id'])}}** | ApiWorkspacesController@setCurrentWorkspace | api.workspaces.set_current |

### Headers

```json
{
  "Authorization": "Bearer {token}"
}
```

### URL Params

```json
{
  "id": "Workspace ID"
}
```

