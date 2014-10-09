<?php
$folders = explode ('/', $_SERVER['PHP_SELF']);
$foler_count = count($folders);
if($foler_count > 3){
	$relative = "../";
}else{
	$relative = "";
}
////////////////URL's////////////////////
$url_home = $relative."index.php";
$url_logout = $relative."logout.php";
$url_machining = $relative."machining.php";
$url_settings = $relative."settings.php";
$url_admin = $relative."admin/admin.php";
$url_overview = $relative."reports/index.php";
$url_machine_reports = $relative."reports/machines.php";
$url_user_reports = $relative."reports/userreports.php";
$url_part_reports = $relative."reports/partreports.php";
$url_item_reports = $relative."reports/itemreport.php";

?>

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
			<a class="navbar-brand" href="#">Pin Time Study</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Part Timing <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Cutting</a></li>
						<li><a href="#">Edgebanding</a></li>
						<li><a href="<?php echo $url_machining; ?>">Machining</a></li>
						<li class="divider"></li>
						<li><a href="#">Assembly</a></li>
						<li class="divider"></li>
						<li><a href="#">Packaging</a></li>
					</ul>
				</li>
				<?php
					if($_SESSION['user_auth_level'] >= 3){
						echo "<li class=\"dropdown\">";
						echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Reports<span class=\"caret\"></span></a>";
						//echo "<li><a href=\"reports/index.php\">Reports</a></li>";
						echo "<ul class=\"dropdown-menu\" role=\"menu\">";
						echo "<li><a href=\"".$url_overview."\">Overview</a></li>";
						echo "<li><a href=\"".$url_machine_reports."\">Machine Reports</a></li>";
						echo "<li><a href=\"".$url_user_reports."\">User Reports</a></li>";
						echo "<li><a href=\"".$url_part_reports."\">Performed Studies</a></li>";
						echo "<li><a href=\"".$url_item_reports."\">Part Times</a></li>";
						echo "</ul></li>";
					}
					?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo $url_settings; ?>">Settings</a></li>
						<?php
						if($_SESSION['user_auth_level'] == 5){
						 echo "<li class=\"divider\"></li><li><a href=\"".$url_admin."\">Administration</a></li>";}
						?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<a href="<?php echo $url_logout ?>" class="btn btn-primary navbar-btn btn-xs">Sign Out</a>
			</ul>
			<p class="navbar-text navbar-right">Signed in as <a class="navbar-link" href="settings.php"><b><?php echo $_SESSION['user_first_name']." ".$_SESSION['user_last_name'] ?>&nbsp;</b></a></p>
 
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>