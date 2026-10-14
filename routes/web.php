<?php

use App\Http\Controllers\certification_Report;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamDayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Icdl_Report;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\invoices_ReportController;
use App\Http\Controllers\Mark_Report;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionNumberController;
use App\Http\Controllers\student_Report;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionInvoiceController;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentHandoverController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/student/{id}/print-profile',
    [StudentController::class, 'printProfile'])
    ->name('student.print.profile');
Route::get('/payment/print/{id}', [PaymentController::class, 'printReceipt'])->name('payment.print');
Route::get('/home', [CourseController::class, 'homeIndex'])->name('home');
// Route::get('/', function () {
//     return redirect()->route('home');
// });
Route::get('/student/search', [StudentController::class, 'search'])->name('student.search');
Route::put('/update-course-grade/{studentId}/{courseId}',
[App\Http\Controllers\StudentController::class, 'updateCourseGrade'])->name('update.course.grade');

Route::get('/group-report/export',
    [HomeController::class, 'exportGroupReport'])
    ->name('group.report.export');

    
Route::middleware(['auth'])->group(function () {

    // Handover page (search & surrender)
    Route::get('/payments/handover',
        [PaymentHandoverController::class, 'index'])
        ->name('payments.handover');

    // Ajax search for pending payments
    Route::get('/payments/handover/search',
        [PaymentHandoverController::class, 'search'])
        ->name('payments.handover.search');

    // Submit surrender
    Route::post('/payments/handover/surrender',
        [PaymentHandoverController::class, 'surrender'])
        ->name('payments.handover.surrender');

    // Printable handover document
    Route::get('/payments/handover/print/{batch}',
        [PaymentHandoverController::class, 'printDocument'])
        ->name('payments.handover.print');

    // Cash-in-hand report
    Route::get('/payments/cash-in-hand',
        [PaymentHandoverController::class, 'cashInHand'])
        ->name('payments.cash_in_hand');
});


Route::prefix('payments/reports')->name('payments.reports.')->group(function () {
    Route::get('/collections', [PaymentHandoverController::class, 'collections'])->name('collections');
    Route::get('/handovers',   [PaymentHandoverController::class, 'handovers'])->name('handovers');
    Route::get('/pending',     [PaymentHandoverController::class, 'pending'])->name('pending');

    // Printable documents
    Route::get('/collections/print', [PaymentHandoverController::class, 'printCollections'])->name('collections.print');
    Route::get('/handovers/print',   [PaymentHandoverController::class, 'printHandovers'])->name('handovers.print');
    Route::get('/pending/print',     [PaymentHandoverController::class, 'printPending'])->name('pending.print');
});



//Student Routes
Route::get('/student', [StudentController::class, 'index'])->name('student');
Route::resource('student', StudentController::class);

Route::post('update_status/{id}', [StudentController::class, 'update_status'])->name('update_status');
Route::get('/deletestu/{id}', [StudentController::class, 'destroy'])->name('deletestudent');
Route::delete('/delete-student-course/{student_id}/{course_id}', [StudentController::class, 'deleteStudentFromCourse'])->name('deletefromcourse');
Route::post('/store', [StudentController::class, 'store2'])->name("storestudent");
Route::get('/show/{id}', [StudentController::class, 'show2'])->name('showstudent');
Route::get('/api/addtocourse', [StudentController::class, 'apiaddtocourse'])->name('apiaddtocourse');
Route::post('/addtocourse/{id}', [StudentController::class, 'addtocourse'])->name('addtocourse');
Route::get('/api/stud/courses/{id}', [StudentController::class, 'studentcourses'])->name('apistucourse');
Route::get('/get-invoices/{student_id}/{course_id}', [StudentController::class, 'getInvoices']);
Route::get('/get-courses/{coursenumber}', [StudentController::class, 'getCoursesByNumber'])->name('getCoursesByNumber');
Route::post('/transfer-student/{studentId}', [StudentController::class, 'transferStudent']);
// Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
//new student routes
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store'); // Make sure this exists
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
//Examday Routes
Route::resource('Examday', ExamDayController::class);
Route::post('update_Examday/update', [ExamDayController::class, 'update_Examday'])->name('update_Examday');
Route::get('/Status_show/{id}', [ExamDayController::class, 'show'])->name('Status_show');
Route::get('Examday_active', [ExamDayController::class, 'Examday_active']);
Route::get('Examday_cancele', [ExamDayController::class, 'Examday_cancele']);
Route::get('Examday_complete', [ExamDayController::class, 'Examday_complete']);
Route::post('/Status_Update/{id}', [ExamDayController::class, 'Status_Update'])->name('Status_Update');

