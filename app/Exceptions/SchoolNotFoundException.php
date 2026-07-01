<?php

namespace App\Exceptions;

use Exception;

class SchoolNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(['message' => 'School not found.'], 404);
    }
}
