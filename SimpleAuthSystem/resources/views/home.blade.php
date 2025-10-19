<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.meta')
</head>
<body>
  
    @auth
        <p> {{ auth()->user()->name}} You are login</p>

        <!-- create a new post -->
         <div style="border: solid 3px black;">
            <form action="{{route('create_post')}}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title"/>
                <textarea name="body" placeholder="body content ..."></textarea>
                <button type="submit">Create</button>
            </form>
         </div>


        <!-- logout button -->
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>

        <!-- All Posts -->

        @isset($posts)
        <h2>All Posts by {{$posts[0]->user->name}}</h2>
            @foreach ($posts as $post)
               <div style="border: solid 3px black; background-color: white;">
                    <h3> {{$post['title']}} : post by {{$post->user->name}} 
                        <span style="color: blueviolet">date: {{$post->created_at}}</span> </h3>
                    <p> {{$post['body']}} </p>
                     {{-- <a href="/public/edit_post/{{$post->id}}">Edit Post</a>    --}}
                    <a href="{{Route('edit_post', $post->id)}}">Edit Post</a>  
                    <form action="{{Route('delete_post', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to Delete')">delete_post</button>
                    </form>              
                </div>
                <hr/>
            @endforeach 
        @endisset

    
    @else
    <!-- Register Form -->
    <div style="border: solid 3px black;">
        <h2>Register</h2>
        <form action="{{Route('register')}}" method="POST">
            @csrf
            <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="name"/>
             @error('name')
                <span> {{$message}}</span>
              @enderror
              <br/>
            <input type="email" name="email" value="{{old('email')}}" placeholder="email"/>
             @error('email')
                <span> {{$message}}</span>
              @enderror
              <br/>
            <input type="password" name="password" value="{{old('password') ?? '12345678'}}" placeholder="password"/>
             @error('password')
                <span> {{$message}}</span>
              @enderror
              <br/>
            <button type="submit">Register</button>
        </form>
    </div>

    <!-- Login Form -->
    <div style="border: solid 3px black;">
        <h2>Login</h2>
        <form action="{{Route('login')}}" method="POST">
            @csrf
            <input type="text" name="loginname" value="{{old('name')}}" placeholder="name"/><br/>
            <input type="password" name="loginpassword" value="{{old('password') ?? '12345678'}}" placeholder="password"/>
            <button type="submit">login</button>
        </form>      
    </div>

    @endauth

</body>

</html>