const gameStateKey = "game-state";

export function clearGameState() {
        return new Promise((resolve, reject) => {
        try {
            localStorage.removeItem(gameStateKey)
            resolve()
        } catch (error) {
            reject(error)
        }
    })
}

export function getGameState() {
    //making asyncronous in case modules get swapped out, eg fetch from db 
    return new Promise((resolve, reject) => {
        try {
            const state = JSON.parse(localStorage.getItem(gameStateKey));  
            resolve(state)
        } catch (error) {
            reject(error)
        }
    })
}

export function saveGameState(stateObj) {
    return new Promise((resolve, reject) => {
        try {
            localStorage.setItem(gameStateKey, JSON.stringify(stateObj))
            resolve()
        } catch (error) {
            reject(error)
        }
    })
} 