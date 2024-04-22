Document Management System

Introduction

The Document Management System (DMS) is a web application designed to streamline the process of storing, managing, 
and sharing documents within an organization. 

The primary aim of the DMS is to provide a secure, accessible, and easy-to-use platform for managing a variety of documents, 
from business contracts to employee records. 

The application not only facilitates efficient document handling but also ensures that critical information is safeguarded against unauthorized access and data breaches.
The system is developed from scratch without the use of any pre-existing source code, thus ensuring tailor-made solutions specific to the security and functionality 
requirements of the system.

Security Requirements
The DMS must adhere to stringent security requirements to protect against common web vulnerabilities and threats. Key security requirements include:

1. Authentication: Robust authentication mechanisms ensure that only authorized users can access the system. The system employs secure password storage with hashed passwords and utilizes session management to handle user logins and logouts effectively.
2. Authorization: Ensures that users can only access documents and functionalities relevant to their permission levels. Administrators and regular users have distinct access rights.
3. Data Validation: All input from users is validated both on the client and server sides to prevent common web attacks such as SQL injection and XSS.
4. Session Management: Secure session management mechanisms are implemented to prevent session hijacking and fixation attacks.
5. Error Handling and Logging: Proper error handling mechanisms are in place to avoid leakage of sensitive information through error messages. Logging is used for auditing and monitoring user activities.

Design & Architecture
The DMS is designed with a multi-tier architecture comprising the 
    -> Presentation layer.
    -> Business logic layer.
    -> Data access layer. 
This separation ensures that each component can be secured independently based on the specific threats it faces:

Presentation Layer (Client-Side): Handles user interface and client-side validations using JavaScript and Bootstrap for styling.
Business Logic Layer (Server-Side): Written in PHP, it processes business rules, authentication, and authorization.
Data Access Layer: Manages data persistence and protects against SQL injection attacks by using prepared statements with parameterized queries.

Security considerations such as ensuring all data exchanged between the client and server is encrypted using HTTPS and 
employing CSRF tokens in forms to prevent CSRF attacks were integral during the design phase

Implementation
The implementation of the DMS followed best practices in secure coding to mitigate various web application vulnerabilities:

Input Validation: Implemented using PHP to ensure all inputs are sanitized before processing to prevent XSS and SQL Injection. Example below:
`$title = htmlspecialchars($_POST['title']);`

Authentication and Session Management: Used PHP session management to handle user sessions securely. Passwords are hashed using PHP's MD5() function, enhancing the security of user credentials.

Prevention of SQL Injection: Used prepared statements in PHP to interact with the MySQL database securely. Example below:

`$stmt = $conn->prepare("INSERT INTO documents (title, content) VALUES (?, ?)");`
`$stmt->bind_param("ss", $title, $content);`

CSRF Protection: Included CSRF tokens in forms to ensure that POST requests originate from the application, preventing CSRF attacks.


Testing
Testing was performed in two main phases: Functional Testing and Static Application Security Testing (SAST):

Functional Testing: Tested major functionalities such as document upload, download, edit, and delete operations to ensure they work as expected without security breaches.

Static Application Security Testing (SAST): SonarQube was used to analyze the code for potential security vulnerabilities. The tests focused on identifying insecure coding practices and configuration errors.

Three major security features tested included:

1. Authentication Mechanism: Tests ensured that password handling was secure and session management was correctly implemented.
2. Input Sanitization: Tested to confirm that inputs are correctly sanitized, preventing XSS and SQL Injection.
3. CSRF Protection: Each form was tested to ensure that CSRF tokens were properly validated.
