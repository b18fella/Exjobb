var chartEnabled = false;
var covidChart;
var testResultsTime = [];
var testResultsTimeDraw = [];
var testResultsTimeComplete = [];
var iterations = 0;
function getData(runTests) {
    let regionSelection = document.getElementById('selection').value;
    let startTime = performance.now();
        $.ajax({
            url: 'databaseConnection.php?query=' + regionSelection,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                let dataRetreivalTime = performance.now();
                let time = dataRetreivalTime - startTime;
                console.log("Took " + time + " milliseconds to retrieve the data");
                drawGraph(formatData(data));

                let endTime = performance.now();
                let timeDraw = endTime - dataRetreivalTime;
                console.log("Took " + timeDraw + " milliseconds to format and draw the chart");
                let timeComplete = time + timeDraw;
                console.log("Took " + timeComplete + " milliseconds for the whole process");
                if (runTests) {
                    let iterateTimes = document.getElementById('iterate').value;
                    if(iterations < iterateTimes) {
                        testResultsTime.push(time);
                        testResultsTimeDraw.push(timeDraw);
                        testResultsTimeComplete.push(timeComplete);
                        iterations++;
                        console.log("Iteration #" + iterations);
                        getData(true);
                    } else {
                        iterations = 0;
                        downloadTestResults(regionSelection);
                    }
                }
            },
            error: function(request, status, error) {
                console.error(error);
            }
        });
        
}

function downloadTestResults(file) {
    let downloadData = "";
    for (let i = 0; i < testResultsTime.length; i++) {
        downloadData += testResultsTime[i] + "," + testResultsTimeDraw[i] + "," + testResultsTimeComplete[i] + "\n";
    }
    let downloadElement = document.createElement('a');
    downloadElement.setAttribute('href', 'data:text/html;charset=utf-8,' + downloadData);
    downloadElement.setAttribute('download', file + "testData.txt");

    downloadElement.style.display = 'none';
    document.body.appendChild(downloadElement);
    downloadElement.click();
    document.body.removeChild(downloadElement);
}

function drawGraph(formatedData) {
    let canvas = document.getElementById('covidChart');

    if (!chartEnabled) {
        chartEnabled = true;
        covidChart = new Chart(canvas, {
            type: 'line',
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