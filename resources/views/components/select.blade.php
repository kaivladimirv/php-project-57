@props(['items', 'value'])

<select {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full']) !!}>
    @foreach($items as $key => $item)
        <option @if($key === $value) selected @endif value="{{ $key }}">{{ $item }}</option>
    @endforeach
</select>
