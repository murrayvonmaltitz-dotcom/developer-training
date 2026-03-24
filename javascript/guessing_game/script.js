
//Destructoring objects

const game = (function() {

    return {
        play({minRange = 1, maxRange = 10, maxAttempts = 3} = {}) {

            const secretNumber = Math.floor(Math.random() * (maxRange - minRange + 1)) + minRange
            const history = [];

            while (history.length < maxAttempts) {
            var input = prompt(`Attempt ${history.length + 1}: Guess the secret number between ${minRange} and ${maxRange}`);
            var guess = Number(input)

            if (isNaN(guess) || guess < minRange || guess > maxRange) {
                alert(`Invalid input. Please enter a number between ${minRange} and ${maxRange}.`);
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
    }
})()

game.play();
