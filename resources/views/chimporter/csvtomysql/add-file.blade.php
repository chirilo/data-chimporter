  @extends('app')

  @section('content')
      <div class="row" id="doc-forms">
        <div class="large-10 large-centered columns">
          <form data-abide="" novalidate="novalidate" id="addfile_form" class="fadeInUp animated" action="{{route('addCsvFile', [])}}" method="post" enctype="multipart/form-data">

          
          <!-- <form data-abide="" novalidate="novalidate" id="addfile_form" class="fadeInUp animated" action="{{route('addCsvFile', [])}}" method="post" enctype="multipart/form-data"> -->
                <div class="row">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="_delimiter" value="," />
                  <input type="hidden" name="_user" value="" />
                  <input type="hidden" name="file_type" value="csv" />
                </div>
                <fieldset class="box">
                  <legend><i class="fi-upload style4"></i> Upload CSV File</legend>
                  <!--<div class="box-icon">
                   <span class="fi-page-csv large style4"><img src="./chimporter/images/flat-os-icons/Apps-Plex-Home-Theater.svg" alt="Launchpad flat icon"></span> 
                  </div> -->
                  <div class="row">
                    <!-- <span class="info label"></span> -->
                    <div data-alert class="alert-box info radius">
                      The server is restricted, so 8,000 - 10,000 row can be parset at a time. This is a server settings parameter.
                      <a href="#" class="close">&times;</a>
                    </div>

                    <div class="row">
                      <div class="large-12 columns">
                        <hr>
                      </div>
                    </div>

                    <div class="large-6 columns">
                      <label for="filefield" class="" role="alert">Upload CSV from local folder <small>required</small>
                        <!-- <input type="file" id="filefield" name="filefield" placeholder="Choose file from your local folders.." /> -->
                        <center><input type="file" id="filefield" name="filefield" required pattern="^.+?\.(csv|CSV|xls|XLS|xlsx|XLSX|xml|XML|txt|TXT)$" /></center>
                        <!-- <input type="file" id="filefield" name="filefield" value="" placeholder="Select a .csv file to import" /> -->
                      </label>
                      <small class="error">Please Upload a csv file.</small>
                    </div>
                    <div class="large-6 columns">
                      <div class="row collapse">
                        <label for="basetable" class="" role="alert">Predefined tables <small>required</small>
                          <select id="basetable" name="table" class="medium" required="" data-invalid="" aria-invalid="true">
                            <option value="">Select Base Table</option>
                            <option value="sophiosample"> Sophio Sample Table </option>
                            <option value="allbrands"> All Brands </option>
                          </select>
                        </label>
                        <small class="error">Select a table.</small>
                      </div>
                    </div>
                    <!-- -->
                    <div style="display: none;" class="large-6 columns">
                      <label class="">URL Source</label>
                      <div class="row collapse">
                        <div class="small-10 columns">
                          <input type="text" placeholder="Feature Not Available" disabled />
                        </div>
                        <div class="small-2 columns">
                          <a href="#" class="button postfix" disabled>Not Available</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="large-12 columns">
                      <hr>
                    </div>
                  </div>

                  <div class="row">
                    <div class="large-6 columns">
                      <label for="has_headers">Has headers? <span data-tooltip aria-haspopup="true" class="has-tip" title=" Check if the first row in the table is the header. If checked, the application will skip the first row."><img src="http://foundation.zurb.com/docs/assets/img/images/fi-info.svg" width=20></span>
                      
                      <br />
                      <label for="yes_headers"><input type="radio" name="has_headers" value="yes" id="yes_headers" required>Yes</label>
                      <label for="no_headers"><input type="radio" name="has_headers" value="no" id="no_headers" required>No</label>
                      </label>
                      <small class="error">Please Upload a csv file.</small>
                    </div>
                    <div class="large-6 columns">
                      <label>Delimeter &nbsp; <sup><span data-tooltip aria-haspopup="true" class="has-tip" title=" The delimiter separates your data in CSV file. You can check your default delimiter."><img src="http://foundation.zurb.com/docs/assets/img/images/fi-info.svg" width=20></span></sup>
                        <input type="text" maxlength="5" id="delimiter" name="delimiter" value="" placeholder="default is a comma ( , )" />
                      </label>
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="large-12 columns">
                      <hr>
                    </div>
                  </div>

                  <div class="row">
                    
                  </div>

                  <div class="row">
                      <div class="large-12 columns">
                          <button type="submit" class="medium button green">Submit</button>
                          <button type="reset" class="medium button green">Reset</button>
                      </div>
                  </div>
                  <div class="row">
                      <div class="large-12 columns">
                          
                      </div>
                  </div>
              </fieldset>
          </form>
          
        </div>
      </div>
      
  @endsection
