
<?php include('../templates/Header.php'); ?>
<?php include('../Admin_appointment/admin_dashboard.php'); ?>

<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
        <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Appointment.png">
            <div class="dashboard-text">
                    
                 <?php
                    $select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
                     if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                    }      
                    ?>
                <h1>Hi <?php echo $fetch['firstname']; ?>! </h1>
               
            </div>
            </div>

        <div class="values">
            <div class="val-box">
                <i class="fas fa-syringe"></i>
                <div>
                    <h3><?php echo $stocks; ?></h3>
                    <span>vaccines</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-hand-holding-medical"></i>
                <div>
                    <h3><?php echo $vaccine_administer; ?></h3>
                    <span>administered vaccines</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-bell-slash"></i>
                <div>
                    <h3><?php echo $missed_appointment; ?></h3>
                    <span>missed appointments</span>
                </div>
            </div>
        </div>

        <div class="values">
              <div class="row">
                  <div class="col"><label class="fs-1">Vaccine Name</label></div>
                  <div class="col">
                    <form action="../Admin_appointment/generate_vaccine_data.php" name="form1" target="_blank" method="POST">
                      <select name="vaccine_name" style="width: 100%; height:30px; margin-bottom:10px; border:1px solid black;">
                          <option value="1">ALL</option>
                          <option value="BCG">BCG</option>
                          <option value="HepB">HepB</option>
                          <option value="DTap">DTap</option>
                          <option value="HiB">HiB</option>
                          <option value="IPV">IPV</option>
                          <option value="PCV">PCV</option>
                          <option value="Rota">Rota</option>
                          <option value="Influenza">Influenza</option>
                          <option value="MMR">MMR</option>
                          <option value="MenB">MenB</option>
                          <option value="Vericella">Vericella</option>
                          <option value="HepA">HepA</option>
                          <option value="HPV">HPV</option>
                      </select>
                    <button type="submit" id="generate_csv" name="generate_csv" style="height:40px; margin:5px; padding:2px; width:100%; cursor:pointer;">Generate CSV</button>
                    </form>
                  </div>             
              </div>
        </div>

        <div class="graphbox">
            <div class="box">
                <canvas id="myChart"></canvas>
            </div>
            <div class="box">
                <canvas id="administered"></canvas>
            </div>
        </div>
        </div>
</div>

    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var administered = document.getElementById('administered').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['BCG', 'HepB', 'DTap', 'HiB', 'iPV', 'PCV', 'RV', 'Influenza', 'MMR', 'MenB', 'Vericella', 'HepA', 'HPV'],
                datasets: [{
                    label: 'Vaccine Stocks by Type',
                    data: [
                    <?php echo $bcg_administered; ?>, 
                    <?php echo $hepb_administered; ?>, 
                    <?php echo $dtap_administered; ?>, 
                    <?php echo $hib_administered; ?>, 
                    <?php echo $ipv_administered; ?>, 
                    <?php echo $pcv_administered; ?>, 
                    <?php echo $rota_administered; ?>, 
                    <?php echo $flu_administered; ?>, 
                    <?php echo $mmr_administered; ?>, 
                    0, 
                    0, 
                    <?php echo $hepa_administered; ?>, 
                    0
                    ],
                    backgroundColor: [
                        '#F0EA22',
                        '#FFCB0E',
                        '#F79020',
                        '#F26324',
                        '#ED2227',
                        '#EA1D64',
                        '#C21B79',
                        '#613191',
                        '#263A94',
                        '#1C60AD',
                        '#10A1C5',
                        '#24AF4B',
                        '#89C541'
                    ],
                }]
            },
            options: {
                responsive: true,
            }
        });

        var myChart = new Chart(administered, {
            type: 'bar',
            data: {
                labels: ['BCG', 'HepB', 'DTap', 'HiB', 'iPV', 'PCV', 'RV', 'Influenza', 'MMR', 'MenB', 'Vericella', 'HepA', 'HPV'],
                datasets: [{
                    label: 'Administered Vaccine',
                    data: [
                    <?php echo $bcg_administered; ?>, 
                    <?php echo $hepb_administered; ?>, 
                    <?php echo $dtap_administered; ?>, 
                    <?php echo $hib_administered; ?>, 
                    <?php echo $ipv_administered; ?>, 
                    <?php echo $pcv_administered; ?>, 
                    <?php echo $rota_administered; ?>, 
                    <?php echo $flu_administered; ?>, 
                    <?php echo $mmr_administered; ?>, 
                    0, 
                    0, 
                    <?php echo $hepa_administered; ?>, 
                    0],
                    backgroundColor: [
                        '#F0EA22',
                        '#FFCB0E',
                        '#F79020',
                        '#F26324',
                        '#ED2227',
                        '#EA1D64',
                        '#C21B79',
                        '#613191',
                        '#263A94',
                        '#1C60AD',
                        '#10A1C5',
                        '#24AF4B',
                        '#89C541'
                    ],
                }]
            },
            options: {
                responsive: true,
            }
        });       
    </script>

</body>
</html>
