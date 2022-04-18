if (document.documentElement.clientWidth < 900) {
  var prevScrollpos = window.pageYOffset;

  window.addEventListener("scroll", function () {
    var currentScrollPos = window.pageYOffset;
    header = document.querySelector("header");
    if (prevScrollpos > currentScrollPos) {
      header.style.top = "0";
    } else {
      header.style.top = "-80px";
    }
    prevScrollpos = currentScrollPos;
  });
}
