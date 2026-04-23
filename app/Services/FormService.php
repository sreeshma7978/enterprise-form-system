<?php

namespace App\Services;

use App\Models\Form;
use App\Models\FormField;

use function Laravel\Prompts\info;

class FormService
{
    public function createForm(array $data)
    {

        $form = Form::create([
            'title' => $data['title'],
            'status' => $data['status'] ?? true
        ]);
    
        if (!empty($data['fields'])) {
            $fields = json_decode($data['fields'], true);

            foreach ($fields as $index => $field) {
    
                $options = array_values(array_filter($field['options'] ?? [], function ($opt) {
                    return trim($opt) !== '';
                }));
    
                FormField::create([
                    'form_id' => $form->id,
                    'label' => $field['label'],
                    'type' => $field['type'],
                    'required' => $field['required'] ?? false,
                    'options' => json_encode($options),
                    'order' => $index
                ]);
            }
        }
    
        return $form;
    }
    public function getForms()
    {
        return Form::with('fields')->latest()->get();
    }

    public function getFields($id)
    {
        return FormField::where('form_id', $id)->orderBy('order')->get();
    }
}