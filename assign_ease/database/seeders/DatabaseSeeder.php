<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Submission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@university.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department' => 'Administration',
        ]);

        // Create Lecturers
        $lecturer1 = User::create([
            'name' => 'Dr. Adeyemi Ogunleye',
            'email' => 'adeyemi.ogunleye@university.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
            'staff_id' => 'STAFF001',
            'department' => 'Computer Science',
        ]);

        $lecturer2 = User::create([
            'name' => 'Prof. Ngozi Okeke',
            'email' => 'ngozi.okeke@university.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
            'staff_id' => 'STAFF002',
            'department' => 'Software Engineering',
        ]);

        // Create Students
        $student1 = User::create([
            'name' => 'Chidinma Nwosu',
            'email' => 'chidinma.nwosu@student.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'student',
            'matric_number' => 'CSC/2020/001',
            'department' => 'Computer Science',
        ]);

        $student2 = User::create([
            'name' => 'Oluwaseun Adebayo',
            'email' => 'oluwaseun.adebayo@student.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'student',
            'matric_number' => 'CSC/2020/002',
            'department' => 'Computer Science',
        ]);

        $student3 = User::create([
            'name' => 'Fatima Ibrahim',
            'email' => 'fatima.ibrahim@student.edu.ng',
            'password' => Hash::make('password'),
            'role' => 'student',
            'matric_number' => 'CSC/2020/003',
            'department' => 'Computer Science',
        ]);

        // Create Assignments
        $assignment1 = Assignment::create([
            'lecturer_id' => $lecturer1->id,
            'title' => 'Database Design and Implementation',
            'description' => 'Design and implement a database for a university library management system. Include ER diagrams, normalization process, and SQL scripts.',
            'course_code' => 'CSC 301',
            'course_title' => 'Database Management Systems',
            'due_date' => now()->addDays(7),
            'total_marks' => 100,
        ]);

        $assignment2 = Assignment::create([
            'lecturer_id' => $lecturer1->id,
            'title' => 'Web Application Development',
            'description' => 'Develop a simple e-commerce website using HTML, CSS, JavaScript, and PHP. Should include product listing, cart functionality, and checkout.',
            'course_code' => 'CSC 302',
            'course_title' => 'Web Technologies',
            'due_date' => now()->addDays(14),
            'total_marks' => 100,
        ]);

        $assignment3 = Assignment::create([
            'lecturer_id' => $lecturer2->id,
            'title' => 'Software Requirements Analysis',
            'description' => 'Conduct a requirements analysis for a mobile banking application. Include use cases, user stories, and functional requirements.',
            'course_code' => 'SEN 401',
            'course_title' => 'Software Engineering',
            'due_date' => now()->addDays(10),
            'total_marks' => 100,
        ]);

        // Create past assignment
        $assignment4 = Assignment::create([
            'lecturer_id' => $lecturer2->id,
            'title' => 'Agile Project Management',
            'description' => 'Write a report on Agile methodologies and their application in modern software development.',
            'course_code' => 'SEN 402',
            'course_title' => 'Project Management',
            'due_date' => now()->subDays(2),
            'total_marks' => 100,
        ]);

        // Create some submissions
        Submission::create([
            'assignment_id' => $assignment1->id,
            'student_id' => $student1->id,
            'file_path' => 'submissions/database_design_chidinma.pdf',
            'submitted_at' => now()->subHours(2),
            'status' => 'submitted',
        ]);

        Submission::create([
            'assignment_id' => $assignment4->id,
            'student_id' => $student2->id,
            'file_path' => 'submissions/agile_report_oluwaseun.pdf',
            'submitted_at' => now()->subDays(1),
            'status' => 'late',
        ]);

        Submission::create([
            'assignment_id' => $assignment4->id,
            'student_id' => $student1->id,
            'file_path' => 'submissions/agile_report_chidinma.pdf',
            'submitted_at' => now()->subDays(3),
            'status' => 'graded',
            'score' => 85,
            'feedback' => 'Excellent work! Good understanding of Agile principles.',
        ]);
    }
}