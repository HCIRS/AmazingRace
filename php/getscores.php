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
    header('Content-Type: application/json');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>