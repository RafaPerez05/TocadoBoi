class MobileNavbar {
  constructor(mobileMenu, navList, navLinks) {
      this.mobileMenu = document.querySelector(mobileMenu);
      this.navList = document.querySelector(navList);
      this.navLinks = document.querySelectorAll(navLinks);
      this.activeClass = "active";

      this.handleClick = this.handleClick.bind(this);
  }

  animateLinks() {
      this.navLinks.forEach((link, index) => {
          link.style.animation
              ? (link.style.animation = "")
              : (link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`);
      });
  }

  handleClick() {
      this.navList.classList.toggle(this.activeClass);
      this.mobileMenu.classList.toggle(this.activeClass);
      this.animateLinks();
  }

  closeMenu() {
      this.navList.classList.remove(this.activeClass);
      this.mobileMenu.classList.remove(this.activeClass);
      this.animateLinks();
  }

  addClickEvent() {
      this.mobileMenu.addEventListener("click", this.handleClick);
      this.navLinks.forEach(link => {
          link.addEventListener("click", () => {
              this.closeMenu();
          });
      });
  }

  init() {
      if (this.mobileMenu) {
          this.addClickEvent();
      }
      return this;
  }
}

const mobileNavbar = new MobileNavbar(
  ".mobile-menu",
  ".nav-list",
  ".nav-list li"
);
mobileNavbar.init();

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("loader-wrapper").style.display = "none";
});

var nav = document.querySelector("nav");

window.addEventListener("scroll", function () {
  if (window.scrollY > 0) {
      nav.classList.add("nav-hide");
  } else {
      nav.classList.remove("nav-hide");
  }
});



//SLIDESHOW
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slideshow")[0].getElementsByTagName("li");

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 10000); // Altere o tempo de exibição das imagens (em milissegundos) aqui
}


