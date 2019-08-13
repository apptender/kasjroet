<?php

namespace App\Http\Controllers;

use Exception;
use InvalidArgumentException;


class EnumsController extends Controller
{
    public function show($enum)
    {

//throw new InvalidArgumentException();
        $classname = 'App\\Enums\\' . ucfirst($enum);
        if (!class_exists($classname)) {
          throw new InvalidArgumentException('This enum does not exist');
        }
        return response()->json($classname::values(), 200);
    }
}
