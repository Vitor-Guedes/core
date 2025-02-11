<table class="table-fixed w-full" id="tasks_list">
    <thead class="border-b border-gray-200">
        <tr>
            <th></th>
            <th>id</th>
            <th>Titulo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
            @include('task::tasks.row')
        @empty
            <tr class="py-2 colspan">
                <td colSpan={3}>Sem Resultados</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- pagination -->
@include('task::pagination')