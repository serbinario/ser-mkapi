var options = {
    shadowSize: 0,
    lines: {
        show: true,
        lineWidth: false,
        fill: true
    },
    legend: {
        show: false
    },
    points: {
        show: true,
        radius: 3,
        lineWidth: 2
    },
    xaxis: {
        tickDecimals: false,
        color: 'rgba(0, 0, 0, 0)',
        tickSize: 1
    },
    grid: {
        borderWidth: 0,
        hoverable: true
    }
};

var data = [];

function onDataReceived(series) {

    data.push(series);
    $.plot("#placeholder", data, options);
}

$.ajax({
    url: '/dashboard/clientesPorMes',
    type: "GET",
    dataType: "json",
    success: onDataReceived
});
