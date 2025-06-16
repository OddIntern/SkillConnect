<div align="center">
    <img src="https://github.com/OddIntern/SkillConnect/blob/main/public/images/skillconnect-logo.png?raw=true" alt="SkillConnect Logo" width="350" />
    
  <p align="center">
    Connecting passionate volunteers with meaningful opportunities to build skills and experience.
  </p>
  
  <p align="center">
    <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  </p>
</div>

---

### 📝 About The Project

**SkillConnect** is a social media platform designed to be the bridge between volunteers and project organizers. Our main goal is to help users—from students to professionals—build their portfolios, sharpen new skills, and gain real-world experience by participating in various community projects.

This platform allows users to:
- **Discover Opportunities:** Find and browse a wide range of projects that match their interests and expertise.
- **Build a Reputation:** Create a professional profile that showcases their experience, skills, and contributions.
- **Collaborate:** Connect and communicate directly with project owners and fellow volunteers.

### ✨ Key Features

- ✅ **User Sign-up & Login:** A secure authentication system.
- 🔍 **Browse Projects:** View a list of available projects with search and filter capabilities.
- 📄 **Project Details:** See comprehensive information about each opportunity.
- ➕ **Create Projects:** Users can post their own projects to find volunteers.
- 📩 **Apply to Projects:** Apply to opportunities of interest.
- 💬 **Direct Messaging:** Communicate with project owners.
- 👤 **User Profiles:** A profile page that displays a user's activity, skills, and experience.
---
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
