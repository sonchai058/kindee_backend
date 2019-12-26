  // Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example
var ctx = document.getElementById("myAreaChart1");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chart_labels,
    datasets: [{
      label: 'BMR Chart (K)',
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    displayFormats: {
                        quarter: 'MMM YYYY'
                    }
                }
            }]
        }
    },
      data: chart_bmr,
      backgroundColor: [
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
      ],
      borderColor: [
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
      ],
      borderWidth: 1
    }]
  }
});

var ctx = document.getElementById("myAreaChart2");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chart_labels_calo,
    datasets: [{
      label: 'Calories (K)',
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    displayFormats: {
                        quarter: 'MMM YYYY'
                    }
                }
            }]
        }
    },
      data: chart_calo,
      backgroundColor: [
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
        'rgba(59,242,209, 0.1)',
      ],
      borderColor: [
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
        'rgba(208,33,37, 0.9)',
      ],
      borderWidth: 1
    }]
  }
});