# SymfonyPayrollApp
The Payroll Application

SymfonyPayrollApp/  
├── bin/  
│   └── console  
├── src/  
│   ├── Command/  
│   │   └── GeneratePayrollCommand.php  
│   ├── Service/  
│   │   ├── PayrollGenerator.php  
│   │   ├── PayrollStrategyFactory.php  
│   │   ├── PayrollStrategyInterface.php  
│   │   ├── MonthlyPayrollStrategy.php  
│   │   └── BonusPayrollStrategy.php  
├── tests/  
│   ├── Service/  
│   │   ├── BonusPayrollStrategyTest.php  
│   │   ├── MonthlyPayrollStrategyTest.php  
├── var/  
│   ├── logs/  
│   │   └── app.log  
│   ├── cache/  
│   │   └── dev/  
├── .gitignore  
├── composer.json  
├── docker-compose.yml  
├── Dockerfile  
├── phpunit.xml.dist  
   

# Summary of technologies used in this App:

Symfony Console Component: Used to create a console command-line interface for generating payroll data and interacting with the application.

Design Patterns:

- Factory Method: Used to create instances of MonthlyPayrollStrategy and BonusPayrollStrategy in the PayrollStrategyFactory class.

- Strategy Pattern: Implemented through MonthlyPayrollStrategy and BonusPayrollStrategy, allowing different algorithms for generating payroll data.

SOLID Principles:

- Single Responsibility Principle (SRP): Each class has a single responsibility, such as generating payroll data, creating strategies, or handling console commands.

- Open/Closed Principle (OCP): The code is open for extension (adding new strategies) but closed for modification (existing code doesn't need changes for new strategies).

DateTime: Utilized for date manipulation and calculations to generate accurate payment dates.

CSV Handling: Writing data to CSV files for reporting and data storage.

Event Listener: In this payroll app, an Event Listener captures errors that occur generally. For example during CSV generation, automatically logging them for later analysis and troubleshooting. (var/dev.log)

PHPUnit: The PHPUnit tests in this app ensure the accuracy of payroll calculations and the proper functioning of bonus strategies by validating expected outcomes and behaviors through automated testing.

Docker: The app is containerized for consistent deployment across different environments. This isolation simplifies setup and deployment by bundling the app and its dependencies, ensuring portability and minimizing compatibility concerns.

These design patterns, SOLID principles, and technologies contribute to a well-structured, modular, and maintainable codebase that can easily accommodate future changes and extensions.


# Command to Run Project

php bin/console payroll:generate output.csv


# Command to Run Unit testing

./vendor/bin/phpunit


# Commands to Run Project with Docker

- docker build -t payroll-app .
- docker run -it --rm --name payroll-app payroll-app
