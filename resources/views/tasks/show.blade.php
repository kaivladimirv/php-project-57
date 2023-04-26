<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h2 class="mb-5">
                    {{ __('task.show-task') }}: {{ $task->name }}
                    @can('update', $task)<a href="{{ route('tasks.edit', $task) }}">⚙</a>@endcan
                </h2>

                <p>Имя: {{ $task->name }}</p>
                <p>Статус: {{ $task->status->name }}</p>
                <p>Описание: {{ $task->description }}</p>
            </div>
        </div>
    </section>
</x-app-layout>
