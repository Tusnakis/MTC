document.addEventListener('DOMContentLoaded', init);

function init() {

    let body = document.getElementsByTagName("body")[0];

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById("reloj").innerHTML = h + ":" + m + ":" + s;
        var t = setTimeout(function(){ startTime() }, 500);
      }
      
      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }

    body.addEventListener("load",startTime());
}