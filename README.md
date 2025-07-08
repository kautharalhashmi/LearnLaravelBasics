<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


#  Laravel CSRF Protection

CSRF stands for **Cross-Site Request Forgery**. It's a type of attack where a **malicious website tricks users into submitting a form** on another site where they're already logged in.

Laravel protects your app from CSRF attacks **automatically** by verifying a token on each request.

---

##  Why CSRF Protection Is Important

Imagine you're logged into your bank. A malicious site secretly submits a form to `yourbank.com/transfer-money` without your knowledge.

Laravel prevents this using **CSRF tokens**, which must be present and correct for a form request to be accepted.

---

##  How CSRF Protection Works in Laravel

Laravel includes a middleware called:

```

App\Http\Middleware\VerifyCsrfToken

````

This middleware automatically checks **POST, PUT, PATCH, or DELETE** requests to make sure they include a valid CSRF token.

---

##  Adding CSRF Token to Forms

When you use Blade templates, always include the CSRF token using:

```blade
<form method="POST" action="/submit">
    @csrf
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>
````

Or manually (not recommended):

```blade
<input type="hidden" name="_token" value="{{ csrf_token() }}">
```

This ensures Laravel can validate the request came from your app.

---

##  CSRF Tokens in JavaScript (AJAX Requests)

If you're making AJAX calls, you need to include the CSRF token in the headers.

Laravel provides the token in the page's HTML with a `<meta>` tag:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### Example: Using Axios (recommended)

```js
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content');

// Example request
axios.post('/submit', {
    name: 'John Doe'
});
```

### Example: Using Fetch

```js
fetch('/submit', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ name: 'Jane Doe' })
});
```

---

##  Routes That Don't Need CSRF

If you want to **exclude specific routes** from CSRF protection (e.g., third-party webhooks), edit the following file:

```
app/Http/Middleware/VerifyCsrfToken.php
```

### Example: Skip CSRF for Webhook Route

```php
protected $except = [
    'payment/webhook',
    'api/skip-this-route',
];
```

Use this only if you're 100% sure that external services are safe and trusted.

---

##  What Happens If CSRF Fails?

If a user submits a form without a valid CSRF token, Laravel will block the request and return:

```
419 | Page Expired
```

This error means Laravel's CSRF verification failed.

Common causes:

* Missing `@csrf` in forms
* Token mismatch in JavaScript headers
* Expired session (e.g., user left page open too long)

---




