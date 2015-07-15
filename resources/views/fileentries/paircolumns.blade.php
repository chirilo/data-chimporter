@extends('app')
@section('content')

    <?php 
        $alldata = Session::get('csvtomysql');

        if( !isset( $alldata ) ){
            $alldata = Session::get('alldata');
        }
        // base table - the selected table
        $basetableheaders = $alldata['columnheaders']['basetablecolheaders'];
        
        // this is used as select dropdown element 
        $csvfileheaders = $alldata['columnheaders']['csvfilecolheaders'];
    ?>
    <div class="page-inner clear">
        <h2 class="subtitle">CSV to MySQL</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pair columns</div>
                        <div class="panel-body">
                            <section class="box clear">

                                <article class="box-body clear">

                                    <div class="msg error"></div>

                                    <form action="{{route('csvtomysqlimport', [])}}" method="post">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th>Base Table columns</th>
                                                    <th>CSV File columns</th>
                                                </tr>
                                            </thead>
                                            
                                            
                                                <tbody>

                                                    @foreach( $basetableheaders as $basetableheader )
                                                        <!-- end of base table header -->
                                                        <tr>
                                                            <td>
                                                                <label for="column_{{ $basetableheader }}">{{ $basetableheader }}</label>
                                                            </td>
                                                            
                                                            <td>
                                                                <select name="column[{{ $basetableheader }}]" id="column_{{ $basetableheader }}">
                                                                    <option value=""></option>
                                                                    @foreach( $csvfileheaders as $csvfileheader )
                                                                        <option value="{{ $csvfileheader }}">{{ $csvfileheader }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <input type="checkbox" name="compare[{{ $basetableheader }}]" value="on" id="compare[{{ $basetableheader }}]">
                                                                <label for="compare[{{ $basetableheader }}]">Key <sup>1</sup></label>
                                                            </td>
                                                        </tr>
                                                        <!-- end of base table header -->
                                                    @endforeach
                                            </tbody>
                                        </table>

                                        <div class="plain-text clear">
                                            <p>
                                                <sup>1</sup> If this is checked, the application will use this for comparison. The existing data will be updated.
                                            </p>
                                        </div>

                                        <div class="form-row clear">
                                            <!-- <input type="hidden" name="token" value="1f3b720a1acc4004e32cc6f9ece246d1"> -->
                                            <input type="hidden" name="alldata" value="{{ json_encode($alldata) }}">
                                            <input type="hidden" name="import" value="save">
                                            <input type="submit" value="Import">
                                        </div>                
                                    </form>
                                </article> <!-- .box-body -->
                            </section> <!-- .box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection