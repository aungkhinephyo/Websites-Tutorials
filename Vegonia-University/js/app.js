/* ==================== Start jQuery Area ===================================== */
$(document).ready(function () {
    // console.log('hi');

    /* =================== start header ======================== */

    /* -------------start navabr -------------*/
    $(".navbtns").click(function () {
        $(".navbtns").toggleClass('crossx');
    });
    /* -------------end navabr -------------*/

    /* =================== end header ======================== */

    /* ====================Start Login Form ========================= */
    $('.open-btn').click(function () {
        $('#form-popup').css('display', 'block');
    })
    $('.close-btn').click(function () {
        $('#form-popup').css('display', 'none');
    })
    /* ====================End Login Form ========================= */
});

/* ==================== End jQuery Area ===================================== */



/* ==================== Start JS Area ===================================== */
const getcountervalues = document.querySelectorAll(".countervalues");

getcountervalues.forEach(function (getcountervalue) {

    getcountervalue.textContent = 0;

    const updatecounter = function () {
        // console.log('works');
        // const gettarget = parseInt(getcountervalue.getAttribute('data-target'));
        // const gettarget = Number(getcountervalue.getAttribute('data-target'));
        const getcttarget = +getcountervalue.getAttribute('data-target');
        // console.log(typeof getcttarget, getcttarget);

        const getctcontent = +getcountervalue.innerText;
        // console.log(typeof getctcontent, getctcontent);

        const increment = getcttarget / 100;
        // console.log(increment);

        if (getctcontent < getcttarget) {
            getcountervalue.textContent = getctcontent + increment;
            setTimeout(updatecounter, 20);
        }
    }

    updatecounter()
})

/* =============== Start Rating Section ========================= */
/* start google chart api */

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Myanmar', 8],
        ['Indonesia', 2],
        ['Thailand', 4],
        ['Singapore', 2],
        ['Laos', 8]
    ]);

    var options = {
        title: 'International Students',
        // is3D: true,
        // pieHole: 0.4,
        // width: "100%",
        // height: "100%"
        width: 500,
        height: 300
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
/* end google chart api */

/* =============== End Rating Section ========================= */

/* ====================Start Footer Section ========================= */
const getyear = document.querySelector('#getyear');
getyear.textContent = new Date().getFullYear();
/* ====================End Footer Section ========================= */






/* ==================== End JS Area ===================================== */

