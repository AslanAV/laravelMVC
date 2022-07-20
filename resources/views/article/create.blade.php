<html lang="en">
<body>
{{Form::model($article, ['route'=> 'article.store']) }}
{{Form::label('head', 'Article head') }}
{{Form::input('string', 'head') }}<br>
{{Form::label('body', 'Article body') }}
{{Form::input('string', 'body') }}<br>
{{Form::label('category_id', 'Category Id') }}
{{Form::input('int', 'category_id', 1) }}<br>
{{Form::submit('create')}}
{{Form::close()}}
</body>
</html>
<style>
    input {
        border: 1px solid black;
    }
</style>
