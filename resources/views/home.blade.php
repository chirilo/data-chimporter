@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<section class="option-list">

			            <ul>
			                <li>
			                    <a href="/csvtomysql" target="_self">CSV <em>to</em> MYSQL</a>
			                </li>
			                <li>
			                    <a href="#" target="_self">MYSQL <em>to</em> CSV</a>
			                </li>
			                <li>
			                    <a href="/xlstomysql" target="_self">XLS(X) <em>to</em> MYSQL</a>
			                </li>
			                <li>
			                    <a href="#" target="_self">MYSQL <em>to</em> XLS(X)</a>
			                </li>
			                <li>
			                    <a href="/xmltomysql" target="_self">XML <em>to</em> MYSQL</a>
			                </li>
			                <li>
			                    <a href="#" target="_self">MYSQL <em>to</em> XML</a>
			                </li>
			            </ul>

			        </section>

			        <aside id="copy">Code by <a href="iamchiriru.com" target="_blank">iamchiriru</a></aside>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<div class="page-inner clear">
        

    </div>