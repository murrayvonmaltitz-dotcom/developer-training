//scope

//create a number between 1 and 10 
//by creating a closure we can keep the secret number and max attempts private and only expose the playGame function to the global scope
//game can be played from console by calling playGame()
//by being a const (constant) we can't reassign playGame to something else in console
const playGame = (function() {
    //const variables are block scoped and cannot be reassigned and not accessable otside the {} block
    const secretNumber = Math.floor(Math.random() * 10) + 1
    const maxAttempts = 3

    return  function() {
        //let creates a varianle with block level scope
        let attempt = 1
        for (attempt; attempt <= maxAttempts; attempt++) {
            var input = prompt(`Attempt ${attempt}: Guess the secret number between 1 and 10`);
            //var keyword can be used anywhere within this function, function scoped
            var guess = Number(input)

            if (isNaN(guess) || guess < 1 || guess > 10) {
                alert("Invalid input. Please enter a number between 1 and 10.");
                continue //restart the loop without incrementing the attempt counter
            }

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

        alert(`Game over! The secret number was ${secretNumber}. You ${guessedMessage} in ${attempt} attempts.`);

    }
})()

playGame()