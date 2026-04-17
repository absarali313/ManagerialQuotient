<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationCycle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'created_by_user_id', 'name', 'description', 
        'frequency', 'starts_at', 'ends_at', 'target_scope', 'target_scope_id', 
        'assessment_level', 'duration_minutes', 'due_days_after_start', 
        'status', 'auto_generate', 'assessments_generated', 'last_generated_at',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'auto_generate' => 'boolean',
            'assessments_generated' => 'integer',
            'last_generated_at' => 'datetime',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function assessmentResults(): HasMany
    {
        return $this->hasMany(AssessmentResult::class);
    }

    public function rankings(): HasMany
    {
        return $this->hasMany(EmployeeRanking::class);
    }

    public function promotionRecommendations(): HasMany
    {
        return $this->hasMany(PromotionRecommendation::class);
    }

    public function performanceHistory(): HasMany
    {
        return $this->hasMany(PerformanceHistory::class);
    }

    public function benchmarkReports(): HasMany
    {
        return $this->hasMany(BenchmarkReport::class);
    }

    public function aiInsights(): HasMany
    {
        return $this->hasMany(AiInsight::class);
    }
}
