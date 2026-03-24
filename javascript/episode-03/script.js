//opertators

// + used for concatination and addition
var str1 = "hello"
var str2 = str1 + '. world'
//template strings better than + 
var str3 = `${str1} world`

var result1 = 1 + "2" // 12
var result = 1 - 2 // -1 auto converts

var result3 = 1 < "2" //true
var result4 = 1 < "a" //defaults to false
var result4 = 1 > "a" //defaults to false
var result5 = 1 > '' //true since '' is falsy
var result6 = 1 > [] //true because falsy value is 0

//falsy values used in comparision will be false examples anything else is truthy
var emptyString = '';
var zero = 0
var emptyArray = []
var zeroString = '0';
var nullValue = null
var undefinedValue = undefined
var falseValue = false


var value1 = 1 == '1' //true converts an compares
var value2 = 1 === '1' //false only true if value and type is the same, good with the number 0 

var value3 = 1 != '1' //false
var value4 = 1 !== '1' //true

//increment and decrement
var num1 = 1++
var num2 = 1--

//spread operator 
var array1 = [1, 2, 3]
var array2 = [...array1, 4, 5, 6] // [1, 2, 3, 4, 5, 6]

//rest operator pass in multiple values and treat as an array
function sum(...args) {
    return args.reduce((a, b) => a + b, 0)
}
//can pass in any amount of values
sum(1, 2, 3, 4, 5, 6)



