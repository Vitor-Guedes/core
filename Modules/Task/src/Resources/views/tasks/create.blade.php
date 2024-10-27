@extends('task::index')

@section('container')
    <div id="tasks_container" class="w-full">
        <!-- form -->
        <form id="task_form"
            hx-post="{{route('api.tasks.store')}}" 
            hx-target="#request_response" 
            hx-swap="outerHTML"
            hx-on::before-request="skeletonSwap()"
            swap
        >
            <div class="container w-full flex">
                <div class="flex flex-col w-full">
                    <label for="title">
                        Titulo
                    </label>
                    <input 
                        class="py-2 px-5 border rounded-lg" 
                        type="text" 
                        name="title" 
                        id="title"
                        onkeyup="this.setCustomValidity('')"
                        hx-on:htmx:validation:validate="if (this.value == '') {
                            this.setCustomValidity('Titulo é obrigatório');
                            htmx.find('#task_form')
                        }"
                    >
                </div>
            </div>
            <div class="flex flex-row justify-between mt-5">
                <!-- save button -->
                <button id="btn-save" class="bg-purple-600 hover:bg-purple-500 py-2 px-5 text-white rounded"
                    hx-trigger="button"
                    hx-on:click="toggleClass(document.querySelector('#header-options'), 'hide')"
                >
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                    </svg>
                </button>
                <!-- back button -->
                <button class="bg-gray-500 hover:bg-gray-300 text-white py-2 px-5 rounded" 
                    hx-get="{{route('api.tasks.get')}}" 
                    hx-target="#tasks_container" 
                    hx-swap="innerHTML"
                    hx-on::before-request="skeletonSwap()"
                    hx-push-url="{{route('web.task.index')}}"
                    hx-on:click="toggleClass(document.querySelector('#header-options'), 'hide')"
                >
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9h13a5 5 0 0 1 0 10H7M3 9l4-4M3 9l4 4"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
@endsection