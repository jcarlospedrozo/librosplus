$('.fecha-reserva.desde').datepicker({
    format: "dd/mm/yyyy",
    startDate: '0d',
    datesDisabled: '0d',
	todayHighlight:true
});

$('.fecha-reserva.desde').change(function(){

    $('.fecha-reserva.hasta').attr("readonly", false);
      
    var fechaEntrada = $(this).val();
  
    $('.fecha-reserva.hasta').datepicker({
        startDate: fechaEntrada,
        datesDisabled: fechaEntrada,
        format: 'dd/mm/yyyy'
    });
 })