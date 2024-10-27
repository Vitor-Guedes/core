<tr class="border-b border-purple-200" id="task_{{$task->id}}">
    <td>{{$task->id}}</td>
    <td>
        <input 
            class="p-1 border rounded-lg" 
            type="text" 
            name="title" 
            id="title"
            value="{{$task->title}}"
            onkeyup="this.setCustomValidity('')"
            hx-on:htmx:validation:validate="if (this.value == '') {
                this.setCustomValidity('Titulo é obrigatório');
                htmx.find('#task_form')
            }"
        >
    </td>
    <td>
        <div class="flex justify-center gap-2.5">
            <!-- update button -->
            <button class="bg-purple-600 hover:bg-purple-500 py-1 px-2 text-white rounded"
                hx-on:click="sendForm(event)"
            >
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                </svg>
            </button>
            <!-- back button -->
            <button class="bg-gray-500 hover:bg-gray-300 text-white py-1 px-2 rounded"
                hx-get="{{route('web.tasks.find', ['id' => $task->id])}}"
                hx-target="#task_{{$task->id}}"
                hx-swap="outerHTML"
            >
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9h13a5 5 0 0 1 0 10H7M3 9l4-4M3 9l4 4"/>
                </svg>
            </button>
        </div>
    </td>
</tr>
