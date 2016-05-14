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
		
		#Notification {
			position: fixed;
			top: 5px;
			background-color: DarkSlateBlue;
			color: #ffffff;
			left: 5px;
			display: none;
			z-index:999;
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
			var registerDiv = document.getElementById("registerPage");

			switch (value) {
				case "mainbtn":
					mainDiv.style.display = "";
					submitDiv.style.display = "none";
					scoreDiv.style.display = "none";
					registerDiv.style.display = "none";
					location.hash = "mainbtn";
					break;

				case "submitbtn":
					mainDiv.style.display = "none";
					submitDiv.style.display = "";
					scoreDiv.style.display = "none";
					registerDiv.style.display = "none";
					location.hash = "submitbtn";
					break;

				case "scorebtn":
					mainDiv.style.display = "none";
					submitDiv.style.display = "none";
					scoreDiv.style.display = "";
					registerDiv.style.display = "none";
					location.hash = "scorebtn";
					break;
					
				case "registerbtn":
					mainDiv.style.display = "none";
					submitDiv.style.display = "none";
					scoreDiv.style.display = "none";
					registerDiv.style.display = "";
					location.hash = "registerbtn";
					break;
			}
		}
	</script>
</head>

<body>
<div id="Notification">...</div>
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
					<a id="scorebtn" onclick="changePage(this.id)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">assessment</i>Scoreboard</a>
					<a id="mainbtn" onclick="changePage(this.id)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">view_carousel</i>Main Page</a>
					<a id="registerbtn" onclick="changePage(this.id)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">perm_identity</i>Register</a>
					<a id="submitbtn" onclick="changePage(this.id)" class="waves-effect waves-light btn-large" style="margin-bottom:5px;"><i class="material-icons left">chat</i>Submit Flags</a>
				</center>
			</div>
		</div>

		<div class="container">
			<div class="row" id="mainPage">
				<center>
					<a href="#" class="brand-logo center"><img style="width:60vw; height:auto;" src="https://i.imgur.com/OKisbC3.png"></a>
					<h2>Instructions</h2>
				</center>
					<h5>
						Hunt around the Hwa Chong Campus this week to find our hidden puzzles and find their answers.
						Enter these answer in the flags box on the 'Submit Flags' Page with your NRIC, so that we can track your porgress.<br><br>
						Happy solving these Math and Science Problems!
					</h5>
				<center>
					<br><img style="width:15vw;" src="https://i.imgur.com/dtoRoyW.png">
					<img style="width:15vw;" src="https://i.imgur.com/6IZQ27K.png">
					<img style="width:15vw;" src="https://i.imgur.com/TkiVeAr.png">
					<img style="width:15vw;" src="http://i.imgur.com/6pOoKHu.jpg">
				</center>
			</div>
			
			<div class="row" style="display:none;" id="registerPage">
				<center>
					<h2>Register Account</h2>
				</center>
				<form method="post" id="registerMe">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input id="name_input" type="text" name="name" class="validate">
						<label for="name_input" class="">Your Name ( Example: Hon Chiew Weng )</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">subtitles</i>
						<input id="nric_input" type="text" name="nric" class="validate">
						<label for="nric_input" class="">Your NRIC ( Example: S9812345A )</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">phone</i>
						<input id="phone_input" type="text" name="phone" class="validate">
						<label for="phone_input" class="">Your Phone Number ( Example: 98123456 )</label>
					</div>
				</div>
				<center>
					<a onclick="document.getElementById('registerMe').submit();" class="waves-effect waves-light btn-large"><i class="material-icons right">send</i>Let Me Play!</a >
				</center>
				</form>
			    <?php
			        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])) {
			            $phone_input = $_POST['phone'];
			            $name_input = $_POST['name'];
			            $nric_input = strtoupper($_POST['nric']);
			            
			            $db = new PDO('mysql:host=infocommsociety.com;dbname=ar2016;charset=utf8mb4', 'ar2016', 'ar2016');
			            $registerq = $db->prepare("INSERT INTO participants (nric, name, phone) VALUES ( ? , ? , ?)");
			            $registerq->execute(array($nric_input, $name_input, $phone_input));
			            $registered = $registerq->fetchAll(PDO::FETCH_ASSOC);
			            echo "<script>setTimeout(function(){issueNotification('Registered!')}, 1000)</script>";
			        }
			    ?>
				
			</div>

			<div class="row" style="display:none;" id="submitFlagPage">
				<center>
					<a href="#" class="brand-logo center"><img style="width:auto; height:20vh;" src="http://zizaza.com/cache/big_thumb/iconset/582081/582089/PNG/256/flato/flag_web_corporate_flat_icon_png_flag_png_flag_icon.png"></a>
					<h2>Submit your flags</h2>
				</center>
			    <?php
			        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flag'])) {
			            $submitted_flag = $_POST['flag'];
			            $submitted_name = strtoupper($_POST['name']);
			            
			            $db = new PDO('mysql:host=infocommsociety.com;dbname=ar2016;charset=utf8mb4', 'ar2016', 'ar2016');
			            
			            $nameq = $db->prepare("SELECT * FROM participants WHERE nric=?");
			            $nameq->execute(array($submitted_name));
			            $name = $nameq->fetchAll(PDO::FETCH_ASSOC);
			            if($name[0])
			            {
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
				                    echo "<script>setTimeout(function(){issueNotification('Correct Flag')}, 1000)</script>";
				                }
				                else
				                {
				                    echo "<script>setTimeout(function(){issueNotification('Already submitted')}, 1000)</script>";
				                }
				            }
				            else {
				                echo "<script>setTimeout(function(){issueNotification('No Such Flag!')}, 1000)</script>";
				            }
			        	}
			        	else
			        	{
				            echo "<script>setTimeout(function(){issueNotification('Please register first!')}, 1000)</script>";
			        	}
			        }
			    ?>
				<form method="post" id="submitflag">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">account_circle</i>
						<input id="nric_input" type="text" name="name" class="validate">
						<label for="nric_input" class="">Your NRIC ( Example: S9812345A )</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">subtitles</i>
						<input id="flag_input" type="text" name="flag" class="validate">
						<label for="flag_input" class="">Input Your Flag a.k.a. Answer ( Example: thisisanexampleofaflag )</label>
					</div>
				</div>
				<center>
					<a onclick="document.getElementById('submitflag').submit();" class="waves-effect waves-light btn-large"><i class="material-icons right">send</i>Verify My Flag!</a>
				</center>
				</form>
				
			</div>

			<div style="display:none;" class="row" id="scorePage">
				<center>
					<h2>SCOREBOARD</h2>
					<a class="waves-effect waves-light btn-large" id="refreshscores"><i class="material-icons right">send</i>Refresh</a>
					<table id="scoreboard">
						<thead>
							<tr>
								<th data-field="id">NRIC / Name</th>
								<th data-field="name">Score</th>
							</tr>
						</thead>
						<tbody>
					    <?php
				            $db = new PDO('mysql:host=infocommsociety.com;dbname=ar2016;charset=utf8mb4', 'ar2016', 'ar2016');
				
				            $stmt = $db->query("
				            SELECT name, totalpoints FROM (
				            	SELECT participant, sum(points) AS totalpoints FROM 
								( 
									SELECT participant, points FROM entries 
									LEFT JOIN flags 
									ON entries.flag = flags.id 
									GROUP BY participant, flag
								) scores 
								GROUP BY participant
								ORDER BY totalpoints DESC
							) nricscores
							LEFT JOIN participants
							ON participants.nric = nricscores.participant");
				            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
				            {
				                echo "<tr>";
				                    echo "<td>". $row["name"] . "</td>";
				                    echo "<td>". $row["totalpoints"] . "</td>";
				                echo "</tr>";
				            }
				        ?>
						</tbody>
					</table>
				</center>
			</div>
		</div>
	</main>

	<footer class="page-footer lol">
		<div class="footer-copyright">
			<div class="container">
				Hwa Chong Mathematics &amp; Science Week 2016 &copy; HCIRS/ragulbalaji &amp; hojiefeng
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
			issueNotification("Scores Refreshed!");
		});
	});
	
	var notificationTimeout = null;

	function issueNotification(msg) {
		var elem = $("#Notification");
		elem.hide();
		elem.html("<font size=+4>" + msg + "</font>");
		elem.slideToggle('fast');
		if (notificationTimeout != null) clearTimeout(notificationTimeout);
		notificationTimeout = setTimeout(function() {
			notificationTimeout = null;
			$("#Notification").fadeOut('slow')
		}, 5000);
	}
	
	if(location.hash.substring(1) != ""){
		changePage(location.hash.substring(1));
	} 
</script>

</html>
