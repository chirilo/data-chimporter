@extends('app')
@section('content')
<div class="page-inner clear">
        <h2 class="subtitle">CSV to MySQL</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Import</div>
                        <div class="panel-body">
                            <section class="box clear">
                                <article class="box clear">
                                    <div class="box-body" style="font-size: 24px; text-align: center;">
                                        <h2>Import Process Successfully Completed!</h2>
                                        <p>
                                            An overview below is available.
                                        </p>
                                    </div>

                                </article> <!-- .box -->
                            </section>
                            <section>
                                <aside id="copy">
                                    Code by <a href="iamchiriru.com" target="_blank">iamchiriru</a>
                                </aside>
                            </section> <!-- .box -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <table id="dataimport_table" class="display" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                           </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                           </tr>
                        </tfoot>
                        <tbody>
                            @foreach( $importedcsvdata['csvtoarraydata'] as $k => $rows )
                            <tr>
                                @foreach( $rows as $row )
                                    @while( $k > 0 )
                                <td>{{ $row[$k] }}</td>
                                    @endwhile
                                @endforeach
                            </tr>
                            @endforeach;
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection