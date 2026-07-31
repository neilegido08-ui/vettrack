document.addEventListener("DOMContentLoaded", function () {
    const ownerForm = document.getElementById("ownerForm");

    if (!ownerForm) {
        return;
    }

    ownerForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const formData = new FormData(ownerForm);

        try {
            const response = await fetch("/vettrack/actions/save_owner.php", {
                method: "POST",
                body: formData
            });

            const text = await response.text();
            console.log("PHP response:", text);

            const result = JSON.parse(text);

            if (result.success) {
                alert(result.message);
                ownerForm.reset();
            } else {
                alert("Error: " + result.message);
            }
        } catch (error) {
            console.error(error);
            alert("Unable to save the owner. Check the browser console.");
        }
    });
});