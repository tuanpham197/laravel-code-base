<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class WebController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
} 