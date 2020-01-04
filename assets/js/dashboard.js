  // Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
/*
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example
var ctx = document.getElementById("myAreaChartD");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chart_labels,
    datasets: [{
      label: 'สถิติการใช้งาน',
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
      data: chart_data,
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
*/


window.onload = function () {
  var chart1 = new CanvasJS.Chart("chartContainer1", {
    backgroundColor: "#F0F8FF",
    animationEnabled: true,
    theme: "light2",
    title:{
      text: "(จำนวนการเข้าใช้งาน)"
    },
    axisX:{
      valueFormatString: "DD/MM/YYYY",
      crosshair: {
        enabled: true,
        snapToDataPoint: true
      }
    },
    axisY: {
      //title: "Number of Visits",
      crosshair: {
        enabled: true
      }
    },
    toolTip:{
      shared:true
    },  
    legend:{
      cursor:"pointer",
      verticalAlign: "bottom",
      horizontalAlign: "left",
      dockInsidePlotArea: true,
      itemclick: toogleDataSeries1
    },
    data: [{
      type: "line",
      showInLegend: true,
      //name: "Total Visit",
      markerType: "square",
      xValueFormatString: "DD MMM, YYYY",
      color: "#FF4040",
      dataPoints: chart_data1
    }]
  });
  chart1.render();
  function toogleDataSeries1(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    } else{
      e.dataSeries.visible = true;
    }
    chart1.render();
  }

}