<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class KT9BadRequest extends Exception
{
    private $errors;
    private $status;
    
    public function __construct($errors = "BadRequest")
    {
        $this->errors = $errors;
        $this->status = Response::HTTP_BAD_REQUEST;
    }

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Report at KT9BadReqeust');
    }

    public function render($request)
    {
        return response()->json([
            'errors' => [
                [
                    $this->errors,
                ],
            ],
            'status' => $this->status,
        ]);
    }
}
