// // Get the modal
// var modal = document.getElementById("myModal");
//
// // Get the button that opens the modal
// var btn = document.getElementById("mySpecBtn");
//
// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];
//
// // When the user clicks the button, open the modal
// btn.onclick = function() {
//     modal.style.display = "block";
// }
//
// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//     modal.style.display = "none";
// }
//
const btns = document.querySelectorAll("[data-target]");
const close_btns = document.querySelectorAll(".modal-btn");
const overlay = document.getElementById("#overlay");

btns.forEach((btn) => {
    btn.addEventListener('click', () => {
        document.querySelector(btn.dataset.target).classList.add("active");
        overlay.classList.add("active");
    });
});

close_btns.forEach((btn) => {
    btn.addEventListener('click', () => {
        const modal = btn.closest(".modal");
        modal.classList.remove("active");
        overlay.classList.remove("active");
    });
});

window.onclick = (e) => {
    if(e.target == overlay){
        const modals = document.querySelectorAll(".modal");
        modals.forEach((modal) => modal.classList.remove("active"));
        overlay.classList.remove("active");
    }
}