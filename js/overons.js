
document.addEventListener('DOMContentLoaded', function() { // wacht tot de pagina geladen is
    const headerElement = document.getElementById('header'); // geef de header een element
    if (headerElement) { // als de header bestaat
        fetch('header.html') // haal de header op
            .then(response => response.text()) // zet de response om naar tekst
            .then(html => { // zet de tekst om naar html
                headerElement.innerHTML = html; // zet de html in de header
            })
            .catch(error => console.error('Error loading the header:', error)); // als er een error is, toon deze
    } else {
        console.error('The header element does not exist!'); // als de header niet bestaat, toon dit
    }
});

document.addEventListener('DOMContentLoaded', function() { // wacht tot de pagina geladen is
    const footerElement = document.getElementById('footer'); // geef de footer een element
    if (footerElement) { // als de header bestaat
        fetch('footer.html') // haal de header op
            .then(response => response.text()) // zet de response om naar tekst
            .then(html => { // zet de tekst om naar html
                footerElement.innerHTML = html; // zet de html in de footer
            })
            .catch(error => console.error('Error loading the footer:', error)); // als er een error is, toon deze
    } else {
        console.error('The footer element does not exist!'); // als de footer niet bestaat, toon dit
    }
});


function loadHTML() {
    // Load header
    fetch('./header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header').innerHTML = data;
        })
        .catch(error => console.error('Error loading header:', error));

    // Load footer
    fetch('./footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer').innerHTML = data;
        })
        .catch(error => console.error('Error loading footer:', error));
}

// volledig geladen
document.addEventListener('DOMContentLoaded', loadHTML);
