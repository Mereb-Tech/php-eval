Submission for PHP Evaluation Project

Dear Evaluators,

I am pleased to submit my work for the PHP evaluation project. Here’s an overview of what I have implemented:

Overview
In this submission, I created a PHP API that generates secure random numbers using the getSecureRandom function located in utils.php. Additionally, I implemented comprehensive testing functions to ensure the reliability and strength of the random numbers produced.

Task 1: Testing the getSecureRandom Function
I developed three testing cases to validate the functionality of getSecureRandom:

Random Number Range: Ensures that the generated number falls within the specified minimum and maximum range.
Randomness: Executes multiple calls to verify that not all numbers are the same, demonstrating randomness.
Edge Cases: Tests scenarios where the minimum and maximum values are equal, confirming that the expected value is returned.
These test cases help guarantee the integrity of the random number generation process.

Task 2: API Implementation
I also created a simple API endpoint named api.php that:

Accepts GET requests with min and max parameters.
Validates input and responds with the generated random number in JSON format.
Handles errors gracefully, providing informative error messages for common issues, such as missing parameters or invalid ranges.
Testing
The API can be easily tested with standard HTTP request tools. Sample requests and their expected responses are included in the README file for reference.

Conclusion
I focused on delivering a simple yet functional implementation while ensuring that the code is easy to understand and maintain. I look forward to your feedback and hope you find my project meets the evaluation criteria.

Thank you for your time!

Best regards,
kirubel gulilat
kirub21
11/23/2024