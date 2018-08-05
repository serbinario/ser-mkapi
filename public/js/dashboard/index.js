//http://morrisjs.github.io/morris.js/index.html
$.ajax({
    url: "dashboard/clientesPorMes",
    type: "GET",
    dataType: "json",
    success: function (data) {
        ShowGrpah(data);
    },
});


function ShowGrpah(data) {
    Morris.Bar({
        element: 'IcecastGraph',
        data: data,
        xkey: 'MONTH',
        ykeys: ['Total'],
        labels: ['Total'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto'
    });
}



