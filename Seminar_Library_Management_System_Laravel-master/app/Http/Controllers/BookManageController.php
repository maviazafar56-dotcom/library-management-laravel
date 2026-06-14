<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Hash;
use \App\Mail\BookOrderMail;
use \App\Mail\BookReceiveMail;
use Illuminate\Support\Facades\Redirect;
use App\Book;
use App\Shelf;
use App\Student;
use App\Record;
class BookManageController extends Controller
{
    public function add_shelf()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        return view('admin.add_shelf');
    }
    public function add_shelf_process(Request $req)
    {
        $data=array();
        $data['Shelf_ID']=$req->shelf_id;
        $data['Shelf_Location']=$req->shelf_location;
        $unique_shelf=Shelf::where('Shelf_ID',$req->shelf_id)->count();
        if($unique_shelf > 0){
            $notification = array(
                'message' => 'Shelf ID already exits !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $add_shelf=Shelf::create($data);
        if($add_shelf)
        {
            $notification = array(
                'message' => 'Successfully added shelf !',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
    }
    public function update_shelf()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::all();
        return view('admin.update_shelf',compact('shelf'));
    }
    public function edit_shelf($id)
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::where('id',$id)->first();
        $books_amount=Book::where('Shelf_ID',$shelf->Shelf_ID)->sum('Amounts');
        $shelf=Shelf::where('id',$id)->get();
        return view('admin.edit_shelf',compact('shelf','books_amount'));
    }
    public function edit_shelf_process(Request $req,$id)
    {
        $data=array();
        $data['Shelf_Location']=$req->shelf_location;
        $update_shelf=Shelf::where('id',$id)->update($data);
        if($update_shelf)
        {
            $notification = array(
                'message' => 'Successfully updated shelf !',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Already same location exits !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
    }
    public function remove_shelf()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::all();
        return view('admin.remove_shelf',compact('shelf'));
    }
    public function remove_shelf_process($id)
    {
        $shelf=Shelf::find($id);
        $books_amount=Book::where('Shelf_ID',$shelf->Shelf_ID)->sum('Amounts');
        if($books_amount > 0)
        {
            $notification = array(
                'message' => 'Already some books exits in this self !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $books_shelf=Record::where('Shelf_ID',$shelf->Shelf_ID)->count();
        if($books_shelf > 0)
        {
            $notification = array(
                'message' => 'Already some books of the self exits in students  !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $delete_shelf=Shelf::where('id',$id)->delete();
        if($delete_shelf)
        {
            $notification = array(
                'message' => 'Successfully deleted shelf !',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
    }
    public function add_book()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::all();
        return view('admin.add_book',compact('shelf'));
    }
    public function add_book_process(Request $req)
    {
        if($req->amounts <=0)
        {
            $notification = array(
                'message' => 'Amounts of Book is not Negative or Zero !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $check_book=Book::where('Book_ID',$req->book_id)->count();
        if($check_book > 0)
        {
            $notification = array(
                'message' => 'Book ID already exits !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $data=array();
        $data['Book_ID']=$req->book_id;
        $data['Book_Name']=$req->book_name;
        $data['Writer_Name']=$req->writer_name;
        $data['Catagory']=$req->catagory;
        $data['Shelf_ID']=$req->shelf_id;
        $data['Amounts']=$req->amounts;
        $add_book=Book::create($data);
        if($add_book)
        {
            $notification = array(
                'message' => 'Sucessfully Added Book',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
    }
    public function update_book()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $books=Book::all();
        return view('admin.update_books',compact('books'));
    }
    public function edit_book($id)
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $books=Book::where('id',$id)->get();
        $shelf=Shelf::all();
        return view('admin.edit_books',compact('books','shelf'));
    }
    public function edit_book_process(Request $req,$id)
    {
        if($req->amounts < 0)
        {
            $notification = array(
                'message' => 'Amounts of Book is not Negative !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $data=array();
        $data['Shelf_ID']=$req->shelf_id;
        $data['Amounts']=$req->amounts;
        $update_book=Book::where('id',$id)->update($data);
        if($update_book)
        {
            $notification = array(
                'message' => 'Successfully updated book !',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Same data already exits !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
    }
    public function remove_book()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $books=Book::all();
        return view('admin.remove_books',compact('books'));
    }
    public function remove_book_process($id)
    {
        $book=Book::where('id',$id)->first();
        $student_copy=Record::where('Book_ID',$book->Book_ID)
        ->where('Submission_Status','No')
        ->count();
        if($student_copy > 0)
        {
            $notification = array(
                'message' => 'Student has already this book !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $book=Book::find($id);
        if($book->Amounts > 0)
        {
            $notification = array(
                'message' => 'Shelf has already this book !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $delete_book=Book::where('id',$id)->delete();
        if($delete_book)
        {
            $notification = array(
                'message' => 'Successfully deleted book !',
                'alert-type' => 'success'
            );
           return back()->with($notification);
        }
    }
    public function book_order()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $book_order=Record::join('students', 'records.Student_ID', '=', 'students.Student_ID')
            ->join('books', 'records.Book_ID', '=', 'books.Book_ID')
            ->select('records.*', 'students.Name as Student_Name', 'students.Email as Student_Email', 'books.Book_Name', 'books.Writer_Name')
            ->get();
        return view('admin.book_order_show',compact('book_order'));
    }
    public function add_order()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        return view('admin.add_order');
    }
    public function add_order_process(Request $req)
    {
        $student=Student::where('Verify','Approve')->where('Student_ID',$req->student_id)->count();
        if(! $student)
        {
            $notification = array(
                'message' => 'Wrong Student ID !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $book=Book::where('Book_ID',$req->book_id)->count();
        if(! $book)
        {
            $notification = array(
                'message' => 'Wrong Book ID !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $again_order=Record::where('Book_ID',$req->book_id)
        ->where('Student_ID',$req->student_id)
        ->where('Submission_Status','No')
        ->count();
        if($again_order)
        {
            $notification = array(
                'message' => 'Sorry, This book is already ordered for same student !',
                'alert-type' => 'error'
            );
           return back()->with($notification);
        }
        $data=array();
        $data['Book_ID']=$req->book_id;
        $data['Student_ID']=$req->student_id;
        date_default_timezone_set("Asia/Karachi");
        $today=date("d-m-Y");
        $data['Collection_Date']=$today;
        $data['Submission_Status']="No";
        $data['Submission_Date']="N/A";
        $data['Read']="No";
        $expiredDate = date('d-m-Y', strtotime("+6 months", strtotime($today)));
        $data['Expired_Date']=$expiredDate;
        $add_order=Record::create($data);
        if($add_order)
        {
            $book=Book::where('Book_ID',$req->book_id)->first();
            $data2=array();
            $data2['Amounts']=$book->Amounts - 1;
            $remove_book=Book::where('Book_ID',$req->book_id)->update($data2);
            if($remove_book)
            {
                $student=Student::where('Student_ID',$req->student_id)->first();
                $details_order = [
                    'title' => 'Seminar Library Management System',
                    'body' => 'Book ID  - "'.$req->book_id.'" ordered for you. Expired Date - .'.$expiredDate
                ];
                \Mail::to($student->Email)->send(new \App\Mail\BookOrderMail($details_order));
                $notification = array(
                    'message' => 'Successfully order completed !',
                    'alert-type' => 'success'
                );
               return back()->with($notification);
            }
        }
    }
    public function book_received()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $book_order=Record::join('students', 'records.Student_ID', '=', 'students.Student_ID')
            ->join('books', 'records.Book_ID', '=', 'books.Book_ID')
            ->where('records.Submission_Status','Pending')
            ->select('records.*', 'students.Name as Student_Name', 'students.Email as Student_Email', 'books.Book_Name', 'books.Writer_Name')
            ->orderBy('records.Submission_Date', 'desc')
            ->get();
        return view('admin.book_received',compact('book_order'));
    }
    public function book_received_process($id)
    {
        date_default_timezone_set("Asia/Karachi");
        $today = date("d-m-Y");
        
        $record = Record::find($id);
        if (!$record) {
            $notification = array(
                'message' => 'Record not found !',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // Set values to compute fine
        $record->Submission_Date = $today;
        $record->Submission_Status = "Yes";
        
        // Calculate fine at return time and persist it
        $fine = $record->calculateFine(); 
        $record->Fine = $fine;
        $record->save();

        // Update book amount
        $book = Book::where('Book_ID', $record->Book_ID)->first();
        if ($book) {
            $book->Amounts = $book->Amounts + 1;
            $book->save();
        }

        // Send mail
        $student = Student::where('Verify', 'Approve')->where('Student_ID', $record->Student_ID)->first();
        $details_received = [
            'title' => 'Seminar Library Management System',
            'body' => 'Book ID  - "' . $record->Book_ID . '" received by Admin. Fine Charged: Rs. ' . $fine
        ];
        
        if ($student && $student->Email) {
            try {
                \Mail::to($student->Email)->send(new \App\Mail\BookReceiveMail($details_received));
            } catch (\Exception $e) {
                \Log::error('Failed to send returned email: ' . $e->getMessage());
            }
        }

        $notification = array(
            'message' => 'Successfully received! Fine Charged: Rs. ' . $fine,
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function book_details($id)
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $book=Book::where('id',$id)->first();
        $records=Record::where('Book_ID',$book->Book_ID)
        ->where('Submission_Status','No')
        ->get();
        $book=Book::where('id',$id)->get();
        return view('admin.book_details',compact('book','records'));
    }
    public function shelf_list()
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::all();
        return view('admin.shelf_list',compact('shelf'));
    }

    public function shelf_list_student()
    {
        $student_status=Session::get('Student_ID');
        if(! $student_status)
        {
            return Redirect::to('/');
        }
        $student=Student::where('id', $student_status)->get();
        $shelf=Shelf::all();
        return view('student.shelf_list',compact('student','shelf'));
    }
    public function allocate_book_student(Request $req)
    {
        $student_status=Session::get('Student_ID');
        if(! $student_status)
        {
            return Redirect::to('/');
        }
        $student=Student::find($student_status);
        // Check if student already has this book
        $existing_record=Record::where('Student_ID',$student->Student_ID)
            ->where('Book_ID',$req->book_id)
            ->where('Submission_Status','No')
            ->count();
        if($existing_record > 0)
        {
            $notification = array(
                'message' => 'You already have this book!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        // Check book availability
        $book=Book::where('Book_ID',$req->book_id)->first();
        if($book->Amounts <= 0)
        {
            $notification = array(
                'message' => 'Book is not available!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        date_default_timezone_set("Asia/Karachi");
        $today=date("d-m-Y");
        $expired_date=date('d-m-Y', strtotime('+15 days'));
        $data=array();
        $data['Book_ID']=$req->book_id;
        $data['Student_ID']=$student->Student_ID;
        $data['Collection_Date']=$today;
        $data['Expired_Date']=$expired_date;
        $data['Submission_Status']="No";
        $data['Submission_Date']="N/A";
        $data['Read']="No";
        $allocate_book=Record::create($data);
        if($allocate_book)
        {
            // Update book amount
            $new_amount = $book->Amounts - 1;
            Book::where('Book_ID',$req->book_id)->update(['Amounts'=>$new_amount]);
            $notification = array(
                'message' => 'Book allocated successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Allocation failed! Please try again.',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
    public function shelf_details($id)
    {
        $admin_status=Session::get('Admin_ID');
        if(! $admin_status)
        {
            return Redirect::to('/admin');
        }
        $shelf=Shelf::find($id);
        $books_amount=Book::where('Shelf_ID',$shelf->Shelf_ID)->sum('Amounts');
        $book=Book::where('Shelf_ID',$shelf->Shelf_ID)->get();
        $shelf=Shelf::where('id',$id)->get();
        return view('admin.shelf_details',compact('book','shelf','books_amount'));
    }
    public function shelf_details_student($id)
    {
        $student_status=Session::get('Student_ID');
        if(! $student_status)
        {
            return Redirect::to('/');
        }
        $student=Student::where('id',$student_status)->get();
        $shelf=Shelf::find($id);
        $book=Book::where('Shelf_ID',$shelf->Shelf_ID)->get();
        $shelf=Shelf::where('id',$id)->get();
        return view('student.shelf_details',compact('student','book','shelf'));
    }
    public function student_notification()
    {
        $student_status=Session::get('Student_ID');
        if(! $student_status)
        {
            return Redirect::to('/');
        }
        $student=Student::find($student_status);
        $records=Record::where('Student_ID',$student->Student_ID)
        ->where('Submission_Status','No')
        ->where('Read','No')
        ->get();
        date_default_timezone_set("Asia/Karachi");
        $today=date("d-m-Y");

        $todayTs = strtotime($today);
        $expiredIds = [];
        foreach($records as $row)
        {
            $expiredTs = strtotime($row->Expired_Date);
            if($expiredTs && $expiredTs <= $todayTs)
            {
                $expiredIds[] = $row->id;
            }
        }

        if(count($expiredIds) > 0)
        {
            $data=array();
            $data['Read']="Yes";
            $update_read=Record::whereIn('id',$expiredIds)
                ->update($data);
        }
        $student=Student::where('id',$student_status)->get();
        return view('student.notification',compact('student','records'));
    }
    public function student_notify_count()
    {
        $student_status=Session::get('Student_ID');
        if(! $student_status)
        {
            return Redirect::to('/');
        }
        date_default_timezone_set("Asia/Karachi");
        $today=date("d-m-Y");
        $today = strtotime($today); 
        $student=Student::find($student_status);
        $records=Record::where('Student_ID',$student->Student_ID)
        ->where('Submission_Status','No')
        ->where('Read','No')
        ->get();
        $count=0;
        foreach($records as $row)
        {
            $Expired_Date = strtotime($row->Expired_Date);
            if($Expired_Date <= $today)
            {
                $count++;
            }
        }
        /*
        $records=Record::where('Student_ID',$student->Student_ID)
        ->where('Submission_Status','No')
        ->where('Read','No')->where('Expired_Date','<=',$today)
        ->count();
        */
        if($count == 0)
        {
            return null;
        }
        return $count;
    }

    public function book_list_student($category)
    {
        $student_status = Session::get('Student_ID');
        if (!$student_status) {
            return Redirect::to('/');
        }
        $student = Student::where('id', $student_status)->get();
        $categoryName = str_replace('-', ' ', $category);
        $books = Book::where('Catagory', 'like', '%' . $categoryName . '%')->get();
        return view('student.book_list', compact('student', 'books', 'category'));
    }

    public function book_list_admin($category)
    {
        $admin_status = Session::get('Admin_ID');
        if (!$admin_status) {
            return Redirect::to('/admin');
        }
        $categoryName = str_replace('-', ' ', $category);
        $books = Book::where('Catagory', 'like', '%' . $categoryName . '%')->get();
        return view('admin.book_list', compact('books', 'category'));
    }

    public function all_books_student(Request $request)
    {
        $student_status = Session::get('Student_ID');
        if (!$student_status) {
            return Redirect::to('/');
        }
        $student = Student::where('id', $student_status)->get();
        
        $query = Book::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Book_ID', 'like', "%{$search}%")
                  ->orWhere('Book_Name', 'like', "%{$search}%")
                  ->orWhere('Writer_Name', 'like', "%{$search}%")
                  ->orWhere('Catagory', 'like', "%{$search}%");
            });
        }
        
        $books = $query->get();
        return view('student.book_list', compact('student', 'books'));
    }

    public function all_books_admin(Request $request)
    {
        $admin_status = Session::get('Admin_ID');
        if (!$admin_status) {
            return Redirect::to('/admin');
        }
        
        $query = Book::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Book_ID', 'like', "%{$search}%")
                  ->orWhere('Book_Name', 'like', "%{$search}%")
                  ->orWhere('Writer_Name', 'like', "%{$search}%")
                  ->orWhere('Catagory', 'like', "%{$search}%");
            });
        }
        
        $books = $query->get();
        return view('admin.book_list', compact('books'));
    }
}
