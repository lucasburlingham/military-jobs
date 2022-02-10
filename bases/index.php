<?php

include_once '../functions.php';

// Log all of the entries to the form
// DEBUG ONLY
// foreach ($_GET as $data) {
// 	consoleLog($data);
// }


// if branch is set, get it from the form
if(isset($_GET['branch'])) {
	$branch_query = $_GET['branch'];
}

// if the rank is set, get it from the form
if (isset($_GET['oconus'])) {
	$oconus_pretty = ucwords($_GET['oconus']);
	$oconus = $_GET['oconus'];
}

// Format table names for use in query
switch(isset($_GET['branch'])) {
	case ($_GET['branch']== "airforce"):
		$branch_query = 'airforce';
		break;
	case ($_GET['branch'] == "army"):
		$branch_query = 'army';
		break;
	case ($_GET['branch'] == "navy"):
		$branch_query = 'navy';
		break;
	case ($_GET['branch'] == "marines"):
		$branch_query = 'marines';
		break;
	case ($_GET['branch'] == "coastguard"):
		$branch_query = 'coastguard';
		break;
	default:
		break;
}


if(isset($_GET['oconus'])) {
	$query = "SELECT * FROM 'bases' WHERE branch LIKE '%". $branch_query . "%' AND oconus LIKE '". $oconus . "'";
} elseif(isset($_GET['branch'])) {
	$query = "SELECT * FROM 'bases' WHERE branch LIKE '%". $branch_query . "%'";
} else {
	$query = "SELECT * FROM 'bases'";
}

$state = "SELECT DISTINCT location FROM 'bases' WHERE oconus = 'no'";


$dir = 'sqlite:../db/bases-db.db';
$dbh  = new PDO($dir) or die("Cannot open the database");



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>USA Military Bases Around the World</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="../style.css">
	<?php
	include "../favicon.php";
	?>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<div class="container-fluid">
			<div class="navbar-brand" href="#">USA Military Base Search</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navab"
				aria-controls="navab" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navab">
				<div class="navbar-nav mr-6">
					<a class="nav-link" aria-current="page" href="/">Home</a>
					<a class="nav-link" aria-current="page" href="/pay/">Pay Scales</a>
					<a class="nav-link active" aria-current="page" href="/bases/">Bases</a>
					<div class="dropdown">
						<a class="btn btn-light dropdown-toggle" href="#" role="button" id="branchDropdown"
							data-bs-toggle="dropdown" aria-expanded="false">
							Branch Websites
						</a>
						<ul class="dropdown-menu" aria-labelledby="branchDropdown">
							<li>
								<a class="dropdown-item" target="_blank" href="https://goarmy.com">Army</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.airforce.com/">Air Force</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.marines.com/">Marine
									Corps</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.navy.com/">Navy</a>
							</li>
							<li>
								<a class="dropdown-item" target="_blank" href="https://www.gocoastguard.com/">Coast
									Guard</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<span class="navbar-text">
				Last Updated: 20220205
			</span>
		</div>
		</div>
	</nav>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" class="form-horizontal">
		<div class="container">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<section>
						<small class="text-muted">Select the branch you are looking for</small>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="airforce" id="airforce" name="branch">
							<label class="form-check-label" for="airforce">
								<i class="fa fa-fighter-jet" aria-hidden="true"></i> Air Force
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="army" id="army" name="branch">
							<label class="form-check-label" for="army">
								<i class="fa fa-star" aria-hidden="true"></i> Army
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="navy" id="navy" name="branch">
							<label class="form-check-label" for="navy">
								<i class="fa fa-ship" aria-hidden="true"></i> Navy
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="marines" id="marines" name="branch">
							<label class="form-check-label" for="marines">
								<i class="fa fa-globe-americas" aria-hidden="true"></i> Marines
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="marines" id="coastguard" name="branch">
							<label class="form-check-label" for="marines">
								<i class="fa fa-life-ring" aria-hidden="true"></i> Coast Guard
							</label>
						</div>
					</section>
					<section>
						<small class="text-muted">Is the base over seas (OCONUS)?</small>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="yes" id="oconusYes" name="oconus">
							<label class="form-check-label" for="oconusYes">
								<i class="fas fa-check-circle"></i> Yes
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="no" id="oconusNo" name="oconus">
							<label class="form-check-label" for="oconusNo">
								<i class="fas fa-times-circle"></i> No
							</label>
						</div>
					</section>
					<section>
						<small class="text-muted">Select state if not OCONUS: </small>
						<div class="form-check">
							<select class="form-control" id="state" name="state">
								<?php
										foreach ($dbh->query($state) as $row)
											{
												// DEBUG ONLY
												// consoleLog($row);
												echo "<option>" . $row[0] . "</option>";
											}
									?>
							</select>
						</div>
					</section>
					<section>
						<br>
						<button type="submit" class="btn btn-primary">Submit</button>
					</section>
	</form>
	<hr>
	<section id="result">
		<div class="text-secondary">
			<small>You chose:</small>
		</div>
		<?php
						$branch_pretty = ucwords($branch);

						echo "<b>Branch: </b><i>" . $branch_pretty . "</i><br>";
						echo "<b>ONOCUS: </b><i>" . $oconus_pretty . "</i><br>";
						echo "<b>Query: </b><code>" . $query . "</code><br>";
						echo "<b>Result: </b>";
						?>
		<table class="table table-secondary table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">Location</th>
					<th scope="col">Name</th>
					<th scope="col">OCONUS</th>
					<th scope="col">Branch</th>
				</tr>
			</thead>
			<?php
						foreach ($dbh->query($query) as $row)
							{
								// DEBUG ONLY
								// consoleLog($row);
								echo "<tr><th scope=\"row\">" . $row[0] . "</th><td>" . $row[1] . "</td><td>" . ucwords($row[2]) . "</td><td>" . ucwords($row[3]) . "</td></tr>";
							}
						$dbh = null;
						
						?>
		</table>
	</section>
	<hr>
	<div class="col-1"></div>
	<?php
		include '../footer.php';
	?>
</body>

</html>