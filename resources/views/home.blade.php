@extends('app')

@section('content')
	<div class="row">
        <div class="large-12 columns">

					<section >

			          <!--   <ul>
			                <li class=""> -->
			                    <!-- <a href="/csvtomysql" target="_self">CSV <em>to</em> MYSQL</a> -->
								<div class="row">
								  <div class="small-4 columns">
								    
								    <div class="service slideInLeft animated">
								      <div class="service-icon-box">
								        <!-- <img src="./chimporter/images/flat-os-icons/Apps-Plex-Home-Theater.svg" alt="Launchpad flat icon" class="service-icon"> -->
								        <a href="/csvtomysql"><i class="fi-page-export-csv large style2 csv-legend"></i></a>
								      </div>
								      
								      <p class="service-description">
								      	Accepts a <em>CSV / DOC(x)</em> file and imports to database. You can pair the columns and may save back to database or export into another file.</p>
								    </div>
								    
								  </div>
								  <div class="small-4 columns">
								    
								    <div class="service slideInUp animated">
								      <div class="service-icon-box">
								        <!-- <img src="./chimporter/images/swap.svg" alt="Launchpad flat icon" class="swap-legend service-icon" /> -->
								        <a href="/csvtomysql"><i class="fi-page-export-doc large style2 csv-legend"></i></a>
								      </div>
								      
								      <p class="service-description">Accepts <em>XLS(x)</em> file and imports to database. You can pair the columns and may save back to database or export into another file.</p>
								    </div>
								    
								  </div>
								  <div class="small-4 columns">
								    
								    <div class="service slideInRight animated">
								      <div class="service-icon-box">
								        <a href="/csvtomysql"><i class="fi-page-export-pdf large style2 csv-legend"></i></a>
								      </div>
								      
								      <p class="service-description">Accepts a <em>XML / PDF</em> file and imports to database. You can pair the columns and may save back to database or export into another file.</p>
								    </div>
								    
								  </div>
								</div>
			        </section>
			        <aside id="copy">Code by <a href="iamchiriru.com" target="_blank">iamchiriru</a></aside>

			</div>
		</div>


@endsection
