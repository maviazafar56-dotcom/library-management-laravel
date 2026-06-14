<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use \App\Mail\ApproveMail;
use \App\Mail\RemoveStudentMail;
use \App\Mail\RejectMail;
use Hash;
use App\Student;
use App\Book;
use App\Record;

class StudentManageController extends Controller
{
    public function student_approve($id)
    {

        $data=array();

        $data['Verify']="Approve";

        $student=Student::where('id',$id)->first();
        if(! $student)
        {
            $notification = array(
                'message' => 'Student not found !',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        $approve=Student::where('id',$id)->update($data);

        if($approve)
        {

            $details_approve = [
                'title' => 'Seminar Library Management System',
                'body' => 'Congrats! Your account is approved.Please login now...'
            ];

            if($student->Email)
            {
                \Mail::to($student->Email)->send(new \App\Mail\ApproveMail($details_approve));
            }

            $notification = array(
                'message' => 'Successfully Approved !',
                'alert-type' => 'success'
            );
    
            return back()->with($notification);
        }
    }
    public function student_reject($id)
    {
        $student=Student::where('id',$id)->first();
        if(! $student)
        {
            $notification = array(
                'message' => 'Student not found !',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        $reject=Student::where('id',$id)->delete();
        if($reject)
        {

            $details_reject = [
                'title' => 'Seminar Library Management System',
                'body' => 'Opps! Your account is rejected.Please try again...'
            ];

            if($student->Email)
            {
                \Mail::to($student->Email)->send(new \App\Mail\RejectMail($details_reject));
            }
            $notification = array(
                'message' => 'Successfully Rejected !',
                'alert-type' => 'success'
            );
    
            return back()->with($notification);


        }

    }
    public function remove_student()
    {
        $admin_status=Session::get('Admin_ID');
        
        if(! $admin_status)
        {

            return Redirect::to('/admin');
        }

        $student=Student::where('Verify','Approve')->get();

        return view('admin.remove_student',compact('student'));
    }
    public function remove_student_process($id)
    {

        $student=Student::where('id',$id)->where('Verify','Approve')->first();
        if(! $student)
        {
            $notification = array(
                'message' => 'Student not found !',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        $record=Record::where('Student_ID',$student->Student_ID)
        ->where('Submission_Status','No')
        ->count();

        if($record > 0)
        {    
            $notification = array(
                'message' => 'This student has already some books !',
                'alert-type' => 'error'
            );
    
            return back()->with($notification);

        }

        $details_remove = [
            'title' => 'Seminar Library Management System',
            'body' => 'Opps! Your account is deleted by Admin'
        ];

        if($student->Email)
        {
            \Mail::to($student->Email)->send(new \App\Mail\RemoveStudentMail($details_remove));
        }
        $remove_student=Student::where('id',$id)->delete();
        if($remove_student)
        {

            $notification = array(
                'message' => 'Successfully Removed Student !',
                'alert-type' => 'success'
            );
    
            return back()->with($notification);




        }



    }
    public function student_info()
    {  
        $admin_status=Session::get('Admin_ID');
        
        if(! $admin_status)
        {

            return Redirect::to('/admin');
        }

        $student=Student::where('Verify','Approve')->get();

        return view('admin.student_info',compact('student'));
    }
    public function student_details($id)
    {

        $student=Student::where('Verify','Approve')->find($id);

        $book=Record::join('books', 'records.Book_ID', '=', 'books.Book_ID')
            ->where('records.Student_ID',$student->Student_ID)
            ->where('records.Submission_Status','No')
            ->select('records.*', 'books.Book_Name', 'books.Writer_Name', 'books.Catagory')
            ->get();

        $student=Student::where('Verify','Approve')->where('id',$id)->get();


        return view('admin.student_details',compact('student','book'));

    }
    public function notification()
    {

        $admin_status=Session::get('Admin_ID');
        
        if(! $admin_status)
        {

            return Redirect::to('/admin');
        }

        $notification=Student::whereIn('Verify',['Pending','Panding'])
            ->where('Read','No')
            ->get();

        $data=array();


        $data['Read']="Yes";
        $update=Student::whereIn('Verify',['Pending','Panding'])
            ->where('Read','No')
            ->update($data);

        return view('admin.notification',compact('notification'));


    }
    public function notify_count()
    {


        $student=Student::whereIn('Verify',['Pending','Panding'])
            ->where('Read','No')
            ->count();

        if($student == 0)
        {

            return null;
            

        }

        return $student;

    }
    public function my_collection()
    {

        $student_status=Session::get('Student_ID');

        if(! $student_status)
        {

            return Redirect::to('/');
        }
        $student=Student::find($student_status);


        $collection=Record::join('books', 'records.Book_ID', '=', 'books.Book_ID')
            ->where('records.Student_ID',$student->Student_ID)
            ->where('records.Submission_Status','No')
            ->select('records.*', 'books.Book_Name', 'books.Writer_Name', 'books.Catagory')
            ->get();

        $student=Student::where('id',$student_status)->get();


        return view('student.my_collection',compact('student','collection'));


    }
    public function submit_book($id)
    {
        $student_status = Session::get('Student_ID');
        if (!$student_status) {
            return Redirect::to('/');
        }

        // Get the record
        $record = Record::find($id);
        
        if (!$record) {
            $notification = array(
                'message' => 'Record not found!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // Check if the book belongs to the student
        $student = Student::find($student_status);
        if ($record->Student_ID != $student->Student_ID) {
            $notification = array(
                'message' => 'Unauthorized action!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // Update the record to mark as pending return
        date_default_timezone_set("Asia/Karachi");
        $today = date("d-m-Y");
        
        $data = array(
            'Submission_Status' => 'Pending',
            'Submission_Date' => $today
        );

        // Update the record
        $update = Record::where('id', $id)->update($data);

        if ($update) {
            // Send notification to admin
            $admin_email = 'admin@library.com'; // Replace with actual admin email
            $book = Book::where('Book_ID', $record->Book_ID)->first();
            
            if ($book) {
                $details = [
                    'title' => 'Book Submission Request',
                    'body' => "Student ID: {$student->Student_ID} has requested to submit the book: {$book->Book_Name} (ID: {$book->Book_ID})."
                ];
                
                try {
                    if (filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
                        if (class_exists('App\\Mail\\BookSubmissionMail')) {
                            \Mail::to($admin_email)->send(new \App\Mail\BookSubmissionMail($details));
                        } else {
                            // Fallback email sending if the mail class is not found
                            \Mail::raw($details['body'], function($message) use ($admin_email, $details) {
                                $message->to($admin_email)
                                        ->subject($details['title']);
                            });
                        }
                    }
                } catch (\Exception $e) {
                    // Log the error but don't show it to the user
                    \Log::error('Failed to send email: ' . $e->getMessage());
                }
            }

            $notification = array(
                'message' => 'Book submission request sent successfully! The book is now pending admin approval.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Failed to submit book. Please try again.',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }

    public function my_submission()
    {
        $student_status=Session::get('Student_ID');
        if(!$student_status)
        {
            return Redirect::to('/');
        }
        $student=Student::find($student_status);


        $submission=Record::join('books', 'records.Book_ID', '=', 'books.Book_ID')
            ->where('records.Student_ID',$student->Student_ID)
            ->where('records.Submission_Status','Yes')
            ->select('records.*', 'books.Book_Name', 'books.Writer_Name', 'books.Catagory')
            ->get();

        $student=Student::where('id',$student_status)->get();


        return view('student.my_submission',compact('student','submission'));




    }
 
}
