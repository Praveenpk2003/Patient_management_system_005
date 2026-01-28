Task Id: 005
Task Name : Patient Management System
(SQL + PHP CRUD PROJECT)

PROJECT FOLDER STRUCTURE (FOLLOW EXACTLY)
Trainees should create this structure:
project_root/
│
├── config/
│ └── db.php # Database connection file (MySQLi)
│
├── includes/
│ ├── header.php # Common header
│ └── footer.php # Common footer
│
├── patients/
│ ├── create.php # Insert new patient
│ ├── list.php # Fetch & display patients list
│ ├── edit.php # Edit patient details
│ └── delete.php # Delete patient record
│
├── assets/
│ └── css/style.css # Custom styling
│
└── index.php # Redirect to patients/list.php

SQL TASKS
Step 1 — Create a Database
Create a database named hospital_db
Step 2 — Create a Patients Table
Table fields to include:
id (primary key, auto increment)
patient_name
email (unique)
phone
age
gender
diagnosis
created_at (timestamp)
Step 3 — Insert Test Data
Insert at least 5 sample patients.
Step 4 — Basic SQL Queries
Trainees must perform:
Fetch all patients
Fetch patients above a certain age
Fetch patients between age range
Search patients by name using LIKE
Order by age and patient_name
Limit results (LIMIT 5)
Step 5 — Update and Delete Queries
Update diagnosis for a specific patient
Delete a patient using ID
Step 6 — JOIN TASK
Create a new doctors table and connect it with patients.
Example tables:
doctors (id, doctor_name, specialization)
patients (doctor_id as foreign key)
Run the following:
INNER JOIN (patients with assigned doctors)
LEFT JOIN (patients with or without doctor assignment)

PHP TASKS
Step 1 — Create DB Connection File
In config/, create a file responsible for connecting PHP with MySQL.
Use a separate file to maintain a clean structure.
Step 2 — Build CRUD Operations
🟢 Create (Insert Patient)
Form fields:
Patient Name
Email
Phone
Age
Gender
Diagnosis
On submit → Insert into DB
Show success message
🟡 Read (List Patients)
Display all patients in table format
Add search bar (search by name or diagnosis)
Add sorting for age or patient name
Add pagination (5 per page)
🔵 Update (Edit Patient)
When clicking “Edit”, load the patient’s data
Update changes in the database
🔴 Delete (Remove Patient)
When clicking “Delete”, remove the patient from DB
Redirect back to the list

ADDITIONAL ADVANCED REQUIREMENTS
⭐ 1. Pagination
Display only 5 records per page
Show Next / Previous buttons
⭐ 2. Search Functionality
Search by patient name or diagnosis
⭐ 3. Sorting
Allow sorting by:
Age (Ascending / Descending)
Patient Name (A–Z / Z–A)
⭐ 4. Validation
Validate form fields before inserting
Email must be unique
Phone number validation
⭐ 5. Clean UI
Use Bootstrap for form and table layout
Match professional hospital CRUD interface standards

🎯 Learning Outcome
By completing this project, trainees will understand:
✔ Real‑world Patient Management System logic
✔ SQL CRUD operations with healthcare data
✔ PHP‑MySQL integration
✔ Pagination, Search, Sorting
✔ Clean project structure used in hospital systems

