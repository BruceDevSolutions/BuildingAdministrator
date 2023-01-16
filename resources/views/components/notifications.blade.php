<div>
    @if(session()->has('notify-saved'))
        <button 
            type="button"
            class="fixed bottom-8 right-8 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition hover:bg-green-600"
            x-data="{ open: true}"
            x-init="
                setTimeout(() => { open = false}, 3500);
                setTimeout(() => { $refs.successNotification.remove() }, 3800)
                "
            x-show="open"
            x-ref="successNotification"
            x-transition.duration.300ms 
        >
            <div class="flex items-center space-x-2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                
                <p class="font-semibold">{{-- {{ session()->get('notify-saved') }} --}}Holanda</p>
            </div>
        </button>
    @endif
</div>