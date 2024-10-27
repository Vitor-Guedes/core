<span class="underline italix" id="response" 
    hx-trigger="load" hx-get="{{route('api.tasks.get')}}" hx-target="#tasks_list" hx-swap="innertHTML">
    {{$message}}
</span>