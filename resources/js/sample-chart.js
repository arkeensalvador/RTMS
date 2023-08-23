google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Month Name', 'Registered User Count'],

        @php
        foreach($data as $d) {
            echo "['".$d - > month_name.
            "', ".$d - > count.
            "],";
        }
        @endphp
    ]);

    var options = {
        title: 'Users Detail',
        is3D: false,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}