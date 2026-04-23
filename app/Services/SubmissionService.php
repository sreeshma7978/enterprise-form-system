<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Submission;
use App\Models\SubmissionValue;
use App\Events\FormSubmitted;
use Illuminate\Support\Facades\Request;

class SubmissionService
{
    public function submit($form_id, $data)
    {
        $form = Form::with('fields')->findOrFail($form_id);
    
        $rules = [];
    
        foreach ($form->fields as $field) {
            $rule = [];
    
            if ($field->required) $rule[] = 'required';
            if ($field->type == 'email') $rule[] = 'email';
            if ($field->type == 'number') $rule[] = 'numeric';
    
            $rules["$field->id"] = $rule;
        }
    
        // validator($data, $rules)->validate();
    
        $submission = Submission::create([
            'form_id' => $form_id
        ]);
    
        foreach ($data as $field_id => $value) {
    
            if (is_array($value)) {
                $value = implode(',', $value);
            }
    
            SubmissionValue::create([
                'submission_id' => $submission->id,
                'form_field_id' => $field_id, 
                'value' => $value
            ]);
        }
    
        return $submission;
    }
    public function getSubmissions($request = null)
    {
        $query = Submission::query()->with(['values', 'form']);

        if ($request && $request->filled('form_id')) {
            $query->where('form_id', $request->form_id);
        }

        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
    public function destroy($id)
    {
        return Submission::findOrFail($id)->delete();
    }
}