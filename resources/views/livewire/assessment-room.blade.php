<?php

use Livewire\Volt\Component;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Response as UserResponse;
use App\Models\Competency;
use App\Services\AIService;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public ?Assessment $assessment = null;
    public ?Question $currentQuestion = null;
    public string $userResponse = '';
    public bool $isProcessing = false;
    public array $history = [];
    public int $progress = 0;

    public function mount()
    {
        $this->assessment = Auth::user()->assessments()->where('status', 'ongoing')->first();

        if (!$this->assessment) {
            $this->startNewAssessment();
        } else {
            $this->loadCurrentState();
        }
    }

    public function startNewAssessment()
    {
        $this->assessment = Assessment::create([
            'user_id' => Auth::id(),
            'status' => 'ongoing',
        ]);

        $this->generateNextQuestion();
    }

    public function loadCurrentState()
    {
        $this->currentQuestion = $this->assessment->questions()->whereDoesntHave('response')->latest()->first();
        
        if (!$this->currentQuestion) {
            $this->generateNextQuestion();
        }

        $this->updateState();
    }

    public function generateNextQuestion()
    {
        $this->isProcessing = true;
        
        $competency = Competency::inRandomOrder()->first();
        $context = $this->assessment->questions()->with('response')->get()->map(fn($q) => $q->response?->response_text)->filter()->toArray();

        $aiService = resolve(AIService::class);
        $questionText = $aiService->generateQuestion($competency->name, $context);

        if ($questionText) {
            $this->currentQuestion = Question::create([
                'assessment_id' => $this->assessment->id,
                'competency_id' => $competency->id,
                'question_text' => $questionText,
            ]);
        } else {
            session()->flash('error', 'Intelligence offline. Check API configuration.');
        }

        $this->isProcessing = false;
        $this->updateState();
    }

    public function submitResponse()
    {
        if (empty($this->userResponse)) return;

        $this->isProcessing = true;

        UserResponse::create([
            'question_id' => $this->currentQuestion->id,
            'response_text' => $this->userResponse,
        ]);

        $this->userResponse = '';
        
        if ($this->assessment->questions()->count() >= 5) {
            $this->finishAssessment();
        } else {
            $this->generateNextQuestion();
        }
    }

    public function finishAssessment()
    {
        $this->assessment->update(['status' => 'completed']);
        return redirect()->route('dashboard')->with('status', 'Assessment data integrated successfully.');
    }

    public function updateState()
    {
        $this->history = $this->assessment->questions()
            ->with(['response', 'competency'])
            ->get()
            ->toArray();
            
        $this->progress = ($this->assessment->questions()->count() / 5) * 100;
    }
}; ?>

