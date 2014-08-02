<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PIN Time Study</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div class="page-header">
		<h1>PIN Time Study <small>Obtaining real run times</small></h1>
	</div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Brand</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Process <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Cutting</a></li>
							<li><a href="#">Machining</a></li>
							<li><a href="#">Edgebanding</a></li>
							<li class="divider"></li>
							<li><a href="#">Assembly</a></li>
							<li class="divider"></li>
							<li><a href="#">Packaging</a></li>
						</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Login</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings</a></li>
							<li><a href="#">Another action</a></li>
							<li class="divider"></li>
							<li><a href="#">Administration</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li class="active">Machining</li>
	</ol>
	<div class="container-fluid">
		<!-- Stack the columns on mobile by making one full-width and the other half-width -->
		<div class="row">
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-5"><h4>Parent Part Number:</h4></div>
					<div class="col-md-6"><input type="text" class="form-control" placeholder="Enter part number"></div>
				</div>
				<div class="row">
<dl class="dl-horizontal">
  <dt>12345</dt>
  <dd>Tall cabinet</dd>
  <dt>67890</dt>
  <dd>Short cabinet</dd>
</dl>
			
<ul>
    <li><span class="Collapsable" style="cursor:pointer">item 1</span><ul>
        <li><span class="Collapsable">item 1</span></li>
        <li><span class="Collapsable" style="cursor:pointer">item 2</span><ul>
            <li><span class="Collapsable">item 1</span></li>
            <li><span class="Collapsable">item 2</span></li>
            <li><span class="Collapsable">item 3</span></li>
            <li><span class="Collapsable">item 4</span></li>
        </ul>
        </li>
        <li><span class="Collapsable">item 3</span></li>
        <li><span class="Collapsable" style="cursor:pointer">item 4</span><ul>
            <li><span class="Collapsable">item 1</span></li>
            <li><span class="Collapsable">item 2</span></li>
            <li><span class="Collapsable">item 3</span></li>
            <li><span class="Collapsable">item 4</span></li>
        </ul>
        </li>
    </ul>
    </li>
    <li><span class="Collapsable" style="cursor:pointer">item 2</span><ul>
        <li><span class="Collapsable">item 1</span></li>
        <li><span class="Collapsable">item 2</span></li>
        <li><span class="Collapsable">item 3</span></li>
        <li><span class="Collapsable">item 4</span></li>
    </ul>
    </li>
    <li><span class="Collapsable" style="cursor:pointer">item 3</span><ul>
        <li><span class="Collapsable">item 1</span></li>
        <li><span class="Collapsable">item 2</span></li>
        <li><span class="Collapsable">item 3</span></li>
        <li><span class="Collapsable">item 4</span></li>
    </ul>
    </li>
    <li><span class="Collapsable">item 4</span></li>
</ul>
					
					
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<table class="table table-hover">
						<tr>
							<th>Work Center</th>
							<th>Machine</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
						<tr>
							<td>221</td>
							<td>BAZ 1</td>
							<td>6m 32s</td>
							<td>
								<button type="button" class="btn btn-success btn-xs">Start</button>
								<button type="button" class="btn btn-danger btn-xs" disabled="disabled">Stop</button></td>
						</tr>
					</table>
				</div>
			
			</div>
		</div>
		
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript">
		var toggle = function () {
				$(this).parent().children().toggle();
				$(this).toggle();
			};
		$(".Collapsable").click(toggle);
		$(".Collapsable").each(toggle)
	</script>

</body>
</html>