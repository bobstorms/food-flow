window.addEventListener("load", () => {

    const nextButton = document.querySelector("#next-button");
    let allInputs = document.querySelectorAll(".weights__form__input");

    allInputs.forEach(input => {

        input.addEventListener("input", () => {
            checkAllInputs();
        });

    });

    const checkAllInputs = () => {
        let totalInputs = allInputs.length;
        let inputsFilled = 0;

        allInputs.forEach(input => {
            if(input.value !== "") {
                input.classList = "weights__form__input weights__form__input--success";
                inputsFilled++;
            } else {
                input.classList = "weights__form__input";
            }
        });

        if(inputsFilled === totalInputs) {
            nextButton.classList = "button button--primary";
            nextButton.dataset.disabled = false;
        } else {
            nextButton.classList = "button button--disabled";
            nextButton.dataset.disabled = true;
        }
    };

});