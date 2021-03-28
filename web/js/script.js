document.addEventListener("DOMContentLoaded", init);

function init() {

  if (document.getElementsByClassName("inicio")[0] != null) {
    var body = document.getElementsByTagName("body")[0];

    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      h = checkTime(h);
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById("reloj").innerHTML = h + ":" + m + ":" + s;
      var t = setTimeout(function () { startTime() }, 500);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    body.addEventListener("load", startTime());
  }

  if (document.getElementsByClassName("dias")[0] != null) {
    var dias = document.getElementsByClassName("dias");

    for (var i = 0; i < dias.length; i++) {
      dias[i].addEventListener("click", function (e) {
        var dia = e.target.innerHTML;
        var mesAño = e.target.parentNode.parentNode.parentNode.children[0].children[0].innerText.split(" ");
        var numMes;
        for(var i = 0; i < meses.length; i++) {
          if(mesAño[0] == meses[i][0]) {
            mesAño[0] = meses[i][0];
            numMes = meses[i][1];
          }
        }

        if (dia < 10) {
          dia = "0" + dia;
        }

        if(numMes < 10) {
          numMes = "0" + numMes;
        }

        var fecha = mesAño[1] + "-" + numMes + "-" + dia;
        document.getElementsByClassName("fecha")[0].value = fecha;
        document.getElementsByClassName("fecha")[1].value = fecha;
      });
    }
  }
}

var meses = [
  ["Enero",1],
  ["Febrero",2],
  ["Marzo",3],
  ["Abril",4],
  ["Mayo",5],
  ["Junio",6],
  ["Julio",7],
  ["Agosto",8],
  ["Septiembre",9],
  ["Octubre",10],
  ["Noviembre",11],
  ["Diciembre",12]
];