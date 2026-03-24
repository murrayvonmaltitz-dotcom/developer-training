//javascrip arrays

//ways of creating arrays
let array = new Array(1, 2, 3); //[1, 2, 3]
let array2 = [1, 2, 3];
let array3 = Array.of(4) // [4]
let array4 = Array.from('hello') //['h', 'e', 'l', 'l', 'o']


//add history to function from episode 6
const playGame = (function() {
    const secretNumber = Math.floor(Math.random() * 10) + 1
    const maxAttempts = 3
    const history = [];

    return  function() {
        while (history.length < maxAttempts) {
            var input = prompt(`Attempt ${history.length + 1}: Guess the secret number between 1 and 10`);
            var guess = Number(input)

            if (isNaN(guess) || guess < 1 || guess > 10) {
                alert("Invalid input. Please enter a number between 1 and 10.");
                continue
            }

            //check if guess is in history array, if it is skip the rest of the loop and prompt again
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
})()

playGame()