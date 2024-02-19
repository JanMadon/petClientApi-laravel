<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details</title>
</head>

<body>
    <h1>Pet Details</h1>
    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    Status code: {{ session('code') }}
    @endif

    @if(isset($pet))
    <ul>
        <li>ID: {{ $pet['id'] }}</li>
        <li>Name: {{ $pet['name'] }}</li>
        <li>Status: {{ $pet['status'] }}</li>

        @if(isset($pet['category']))
        <li>Category ID: {{ $pet['category']['id'] }}</li>
        <li>Category Name: {{ $pet['category']['name'] }}</li>
        @endif

        @if(isset($pet['photoUrls']))
        <li>Photo URLs:</li>
        <ul>
            @foreach($pet['photoUrls'] as $photoUrl)
            <li>{{ $photoUrl }}</li>
            @endforeach
        </ul>
        @endif

        @if(isset($pet['tags']))
        <li>Tags:</li>
        <ul>
            @foreach($pet['tags'] as $tag)
            @if(isset($tag['id']) && isset($tag['name']))
            <li>ID: {{ $tag['id'] }}, Name: {{ $tag['name'] }}</li>
            @endif
            @endforeach
        </ul>
        @endif
    </ul>
    @else
    <p>No pet details available.</p>
    <p>Status code: {{$status}} - {{$message}}</p>
    @endif


    @if(isset($pet))
    <button><a href="{{route('edit.pet', request()->segment(2))}}">Edit</a></button>
    <form action="{{ url()->current() }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Pet</button>
    </form>
    @endif

    <a href="{{url()->route('main.pet')}}"> BACK </a>


</body>

</html>