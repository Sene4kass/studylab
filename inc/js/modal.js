function ModalWindowCourse() {
    const window = document.getElementById("blockCourseWind");
    
    if(window.style.display("flex")) {
        alert("Closing...");
        window.style.animationName("Op_C_anim");
    } else {
        alert("Opening...");
        window.style.animationName("Cl_C_anim");
    }
}