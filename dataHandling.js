var chartEnabled = false;
var covidChart;

$(document).ready(function() {
    $("select").on('click', function() {
        var startTime = performance.now();
        $.ajax({
            url: 'databaseConnection.php?query=' + this.value,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                var dataRetreivalTime = performance.now();
                var time = dataRetreivalTime - startTime;
                console.log("Took " + time + " milliseconds to retrieve the data");
                drawGraph(formatData(data));

                endTime = performance.now();
                timeDraw = endTime - dataRetreivalTime;
                console.log("Took " + timeDraw + " milliseconds to format and draw the chart");
                time = time + timeDraw;
                console.log("Took " + time + " milliseconds for the whole process")
            },
            error: function(request, status, error) {
                console.error(error);
            }
        });
    });
});

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

function formatData(unformattedData) {
    let dates = [];
    let datasets = [];
    let currentDate;
    let data = [];
    let regions = [];

    for (let i = 0; i < unformattedData.length; i++) {
        if (!dates.includes(unformattedData[i]['Date_reported'])) {
            dates.push(unformattedData[i]['Date_reported']);
            currentDate = unformattedData[i]['Date_reported'];
            data[currentDate] = [];
        }

        if (data[currentDate][unformattedData[i]['WHO_region']] === undefined) {
            data[currentDate][unformattedData[i]['WHO_region']] = parseInt(unformattedData[i]['Cumulative_cases']);
        } else {
            data[currentDate][unformattedData[i]['WHO_region']] += parseInt(unformattedData[i]['Cumulative_cases']);
        }
    }

    for (const key in data) {
        let date = data[key];
        for (var dateKey in date) {
            if (regions[dateKey] === undefined) {
                regions[dateKey] = [];
            }
            regions[dateKey].push(date[dateKey]);
        }
    }

    for (let regionKey in regions) {
        datasets.push({
            label: regionKey,
            data: regions[regionKey]
        });
    }

    let formatedData = {
        labels: dates,
        datasets: datasets
    };

    return formatedData;                
}