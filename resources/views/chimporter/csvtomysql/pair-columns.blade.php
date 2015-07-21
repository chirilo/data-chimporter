  @extends('app')

  @section('content')
    <?php 
        $alldata = Session::get('csvtomysqlimportdata');

        if( !isset( $alldata ) ){
            $alldata = Session::get('alldata');
        }
        // base table - the selected table
        $basetableheaders = $alldata['columnheaders']['basetablecolheaders'];
        
        // this is used as select dropdown element 
        $csvfileheaders = $alldata['columnheaders']['csvfilecolheaders'];
        $csvfiledetails = $alldata['csvfile'];
    ?>
        <div class="row" id="doc-forms">
            <div class="large-10 large-centered columns fadeInUp animated">
                <div class="msg error"></div>
                <form action="{{route('pairCsvRowsTableColumns', [])}}" method="post">
                    <fieldset class="box">
                        <legend><i class="fi-upload style2"></i> Pair Columns</legend>
                        <table id="paircolumns" cellpadding="10" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Base Table columns</th>
                                    <th>CSV File columns</th>
                                    <th>Compare Fields</th>
                                </tr>
                            </thead>
                                <tbody>

                                    @foreach( $basetableheaders as $basetableheader )
                                        <!-- end of base table header -->
                                        <tr>
                                            <td>
                                                <label for="column_{{ $basetableheader }}"> 
                                                    <input type="text" value="{{ $basetableheader }}" disabled />
                                                </label>
                                            </td>
                                            
                                            <td>
                                                <label for="column_{{ $basetableheader }}">
                                                <select name="column[{{ $basetableheader }}]" id="column_{{ $basetableheader }}" data-placeholder="Map these fields from the uploaded CSV File" style="width: 350px;" class="chosen-select-no-results" tabindex="-1">
                                                <!-- <select name="column[{{ $basetableheader }}]" id="column_{{ $basetableheader }}"> -->
                                                    <option value=""></option>
                                                    @foreach( $csvfileheaders as $csvfileheader )
                                                        <option value="{{ $csvfileheader }}">{{ $csvfileheader }}</option>
                                                    @endforeach
                                                </select>
                                                </label>
                                            </td>
                                            <td>
                                               <label for="compare[{{ $basetableheader }}]">Key <sup>1</sup> <input type="checkbox" name="compare[{{ $basetableheader }}]" value="on" id="compare[{{ $basetableheader }}]">
                                                </label>
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

                    <div class="row">
                      <input type="hidden" name="_token" value="" />
                      <input type="hidden" name="_delimiter" value="," />
                      <input type="hidden" name="_user" value="" />
                      <input type="hidden" name="_file_type" value="csv" />
                      <input type="hidden" name="_csvfilename" value="{{ $csvfiledetails['filename'] }}" />
                      <input type="hidden" name="_basetable" value="{{ $csvfiledetails['basetable'] }}" />
                      <center>
                        <div class="small-12 columns">
                          <button type="submit" class="button">Finalize Column Mapping</button>
                        </div>
                      </center>
                    </div>
                    </fieldset>               
                </form>
            </div>
        </div>
        <!-- <div class="oss-bar">
            <ul>
             <li><a class="fork" href="">Fork on Github</a></li>
            <li><a class="harvest" href="">Built by Harvest</a></li>
            </ul>
        </div> -->
  @endsection