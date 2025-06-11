# Todo List - Porto Architecture Example

This is a complete Todo list implementation following the **Porto architectural pattern** with Laravel 11 and PHP 8.2.

## Architecture Overview

### Container Structure: `app/Containers/Todo/`

```
Todo/
├── Actions/               # Orchestrate business logic
│   ├── CreateTodoAction.php
│   ├── GetAllTodosAction.php
│   └── ToggleTodoStatusAction.php
├── Tasks/                 # Atomic business operations
│   ├── CreateTodoTask.php
│   ├── GetAllTodosTask.php
│   └── ToggleTodoStatusTask.php
├── Models/                # Database entities
│   └── Todo.php
├── Enums/                 # Type-safe constants
│   └── TodoStatusEnum.php
├── Data/
│   ├── Migrations/        # Database migrations
│   │   └── 2024_01_01_000001_create_todos_table.php
│   └── Factories/         # Test data factories
│       └── TodoFactory.php
├── UI/
│   └── API/
│       ├── Controllers/   # HTTP request handlers
│       │   └── TodoController.php
│       ├── Requests/      # Form validation
│       │   └── CreateTodoRequest.php
│       └── Routes/        # API routes
│           └── todos.php
└── Providers/             # Container service registration
    └── TodoServiceProvider.php
```

### Ship Structure: `app/Ship/`

```
Ship/
├── Parents/               # Base classes for all containers
│   ├── Actions/
│   │   └── Action.php
│   ├── Controllers/
│   │   └── ApiController.php
│   ├── Models/
│   │   └── Model.php
│   ├── Requests/
│   │   └── Request.php
│   ├── Tasks/
│   │   └── Task.php
│   └── Providers/
│       └── MainServiceProvider.php
└── Exceptions/            # Shared exceptions
    ├── CreateResourceFailedException.php
    └── NotFoundException.php
```

## Key Features

### PHP 8.2 Features Used
- **Strict typing**: `declare(strict_types=1);` in all files
- **Enums**: Type-safe todo status enumeration
- **Constructor property promotion**: Simplified dependency injection
- **Union types**: Flexible parameter typing
- **Readonly properties**: Immutable class dependencies

### Laravel 11 Features
- **Eloquent ORM**: Modern model relationships and scopes
- **Form Requests**: Centralized validation
- **Service Providers**: Modular component registration
- **Factory Pattern**: Test data generation

### Porto Patterns
- **Single Responsibility**: Each class has one reason to change
- **Dependency Injection**: Constructor-based service resolution
- **Method Chaining**: Fluent task configuration
- **Atomic Tasks**: Single `run()` method operations

## API Endpoints

### Get All Todos
```http
GET /api/v1/todos
GET /api/v1/todos?completed=true
GET /api/v1/todos?completed=false
```

### Create Todo
```http
POST /api/v1/todos
Content-Type: application/json

{
    "title": "Learn Porto Architecture",
    "description": "Study the Porto pattern implementation"
}
```

### Toggle Todo Status
```http
PATCH /api/v1/todos/{id}/toggle
```

## Usage Examples

### Creating a Todo
```php
$action = new CreateTodoAction(new CreateTodoTask());
$todo = $action->run([
    'title' => 'Learn Porto Architecture',
    'description' => 'Study the implementation patterns'
]);
```

### Retrieving Todos
```php
$action = new GetAllTodosAction(new GetAllTodosTask());

// Get all todos
$todos = $action->run();

// Get only completed todos
$completed = $action->run(completed: true);

// Get only incomplete todos
$incomplete = $action->run(completed: false);
```

### Using Enums
```php
use App\Containers\Todo\Enums\TodoStatusEnum;

$status = TodoStatusEnum::COMPLETED;
echo $status->getLabel(); // "Completed"
echo $status->isCompleted(); // true
```

### Factory Usage
```php
// Create test todos
$incompleteTodo = Todo::factory()->incomplete()->create();
$completedTodo = Todo::factory()->completed()->create();
```

## Database Migration

Run the migration to create the todos table:

```bash
php artisan migrate
```

## Testing

The architecture supports easy testing with factories:

```php
// In your tests
$todo = Todo::factory()->create([
    'title' => 'Test Todo',
    'is_completed' => false
]);

$completedTodos = Todo::factory()->completed()->count(5)->create();
```

## Benefits of This Architecture

1. **Maintainability**: Clear separation of concerns
2. **Testability**: Each component can be tested in isolation
3. **Scalability**: Easy to add new features without affecting existing code
4. **Type Safety**: PHP 8.2 strict typing prevents common errors
5. **Consistency**: Standardized patterns across all containers
6. **Reusability**: Ship components can be shared across containers

This example demonstrates how Porto architecture promotes clean, maintainable, and scalable Laravel applications. 