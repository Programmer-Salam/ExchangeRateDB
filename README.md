# Currency Exchange Rates Service

This project implements a service to provide data about currency exchange rates, with the capability to update exchange rates from an external source. The service is designed with a REST API and features a simple frontend for displaying exchange rates.

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Setup Instructions](#setup-instructions)
- [API Endpoints](#api-endpoints)
- [Frontend](#frontend)
- [License](#license)
- [Repository](#repository)

## Features

- Retrieve a list of currency rates with pagination.
- Retrieve a specific currency rate by ID.
- Retrieve the history of exchange rate changes for a specific currency.
- Console command to update exchange rate data every minute using a scheduled task.
- Simple frontend using DataTables for displaying currency rates and dynamic updates.
- Bearer token authentication for API access.

## Technology Stack

- **Version Control**: Git
- **Server**: Apache 
- **Database**: MySQL
- **PHP Version**: 7.x
- **Framework**: Laravel Framework

## Setup Instructions

1. Clone the repository.
2. Install dependencies.
3. Configure your database by creating a MySQL database and updating the `.env` file.
4. Run the migrations to create the necessary tables.
5. Set up a cron job for the console command to run every minute, updating exchange rates.
6. Start the server and access the application.

## API Endpoints

### 1. List Currencies

The first endpoint allows users to retrieve a paginated list of currency rates. This is useful for displaying multiple currencies in a user interface and can be enhanced with pagination options to navigate through results.

### 2. Get Currency by ID

The second endpoint provides the ability to retrieve the exchange rate for a specific currency identified by its unique ID. This is particularly useful for detailed views where users may want to see the specifics of one currency.

### 3. Get Currency History

The third endpoint offers access to the historical exchange rate changes for a specific currency. This is helpful for users interested in analyzing trends over time.

### Authentication

All API endpoints are secured with Bearer Token authentication. To access the secured endpoints, users need to obtain a token. A dedicated endpoint allows users to generate a token, which they can then use to authenticate their requests to the other endpoints.

### Note on Access

For testing purposes, the endpoints can be accessed without a Bearer token. However, for secured access, users are encouraged to use the token provided through the designated endpoint. 

## Frontend

The frontend is built using DataTables to display the currency exchange rates in a dynamic table format. If you wish to access the API directly from the browser, you can do so without a Bearer token. However, to use the token for authentication, users should retrieve their token first and ensure they are using the authenticated routes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Repository

You can access the repository at: [GitHub Repository Link](https://github.com/Programmer-Salam/ExchangeRateDB)
