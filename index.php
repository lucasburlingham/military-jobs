<?php

include_once 'functions.php';

foreach ($_GET as $data) {
	consoleLog($data);
}

// Log all of the entries to the form

// if branch is set, get it from the form
if(isset($_GET['branch'])) {
	$branch_query = $_GET['branch'];
	$branch = $_GET['branch'];
} else {
	$branch = "*";
}

// if the rank is set, get it from the form
if (isset($_GET['rank'])) {
	$rank_query = ucwords($_GET['rank']);
	$rank = $_GET['rank'];
} else {
	$rank_query = "*";
}

// Format table names for use in query
switch(isset($branch)) {
	case ($branch == "airforce"):
		$branch_query = 'afsc-airforce';
		break;
	case ($branch == "army"):
		$branch_query = 'mos-army';
		break;
	case ($branch == "army"):
		$branch_query = 'mos-army';
		break;
		case ($branch == "army"):
		$branch_query = 'mos-army';
		break;
	default:
		$branch_query = 'mos-army';
		break;
}

if(isset($_GET['series']) && $branch = "army") {
	if ($_GET['series'] == "") {
		unset($_GET['series']);
	} else {
		$series_query = $_GET['series'] . "%";
		$series = $_GET['series'];
	}
	
}


// Only if the series is set, use the series data in the query
if(isset($series_query)) {
	$query = 'SELECT * FROM "' . $branch_query . '" WHERE "rank" = "' . $rank_query . '" AND "mos" LIKE "' . $series_query . '" ORDER BY "mos" ;';
	consoleLog("Query with series used");
	consoleLog("Query: " . $query);
} elseif(isset($rank_query)) {
	$query = 'SELECT * FROM "' . $branch_query . '" WHERE "rank" = "' . $rank_query. '";';
	consoleLog("Query without series used");
	consoleLog("Query: " . $query);
}


$dir = 'sqlite:mos-db.db';
$dbh  = new PDO($dir) or die("Cannot open the database");

?>
<html lang="en">

<head>
	<title>Military Job Consideration Tool</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="/style.css">
	<script src="/showSeries.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Military Jobs</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navab"
				aria-controls="navab" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navab">
				<div class="navbar-nav">
					<a class="nav-link active" aria-current="page" href="#">Home</a>
				</div>
			</div>
		</div>
	</nav>

	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" class="form-horizontal">
		<div class="container">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<section>
						<small class="text-muted">Select the branch(es) you are interested in, or omit this field
							altogether</small>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="airforce" id="airforce" name="branch">
							<label class="form-check-label" for="airforce">
								<i class="fa fa-fighter-jet" aria-hidden="true"></i> Air Force
							</label>
						</div>

						<input class="form-check-input" type="radio" value="army" id="army" name="branch">
						<label class="form-check-label" for="army">
							<i class="fa fa-star" aria-hidden="true"></i> Army
						</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="navy" id="navy" name="branch" disabled>
							<label class="form-check-label" for="navy">
								<i class="fa fa-ship" aria-hidden="true"></i> Navy
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="marines" id="marines" name="branch"
								disabled>
							<label class="form-check-label" for="marines">
								<i class="fa fa-globe-americas" aria-hidden="true"></i> Marines
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="marines" id="marines" name="branch"
								disabled>
							<label class="form-check-label" for="marines">
								<i class="fa fa-life-ring" aria-hidden="true"></i> Coast Guard
							</label>
						</div>
					</section>
					<section>
						<small class="text-muted">Select type of rank held</small>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="enlisted" id="enlisted" name="rank">
							<label class="form-check-label" for="enlisted">
								<i class="fa fa-warehouse" aria-hidden="true"></i> Enlisted
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" value="officer" id="officer" name="rank">
							<label class="form-check-label" for="officer">
								<i class="fa fa-graduation-cap" aria-hidden="true"></i> Officer
							</label>
						</div>
					</section>
					<section id="seriesSection">
						<small class="text-muted">Type in the series code (Army only; Optional)</small>
						<div class="form-check sm">
							<input type="number" class="form-control" name="series" placeholder="Army Series Code"
								aria-label="Army Series Code">
						</div>
					</section>
					<section>
						<br>
						<button type="submit" class="btn btn-primary">Submit</button>
					</section>
	</form>
	<hr>
	<section>
		<div class="text-secondary">
			<small>You chose:</small>
		</div>
		<?php
						$branch_pretty = ucwords($branch);
						$rank_pretty = ucwords($rank);

						echo "<b>Branch: </b>" . $branch_pretty . "<br>";
						echo "<b>Rank: </b>" . $rank_pretty . "<br>";
						echo "<b>Query: </b>" . $query . "<br>";
						echo "<b>Series: </b>" . $series . "<br>";
						echo "<b>Result: </b>";
						?>
		<table class="table table-secondary table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">Code</th>
					<th scope="col">Job Title</th>
					<th scope="col">Rank held</th>
				</tr>
			</thead>
			<?php
						
						foreach ($dbh->query($query) as $row)
							{
								consoleLog($row);
								echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
							}
						$dbh = null;
						
						?>
		</table>
	</section>
	<hr>
	<div class="col-1"></div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-4">
					&copy 2022
					<a href="https://github.com/lucasburlingham" style="color: black;"><i
							class="fab fa-github-square"></i></a> Lucas Burlingham
				</div>
				<div class="col-4"></div>
			</div>
		</div>
	</footer>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
		integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
		integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
	</script>
	<!-- FontAwesome 5.15.3 CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
		integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- (Optional) Use CSS or JS implementation -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
		integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>