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

<br>
<br>

<form id="addMessage" @submit="checkForm" action="{{URL::to('/discussions', array($fil_id ?? ''), false)}}"
    method="POST">
    @csrf
    <legend>Envoyer un nouveau message</legend>
    <input type=”name” size=”19″ name="UserName" placeholder="Nom d'utilisateur"><br><br>
    <input type="password" size=”19″ name="Password" placeholder="Mot de passe"><br><br><br>
    <textarea name=Message rows=”6″ cols=”20″ placeholder="Ecrivez votre message ici..."></textarea><br><br>
    <button type=”submit” value="Envoyer">
        <a onclick="update()"></a>
        Envoyer
    </button>
</form>

<div id="detail"></div>

<script>
    function update(value) {
        $("#addMessage").empty();
        $.get("/api/discussions/" + value, function (data, status) {
            let info = JSON.parse(data);
            $("#addMessage").append("<h3>Nom d'utilisateur</h3><br/>" + info['UserName']);
            $("#addMessage").append("<h3>Mot de passe</h3><br/>" + info['Password']);

            if (info["UserName"].length == 0) {
                $("#addMessage").append("<h3>Entrez votre nom d'utilisateur</h3><br/><ul>");
            }

            for (commits of info["commits"]) {
                $("#addMessage").append("<li>[" + commits['date'] + "] " + commits['message'] + "</li>");
            }
            $("#addMessage").append("</li>");
        });
    }

</script>

<script type="text/javascript">
    function update() {
        var msgid = document.getElementById('msgid').value;
        var msgtext = document.getElementById('msgtext').value;
        var msgdate = document.getElementById('msgdate').value;
        var msgauthor = document.getElementById('msgauthor').value;
        if (msgid.length != 0 || msgtext.length != 0 || msgdate.length != 0 || msgauthor.length != 0) {
            try {
                var connection = new ActiveXObject("ADODB.Connection");
                var connectionstring =
                    "Data Source=.;Initial Catalog=FilsDiscussions;Persist Security Info=True;User ID=sa;Provider=SQLOLEDB";
                connection.Open(connectionstring);
                var rs = new ActiveXObject("ADODB.Recordset");
                rs.Open("insert into Message values('" + msgid + "','" + $fil_id + "','" + msgauthor + "','" + msgdate +
                    "," + msgtext + "')", connection);
                alert("Insert Record Successfuly");
                msgid.value = " ";
                connection.close();
            } catch (error) {
                alert("L'ajout du message n'a pas foncitonné");
            }
        } else {
            alert("Veuillez remplir tous les champs");
        }
    }

    function ShowAll() {
        var connection = new ActiveXObject("ADODB.Connection");
        var connectionstring =
            "Data Source=.;Initial Catalog=FilsDiscussions;Persist Security Info=True;User ID=sa;Provider=SQLOLEDB";
        connection.Open(connectionstring);
        var rs = new ActiveXObject("ADODB.Recordset");
        rs.Open("select * from Message ", connection);
        rs.MoveFirst();
        var span = document.createElement("span");
        span.style.color = "Blue";
        span.innerText = "  ID " + "  Text " + "  Date" + " Author ";
        document.body.appendChild(span);
        while (!rs.eof) {
            var span = document.createElement("span");
            span.style.color = "green";
            span.innerText = "\n " + rs.fields(0) + " |  " + rs.fields(1) + " |  " + rs.fields(2) + " |  " + rs.fields(
                3);
            document.body.appendChild(span);
            rs.MoveNext();
        }
        rs.close();
        connection.close();
    }

</script>

<script>
    function insertPlanet($value) {

        $stmt = $this->connection->prepare("INSERT INTO Message(owner, name, x, y, level, baseIncome) VALUES(:owner, :name, :x, :y, :level, :baseIncome)");

            $stmt->bindParam(":fil_id", $Message["threadId"]);
            $stmt->bindParam(":msgtext", $Message["text"]);
            $stmt->bindParam(":x", $Message["loc"][0]);
            $stmt->bindParam(":y", $Message["loc"][1]);
            $stmt->bindParam(":level", $Message["level"]);
            $stmt->bindParam(":baseIncome", $Message["baseIncome"]);

            $stmt->execute();

            if ($stmt->errorCode() == 0) {
                return true;
            } else {
                return false;
            }
        }

</script>

@endif

@endsection
