<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>




# Laravel Routing 

Laravel routing controls what happens when someone visits a URL in your app.

---

## 1. What is Routing?

Routing decides **which code runs** for each URL.

**Example:**
```php
Route::get('/hello', function () {
    return 'Hello, World!';
});
```

## 2. Route Methods

##### Define how users interact with your app.

###### GET – Show data
###### POST – Submit data
###### PUT – Update data
###### DELETE – Delete data
###### PATCH – Partially update data

**Example:**
```php
Route::get('/users', function () {
    return 'List of users';
});

Route::post('/users', function () {
    return 'Create user';
});

Route::put('/users/{id}', function ($id) {
    return 'Update user ' . $id;
});

Route::delete('/users/{id}', function ($id) {
    return 'Delete user ' . $id;
});

```

## 3. Route Parameters

##### Required parameter:
**Example:**
```php
Route::get('/posts/{id}', function ($id) {
    return 'Post ID: ' . $id;
});
```
###### Visiting /posts/5 ➜ Post ID: 5

## 4. Named Routes
##### Name your routes to generate URLs or redirects.
```php
Route::get('/dashboard', function () {
    return 'Dashboard';
})->name('dashboard');

```

```php
// Generate URL:
$url = route('dashboard');

```
```php
// Redirect:
return redirect()->route('dashboard');

```

## 5. Route Groups
##### Group routes to share settings.
**With prefix:**
```php
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });
    Route::get('/settings', function () {
        return 'Admin Settings';
    });
});
```
##### Visiting /admin/users shows Admin Users.

**With middleware:**
```php
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return 'Your Profile';
    });
});
```
## 6. Route Middleware
##### Add extra checks like authentication.
```php
Route::get('/dashboard', function () {
    return 'Dashboard';
})->middleware('auth');

```

## 7. Route Fallback
##### Show a custom page when no route matches.
```php
Route::fallback(function () {
    return 'Sorry, page not found.';
});
```
## 8. Route Model Binding
##### Automatically load models.
```php
Route::get('/posts/{post}', function (App\Models\Post $post) {
    return $post->title;
});

```
##### Visiting /posts/1 loads the Post with ID 1.


## 9. Controllers
##### Use controllers instead of closures.
```php
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
```

## 10. Resource Routes
##### Create all CRUD routes automatically.
```php
Route::resource('photos', PhotoController::class);
```
###### Creates:
###### GET /photos
###### GET /photos/create
###### POST /photos
###### GET /photos/{photo}
###### GET /photos/{photo}/edit
###### PUT/PATCH /photos/{photo}
###### DELETE /photos/{photo}


## 11. Redirect Routes
##### Redirect old URLs.
```php
Route::redirect('/old-page', '/new-page');
```
## 12. View Routes
##### Return a view directly.
```php
Route::view('/welcome', 'welcome');

```
##### This shows resources/views/welcome.blade.php.



