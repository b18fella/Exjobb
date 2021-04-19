var chartEnabled = false;
var covidChart;
function drawGraph(formatedData) {
    let canvas = document.getElementById('covidChart');
    let canvasContext = canvas.getContext('2d');

    if (!chartEnabled) {
        chartEnabled = true;
        covidChart = new Chart(canvas, {
            type: 'line', //Type of chart, in this case, bar chart.
            data: formatedData,
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
    } else {
        covidChart.config.data = formatedData;
        covidChart.update();
    }
}

function formatData(data) {
    let datasets = [];
    let dates = [];

    

    let formatedData = {
        labels: dates,
        datasets: datasets
    };

    return formatedData;                
}