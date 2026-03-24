//functions

//all functions return something even if it's undefined
function doNothing() { 
    //do nothing
}

var foo = doNothing() //undefined

//function deleclaration syntax
function sum(a, b) {
    return a + b
}

//function expression syntax
var diff = function(a, b) {
    return a - b
}

//hoisitng allows us to call functions before they are declared, functions can be declared below the call but not if they are function expressions

//arrow functions are a shorter syntax for function expressions
//explicit return
var product = (a, b) => a * b

//non explicit return, good if we want to do more than one thing in the function body like add a if statement
var divide = (a, b) => {
    if (b === 0) {
        return "Cannot divide by zero"
    }
    return a / b
}

//annonymous functions are functions without a name
//function is created and immediately invoked, good for code that only needs to run once and doesn't need to be reused, good for creating a new scope to avoid polluting the global scope
//create a closure
(function() {
    //do something
})()

