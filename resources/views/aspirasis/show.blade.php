@extends('layouts.app')

@section('content')
<article>
    <header>
        <h2>{{ $aspirasi->title }}</h2>
        <p>Status: <strong>{{ $aspirasi->status }}</strong></p>
    </header>

    <section>
        <p>Deskripsi: {{ $aspirasi->description }}</p>

        @if ($aspirasi->photo)
            <p>Foto Pendukung :</p>
            <img
                src="{{ asset('storage/' . $aspirasi->photo) }}"
                alt="Foto Aspirasi"
                style="max-width: 420px; height: auto; border: 1px solid #ccc; padding: 4px;"
            >
        @endif
    </section>

    @if ($aspirasi->status !== 'selesai')
        @if (auth()->user()->role == 'admin' || auth()->id() == $aspirasi->user_id)
            <section>
                <h3>Kirim Balasan</h3>
                <form method="POST" action="{{ route('responses.store', $aspirasi) }}">
                    @csrf
                    <table>
                        <tr>
                            <td><label for="message">Pesan:</label></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea id="message" name="message" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <button type="submit">Kirim Balasan</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
        @endif
    @else
        <hr>
        <p style="color: red;">
            <strong>
                Tiket ini telah ditutup. Anda tidak dapat mengirim balasan.
            </strong>
        </p>
    @endif

    <section>
        <h3>Balasan</h3>

        @if ($aspirasi->responses->isEmpty())
            <p>Belum ada balasan.</p>
        @else
            <table>
                @foreach ($aspirasi->responses as $response)
                    <tr>
                        <td><strong>{{ $response->user->name }}</strong></td>
                        <td>:</td>
                        <td>{{ $response->message }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </section>
</article>
@endsection
