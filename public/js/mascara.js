function mascara(i, type) {
  var valor = i.value;

  if (isNaN(valor[valor.length - 1]) || valor[valor.length - 1] === " ") {
    i.value = valor.substring(0, valor.length - 1);
    return;
  }

  if (type == "data") {
    i.setAttribute("maxlength", "10");
    if (valor.length == 2 || valor.length == 5) i.value += "/";
  }

  if (type == "cpf") {
    i.setAttribute("maxlength", "14");
    if (valor.length == 3 || valor.length == 7) i.value += ".";
    if (valor.length == 11) i.value += "-";
  }

  if (type == "cnpj") {
    i.setAttribute("maxlength", "18");
    if (valor.length == 2 || valor.length == 6) i.value += ".";
    if (valor.length == 10) i.value += "/";
    if (valor.length == 15) i.value += "-";
  }

  if (type == "cep") {
    i.setAttribute("maxlength", "9");
    if (valor.length == 5) i.value += "-";
  }

  if (type == "tel") {
    i.setAttribute("maxlength", "14");
    if (valor.length == 2) i.value += " ";
  }
}
