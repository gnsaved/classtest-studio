# Quick Start Guide

Get ClassTest Studio running in 2 minutes!

## Installation

```bash
git clone https://github.com/yourusername/classtest-studio.git
cd classtest-studio
php setup.php
php -S localhost:8000 -t public
```

Visit: http://localhost:8000

## Login Credentials

**Admin:**
- Email: `admin@classtest.com`
- Password: `admin123`

**Student:**
- Email: `student@classtest.com`  
- Password: `student123`

## Create Your First Assessment

1. Login as admin
2. Click "Create New"
3. Fill in:
   - Title: "Mathematics Quiz"
   - Type: Quiz
   - Subject: Mathematics
   - Duration: 30 minutes
4. Click "Create Assessment"
5. Add a section:
   - Title: "Multiple Choice"
   - Type: MCQ
6. Add questions:
   - Question text
   - 4 options (A-D)
   - Mark correct answer
   - Set marks
7. Click "Publish"

## Take an Assessment (Student)

1. Logout, login as student
2. Click assessment card
3. Click "Start Assessment"
4. Answer questions
5. Click "Submit Assessment"
6. View results immediately

## View Results (Admin)

1. Login as admin
2. Dashboard â†’ Click "Results" on any published assessment
3. See statistics and individual scores
4. Click "Export to CSV" for analysis

## Features Overview

### Admin Dashboard
- Create assessments
- Manage questions (MCQ + Essay)
- Publish assessments
- View comprehensive results
- Export data to CSV

### Student Dashboard
- View available assessments
- Take timed assessments
- Auto-save answers
- View results
- Review submitted answers

## Advanced Usage

### Scheduling Assessments
Set "Schedule For" when creating to auto-publish at specific time

### Mixed Question Types
Use "Mixed" section type to combine MCQ and essay questions

### CSV Export
Results â†’ Export to CSV â†’ Opens in Excel/Google Sheets

## Troubleshooting

**Database error?**
```bash
rm storage/database.sqlite
php setup.php
```

**Routing not working?**
Ensure you're running from `public` directory:
```bash
php -S localhost:8000 -t public
```

**Permission denied?**
```bash
chmod -R 755 storage/
```

## Next Steps

- Read full documentation in README.md
- Explore the code structure
- Customize for your needs
- Deploy to production server

Happy testing! ðŸŽ“
