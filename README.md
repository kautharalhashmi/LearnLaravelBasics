<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Laravel Middleware 

Middleware in Laravel is like a **filter** that runs **before or after** a request hits your controller.

Think of it like a **security gate**:
- Before you enter a building (your app), the guard (middleware) checks your ID (like authentication).
- Once you're allowed in, the request reaches the right room (controller).
- When you leave, the guard can do something else (like logging).

---

##  Why Use Middleware?

Middleware is useful for:

- Checking if the user is authenticated
- Verifying if the user is an admin
- Logging user activity
- CORS (Cross-Origin Resource Sharing)
- Maintenance mode handling

---

##  Creating Middleware

Run this command to create middleware:

```bash
php artisan make:middleware CheckAge
```
###### Will be creating this app/Http/Middleware/CheckAge.php

**Example: CheckAge Middleware**
```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age <= 18) {
            return redirect('no-access');
        }

        return $next($request);
    }
}
//If age is 18 or less, redirect to no-access.
//Otherwise, go to the next step (controller).

```
## Register Middleware

```php
// Open this file
app/Http/Kernel.php

// Add to $routeMiddleware:
protected $routeMiddleware = [
    'check.age' => \App\Http\Middleware\CheckAge::class,
];
// Now you can use 'check.age' in routes.
```

## Using Middleware in Routes

**Single Route Example**
```php
Route::get('/restricted', function () {
    return 'Welcome, adult!';
})->middleware('check.age');

```

**Group Middleware Example**
```php
Route::middleware(['check.age'])->group(function () {
    Route::get('/drinks', fn () => 'Bar');
    Route::get('/casino', fn () => 'Gamble');
});

```


##  Global Middleware
##### If you want your middleware to run for every request, add it to $middleware in app/Http/Kernel.php:

```php
protected $middleware = [
    \App\Http\Middleware\CheckAge::class,
];
```


## Middleware Parameters
##### Middleware can take parameters!

```php
public function handle(Request $request, Closure $next, $role)
{
    if (!$request->user()->hasRole($role)) {
        abort(403);
    }

    return $next($request);
}

```

##### Use it in a route like:

```php
Route::get('/admin', fn () => 'Admin Page')->middleware('role:admin');

```

## Terminable Middleware (Runs After Response)
##### If you want middleware to run after the response is sent to the browser, implement \Illuminate\Contracts\Http\Middleware\TerminableMiddleware.

```php
use Illuminate\Contracts\Http\Middleware\TerminableMiddleware;

class LogAfterResponse implements TerminableMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        \Log::info('Response sent for ' . $request->url());
    }
}

```



















