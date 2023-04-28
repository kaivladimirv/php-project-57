<div class="flex flex-col">
    <div class="mt-2">
        {{ Form::label('name', __('Name')) }}
    </div>
    <div>
        {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div class="mt-2">
        {{ Form::label('description', __('Description')) }}
    </div>
    <div>
        {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'cols' => 50, 'rows' => 10]) }}
        <x-input-error :messages="$errors->get('description')" />
    </div>
</div>
