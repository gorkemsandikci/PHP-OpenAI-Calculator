
# PHP-OpenAI-Calculator

A PHP project that integrates with OpenAI's GPT-3.5 API to dynamically generate a secure PHP function for evaluating mathematical expressions. The project ensures that only valid mathematical expressions are processed and includes error handling for issues like division by zero and invalid inputs.

## Features

- Safely evaluates mathematical expressions provided by the user.
- Uses OpenAI's API to generate the PHP `calculate` function dynamically.
- Input validation ensures only numbers and mathematical operators (`+`, `-`, `*`, `/`, `.`, `()`) are accepted.
- Handles division by zero errors and retries up to 3 times if an error occurs during execution.
- API key and URL are stored in environment variables for security.

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/PHP-OpenAI-Calculator.git
   cd PHP-OpenAI-Calculator
   ```

2. Install PHP if it's not already installed on your machine.

3. Set up a web server (like Apache or Nginx) to serve the PHP files.

4. You will need an API key from OpenAI to use their GPT-3.5 model. You can get one from [OpenAI's website](https://beta.openai.com/signup/).

5. Create a `.env` file in the project root and add the following environment variables:

   ```
   APIKEY=your_openai_api_key
   URL=https://api.openai.com/v1/chat/completions
   ```

6. Install the `phpdotenv` package to manage environment variables:

   ```bash
   composer require vlucas/phpdotenv
   ```

7. Make sure your server is set up to load environment variables from the `.env` file.

## Configuration

1. Open the `.env` file and replace the placeholders with your actual API key and the API endpoint URL:

   ```dotenv
   APIKEY=your_openai_api_key
   URL=https://api.openai.com/v1/chat/completions
   ```

2. Ensure that the project is served via a web server (e.g., localhost or a production server).

## Usage

1. Open the web page in a browser.
2. Input a valid mathematical expression using numbers and operators like `+`, `-`, `*`, `/`, `.`, and parentheses `()`.
3. The result of the calculation will be displayed on the page.

### Example:

```bash
http://localhost/PHP-OpenAI-Calculator/case.php?input=5+10*(3-1)
```

Expected result: `25`

## Error Handling

- If invalid characters are included in the input (such as letters or symbols), the program will return an error message indicating that only numbers and basic operators are allowed.
- The system retries up to 3 times in case of errors during code generation and execution (e.g., division by zero).
- If all attempts fail, the user is presented with an error message.

## OpenAI API Integration

This project leverages OpenAI's GPT-3.5-turbo model to generate PHP code for evaluating mathematical expressions. The system dynamically generates and executes the function via the `eval()` method, ensuring that the input has already been validated.

## Project Structure

```
PHP-OpenAI-Calculator/
│
├── case.php          # Main file that handles input and communicates with OpenAI API
├── .env              # Environment variables (API key and URL)
├── README.md         # Project documentation
└── .gitignore        # Ignored files in Git
```

## Security Considerations

- Input validation is done before sending the request to the OpenAI API to ensure that no invalid characters are passed.
- The use of `eval()` is carefully handled with multiple checks and retries to minimize risks.
- API keys are stored securely in environment variables to avoid hard-coding sensitive information in the source code.

## Future Improvements

- Add support for more complex mathematical functions like exponents, logarithms, and trigonometric functions.
- Improve caching mechanisms to store generated code and reduce the number of API calls.
- Enhance the user interface for a more intuitive experience.

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests if you find any bugs or have feature requests.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.
