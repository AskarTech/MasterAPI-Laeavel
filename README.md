# MasterAPI---Laeavel
# API Master Project – Modular Laravel Clean Architecture

## 📚 Overview

This Laravel API project follows a **modular, scalable, and maintainable structure** that cleanly separates application concerns using:

- ✅ Repository Pattern
- ✅ Service Layer
- ✅ Validation Layer
- ✅ Mapper Classes
- ✅ Modules-Based Organization

This architecture improves testing, readability, and reusability across the application.

---

## 🗂 Folder Structure
app/ 
├── Http/ 
│ ├── Controlles/ 


app/ 
├── Modules/ 
│ ├── Common/ 
│ │ └── MyHelpers.php 
│ ├── Core/ 
│ │ └── HTTPResponseCodes.php 
│ ├── Courses/ 
│ │ ├── Course.php 
│ │ ├── CourseMapper.php 
│ │ ├── CourseRepository.php 
│ │ ├── CourseService.php 
│ │ └── CourseValidator.php 
│ ├── Student/ 
│ │ ├── Student.php 
│ │ ├── StudentMapper.php 
│ │ ├── StudentRepository.php 
│ │ ├── StudentService.php 
│ │ └── StudentValidator.php 

---

## 📦 Module Structure

Each module (e.g., `Student`, `Sanctum`, `Courses`) contains:

- **Entity Class**: The domain model (e.g., `Student.php`)
- **Repository**: Handles raw DB queries or ORM interactions (`StudentRepository.php`)
- **Service**: Application logic, connects controller ↔ repository (`StudentService.php`)
- **Validator**: Validates incoming request data (`StudentValidator.php`)
- **Mapper**: Maps raw DB results to entity objects (`StudentMapper.php`)

---

## 🧠 Why This Architecture?

- ✅ **Separation of Concerns**: Clear division between data access, business logic, and validation.
- 🔁 **Reusable Components**: Common logic (e.g., validation, responses) centralized in Core/Common.
- 🧪 **Testability**: Services and repositories are easily testable using dependency injection.
- 🚀 **Scalability**: Easy to add new features or modules without affecting existing code.

---

## 🔄 Example Flow (Student Module)

1. **Controller** calls `StudentService`
2. `StudentService` validates request and calls `StudentRepository`
3. `StudentRepository` interacts with DB and returns data
4. `StudentMapper` maps result to a `Student` object
5. Data is returned as response

---

## 🛠 Custom Utilities

- `Core/HTTPResponseCodes.php`: Standard HTTP response codes used across all modules.
- `Common/MyHelpers.php`: Helper functions shared across modules.

---

## ✅ Technologies Used

- Laravel 11+
- Eloquent ORM
- DB Facade
- PSR-4 Autoloading
- Composer

---

## 📌 Future Enhancements

- Add OpenAPI (Swagger) documentation
- Integrate Laravel Permission or Roles module
- Add caching layer (e.g., Redis) in repositories

---

## 💡 Contribution

If you want to extend the architecture or add new modules, just follow the same folder structure and class naming conventions per module.

