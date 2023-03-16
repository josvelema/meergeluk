const readMoreButtons = document.querySelectorAll(".read-more-btn");
const overlays = document.querySelectorAll(".overlay");
const tabs = document.querySelectorAll(".tab");
const closeButtons = document.querySelectorAll(".tab-close");

readMoreButtons.forEach((button, index) => {
  button.addEventListener("click", () => {
    overlays[index].classList.add("active");
    tabs[index].classList.add("active");
    document.body.style.overflow = "hidden";
  });
});

closeButtons.forEach((button, index) => {
  button.addEventListener("click", () => {
    overlays[index].classList.remove("active");
    tabs[index].classList.remove("active");
    document.body.style.overflow = "";
  });
});

overlays.forEach((overlay) => {
  overlay.addEventListener("click", (event) => {
    if (event.target === overlay) {
      overlay.classList.remove("active");
      overlay.querySelector(".tab").classList.remove("active");
      document.body.style.overflow = "";
    }
  });
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    overlays.forEach((overlay, index) => {
      if (overlay.classList.contains("active")) {
        overlay.classList.remove("active");
        tabs[index].classList.remove("active");
        document.body.style.overflow = "";
      }
    });
  }
});