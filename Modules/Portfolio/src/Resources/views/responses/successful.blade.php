<div id="request_response" 
    class="absolute py-2 px-5 rounded-full top-5 right-5 bg-green-200 text-green-900"
    hx-get="{{route('api.tasks.get')}}" 
    hx-trigger="load delay:1s"
    hx-target="#tasks_container" 
    hx-swap="innerHTML"
    hx-push-url="{{route('web.portfolio.index')}}"
    hx-on::load="setTimeout(() => { document.querySelector('#request_response').classList.toggle('invisible') }, 3000)"
    >
    <span id="request_response_fail">{{$message}}</span>
</div>