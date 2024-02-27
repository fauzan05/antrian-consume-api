document.addEventListener("DOMContentLoaded", () => {
    let body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    home = body.querySelector(".home"),
    navbar = body.querySelector(".navbar"),
    footer = body.querySelector("footer"),
    toggle = document.getElementById('toggle'),
    modeSwitch = body.querySelector(".toggle-switch"), // dark mode
    modeText = body.querySelector(".mode-text"),
    dashboardTooltip = body.querySelector("#dashboard-tooltip"),
    countersTooltip = body.querySelector("#counters-tooltip"),
    servicesTooltip = body.querySelector("#services-tooltip"),
    usersTooltip = body.querySelector("#users-tooltip"),
    settingsTooltip = body.querySelector("#settings-tooltip"),
    logoutTooltip = body.querySelector("#logout-tooltip");
new bootstrap.Tooltip(logoutTooltip); // Inisialisasi Logout Tooltip

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
});

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close-sidebar");
    home.classList.toggle("close-home");
    navbar.classList.toggle("close-navbar");
    footer.classList.toggle("close-footer");

    const tooltip1 = new bootstrap.Tooltip(dashboardTooltip); // Inisialisasi Dashboard Tooltip
    const tooltip2 = new bootstrap.Tooltip(countersTooltip); // Inisialisasi Counters Tooltip
    const tooltip3 = new bootstrap.Tooltip(servicesTooltip); // Inisialisasi Services Tooltip
    const tooltip4 = new bootstrap.Tooltip(usersTooltip); // Inisialisasi Users Tooltip
    const tooltip5 = new bootstrap.Tooltip(settingsTooltip); // Inisialisasi Settings Tooltip

    // Menentukan apakah kelas 'close-sidebar' ada atau tidak
    const isSidebarClosed = sidebar.classList.contains("close-sidebar");


    if (isSidebarClosed) {
        // Jika 'close-sidebar' ada, aktifkan Tooltip
        tooltip1.enable();
        tooltip2.enable();
        tooltip3.enable();
        tooltip4.enable();
        tooltip5.enable();
    } else {
        // Jika 'close-sidebar' tidak ada, nonaktifkan Tooltip
        tooltip1.disable();
        tooltip2.disable();
        tooltip3.disable();
        tooltip4.disable();
        tooltip5.disable();
    }
});

});


// admin charts
document.addEventListener("DOMContentLoaded", () => {
    const carausel = document.querySelector(".line-chart-carausel");
    firstChart = carausel.querySelector(".line-chart");
    slideButton = document.querySelectorAll(".line-chart-container i");
    let isDragStart = false, prevPageX, prevScrollLeft;
    let firstChartWidth = firstChart.clientWidth; // nilai awal 335
    let scrollWidth = carausel.scrollWidth - firstChartWidth;
    let state;

    const showHideIcons = () => {
        slideButton[0].style.display = state <= 0 ? "none" : "block";
        slideButton[1].style.display = state >= scrollWidth ? "none" : "block";
    }

    slideButton.forEach(icon => {
        icon.addEventListener("click", () => {
            if (icon.id == "right-button") {
                state = carausel.scrollLeft + firstChartWidth;
                carausel.scrollLeft = state;
                // console.log("state : " + state);
                // console.log("carausel.scrollLeft : " + carausel.scrollLeft);
                showHideIcons();
            }
            if (icon.id == "left-button") {
                state = carausel.scrollLeft - firstChartWidth;
                carausel.scrollLeft = state;
                // console.log("state : " + state);
                // console.log("carausel.scrollLeft : " + carausel.scrollLeft);
                showHideIcons();
            }
        });

    });


    const dragStart = (e) => {
        isDragStart = true;
        prevPageX = e.pageX;
        prevScrollLeft = carausel.scrollLeft;
    }

    const dragging = (e) => {
        if (!isDragStart) return;
        e.preventDefault();
        carausel.classList.add("dragging");
        let positionDiff = e.pageX - prevPageX;
        carausel.scrollLeft = prevScrollLeft - positionDiff;
    }

    const dragStop = (e) => {
        isDragStart = false;
        carausel.classList.remove("dragging");
    }

    carausel.addEventListener("mousedown", dragStart);
    carausel.addEventListener("mousemove", dragging);
    carausel.addEventListener("mouseup", dragStop);

});
