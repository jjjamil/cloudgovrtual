
function openPopup() {
    document.getElementById("popupForm").style.display = "block";
    document.body.style.overflow = "hidden";
    document.body.style.backgroundColor = "rgba(0, 0, 0, 0.5)";

    var elementsToBlur = document.querySelectorAll("body > *:not(#popupForm):not(#rc-imageselect)");
    for (var j = 0; j < elementsToBlur.length; j++) {
        elementsToBlur[j].classList.add("blur");
    }
}


document.getElementById("closeBtn").onclick = function () {
    document.getElementById("popupForm").style.display = "none";
    document.body.style.overflow = "auto";
    document.body.style.backgroundColor = "";

    var elementsToBlur = document.querySelectorAll(".blur");
    for (var j = 0; j < elementsToBlur.length; j++) {
        elementsToBlur[j].classList.remove("blur");
    }
};

const form = document.querySelector("form");

form.addEventListener('submit', (e) => {

    const captchaResponse = grecaptcha.getResponse();
    const button = document.getElementById("formBtn");
    const captchaNote = document.getElementById("captchaNote");

    if (!captchaResponse.length > 0) {
        captchaNote.innerHTML = "Error submitting the form. Please comply reCaptcha";
        captchaNote.style.color = "red";

        e.preventDefault();
    } else {
    
    }
});
