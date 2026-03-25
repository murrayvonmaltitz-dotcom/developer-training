//async await

import { ui, init } from "./ui.js"

//setups all dom event listeners
await init()

    document.addEventListener('game:over', (e) => {
        const secretNumber = e.detail.secretNumber;

        ui.showFeedback(`Game Over! the secret number is ${secretNumber}`)
        ui.settings.disabled = false;
        ui.gameArea.disabled = true;
    })

    document.addEventListener('game:guess', (e) => {
        const {guess, result, remainingAttempts} = e.detail

        ui.updateHistory(`${guess} is ${result}`);
        ui.showFeedback(`You have ${remainingAttempts} remaining attempts`)
    }) 

    document.addEventListener("ui:submit-guess", async (e) => {
        
        const {guess, game} = e.detail

        if (isNaN(guess) || guess < game.minRange || guess > game.maxRange) {
            ui.showFeedback(`Invalid input. Please enter a number between ${game.minRange} and ${game.maxRange}.`);
            ui.resetGuess();
            return;
        }
        
        await game.checkGuess(guess);

        ui.resetGuess();
    })

    document.addEventListener("ui:end-game", (e) => {
        ui.settings.disabled = false;
    })



