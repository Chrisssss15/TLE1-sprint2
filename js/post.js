function openNav() {
    const sidebarJs = document.getElementById("sidebarJs");
    if (sidebarJs) {
        sidebarJs.style.width = "250px";
    }
}

function closeNav() {
    const sidebarJs = document.getElementById("sidebarJs");
    if (sidebarJs) {
        sidebarJs.style.width = "0px";
    }
}

let clicked = false
function openPost() {
    clicked = !clicked;
    const postScreenJs = document.getElementById("postScreenJs");
    if (postScreenJs) {
        if(clicked == true) {
            postScreenJs.style.width = "50%";
        }
        else{
            postScreenJs.style.width = "0%";
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const forbiddenWords = [
        // Dutch words (Nederlands)
        'slet', 'neuker', 'flikker', 'klootzak', 'lul', 'drol', 'flapdrol', 'kutwijf', 
        'kankerlijer', 'klootviool', 'sukkeltje', 'trut', 'hufter', 'schoft', 'hoer', 
        'eikel', 'geitenneuker', 'kloot', 'lafaard', 'mietje', 'pisvlek', 'rotzak', 
        'tietwijf', 'valsspeler', 'zakkenwasser', 'pannenkoek', 'paardenlul', 'rotkind', 
        'lulhannes', 'mierenneuker', 'slappehap', 'teringlijer', 'klaploper', 'zwakkeling', 
        'hondenlul', 'zeikerd', 'malloot', 'dramaqueen', 'idioot', 'debiel', 'achterlijk', 
        'gekkenhuis', 'onbenul', 'lamzak', 'schijtluis', 'etterbak', 'frikandel', 'zeurpiet', 
        'vlerk', 'etter', 'gladiool', 'lapzwans', 'stakker', 'tokkie', 'verlakker', 'wous', 
        'wijzeuil', 'krankjorum', 'domoor', 'vrijbuiter', 'rotmof', 'zwamneus', 'flapuit', 'kanker',
    
        // English words (Engels)
        'asshole', 'bastard', 'bitch', 'bimbo', 'brat', 'coward', 'creep', 'cretin', 
        'cunt', 'dickhead', 'douchebag', 'faggot', 'fuckface', 'fuckhead', 'goon', 
        'idiot', 'jackass', 'jerk', 'loser', 'moron', 'nitwit', 'pervert', 'prick', 
        'punk', 'retard', 'scumbag', 'slut', 'stupid', 'twat', 'wanker', 'weirdo', 
        'arsehole', 'blowhard', 'blockhead', 'buffoon', 'chump', 'clown', 'dullard', 
        'fathead', 'knucklehead', 'lout', 'nincompoop', 'numbskull', 'rascal', 'scallywag', 
        'slob', 'snotrag', 'sod', 'twit', 'imbecile', 'goofball', 'numpty', 'skank', 
        'sleazebag', 'scoundrel', 'fool', 'wasteoid', 'neanderthal'
    ];
    

    // Functie om tekst te filteren
    function filterText(text) {
        let containsForbiddenWord = false;
        forbiddenWords.forEach(word => {
            const regex = new RegExp(word, 'gi');
            if (regex.test(text)) {
                containsForbiddenWord = true;
                text = text.replace(regex, '*'.repeat(word.length)); // Vervang het woord door sterretjes
            }
        });
        return { text, containsForbiddenWord };
    }

    // Voeg een eventlistener toe aan de knop
    const postForm = document.getElementById('postForm');
    const postTextArea = document.getElementById('post_text');

    if (postForm && postTextArea) {
        postForm.addEventListener('submit', function (event) {
            // Zorg ervoor dat je werkt met een textarea-element
            if (postTextArea instanceof HTMLTextAreaElement) {
                // Haal de tekst uit de textarea
                const text = postTextArea.value;

                // Filter de tekst
                const { text: filteredText, containsForbiddenWord } = filterText(text);

                if (containsForbiddenWord) {
                    // Voorkom het versturen van het formulier als er verboden woorden zijn
                    event.preventDefault();
                    alert('Je bericht bevat verboden woorden en kan niet worden verzonden.');
                } else {
                    // Als er geen verboden woorden zijn, vervang de tekst met de gefilterde versie
                    postTextArea.value = filteredText;
                }
            }
        });
    }
});