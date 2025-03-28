        <?php
                include '../inc/db_conn.php'; 
                session_start();
                if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
                    header("Location: ../index.php");
                    exit;
                }
                $user_id = $_SESSION['id'];
                            $select = mysqli_query($conn, "SELECT * FROM `teacher` WHERE id ='$user_id'") or die('query failed');
                            if(mysqli_num_rows($select) > 0){
                                $admin = mysqli_fetch_assoc($select);
                            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     
    <title>ens-kech</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
                        <?php include 'header.php'?>

                    <!-- Page Content -->
                    

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">Students:</h3>
                                
                                <p class="fs-5 ms-5 " style="color: red;">
                                   <?php $select = mysqli_query($conn, "SELECT COUNT(student.classe)as mam,student.classe,teachclasse.classeid,teachclasse.teachid FROM student JOIN teachclasse on student.classe=teachclasse.classeid where $user_id=teachclasse.teachid") or die('query failed');
                                    $row = mysqli_fetch_assoc($select);
                                    echo $row['mam'];?>
                                </p>
                            </div>
                            <i class="fa-solid fa-graduation-cap fs-1 primary-text border rounded-full secondary-bg p-3 me-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">Classes:</h3>
                                
                                <p class="fs-5 ms-5 " style="color: red;">
                                   <?php $select = mysqli_query($conn, "SELECT COUNT(*) FROM teachclasse where teachid=$user_id") or die('query failed');
                                    $row = mysqli_fetch_assoc($select);
                                    echo $row['COUNT(*)'];?>
                                </p>
                            </div>
                            <i class="fa-solid fa-person-chalkboard me-3 fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">Best note:</h3>
                                
                                <p class="fs-5 ms-5 " style="color: red;">
                                   <?php $select = mysqli_query($conn, "SELECT MAX(note) FROM notes where idteacher=$user_id") or die('query failed');
                                    $row = mysqli_fetch_assoc($select);
                                    echo $row['MAX(note)'];?>
                                </p>
                            </div>
                            <i class="fa-sharp fa-solid fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">Weak note:</h3>
                                
                                <p class="fs-5 ms-5 " style="color: red;">
                                   <?php $select = mysqli_query($conn, "SELECT MIN(note) FROM notes where idteacher=$user_id") or die('query failed');
                                    $row = mysqli_fetch_assoc($select);
                                    echo $row['MIN(note)'];?>
                                </p>
                            </div>
                            <i class="fa-solid fa-school fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>     
                </div>  
                <div class="col-md-12 ">
                        <div class="p-3 d-flex ">
                        <div classe="bg-white shadow-sm align-items-center rounded" style="width: 100%; height:400px; overflow: auto;" id="donutchart"></div>
                           <div classe="bg-white shadow-sm align-items-center rounded" style="width: 100%; height:400px; overflow: auto;"  id="piechart_3d"></div>
                        </div>
                    </div>
                <div class="mt-3 container">
                    <div class="left">
                        <h2>Calendar </h2>
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
                                <input type="text" placeholder="Event Name" class="event-name" />
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
                <h6 class="text-center bg-dark text-white p-3 mt-5 m-0"> Copyright @ <?php echo date("Y")?>. MEKKAOUI ABD-ESSAMAD | 15/03/2023 | SCHOOL MANAGMENT SYSTEM| ECOL NORMAL SUPERIEUR, MARRAKECH.  All Rights Reserved.</h6>

            </div> 
            
        </div>
        

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script type="text/javascript">
            google.charts.load("current", { packages: ["corechart"] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Class', 'Average Absence'],
                <?php
                $mar = $conn->query("SELECT student.classe,teachclasse.classeid,student.id, absence.idstudent,teachclasse.teachid, sum(absence.nbheur) AS avg_absence FROM student JOIN absence ON student.id = absence.idstudent JOIN teachclasse on teachclasse.classeid = student.classe where teachclasse.teachid = $user_id  GROUP BY student.classe");
                while ($mmop = $mar->fetch_assoc()) {
                    echo "['" . $mmop['classe'] . "', " . $mmop['avg_absence'] . "],";
                }
                ?>
                   ]);

                    var options = {
                    title: 'The Average Absence for Each Class',
                    is3D: true
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
            }
            </script>

                  <!-- ------------------------------------------- -->
                  <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                       
                        var data = google.visualization.arrayToDataTable([
                        ['classe', 'Average notes'],
                        <?php
                        $mar = $conn->query("SELECT student.classe AS classe,teachclasse.classeid,student.id, notes.idstudent,teachclasse.teachid, sum(notes.note) AS NOTR FROM student JOIN notes ON student.id = notes.idstudent JOIN teachclasse on teachclasse.classeid = student.classe where teachclasse.teachid = $user_id && notes.idteacher = $user_id  GROUP BY student.classe");
                        while ($mmop = $mar->fetch_assoc()) {
                            echo "['" . $mmop['classe'] . "', " . $mmop['NOTR'] . "],";
                        }
                        ?>
                        ]);

                        var options = {
                        title: 'Average notes for ech classe',
                        pieHole: 0.4,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                    }
                    
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!--calender-->
        <script>
                    const calendar = document.querySelector(".calendar"),
                        date = document.querySelector(".date"),
                        daysContainer = document.querySelector(".days"),
                        prev = document.querySelector(".prev"),
                        next = document.querySelector(".next"),
                        todayBtn = document.querySelector(".today-btn"),
                        gotoBtn = document.querySelector(".goto-btn"),
                        dateInput = document.querySelector(".date-input"),
                        eventDay = document.querySelector(".event-day"),
                        eventDate = document.querySelector(".event-date"),
                        eventsContainer = document.querySelector(".events"),
                        addEventBtn = document.querySelector(".add-event"),
                        addEventWrapper = document.querySelector(".add-event-wrapper "),
                        addEventCloseBtn = document.querySelector(".close "),
                        addEventTitle = document.querySelector(".event-name "),
                        addEventFrom = document.querySelector(".event-time-from "),
                        addEventTo = document.querySelector(".event-time-to "),
                        addEventSubmit = document.querySelector(".add-event-btn ");

                        let today = new Date();
                        let activeDay;
                        let month = today.getMonth();
                        let year = today.getFullYear();

                        const months = [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                        ];

                        

                        const eventsArr = [];
                        getEvents();
                        console.log(eventsArr);

                        function initCalendar() {
                        const firstDay = new Date(year, month, 1);
                        const lastDay = new Date(year, month + 1, 0);
                        const prevLastDay = new Date(year, month, 0);
                        const prevDays = prevLastDay.getDate();
                        const lastDate = lastDay.getDate();
                        const day = firstDay.getDay();
                        const nextDays = 7 - lastDay.getDay() - 1;

                        date.innerHTML = months[month] + " " + year;

                        let days = "";

                        for (let x = day; x > 0; x--) {
                            days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
                        }

                        for (let i = 1; i <= lastDate; i++) {
                            //check if event is present on that day
                            let event = false;
                            eventsArr.forEach((eventObj) => {
                            if (
                                eventObj.day === i &&
                                eventObj.month === month + 1 &&
                                eventObj.year === year
                            ) {
                                event = true;
                            }
                            });
                            if (
                            i === new Date().getDate() &&
                            year === new Date().getFullYear() &&
                            month === new Date().getMonth()
                            ) {
                            activeDay = i;
                            getActiveDay(i);
                            updateEvents(i);
                            if (event) {
                                days += `<div class="day today active event">${i}</div>`;
                            } else {
                                days += `<div class="day today active">${i}</div>`;
                            }
                            } else {
                            if (event) {
                                days += `<div class="day event">${i}</div>`;
                            } else {
                                days += `<div class="day ">${i}</div>`;
                            }
                            }
                        }

                        for (let j = 1; j <= nextDays; j++) {
                            days += `<div class="day next-date">${j}</div>`;
                        }
                        daysContainer.innerHTML = days;
                        addListner();
                        }

                        //function to add month and year on prev and next button
                        function prevMonth() {
                        month--;
                        if (month < 0) {
                            month = 11;
                            year--;
                        }
                        initCalendar();
                        }

                        function nextMonth() {
                        month++;
                        if (month > 11) {
                            month = 0;
                            year++;
                        }
                        initCalendar();
                        }

                        prev.addEventListener("click", prevMonth);
                        next.addEventListener("click", nextMonth);

                        initCalendar();

                        //function to add active on day
                        function addListner() {
                        const days = document.querySelectorAll(".day");
                        days.forEach((day) => {
                            day.addEventListener("click", (e) => {
                            getActiveDay(e.target.innerHTML);
                            updateEvents(Number(e.target.innerHTML));
                            activeDay = Number(e.target.innerHTML);
                            //remove active
                            days.forEach((day) => {
                                day.classList.remove("active");
                            });
                            //if clicked prev-date or next-date switch to that month
                            if (e.target.classList.contains("prev-date")) {
                                prevMonth();
                                //add active to clicked day afte month is change
                                setTimeout(() => {
                                //add active where no prev-date or next-date
                                const days = document.querySelectorAll(".day");
                                days.forEach((day) => {
                                    if (
                                    !day.classList.contains("prev-date") &&
                                    day.innerHTML === e.target.innerHTML
                                    ) {
                                    day.classList.add("active");
                                    }
                                });
                                }, 100);
                            } else if (e.target.classList.contains("next-date")) {
                                nextMonth();
                                //add active to clicked day afte month is changed
                                setTimeout(() => {
                                const days = document.querySelectorAll(".day");
                                days.forEach((day) => {
                                    if (
                                    !day.classList.contains("next-date") &&
                                    day.innerHTML === e.target.innerHTML
                                    ) {
                                    day.classList.add("active");
                                    }
                                });
                                }, 100);
                            } else {
                                e.target.classList.add("active");
                            }
                            });
                        });
                        }

                        todayBtn.addEventListener("click", () => {
                        today = new Date();
                        month = today.getMonth();
                        year = today.getFullYear();
                        initCalendar();
                        });

                        dateInput.addEventListener("input", (e) => {
                        dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
                        if (dateInput.value.length === 2) {
                            dateInput.value += "/";
                        }
                        if (dateInput.value.length > 7) {
                            dateInput.value = dateInput.value.slice(0, 7);
                        }
                        if (e.inputType === "deleteContentBackward") {
                            if (dateInput.value.length === 3) {
                            dateInput.value = dateInput.value.slice(0, 2);
                            }
                        }
                        });

                        gotoBtn.addEventListener("click", gotoDate);

                        function gotoDate() {
                        console.log("here");
                        const dateArr = dateInput.value.split("/");
                        if (dateArr.length === 2) {
                            if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
                            month = dateArr[0] - 1;
                            year = dateArr[1];
                            initCalendar();
                            return;
                            }
                        }
                        alert("Invalid Date");
                        }

                        //function get active day day name and date and update eventday eventdate
                        function getActiveDay(date) {
                        const day = new Date(year, month, date);
                        const dayName = day.toString().split(" ")[0];
                        eventDay.innerHTML = dayName;
                        eventDate.innerHTML = date + " " + months[month] + " " + year;
                        }

                        //function update events when a day is active
                        function updateEvents(date) {
                        let events = "";
                        eventsArr.forEach((event) => {
                            if (
                            date === event.day &&
                            month + 1 === event.month &&
                            year === event.year
                            ) {
                            event.events.forEach((event) => {
                                events += `<div class="event">
                                    <div class="title">
                                    <i class="fas fa-circle"></i>
                                    <h3 class="event-title">${event.title}</h3>
                                    </div>
                                    <div class="event-time">
                                    <span class="event-time">${event.time}</span>
                                    </div>
                                </div>`;
                            });
                            }
                        });
                        if (events === "") {
                            events = `<div class="no-event">
                                    <h3>No Events</h3>
                                </div>`;
                        }
                        eventsContainer.innerHTML = events;
                        saveEvents();
                        }

                        //function to add event
                        addEventBtn.addEventListener("click", () => {
                        addEventWrapper.classList.toggle("active");
                        });

                        addEventCloseBtn.addEventListener("click", () => {
                        addEventWrapper.classList.remove("active");
                        });

                        document.addEventListener("click", (e) => {
                        if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
                            addEventWrapper.classList.remove("active");
                        }
                        });

                        //allow 50 chars in eventtitle
                        addEventTitle.addEventListener("input", (e) => {
                        addEventTitle.value = addEventTitle.value.slice(0, 60);
                        });



                        //allow only time in eventtime from and to
                        addEventFrom.addEventListener("input", (e) => {
                        addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
                        if (addEventFrom.value.length === 2) {
                            addEventFrom.value += ":";
                        }
                        if (addEventFrom.value.length > 5) {
                            addEventFrom.value = addEventFrom.value.slice(0, 5);
                        }
                        });

                        addEventTo.addEventListener("input", (e) => {
                        addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
                        if (addEventTo.value.length === 2) {
                            addEventTo.value += ":";
                        }
                        if (addEventTo.value.length > 5) {
                            addEventTo.value = addEventTo.value.slice(0, 5);
                        }
                        });

                        //function to add event to eventsArr
                        addEventSubmit.addEventListener("click", () => {
                        const eventTitle = addEventTitle.value;
                        const eventTimeFrom = addEventFrom.value;
                        const eventTimeTo = addEventTo.value;
                        if (eventTitle === "" || eventTimeFrom === "" || eventTimeTo === "") {
                            alert("Please fill all the fields");
                            return;
                        }

                        //check correct time format 24 hour
                        const timeFromArr = eventTimeFrom.split(":");
                        const timeToArr = eventTimeTo.split(":");
                        if (
                            timeFromArr.length !== 2 ||
                            timeToArr.length !== 2 ||
                            timeFromArr[0] > 23 ||
                            timeFromArr[1] > 59 ||
                            timeToArr[0] > 23 ||
                            timeToArr[1] > 59
                        ) {
                            alert("Invalid Time Format");
                            return;
                        }

                        const timeFrom = convertTime(eventTimeFrom);
                        const timeTo = convertTime(eventTimeTo);

                        //check if event is already added
                        let eventExist = false;
                        eventsArr.forEach((event) => {
                            if (
                            event.day === activeDay &&
                            event.month === month + 1 &&
                            event.year === year
                            ) {
                            event.events.forEach((event) => {
                                if (event.title === eventTitle) {
                                eventExist = true;
                                }
                            });
                            }
                        });
                        if (eventExist) {
                            alert("Event already added");
                            return;
                        }
                        const newEvent = {
                            title: eventTitle,
                            time: timeFrom + " - " + timeTo,
                        };
                        console.log(newEvent);
                        console.log(activeDay);
                        let eventAdded = false;
                        if (eventsArr.length > 0) {
                            eventsArr.forEach((item) => {
                            if (
                                item.day === activeDay &&
                                item.month === month + 1 &&
                                item.year === year
                            ) {
                                item.events.push(newEvent);
                                eventAdded = true;
                            }
                            });
                        }

                        if (!eventAdded) {
                            eventsArr.push({
                            day: activeDay,
                            month: month + 1,
                            year: year,
                            events: [newEvent],
                            });
                        }

                        console.log(eventsArr);
                        addEventWrapper.classList.remove("active");
                        addEventTitle.value = "";
                        addEventFrom.value = "";
                        addEventTo.value = "";
                        updateEvents(activeDay);
                        //select active day and add event class if not added
                        const activeDayEl = document.querySelector(".day.active");
                        if (!activeDayEl.classList.contains("event")) {
                            activeDayEl.classList.add("event");
                        }
                        });

                        //function to delete event when clicked on event
                        eventsContainer.addEventListener("click", (e) => {
                        if (e.target.classList.contains("event")) {
                            if (confirm("Are you sure you want to delete this event?")) {
                            const eventTitle = e.target.children[0].children[1].innerHTML;
                            eventsArr.forEach((event) => {
                                if (
                                event.day === activeDay &&
                                event.month === month + 1 &&
                                event.year === year
                                ) {
                                event.events.forEach((item, index) => {
                                    if (item.title === eventTitle) {
                                    event.events.splice(index, 1);
                                    }
                                });
                                //if no events left in a day then remove that day from eventsArr
                                if (event.events.length === 0) {
                                    eventsArr.splice(eventsArr.indexOf(event), 1);
                                    //remove event class from day
                                    const activeDayEl = document.querySelector(".day.active");
                                    if (activeDayEl.classList.contains("event")) {
                                    activeDayEl.classList.remove("event");
                                    }
                                }
                                }
                            });
                            updateEvents(activeDay);
                            }
                        }
                        });

                        //function to save events in local storage
                        function saveEvents() {
                        localStorage.setItem("events", JSON.stringify(eventsArr));
                        }

                        //function to get events from local storage
                        function getEvents() {
                        //check if events are already saved in local storage then return event else nothing
                        if (localStorage.getItem("events") === null) {
                            return;
                        }
                        eventsArr.push(...JSON.parse(localStorage.getItem("events")));
                        }

                        function convertTime(time) {
                        //convert time to 24 hour format
                        let timeArr = time.split(":");
                        let timeHour = timeArr[0];
                        let timeMin = timeArr[1];
                        let timeFormat = timeHour >= 12 ? "PM" : "AM";
                        timeHour = timeHour % 12 || 12;
                        time = timeHour + ":" + timeMin + " " + timeFormat;
                        return time;
                        }

        </script>
    <!--fin calender-->

</body>

</html>