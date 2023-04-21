<div class="flex flex-col">
    <div>
        {{ Form::label('name', __('Name')) }}
    </div>
    <div class="mt-2">
        {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
        <x-input-error :messages="$errors->get('name')" />
    </div>
</div>
