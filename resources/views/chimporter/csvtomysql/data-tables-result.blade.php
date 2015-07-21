 <style type="text/css" src=""></style>
 @extends('app')

  @section('content')

      <div class="row" id="doc-forms">
        <div class="large-12 medium-centered columns">
            
            <form data-abide="" novalidate="novalidate" id="datatables_form" class="fadeInUp animated" action="{{route('dataImportToDatabase', [])}}" method="post" style="margin-top: 1.5em;">
                <fieldset class="box">
                    <legend class="info"><i class="fi-upload style4"></i> Compare fields</legend>
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="info" style="min-height: 2em;">
                                <p>TableTools uses a Flash SWF file to provide the ability to copy text to the system clipboard and save files locally. TableTools must be able to load the SWF
                                file in order to provide these facilities. If you aren't using the same directory structure as the TableTools package, you will need to set the
                                <code>sSwfPath</code> TableTools parameter, as shown in this example.</p>
                            </div>
                        </div>
                    </div>
                    <table id="csvtomysql" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                @foreach($_REQUEST['column'] as $key => $value)
                                    <th> {{ $key }} </th>
                                @endforeach
                            </tr>
                        </thead>
                 
                        <tfoot>
                            <tr>
                                @foreach($_REQUEST['column'] as $key => $value)
                                    <th> {{ $key }} </th>
                                @endforeach
                            </tr>
                        </tfoot>
                 
                        <tbody>
                            @foreach( $mapped_data['mapped_table_csv_values'] as $key => $rows )
                                <tr>
                                @foreach( $rows as $value )
                                    @if( $value !== null || $value != '' )
                                        <td> {{ $value }} </td>
                                    @else
                                        <td> NO DATA </td>
                                    @endif
                                @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
    <!-- end of DataTables -->
@endsection