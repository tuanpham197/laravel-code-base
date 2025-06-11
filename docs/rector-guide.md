# Rector Configuration Guide

This guide explains how to use Rector for automated code refactoring and quality improvements in our Porto architecture Laravel project.

## What is Rector?

Rector is a tool for automated refactoring of PHP code. It can:
- Upgrade your code to newer PHP versions
- Improve code quality and readability
- Apply best practices automatically
- Fix deprecated patterns
- Modernize Laravel code

## Installation

Rector is already installed in this project. You can verify by running:

```bash
composer show rector/rector
```

## Available Commands

### Local Development

```bash
# Check what Rector would change (dry run)
composer rector:check

# Apply Rector refactoring
composer rector:fix

# Run all quality checks (Rector + Pint + PHPStan)
composer quality

# Run all quality fixes
composer quality:fix

# Direct Rector commands
vendor/bin/rector process --dry-run  # Check only
vendor/bin/rector process            # Apply changes
```

### CI/CD Integration

We have configured two CI workflows for Rector:

#### 1. Standalone Rector Workflow (`.github/workflows/rector.yml`)

- **Triggers**: Push to main/develop, PRs, weekly schedule, manual
- **Behavior**:
  - On PRs: Fails if Rector changes are needed
  - On push to main/develop: Auto-commits fixes
  - Weekly: Checks for new rules to apply

#### 2. Integrated Code Quality Workflow (`.github/workflows/lint-with-rector.yml`)

- **Triggers**: Push and PRs to main/develop
- **Includes**: Rector + Pint + PHPStan + Frontend linting
- **Behavior**: Checks only (no auto-fixes)

## Configuration

### Current Rector Rules (`rector.php`)

```php
// PHP version target
->withPhpSets(php82: true)

// Quality levels
->withTypeCoverageLevel(1)
->withDeadCodeLevel(1) 
->withCodingStyleLevel(1)
->withCodeQualityLevel(1)

// Laravel-specific rules
- OptionalToNullsafeOperatorRector
- ValidationRuleArrayStringValueToArrayRector
- ReverseConditionableMethodCallRector

// PHP modernization
- ClassPropertyAssignToConstructorPromotionRector
- AddVoidReturnTypeWhereNoReturnRector
- TypedPropertyFromStrictConstructorRector
```

### Paths Analyzed

```
app/                # Porto containers and Ship
bootstrap/          # Laravel bootstrap
config/             # Configuration files
public/             # Public assets
resources/          # Views and assets
routes/             # Route definitions
tests/              # Test files
```

## Porto Architecture Considerations

### What Rector Helps With

1. **Constructor Property Promotion**: Automatically converts properties to constructor promotion
   ```php
   // Before
   public function __construct(CreateTodoTask $task) {
       $this->task = $task;
   }
   
   // After
   public function __construct(
       private readonly CreateTodoTask $task
   ) {}
   ```

2. **Void Return Types**: Adds void return types where appropriate
   ```php
   // Before
   public function boot() {
       // ...
   }
   
   // After
   public function boot(): void {
       // ...
   }
   ```

3. **Typed Properties**: Adds type declarations to properties
   ```php
   // Before
   private $completed = null;
   
   // After
   private ?bool $completed = null;
   ```

### What to Watch For

1. **ReadOnly Classes**: Currently disabled as it might break Laravel features
2. **Action/Task Interfaces**: Rector respects your abstract classes in Ship layer
3. **Service Provider Registration**: Won't break Laravel's service container

## Best Practices

### Development Workflow

1. **Before committing**:
   ```bash
   composer quality:fix
   ```

2. **Before creating PR**:
   ```bash
   composer quality
   ```

3. **Regular maintenance**:
   ```bash
   # Weekly check for new improvements
   composer rector:check
   ```

### CI/CD Strategy

#### Option A: Strict Checks (Recommended for teams)
- Use the integrated quality workflow
- Require all checks to pass before merge
- Developers fix issues locally

#### Option B: Auto-fix (Good for solo projects)
- Enable auto-fix sections in workflows
- Automatically commit improvements
- Review changes in subsequent commits

## Troubleshooting

### Common Issues

1. **Rector changes fail tests**:
   ```bash
   composer rector:check  # See what would change
   vendor/bin/rector process app/specific/file.php  # Apply selectively
   ```

2. **Memory issues with large codebases**:
   ```bash
   php -d memory_limit=2G vendor/bin/rector process
   ```

3. **Skip specific files**:
   ```php
   // In rector.php
   ->withSkip([
       __DIR__ . '/app/Legacy',
       SomeSpecificRector::class => [
           __DIR__ . '/app/Containers/Todo/Models/Todo.php'
       ]
   ])
   ```

### Performance Tips

1. **Rector handles caching automatically**:
   ```bash
   # Rector automatically manages its cache in newer versions
   vendor/bin/rector process
   ```

2. **Process specific paths**:
   ```bash
   vendor/bin/rector process app/Containers/Todo
   ```

3. **Use parallel processing** (if available):
   ```bash
   # Check if your Rector version supports parallel processing
   vendor/bin/rector process --help | grep parallel
   vendor/bin/rector process --parallel  # If supported
   ```

## Rector Rules for Porto Architecture

### Recommended Additional Rules

You can add these to `rector.php` for even better Porto compliance:

```php
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedMethodRector;
use Rector\Privatization\Rector\ClassMethod\PrivatizeLocalOnlyMethodRector;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

->withRules([
    // Remove unused methods (good for Tasks/Actions)
    RemoveUnusedMethodRector::class,
    
    // Make methods private when only used locally
    PrivatizeLocalOnlyMethodRector::class,
    
    // Stricter empty checks
    DisallowedEmptyRuleFixerRector::class,
])
```

## Integration with Other Tools

### With Laravel Pint
```bash
# Run both in sequence
composer rector:fix && vendor/bin/pint
```

### With PHPStan
```bash
# Rector can help fix PHPStan issues
composer rector:fix && vendor/bin/phpstan analyse
```

### With IDE
Many IDEs support Rector integration:
- **PhpStorm**: Install Rector plugin
- **VS Code**: Use PHP extensions that support Rector

This configuration ensures your Porto architecture Laravel project maintains high code quality while automatically applying modern PHP patterns and Laravel best practices. 