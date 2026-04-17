<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceHistory extends Model
{
    use HasFactory;

    protected $table = 'performance_history';

    protected $fillable = [
        'user_id', 'organization_id', 'assessment_result_id', 'evaluation_cycle_id',
        'mq_score', 'score_delta', 'kpi_snapshot', 'trend', 'performance_band', 'recorded_on'
    ];

    protected function casts(): array
    {
        return [
            'kpi_snapshot' => 'array',
            'recorded_on' => 'date',
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

    public function assessmentResult(): BelongsTo
    {
        return $this->belongsTo(AssessmentResult::class);
    }

    public function evaluationCycle(): BelongsTo
    {
        return $this->belongsTo(EvaluationCycle::class);
    }
}
