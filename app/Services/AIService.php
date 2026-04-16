<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    /**
     * Generate a new assessment question based on competency and context.
     */
    public function generateQuestion(string $competency, array $context = []): ?string
    {
        $prompt = "You are a professional industrial psychologist and managerial assessor. 
        Generate a highly professional, open-ended situational judgment question to evaluate a manager's competency in: {$competency}.
        The question should be practical and relevant to a modern workspace.";

        if (!empty($context)) {
            $prevAnswers = implode("\n", $context);
            $prompt .= "\n\nBased on the following previous answers in this assessment, ensure this new question drills deeper or explores a related aspect:\n{$prevAnswers}";
        }

        $prompt .= "\n\nReturn ONLY the question text. No preamble.";

        return $this->callGemini($prompt);
    }

    /**
     * Analyze a response to a question.
     */
    public function analyzeResponse(string $question, string $response): array
    {
        $prompt = "Question: {$question}\nUser Response: {$response}\n\n
        As an industrial psychologist, analyze this response. 
        Evaluate:
        1. Logical reasoning.
        2. Depth of professional insight.
        3. Alignment with managerial best practices.
        
        Provide your analysis in JSON format with the following keys:
        - logic_score (1-10)
        - insight_score (1-10)
        - feedback (string)
        - follow_up_needed (boolean)";

        $result = $this->callGemini($prompt, true);
        
        return json_decode($result, true) ?? [];
    }

    /**
     * Call the Gemini API.
     */
    protected function callGemini(string $prompt, bool $isJson = false): ?string
    {
        if (!$this->apiKey) {
            Log::error('Gemini API key is missing.');
            return null;
        }

        try {
            $response = Http::post($this->baseUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => $isJson ? ['response_mime_type' => 'application/json'] : []
            ]);

            if ($response->successful()) {
                return $response->json('candidates.0.content.parts.0.text');
            }

            Log::error('Gemini API call failed', ['response' => $response->body()]);
        } catch (\Exception $e) {
            Log::error('Gemini API Exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}