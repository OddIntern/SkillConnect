<h1> AOL---SoftEng </h1> 

# SkillConnect
# Connecting volunteers through a social media platform that allows them to apply and view other projects made from other users. Intended to help users build their skills and experience.
# Features: Sign-up/Login, Apply to a project, Browser other Projects, Message project owner.


### ✅ Prerequisites

Before you begin, ensure you have the following installed on your system:
- **PHP** (version 8.1 or higher)
- **Composer**
- **Node.js & npm**
- **Database Server** **(Use XAMPP Control Panel, enable Apache & MySQL)**


Follow these steps carefully to get your development environment up and running.

**1. Clone the Repository**
   Open your terminal and clone the repository using Git.
   ```bash
   git clone [URL_OF_YOUR_GITHUB_REPOSITORY]
   cd skillconnect
   ```
   > **Note:** Replace `[URL_OF_YOUR_GITHUB_REPOSITORY]` with the actual URL and `skillconnect` with the project's folder name.

**2. Install PHP Dependencies**
   Install all the required PHP packages with Composer.
   ```bash
   composer install
   ```

**3. Install JavaScript Dependencies**
   Install the necessary frontend packages with npm.
   ```bash
   npm install
   ```

**4. Create Environment File**
   Copy the example environment file. This file stores your application's configuration.
   ```bash
   cp .env.example .env
   ```

**5. Generate Application Key**
   Generate a unique, secure key for your Laravel application.
   ```bash
   php artisan key:generate
   ```

**6. Configure Your Database**
   Open the `.env` file in your code editor and update the database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) to match your local setup.
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=skillconnect
   DB_USERNAME=root
   DB_PASSWORD=
   ```

**7. Run Database Migrations**
   Create all the necessary tables in your database.
   ```bash
   php artisan migrate
   ```

**8. Build Frontend Assets**
   For local development, use `npm run dev` to compile assets and watch for changes.
   ```bash
   npm run dev
   ```

**9. Run the Development Server**
   Start the Laravel development server.
   ```bash
   php artisan serve
   ```

**10. Access the Application**
    You're all set! Open your web browser and go to the URL provided, usually:
    [http://127.0.0.1:8000](http://127.0.0.1:8000)
