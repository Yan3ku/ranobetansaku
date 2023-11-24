document.addEventListener("click", e => {
    if (e.target.closest("[data-dropdown-button]")) {
        e.target.closest("[data-dropdown]").classList.toggle("dropdown--active");
    } else if (e.target.closest("[data-dropdown]") == null) {
        document.querySelectorAll("[data-dropdown].dropdown--active").forEach(dropdown => {
            dropdown.classList.remove("dropdown--active");
        })
    }
})
