<!DOCTYPE html>
<!--[if IE 8]>         
<html class="no-js lt-ie9" lang="en"> 
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Data and File | Importer Mapper Exporter</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/chimporter/images/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/chimporter/images/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/chimporter/images/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/chimporter/images/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/chimporter/images/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/chimporter/images/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/chimporter/images/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/chimporter/images/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/chimporter/images/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/chimporter/images/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/chimporter/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/chimporter/images/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/chimporter/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/chimporter/images/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/chimporter/stylesheets/normalize.css" />
    <link rel="stylesheet" href="/chimporter/stylesheets/animate.css" />
    <link rel="stylesheet" href="/chimporter/stylesheets/animations.css" />
    <link rel="stylesheet" href="/chimporter/stylesheets/app.css" />

    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/foundation/dataTables.foundation.css" />
    <link rel="stylesheet" href="/chimporter/datatables_v1.10.7/extensions/TableTools/css/dataTables.tableTools.css" />
    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/foundation/5.5.1/css/foundation.min.css" />
    <link rel="stylesheet" href="/chimporter/chosen_v1.4.2/docsupport/style.css">
	<link rel="stylesheet" href="/chimporter/chosen_v1.4.2/docsupport/prism.css">
	<link rel="stylesheet" href="/chimporter/chosen_v1.4.2/chosen.css">
	<link rel="stylesheet" href="/chimporter/chosen_v1.4.2/chosen.min.css">
    <script src="/chimporter/bower_components/modernizr/modernizr.js"></script>

  </head>

    <body>
    


	<!-- <div class="contain-to-grid sticky" style="height: 48px; margin-bottom: 20px;">
	<nav class="top-bar menu" data-topbar role="navigation" data-options="">
	  <h1 class="name"><i class="fi-social-zurb large style13"></i></a></h1> -->
	  @if (Auth::guest())
	  	<div class="oss-bar">
			<ul>
				<li><a style="background: #333333 url(../chimporter/login.png) no-repeat 20px 22px;" class="fork" href="/auth/login" data-reveal-id="myModal">Login</a></li>
				<li class=""><a style="background: #F36C00 url(../chimporter/login.png) no-repeat -142px 21px;" class="signup harvest" href="/auth/register" data-reveal-id="myModal">Signup</a></li>
			</ul>
		</div>
	  <!-- <ul class="inline-list hide-for-small-only account-action">
	    <li><a href="/auth/login" data-reveal-id="myModal">Login</a></li>
	    <li class=""><a class="signup" href="/auth/register" data-reveal-id="myModal">Signup</a></li>
	  </ul>
	  <a class="account hide-for-medium-up" href="#" data-reveal-id="myModal"><i class="fi-unlock"></i></a> -->
	  @else
		<div class="oss-bar">
			<ul>
				<li><a style="background: #333333 url(../chimporter/logout.png) no-repeat 20px 22px;" class="fork" href="/">{{ Auth::user()->name }}</a></li>
				<li><a style="background: #F36C00 url(../chimporter/logout.png) no-repeat -142px 21px;" class="harvest" href="/auth/logout/"></a></li>
			</ul>
		</div>
	  <!-- <ul class="inline-list hide-for-small-only account-action">
	    <li><a href="/">{{ Auth::user()->name }}</a></li>
	    <li class=""><a class="signup" href="/auth/logout/">Logout</a></li>
	  </ul>
	  <a class="account hide-for-medium-up" href="#" data-reveal-id="adad"><i class="fi-unlock"></i></a> -->
	  @endif
	<!-- </nav>
	</div> -->
	<div class="row">
		<div class="large-12 columns" style="visibility: hidden; margin: 0 0 20px 0;">
			<h1>Chimporter</h1>
		</div>
	</div>
	@yield('content')

	<!-- <div class="oss-bar">
    	<ul>
         <li><a class="fork" href="">Fork on Github</a></li>
        <li><a class="harvest" href="">Built by Harvest</a></li>
        </ul>
    </div> -->
</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="/chimporter/javascripts/vendor/jquery.js"></script>
	<script src="/chimporter/javascripts/vendor/jquery.cookie.js"></script>
	<script src="/chimporter/bower_components/foundation/js/foundation.min.js"></script>
	
	

	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/foundation/dataTables.foundation.js"></script>
	<script src="/chimporter/datatables_v1.10.7/media/js/jquery.dataTables.min.js"></script>
	<script src="/chimporter/datatables_v1.10.7/extensions/TableTools/js/dataTables.tableTools.js"></script>
	<!-- <script src="https://datatables.net/release-datatables/extensions/Plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->
	


	
	<script src="/chimporter/chosen_v1.4.2/chosen.jquery.js"></script>
    <script src="/chimporter/chosen_v1.4.2/chosen.jquery.min.js"></script>
    <script src="/chimporter/chosen_v1.4.2/chosen.jquery.js" type="text/javascript"></script>
    <script src="/chimporter/chosen_v1.4.2/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
	

	<script>
		$(document).foundation();
    	$(document).ready(function(){$('#myModal').foundation('reveal', 'open')});
	    /*$(document).ready(function() {
	        
	    );*/

	    $(document).ready(function() {
	    	$(document).ready( function () {
			    var table = $('#csvtomysql').dataTable();
			    var tableTools = new $.fn.dataTable.TableTools( table, {
			        "buttons": [
			            "copy",
			            "csv",
			            "xls",
			            "pdf",
			            { "type": "print", "buttonText": "Print me!" }
			        ],
			        "sSwfPath": "../chimporter/datatables_v1.10.7/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
			    } );
			      
			    $( tableTools.fnContainer() ).insertAfter('div.info');
			} );
	    	
	    } );
	</script>
	<script type="text/javascript">
	    var config = {
	      '.chosen-select'           : {},
	      '.chosen-select-deselect'  : {allow_single_deselect:true},
	      '.chosen-select-no-single' : {disable_search_threshold:10},
	      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	      '.chosen-select-width'     : {width:"95%"}
	    }
	    for (var selector in config) {
	      $(selector).chosen(config[selector]);
	    }
	</script>
</html>
