# Use an official PHP image with a version >= 8.1.0
FROM php:8.1-cli

# Set working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy project files to the container
COPY . .

# Expose port 8000 (adjust as needed)
EXPOSE 8000

# Run Symfony command with arguments
CMD ["php", "bin/console", "payroll:generate", "output.csv"]
