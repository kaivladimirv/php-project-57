@props(['messages'])

@if ($messages)
    <div class="mb-4">
        <p class="font-medium text-red-600">{{ __('Oops! Something went wrong:') }}</p>

        <ul {{ $attributes->merge(['class' => 'mt-3 list-disc list-inside text-sm text-red-600']) }}>
            @foreach ($messages as $message)
                <li>{{ Str::ucfirst($message) }}</li>
            @endforeach
        </ul>
    </div>
@endif
