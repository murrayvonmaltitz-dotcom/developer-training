
//Object Basics


//basic object creation
let person = {
    firstName: "John",
    lastName: "Doe",
    getFullName() {
        return `${this.firstName} ${this.lastName}`
    }
}

const game = (function() {
    const secretNumber = Math.floor(Math.random() * 10) + 1
    const maxAttempts = 3
    const history = [];

    return {
        play() {
            while (history.length < maxAttempts) {
            var input = prompt(`Attempt ${history.length + 1}: Guess the secret number between 1 and 10`);
            var guess = Number(input)

            if (isNaN(guess) || guess < 1 || guess > 10) {
                alert("Invalid input. Please enter a number between 1 and 10.");
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
        },
        reset() {
            const secretNumber = Math.floor(Math.random() * 10) + 1
            history.length = 0
        },
    }
})()

//play game twice and reset in between
game.play();
game.reset();
game.play();