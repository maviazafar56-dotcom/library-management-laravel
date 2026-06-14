<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailyFineNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fine:send-daily-notifications';

    protected $description = 'Calculate fines for late book submissions and send daily notifications.';

    public function handle()
    {
        $overdueRecords = \App\Record::where('Submission_Status', 'No')->get();
        $today = now()->startOfDay();

        foreach ($overdueRecords as $record) {
            try {
                $expiredDate = \Carbon\Carbon::createFromFormat('d-m-Y', $record->Expired_Date)->startOfDay();

                if ($today->gt($expiredDate)) {
                    $daysLate = $today->diffInDays($expiredDate);
                    $fineAmount = $daysLate * 200;

                    // Update fine in database
                    $record->update(['Fine' => $fineAmount]);

                    // Send notification
                    $student = \App\Student::where('Student_ID', $record->Student_ID)->first();
                    if ($student && $student->Email) {
                        $book = \App\Book::where('Book_ID', $record->Book_ID)->first();
                        $details = [
                            'title' => 'Late Book Submission - Fine Alert',
                            'body' => "Dear {$student->Name}, your book '{$book->Book_Name}' (ID: {$record->Book_ID}) is {$daysLate} days overdue. Your current fine is {$fineAmount} rupees. Please return it immediately."
                        ];

                        \Mail::to($student->Email)->send(new \App\Mail\FineNotification($details));
                    }
                }
            } catch (\Exception $e) {
                $this->error("Error processing record ID {$record->id}: " . $e->getMessage());
            }
        }

        $this->info('Daily fine check and notifications completed.');
    }
}
