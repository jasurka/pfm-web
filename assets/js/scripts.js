function openForm(formName) {
    var i, formContent, form;
    formContent = document.getElementsByClassName("form-content")[0];
    form = formContent.getElementsByClassName("form");
    for (i = 0; i < form.length; i++) {
        form[i].style.display = "none";
    }
    document.getElementById(formName).style.display = "flex";
}

// Open login form by default
openForm("login");

