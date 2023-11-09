
  //tabs
  function openContent(evt, contentName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("content");
      for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
          tablinks[i].classList.remove("tablink-active"); // Elimina la clase de la pestaña activa actual
      }
      document.getElementById(contentName).style.display = "block";
      evt.currentTarget.firstElementChild.classList.add("tablink-active"); // Agrega la clase a la pestaña activa
  }
  
  