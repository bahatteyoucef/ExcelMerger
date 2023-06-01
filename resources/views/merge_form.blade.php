<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <form action="{{ route('excel.merge') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="files[]" multiple>
            <input type="text" name="merged_file_name">

            <button type="submit">Merge File</button>
        </form>
    </body>
</html>
