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

    <div class="mt-2">
        {{ Form::label('status_id', __('Status')) }}
    </div>
    <div>
        {{ Form::select('status_id', $taskStatuses->prepend('----------', null), null, ['class' => 'rounded border-gray-300 w-1/3']) }}
        <x-input-error :messages="$errors->get('status_id')" />
    </div>

    <div class="mt-2">
        {{ Form::label('assigned_to_id', __('Executor')) }}
    </div>
    <div>
        {{ Form::select('assigned_to_id', $executors->prepend('----------', null), null, ['class' => 'rounded border-gray-300 w-1/3']) }}
        <x-input-error :messages="$errors->get('assigned_to_id')" />
    </div>

    <div class="mt-2">
        {{ Form::label('labels', __('Labels')) }}
    </div>
    <div>
        {{ Form::select('labels[]', $labels->prepend('', null), null, ['class' => 'rounded border-gray-300 w-1/3 h-32', 'multiple' => 'multiple', 'id' => 'labels']) }}
        <x-input-error :messages="$errors->get('labels')" />
    </div>
</div>
