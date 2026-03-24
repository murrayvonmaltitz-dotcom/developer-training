//flow control

//if else
let i =3
if (i > 3) {
    //do something
} else {
    //do something else
}

//turnery oprator 
var value = (i < 3) ? "true statement" : "false statement"

//switch
var value = "hello"
switch (value) {
    case "hello":
        //do something
        break
    case "bye":
        //do something else
        break
    default:
        //do something default
        break
}


//for loops
for (var j = 0; j < 10; j++) {
    //do something
    console.log(j)
}

//while loops
var k = 0
while (k < 10) {
    //do something
    console.log(k)
    k++
}

//do while loops will run at least once
var l = 0
do {
    //do something
    console.log(l)
    l++
} while (l < 10)

//for loop for arrays
var fruits = ["apple", "banana", "orange"]
for (var fruit of fruits) {
    console.log(fruit)
}


var person = {
    firstName: "John",
    lastName: "Doe",
}

//for in loop for objects 
//break will end loop after firstname is found
//continue will skip to the next iteration after firstname is found
for (var prop in person) {
    if (prop === "firstName") {
        console.log(prop + ": " + person[prop])
        break
    }
}

for (var prop in person) {
    if (prop === "firstName") {
        continue
    }
    console.log(prop + ": " + person[prop])
}