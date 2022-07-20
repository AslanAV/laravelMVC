<html lang="en">
    <body>
        <table>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{$article->head}}</td>
                    <td>{{$article->body}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
