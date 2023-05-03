<div class="flex flex-col md:w-1/2">
    <div class="mt-2">
        <x-input-label for="name" :value="__('Name')" />
    </div>
    <div>
        <x-text-input id="name" name="name" type="text" :value="old('name', $label->name)" autofocus />
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div class="mt-2">
        <x-input-label for="description" :value="__('Description')" />
    </div>
    <div>
        <x-textarea id="description" class="h-32" name="description" cols=50 rows="50" :value="old('description', $label->description)" />
        <x-input-error :messages="$errors->get('description')" />
    </div>
</div>
