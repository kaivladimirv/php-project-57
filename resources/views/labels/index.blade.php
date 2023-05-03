<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="max-w-screen-xl px-4 pt-28 pb-8 mx-auto lg:pb-16">
            @include('flash::message')
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('Labels') }}</h1>

                <div class="w-full flex items-center">
                    @can('create', \App\Models\Label::class)
                    <div class="ml-auto">
                        <x-primary-hyperlink-button :href="route('labels.create')">
                            {{ __('label.create-label') }}
                        </x-primary-hyperlink-button>
                    </div>
                    @endcan
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        @canany(['update', 'delete'], new \App\Models\Label())
                            <th>{{ __('Actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($labels as $label)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            @canany(['update', 'delete'], $label)
                                <td>
                                    @can('delete', $label)
                                        <a class="text-red-600 hover:text-red-900"
                                           href="{{ route('labels.destroy', $label) }}"
                                           data-confirm="{{ __('Are you sure?') }}"
                                           data-method="delete"
                                           rel="nofollow">
                                            {{ __('Delete') }}</a>
                                    @endcan
                                    @can('update', $label)
                                        <a class="text-blue-600 hover:text-blue-900"
                                           href="{{ route('labels.edit', $label) }}">
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
