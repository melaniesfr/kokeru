// Fungsi untuk membuat objek XMLHttpRequest
function getXMLHTTPRequest() {
  if (window.XMLHttpRequest) {
    // Code for modern browsers
    return new XMLHttpRequest();
  } else {
    // Code for old IE browsers
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}

// Fungsi untuk memanggil Ajax
function callAjax(url, inner) {
  var xmlhttp = getXMLHTTPRequest();

  xmlhttp.open('GET', url, true);
  xmlhttp.onreadystatechange = function() {
    // document.getElementById('showtime').innerHTML = '<img src="../images/ajax_loader.png">';
    if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
      document.getElementById(inner).innerHTML = xmlhttp.responseText;
    }
    return false;
  }
  xmlhttp.send(null);
}

// Fungsi untuk menampilkan data cs yang dipilih
function showCS(id) {
  var inner = 'detail_cs';
  var url = 'get_cs.php?id=' + id;

  if (id == "") {
    document.getElementById(inner).innerHTML = '';
  } else {
    callAjax(url, inner);
  }
}