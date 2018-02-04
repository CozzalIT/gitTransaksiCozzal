var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function tes(){
  alert('tes');
}

function validasi_upload(){
  var x = $('input#img')[0].files;
  count = x.length;
  if(count==0){
    alert('Anda belum memilih gambar yang akan di upload, silahkan pilih terlebih dahulu');
    return false;
  }
  else if(count>10){
    alert('Gambar maksimal yang di boleh di upload adalah 10');
    return false;    
  }
  else{
    var a = $('#kd_img').val();
    var count2 = 0;
    if(a!='None'){
      a = a.split('+');
      count2 = a.length;
    }
    count = count + count2;
    if(count>10){
      alert('Gambar maksimal yang di boleh di upload adalah 10');
      return false;
    }
  }
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("foto-unit");
  if (n > x.length) {
    slideIndex = 1
  }
  if (n < 1) {  
    slideIndex = x.length
  }
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].style.borderColor = "gray";
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].style.borderColor = "green";
}
