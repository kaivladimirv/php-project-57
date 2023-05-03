<div class="flex flex-col md:w-1/2">
    <div>
        <x-input-label for="name" :value="__('Name')" />
    </div>
    <div class="mt-2">
        <x-text-input id="name" name="name" type="text" :value="old('name', $taskStatus->name)" autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" />
    </div>
</div>
