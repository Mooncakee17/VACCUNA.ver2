<?php 
include '../Homepage/config.php';
	session_start();
	$userid = $_SESSION['user_id'];
	$searchBy = $_POST['searchBy'];
    

	$search_by = "";
	 if($searchBy == 3){
		$searchData = $_POST['searchData'];

	//eto yung query pang basis mo
		$selectvac = mysqli_query($conn, "SELECT * FROM appointmenttable a
		LEFT JOIN vaccineinventory b ON a.vacid = b.vacid WHERE CONCAT(status_desc, vac_name) LIKE '%$searchData%' ORDER BY appointment_status ASC") or die('query failed');
    
     }
	$search_record = mysqli_fetch_all($selectvac, MYSQLI_ASSOC);


    	$html = "";
    	$html .= "<div class='table_section' style='position:relative; transform:translate(-8px,-8px);'>";
    	$html .= '<div class="row"  style="position:relative; left:80px;">';
    	$html .= "<table class='table border-3' id='data_table' >";
    	$html .= "<thead class='p-3 fs-7 text-center text-white text-uppercase'>";
    	$html .= "<tr>";
    	$html .= "<th class='col col-auto ps-2 pe-2 text-uppercase'>ID</th>
				<th class='col col-auto ps-2 pe-2 text-uppercase'>CHILD NAME</th>
				<th class='col col-auto ps-2 pe-2 text-uppercase'>VACCINE NAME</th>
				<th class='col col-auto ps-2 pe-2 text-uppercase'>STATUS</th>
				<th class='col col-auto ps-2 pe-2 text-uppercase'>DATE</th>
                <th class='col col-auto ps-2 pe-2 text-uppercase'>VACCINE ADMINISTER</th>
				";

    	$html .= "</tr>";
    	$html .= "</thead>";
    	$html .= "<tbody class='p-3 fs-7 text-white text-center'>";
	    foreach($search_record as $value){
	    	$appt_id = $value['appt_id'];
	    		$appt_status_str = '';
	    		if($value['appointment_status'] == 1){
	    			$appt_status_str = 'For Approval';
	    		}
	    		else if($value['appointment_status'] == 2){
	    			$appt_status_str = 'Completed';
	    		}
	    		else if($value['appointment_status'] == 3){
	    			$appt_status_str = 'Missed Appointment';
	    		}
	    		else if($value['appointment_status'] == 5){
	    			$appt_status_str = 'Walkin';
	    		}	    			    		
	    	$html.= "<tr>";
	    			$html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$value['appt_id']."</td>";
	    			$html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$value['child_name']."</td>";
	    		    $html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$value['vac_name']."</td>";
	    			$html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$appt_status_str."</td>";
	    			$html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$value['appt_date']."</td>";
                    $html .= "<td class='col col-auto ps-2 pe-2 text-uppercase'>".$value['vaccine_administer']."</td>";

			  
	    	$html.= "</tr>";

			$html .= "
			<script type=\"text/javascript\">
			    // JavaScript to open the modal
			    document.getElementById('update_record-$appt_id').addEventListener('click', function() {
			        var appt_id = this.id; 
			        appt_id = appt_id.split('-')[1];
			        $.ajax({
			            url: '../Admin_appointment/individual_appointment.php',
			            type: 'POST',
			            data: { appt_id: appt_id },                                                
			            success: function(response) {
			                if(response.status == 'success'){
			                    $('#userid').val($userid);
			                    $('#appt_id').val(appt_id);
			                    $('#vacid').val(response.vacid);
			                    $('#cid').val(response.cid);
			                    $('#child_name').val(response.child_name);
			                    $('#contact').val(response.contact_number);
			                    $('#child_age').val(response.age);
			                    $('#email').val(response.email);
			                    $('#mother_name').val(response.guardian_name);
			                    $('#appointment_date').val(response.appt_date);
			                    $('#appointment_time').val(response.appt_time);
			                    $('#vaccine_administer').val(response.vac_name);
			                    $('#dosage').val(response.dose);
			                    $('#dose').val(response.dose);
			                    $('#doctor').val(response.doctor);
			                    $('#for_reason').val(response.for_reason);
			                    if(response.for_reason == 'Consultation'){
			                        $('#vaccine_name').css('display', 'none');
			                        $('#vaccine_dose').css('display', 'none');
			                    }
			                    $('#update_appointment').modal('show');
			                }
			            }
			        });
			    });

			    document.getElementById('back_update_appointment').addEventListener('click', function() {
			        $('#appt_id').val('');
			        $('#update_appointment').modal('hide');
			    });
			</script>
			";


	$html .= '<script>
	     document.getElementById("view_details-' . $appt_id . '").addEventListener("click", function() {
	        var more_details_container = document.getElementById("more_details_container");
	        var cid_hidden = document.getElementById("cid-hidden");
	        var close = document.getElementById("close");
	        
	           	var appt_id = this.id; 
	            var appt_id = appt_id.split("-")[1];
	            $.ajax({
	                url: \'../Admin_appointment/individual_appointment.php\',
	                type: \'POST\',
	                data: { appt_id: appt_id },
	                success: function(response) {
	                    console.log($("#cid_hidden").val());
	                    cid_hidden.value = response.cid;
	                    more_details_container.style.display = "block";
	                }
	            });
	  
	    });
	</script>';

    $html .= '
            <script type="text/javascript">
            document.getElementById("send_notif-' . $appt_id . '").addEventListener("click", function() {
                var appt_id = this.id; 
                appt_id = appt_id.split("-")[1];
                $("#notify_appt").val(appt_id);
                $("#notify_applicant").modal("show");
            });
          
            </script>
        ';

	    }
    	$html .= "</tbody>";
    	$html .= "</table>";
    	$html .="</div></div>";

    	echo $html;
?>