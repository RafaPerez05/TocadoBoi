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

//FILTROS dos projetos
document.getElementById("mostrarTodos").addEventListener("click", function () {
  mostrarItens("square");
});

document.getElementById("mostrarDesigns").addEventListener("click", function () {
  mostrarItens("design");
});

document.getElementById("mostrarProjetos").addEventListener("click", function () {
  mostrarItens("projeto");
});

function mostrarItens(categoria) {
  var itens = document.getElementsByClassName("square");

  for (var i = 0; i < itens.length; i++) {
      if (categoria === "square" || itens[i].classList.contains(categoria)) {
          itens[i].style.display = "block";
      } else {
          itens[i].style.display = "none";
      }
  }
}

//JS PARA ROLAR
document.addEventListener("DOMContentLoaded", function () {
  // Selecione o link "Contato" pelo texto do link
  const linkContato = document.querySelector('a[href="#contato"]');

  // Adicione um ouvinte de evento de clique ao link
  linkContato.addEventListener("click", function (event) {
      event.preventDefault(); // Evite o comportamento padrão de seguir o link

      // Selecione o footer pelo ID
      const footer = document.getElementById("FormContato");

      // Role suavemente até o footer
      footer.scrollIntoView({
          behavior: "smooth",
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Selecione o link "Contato" pelo texto do link
  const linkContato = document.querySelector('a[href="#projetos"]');

  // Adicione um ouvinte de evento de clique ao link
  linkContato.addEventListener("click", function (event) {
      event.preventDefault(); // Evite o comportamento padrão de seguir o link

      // Selecione o footer pelo ID
      const footer = document.getElementById("projetos");

      // Role suavemente até o footer
      footer.scrollIntoView({
          behavior: "smooth",
      });
  });
});

function redirecionaEmail(){
  window.alert("Enviado com sucesso!");
  document.getElementById("formName").textContent = "";
  document.getElementById("formEmail").textContent= "";
  document.getElementById("formMensage").textContent = "";

};

document.getElementById("enviaEmail").addEventListener("click", function () {
  redirecionaEmail();
});

