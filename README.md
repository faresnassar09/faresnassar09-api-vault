# 🚀 ApiVault

**ApiVault** is a fluent and expressive Laravel package designed to streamline API responses. It provides a clean, unified response structure, automatic pagination handling, and smart caching—all through an elegant **Method Chaining (Fluent) API**.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faresnassar09/api-vault.svg?style=flat-square)](https://packagist.org/packages/faresnassar09/api-vault)
[![Total Downloads](https://img.shields.io/packagist/dt/faresnassar09/api-vault.svg?style=flat-square)](https://packagist.org/packages/faresnassar09/api-vault)

---

## 🔥 Why ApiVault?

In professional Laravel applications (especially ERPs), managing consistent API responses can be repetitive. **ApiVault** solves this by:
- ✅ **Method Chaining:** A readable, developer-friendly way to build responses.
- ✅ **Auto-Pagination:** Detects Paginator instances and extracts meta-data automatically.
- ✅ **Smart Caching:** High-speed performance with page-aware caching (no more pagination conflicts).
- ✅ **Clean Architecture:** Keep your controllers slim and focused on logic.

## 🛠 Installation

You can install the package via composer:

```bash
composer require faresnassar09/api-vault

---
🚀 Usage Guide
1. Simple Data Response
You can quickly return a formatted response using the data() method. This is ideal for collections or simple arrays.

<p align="center"> <img src="docs/images/image1.png" alt="Simple Response Example" width="700"> </p>

2. Advanced Caching & Callbacks
For high-performance endpoints, use the cache() and callback() methods. This ensures your database isn't hit unnecessarily and handles pagination perfectly.

<p align="center"> <img src="docs/images/image1.png" alt="Cached Response Example" width="700"> </p>

⚙️ Detailed Chaining Options
📊 Standard Response Structure
Every response returns a consistent structure, making life easier for Frontend developers:

📞 Contact Me
Whether you have a suggestion, found a bug, or want to collaborate, feel free to reach out!

Name: Fares Nassar (ايرانور)

Role: Backend Laravel Developer

GitHub:

LinkedIn:

Email:

🤝 Contributing
Fork the Project.

Create your Feature Branch.

Commit your Changes.

Push to the Branch.

Open a Pull Request.

📜 License
Distributed under the MIT License. See LICENSE for more information.

Created with ❤️ by Fares Nassar


