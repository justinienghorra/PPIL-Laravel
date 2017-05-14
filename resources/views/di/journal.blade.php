<html>
<head>

</head>
<body>
<h1>Journal</h1>
@if (isset($events))

    <table border="1">

    @foreach($events as $event)

        <tr>
           <td>{{ $event->toString() }} </td>
            <td><button>Accepter</button></td>
            <td><button>Refuser</button></td>
        </tr>


    @endforeach

    </table>


@endif

</body>
</html>