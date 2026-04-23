<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['form_id'];

    public function values()
    {
        return $this->hasMany(SubmissionValue::class, 'submission_id');
    }
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
