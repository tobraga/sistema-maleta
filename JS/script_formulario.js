function dataMin(diaInicio) {
  var inputDataFim = document.getElementsByName("dataFim")[0];
  var dataInicio = new Date(diaInicio);

  dataInicio.setDate(dataInicio.getDate() + 1);
  dataInicio = dataInicio.toISOString().split("T")[0];
  var minDataFim = dataInicio;

  inputDataFim.setAttribute("min", minDataFim);
}
