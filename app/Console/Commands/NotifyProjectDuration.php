<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Projects;
use App\Models\Programs;
use App\Models\SubProjects;
use App\Models\User;
use App\Models\Agency;
use Carbon\Carbon;

class NotifyProjectDuration extends Command
{
    protected $signature = 'notify:project-duration';

    protected $description = 'Notify users when project duration is near';

    public function __construct()
    {
        parent::__construct();
    }

    // public function handle()
    // {
    //     // Retrieve all projects from the database
    //     $projects = Projects::all();

    //     // Loop through each project
    //     foreach ($projects as $project) {
    //         // Parse the duration to extract start and end dates
    //         [$startDate, $endDate] = explode(' to ', $project->project_duration);
    //         $endDate = Carbon::createFromFormat('m/d/Y', trim($endDate));

    //         // Calculate the duration remaining (in days)
    //         $daysRemaining = $endDate->diffInDays(now());

    //         // Check if the duration is near (within 7 days in this case)
    //         if ($daysRemaining <= 7) {
    //             // Get the associated agency
    //             $agency = $project->encoder_agency;

    //             // Get all users (CMIs) under the agency
    //             $cmis = User::where('role', 'CMI')->where('agencyID', '=', $agency)->get();

    //             // If there are at least 2 CMIs, send email to them
    //             if ($cmis->count() >= 2) {
    //                 // Loop through each CMI and send email
    //                 foreach ($cmis as $cmi) {
    //                     $this->sendEmail($cmi->email, $project->project_title, $startDate, $endDate->toDateString());
    //                 }
    //             }
    //         }
    //     }
    // }

    // Function to send email notification
    // private function sendEmail($to, $projectName, $startDate, $endDate)
    // {
    //     // Send email logic
    //     Mail::raw("Your project '{$projectName}' is ending soon. It started on {$startDate} and ends on {$endDate}. THIS IS A TEST PLEASE DISREGARD", function ($message) use ($to) {
    //         $message->to($to)->subject('Project Duration Reminder');
    //     });
    // }

    // TESTING

    public function handle()
    {
        // Notify projects
        $this->notifyProjects();

        // Notify programs
        $this->notifyPrograms();

        // Notify sub-projects
        $this->notifySubProjects();
    }

    private function notifyProjects()
    {
        $projects = Projects::all();

        foreach ($projects as $project) {
            $this->notify($project->project_duration, $project->encoder_agency, $project->project_title, 'project');
        }
    }

    private function notifyPrograms()
    {
        $programs = Programs::all();

        foreach ($programs as $program) {
            $this->notify($program->duration, $program->encoder_agency, $program->program_title, 'program');
        }
    }

    private function notifySubProjects()
    {
        $subProjects = SubProjects::all();

        foreach ($subProjects as $subProject) {
            $this->notify($subProject->sub_project_duration, $subProject->encoder_agency, $subProject->sub_project_title, 'sub-project');
        }
    }

    private function notify($duration, $agency, $title, $type)
    {
        [$startDate, $endDate] = explode(' to ', $duration);
        $endDate = Carbon::createFromFormat('m/d/Y', trim($endDate));

        $daysRemaining = $endDate->diffInDays(now());

        if ($daysRemaining <= 60 || $daysRemaining <= 30 || $daysRemaining <= 15 || $daysRemaining <= 7) {
            $cmis = User::where('role', 'CMI')->where('agencyID', '=', $agency)->get();

            if ($cmis->count() >= 2) {
                foreach ($cmis as $cmi) {
                    $this->sendEmail($cmi->email, $title, $startDate, $endDate->toDateString(), $type);
                }
            }
        }
    }

    private function sendEmail($to, $title, $startDate, $endDate, $type)
    {
        $subject = ucfirst($type) . ' Duration Reminder';
        $title = strtoupper($title);
        $startDate = date('m/d/Y', strtotime($startDate));
        $endDate = date('m/d/Y', strtotime($endDate));
        $messageContent = "Your {$type} '{$title}' is ending soon. It started on {$startDate} and ends on {$endDate}. THIS IS A FUNCTIONAL TEST IN RTMS. PLEASE DISREGARD. THANK YOU.";

        // Customize the message content based on the type
        switch ($type) {
            case 'project':
                // Add project-specific content here
                break;
            case 'program':
                // Add program-specific content here
                break;
            case 'sub-project':
                // Add sub-project-specific content here
                break;
        }

        Mail::raw($messageContent, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
