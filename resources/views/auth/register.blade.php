@extends('auth.app')

@section('content')
<form method="POST" action="{{ route('postRegister') }}">
    @csrf
    <table cellpadding="5">
        <tr>
            <td>Nama</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td><input type="text" name="nis"></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td><input type="text" name="kelas"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td><input type="password" name="password_confirmation"></td>
        </tr>
        <tr>
            <td>
                <p>Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk</a>
                </p>
            </td>
            <td align="center">
                <button type="submit">Daftar</button>
            </td>
        </tr>
    </table>
</form>
@endsection