<div class="flex h-[calc(100vh-160px)] gap-6">
    <!-- Main Evaluation Chamber -->
    <div class="flex-1 flex flex-col glass-card !p-0 overflow-hidden relative border-slate-200 shadow-xl bg-white rounded-3xl">
        <!-- Chamber Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse shadow-sm"></div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Neural Evaluation Room</h2>
                    <p class="text-[10px] font-bold text-slate-500 flex items-center gap-1 mt-1">
                        <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        AI ENGINE: GEMINI FLASH 1.5
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <span class="text-[10px] font-bold text-blue-600 mb-1 uppercase tracking-widest">Chamber Stability: 98.2%</span>
                <div class="w-32 bg-slate-200 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-full w-[98.2%]"></div>
                </div>
            </div>
        </div>

        <!-- Dialogue Feed -->
        <div id="dialogue-feed" class="flex-1 overflow-y-auto p-8 space-y-8 custom-scrollbar scroll-smooth">
            @foreach($history as $q)
                <!-- AI Question -->
                <div class="flex items-start gap-4 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="space-y-1 max-w-[80%]">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">{{ $q['competency']['name'] }}</span>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">AI ANALYST</span>
                        </div>
                        <div class="p-5 rounded-2xl rounded-tl-none bg-slate-50 border border-slate-100 shadow-sm text-slate-700 leading-relaxed font-medium text-sm">
                            {{ $q['question_text'] }}
                        </div>
                    </div>
                </div>

                <!-- User Response -->
                @if($q['response'])
                    <div class="flex flex-row-reverse items-start gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                            <span class="text-sm font-bold text-slate-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="space-y-1 max-w-[80%] flex flex-col items-end">
                            <div class="flex flex-row-reverse items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ Auth::user()->name }}</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">RESPONDENT</span>
                            </div>
                            <div class="p-5 rounded-2xl rounded-tr-none bg-blue-600 text-white shadow-md leading-relaxed font-medium text-sm">
                                {{ $q['response']['response_text'] }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($isProcessing)
                <div class="flex items-start gap-4 animate-in fade-in slide-in-from-bottom-2 duration-500">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 shadow-sm animate-pulse">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest">Processing Neural Data</span>
                        </div>
                        <div class="flex gap-1.5 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce [animation-delay:0.2s]"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce [animation-delay:0.4s]"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Active Input Zone -->
        <div class="p-8 border-t border-slate-100 bg-slate-50 rounded-b-3xl">
            @if($currentQuestion && !$isProcessing)
                <div class="relative group max-w-4xl mx-auto">
                    <textarea 
                        wire:model="userResponse"
                        wire:keydown.enter.prevent="submitResponse"
                        placeholder="Construct your strategic response..."
                        class="w-full bg-white border border-slate-200 rounded-2xl p-6 pr-20 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all duration-300 resize-none min-h-[120px] shadow-sm text-slate-800 font-medium text-sm leading-relaxed"
                    ></textarea>
                    <button 
                        wire:click="submitResponse"
                        class="absolute right-4 bottom-4 p-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all shadow-md hover:scale-105 active:scale-95 group"
                    >
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 12h15"/></svg>
                    </button>
                    <div class="flex items-center justify-between mt-3 px-2">
                        <div class="flex items-center gap-4 text-[10px] font-bold text-slate-400">
                            <span class="flex items-center gap-1"><kbd class="bg-white px-1.5 py-0.5 rounded border border-slate-200 shadow-sm text-slate-500">ENTER</kbd> TO TRANSMIT</span>
                            <span class="flex items-center gap-1"><kbd class="bg-white px-1.5 py-0.5 rounded border border-slate-200 shadow-sm text-slate-500">CMD + S</kbd> SAVE DRAFT</span>
                        </div>
                        <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Current Level: <span class="text-blue-600 font-bold">Strategic Leadership</span></div>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-8 text-slate-400 space-y-4">
                    <div class="w-12 h-12 rounded-full border-4 border-slate-200 border-t-blue-500 animate-spin"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Synchronizing Neural Patterns...</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Right Intelligence Panel -->
    <div class="w-80 flex flex-col gap-6 shrink-0">
        <!-- Progress Module -->
        <div class="glass-card bg-white border border-slate-200 shadow-sm rounded-3xl p-6">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-6 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Assessment Status
            </h3>
            <div class="space-y-6">
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase">Current Tier</p>
                        <p class="text-sm font-black text-blue-600 uppercase">Standard MQ-1</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-500 uppercase">Completion</p>
                        <p class="text-sm font-black text-slate-900">{{ $progress }}%</p>
                    </div>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden shadow-inner">
                    <div class="bg-blue-500 h-full rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="h-1 rounded-full {{ count($history) >= $i ? 'bg-blue-500' : 'bg-slate-200' }}"></div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Live KPI Analyzer -->
        <div class="glass-card flex-1 flex flex-col bg-white border border-slate-200 shadow-sm rounded-3xl p-6">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-6">Real-time KPI Tracking</h3>
            <div class="flex-1 space-y-4">
                @foreach(['Decision Making', 'Leadership', 'Discipline', 'Communication', 'Innovation'] as $kpi)
                    <div class="space-y-2 group">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-600 group-hover:text-blue-600 transition-colors uppercase">{{ $kpi }}</span>
                            @if($currentQuestion && $currentQuestion->competency->name === $kpi)
                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-600 border border-blue-100 !text-[8px] font-bold uppercase animate-pulse tracking-widest">Scanning</span>
                            @else
                                <span class="text-[10px] font-bold text-slate-300 tracking-widest">WAITING</span>
                            @endif
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full w-0 group-hover:w-[15%] transition-all duration-500 opacity-20"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8 p-4 bg-slate-50 rounded-2xl border border-slate-100 text-center">
                <p class="text-[10px] font-medium text-slate-500 leading-relaxed">
                    AI is currently mapping your responses to the <span class="font-bold text-slate-700">Managerial Competency Matrix</span>.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const dialogueFeed = document.getElementById('dialogue-feed');
        
        Livewire.on('scroll-to-bottom', () => {
            setTimeout(() => {
                dialogueFeed.scrollTop = dialogueFeed.scrollHeight;
            }, 100);
        });

        // Auto scroll when content changes
        const observer = new MutationObserver(() => {
            dialogueFeed.scrollTop = dialogueFeed.scrollHeight;
        });

        observer.observe(dialogueFeed, { childList: true, subtree: true });
    });
</script>
