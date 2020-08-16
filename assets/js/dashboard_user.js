	$(document).ready(function () {
		setDatePickerChart(".datepicker");
	});
	$(window).on('load',function(){
			if($('#update_data').val() == 'true'){
	        $('#warningModal').modal('show');
			}
	});
	// 	$(function() {
	// 	$(".datepicker").datepicker({
	// 		dateFormat: 'yy-mm-dd',
	// 		maxDate: new Date()
	// 	});
	// });
// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
/*
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

*/


// window.onload = function () {
//   var chart1 = new CanvasJS.Chart("chartContainer1", {
//     backgroundColor: "#F0F8FF",
//     animationEnabled: true,
//     theme: "light2",
//     title:{
//       text: "(Kilocal)"
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
//       dataPoints: chart_bmr1
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

//   var chart2 = new CanvasJS.Chart("chartContainer2", {
//     backgroundColor: "#F0F8FF",
//     animationEnabled: true,
//     theme: "light2",
//     title:{
//       text: "(Kilocal)"
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
//       itemclick: toogleDataSeries2
//     },
//     data: [{
//       type: "line",
//       showInLegend: true,
//       //name: "Total Visit",
//       markerType: "square",
//       xValueFormatString: "DD MMM, YYYY",
//       color: "#FF4040",
//       dataPoints: chart_calo1
//     }]
//   });
//   chart2.render();
//   function toogleDataSeries2(e){
//     if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
//       e.dataSeries.visible = false;
//     } else{
//       e.dataSeries.visible = true;
//     }
//     chart2.render();
//   }

// }
/*
var bmi_json = new Array();
var bmr_json = new Array();

$.map(chart_bmi, function (obj, i) {
	bmi_json.push([obj.t, parseInt(obj.y)]);
});
$.map(chart_bmr, function (obj, i) {
	bmr_json.push([obj.t, parseInt(obj.y)]);
});

const seriesi = chart_bmi.map(o => o.t);
const seriesr = chart_bmr.map(o => o.t);

var categoriesi = seriesi.map(function(date) {
    let formatOptions = { month: '2-digit', day: '2-digit', year: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, formatOptions);
	});

var categoriesr = seriesr.map(function (date) {
	let formatOptions = {month: '2-digit', day: '2-digit', year: 'numeric'};
	return new Date(date).toLocaleDateString(undefined, formatOptions);
});
console.log(bmi_json);
console.log(bmr_json);

$('#chartContainer1').highcharts({

	chart: {
		type: 'line'
	},
	dateRangeGrouping: {
  	dayFormat: { month: 'numeric', day: 'numeric', year: 'numeric' }
  },
	title: {
		text: 'Kilocalories'
	},
	subtitle: false,
	credits: {
		enabled: false
	},
	legend: {
		enabled: false
	},
	xAxis: {
				categories: categoriesi,
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
        tooltipArray.push('BMR: <b>' + point.y + '</b>' + ' '+'Kcal');
      });

      return tooltipArray;
    }
  },
	series: [{
		name: 'User',
		data: bmi_json
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

$('#chartContainer2').highcharts({

	chart: {
		type: 'line'
	},
	dateRangeGrouping: {
  	dayFormat: { month: 'numeric', day: 'numeric', year: 'numeric' }
  },
	title: {
		text: 'Kilocalories'
	},
	subtitle: false,
	credits: {
		enabled: false
	},
	legend: {
		enabled: false
	},
	xAxis: {
				categories: categoriesr,
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
        tooltipArray.push('Calories: <b>' + point.y + '</b>' + ' '+'Kcal');
      });

      return tooltipArray;
    }
  },
	series: [{
		name: 'User',
		data: bmr_json
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
*/
