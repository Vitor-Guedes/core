<div id="request_response" 
    class="transition duration-300 ease-in-out absolute py-2 px-5 rounded-full top-5 right-5 bg-red-200 text-red-900"
    hx-on::load="setTimeout(() => { document.querySelector('#request_response').classList.toggle('invisible') }, 3000);"
    hx-trigger="load"
>
    <span id="request_response_fail">{{$message}}</span>
</div>