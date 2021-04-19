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

    let currentDate;
    let regions = [];

    for (let i = 0; i < data.length; i++) {
        if (!dates.includes(data[i]['Date_reported'])) {
            dates.push(data[i]['Date_reported']);
            currentDate = data[i]['Date_reported'];
        }

        if (!regions.includes(data[i]['WHO_region'])) {
            regions[data[i]['WHO_region']] = [];
        }
    }

    console.log(dates);

    let formatedData = {
        labels: dates,
        datasets: datasets
    };

    return formatedData;                
}