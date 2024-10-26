<div class="w-full flex flex-row justify-between @if (hideHeaderOptions() && !isset($error)) hide @endif" id="header-options">
    <!-- create btn -->
    <button class="bg-purple-600 hover:bg-purple-500 p-2 text-white rounded" 
        type="button"
        hx-get="{{route('web.tasks.create')}}"
        hx-target="#tasks_container"
        hx-swap="innerHTML"
        hx-trigger="click throttle:2s"
        hx-on::before-request="skeletonSwap()"
        hx-select="#tasks_container"
        hx-push-url="true"
        hx-on::after-request="document.title = 'Nova Tarefa';"
        hx-on:click="toggleClass(document.querySelector('#header-options'), 'hide')"
    >
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
        </svg>
    </button>
    <!-- filter -->
    <div>
        <input class="py-2 px-5 border rounded-lg" 
            type="text" 
            name="filter" 
            id="filter" 
            placeholder="Filtrar"
            hx-post="{{route('api.tasks.filter')}}"
            hx-trigger='keyup[!(["Control", "Alt", "Shift", "AltGraph", "ArrowRight", "ArrowLeft", "ArrowDown", "ArrowUp", "CapsLock", "Tab"].includes(key))&&!(ctrlKey&&(new RegExp("\w")).test(key))] delay:1s, throttle:2s'
            hx-on::before-request="skeletonSwap()"
            hx-target="#tasks_container"
            hx-swap="innerHTML"
        >
    </div>
</div>
@php

\Illuminate\Support\Facades\Log::debug('hide:' . (int) hideHeaderOptions(), [request()->url()]);

@endphp