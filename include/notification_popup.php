    <?php 
        $select = mysqli_query($conn, "SELECT * FROM usertable where userid = '$userid' ") or die('query failed');

        $get_notification = mysqli_fetch_all($select, MYSQLI_ASSOC);
        foreach ($get_notification as $info) {
            $is_notified = $info['is_notified'];
        }       
        if($is_notified == 1){
    ?>
    <form action="../Parent_appointment/received_notification.php" method="POST">
        <!--Notification-->
        <input type="text" value="<?php echo $userid; ?>" name="notif_userid" />
        <div class="card w-25" style="position:fixed; left:550px; top:90px;">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            Good day, This is Admin of Vaccuna Website, This message is to notified you that you have upcoming Appointmen Thank you .
                        </div>
                    </div>
                     <div class="row mt-3">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-lg btn-primary">Confirm to Close</button>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </form>
    <?php }?>