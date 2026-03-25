
//event driven development

const ui = (function() {
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

    return {
        get selectedGameType() {
            return form.elements.namedItem('game-type-selector').value
        },

        get allowDuplicateGuesses() {
            return allowedDuplicateElement.checked
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

        ChangeGameType(id) {
            if (optionsCustomElement.id === id) {
                optionsCustomElement.className = 'inline'
                optionsModeElement.className = 'hidden'
            } else {
                optionsCustomElement.className = 'hidden'
                optionsModeElement.className = 'inline' 
            }
        }
    }
})();

class Game {
    // # makes the variable private, only accessable within the class
    #minRange;
    #maxRange;
    #maxAttempts;
    #allowDuplicateGuesses;

    constructor({minRange = 1, maxRange = 10, maxAttempts = 3, allowDuplicateGuesses = false} = {}) {
        this.#minRange = Game.initRangeValues({value: minRange, lowerBound: 1, upperBound: maxRange});
        this.#maxRange = Game.initRangeValues({value: maxRange, lowerBound: minRange});
        this.#maxAttempts = maxAttempts
        this.#allowDuplicateGuesses = allowDuplicateGuesses
        this.history = [];
        this.secretNumber = Math.floor(Math.random() * (this.#maxRange - this.#minRange + 1)) + this.#minRange;
    }

    //checks if the value is a number and within the specified range, if not throws an error with a message, returns the number if valid
    //static methods can be called on the class itself eg Game.initRangeValues()
    static initRangeValues({value, lowerBound, upperBound = 0} = {}) {
        let num = Number(value)

        if (isNaN(num)) {
            throw {message: "Value must be a number"}
        }

        if (num < lowerBound) {
            throw {message: `Value cannot be lower than ${lowerBound}`}
        }

        if (upperBound && num > upperBound) {
            throw {message: `Value cannot be higher than ${upperBound}`}
        }

        return num;
    }

    checkGuess(guess) {

        if (!this.#allowDuplicateGuesses) {
            if (this.history.indexOf(guess) > -1) {
                return;
            }
        }

        this.history.push(guess);

        if (guess === this.secretNumber) {
            return 'correct!';
        } else if (guess < this.secretNumber) {
            return `too low.`;
        } else {
           return `too high.`;
        }
    }


    //getters and setters for minRange, maxRange, and maxAttempts with validation using the static method initRangeValues
    get minRange() {
        return this.#minRange
    }

    set minRange(value) {
        this.#minRange = Game.initRangeValues({value, lowerBound: 0, upperBound: this.#maxRange})
    }

    get maxRange() {
        return this.#maxRange
    }
    
    set maxRange(value) {
        this.#maxRange = Game.initRangeValues({value, lowerBound: this.#minRange})
    }

    get maxAttempts() {
        return this.#maxAttempts
    }
    
    set maxAttempts(value) {
        let num = value
    }

    play() {
        const history = [];

        while (history.length < this.#maxAttempts) {

        if (this.checkGuess(guess)) {
                var guessed = true;
                break;
            }    
    }

    var guessedMessage = guessed ? "You won!" : "You lost!"

    console.log(`Game over! The secret number was ${secretNumber}. You ${guessedMessage} in ${history.length} attempts.`);
    console.log(`Your guesses were: ${history.join(', ')}`);
    }
}

function getBy(cssSelector) {
    return document.querySelector(cssSelector);
}


//global event listener, any input changes on the document 
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

let game;   

//single event listner to replace two below, form submit
document.getElementById('settings-form').addEventListener('submit', (e) => {
    e.preventDefault()

    let titleElement = getBy('#input-title');
    let minRangeElement = getBy('#input-min-range');
    let maxRangeElement = getBy('#input-max-range');
    let maxAttemptsElement = getBy('#input-max-attempts');

    //from select element
    let gameLevelElement = getBy('#game-level');

    const gameAreasElement = getBy('#game-area');

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
            //get 
            let selectedOption = gameLevelElement.options[gameLevelElement.selectedIndex];
            //let selectedOption = gameLevelElement.selectedOptions[0]; //can also use selectedOptions which returns an array of selected options, in this case only one option can be selected so we take the first element

            minRange = selectedOption.getAttribute('data-min-range');
            maxRange = selectedOption.dataset.maxRange; //from data-max-range attribute, can also use getAttribute
            maxAttempts = selectedOption.getAttribute('data-max-attempts');
        }

        // gameAreasElement.style.display = 'block'; //alternative to below can also use toggle, but limited to one class at a time
        gameAreasElement.classList.remove('hidden');

        ui.resetHistory();

        game = new Game({minRange, maxRange, maxAttempts, allowDuplicateGuesses});
        // easyGame.play()
    } else {
        titleElement.value = '';
        minRangeElement.value = '';
        maxRangeElement.value = '';
        maxAttemptsElement.value = '';
        ui.reset();

        // gameAreasElement.style.display = ''; //alternative to below
        gameAreasElement.classList.add('hidden');
    }
})


//get the guess and 
document.addEventListener('click', (e) => {
    if (e.target.id === 'submit-guess') {
        const guess = ui.getGuess();

        if (isNaN(guess) || guess < game.minRange || guess > game.maxRange) {
            ui.showFeedback(`Invalid input. Please enter a number between ${game.minRange} and ${game.maxRange}.`);
            ui.resetGuess();
            return;
        }
        
        const result = game.checkGuess(guess);

        ui.showFeedback(`${guess} is ${result}`);

        ui.updateHistory(`${guess} is ${result}`);

        ui.resetGuess();
    }
})
