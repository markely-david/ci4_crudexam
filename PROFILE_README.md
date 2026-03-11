# Student Profile Page - CodeIgniter 4 Project

## Project Information
- **Project Name**: CodeIgniter 4 CRUD Exam with Student Profile
- **Framework**: CodeIgniter 4.6.1
- **PHP Version**: 8.4
- **Bootstrap Version**: 5.3.7
- **Database**: MySQL (adminpanel)

## Features Implemented
1. ✅ Student Profile Display Page
2. ✅ Profile Edit Form with Validation
3. ✅ Profile Image Upload (max 2MB, JPG/PNG/WEBP)
4. ✅ Live Image Preview using JavaScript FileReader
5. ✅ Session-aware User Data Management
6. ✅ Database Storage for Profile Information

## Database Setup

### Database Name
`adminpanel`

### Migration Applied
The following columns were added to the `users` table:
- `student_id` VARCHAR(20)
- `course` VARCHAR(100)
- `year_level` TINYINT
- `section` VARCHAR(50)
- `phone` VARCHAR(20)
- `address` TEXT
- `profile_image` VARCHAR(255)

### Running the Migration
```bash
# The migration has already been applied
# If you need to reapply, run:
type profile_migration.sql | "C:\xampp\mysql\bin\mysql.exe" -u root adminpanel
```

## Installation Instructions

1. **Database Setup**
   ```bash
   php spark db:create adminpanel
   php spark migrate
   php spark db:seed Users
   ```

2. **Environment Configuration**
   - Copy `env` to `.env`
   - Update database settings in `.env`:
     ```
     database.default.hostname = localhost
     database.default.database = adminpanel
     database.default.username = root
     database.default.password = 
     ```

3. **Start the Server**
   ```bash
   php spark serve
   ```

4. **Access the Application**
   - URL: http://localhost:8080
   - Login with default credentials (see below)

## Login Credentials for Testing

### Default Admin Account
- **Username**: admin
- **Password**: (check database seeder)

### Test Student Account
You can register a new account or use existing credentials from the database.

## File Structure

### New Files Created
```
app/
├── Controllers/
│   └── ProfileController.php          # Profile management controller
├── Models/
│   └── UserModel.php                  # User model with profile fields
└── Views/
    └── profile/
        ├── show.php                   # Profile display page
        └── edit.php                   # Profile edit form

public/
└── uploads/
    └── profiles/                      # Profile images storage

profile_migration.sql                  # Database migration file
```

### Modified Files
```
app/
├── Config/
│   └── Routes.php                     # Added profile routes
└── Views/
    └── layouts/
        └── header.php                 # Added Profile link to navbar
```

## Features Details

### Profile Display Page (`/profile`)
- Shows user's profile picture (or placeholder icon)
- Displays all student information
- Shows account creation and last update timestamps
- Edit Profile button

### Profile Edit Page (`/profile/edit`)
- Form with all profile fields
- File upload for profile picture
- Live image preview before upload
- Server-side validation
- Bootstrap validation styling
- Old input preservation on validation errors

### Profile Update (`/profile/update`)
- Validates all input fields
- Handles image upload with validation:
  - Max size: 2MB
  - Allowed formats: JPG, PNG, WEBP
  - Generates unique filename
  - Deletes old image when new one is uploaded
- Updates session data
- Flash messages for success/error

## Image Upload Details

### Storage Location
`public/uploads/profiles/`

### Filename Format
`avatar_{userId}_{timestamp}.{extension}`

Example: `avatar_1_1710123456.jpg`

### Database Storage
Only the filename is stored in the database, not the full path or binary data.

## Validation Rules

### Required Fields
- Full Name (min 3, max 100 characters)
- Username (min 3, max 50 characters, unique)

### Optional Fields
- Student ID (max 20 characters)
- Course (max 100 characters)
- Year Level (1-5)
- Section (max 50 characters)
- Phone (max 20 characters)
- Address (max 500 characters)

### Image Validation
- Must be a valid image file
- MIME types: image/jpg, image/jpeg, image/png, image/webp
- Maximum size: 2048 KB (2 MB)

## Testing Checklist

- [x] Profile page displays correctly
- [x] Edit form loads with current data
- [x] Form validation works
- [x] Image upload works
- [x] Live preview shows selected image
- [x] Old image is deleted when new one is uploaded
- [x] Session updates after profile update
- [x] Flash messages display correctly
- [x] Navbar Profile link works
- [x] Breadcrumbs navigation works

## Browser Compatibility
- Chrome (Latest)
- Firefox (Latest)
- Edge (Latest)
- Safari (Latest)

## Notes
- Profile images are stored in `public/uploads/profiles/`
- Make sure the directory has write permissions
- The intl PHP extension must be enabled
- Session must be active to access profile pages

## Support
For issues or questions, please contact the developer.

---
**Developed by**: David Ashlie Markely
**Date**: March 2026
**Framework**: CodeIgniter 4.6.1
