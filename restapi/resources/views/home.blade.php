<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
</head>
<body>
    <h2>Home Page</h2>

        <!-- API GET REQUEST -->
        <h4>Get all Posts</h4>
        <a href={{url('/api/posts')}}>Get all Posts</a> <br/>
        <br/>
        <h4>Get a Single Post</h4>
        <a href={{url('/api/posts/3')}}>Get a single Post</a>
        <br/>  <br/>

        
        <!-- API POST REQUEST -->
        <h4>Create Posts</h4>
        {{-- <form action="/public/api/posts" method="POST"> --}}
        <form action="{{url('/api/posts')}}" method="POST">    
        {{-- <form action="{{ Route('API_create_post') }}" method="POST"> --}}
            @csrf
            <input type="text" name="title" placeholder="title" value="{{old('title')}}"/>
            <button>Create post</button>
        </form>

        <br/>
        <!-- API PUT REQUEST -->
        <h4>Update Posts</h4>
        {{-- <form action="{{url('/api/posts/3')}}" method="POST">     --}}
        <form action="{{ Route('API_update_post', 3) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" placeholder="title" value="{{old('title')}}"/>
            <button>Update post</button>
        </form>

        <br/>
        <!-- API DELETE REQUEST -->
        <h4>Delate Posts</h4>
        <form action="{{url('/api/posts/2')}}" method="POST">    
        {{-- <form action="{{ Route('API_delete_post', 3) }}" method="POST"> --}}
            @csrf
            @method('DELETE')
            <button>Delete post</button>
        </form>

</body>
</html>