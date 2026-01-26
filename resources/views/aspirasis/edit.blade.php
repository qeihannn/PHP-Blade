@extends('layouts.app')

@section('content')
<div style="max-width: 600px;">


    {{-- Error validation --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <table cellpadding="6">
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}" required>
                </td>
            </tr>

            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}" required>
                </td>
            </tr>

            <tr>
                <td>NIS</td>
                <td>
                    <input type="text" name="nis"
                        value="{{ old('nis', $user->nis) }}" required>
                </td>
            </tr>

            <tr>
                <td>Kelas</td>
                <td>
                    <input type="text" name="kelas"
                        value="{{ old('kelas', $user->kelas) }}" required>
                </td>
            </tr>

            <tr>
                <td colspan="2"><strong>Ganti Password</strong></td>
            </tr>

            <tr>
                <td>Password Lama</td>
                <td>
                    <input type="password" name="old_password">
                </td>
            </tr>

            <tr>
                <td>Password Baru</td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>

            <tr>
                <td>Konfirmasi Password Baru</td>
                <td>
                    <input type="password" name="password_confirmation">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="{{ route('aspirasi.user') }}">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</div>
@endsection
