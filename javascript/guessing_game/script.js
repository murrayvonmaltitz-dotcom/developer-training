
//Factories and classes

class Game {
    // # makes the variable private, only accessable within the class
    #minRange;
    #maxRange;
    #maxAttempts;
    constructor({minRange = 1, maxRange = 10, maxAttempts = 3} = {}) {
        this.#minRange = minRange
        this.#maxRange = maxRange
        this.#maxAttempts = maxAttempts
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
let hardGame = new Game({maxRange: 20, maxAttempts: 5});
let reallyHardGame = new Game({maxRange: 100, maxAttempts: 5});
