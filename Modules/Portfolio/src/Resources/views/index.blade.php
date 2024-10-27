<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Portfolio - Tarefas')</title>

    <style>
        .hide {
            display: none !important;
        }
    </style>

    <script src="{{ asset('/js/htmx.js') }}"></script>
    <script src="{{ asset('/js/tailwind.js') }}"></script>

    <script defer>
        skeletonSwap = (title = 'Portfolio') => {
            document.title = title;

            const container = document.querySelector('#tasks_container');
            const skeleton = document.querySelector('#skeleton');
            const clone = skeleton.cloneNode(true);
            
            const swap = container.querySelector('*[swap]') || false;
            if (swap) {
                swap.replaceWith(clone); 
                clone.classList.remove('htmx-indicator');
            }

            document.querySelector('#filter').value = '';
        }

        toggleClass = (element, className) => {
            element.classList.toggle(className);
        }

        addMassive = (element) => {
            const action = document.querySelector('#action');
            var massElements = action.getAttribute('hx-include');
            var include = `[name='${element.name}']`;

            if (element.checked) {
                // incluir
                massElements = ! massElements ? [] : massElements.split(','); 
                massElements.push(include);
            } else {
                // remover
                massElements = massElements.split(',');
                massElements.splice(massElements.indexOf(include), 1);
            }
            massElements = massElements.join(',');
            action.setAttribute('hx-include', massElements);
        }

        function massAction (element) {
            const includes = element.getAttribute('hx-include') || '';
            if (element.value == 'destroy' && includes.length > 0) {
                element.setAttribute('hx-confirm', 'Tem certeza que deseja deletar todas as tasks selecionadas?')
                htmx.trigger('#'+element.id, 'mass-action');
            } else if (element.value == 'destroy' && includes.length < 1) {
                alert('Nenhuma task selectionada para a ação.');
            }
        }
    </script>
</head>
<body>

    <div class="container mx-auto mt-5">
        <div class="flex flex-col gap-2.5">

            @section('header-options')
                @include('portfolio::header-options')
            @show

            @section('container')
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