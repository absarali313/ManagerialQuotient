<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'organization_id', 'evaluation_cycle_id', 'current_job_role_id',
        'target_job_role_id', 'readiness', 'score_at_evaluation', 'trend',
        'consistency_met', 'threshold_met', 'rule_results', 'is_ai_generated',
        'ai_reasoning', 'ai_confidence', 'hr_decision', 'reviewed_by_user_id',
        'reviewed_at', 'hr_notes'
    ];

    protected function casts(): array
    {
        return [
            'consistency_met' => 'boolean',
            'threshold_met' => 'boolean',
            'rule_results' => 'array',
            'is_ai_generated' => 'boolean',
            'reviewed_at' => 'datetime',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function evaluationCycle(): BelongsTo
    {
        return $this->belongsTo(EvaluationCycle::class);
    }

    public function currentJobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class, 'current_job_role_id');
    }

    public function targetJobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class, 'target_job_role_id');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }
}
