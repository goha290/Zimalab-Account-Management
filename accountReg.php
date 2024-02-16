<?php
class Account
{
    private $firstname;
    private $secondname;
    private $email;
    private $companyname;
    private $position;
    private $phone;
    private $secondphone;
    private $alternatephone;

    public function __construct($firstname, $secondname, $email, $companyname, $position, $phone, $secondphone, $alternatephone)
    {
        $this->firstname = filter_var(trim($firstname), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->secondname = filter_var(trim($secondname), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        $this->companyname = filter_var(trim($companyname), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->position = filter_var(trim($position), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->phone = filter_var(trim($phone), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->secondphone = filter_var(trim($secondphone), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->alternatephone = filter_var(trim($alternatephone), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function validateInput()
    {
        // Код валидации входных данных
        if (mb_strlen($this->firstname) < 2 || mb_strlen($this->firstname) > 50) {
            echo "Invalid first name length";
            exit();
        } elseif (mb_strlen($this->secondname) < 2 || mb_strlen($this->secondname) > 50) {
            echo "Invalid last name length";
            exit();
        } elseif (mb_strlen($this->email) < 5 || mb_strlen($this->email) > 320) {
            echo "Invalid email length";
            exit();
        } elseif (mb_strlen($this->companyname) > 100) {
            echo "Invalid company name length";
            exit();
        } elseif (mb_strlen($this->position) > 100) {
            echo "Invalid position length";
            exit();
        } elseif (mb_strlen($this->phone) > 20 || mb_strlen($this->secondphone) > 20 || mb_strlen($this->alternatephone) > 20) {
            echo "Invalid phone number length";
            exit();
        }
    }

    public function addToDatabase()
    {
        $mysql = new mysqli('localhost', 'root', 'root', 'accountmanagementdb');
        if ($mysql->connect_error) {
            die("Connection error: " . $mysql->connect_error);
        }

        $stmt = $mysql->prepare("INSERT INTO accounts (firstName, lastName, emailAddress, companyName, position, phoneNumber, secondaryPhone, alternatePhone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $this->firstname, $this->secondname, $this->email, $this->companyname, $this->position, $this->phone, $this->secondphone, $this->alternatephone);

        if ($stmt->execute() === TRUE) {
            echo '<script>alert("The account has been successfully registered")</script>';
            echo '<script>window.location.href = "registration.html";</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '")</script>';
            echo '<script>window.location.href = "registration.html";</script>';
        }

        $stmt->close();
        $mysql->close();
    }
}
