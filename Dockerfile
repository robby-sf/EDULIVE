Start Sail/Docker Containers:
Once docker-compose.yml is in place, you can start the services:

Bash

./vendor/bin/sail up -d
The -d flag runs the containers in detached mode (in the background).

Run Laravel Commands with Sail:
Instead of php artisan, you'll use sail artisan:

Bash

./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan cache:clear
For Composer commands:

Bash

./vendor/bin/sail composer install
For Node/NPM commands:

Bash

./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
Access Your Application:
Your Laravel application should now be accessible in your web browser, typically at http://localhost.

Stop Containers:

Bash

./vendor/bin/sail down