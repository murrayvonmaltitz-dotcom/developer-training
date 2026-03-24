function helloWorld() {
    alert("hello world");
}

function sum(a, b) {
    return a + b
}

function divide(a,b) {
    if (b == 0) {
        throw new Error("cannot divide by 0")
    } 

    return a /b;
}

function sayHello(name) {
    let message = `Hello ${name}`;

    message.toUpperCase();

    return message;
}