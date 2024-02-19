<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <style>
        .btn {
            display: flex;
            align-items: center;
        }

        .getPet {
            display: flex;
            flex-direction: column;
            width: max-content;
        }
    </style>
</head>

<body>

    @if(session('message'))
    <div style="color: green;">
        {{ session('message') }}
    </div>
    @endif
    @if(session('petId'))
    ID: {{ session('petId') }}
    @endif

    <h1>Pet dashboard</h1>

    <div class="btn">

        <form action="{{ route('show.pet', ['id' => 'petId']) }}" method="GET" class="getPet" id="getPetForm">
            <label for="id">Enter Pet ID:</label>
            <input type="number" id="id" required>
            <button type="submit">Get Pet</button>
        </form>

        <p style="margin: 20px">OR</p>

        <button><a href="{{route('create.pet')}}">create pet</a></button>
    </div>


    <script>
        document.getElementById('getPetForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const petId = document.getElementById('id').value;
            let formAction = document.getElementById('getPetForm').getAttribute('action');
            formAction = formAction.replace('petId', petId);

            document.getElementById('getPetForm').setAttribute('action', formAction);
            document.getElementById('getPetForm').submit();
        });
    </script>

</body>


</html>