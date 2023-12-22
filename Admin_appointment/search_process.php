<?php 
include '../Homepage/config.php';
	$search_data = $_POST['search_data'];
    $select = mysqli_query($conn, "SELECT * FROM `childtable` 
    	WHERE CONCAT(child_firstname, child_lastname, mothername, birthdate, cid, gender) LIKE '%$search_data%'") or die('query failed');
    $search_record = mysqli_fetch_all($select, MYSQLI_ASSOC);

    	$html = "";
    	$html .= "<table>";
    	$html .= "<thead>";
    	$html .= "<tr>";
    	$html .= "<th>ID</th>
				<th>CHILD NAME</th>
				<th>SEX</th>
				<th>BIRTHDATE</th>
				<th>PARENT/GUARDIAN</th>
				<th>ACTION</th>";
    	$html .= "</tr>";
    	$html .= "</thead>";
    	$html .= "<tbody>";
	    foreach($search_record as $value){
	    	$html.= "<tr>";
	    			$html .= "<td>".$value['cid']."</td>";
	    			$html .= "<td>".$value['child_firstname']." ".$value['child_lastname']."</td>";
	    			$html .= "<td>".$value['gender']."</td>";
	    			$html .= "<td>".$value['birthdate']."</td>";
	    			$html .= "<td>".$value['mothername']."</td>";
	    			$html .= "<td>".'<a href="Report-Details.php?id={$value["cid"]} "><i class="fas fa-eye"></i></a>'."</td>";
	    	$html.= "</tr>";
	    }
    	$html .= "</tbody>";
    	$html .= "</table>";


    	echo $html;
?>