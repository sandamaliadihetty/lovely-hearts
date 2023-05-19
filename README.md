## Setup Instructions
01. Clone the repo
02. Run composer install
03. php artisan key:generate
04. Rename the env.example and replace the required variables such as database connection, stripe api keys etc
05. inside .env -> SLACK_WEBHOOK should be linked and SLACK_ADMIN email (SLCK_ADMIN email should be registered in the database)
06. npm install
07. npm run dev or npm run build
08. php artisan migrate for database migration 
09. Register admin user as mentioned in the SALCK_ADMIN
10. Seed databse with dummy data php artisan db:seed (optional)

