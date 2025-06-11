<?php

declare(strict_types=1);

namespace App\Containers\Todo\UI\API\Controllers;

use App\Containers\Todo\Actions\CreateTodoAction;
use App\Containers\Todo\Actions\GetAllTodosAction;
use App\Containers\Todo\Actions\ToggleTodoStatusAction;
use App\Containers\Todo\UI\API\Requests\CreateTodoRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Todo API Controller
 *
 * Handles HTTP requests for Todo operations
 */
class TodoController extends ApiController
{
    public function __construct(
        private readonly CreateTodoAction $createTodoAction,
        private readonly GetAllTodosAction $getAllTodosAction,
        private readonly ToggleTodoStatusAction $toggleTodoStatusAction
    ) {}

    /**
     * Get all todos
     */
    public function index(Request $request): JsonResponse
    {
        $completed = $request->query('completed');
        $completedFilter = $completed !== null ? filter_var($completed, FILTER_VALIDATE_BOOLEAN) : null;

        $todos = $this->getAllTodosAction->run($completedFilter);

        return $this->success($todos->toArray(), 'Todos retrieved successfully');
    }

    /**
     * Create a new todo
     */
    public function store(CreateTodoRequest $request): JsonResponse
    {
        $todo = $this->createTodoAction
            ->fillProperties([
                'todo' => $request->validated(),
            ])
            ->run();

        return $this->created($todo->toArray(), 'Todo created successfully');
    }

    /**
     * Toggle todo completion status
     */
    public function toggle(int $id): JsonResponse
    {
        $todo = $this->toggleTodoStatusAction
            ->fillProperties(['todoId' => $id])
            ->run();

        return $this->success($todo->toArray(), 'Todo status updated successfully');
    }
}
