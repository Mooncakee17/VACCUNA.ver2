<?php include('../templates/Header.php'); ?>
<?php include('../Admin_appointment/vaccine_details.php'); ?> 
<link rel="stylesheet" href="./css/style6.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Vaccine inventory.png">
            <div class="dashboard-text">
                    
                <h1>VACCINE RECORDS</h1>
               
            </div>
            </div>
            <div class="table2">
            <div class="table2_section">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>VACCINE</th>
                            <th>BATCH NUMBER </th>
                            <th>ADMINISTERED VACCINE</th>
                            <th>DESCRIPTION</th>
                            <th>EXPIRATION DATE</th>
                            <th>Active Status</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($vaccine_list as $value){
                                $vacid = $value['vacid'];
                        ?>
                        <tr>
                            <td><?php echo $value['vacid']; ?></td>
                            <td><?php echo $value['vac_name']; ?></td>
                            <td><?php echo $value['batch_no']; ?></td>
                            <td><?php echo $value['administered']; ?></td>
                            <td><?php echo $value['vac_desc']; ?></td>
                            <td><?php echo $value['exp_date']; ?></td>
                            <td><?php if($value['active'] == 1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                            <td>
                                <button id="update_vaccine-<?php echo $vacid ; ?>"><i class="fas fa-edit"></i></button>
                                <button id="delete_vaccine-<?php echo $vacid ; ?>"><i class="fas fa-trash"></i></button>
                                <button id="add_vaccine-<?php echo $vacid ; ?>"><i class="fas fa-plus"></i></button>

                                <div id="editModal" class="modal">
                                    <div class="editModal2-content">
                                 
                                            <div class="user-details">
                                                <div class="input-box">
                                                    <span class="details">ID</span>
                                                    <input type="text" name="vaccine_id" id="vaccine_id" placeholder="Vaccine ID" value="<?php echo $value['vacid']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Vaccine</span>
                                                    <input type="text" name="vaccine_name"  id="vaccine_name"  placeholder="Vaccine type" value="<?php echo $value['vac_name']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Stocks</span>
                                                    <input type="text" name="vaccine_stock" id="vaccine_stock" placeholder="Total vaccine stocks" value="<?php echo $value['stocks']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Administered Vaccine</span>
                                                    <input type="text" name="vaccine_administered" id="vaccine_administered" placeholder="Total of administered vaccine" value="<?php echo $value['administered']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Description</span>
                                                    <input type="text" name="vaccine_description" id="vaccine_description" placeholder="Description of vaccine" value="" required>
                                                </div>

                                                <div class="input-box">
                                                    <span class="details">Status</span>
                                                    <select class="selectedstatus">
                                                          <option value="1" >Active</option>
                                                          <option value="0" >Inactive</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <button id="close_update">Close</button>
                                            <button id="update_modal" onclick="update_vaccine();">Update</button>
                                      
                                    </div>
                                  </div>
                            

                                <div id="addModal" class="modal">
                                    <div class="addModal2-content">
                                 
                                            <div class="user-details">
                                                <div class="input-box">
                                                    <span class="details">ID</span>
                                                    <input type="text" name="batch_vaccine_id" id="batch_vaccine_id" placeholder="Vaccine ID" value="<?php echo $value['vacid']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Vaccine Batch No </span>
                                                    <input type="text" name="batch_no"  id="batch_no"  placeholder="Batch Number"  required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Vaccine Expiration Date</span>
                                                    <input type="date" name="batch_vax_exp"  id="batch_vax_exp"  placeholder="Vaccine type" v required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Vaccine</span>
                                                    <input type="text" name="vaccine_name"  id="batch_vaccine_name"  placeholder="Vaccine type" value="<?php echo $value['vac_name']; ?>" required>
                                                </div>
                                                <div class="input-box">
                                                    <span class="details">Stocks</span>
                                                    <input type="text" name="vaccine_stock" id="batch_vaccine_stock" placeholder="Total vaccine stocks"  required>
                                                </div>
                                            </div>
                                            <button id="close_add">Close</button>
                                            <button id="add_vaccine" onclick="add_vaccine();">Add</button>
                                      
                                    </div>
                                  </div>





                                <div id="trashModal" class="modal">
                                    <div class="trashModal-content">
                                      <h2>This action cannot be undone. Are you sure you want to delete this record?</h2>
                                      <input type="hidden" id="trashid"/ >
                                      <button id="delete_vaccine" onclick="delete_vaccine();">Delete</button>
                                      <button id="close_trash_modal">Close</button>
                                    </div>
                                  </div>
                            </td>
                        </tr>
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                        <!-- Include Bootstrap JavaScript and Popper.js from a CDN -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                        <script type="text/javascript">
                        // JavaScript to open the modal Wag alisin sa loob ng loop para makuha yung vacid!
                        document.getElementById('delete_vaccine-<?php echo $vacid ; ?>').addEventListener('click', function() {
                            var trash_vacid = this.id; 
                            trash_vacid = trash_vacid.split('-')[1];
                            $("#trashid").val(trash_vacid);
                            var modal = document.getElementById('trashModal');
                            modal.style.display = "block";
                        });



                        // JavaScript to open the modal Wag alisin sa loob ng loop para makuha yung vacid!
                        document.getElementById('update_vaccine-<?php echo $vacid ; ?>').addEventListener('click', function() {
                            var update_vaccine = this.id; 
                            update_vaccine = update_vaccine.split('-')[1];
                             $.ajax({
                                url:'../Admin_appointment/get_vaccine_details.php',
                                type:'POST',
                                data:{update_vaccine:update_vaccine},
                                success:function(response){
                                    if(response.status == "success"){
                                        $("#vaccine_id").val(response.vacid);
                                        $("#vaccine_name").val(response.vac_name);
                                        $("#vaccine_stock").val(response.stocks);
                                        $("#vaccine_administered").val(response.administered);
                                        $("#vaccine_description").val(response.vac_desc);
                                        if (response.active == 1) {
                                            $(".selectedstatus").val('1'); // Set "Active" as selected
                                        } else {
                                        
                                            $(".selectedstatus").val('0'); // Set "Inactive" as selected
                                        }
                                        var modal = document.getElementById('editModal');
                                        modal.style.display = "block";
                                    }
                                    else{
                                        alert(response);
                                    }
                                }
                            });                           
                        });




                        // JavaScript to open the modal add batch
                        document.getElementById('add_vaccine-<?php echo $vacid ; ?>').addEventListener('click', function() {

                            var add_vaccine = this.id; 
                            add_vaccine = add_vaccine.split('-')[1];

                             $.ajax({
                                url:'../Admin_appointment/get_vaccine_details.php',
                                type:'POST',
                                data:{update_vaccine:add_vaccine},
                                success:function(response){
                               
                                    if(response.status == "success"){
                                        $("#add_vaccine_id").val(response.vacid);
                                        $("#add_vaccine_name").val(response.vac_name);
                                        var modal = document.getElementById('addModal');
                                        modal.style.display = "block";
                                    }
                                    else{
                                        alert(response);
                                    }
                                }
                            });                           
                        });





                        </script>



                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

    <script src="./js/index.js"></script>
    <!--modal-->
    <script type="text/javascript">
            document.getElementById('close_trash_modal').addEventListener('click', function() {
                console.log("test4")
                var modal = document.getElementById('trashModal');
                modal.style.display = "none";
            });   


            document.getElementById('close_update').addEventListener('click', function() {
                console.log("test4")
                var modal = document.getElementById('editModal');
                modal.style.display = "none";
            });  


            document.getElementById('close_add').addEventListener('click', function() {
                console.log("test4")
                var modal = document.getElementById('addModal');
                modal.style.display = "none";
            });         
            

    </script>
    <!--Process-->
    <script type="text/javascript">
    function delete_vaccine(){
                const vac_trashid = $("#trashid").val();
                $.ajax({
                    url:'../Admin_appointment/delete_vaccine.php',
                    type:'POST',
                    data:{vac_trashid:vac_trashid},
                    success:function(response){
                        if(response == 1){
                            alert("Vaccine Successfully Remove to active list");
                            window.location.href="VaccineInventory-TAB.php"
                        }
                        else{
                            alert(response);
                        }
                    }
                });
    }


    function update_vaccine(){
                const vaccine_id = $("#vaccine_id").val();
                const vaccine_name = $("#vaccine_name").val();
                const vaccine_stock = $("#vaccine_stock").val();
                const vaccine_administered = $("#vaccine_administered").val();
                const vaccine_description = $("#vaccine_description").val();
                const vaccine_status = $(".selectedstatus").val();
      
                $.ajax({
                    url:'../Admin_appointment/update_vaccine.php',
                    type:'POST',
                    data:{
                        vaccine_id:vaccine_id,
                        vaccine_name:vaccine_name,
                        vaccine_stock:vaccine_stock,
                        vaccine_administered:vaccine_administered,
                        vaccine_description:vaccine_description,
                        vaccine_status:vaccine_status
                    },
                    success:function(response){
                        if(response == 1){
                            alert("Vaccine Successfully Update Vaccine");
                            window.location.href="VaccineInventory-TAB.php"
                        }
                        else{
                            alert(response);
                        }
                    }
                });
       
    }




    function add_vaccine(){
                const batch_vaccine_id = $("#batch_vaccine_id").val();
                const batch_no = $("#batch_no").val();
                const batch_vax_exp = $("#batch_vax_exp").val();
                const batch_vaccine_name = $("#batch_vaccine_name").val();
                const batch_vaccine_stock = $("#batch_vaccine_stock").val();
      
                $.ajax({
                    url:'../Admin_appointment/add_vaccine_batch.php',
                    type:'POST',
                    data:{
                        batch_vaccine_id:batch_vaccine_id,
                        batch_no:batch_no,
                        batch_vax_exp:batch_vax_exp,
                        batch_vaccine_name:batch_vaccine_name,
                        batch_vaccine_stock:batch_vaccine_stock,
                    },
                    success:function(response){
                        if(response == 1){
                            alert("Successfully Added Vaccine");
                            window.location.href="VaccineInventory-TAB.php"
                        }
                        else{
                            alert(response);
                        }
                    }
                });
       
    }



 
    </script>
</body>
</html>
