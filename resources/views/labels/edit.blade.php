<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('label.change-label') }}</h1>

                {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH']) }}
                @include('labels.form')
                <div class="mt-2">
                    <x-primary-submit-button>{{__('Update') }}</x-primary-submit-button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
</x-app-layout>
