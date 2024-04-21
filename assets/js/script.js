const showPasswordIcon = document.querySelector(".show-hide");
const passwordInput = document.querySelector(".pas");

showPasswordIcon.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    showPasswordIcon.name = "eye-off-outline";
  } else {
    passwordInput.type = "password";
    showPasswordIcon.name = "eye-outline";
  }
});
