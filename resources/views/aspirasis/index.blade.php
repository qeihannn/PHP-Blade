@extends('layouts.app')

@section('content')

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="2" cellpadding="10" cellspacing="0" center>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tanggal</th>
    
        </tr>
    </thead>
    <tbody>
        @foreach ($aspirasis as $aspirasi)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{$aspirasi->user->name}}</td>
                <td>{{$aspirasi->user->nis}}</td>
                <td>{{$aspirasi->user->kelas}}</td>
                <td>
                    <a href="{{ route('aspirasi.show', $aspirasi->id) }}">
                        {{ $aspirasi->title }}
                    </a>
                </td>
                <td>{{ $aspirasi->kategori }}</td>
                <td>
                    @if(auth()->user()->role == 'admin')
                        <form method="POST" action="{{ route('aspirasi.updateStatus', $aspirasi) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()">
                                <option value="menunggu" {{ $aspirasi->status == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="diproses" {{ $aspirasi->status == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </form>
                    @else
                        {{ $aspirasi->status }}
                    @endif
                </td>
                <td>
                   {{ $aspirasi->created_at->format('d-m-Y') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
