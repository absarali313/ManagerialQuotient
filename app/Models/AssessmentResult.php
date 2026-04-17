<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssessmentResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id', 'user_id', 'organization_id', 'evaluation_cycle_id', 
        'total_score', 'raw_score', 'benchmark_score', 'performance_band', 
        'ai_summary', 'ai_confidence'
    ];

    // ── Relationships ────────────────────────────────────────────────────────

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

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

    public function kpiScores(): HasMany
    {
        return $this->hasMany(ResultKpiScore::class);
    }

    public function performanceSnapshot(): HasOne
    {
        return $this->hasOne(PerformanceHistory::class);
    }

    public function triggeredAlerts(): HasMany
    {
        return $this->hasMany(PerformanceAlert::class, 'triggered_by_result_id');
    }

    public function aiInsights(): HasMany
    {
        return $this->hasMany(AiInsight::class);
    }
}
