<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            @include('flash::message')
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('Statuses') }}</h1>

                @can('create', \App\Models\TaskStatus::class)
                    <div>
                        <x-primary-hyperlink-button :href="route('task_statuses.create')">
                            {{ __('task-status.create-status') }}
                        </x-primary-hyperlink-button>
                    </div>
                @endcan

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        @canany(['update', 'delete'], new \App\Models\TaskStatus())
                            <th>{{ __('Actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($taskStatuses as $taskStatus)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $taskStatus->id }}</td>
                            <td>{{ $taskStatus->name }}</td>
                            <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                            @canany(['update', 'delete'], $taskStatus)
                                <td>
                                    @can('delete', $taskStatus)
                                        <a class="text-red-600 hover:text-red-900"
                                           href="{{ route('task_statuses.destroy', $taskStatus) }}"
                                           data-confirm="{{ __('Are you sure?') }}"
                                           data-method="delete"
                                           rel="nofollow">
                                            {{ __('Delete') }}</a>
                                    @endcan
                                    @can('update', $taskStatus)
                                        <a class="text-blue-600 hover:text-blue-900"
                                           href="{{ route('task_statuses.edit', $taskStatus) }}">
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
