# 🔐 API Vault

**API Vault** is a lightweight Laravel utility for building clean, consistent, and chainable API responses with optional caching, callbacks, headers, and response customization.

It helps you avoid repetitive response logic and keeps your controllers clean and readable.

---

## ✨ Features

- Fluent method chaining for API responses  
- Optional caching support  
- Lazy data execution using callbacks (with or without caching)  
- Unified response structure  
- Custom headers & JSON options support  
- Clean and expressive syntax  

---

## 📦 Installation

```bash
composer require faresnassar09/api-vault
```

---

## 🚀 Usage Examples

### 1️⃣ Basic data response

```php
use FaresNassar\ApiVault\Formatter;

$formatter = new Formatter();

return $formatter
    ->message('Users Retrieved Successfully')
    ->data(User::all())
    ->code(200)
    ->send();
```

### 2️⃣ Using callback() with caching

```php
return $formatter
    ->message('Users Retrieved And Cached Successfully')
    ->cache('users_cache_key', 600)
    ->callback(fn () => User::where('id', '<', 10000)->get())
    ->code(200)
    ->send();
```

### 3️⃣ Using callback() without caching

```php
return $formatter
    ->message('Users Retrieved Successfully')
    ->callback(fn () => User::all()) // lazy evaluation, no caching
    ->code(200)
    ->send();
```

### 4️⃣ Sending additional meta data

```php
return $formatter
    ->message('Users Retrieved Successfully')
    ->data(User::all())
    ->additional([
        'cached' => false,
        'execution_time' => '12ms',
        'debug' => true
    ])
    ->send();
```

### 5️⃣ Custom headers and JSON options

```php
return $formatter
    ->message('Custom Response')
    ->data($data)
    ->headers([
        'X-App-Version' => '1.0.0'
    ])
    ->jsonOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    ->send();
```

---

## 🛠️ Available Methods

- `message()`      → Set response message  
- `data()`         → Set response data directly  
- `cache()`        → Enable caching (key, seconds)  
- `callback()`     → Lazy data execution (can be used with or without caching)  
- `code()`         → HTTP status code (default: 200)  
- `additional()`   → Set extra meta data  
- `headers()`      → Custom response headers  
- `jsonOptions()`  → Set JSON encoding options (int)  
- `send()`         → Return the final response  

---

## 📄 Example JSON Response

```json
{
  "success": true,
  "message": "Users Retrieved Successfully",
  "data": [
    {"id": 1, "name": "Fares Ahmed"},
    {"id": 2, "name": "Ali Mohamed"}
  ],

  "code": 200,
  "additional": {
    "cached": false,
    "execution_time": "12ms",
    "debug": true
  }
}
```

---

## 📄 License

MIT License

---

## 👨‍💻 Author

Fares Nassar  
GitHub: https://github.com/faresnassar09  

---

Built for clean APIs, not messy controllers 🚀
