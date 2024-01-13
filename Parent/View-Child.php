
<?php include('../templates/Header.php'); ?>
<?php include('../Parent_appointment/child_list.php'); ?>


<!DOCTYPE html>
<html>
    <?php include('../include/include.php'); ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
rel="stylesheet">
<link rel="stylesheet" href="./css/style3.css">

<body>
    <div class="dash-container">
        <!--------------------------------Start OF SIDE BAR-------------------------------->
         <?php include('../include/sidebar.php'); ?>
         <!--------------------------------END OF SIDE BAR-------------------------------->
         <main>
            <div class="data-board" >
                <img src="./images/Childs Data.png">
            <div class="data-board-text">
                <h1>CHILD'S DATA</h1>
            </div>
       
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <select class="form-select" id="select_child">
                        <option >-- Select --</option>
                        <?php foreach($child_list as $value){?>
                            <option value="<?php echo $value['cid']; ?>"><?php echo $value['child_firstname']." ".$value['child_lastname']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-lg-8"> </div>
            </div>



            <script>
            $(document).ready(function(){
                $("#select_child").on("change",function(){
                    var cid = $(this).val();
                   
                    $.ajax({
                        url:'../Parent_appointment/selected_child.php',
                        type:'POST',
                        data:{
                            cid: cid
                        },
                        success:function(result){
                            console.log(result);
                            window.location.href= "../Parent/Select_child_data.php"
                        }   
                    });
                });
            });
            </script>

            </div>           
        </main>
        
        <!--------------------------------END OF MAIN-------------------------------->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
        </div>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the element by its ID
        var more_detail_btn = document.getElementById("more_details-<?php echo $cid; ?>");
        var more_details_container = document.getElementById("more_details_container");
        var cid_hidden = document.getElementById("cid-hidden");
        var close = document.getElementById("close");
        more_detail_btn.onclick = function() {
            // Extract the value from the element's ID
            var id = more_detail_btn.id; 
            var cid = id.split('-')[1];
            //Set the hiddenid of child to textbox will use for where statement in fetching data
            cid_hidden.value = cid;
            //display block the container
            more_details_container.style.display = "block";
        };


        close.onclick = function() {
            cid_hidden.value = "";
            more_details_container.style.display = "none";
        };
    });
    </script>
    <script src="./js/index.js"></script>
</body>
</html>
