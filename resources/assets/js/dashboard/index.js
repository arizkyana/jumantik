const Chartist = require('chartist');
$(document).ready(function () {

    const data = {
        line : {
            // A labels array that can contain any sort of values
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            // Our series array that contains series objects or in this case series data arrays
            series: [
                [5, 2, 4, 2, 0]
            ]
        },
        pie: {
            series: [5, 3, 4]
        }

    };

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
    new Chartist.Line('.line', data.line);


    // Pie Chart
    let sum = function(a, b) { return a + b };

    new Chartist.Pie('.pie', data.pie, {
        labelInterpolationFnc: function(value) {
            return Math.round(value / data.pie.series.reduce(sum) * 100) + '%';
        }
    });


});