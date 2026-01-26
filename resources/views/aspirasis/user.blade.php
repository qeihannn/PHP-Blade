@extends('layouts.app')

@section('content')
<div>

    <table border="2" cellpadding="8" cellspacing="0">
        <head>

        </head>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td style="text-transform: capitalize;">
                        {{ $user->role }}
                    </td>
                    <td>
                        {{ $user->created_at->format('d-m-Y') }}
                    </td>
                    <td>
                        delete / edit
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">
                        Data user masih kosong
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
