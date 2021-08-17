function validaInput(input, enableNumber) {
  var valor = input.value;
  if (valor[0] == " ") {
    return (input.value = valor.substring(0, valor.length - 1));
  }

  if (!enableNumber) {
    if (valor[valor.length - 1] != " ")
      if (!isNaN(valor[valor.length - 1]))
        return (input.value = valor.substring(0, valor.length - 1));
  }
}

function validaInputNumber(input) {
  var valor = input.value;

  if (valor[0] == " " || isNaN(valor[0])) {
    return (input.value = valor.substring(0, valor.length - 1));
  }
  if (isNaN(valor[valor.length - 1]) || valor[valor.length - 1] == " ") {
    return (input.value = valor.substring(0, valor.length - 1));
  }
}
