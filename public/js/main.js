function showMedias() {
  var x = document.getElementById("medias-btn");
  var y = document.getElementById("medias");
  var z = document.getElementById("medias-btn-hide");
  x.style.display = "none";
  y.style.visibility = "visible";
  y.style.opacity = "1";
  y.style.height = "auto";
  z.style.display = "block";
}

function hideMedias() {
  var x = document.getElementById("medias-btn");
  var y = document.getElementById("medias");
  var z = document.getElementById("medias-btn-hide");
  x.style.display = "block";
  y.style.visibility = "hidden";
  y.style.opacity = "0";
  y.style.height = "0";
  z.style.display = "none";
}
