<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Role\UserRole;

use App\Http\Livewire\Section\SiteSection;
use App\Http\Livewire\Subject\Subjects;
use App\Http\Livewire\Category\Categories;
use App\Http\Livewire\School\School;
use App\Http\Livewire\Student\Student;
use App\Http\Livewire\Teacher\Teacher;
use App\Http\Livewire\Book\Book;
use App\Http\Livewire\Board\Boards;
use App\Http\Livewire\Paper\Papers;
use App\Http\Controllers\Admin\School\SchoolController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SchoolGroupController;
use App\Http\Controllers\Admin\ClassController as GlobalClass;
use App\Http\Controllers\Admin\SectionController as GlobalSection;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\School\TeacherController;
use App\Http\Controllers\Admin\School\StudentController;
use App\Http\Controllers\Admin\School\ClassController;
use App\Http\Controllers\Admin\School\SectionController;
use App\Http\Controllers\Admin\Paper\TemplateController;
use App\Http\Controllers\Admin\Paper\QuestionController;
use App\Http\Controllers\Admin\Paper\PaperController;
use App\Http\Controllers\Admin\Paper\QuestionPaperController;
use App\Http\Controllers\Admin\Paper\AssigedPaperController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum'])->group(function (){



        //Paper Routes

            Route::resource('template', TemplateController::class);
            Route::post('get-category', [TemplateController::class,'get_category'])->name('get-category');
            Route::post('get-board', [TemplateController::class,'get_board'])->name('get-board');

            Route::resource('paper', PaperController::class);
            Route::resource('question-paper', QuestionPaperController::class);
            Route::get('get-question/{template} ', [QuestionPaperController::class,'get_question'])->name('get-question');
            Route::get('get-school/{school_group_id} ', [QuestionPaperController::class,'get_school']);
            Route::get('get-class/{school_id} ', [QuestionPaperController::class,'get_class']);
            Route::post('paper-assign', [QuestionPaperController::class,'paper_assigned'])->name('paper_assigned');
            Route::delete('delete-question', [QuestionPaperController::class,'delete_question'])->name('delete-question');
            Route::resource('question', QuestionController::class);

            Route::get('assigned-paper',[ AssigedPaperController::class,'index'])->name('assigned_paper.index');
            Route::get('assigned-paper/show/{number}',[ AssigedPaperController::class,'show'])->name('assigned_paper.show');
            Route::get('assigned-paper/sent',[ AssigedPaperController::class,'sent'])->name('sent_paper');



        //School Routes
            
             Route::prefix('schools/{school_id}')->group(function (){
                     Route::resource('teachers', TeacherController::class);
                     Route::resource('student', StudentController::class);
                      Route::post('student-import', [StudentController::class,'student_import'])->name('student-import');
                      Route::post('teacher-import', [TeacherController::class,'teacher_import'])->name('teacher-import');
                     Route::resource('class', ClassController::class);
                     Route::post('class-section', [StudentController::class,'class_section'])->name('class-section');
                     Route::get('teacher-class', [TeacherController::class,'teacher_class'])->name('teacher-class');
                     Route::get('teacher-modify/', [TeacherController::class,'teacher_class'])->name('teacher.modify');
            });

                Route::prefix('school-class/{class_id}')->group(function (){
                     Route::resource('section', SectionController::class);
            });


            //Reports Routes
             
             Route::group(['prefix' => 'reports', 'as'=>'report.'] ,function (){

                  Route::prefix('schools/{school_id}')->group(function (){
                         Route::get('/classes', [App\Http\Controllers\Admin\Report\SchoolController::class, 'classes'])->name('school');  
                         Route::get('/teachers', [App\Http\Controllers\Admin\Report\SchoolController::class, 'teachers'])->name('school.teachers');  
                         Route::get('/students', [App\Http\Controllers\Admin\Report\SchoolController::class, 'students'])->name('school.students');  
                  });
             });

        //Admin Routes


        Route::group(['prefix' => 'admin', 'as'=>'admin.','middleware' => 'admin', 'role' => 'admin'], function () {  

            Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

            Route::resource('school_group', SchoolGroupController::class);
            Route::resource('sections', GlobalSection::class);
            Route::resource('classes', GlobalClass::class);
            Route::resource('subjects', SubjectController::class);
            Route::resource('category', CategoryController::class);
            Route::get('create-subcategory/{id}', [CategoryController::class,'create_subcategory'])->name('create_subcategory');


            // Route::get('/user/manage', [App\Http\Controllers\DashboardController::class, 'index'])->name('user.manage');
            Route::resource('schools', SchoolController::class);
               Route::post('get-class', [SchoolController::class,'get_class'])->name('get-classes');
               Route::delete('delete-class-section', [SchoolController::class,'delete_class_section'])->name('delete_class');

            Route::get('users', Users::class)->name('users');
            Route::get('user_role', UserRole::class)->name('user_role');
            // Route::get('classes', GlobalClass::class)->name('classes');
            // Route::get('sections', SiteSection::class)->name('sections');
            // Route::get('subjects', Subjects::class)->name('subjects');
            // Route::get('categories', Categories::class)->name('categories');
            // Route::get('schools/{id}/teachers', Teacher::class)->name('teachers');
            Route::get('schools/{id}/students', Student::class)->name('students');
            Route::get('books', Book::class)->name('books');    
            Route::get('boards', Boards::class)->name('boards');

        });

        //Subadmin Routes

        Route::group(['prefix' => 'subadmin', 'as'=>'subadmin.', 'middleware' => 'subadmin', 'role' => 'subadmin'], function () {  
            Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        });


        //Deputy Admin Routes


        Route::group(['prefix' => 'deputy_admin', 'as'=>'deputy_admin.', 'middleware' => 'deputy_admin', 'role' => 'deputy_admin'], function () {  
            Route::get('/', [App\Http\Controllers\DeputyAdmin\DashboardController::class, 'index'])->name('dashboard');
        });


        // School Routes

        Route::group(['prefix' => 'school', 'as'=>'school.', 'middleware' => 'school', 'role' => 'school'], function () {  
            Route::get('/', [App\Http\Controllers\School\DashboardController::class, 'index'])->name('dashboard');

            //Reports 

            Route::get('/class-reports', [App\Http\Controllers\School\ReportController::class, 'class'])->name('class.reports');
            Route::get('/student-reports', [App\Http\Controllers\School\ReportController::class, 'student'])->name('student.reports');
            Route::get('/paper-reports', [App\Http\Controllers\School\ReportController::class, 'paper'])->name('paper.reports');
        });


        //Teacher Routes

        Route::group(['prefix' => 'teacher', 'as'=>'teacher.', 'middleware' => 'teacher', 'role' => 'teacher'], function () {  


            Route::get('/', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('dashboard');
            Route::get('/classes', [App\Http\Controllers\Teacher\TeacherController::class, 'classes'])->name('classes');
            Route::get('/students', [App\Http\Controllers\Teacher\TeacherController::class, 'students'])->name('students');

       

            //Teacher papers
            Route::get('/browse-papers', [App\Http\Controllers\Teacher\PaperController::class, 'browse_papers'])->name('browse.papers');
            Route::get('/paper/show/{number}', [App\Http\Controllers\Teacher\PaperController::class, 'paper_show'])->name('paper.show');
            Route::post('assigned-papers/{number}', [App\Http\Controllers\Teacher\PaperController::class,'paper_assigned'])->name('send_paper');
            Route::post('get-students', [App\Http\Controllers\Teacher\PaperController::class,'get_students'])->name('get_students');
            Route::get('/assigned-papers', [App\Http\Controllers\Teacher\PaperController::class, 'assigned_papers'])->name('assigned.papers');
            Route::get('/recieved-papers', [App\Http\Controllers\Teacher\PaperController::class, 'recieved_papers'])->name('recieved.papers');
            Route::get('/sent-back-papers', [App\Http\Controllers\Teacher\PaperController::class, 'sent_back_papers'])->name('papers.sent_back');
            Route::get('/archived-papers', [App\Http\Controllers\Teacher\PaperController::class, 'archived_papers'])->name('papers.archived');
            Route::get('/student-papers', [App\Http\Controllers\Teacher\PaperController::class, 'student_papers'])->name('paper.students');
            Route::get('/student-answer/{id}', [App\Http\Controllers\Teacher\PaperController::class, 'student_answer'])->name('paper.answer');
            Route::match(['post','put'],'answer-comment', [App\Http\Controllers\Teacher\PaperController::class, 'answer_comment'])->name('answer.comment');
            Route::match(['post','put'],'paper-comment', [App\Http\Controllers\Teacher\PaperController::class, 'paper_comment'])->name('paper.comment');
            Route::match(['get','post'],'/student-paper/{id}', [App\Http\Controllers\Teacher\PaperController::class, 'student_paper_action'])->name('student.paper.action');

            //Reports 

            Route::get('/class-reports', [App\Http\Controllers\Teacher\ReportController::class, 'class'])->name('class.reports');
            Route::get('/student-reports', [App\Http\Controllers\Teacher\ReportController::class, 'student'])->name('student.reports');
            Route::get('/paper-reports', [App\Http\Controllers\Teacher\ReportController::class, 'paper'])->name('paper.reports');

        });

        //Student Routes

        Route::group(['prefix' => 'student', 'as'=>'student.', 'middleware' => 'student', 'role' => 'student'], function () { 

            Route::get('/', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
                Route::get('/papers', [App\Http\Controllers\Student\PaperController::class, 'papers'])->name('papers');
                Route::get('/assign-papers', [App\Http\Controllers\Student\PaperController::class, 'assign_papers'])->name('papers.assign');
                Route::get('/saved-papers', [App\Http\Controllers\Student\PaperController::class, 'saved_papers'])->name('papers.saved');
                Route::get('/sent-papers', [App\Http\Controllers\Student\PaperController::class, 'sent_papers'])->name('papers.sent');
                Route::get('/checked-papers', [App\Http\Controllers\Student\PaperController::class, 'checked_papers'])->name('papers.checked');
                Route::get('/sent-back-papers', [App\Http\Controllers\Student\PaperController::class, 'sent_back_papers'])->name('papers.sent_back');
                Route::get('/paper/show/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_show'])->name('paper.show');
                Route::get('/paper/edit/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_edit'])->name('paper.edit');
                Route::post('/paper/submit/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_submit'])->name('paper.submit');
                Route::put('/paper/update/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_update'])->name('paper.update');
                Route::put('/paper/resubmit/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_resubmit'])->name('paper.resubmit');
                Route::get('/paper/sent/{number}', [App\Http\Controllers\Student\PaperController::class, 'sent_to_teacher'])->name('paper.sent');
                 Route::match(['get','post'],'/paper/checked/{number}', [App\Http\Controllers\Student\PaperController::class, 'paper_checked'])->name('paper.checked');
                 Route::match(['get','post'],'/paper/sent-back/{number}', [App\Http\Controllers\Student\PaperController::class, 'sent_back_paper'])->name('paper.sent_back');
                Route::match(['get','post','put'],'/question/recheck/{number}/{id}', [App\Http\Controllers\Student\PaperController::class, 'question_recheck'])->name('question.recheck');
                 Route::get('/paper/resent/{number}', [App\Http\Controllers\Student\PaperController::class, 'resent_to_teacher'])->name('paper.resend');

        });
});


