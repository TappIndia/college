# College Management System

A modular web application for managing college operations including students, staff, and designations. Built with PHP, MySQL, and Bootstrap for a responsive, user-friendly interface.

---

## 📋 Project Overview

This college management system provides a centralized platform for:
- Managing student records and information
- Managing staff details and designations
- Organizing organizational hierarchy
- Full CRUD (Create, Read, Update, Delete) operations across all modules

---

## 🎯 Features

✅ **Student Module** – Add, view, edit, delete student records  
✅ **Staff Module** – Manage staff with designation assignments  
✅ **Designation Module** – Create and manage staff designations  
✅ **Responsive UI** – Bootstrap 5 for mobile-friendly design  
✅ **Database Relations** – Proper foreign key constraints  
✅ **Shared Navigation** – Consistent navbar across all modules  
✅ **Form Validation** – Safe handling of user inputs  

---

## 🏗️ Project Structure

```
college/
├── README.md                 # This file
├── db.php                    # Database connection configuration
├── layout/
│   └── nav.php              # Shared navigation bar
├── student/
│   ├── table.php            # View all students
│   ├── add.php              # Add new student form
│   ├── create.php           # Process add student
│   ├── single.php           # View single student
│   ├── edit.php             # Edit student form
│   ├── update.php           # Process edit student
│   └── delete.php           # Delete student
├── staff/
│   ├── table.php            # View all staff
│   ├── add.php              # Add new staff form
│   ├── create.php           # Process add staff
│   ├── single.php           # View single staff
│   ├── edit.php             # Edit staff form
│   ├── update.php           # Process edit staff
│   └── delete.php           # Delete staff
└── designation/
    ├── table.php            # View all designations
    ├── add.php              # Add new designation form
    ├── create.php           # Process add designation
    ├── edit.php             # Edit designation form
    ├── update.php           # Process edit designation
    └── delete.php           # Delete designation
```

---

## 📦 Modules

### 1. **Student Module** (`student/`)
Manages student records with the following fields:
- ID (auto-increment)
- Name
- Mobile Number
- Address
- Gender
- Date of Birth
- Father's Name
- Mother's Name

**Features:**
- List all students in a table
- Add new student records
- View individual student details
- Edit existing student information
- Delete student records

---

### 2. **Staff Module** (`staff/`)
Manages staff information with designation assignment:
- ID (auto-increment)
- Name
- Mobile Number
- Address
- Gender
- Date of Birth
- Email
- Designation (foreign key to designations table)

**Features:**
- List all staff members
- Add new staff with designation dropdown
- View individual staff details
- Edit staff information and designations
- Delete staff records
- Dynamic dropdown populated from designations table

---

### 3. **Designation Module** (`designation/`)
Manages job titles and designations:
- ID (auto-increment)
- Designation Name

**Features:**
- List all designations
- Add new designation
- Edit existing designation
- Delete designation

---

## 🔧 Tech Stack

| Component | Technology | Version |
|-----------|-----------|---------|
| **Server** | Apache | (via WAMP) |
| **Backend** | PHP | 8.3.28 |
| **Database** | MySQL | 8.4.7 |
| **Database Engine** | InnoDB | With Foreign Keys |
| **Frontend** | Bootstrap | 5.3.8 |
| **Charset** | UTF-8 | UTF8MB4 |

---

## 🗄️ Database Schema

### Tables

#### `student`
```sql
CREATE TABLE student (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  mobile VARCHAR(15),
  address TEXT,
  gender ENUM('Male', 'Female', 'Other'),
  dob DATE,
  father_name VARCHAR(100),
  mother_name VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### `staff`
```sql
CREATE TABLE staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  mobile VARCHAR(15),
  address TEXT,
  gender ENUM('Male', 'Female', 'Other'),
  dob DATE,
  email VARCHAR(100),
  designation_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (designation_id) REFERENCES designation(id) ON DELETE RESTRICT
);
```

#### `designation`
```sql
CREATE TABLE designation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  designation_name VARCHAR(100) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🚀 Installation & Setup

### Prerequisites
- WAMP Server (or Apache + PHP + MySQL)
- PHP 8.0+
- MySQL 8.0+
- Git

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/TappIndia/college.git
   cd college
   ```

2. **Place in WAMP htdocs:**
   ```
   D:\wamp64\www\project\college
   ```

3. **Import database schema:**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create database: `college`
   - Import SQL schema file (if provided)
   - Or run SQL statements from database schema section

4. **Configure database connection:**
   - Edit `db.php` if needed
   - Default: `localhost`, user: `root`, password: `''`

5. **Access the application:**
   - Navigate to: `http://localhost/project/college/student/table.php`
   - Use navbar to switch between modules

---

## 📖 Usage

### Adding a Record
1. Click on module (Students, Staff, Designations)
2. Click **+ Add** button
3. Fill form with required information
4. Click **Submit** to save

### Viewing Records
1. Module table shows all records
2. Click **View** button in Action column
3. View individual record details

### Editing a Record
1. From table view, click **Edit** button
2. Update form fields
3. Click **Update** to save changes

### Deleting a Record
1. From table view, click **Delete** button
2. Confirm deletion
3. Record will be removed

---

## 🔐 Security Notes

- All user inputs are escaped using `mysqli_real_escape_string()`
- HTML special characters encoded with `htmlspecialchars()`
- Database connections use mysqli
- Foreign key constraints prevent orphaned records

### Future Enhancements
- Implement prepared statements for better SQL injection prevention
- Add user authentication and role-based access control
- Add input validation with error messages
- Add CSRF token protection
- Implement pagination for large datasets

---

## 📁 File Descriptions

| File | Purpose |
|------|---------|
| `db.php` | Database connection and configuration |
| `layout/nav.php` | Shared navigation bar component |
| `*/table.php` | Display all records in table format |
| `*/add.php` | Form to add new record |
| `*/create.php` | Process form submission for adding |
| `*/single.php` | Display single record details |
| `*/edit.php` | Form to edit existing record |
| `*/update.php` | Process form submission for updating |
| `*/delete.php` | Handle record deletion |

---

## 🛠️ Troubleshooting

**Issue:** "Database connection failed"
- Check MySQL is running in WAMP
- Verify credentials in `db.php`
- Ensure `college` database exists

**Issue:** "Table doesn't exist"
- Import the database schema
- Check database name matches `db.php`

**Issue:** "Designation dropdown empty"
- Add designations first via Designation module
- Check staff table has proper foreign key reference

---

## 📝 Future Improvements

- [ ] Add search and filter functionality
- [ ] Implement pagination for large datasets
- [ ] Add data export (CSV/PDF)
- [ ] User authentication system
- [ ] Dashboard with statistics
- [ ] Reports generation
- [ ] Image upload for profiles
- [ ] API endpoints for mobile app

---

## 👤 Author

**TappIndia**  
Email: tappindia2020@gmail.com  
GitHub: [@TappIndia](https://github.com/TappIndia)

---

## 📄 License

This project is open source and available under the MIT License.

---

## 🤝 Contributing

Contributions are welcome! Feel free to fork, create a branch, and submit pull requests.

---

**Last Updated:** April 2026  
**Status:** Active Development
