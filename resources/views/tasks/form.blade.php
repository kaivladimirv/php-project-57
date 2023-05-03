<div class="flex flex-col md:w-1/2">
    <div class="mt-2">
        <x-input-label for="name" :value="__('Name')" />
    </div>
    <div>
        <x-text-input id="name" name="name" type="text" :value="old('name', $task->name)" autofocus />
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div class="mt-2">
        <x-input-label for="description" :value="__('Description')" />
    </div>
    <div>
        <x-textarea id="description" class="h-32" name="description" cols=50 rows="50" :value="old('description', $task->description)" />
        <x-input-error :messages="$errors->get('description')" />
    </div>

    <div class="mt-2">
        <x-input-label for="status_id" :value="__('Status')" />
    </div>
    <div>
        <x-select id="status_id" name="status_id" :items="$taskStatuses->prepend('----------', null)" :value="old('status_id', $task->status_id)" />
        <x-input-error :messages="$errors->get('status_id')" />
    </div>

    <div class="mt-2">
        <x-input-label for="assigned_to_id" :value="__('Executor')" />
    </div>
    <div>
        <x-select id="assigned_to_id" name="assigned_to_id" :items="$executors->prepend('----------', null)" :value="old('assigned_to_id', $task->assigned_to_id)" />
        <x-input-error :messages="$errors->get('assigned_to_id')" />
    </div>

    <div class="mt-2">
        <x-input-label for="labels" :value="__('Labels')" />
    </div>
    <div>
        <x-select-multiple id="labels" name="labels[]" :items="$labels->prepend('', null)" :values="old('labels', $task->labels->pluck('name', 'id'))" />
        <x-input-error :messages="$errors->get('labels')" />
    </div>
</div>
