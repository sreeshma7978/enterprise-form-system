<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Services\FormService;
use Illuminate\Http\Request;

use function Laravel\Prompts\info;

class FormController extends Controller
{
    protected $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    public function index()
    {
        $forms = $this->formService->getForms();
        return view('admin.forms.index', compact('forms'));
    }

    // public function create()
    // {
    //     return view('admin.forms.create');
    // }

    public function store(Request $request)
    {
        $this->formService->createForm($request->all());

        return redirect()->route('admin.forms.index')
            ->with('success','Form created');
    }

    public function fields($id)
    {
        $fields = $this->formService->getFields($id);
        return $fields;
    }
   
}
