<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.meta')
</head>
<body>
    <form action="/public/update_post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        Title: <input type="text" name="title" value="{{old('title')?? $post->title}}"/><br/>
        Body: <br/><textarea name='body'>{{old('body')?? $post->body}}</textarea><br/>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>