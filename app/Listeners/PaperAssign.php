<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PaperNotification;
use App\Models\AssignedPaper;
use App\Models\Section;
use App\Models\User;
use App\Events\PaperAssignEvent;
use Notification;    

class PaperAssign
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaperAssignEvent $event)
    {
          if ($event->model instanceof AssignedPaper) {
                 $assigned = $event->model;
                $teachers = $this->findUsers($assigned->class_id);
                 foreach ($teachers as $user) {
                     
                            Notification::send($user, new PaperNotification($assigned));
                        
                  }
          }
    }

  public  function findUsers($class_id)
    {
        $teachers = Section::where('class_id',$class_id)->whereNotNull('teacher_id')->get()->groupBy('teacher_id');
         $users = [];
        if($teachers){
           $teacher_ids = array_keys(collect($teachers)->toArray());
            $users = User::whereIn('id', $teacher_ids)->get();

        }

            return $users;
    }
}
