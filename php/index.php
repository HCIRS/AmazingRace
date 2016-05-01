<!DOCTYPE html>
<html>

<head>
	<title>Math &amp; Science Week</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}

		main {
			flex: 1 0 auto;
		}
	</style>
	<script type="text/javascript">
		// JS
		//http://i.imgur.com/OKisbC3.png BLACK text
		//http://i.imgur.com/zIol3Wr.png BLACK text

		function changePage(value) {
			var mainDiv = document.getElementById("mainPage");
			var submitDiv = document.getElementById("submitFlagPage");
			var scoreDiv = document.getElementById("scorePage");

			switch (value.id) {
				case "mainbtn":
					mainDiv.style.display = "";
					submitDiv.style.display = "none";
					scoreDiv.style.display = "none";
					break;

				case "submitbtn":
					mainDiv.style.display = "none";
					submitDiv.style.display = "";
					scoreDiv.style.display = "none";
					break;

				case "scorebtn":
					mainDiv.style.display = "none";
					submitDiv.style.display = "none";
					scoreDiv.style.display = "";
					break;
			}
		}
	</script>
</head>

<body>
	<main>
		<nav>
			<div class="nav-wrapper">
				<!--a href="#" class="brand-logo center">Math &amp; Science Week '16</a-->
				<a href="#" class="brand-logo center"><img style="width:auto; height:64px;" src="https://i.imgur.com/zIol3Wr.png"></a>
			</div>
		</nav>

		<br>
		<div class="row">
			<div class="col s12">
				<center>
					<a id="scorebtn" onclick="changePage(this)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">assessment</i>Scoreboard</a>
					<a id="mainbtn" onclick="changePage(this)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">view_carousel</i>Main Page</a>
					<a id="submitbtn" onclick="changePage(this)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">chat</i>Submit Flags</a>
				</center>
			</div>
		</div>

		<div class="container">
			<div class="row" style="display:none;" id="mainPage">
				<center>
					<a href="#" class="brand-logo center"><img style="width:60vw; height:auto;" src="https://i.imgur.com/OKisbC3.png"></a>
					<h2>Instructions</h2>
				</center>
				<p>
					FILL THIS UP.
				</p>
			</div>

			<div class="row" id="submitFlagPage">
				<center>
					<a href="#" class="brand-logo center"><img style="width:auto; height:20vh;" src="http://zizaza.com/cache/big_thumb/iconset/582081/582089/PNG/256/flato/flag_web_corporate_flat_icon_png_flag_png_flag_icon.png"></a>
					<h2>Submit your flags</h2>
				</center>
			    <?php
			        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			            $submitted_flag = $_POST['flag'];
			            $submitted_name = strtoupper($_POST['name']);
			            
			            $db = new PDO('mysql:host=infocommsociety.com;dbname=ar2016;charset=utf8mb4', 'ar2016', 'ar2016');
			            $flagq = $db->prepare("SELECT * FROM flags WHERE name=?");
			            $flagq->execute(array($submitted_flag));
			            $flag = $flagq->fetchAll(PDO::FETCH_ASSOC);
			            
			            if($flag[0])
			            {
			                $entrystmt = $db->prepare("SELECT * FROM entries WHERE participant=? AND flag=?");
			                $entrystmt->execute(array($submitted_name, $flag[0]["id"]));
			                $entry = $entrystmt->fetchAll(PDO::FETCH_ASSOC);
			                if(!count($entry))
			                {
			                    $insertstmt = $db->prepare("INSERT INTO entries (flag, participant) VALUES ( ?, ? )");
			                    $insertstmt->execute(array($flag[0]["id"],$submitted_name ));
			                    echo "<h3>Correct Flag</h3>";
			                }
			                else
			                {
			                    echo "<h3>Already submitted</h3>";
			                }
			            }
			            else {
			                echo "<h3>No Such Flag!</h3>";
			            }
			        }
			    ?>
				<form method="post" id="submitflag">
				<div class="row">
					<div class="input-field col s6">
						<i class="material-icons prefix">account_circle</i>
						<input id="nric_input" type="text" name="name" class="validate">
						<label for="nric_input" class="">Your NRIC (for Score Tracking) Example: S9812345A </label>
					</div>
					<div class="input-field col s6">
						<i class="material-icons prefix">subtitles</i>
						<input id="flag_input" type="text" name="flag" class="validate">
						<label for="flag_input" class="">Input Your Flag ( Example: flag[H3LL0] )</label>
					</div>
				</div>
				<center>
					<a onclick="document.getElementById('submitflag').submit();" class="waves-effect waves-light btn-large"><i class="material-icons right">send</i>Verify My Flag!</a>
				</center>
				</form>
				
			</div>

			<div style="display:none;" class="row" id="scorePage">
				<center>
					<h2>SCORES</h2>
					<a class="waves-effect waves-light btn-large" id="refreshscores"><i class="material-icons right">send</i>Refresh</a>
					<table id="scoreboard">
						<thead>
							<tr>
								<th data-field="id">Name</th>
								<th data-field="name">Score</th>
							</tr>
						</thead>
						<tbody>
					    <?php
				            $db = new PDO('mysql:host=infocommsociety.com;dbname=ar2016;charset=utf8mb4', 'ar2016', 'ar2016');
				
				            $stmt = $db->query("SELECT participant, sum(points) AS totalpoints FROM 
								( 
									SELECT participant, points FROM entries 
									LEFT JOIN flags 
									ON entries.flag = flags.id 
									GROUP BY participant, flag
								) scores 
								GROUP BY participant
								ORDER BY totalpoints DESC");
				            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
				            {
				                echo "<tr>";
				                    echo "<td>". $row["participant"] . "</td>";
				                    echo "<td>". $row["totalpoints"] . "</td>";
				                echo "</tr>";
				            }
				        ?>
							<!--<tr>
								<td>Alvin</td>
								<td>800</td>
							</tr>
							<tr>
								<td>Alan</td>
								<td>200</td>
							</tr>
							<tr>
								<td>Jonathan</td>
								<td>100</td>
							</tr>-->
						</tbody>
					</table>
				</center>
			</div>
		</div>
	</main>

	<footer class="page-footer lol">
		<div class="footer-copyright">
			<div class="container">
				Hwa Chong Mathematics &amp; Science Week 2016 &copy; HCIRS/ragulbalaji
				<a class="grey-text text-lighten-4 right" href="https://infocommsociety.com">infocommsociety.com</a>
			</div>
		</div>
	</footer>

</body>
<script type="text/javascript">
	/*global $*/
	$(document).ready(function() {
		$("#refreshscores").click(function(){
			$.getJSON( "/getscores.php", function( data ) {
				$("#scoreboard tbody").empty();
				
				data.forEach(function(row){
					$("#scoreboard tbody").append(
						$("<tr>").append($("<td>").text(row.participant))
								 .append($("<td>").text(row.totalpoints))
					)
				})
			});
		});
	});
</script>

</html>