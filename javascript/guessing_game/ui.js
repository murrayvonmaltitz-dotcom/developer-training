import Game from "./game.js"

let game;

function getBy(cssSelector) {
    return document.querySelector(cssSelector);
}

const form = getBy('#settings-form');
const optionsCustomElement = getBy('#options-custom');
const optionsModeElement = getBy('#options-mode');
const allowedDuplicateElement = getBy('#allow-duplicates-checkbox');
const inputGuessElement = getBy('#guess-input');
const feedbackElement = getBy('#guess-feedback');
const historyElement = getBy('#guess-history');

const gameAreasElement = getBy('#game-area');

export const ui = {
    get selectedGameType() {
        return form.elements.namedItem('game-type-selector').value
    },

    get allowDuplicateGuesses() {
        return allowedDuplicateElement.checked
    },

    gameArea: {
        set disabled(value) {
            const elements = gameAreasElement.querySelectorAll('input, button');

            for (let ii = 0; ii < elements.length; ii++) {
                elements[ii].disabled = value;
            }
        },

        hide() {
            gameAreasElement.classList.add('hidden');
        },

        show() {
            gameAreasElement.classList.remove('hidden');
        }
    },

    settings: {
        set disabled(value) {
            //form controls (inputs, buttons, selects)
            //not an array but has length and can be accessed by index.
            const elements = form.elements;

            for (let ii = 0; ii < elements.length; ii++) {
                elements[ii].disabled = value;
            }
        }

        //alternatives to above
        // [...form.elements].forEach(element => {
        //     element.disabled = value;
        // });

        // Array.from(form.elements).forEach(el => {
        //     el.disabled = value;
        // });

        // Array.prototype.forEach.call(form.elements, el => {
        //     el.disabled = value;
        // });
    },

    ChangeGameType(id) {
        if (optionsCustomElement.id === id) {
            optionsCustomElement.className = 'inline'
            optionsModeElement.className = 'hidden'
        } else {
            optionsCustomElement.className = 'hidden'
            optionsModeElement.className = 'inline' 
        }
    },

    getGuess() {
        return parseInt(inputGuessElement.value);
    },

    reset() {
        this.resetHistory();
        this.resetGuess();
        this.showFeedback('');
    },

    resetGuess() {
        inputGuessElement.value = '';
        inputGuessElement.focus();
    },
    
    resetHistory() {
        historyElement.innerHTML = '';
    },

    showFeedback(result) {
        feedbackElement.innerHTML = result;
    },

    updateHistory(result) {
        historyElement.innerHTML += `<li>${result}</li>`;
    },
}



export function init() {

    document.getElementById('settings-form').addEventListener('submit', (e) => {
        e.preventDefault()

        let titleElement = getBy('#input-title');
        let minRangeElement = getBy('#input-min-range');
        let maxRangeElement = getBy('#input-max-range');
        let maxAttemptsElement = getBy('#input-max-attempts');

        //from select element
        let gameLevelElement = getBy('#game-level');

        const submitterName =  e.submitter.name;
        const allowDuplicateGuesses = ui.allowDuplicateGuesses;

        if (submitterName === 'play-game') {
            let title = titleElement.value;
            let minRange = minRangeElement.value;
            let maxRange = maxRangeElement.value;
            let maxAttempts = maxAttemptsElement.value;

            if (ui.selectedGameType === 'options-custom') {
                if (!title || !minRange || !maxRange || !maxAttempts) {
                    alert("Please enter all game settings.");
                    return;
                }
            } else {
                let selectedOption = gameLevelElement.options[gameLevelElement.selectedIndex];
                //let selectedOption = gameLevelElement.selectedOptions[0]; //can also use selectedOptions which returns an array of selected options, in this case only one option can be selected so we take the first element

                minRange = selectedOption.getAttribute('data-min-range');
                maxRange = selectedOption.dataset.maxRange; //from data-max-range attribute, can also use getAttribute
                maxAttempts = selectedOption.getAttribute('data-max-attempts');
            }

            ui.gameArea.show();

            ui.reset();

            game = new Game({minRange, maxRange, maxAttempts, allowDuplicateGuesses});
            ui.settings.disabled = true;
            ui.gameArea.disabled = false;

        } else {
            titleElement.value = '';
            minRangeElement.value = '';
            maxRangeElement.value = '';
            maxAttemptsElement.value = '';
            ui.reset();

            ui.gameArea.hide();
        }
    });


    document.addEventListener('click', (e) => {
        if (e.target.id === 'submit-guess') {
            document.dispatchEvent(new CustomEvent("ui:submit-guess", {
                //originates from button and will "bubble up" to the document
                bubbles: true,
                detail: {
                    guess: ui.getGuess(),
                    game
                }
            }))
        } else if (e.target.id === 'end-game') {
            document.dispatchEvent(new Event('ui:end-game'), {
                bubbles: true
            })
        }
    })

    document.addEventListener('input', (e) => {
    //only works on radio buttons with name "game-type-selector"
    if (e.target.name !== 'game-type-selector') {
        return;
    }

    ui.ChangeGameType(e.target.value)
})

document.addEventListener('keydown', (e) => {
    if (e.target.parentNode.id !== 'options-custom') {
        return;
    }

    if (e.target.id.indexOf('title') > -1) {
        return;
    }

    const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Tab', "Delete"]
    const key = e.key

    if (allowedKeys.includes(key) || (key >= 0 && key <= 9)) {
        console.log("valid input")
        return;
    } else {
        e.preventDefault()
    }

})

}
