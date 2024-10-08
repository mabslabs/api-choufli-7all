# API-choufli-7all

**API-choufli-7all** is an open-source REST API, built 100% in PHP using the Mabs micro framework. It serves random quotes from the famous Tunisian TV series "شوفلي حل". Currently, the API offers a single endpoint, with plans to expand it by adding more quotes from various characters.

## Features

- **/random**: Returns a random quote from the collection of "شوفلي حل" quotes.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/mabslabs/api-choufli-7all.git
   cd api-choufli-7all
    ```
2. Install dependencies :
    ```bash
    composer install
    ```
3. Import quotes
   ```bash
   php quotes/importQuotes.php
   ``` 
   * Make sure you have created and correctly configured your database before importing quotes.


4. Run the API in dev environment:

    ```bash
    php -S localhost:8000

## Usage

To fetch a random quote, simply call the `/random` endpoint:

```bash
   curl http://localhost:8000/random
```

You will receive a random quote in JSON format:

```json
    {
        "quote": "الدنيا هانية، يا سبوعي، الدنيا لعب وفلوس",
        "actor":"فوشيكا"
    }
```
## Contribution

We welcome contributions to enrich the database of quotes. The quotes are stored as plain text files in the `quotes/raw/` directory, with each file representing a character from the show. If you know quotes from "شوفلي حلّ", you can add them to the appropriate text file.

### How to Contribute

1. Fork the repository.
2. Add quotes to the text files located in `quotes/raw/`. Each file corresponds to a character's name (e.g., `quotes/raw/sboui.txt`). Ensure you add **one quote per line**.
3. Submit a Merge Request (MR) with your contributions.

### Example of Contribution
To add quotes for the character "Sboui", edit the file `quotes/raw/sboui.txt` and add quotes like this:
```
First quote
Second quote
Third quote
```
Once done, submit a Merge Request, and your contribution will be reviewed.

## License

This project is licensed under the **AGPL-3.0-or-later** license. This means that anyone who uses or modifies the code, even as part of a web service, must make their source code available under the same license.

For more details, refer to the [LICENSE](LICENSE) file or visit the [GNU AGPL website](https://www.gnu.org/licenses/agpl-3.0.html).