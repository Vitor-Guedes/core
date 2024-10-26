<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>

    <script src="{{ asset('/js/htmx.js') }}"></script>
    <script src="{{ asset('/js/tailwind.js') }}"></script>

    <script defer>
        skeletonSwap = (title = 'Portfolio') => {
            document.title = title;

            const container = document.querySelector('#tasks_container');
            const skeleton = document.querySelector('#skeleton');
            const clone = skeleton.cloneNode(true);
            container.firstChild.replaceWith(clone); 
            clone.classList.remove('htmx-indicator');

            document.querySelector('#filter').value = '';
        }
    </script>
</head>
<body>

    <div class="container mx-auto mt-5">
        <div class="flex flex-col gap-2.5">

            @section('container')
                <div class="w-full flex flex-row justify-between">
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
                        hx-on::after-request="document.title = 'Nova Tarefa'"
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
                            hx-on:keyup="console.log(event)"
                        >
                    </div>
                </div>

                <div id="tasks_container" 
                    hx-get="{{route('api.tasks.get')}}" 
                    hx-swap="innerHTML" 
                    hx-trigger="load" 
                    class="w-full"
                    hx-push-url="{{route('web.portfolio.index')}}"
                >
                    <!-- skeleton -->
                    @include('portfolio::skeleton')
                </div>
            @show

        </div>
    </div>

    <!-- alerts -->
    <div @if (! isset($error)) 
            id="request_response" class="invisible"
        @else  
            hx-trigger="load"
            hx-post="{{route('web.portfolio.responses')}}"
            hx-include="[name='message'],[name='type']"
        @endif>
        @if (isset($error))
            <input type="hidden" id="type" name="type" value="fail">
            <input type="hidden" id="message" name="message" value="{{$error ?? ''}}">
        @endif
    </div>

    <!-- skeleton -->
    @include('portfolio::skeleton')

</div>
</body>
</html>