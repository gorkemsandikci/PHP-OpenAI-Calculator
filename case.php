<?php
if (!isset($_GET['input']) || !preg_match('#^[0-9+\-*/().\s]+$#', $_GET['input'])) {
    die('Invalid input. Only numbers and + - * / . ( ) characters are allowed.<br>');
}

function fetchChatGPTCode() {
    $apiKey = getenv('APIKEY');
    $url = getenv('URL');
    $headers = array(
        "Authorization: Bearer {$apiKey}",
        "Content-Type: application/json"
    );

    $messages = [[
        "role" => "system",
        "content" => "Please provide a complete PHP function named `calculate` that takes a single string parameter and evaluates a mathematical expression safely. The function should: 1. Allow only numbers and the following operators: +, -, *, /. 2. Return an error message if the input contains invalid characters. 3. Safely handle division by zero. 4. Return the result of the calculation. 5. Do not use `preg_match` for input validation as that has already been handled. The response should be in the following format:\n\n```php\nfunction calculate {\n    // your code here\n}\n```"
    ]];

    $data = array(
        "model" => "gpt-3.5-turbo",
        "messages" => $messages,
        "max_tokens" => 150
    );

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = json_decode(curl_exec($curl), true);
    curl_close($curl);
 
    if (!isset($result['choices'][0]['message']['content']) || empty(trim($result['choices'][0]['message']['content']))) {
        die('Error: No valid code returned from ChatGPT.<br>');
    }

    return $result['choices'][0]['message']['content'];
}

function executeCalculate($input) {
    $attempts = 0;
    $maxAttempts = 3;
    while ($attempts < $maxAttempts) {
        $generatedCode = fetchChatGPTCode();
        $generatedCode = trim(preg_replace('/^.*?```php\s*|\s*```.*$/s', '', $generatedCode));

        if (empty($generatedCode)) {
            return 'Error: Generated code is empty.<br>';
        }

        try {
            eval($generatedCode);
            $calcResult = calculate($input);
            return htmlspecialchars($calcResult);
        } catch (Error $e) {
            $attempts++;
            if ($attempts >= $maxAttempts) {
                return 'Error: Failed to execute calculation after multiple attempts.<br>';
            }
        }
    }
    return 'Error: Unexpected error occurred.<br>';
}

$result = executeCalculate($_GET['input']);
echo $result;
?>