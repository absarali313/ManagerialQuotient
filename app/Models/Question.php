<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['assessment_id', 'competency_id', 'question_text', 'ai_context'];

    public function assessment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function competency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Competency::class);
    }

    public function response(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Response::class);
    }
}
