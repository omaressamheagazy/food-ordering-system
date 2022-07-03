let form = document.querySelector(".mainForm");

form.onclick = (_) => {
    if(document.getElementById("checkbox").checked) {
        document.getElementById("hiddenCheckbox").disabled = true;
    }
}