<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Modules\Core\HTTPResponseCodes;
use App\Modules\Student\StudentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    private StudentService $service;
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        try {
            $data = $this->service->getAll();
            return new Response(
                $data,
                HTTPResponseCodes::Success['code']
            );
        } catch (\Exception $e) {
            return  new Response(
                [
                    'exception' => get_class($e),
                    'error' => $e->getMessage()
                ],
                HTTPResponseCodes::BadRequest['code']
            );
        }
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function get($student):Response
    
    {
        try {
            $data = $this->service->get($student)->toArray();
            return new Response(
                $data,
                HTTPResponseCodes::Success['code']
            );
        } catch (\Exception $e) {
            return  new Response(
                [
                    'exception' => get_class($e),
                    'error' => $e->getMessage()
                ],
                HTTPResponseCodes::BadRequest['code']
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): Response
    {
        try {
            $dataArray = ($request->toArray() !== [])
                ? $request->toArray()
                : $request->json()->all();

            return new Response(
                $this->service->update($dataArray)->toArray(),
                HTTPResponseCodes::Success["code"]
            );
        } catch (\Exception $error) {
            return new Response(
                [
                    "exception" => get_class($error),
                    "errors" => $error->getMessage()
                ],
                HTTPResponseCodes::BadRequest["code"]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(int $id): Response
{
    try {
        $this->service->softDelete($id);
        return  new Response([
            'message' => 'Student soft deleted successfully.'
        ], HTTPResponseCodes::Success['code']);
    } catch (\Exception $e) {
        return  new Response([
            'exception' => get_class($e),
            'error' => $e->getMessage()
        ], HTTPResponseCodes::BadRequest['code']);
    }
}

public function restore(int $id):Response
{
    try {
        $this->service->restore($id);
        return  new Response([
            'message' => 'Student restored successfully.'
        ], HTTPResponseCodes::Success['code']);
    } catch (\Exception $e) {
        return new Response([
            'exception' => get_class($e),
            'error' => $e->getMessage()
        ], HTTPResponseCodes::BadRequest['code']);
    }
}

public function forceDelete(int $id): Response
{
    try {
        $this->service->forceDelete($id);
        return new Response([
            'message' => 'Student permanently deleted successfully.'
        ], HTTPResponseCodes::Success['code']);
    } catch (\Exception $e) {
        return new Response([
            'exception' => get_class($e),
            'error' => $e->getMessage()
        ], HTTPResponseCodes::BadRequest['code']);
    }
}

}
