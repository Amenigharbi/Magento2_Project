document.addEventListener('DOMContentLoaded', function() {
    var signOutForm = document.querySelector('form.sign-out-form');
    var signInLink = document.querySelector('li.sign-in-item');
    var signOutItem = document.querySelector('li.sign-out-item');

    if (signOutForm) {
        signOutForm.addEventListener('submit', function(event) {
            // Optionally prevent the default form submission if needed
            // event.preventDefault();

            // Hide the Sign Out button and show the Sign In link
            if (signInLink) {
                signInLink.style.display = 'block';
            }
            if (signOutItem) {
                signOutItem.style.display = 'none';
            }
        });
    }
});
