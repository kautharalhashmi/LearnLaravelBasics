<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



#  Laravel Controllers 

Controllers in Laravel **handle requests** and **return responses**.

Instead of putting logic inside your route files (`web.php` or `api.php`), you can move it to **controller classes**, keeping things clean and organized.



##  Creating a Controller

Use Artisan to create a controller:

```bash
php artisan make:controller PostController
````

This creates:

```
app/Http/Controllers/PostController.php
```

---

##  Basic Controller Example

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return 'All Posts';
    }

    public function show($id)
    {
        return 'Post ID: ' . $id;
    }
}
```

---

##  Using Controller in Routes

In `routes/web.php` or `routes/api.php`:

```php
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
```

---

##  Request Injection Example

You can automatically inject the `Request` object:

```php
public function store(Request $request)
{
    return $request->all();
}
```

---

##  Resource Controllers

If your controller handles CRUD (Create, Read, Update, Delete), use a **resource controller**:

### Create One:

```bash
php artisan make:controller ProductController --resource
```

This creates methods like:

* `index()`
* `create()`
* `store()`
* `show($id)`
* `edit($id)`
* `update(Request $request, $id)`
* `destroy($id)`

### Register Routes:

```php
Route::resource('products', ProductController::class);
```

This sets up these routes automatically:

| HTTP Verb | URI                 | Action  |
| --------- | ------------------- | ------- |
| GET       | /products           | index   |
| GET       | /products/create    | create  |
| POST      | /products           | store   |
| GET       | /products/{id}      | show    |
| GET       | /products/{id}/edit | edit    |
| PUT/PATCH | /products/{id}      | update  |
| DELETE    | /products/{id}      | destroy |

---

##  Route::controller (Grouped Routes)

You can group multiple methods from one controller like this:

```php
Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{id}', 'show');
});
```

---

##  Single Action Controller

Sometimes you want a controller with only one method.

### Create:

```bash
php artisan make:controller ContactController --invokable
```

### Code:

```php
class ContactController extends Controller
{
    public function __invoke()
    {
        return 'Contact Page';
    }
}
```

### Route:

```php
Route::get('/contact', ContactController::class);
```

---

##  Middleware in Controller

Add middleware inside the constructor:

```php
public function __construct()
{
    $this->middleware('auth');
}
```

Or apply it only to specific methods:

```php
public function __construct()
{
    $this->middleware('auth')->only(['store', 'update']);
}
```

---

##  Dependency Injection

Controllers can automatically inject services:

```php
use App\Services\ReportService;

public function generate(ReportService $reportService)
{
    return $reportService->run();
}
```

Laravel will resolve the dependency from the service container.

---


