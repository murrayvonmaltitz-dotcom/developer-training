
//context

class Game {
    // # makes the variable private, only accessable within the class
    #minRange;
    #maxRange;
    #maxAttempts;
    constructor({minRange = 1, maxRange = 10, maxAttempts = 3} = {}) {
        this.#minRange = Game.initRangeValues({value: minRange, lowerBound: 1, upperBound: maxRange});
        this.#maxRange = Game.initRangeValues({value: maxRange, lowerBound: minRange});
        this.#maxAttempts = maxAttempts
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
        const secretNumber = Math.floor(Math.random() * (this.#maxRange - this.#minRange + 1)) + this.#minRange
        const history = [];

        while (history.length < this.#maxAttempts) {
        var input = prompt(`Attempt ${history.length + 1}: Guess the secret number between ${this.#minRange} and ${this.#maxRange}`);
        var guess = Number(input)

        if (isNaN(guess) || guess < this.#minRange || guess > this.#maxRange) {
            alert(`Invalid input. Please enter a number between ${this.#minRange} and ${this.#maxRange}.`);
            continue
        }

        if (history.indexOf(guess) >-1) {
            continue;
        }

        history.push(guess)

        if (guess === secretNumber) {
            alert("Congratulations! You guessed the secret number!");
            var guessed = true
            break;
        } else if (guess < secretNumber) {
            alert(`${guess} is too low!`);
        } else {
            alert(`${guess} is too high!`);
        }
    }

    var guessedMessage = guessed ? "You won!" : "You lost!"

    alert(`Game over! The secret number was ${secretNumber}. You ${guessedMessage} in ${history.length} attempts.`);
    alert(`Your guesses were: ${history.join(', ')}`);
    }
}

let easyGame = new Game({maxAttempts: 10});

easyGame.play()
