<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pet</title>
    <style>
        .form {
            display: flex;
            flex-direction: column;
            width: fit-content;
        }

        .field {
            display: flex;
            justify-content: space-between;
            margin: 3px;
        }
    </style>
</head>

<body>

    <h1>Create Pet</h1>

    @if ($errors->any())
    <div style="color: red">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('store.pet')}}" method="POST" class="form">
        @csrf

        <div class="field">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="field">
            <label for="status">Status:</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>

        </div>

        <div class="field">
            <label for="category">Category:</label>
            <input type="text" name="category" required>
        </div>

        <div class="field">
            <label for="photoUrls">Photo URLs (comma-separated):</label>
            <input type="text" name="photoUrls" required>
        </div>

        <div class="field">
            <label for="tags">Tags (comma-separated):</label>
            <input type="text" name="tags" required>
        </div>

        <button type="submit">Create Pet</button>
    </form>

    <a href="{{url()->route('main.pet')}}"> BACK </a>

</body>

</html>