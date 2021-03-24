var canvas = document.getElementById('covidChart');
var covidChart = new Chart(canvas, {
    type: 'bar', //Type of chart, in this case, bar chart.
    data: {
        labels: ['Red', 'Black', 'Yellow'],
        datasets: [{
            label: 'number of cases', //Label on top of the chart.
            data: [15, 20, 1111], //The data goes here.
            backgroundColor: [ //Color of each bar, left to right.
                'rgba(255, 99, 132, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [ //Border color of each bar, left to right.
                'rgba(255, 99, 132, 1)',
                'rgba(0, 0, 0, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});