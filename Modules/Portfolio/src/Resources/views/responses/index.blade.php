<span class="underline italix" id="response" 
    hx-trigger="load" hx-get="{{route('api.tasks.get_last')}}" hx-target="#tasks_list" hx-swap="beforeend">
    {{$message}}
</span>