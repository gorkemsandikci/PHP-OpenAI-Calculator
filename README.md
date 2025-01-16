# PHP Mathematical Expression Calculator

A secure PHP calculator that uses ChatGPT API to generate and execute mathematical expressions.

## Features

- Safely evaluates mathematical expressions using ChatGPT-generated code
- Supports basic arithmetic operations (+, -, *, /)
- Input validation and sanitization
- Multiple retry attempts on failure
- Security checks for potentially harmful code
- Error logging

## Requirements

- PHP 7.0 or higher
- cURL extension
- OpenAI API key
- Valid OpenAI API endpoint

## Installation

1. Clone the repository
2. Set up your environment variables:
   - `APIKEY`: Your OpenAI API key
   - `URL`: OpenAI API endpoint

## Usage

Send GET requests to the script with an `input` parameter containing the mathematical expression:
