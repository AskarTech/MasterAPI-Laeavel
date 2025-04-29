<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Modules\Courses\CourseService;
use App\Modules\Core\HTTPResponseCodes;
use App\Modules\StudentsCoursesEnrollments\StudentsCoursesEnrollmentService;

class StudentsCoursesEnrollmentController extends Controller
{
    private StudentsCoursesEnrollmentService $service;
    public function __construct(StudentsCoursesEnrollmentService $service)
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
    public function get($Course):Response
    
    {
        try {
            $data = $this->service->get($Course)->toArray();
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
            'message' => 'Course soft deleted successfully.'
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
            'message' => 'Course restored successfully.'
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
            'message' => 'Course permanently deleted successfully.'
        ], HTTPResponseCodes::Success['code']);
    } catch (\Exception $e) {
        return new Response([
            'exception' => get_class($e),
            'error' => $e->getMessage()
        ], HTTPResponseCodes::BadRequest['code']);
    }
}

}
