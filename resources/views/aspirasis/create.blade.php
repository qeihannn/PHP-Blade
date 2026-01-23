@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('aspirasi.store') }}"
      enctype="multipart/form-data">
    @csrf
    <table cellpadding="5">
        <tr>
            <td>Judul</td>
            <td>
                <input type="text" name="title"
                       value="{{ old('title') }}" required>
            </td>
        </tr>

        <tr>
            <th><label for="kategori">Kategori:</label></th>
            <th>
                <select name="kategori" id="kategori">
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </th>
        </tr>


        <tr>
            <td>Deskripsi</td>
            <td>
                <textarea name="description" required>{{ old('description') }}</textarea>
            </td>
        </tr>

        <tr>
            <td>Foto (Opsional)</td>
            <td>
                <input type="file" name="photo" accept="image/*">
            </td>
        </tr>

        <tr>
            <td></td>
            <td><button type="submit">Kirim</button></td>
        </tr>

    </table>
</form>
@endsection
