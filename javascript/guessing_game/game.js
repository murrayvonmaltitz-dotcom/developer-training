import {clearGameState, getGameState, saveGameState} from "./browser-storage.js"

const gameStateKey = 'game-state';

export default class Game {
    // # makes the variable private, only accessable within the class
    #minRange;
    #maxRange;
    #maxAttempts;
    #allowDuplicateGuesses;
    #secretNumber;

    constructor({minRange = 1, maxRange = 10, maxAttempts = 3, allowDuplicateGuesses = false} = {}) {
        this.#minRange = Game.initRangeValues({value: minRange, lowerBound: 1, upperBound: maxRange});
        this.#maxRange = Game.initRangeValues({value: maxRange, lowerBound: minRange});
        
        this.#maxAttempts = parseInt(maxAttempts)
        this.#allowDuplicateGuesses = allowDuplicateGuesses
        this.history = [];
        this.#secretNumber = Math.floor(Math.random() * (this.#maxRange - this.#minRange + 1)) + this.#minRange;
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

    static async loadSavedGame() {
        const state = await getGameState()

        if (!state) {
            return null
        }
        
        let game = new Game(state)

        game.#secretNumber = state.secretNumber
        game.history = state.history

        return game
    }

    async checkGuess(guess) {

        if (this.maxAttempts === this.history.length) {
            return //todo throw error?
        }

        if (!this.#allowDuplicateGuesses && this.history.indexOf(guess) > -1) {
            return;
        }

        this.history.push(guess);

        const isCorrect = guess == this.#secretNumber;
        const isLastAttempt = this.#maxAttempts === this.history.length
        const result = isCorrect ? "Correct" :
            guess < this.#secretNumber ? "too low" : "too high"

        document.dispatchEvent(new CustomEvent('game:guess', {
            detail: {
                guess,
                result,
                remainingAttempts: this.#maxAttempts - this.history.length
            }
        }))

        if (isCorrect || isLastAttempt) {
            document.dispatchEvent(new CustomEvent('game:over', {
                detail: {
                    secretNumber: this.#secretNumber
                }
            }));
            
            await clearGameState()
            return 
        }

        await saveGameState({
            minRange: this.#minRange,
            maxRange: this.#maxRange,
            maxAttempts: this.#maxAttempts,
            allowDuplicateGuesses: this.#allowDuplicateGuesses,
            secretNumber: this.#secretNumber,
            history: this.history
        })

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
}