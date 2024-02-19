<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pet</title>
    <style>
        .form{
            display: flex;
            flex-direction: column;
            width: fit-content;
        }

        .field{
            display: flex;
            justify-content: space-between;
            margin: 3px;
        }

    </style>
</head>

<body>

    <h1>Edit Pet</h1>

    @if(isset($pet))
    <form action="{{route('update.pet', request()->segment(3))}}" method="POST" class="form">
        @csrf
        @method('PUT')
        <div class="field">
            <p for="name">ID: </p>
            <p>{{$pet['id']}}</p>
        </div>
        <div class="field">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{$pet['name']}}" required>
        </div>
        <div class="field">
            <label for="status">Status:</label>
            <select name="status" required>
                <option value="available">Available</option>
                @if($pet['status'] == "pending")
                <option selected value="pending">Pending</option>
                <option value="sold">Sold</option>
                @elseif($pet['status'] == "sold")
                <option value="pending">Pending</option>
                <option selected value="sold">Sold</option>
                @else
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
                @endif
            </select>
        </div>

        <div class="field">
            <label for="category">Category name:</label>
            <input type="text" name="category" value="{{$pet['category']['name']}}" required>
        </div>
  
        <div class="field">
            <label for="photoUrls">Photo URLs:</label>
            @if( isset($pet['photoUrls'][0]))
            <input type="text" name="photoUrls" value="{{$pet['photoUrls'][0]}}" required>
            @else
            <input type="text" name="photoUrls" required>
            @endif
        </div>
     
        <div>
            <p style="text-align: center;">Tags:</p>
            @foreach($pet['tags'] as $tag)
            <div class="field">
                <label for="tags">Tags (comma-separated):</label>
                <input type="text" name="tags" value="{{$tag['name']}}" required>
            </div>
            @endforeach
        </div>
        <button type="submit">Update Pet</button>
    </form>
    @else 
    <p>No pet details available.</p>
    <p>Status code: {{$status}} - {{$message}}</p>
    @endif
    
    <a href="{{url()->route('main.pet')}}"> BACK </a>

</body>

</html>