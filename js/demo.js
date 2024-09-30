// Zorg ervoor dat het JavaScript pas wordt uitgevoerd als de pagina volledig is geladen
document.addEventListener('DOMContentLoaded', function() {
    // Helper functie om HTML-inhoud toe te voegen
    function addInnerHTML(selector, html) {
        const element = document.querySelector(selector);
        if (element) {
            element.innerHTML = html;
        }
    }

    addInnerHTML('#header', `
        <nav>
            <ul style="display: flex; justify-content: space-around; list-style: none; padding: 0;">
                <li><a href="#home" style="text-decoration: none; color: #333;">Home</a></li>
                <li><a href="#over-ons" style="text-decoration: none; color: #333;">Over Ons</a></li>
                <li><a href="#contact" style="text-decoration: none; color: #333;">Contact</a></li>
            </ul>
        </nav>
    `);

    addInnerHTML('#footer', `
        <footer style="text-align: center; padding: 20px; background-color: #222; color: #fff;">
            <p>&copy; 2024 Rewindr. Alle rechten voorbehouden.</p>
        </footer>
    `);


    function applyCalendarStyle(element) {
        element.style.backgroundColor = '#f9f9f9';
        element.style.padding = '30px';
        element.style.borderRadius = '12px';
        element.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        element.style.marginBottom = '20px';
    }


    function applySubtleStyle(element) {
        element.style.backgroundColor = '#ffffff';
        element.style.padding = '20px';
        element.style.borderRadius = '4px';
        element.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
        element.style.marginBottom = '20px';
    }

    // Pas stijl toe op de downloadsectie en de andere secties
    const demoStart = document.querySelector('.demoStart');
    if (demoStart) {
        applySubtleStyle(demoStart);  // Toepassen van subtiele stijl
    }

    const calendars = document.querySelectorAll('.demoCalendar');
    calendars.forEach(calendar => {
        applyCalendarStyle(calendar);  // Toepassen van de kalenderstijl
    });

    const demoSetting = document.querySelector('.demoSetting');
    if (demoSetting) {
        applyCalendarStyle(demoSetting);  // Toepassen van de kalenderstijl
    }

    // Download button interactie
    const downloadButtons = document.querySelectorAll('.downloadIcons');
    downloadButtons.forEach(button => {
        button.style.cursor = 'pointer';
        button.addEventListener('click', function() {
            // Navigeren naar YouTube-video
            window.location.href = 'https://www.youtube.com/watch?v=kOG0_qjKWEI&ab_channel=AzureHitsNotes';
        });
        button.addEventListener('mouseover', function() {
            button.style.transform = 'scale(1.1)';  // De knop wordt groter bij hover
            button.style.transition = 'transform 0.2s ease';  // Animatie over de button
        });
        button.addEventListener('mouseout', function() {
            button.style.transform = 'scale(1)';
        });
    });
});
