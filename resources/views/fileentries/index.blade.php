@extends('app')
@section('content')

    <div class="page-inner clear">
        <h2 class="subtitle">CSV to MySQL</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload CSV File</div>
                        <div class="panel-body">
                            <section class="box clear">
                                
                        
                                <article class="box-body clear">

                                    <div class="msg error">
                                    </div> <!-- .msg -->

                                    <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
                                        <div class="plain-text clear">
                                            <p>
                                                <sup>**</sup> The server is restricted, so 10.000 row can be parset at a time. This is a server settings parameter.                        </p>
                                        </div>
                                        <div class="form-row clear">
                                            <label for="filename">
                                                CSV File                        </label>
                                            <input type="file" id="filename" name="filefield" value="" placeholder="Select a .csv file to import" />

                                        </div>
                                        <div class="form-row clear">
                                            <label>- AND -</label>
                                        </div>
                                        <div class="form-row clear">
                                            <!-- <label for="url">
                                                External source                        </label>
                                            <input type="text" id="url" name="url" value="" placeholder="Via an external resource" disabled /> -->
                                            <label for="table">Choose Table</label>
                                            <select name="table">
                                                <option value="inventory" selected="selected">Inventory</option>
                                                <option value="user">Users</option>
                                                <option value="fileentry">Fileentries</option>
                                            </select>
                                        </div>
                                        <div class="form-row clear">
                                            <label for="delimiter">
                                                Delimiter <sup>1</sup>
                                            </label>
                                            <input type="text" maxlength="5" id="delimiter" name="delimiter" value=",">
                                        </div>
                                        <div class="form-row clear">
                                            <label for="has_header">
                                                Has header <sup>2</sup>
                                            </label>
                                            <input type="checkbox" id="has_header" name="has_header" value="on">
                                        </div>
                                        <div class="plain-text clear">
                                            <p>
                                                <sup>1</sup> The delimiter separates your data in CSV file.</p>
                                            <p>
                                                <sup>2</sup> Check if the first row in the table is the header. If checked, the application will skip the first row.</p>
                                        </div>
                                        <div class="form-row clear">
                                            <!-- <input type="hidden" name="token" value=""> -->
                                            <input type="hidden" name="file_type" value="csv">
                                            <input value="Next" type="submit">
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