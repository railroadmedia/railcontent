<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Exception;

class UserFriendlyException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): ?bool
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response()->json([
            'friendlyMessage' => $this->getMessage()
        ], 500);
    }
}
