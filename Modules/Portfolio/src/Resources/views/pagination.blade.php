<div class="flex flex-row gap-2.5 justify-between">
    @if ($tasks->hasPages())
        <!-- previus -->
        <button rel="prev" class="p-2 text-white rounded @if (! $tasks->onFirstPage()) bg-purple-600 hover:bg-purple-500 @else bg-gray-600 hover:bg-gray-500 @endif"
            @if (! $tasks->onFirstPage())
                hx-get="{{$tasks->previousPageUrl()}}"
                hx-trigger="click"
                hx-target="#tasks_container"
            @else
                disabled="true"
                aria-disabled="true"
            @endif
        >
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </button>
        <!-- next -->
        <button rel="next" class="p-2 text-white rounded @if ($tasks->hasMorePages()) bg-purple-600 hover:bg-purple-500 @else bg-gray-600 hover:bg-gray-500 @endif"
            @if ($tasks->hasMorePages())  
                hx-get="{{$tasks->nextPageUrl()}}"
                hx-trigger="click"
                hx-target="#tasks_container"
            @else
                disabled="true"
                aria-disabled="true"
            @endif 
        >
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
        </button>
    @endif
</div>