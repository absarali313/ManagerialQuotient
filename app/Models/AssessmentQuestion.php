<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id', 'kpi_id', 'question_text', 'question_type', 
        'options', 'max_score', 'order', 'is_ai_generated'
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_ai_generated' => 'boolean',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(Kpi::class);
    }

    public function answer(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class);
    }
}
