
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
            <div class="val-box-vaccine-stocks">
                <i class="fas fa-syringe"></i>
                <div>
                    <h3><?php echo $stocks; ?></h3>
                    <span>total stock of vaccine</span>
                </div>
            </div>
            <div class="val-box-administered-vaccines">
                <i class="fas fa-hand-holding-medical"></i>
                <div>
                    <h3><?php echo $vaccine_administer; ?></h3>
                    <span>administered vaccines</span>
                </div>
            </div>
            <div class="val-box-appointment-today">
                <i class="fas fa-bell-slash"></i>
                <div>
                    <h3><?php echo $missed_appointment; ?></h3>
                    <span>appointment today</span>
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

        <div class="appointment-table data-table">
            <div class="appointment-table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Child Name</th>
                            <th>Administrator</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Marijo Pedian</td>
                            <td>Dr. Conanan</td>
                            <td>01/24/24</td>
                            <td>09:00am</td>
                        </tr>
                        <tr>
                            <td>Xavier Coloma</td>
                            <td>Dr. Talagtag</td>
                            <td>02/10/24</td>
                            <td>09:00am</td>
                        </tr>
                        <tr>
                            <td>Yves Conanan</td>
                            <td>Dr. Coloma</td>
                            <td>02/10/24</td>
                            <td>10:00am</td>
                        </tr>
                        <tr>
                            <td>Harold Talagtag</td>
                            <td>Dr. Pedian</td>
                            <td>02/18/24</td>
                            <td>09:00am</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="vaccine-table data-table">
            <div class="vaccine-table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BCG</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HepB</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>DTaP</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HiB</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>IPV</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>PCV</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>Rotavirus</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>MMR</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>Influenza</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HepA</td>
                            <td>150</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="administered-table data-table">
            <div class="administered-table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Administered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BCG</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HepB</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>DTaP</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HiB</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>IPV</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>PCV</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>Rotavirus</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>MMR</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>Influenza</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td>HepA</td>
                            <td>150</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</div>

    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var administered = document.getElementById('administered').getContext('2d');
        // Assuming the total number of registered children is 40 (10 + 24 + 6)
        var totalRegisteredChildren = 40;

        // Calculate the percentage values for each status
        var fullyVaccinatedPercentage = ((10 / totalRegisteredChildren) * 100).toFixed(2);
        var partiallyVaccinatedPercentage = ((24 / totalRegisteredChildren) * 100).toFixed(2);
        var notVaccinatedPercentage = ((6 / totalRegisteredChildren) * 100).toFixed(2);

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Fully Vaccinated ' + fullyVaccinatedPercentage + '%',
                    'Partially Vaccinated ' + partiallyVaccinatedPercentage + '%',
                    'Not Vaccinated ' + notVaccinatedPercentage + '%'
                ],
                datasets: [{
                    label: 'Vaccination Status of Registered Children',
                    data: [10, 24, 6],
                    backgroundColor: [
                        '#F0EA22',
                        '#FFCB0E',
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
                        '#5AB9EA'
                    ],
                }]
            },
            options: {
                responsive: true,
            }
        });       
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to toggle the display of the corresponding table
            function toggleTable(valueBoxClass, tableClass) {
                const valueBox = document.querySelector(valueBoxClass);
                const table = document.querySelector(tableClass);

                valueBox.addEventListener('click', function () {
                    // Hide the previously displayed table
                    const allTables = document.querySelectorAll('.data-table');
                    allTables.forEach((t) => {
                        if (t !== table) {
                            t.style.display = 'none';
                        }
                    });

                    // Toggle the display of the corresponding table
                    table.style.display = (table.style.display === 'none' || table.style.display === '') ? 'block' : 'none';

                    // Scroll down to the table section with a smooth animation if the table is displayed
                    if (table.style.display === 'block') {
                        table.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }

            // Call the function for each value box and corresponding table
            toggleTable('.val-box-vaccine-stocks', '.vaccine-table');
            toggleTable('.val-box-administered-vaccines', '.administered-table');
            toggleTable('.val-box-appointment-today', '.appointment-table');
        });
    </script>

</body>
</html>
