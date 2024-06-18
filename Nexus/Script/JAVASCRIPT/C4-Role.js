function toggleSections() {
    var role = document.getElementById("role").value;
    var adminSection = document.getElementById("admin-section");
    adminSection.style.display = (role === "admin") ? "block" : "none";
}