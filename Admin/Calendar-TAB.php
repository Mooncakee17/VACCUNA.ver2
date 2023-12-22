<?php include('../templates/Header.php'); ?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/calendar-style.css">

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Calendar.png">
            <div class="dashboard-text">
                    
                <h1>CALENDAR</h1>
               
            </div>
            <div class="container">
            <div class="left">
              <div class="calendar">
                <div class="month">
                  <i class="fas fa-angle-left prev"></i>
                  <div class="date">december 2015</div>
                  <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">
                  <div class="goto">
                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                    <button class="goto-btn">Go</button>
                  </div>
                  <button class="today-btn">Today</button>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="today-date">
                <div class="event-day">wed</div>
                <div class="event-date">12th december 2022</div>
              </div>
              <div class="events"></div>
              <div class="add-event-wrapper">
                <div class="add-event-header">
                  <div class="title">Add Event</div>
                  <i class="fas fa-times close"></i>
                </div>
                <div class="add-event-body">
                  <div class="add-event-input">
                    <input type="text" placeholder="Doctor Administer" class="event-name" />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time From"
                      class="event-time-from"
                    />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time To"
                      class="event-time-to"
                    />
                  </div>
                </div>
                <div class="add-event-footer">
                  <button class="add-event-btn">Add Event</button>
                </div>
              </div>
            </div>
            <button class="add-event">
              <i class="fas fa-plus"></i>
            </button>
          </div>


            </div>
        </div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/Calendar.js"></script>
