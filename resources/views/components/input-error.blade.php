@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <p class='error '>{{ $message }}</p>
    @endforeach
@endif
