<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            @include('flash::message')
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('Tasks') }}</h1>

                <div class="w-full flex items-center">
                    @can('create', \App\Models\Task::class)
                    <div class="ml-auto">
                        <x-primary-hyperlink-button :href="route('tasks.create')">
                            {{ __('task.create-task') }}
                        </x-primary-hyperlink-button>
                    </div>
                    @endcan
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Author') }}</th>
                        <th>{{ __('Executor') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        @canany(['update', 'delete'], new \App\Models\Task())
                            <th>{{ __('Actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td><a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                            <td>{{ $task->creator->name }}</td>
                            <td>{{ $task->executor->name ?? '' }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            @canany(['update', 'delete'], $task)
                                <td>
                                    @can('delete', $task)
                                        <a class="text-red-600 hover:text-red-900"
                                           href="{{ route('tasks.destroy', $task) }}"
                                           data-confirm="{{ __('Are you sure?') }}"
                                           data-method="delete"
                                           rel="nofollow">
                                            {{ __('Delete') }}</a>
                                    @endcan
                                    @can('update', $task)
                                        <a class="text-blue-600 hover:text-blue-900"
                                           href="{{ route('tasks.edit', $task) }}">
                                            {{ __('Edit') }}</a>
                                    @endcan
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
