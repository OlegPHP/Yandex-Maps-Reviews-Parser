# Yandex Maps Reviews Parser

A Laravel application for retrieving and displaying organization information and reviews from Yandex Maps.

## Features

- Retrieve organization information by Yandex Maps URL.
- Extract organization name, category, address, rating, and review counts.
- Parse reviews, including author, date, rating, and text.
- Store organization data and reviews in MariaDB.
- Update existing records without duplicating reviews.
- Display reviews with pagination.
- Handle HTTP and data parsing errors.

## Tech Stack

- PHP 8.3+
- Laravel 13
- MariaDB
- DiDom 2.x
- Laravel HTTP Client
- Blade

## Requirements

- PHP 8.3 or later
- Composer
- MariaDB
- Required PHP extensions, including `pdo_mysql`

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/OlegPHP/Yandex-Maps-Reviews-Parser.git
   cd Yandex-Maps-Reviews-Parser
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Create the environment file and generate the application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Create a MariaDB database and configure the database connection in `.env`.

5. Run database migrations:

   ```bash
   php artisan migrate
   ```

6. Start the development server:

   ```bash
   php artisan serve
   ```

7. Open the URL displayed in the terminal, usually `http://127.0.0.1:8000`.

## Usage

1. Open the application homepage.
2. Paste a Yandex Maps organization URL into the form.
3. Submit the form.
4. The application retrieves and saves the organization data and reviews.
5. Browse the organization details and reviews using pagination.

When the same organization is parsed again, existing organization data is updated and reviews are stored using their Yandex review IDs to prevent duplicates.

## Limitations

The number of review pages processed per request is limited by the parser configuration. Data availability depends on Yandex Maps responses and page structure.

## Error Handling

The application displays an error page when data retrieval or parsing fails. Detailed error information is recorded in application logs.
