<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class KT9NotFound extends Exception
{
    private $errors;
    private $status;
    public function __construct($errors = "Not Found")
    {
        $this->errors = $errors;
        $this->status = Response::HTTP_NOT_FOUND;
    }

     /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Report at KT9NotFound');
    }

    public function render($request)
    {
        return response()->json([
            'errors' => $this->errors,
            'status' => $this->status,
        ]);
    }
}
