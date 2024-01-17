document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myForm');
    const formSteps = document.querySelectorAll('.form-step');
    let currentStep = 0;

    const showStep = (step) => {
        formSteps.forEach((stepElement, index) => {
            stepElement.style.display = index === step ? 'block' : 'none';
        });
    };

    const firstStep = () => {
        if (validateStep(currentStep)) {
            if (currentStep < formSteps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }
    };

    const prevStep = () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    };

    const validateStep = (step) => {
        const currentInputs = formSteps[step].querySelectorAll('input[required]');
        let isValid = true;

        // Check if all required inputs in the current step are filled
        currentInputs.forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                alert('Please fill in all required fields before proceeding.');
            }
        });

        return isValid;
    };

    showStep(currentStep);

    form.addEventListener('click', function (event) {
        if (event.target.classList.contains('next-step')) {
            firstStep();
        } else if (event.target.classList.contains('prev-step')) {
            prevStep();
        }
    });
});
