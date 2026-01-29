# Job Application API - Implementation Summary

## Overview
A complete CRUD API for job vacancy applications has been successfully created with the following features:
- API endpoint for submitting job applications (POST method)
- Admin panel for managing applications (view, delete)
- File upload support for CV/Resume
- Email validation and mobile number validation

## API Endpoint

### POST /api/apply-for-vacancy

**Request Fields:**
- `full_name` (required, string, max:255)
- `email` (required, email, max:255)
- `mobile_no` (required, string, max:255)
- `apply_for_post` (required, string, max:255)
- `work_experience` (nullable, text)
- `educational_qualifications` (required, text)
- `cover_letter` (required, text)
- `cv_upload` (required, file, mimes:pdf,doc,docx, max:10MB)

**Example Request (using FormData):**
```javascript
const formData = new FormData();
formData.append('full_name', 'John Doe');
formData.append('email', 'john@example.com');
formData.append('mobile_no', '+8801712345678');
formData.append('apply_for_post', 'Software Engineer');
formData.append('work_experience', '5 years experience in web development');
formData.append('educational_qualifications', 'BSc in Computer Science');
formData.append('cover_letter', 'I am interested in this position...');
formData.append('cv_upload', fileInput.files[0]);

fetch('http://127.0.0.1:8000/api/apply-for-vacancy', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => console.log(data));
```

**Success Response (201):**
```json
{
    "success": true,
    "message": "Your job application has been submitted successfully.",
    "data": {
        "id": 1,
        "full_name": "John Doe",
        "email": "john@example.com",
        "mobile_no": "+8801712345678",
        "apply_for_post": "Software Engineer",
        "work_experience": "5 years experience in web development",
        "educational_qualifications": "BSc in Computer Science",
        "cover_letter": "I am interested in this position...",
        "cv_upload": "job_applications/cvs/xyz123.pdf",
        "created_at": "2026-01-29T15:30:00.000000Z",
        "updated_at": "2026-01-29T15:30:00.000000Z"
    }
}
```

**Error Response (422):**
```json
{
    "success": false,
    "message": "Validation Error",
    "errors": {
        "email": ["The email field is required."],
        "cv_upload": ["The cv upload field is required."]
    }
}
```

## Admin Panel Routes

1. **List Applications:** `/admin/job-applications`
   - View all submitted job applications
   - Shows: Full Name, Email, Mobile, Applied For, Date
   - Actions: View Details, Delete

2. **View Application:** `/admin/job-applications/{id}`
   - View complete application details
   - Download CV/Resume
   - See all submitted information

3. **Delete Application:** `/admin/job-applications/{id}` (DELETE)
   - Deletes the application and associated CV file

## Files Created/Modified

### Created Files:
1. `app/Http/Controllers/Api/JobApplicationController.php` - API controller
2. `app/Http/Controllers/Admin/JobApplicationController.php` - Admin controller
3. `resources/views/admin/job-applications/index.blade.php` - List view
4. `resources/views/admin/job-applications/show.blade.php` - Detail view

### Modified Files:
1. `database/migrations/2026_01_29_091731_create_job_applications_table.php` - Database schema
2. `app/Models/JobApplication.php` - Model with fillable fields
3. `routes/api.php` - Added API route
4. `routes/web.php` - Added admin routes

## Database Schema

**Table:** `job_applications`

| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | No | Primary key |
| full_name | varchar(255) | No | Applicant's full name |
| email | varchar(255) | No | Email address |
| mobile_no | varchar(255) | No | Mobile number |
| apply_for_post | varchar(255) | No | Position applied for |
| work_experience | text | Yes | Work experience details |
| educational_qualifications | text | No | Educational background |
| cover_letter | text | No | Cover letter content |
| cv_upload | varchar(255) | No | CV file path |
| created_at | timestamp | Yes | Creation timestamp |
| updated_at | timestamp | Yes | Update timestamp |

## File Storage

- CV files are stored in: `storage/app/public/job_applications/cvs/`
- Accessible via: `storage/job_applications/cvs/{filename}`
- Make sure the storage link is created: `php artisan storage:link`

## Testing the API

### Using Postman:
1. Set method to POST
2. URL: `http://127.0.0.1:8000/api/apply-for-vacancy`
3. Go to Body → form-data
4. Add all required fields
5. For cv_upload, select "File" type and upload a PDF/DOC/DOCX file
6. Send the request

### Using cURL:
```bash
curl -X POST http://127.0.0.1:8000/api/apply-for-vacancy \
  -F "full_name=John Doe" \
  -F "email=john@example.com" \
  -F "mobile_no=+8801712345678" \
  -F "apply_for_post=Software Engineer" \
  -F "educational_qualifications=BSc in Computer Science" \
  -F "cover_letter=I am interested..." \
  -F "cv_upload=@/path/to/cv.pdf"
```

## Next Steps

1. **Create Storage Link** (if not already done):
   ```bash
   php artisan storage:link
   ```

2. **Test the API** using Postman or your frontend application

3. **Access Admin Panel:**
   - Login to admin panel
   - Navigate to Job Applications section
   - View and manage submitted applications

## CORS Configuration

CORS is already configured to allow requests from:
- `https://mrpfoundation.net/`
- `http://localhost:*`

If you need to add more origins, edit `config/cors.php`

## Security Notes

- File upload is restricted to PDF, DOC, and DOCX formats only
- Maximum file size is 10MB
- All inputs are validated before processing
- Files are stored securely in the storage directory
- Admin access is protected by authentication and role middleware
