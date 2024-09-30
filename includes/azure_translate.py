import requests
import sys
import json

# Azure Translator API credentials
subscription_key = 'e756795ca0e248ed9c0a378d774763c4'
endpoint = 'https://api.cognitive.microsofttranslator.com/translate?api-version=3.0'

# Azure region
location = 'westus3'

def translate(text, target_language):
    # Create the request headers with API key and region
    headers = {
        'Ocp-Apim-Subscription-Key': subscription_key,
        'Ocp-Apim-Subscription-Region': location,
        'Content-type': 'application/json'
    }

    # Request body
    body = [{'Text': text}]

    # Append the target language to the endpoint URL
    constructed_url = endpoint + '&to=' + target_language

    # Make the request to Azure Translator API
    response = requests.post(constructed_url, headers=headers, json=body)

    # Check if the request was successful
    if response.status_code == 200:
        response_data = response.json()
        # Extract the translated text from the response
        translated_text = response_data[0]['translations'][0]['text']
        return translated_text
    else:
        return f"Error: Unable to translate. Status code: {response.status_code}, Response: {response.text}"

if __name__ == "__main__":
    # Check if the required command line arguments are provided
    if len(sys.argv) < 3:
        print("Usage: python azure_translate.py <text_to_translate> <target_language>")
        sys.exit(1)

    # Get text and target language from command line arguments
    text = sys.argv[1]
    target_language = sys.argv[2]

    # Call the translate function
    translated_text = translate(text, target_language)

    # Output the result (this will be captured by PHP)
    print(translated_text)
