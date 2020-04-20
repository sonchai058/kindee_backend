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


// window.onload = function () {
//   var chart1 = new CanvasJS.Chart("chartContainer1", {
//     backgroundColor: "#F0F8FF",
//     animationEnabled: true,
//     theme: "light2",
//     title:{
//       text: "(จำนวนการเข้าใช้งาน)",
//       fontSize: 16,
//       fontFamily: "'Sarabun', sans-serif",
//     },
//     axisX:{
//       valueFormatString: "DD/MM/YYYY",
//       crosshair: {
//         enabled: true,
//         snapToDataPoint: true
//       }
//     },
//     axisY: {
//       //title: "Number of Visits",
//       crosshair: {
//         enabled: true
//       }
//     },
//     toolTip:{
//       shared:true
//     },
//     legend:{
//       cursor:"pointer",
//       verticalAlign: "bottom",
//       horizontalAlign: "left",
//       dockInsidePlotArea: true,
//       itemclick: toogleDataSeries1
//     },
//     data: [{
//       type: "line",
//       showInLegend: true,
//       //name: "Total Visit",
//       markerType: "square",
//       xValueFormatString: "DD MMM, YYYY",
//       color: "#FF4040",
//       dataPoints: chart_data1
//     }]
//   });
//   chart1.render();
//   function toogleDataSeries1(e){
//     if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
//       e.dataSeries.visible = false;
//     } else{
//       e.dataSeries.visible = true;
//     }
//     chart1.render();
//   }

// }

/*
var processed_json = new Array();
$.map(chart_data, function (obj, i) {
	processed_json.push([obj.t, parseInt(obj.y)]);
});

const series = chart_data.map(o => o.t);

var categories = series.map(function(date) {
    let formatOptions = { month: '2-digit', day: '2-digit', year: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, formatOptions);
	});
console.log(processed_json);

$('#container1').highcharts({

	chart: {
		type: 'line'
	},
	dateRangeGrouping: {
  	dayFormat: { month: 'numeric', day: 'numeric', year: 'numeric' }
  },
	title: {
		text: ''
	},
	subtitle: {
		text: ''
	},
	credits: {
		enabled: false
	},
	legend: {
		enabled: false
	},
	xAxis: {
				categories: categories,
				labels: {
					rotation: 0
			}
	},
	yAxis: {
		title: ''
	},
	plotOptions: {
		line: {
			dataLabels: {
				enabled: true
			},
			enableMouseTracking: true
		}
	},
  tooltip: {
    split: true,
    formatter: function() {
      var points = this.points,
        tooltipArray = ['DATE: <b>' + this.x + '</b>']

      points.forEach(function(point, index) {
        tooltipArray.push('จำนวนการเข้าใช้งาน: <b>' + point.y + '</b>');
      });

      return tooltipArray;
    }
  },
	series: [{
		name: 'User',
		data: processed_json
	}],
	responsive: {
		rules: [{
			condition: {
				maxWidth: 500
			},
			chartOptions: {
				legend: {
					enabled: false
				}
			}
		}]
	}
});


/*


var processed_json2 = new Array();
$.map(chart_data2, function (obj, i) {
	processed_json2.push([obj.t, parseInt(obj.y)]);
});

const series2 = chart_data2.map(o => o.t);

var categories2 = series2.map(function(date) {
    let formatOptions = { month: '2-digit', day: '2-digit', year: 'numeric' };
    return new Date(date).toLocaleDateString('en', formatOptions);
	});
console.log(processed_json);

$('#container2').highcharts({

	chart: {
		type: 'line'
	},
	dateRangeGrouping: {
  	dayFormat: { month: 'numeric', day: 'numeric', year: 'numeric' }
  },
	title: {
	 text: ''
	},
	subtitle: {
		text: ''
	},
	credits: {
		enabled: false
	},
	legend: {
		enabled: false
	},
	xAxis: {
				categories: categories2,
				labels: {
					rotation: 0
			}
	},
	yAxis: {
		title: ''
	},
	plotOptions: {
		line: {
			dataLabels: {
				enabled: true
			},
			enableMouseTracking: true
		}
	},
  tooltip: {
    split: true,
    formatter: function() {
      var points = this.points,
        tooltipArray = ['DATE: <b>' + this.x + '</b>']

      points.forEach(function(point, index) {
        tooltipArray.push('จำนวนการเข้าใช้งาน: <b>' + point.y + '</b>');
      });

      return tooltipArray;
    }
  },
	series: [{
		name: 'User',
		data: processed_json2
	}],
	responsive: {
		rules: [{
			condition: {
				maxWidth: 500
			},
			chartOptions: {
				legend: {
					enabled: false
				}
			}
		}]
	}
});

$('.date_viewer').change(function(){
	var opt =$(this).val();
	if(opt==15){
		$('.container1').show();
		$('.container2').hide();
	} else {
		$('.container1').hide();
		$('.container2').show();
	}
});
*/
