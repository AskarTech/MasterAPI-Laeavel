# MasterAPI – Laravel
## API Master Project – Modular Laravel Clean Architecture

---

## 📚 Overview

This Laravel API project is designed with a **modular, scalable, and maintainable architecture** that cleanly separates application concerns. It leverages:

- ✅ Repository Pattern
- ✅ Service Layer
- ✅ Validation Layer
- ✅ Mapper Classes
- ✅ Modules-Based Organization

This structure enhances **testability**, **readability**, and **reusability** across the application.
> ⚡ Note: This project uses Laravel's DB Facade and Raw SQL for performance optimization.  
> However, it supports switching to Eloquent ORM if needed.


---

## 🗂 Folder Structure

```plaintext
app/
├── Http/
│   ├── Controllers/
├── Modules/
│   ├── Common/
│   │   └── MyHelpers.php
│   ├── Core/
│   │   └── HTTPResponseCodes.php
│   ├── Courses/
│   │   ├── Course.php
│   │   ├── CourseMapper.php
│   │   ├── CourseRepository.php
│   │   ├── CourseService.php
│   │   └── CourseValidator.php
│   ├── Student/
│   │   ├── Student.php
│   │   ├── StudentMapper.php
│   │   ├── StudentRepository.php
│   │   ├── StudentService.php
│   │   └── StudentValidator.php
```

---

## 📦 Module Structure

Each module (e.g., `Student`, `Courses`) contains:

- **Entity Class**: Represents the domain model (e.g., `Student.php`).
- **Repository**: Handles database interactions (`StudentRepository.php`).
- **Service**: Contains business logic and connects controllers to repositories (`StudentService.php`).
- **Validator**: Validates incoming request data (`StudentValidator.php`).
- **Mapper**: Maps raw database results to entity objects (`StudentMapper.php`).

---

## 🧠 Why This Architecture?

- ✅ **Separation of Concerns**: Clear division between data access, business logic, and validation.
- 🔁 **Reusable Components**: Centralized common logic (e.g., validation, responses) in `Core` and `Common`.
- 🧪 **Testability**: Services and repositories are easily testable using dependency injection.
- 🚀 **Scalability**: New features or modules can be added without affecting existing code.

---

## 🔄 Example Flow (Student Module)

1. **Controller** calls `StudentService`.
2. `StudentService` validates the request and calls `StudentRepository`.
3. `StudentRepository` interacts with the database and retrieves data.
4. `StudentMapper` maps the result to a `Student` object.
5. The data is returned as a response.

---

## 🛠 Custom Utilities

- **`Core/HTTPResponseCodes.php`**: Standard HTTP response codes used across all modules.
- **`Common/MyHelpers.php`**: Helper functions shared across modules.

---

## ✅ Technologies Used

- Laravel 11+
- Eloquent ORM
- DB Facade
- PSR-4 Autoloading
- Composer

---

## 📌 Future Enhancements

- Add OpenAPI (Swagger) documentation for API endpoints.
- Integrate a Laravel Permissions or Roles module for access control.
- Add a caching layer (e.g., Redis) in repositories to improve performance.
- Implement unit and feature tests for core modules.

---

## 💡 Contribution

To extend the architecture or add new modules, follow the same folder structure and class naming conventions for consistency.

---

## 🚀 Getting Started

Follow these steps to set up the project:

```bash
# Clone the repository
git clone https://github.com/your-username/MasterAPI.git

# Navigate to the project directory
cd MasterAPI

# Install dependencies
composer install

# Copy the environment file and generate the application key
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Start the development server
php artisan serve
```

---

## 📞 Support

For any issues or questions, feel free to open an issue on the repository or contact the maintainer.

---