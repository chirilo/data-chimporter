@extends('app')
@section('content')

    
    <form action="{{route('pair', [])}}" method="post" enctype="multipart/form-data">
        <!-- <input type="file" name="filefield"> -->
        <ul>
            <li>
                <input type="radio" name="inventory" /> <label>Inventory</label>
            </li>
        </ul>
        <input type="submit">
    </form>
 
@endsection