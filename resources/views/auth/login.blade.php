@extends('auth.app')

@section('content')

<form method="POST" action="{{ route('postLogin') }}">
    @csrf
<table>
    <tr class="form-group">
        <td for="username">username</td>
        <td><input type="text" name="username" id="username" class="form-control" required></td>
    </tr>

    <tr class="form-group">
        <td for="password">Password</td>
        <td><input type="password" name="password" id="password" class="form-control" required></td>
    </tr>
    <tr>
        <td colspan="2">
            <p>belum punya akun?
            <a href="{{ route('register') }}">daftar</a>
        </p>
        </td>
    </tr>
    <tr>
        <td align="center">
               <button  type="submit">masuk</button>
        </td>
    </tr>
 
</table>
</form>

@endsection