<tr class="" id="task_{{$task->id}}">
    <td class="py-3">{{$task->id}}</td>
    <td class="py-3">{{$task->title}}</td>
    <td class="py-3">
        <div class="flex justify-center gap-2.5">
            <!-- delete button icon -->
            <button hx-delete="{{route('api.tasks.delete', ['id' => $task->id])}}" 
                hx-confirm="Tem certeza que deseja deletar essa task?" 
                hx-target="#request_response" 
                hx-swap="outerHTML"
                hx-on::before-request="skeletonSwap()"
            >
                <svg class="w-6 h-6 text-red-800 dark:text-red" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
            </button>

            <!-- edit button icon -->
            <button hx-get="{{route('web.tasks.edit', ['id' => $task->id])}}"
                hx-target="#tasks_container"
                hx-swap="innerHTML"
                hx-on::before-request="skeletonSwap()"
                hx-on::after-request="document.title = 'Editar #{{$task->id}}'"
                hx-push-url="true"
                hx-select="#tasks_container"
            >
                <svg class="w-6 h-6 text-gray-800 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                </svg>
            </button>
        </div>
    </td>
</tr>