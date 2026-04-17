<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiInsight extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'user_id', 'assessment_result_id', 'evaluation_cycle_id',
        'insight_type', 'content', 'structured_data', 'confidence_score',
        'model_version', 'is_reviewed', 'reviewed_by_user_id', 'reviewed_at'
    ];

    protected function casts(): array
    {
        return [
            'structured_data' => 'array',
            'is_reviewed' => 'boolean',
            'reviewed_at' => 'datetime',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessmentResult(): BelongsTo
    {
        return $this->belongsTo(AssessmentResult::class);
    }

    public function evaluationCycle(): BelongsTo
    {
        return $this->belongsTo(EvaluationCycle::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }
}
