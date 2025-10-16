<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
</head>
<body>
    <h2>Simple Calculator</h2>

<form action="{{route('calculator.cal')}}" method="POST">
    @csrf
    
    <label for="numA">Number A:</label>
    <input name="numA" type="number" min="0" max="1000" step="0.00001" value="{{old('numA')}}" /><br/>
    
    <label for="numB">Number B:</label>
    <input name="numB" type="number" min="0" max="1000" step="0.00001" value="{{old('numB')}}"/><br/>
    
    <label for="opp">Operation:</label>
    <select name="opp">
        <option value="add">Add</option>
        <option value="sub">Sub</option>
        <option value="mul">Mul</option>
        <option value="div">Div</option>
    </select><br/>
    
    <button type="submit">Calculate</button>
</form>

<a href="{{ route('calculator.last_val') }}">Last Memory</a>

{{-- <!-- ✅ CORRECT -->
<form action="{{ route('calculator.update_val') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="number" name="val" value="{{ $val ?? 0 }}">
    <button type="submit">Update</button>
</form> --}}

<p>Result: {{ request('result') ?? '0'}}</p> 

    <!-- Error Logs-->
    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif
    

</body>
</html>