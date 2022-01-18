@extends('canevas')
@section ('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section ('content')

@if (empty($discussions))
        <p>Aucune discussion</p>
    @else

        <table>
            <tr>
                <th>Sujets de discussion</th>
            </tr>
            @foreach ($discussions as $discussion)
                <tr>
                    <td><a href="/discussions/{{ $discussion['id'] }}">{{ $discussion['title'] }}</td>
                </tr>
            @endforeach
        </table>

    @endif

@endsection
