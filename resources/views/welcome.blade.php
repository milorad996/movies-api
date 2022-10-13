<!DOCTYPE html>
<body>
    <h1>A new movie is added to the system</h1>
    <h3>{{$email_data->title}}</h3><br>
    <h3>{{$email_data->description}}</h3><br>
    <img src="{{ $email_data->image }}" >
</body>
</html>
