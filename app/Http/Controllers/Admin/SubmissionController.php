<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FormService;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    protected $submissionService;
    protected $formService;
    public function __construct(SubmissionService $submissionService , FormService $formService)
    {
        $this->submissionService = $submissionService;
        $this->formService = $formService;
    }
    public function index(Request $request)
    {
        $data = $this->submissionService->getSubmissions($request->all);

        return view('admin.submissions.index', compact('data'));
    }
    
    public function create()
    {
        $forms = $this->formService->getForms();
        return view('admin.submissions.create', compact('forms'));
    }
    public function store(Request $request)
    {
        $this->submissionService->submit($request->form_id, $request->input('data', []));
        return back()->with('success','Submitted');
    }

    public function destroy($id)
    {
        $destroy = $this->submissionService->destroy($id);
        return back()->with('success','Deleted');
    }
    
}