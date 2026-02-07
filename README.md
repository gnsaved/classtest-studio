# ClassTest Studio

A comprehensive assessment builder platform for teachers and exam administrators to create, manage, and evaluate tests with mixed question types (MCQ + Essay).

## Features

### Teacher/Admin Features
- **Assessment Management**: Create, edit, and publish assessments
- **Flexible Question Types**: Mix MCQ and essay questions
- **Section Organization**: Organize questions into sections
- **Scheduling**: Schedule assessments for specific dates/times
- **Draft/Publish Workflow**: Save as draft and publish when ready
- **Results Dashboard**: View comprehensive statistics and individual results
- **CSV Export**: Export results for further analysis

### Student Features
- **Take Assessments**: Complete published assessments
- **Auto-Save**: Answers are automatically saved
- **Timer**: Built-in countdown timer
- **Instant Feedback**: View results immediately after submission (for MCQ)
- **Results Review**: Review all answers after submission

## Technology Stack

- **Backend**: PHP 7.4+
- **Database**: SQLite (development) / MySQL (production)
- **Frontend**: Pure CSS/JavaScript (no frameworks)
- **Architecture**: MVC pattern with PSR-4 autoloading

## Project Structure

```
classtest-studio/
├── assets/
    ├── classtest-studioAdminAssessmentResult.png    # AdminScreenshot
    ├── classtest-studioAdminCreateAssessment.png    # AdminScreenshot
    ├── classtest-studioAdminDashboard.png           # AdminScreenshot
    ├── classtest-studioLoginPage.png                # LoginScreenshot
    ├── classtest-studioUserAssessmentResult.png     # UserScreenshot
    ├── classtest-studioUserDashboard.png            # UserScreenshot
│   └── classtest-studioUserSubmitAssessment.png     # UserScreenshot
├── config/
│   └── config.php           # Application configuration
├── public/
│   ├── css/
│   │   └── style.css        # Styling
│   ├── js/
│   │   └── app.js           # JavaScript functionality
│   └── index.php            # Entry point and router
├── src/
│   ├── Controllers/         # Request handlers
│   ├── Models/              # Database models
│   ├── Views/               # Templates
│   │   ├── auth/
│   │   ├── dashboard/
│   │   ├── exams/
│   │   ├── submissions/
│   │   ├── results/
│   │   ├── components/
│   │   └── layouts/
│   ├── Database/            # Database layer
│   │   ├── Database.php
│   │   └── Migration.php
│   └── Helpers/             # Utility classes
├── storage/                 # SQLite database storage
└── vendor/                  # Dependencies
```

## Installation

### Requirements
- PHP 7.4 or higher
- SQLite3 extension (for development)
- MySQL (for production)

### Quick Start

1. Clone the repository:
```bash
git clone https://github.com/yourusername/classtest-studio.git
cd classtest-studio
```

2. Start PHP built-in server:
```bash
php -S localhost:8000 -t public
```

3. Access the application:
```
http://localhost:8000
```

### Default Credentials

**Admin Account:**
- Email: admin@classtest.com
- Password: admin123

**Student Account:**
- Email: emma.w@student.edu
- Password: student123

## Configuration

### Database Configuration

Edit `config/config.php` to configure your database:

**For SQLite (Default):**
```php
'database' => [
    'driver' => 'sqlite',
    'sqlite' => [
        'path' => __DIR__ . '/../storage/database.sqlite'
    ]
]
```

**For MySQL:**
```php
'database' => [
    'driver' => 'mysql',
    'mysql' => [
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'classtest',
        'username' => 'root',
        'password' => ''
    ]
]
```

Or use environment variables:
```bash
export DB_DRIVER=mysql
export DB_HOST=localhost
export DB_NAME=classtest
export DB_USER=your_user
export DB_PASS=your_password
```

## Usage Guide

### Creating an Assessment

1. Login as admin
2. Click "Create New"
3. Fill in assessment details:
   - Title
   - Exam Type (Midterm, Final, Quiz, etc.)
   - Subject
   - Term/Session
   - Duration
   - Schedule (optional)
4. Click "Create Assessment"

### Adding Sections and Questions

1. After creating an assessment, you'll be redirected to the edit page
2. Click "Add Section"
3. Choose section type (MCQ, Essay, or Mixed)
4. Add questions to each section
5. For MCQ: Provide options and select correct answer
6. For Essay: Just provide the question text

### Publishing an Assessment

1. Go to the assessment edit page
2. Review all sections and questions
3. Click "Publish"
4. Assessment becomes available to students

### Taking an Assessment (Student)

1. Login as student
2. View available assessments
3. Click "Start Assessment"
4. Answer questions
5. Click "Submit Assessment"
6. View results immediately

### Viewing Results (Admin)

1. Go to Dashboard
2. Click "Results" for a published assessment
3. View statistics and individual submissions
4. Export to CSV for analysis

## Database Schema

### Main Tables

- **users**: User accounts (admin/student)
- **exam_types**: Types of exams (Midterm, Final, etc.)
- **subjects**: Academic subjects
- **assessments**: Assessment metadata
- **sections**: Assessment sections
- **questions**: Questions with types (MCQ/Essay)
- **submissions**: Student submissions
- **answers**: Individual question answers

## API Endpoints

All routes are handled through the router in `public/index.php`:

- `GET /login` - Login page
- `POST /login` - Login action
- `GET /logout` - Logout
- `GET /dashboard` - Dashboard (role-based)
- `GET /assessments` - List assessments
- `GET /assessment/create` - Create form
- `POST /assessment/create` - Create action
- `GET /assessment/edit/{id}` - Edit assessment
- `POST /assessment/add-section` - Add section
- `POST /assessment/add-question` - Add question
- `GET /assessment/publish/{id}` - Publish assessment
- `GET /assessment/take/{id}` - Start taking assessment
- `GET /submission/{id}` - View submission
- `POST /submission/save-answer` - Auto-save answer
- `GET /submission/submit/{id}` - Submit assessment
- `GET /submission/result/{id}` - View results
- `GET /results/{id}` - Results summary
- `GET /results/export/{id}` - Export to CSV

## Security Features

- Password hashing with `password_hash()`
- SQL injection prevention with prepared statements
- XSS protection with `htmlspecialchars()`
- Session management
- Role-based access control

## Code Quality

This project follows:
- PSR-4 autoloading standard
- MVC architecture pattern
- Separation of concerns
- Clean, readable code
- Minimal comments (self-documenting code)
- GitHub standard project structure

## Future Enhancements

- [ ] PDF export for results
- [ ] Question bank/library
- [ ] Randomized question order
- [ ] Image support in questions
- [ ] Advanced analytics
- [ ] Email notifications
- [ ] Bulk import from CSV/Excel

## License

MIT License

## Contributing

Contributions are welcome! Please follow these guidelines:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## Support

For issues and questions, please open an issue on GitHub.
