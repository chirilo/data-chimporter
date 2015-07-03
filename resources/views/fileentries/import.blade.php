@extends('app')
@section('content')

    
    <form action="{{route('import', [])}}" method="post" enctype="multipart/form-data">

    	<table>
    		<thead>
    			<th>Database Columns</th>
    			<th>File Import Columns</th>
    		</thead>
    		<tbody>
    			
    			<tr>
    				<td>asd</td>
    				<td>def</td>
    			</tr>
                <tr>
                    <td>asd</td>
                    <td>def</td>
                </tr>
                <tr>
                    <td>asd</td>
                    <td>def</td>
                </tr>
    		</tbody>
    	</table>

        <!-- <input type="file" name="filefield"> -->
        <input type="submit">
    </form>
 
@endsection