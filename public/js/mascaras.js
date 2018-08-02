$('.phone').mask('(00)000000000');
$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
$('.date').mask('00/00/0000');
//$('.money').mask('###.###.###.##0,00',  {reverse: true});

$('.datepicker').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});


