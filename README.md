<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



#  Laravel HTTP Requests 

Laravel provides a powerful `Illuminate\Http\Request` object to work with incoming HTTP requests. It allows you to access input, query parameters, headers, files, cookies, and more.



##  Accessing Request Data

### Inject Request Object

```php
use Illuminate\Http\Request;

public function store(Request $request)
{
    $name = $request->input('name');
}
````

### Shortcut (in routes)

```php
Route::post('/submit', function (Request $request) {
    return $request->input('email');
});
```

---

##  Retrieving Input

### Get All Input

```php
$request->all();
```

### Get Specific Input

```php
$request->input('name'); // or
$request->name;
```

### Default Value

```php
$request->input('name', 'Guest');
```

### Nested Input

```php
$request->input('user.name');
```

---

##  Query Parameters

```php
$request->query('page', 1);
```

Example: `/users?page=2`

---

##  Retrieving Route Parameters

```php
public function show(Request $request, $id)
{
    // OR
    $id = $request->route('id');
}
```

---

##  Checking If Input Exists

```php
$request->has('email');         // true/false
$request->filled('email');      // not empty
$request->missing('token');     // true if not present
```

---

##  Validating Requests

```php
$request->validate([
    'title' => 'required|string|max:255',
    'body' => 'required',
]);
```

If validation fails, Laravel redirects back with errors.

---

##  File Uploads

### Get Uploaded File

```php
$request->file('photo');
```

### Check If File Exists

```php
$request->hasFile('photo');
```

### Validate and Store

```php
$request->validate([
    'photo' => 'required|image|max:2048',
]);

$request->file('photo')->store('photos');
```

---

##  Cookies

### Retrieve

```php
$request->cookie('name');
```

### Set Cookie (in response)

```php
return response('Hello')->cookie('name', 'John', 60);
```

---

##  Headers

### Get a Header

```php
$request->header('Content-Type');
```

### Set a Header

```php
return response('OK')->header('X-Custom', '123');
```

---

##  CSRF Token

```php
$token = $request->input('_token');
```

Usually added automatically in forms via `@csrf` in Blade.

---

##  Request Type Checks

```php
$request->isMethod('post');      // Check method
$request->is('admin/*');         // URI match
$request->ajax();                // Is AJAX?
$request->wantsJson();           // Wants JSON?
```

---

##  Authorization in Requests

```php
public function authorize(): bool
{
    return auth()->user()->isAdmin();
}
```

Used in **Form Request** classes for checking permissions.

---

##  Sanitizing Inputs (via middleware or manually)

Example to trim all inputs:

```php
$request->merge([
    'name' => trim($request->name),
]);
```

Or use Laravel middleware like `TrimStrings`.

---

##  Summary Table

| Feature      | Example                      |
| ------------ | ---------------------------- |
| Input Value  | `$request->input('email')`   |
| All Inputs   | `$request->all()`            |
| Query Param  | `$request->query('page')`    |
| File Upload  | `$request->file('avatar')`   |
| Route Param  | `$request->route('id')`      |
| Cookie Value | `$request->cookie('token')`  |
| Header Value | `$request->header('Accept')` |
| Validate     | `$request->validate([...])`  |
| Method Check | `$request->isMethod('post')` |
| URI Match    | `$request->is('admin/*')`    |

---




