document.getElementById('helpdeskForm').addEventListener('submit', function (event) {
    const ticket = document.getElementById('ticket').value;
    const subject = document.getElementById('subject').value.trim();
    const description = document.getElementById('description').value.trim();
    const priority = document.getElementById('priority').value;
    const fileInput = document.getElementById('myfile');

    let isValid = false;
    let errorMessages = [];

    // Check if ticket is selected
    if (ticket === '') {
        isValid = false;
        errorMessages.push('Please select a ticket type.');
    }

    // Check if subject is filled
    if (subject === '') {
        isValid = false;
        errorMessages.push('Please enter a subject.');
    }

    // Check if description is filled
    if (description === '') {
        isValid = false;
        errorMessages.push('Please enter a description.');
    }

    // Check if priority is selected
    if (priority === '') {
        isValid = false;
        errorMessages.push('Please select a priority.');
    }

    // Validate file input
    const allowedFileTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
    const files = fileInput.files;

    if (files.length === 0) {
        isValid = false;
        errorMessages.push('Please upload at least one file (PDF or image).');
    } else {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!allowedFileTypes.includes(file.type)) {
                isValid = false;
                errorMessages.push('Only PDF and image files (jpg, jpeg, png) are allowed.');
                break;
            }
        }
    }

    // If there are validation errors, prevent form submission and show errors
    if (!isValid) {
        event.preventDefault(); // Prevent form submission
        displayErrors(errorMessages); // Display the errors
    }
});

// Function to display errors in the output
function displayErrors(errors) {
    const output = document.getElementById('output');
    output.innerHTML = ''; // Clear previous errors
    output.style.color = 'red';

    errors.forEach(function (error) {
        const errorElement = document.createElement('p');
        errorElement.textContent = error;
        output.appendChild(errorElement);
    });
}
