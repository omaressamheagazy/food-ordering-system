let form = document.querySelector(".mainForm");
console.log(form);
console.log("HI");

form.onclick = (_) => {
    if(document.getElementById("checkbox").checked) {
        document.getElementById("hiddenCheckbox").disabled = true;
        console.log("h");
    }
}