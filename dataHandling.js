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

    for (const key in data.Regions) {
        let regionCases = [];
        let region = data.Regions[key];

        if (region.length !== 0) {
            for (const country in region) {
                let countryData = region[country];
                            
                for (let i = 0; i < countryData.length; i++) {
                    let tmp = parseInt(countryData[i]['Cumulative_cases']);
                    if (tmp === 0 && i === countryData.length - 1) {
                        regionCases[i] = tmp;
                    } else if (tmp > 0) {
                        if (regionCases[i] === undefined) {
                            regionCases[i] = tmp;
                        } else {
                            regionCases[i] += tmp;
                        }
                    }
                }
            }
            let dataset = {
                label: key,
                data: regionCases
            };

            datasets.push(dataset);
        }
    }

    for (const key in data.Date_reported) {
        dates.push(data.Date_reported[key]);
    }

    let formatedData = {
        labels: dates,
        datasets: datasets
    };

    return formatedData;                
}