<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>katehori</title>
</head>
<body>
    <h1>Kategori Page</h1>
    <form action="{{ route('input_kategori') }}" method="post">
        @csrf
        <label for="kategori">Nama Kategori:</label>
        <input type="text" id="kategori" name="kategori" required>
        <button type="submit">kirim</button>
    </form>
</body>
</html>
