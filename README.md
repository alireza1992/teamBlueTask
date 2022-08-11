# Team Blue task

Use any framework of your choice to create an API endpoint that accepts input as JSON with 2 fields and returns the result in JSON format with appropriate HTTP status code.
- 1 input field is mandatory, the other is optional.
- If more than 2 input fields are provided, randomly pick any two

Implement code for following test cases to pass:
- If both inputs are missing, return an error message
- If only 1 input is provided, return the input back
- If both inputs are numbers, sum of both numbers is returned
- If either input is a string, the inputs are concatenated in a separate class and the result is returned (Hint: If possible, use dependency injection)
- If either input is an emoji, it returns the same emoji back

## Minimum Requirements
- php 8
- docker (desktop)
- Note: task is implemented with laravel 9

## Installation
- Pull from github : https://github.com/alireza1992/teamBlueTask.git
- After cd into the project run ```composer install```
- run ``` ./vendor/bin/sail up ``` to run the project and ``` ./vendor/bin/sail stop ``` to stop it
  for more info please see : https://laravel.com/docs/9.x/sail
- To run the all of tests at once just run ``` sail test ``` or to run individual test ``` sail test --filter method-name test-path ```
- Also to run any artisan command : ``` sail artisan ... ```
- NOTE : if any miss configuration happens please let me know so I can help.

## About Structure
- app
    - Controllers; Responsible for getting the params and sending it as a response
    - Value Objects; Has the responsibility of taking the input and parse it (and maybe do some operations on it)
    - Services; Main logic of the application goes here ( domain layer )
    - Providers; Binding abstractions to the concretion
    - Exception-handler; To handle any possible exception which was thrown inside the application layer
- tests
    - feature; To test the endpoint for any possible outcome
    - unit; To test every piece of logic for each services (which are responsible for the final outcome)
## Usage
The main endpoint in under ``` routes/api.php ``` (POST verb with raw request body as json) and the request template(sample) is as below :
``` 
        "first_name": 1940,
        "emoji": "😜" ,
        "number":12,
        "is_arg":true,
        "last_name": "amro"
    
 ```
and the response should be something like this :
 ``` "data": {
        "inputs": [
            "😜",
            true
        ],
        "result": [
            "😜"
        ]
    } 
```
- Inputs can be changed as desired to get the corresponded behavior

## Some Suggestions
- Can use Get instead of POST (as long as data is not sensitive or server could handle body inside get request)
- Add more type hints (if the input data type is clear - which in our case is not (numbers..))
- Set api version in the response
- Adding more possible info in the response

## License
The Laravel framework is open-sourced software licensed under the MIT license