Route::get('/courses/grades-report', [CourseController::class, 'gradesReport'])
     ->name('courses.gradesReport');


Route::get('/financial-report', [\App\Http\Controllers\ReportController::class, 'financialReport'])
    ->name('financial.report');
//Mark Routes
Route::resource('marks', MarkController::class);
Route::get('/certifications/export-excel-page', [\App\Http\Controllers\ReportController::class, 'exportExcelPage'])
    ->name('certifications.export.excel.page');



Route::get('/reports/payments', [ReportController::class, 'payments'])->name('reports.payments');
Route::get('/reports/payments/pdf', [ReportController::class, 'paymentsPdf'])->name('reports.payments.pdf');



//Subject Route
Route::get('/subjects', [SubjectController::class, 'index'])->name('showsubject');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('createsubject');
Route::post('/subject/store', [SubjectController::class, 'store'])->name('storesubject');
Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('editsub');
Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('updatesubject');
Route::get('/subject/delete/{id}', [SubjectController::class, 'destroy'])->name('deletesubject');
Route::get('/api/subject/{id}', [SubjectController::class, 'show_api'])->name('shows1');
Route::get('/api/subjectc/{id}', [SubjectController::class, 'showname_api'])->name('showname');

//Department Route
Route::get('/departments', [DepartmentController::class, 'index'])->name('showdepartment');
Route::get('/department/create', [DepartmentController::class, 'create'])->name('createdepartment');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('storedepartment');
Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('editdep');
Route::post('/department/update/{id}', [DepartmentController::class, 'update'])->name('updatedepartment');
Route::get('/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('deletedepartment');
Route::get('/api/department/{id}', [DepartmentController::class, 'show_api'])->name('shows2');
Route::get('/api/department/{id}', [DepartmentController::class, 'showname_api'])->name('showname2');

//Teacher Route
Route::get('/teachers', [TeacherController::class, 'index'])->name('showteachers');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('createteacher');
Route::post('/teachers/store', [TeacherController::class, 'store'])->name('storeteacher');
Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('showteacher');
Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('editteacher');
Route::post('/teachers/update/{id}', [TeacherController::class, 'update'])->name('updateteacher');
Route::get('/teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('deleteteacher');
Route::get('/api/teachersub/{id}', function (string $id) {
    $teachers = Subject::with('teachers')->find($id);
    return $teachers;
})->name('apiteachersub');
Route::get('/students/{student}/course/{course}/profile-pdf',
    [StudentController::class, 'profilePdf'])
    ->name('students.profile.pdf');
//Course Route
Route::get('/courses', [CourseController::class, 'index'])->name('showcourses')->middleware('can:الدورات');
Route::get('/courses/create', [CourseController::class, 'create'])->name('createcourse');
Route::post('/courses/store', [CourseController::class, 'store'])->name('storecourse');
Route::get('/show_course/{id}', [CourseController::class, 'show'])->name('showcourse');
Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('editcourse');
 Route::put('/courses/update/{id}', [CourseController::class, 'update'])->name('updatecourse');

Route::get('Course_active', [CourseController::class, 'Course_active']);
Route::get('Course_cancele', [CourseController::class, 'Course_cancele']);
Route::get('Course_complete', [CourseController::class, 'Course_complete']);
Route::post('/courses/assign-page-numbers', [CourseController::class, 'assignPageNumbers'])->name('courses.assignPageNumbers');
Route::get('/students/search', [CourseController::class, 'searchStudents'])->name('students.search');
Route::post('/save-certificate-data', [CourseController::class, 'saveCertificateData'])->name('saveCertificateData');
Route::get('/assign-group', [CourseController::class, 'showAssignGroupForm'])->name('assign.group.form');
Route::get('/report', [CourseController::class, 'showGroupReport'])->name('group.report');
Route::delete('/students/remove/{id}', [CourseController::class, 'removeFromGroup'])->name('students.removeFromGroup');
Route::get('/courses/search/{course}', [CourseController::class, 'searchPage'])->name('courses.searchPage');
Route::get('/students/search-by-name', [CourseController::class, 'searchByName'])->name('students.searchByName');
Route::post('/save-all-coursegrades', [CourseController::class, 'saveAllCourseGrades'])->name('save.all.coursegrades');
Route::get('/api/subjects/{departmentId}', [CourseController::class, 'getSubjects']);
Route::get('/api/teachers/{subject}', [CourseController::class, 'getTeachers']);
Route::get('/course/check-students/{id}', [CourseController::class, 'checkStudentsBeforeDelete'])->name('course.checkStudents');
Route::delete('/course/delete/{id}', [CourseController::class, 'deleteCourse'])->name('course.delete');
Route::post('/save-selected-courses', function (Illuminate\Http\Request $request) {
    session(['selected_courses' => $request->input('selected_courses', [])]);
    return redirect()->back()->with('success', 'تم حفظ الدورات المختارة بنجاح!');
})->name('saveSelectedCourses');
Route::get('/report/certifications/export-excel',
    [certification_Report::class, 'exportExcel']
)->name('certifications.export.excel');

//Search Routes
Route::get('Search_student', [SearchController::class, 'index']);
Route::post('Search_students', [SearchController::class, 'ajax_search'])->name('ajax_search_student');
Route::get('/adv_search', [SearchController::class, 'adv_search'])->name("adv_search");


//StudentReport Routes
Route::get('students_report', [student_Report::class, 'index']);
Route::post('search_students', [student_Report::class, 'Search_students'])->name('searchstudents');
Route::get('Students_By_Course', [student_Report::class, 'searchStudentsByCourse'])->name('search.students');
Route::put('/update-course-year-serial/{studentId}/{courseId}', [StudentController::class, 'updateYearAndSerial'])->name('update.course.year.serial');


//CertificateReport Routes
Route::get('certifications_Report', [certification_Report::class, 'index']);
Route::post('search_certification', [certification_Report::class, 'Search_certification'])->name('searchcertifications');
Route::post('/certificate-request', [certification_Report::class, 'requestCertificate'])->name('certificate.request');
Route::get('certificate-requests', [certification_Report::class, 'certificateRequests'])->name('certificate.requests');

//Print Routes
Route::get('/print-invoices', [PrintController::class, 'printInvoices'])->name('print.invoices');
Route::get('/print-students', [PrintController::class, 'printStudentsByCourse'])->name('print.students');
Route::get('/print-icdl-report', [PrintController::class, 'printIcdl'])->name('print.icdl.report');
Route::get('/print', [\App\Http\Controllers\ReportController::class, 'printStudents'])->name('print');

Route::get('/get-department-roles/{department}', function ($departmentId) {
    $department = Department::findOrFail($departmentId);
    return response()->json([
        'roles' => $department->roles()->select('id', 'name')->get()
    ]);
});
Route::prefix('payment')->name('payment.')->group(function () {
    Route::post('/store', [PaymentController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [PaymentController::class, 'deletePayment'])->name('destroy');
    Route::get('/summary/{studentId}', [PaymentController::class, 'summary'])->name('summary');
    Route::put('/update/{id}', [PaymentController::class, 'updatePayment'])->name('update');
});
Route::get('/api/number-to-words/{number}', function ($number) {
    return response()->json([
        'words' => \App\Helpers\NumberHelper::toWords((float) $number),
    ]);
});

// Other routes
Route::get('/get-remaining-balance/{studentId}/{courseId}', [PaymentController::class, 'getRemaining'])->name('payment.remaining');
Route::post('/payment/add-note/{id}', [PaymentController::class, 'addNote'])->name('payments.addNote');
//Auth Routes
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});
