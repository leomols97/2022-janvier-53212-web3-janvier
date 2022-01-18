@extends('canevas')
@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    @if (empty($fil))
        <p>Aucun fil de discussion</p>
    @else
        <table>
            <tr>
                <th>Message</th>
                <th>Date de publication</th>
                <th>Auteur</th>
            </tr>
            @foreach ($fil as $f)
                <tr>
                    <td>{{ $f['text'] }}</td>
                    <td>{{ $f['date'] }}</td>
                    <td>{{ $f['author'] }}</td>
                </tr>
            @endforeach
        </table>

    @endif

@endsection

