<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerManagement;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoanManagement;
use App\Http\Controllers\LeaveController;
use Database\Seeders\OfficeExpenseTypesSeeder;
use App\Http\Controllers\LoanInterestController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\InterestPayment;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ExpensesReportController;
use App\Http\Controllers\LeaveReportController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\TeleCallerController;
use App\Http\Controllers\TelecallerFollowController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\LoanReport;
use App\Http\Controllers\OtherBankLoanController;
use App\Http\Controllers\TodayBusinessReport;
use App\Models\OtherBankLoan;
use App\Http\Controllers\LoanActionController;


// Main Page Route
Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/login_verfication', [LoginBasic::class, 'login_verfication'])->name('login_verfication');

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

//Users
Route::resource('users', UserController::class);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users/create');
Route::post('/users/store', [UserController::class, 'store'])->name('users/store');
Route::delete('/users/softDelete/{id}', [UserController::class, 'softDelete'])->name('users.softDelete');
Route::get('/get-location-count', [UserController::class, 'getLocationCount']);
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


Route::any('/logout', [UserController::class, 'logout'])->name('logout');

// Customer management
Route::resource('customers', CustomerManagement::class);
Route::get('/customers', [CustomerManagement::class, 'index'])->name('customers');
Route::get('/customers/show/{id}', [CustomerManagement::class, 'show'])->name('customers/show');
Route::get('/customers/create', [CustomerManagement::class, 'create'])->name('customers/create');
Route::delete('/customers/softDelete/{id}', [CustomerManagement::class, 'softDelete'])->name('customers.softDelete');
Route::get('/customers/{id}/edit', [CustomerManagement::class, 'edit'])->name('customers.edit');
Route::post('/customers/store', [CustomerManagement::class, 'store'])->name('customers.store');

Route::get('customer_report', [CustomerReportController::class, 'index'])->name('customers.report.index');

//Loan
// Customer management

Route::get('/customers/show/{id}', [CustomerManagement::class, 'show'])->name('customers/show');
Route::get('/customers/create', [CustomerManagement::class, 'create'])->name('customers/create');

// Leave Management
Route::resource('leaves', LeaveController::class);

Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
Route::post('/leave/approve/{id}', [LeaveController::class, 'approve'])->name('leave.approve');
Route::post('/leave/cancel/{id}', [LeaveController::class, 'cancel'])->name('leave.cancel');
Route::post('/leave/withdraw/{id}', [LeaveController::class, 'withdraw'])->name('leave.withdraw');
Route::post('/leave/remove/{id}', [LeaveController::class, 'remove'])->name('leave.remove');
Route::post('/leave/create', [LeaveController::class, 'create'])->name('leave.create');

Route::get('leave_report', [LeaveReportController::class, 'index'])->name('leaves.report.index');

// Expensses
Route::resource('expenses', ExpenseController::class);
// routes/web.php
Route::any('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::put('/expenses/{id}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');

Route::get('expenses_report', [ExpensesReportController::class, 'index'])->name('expenses.report.index');


//Attendace
Route::resource('attendance', AttendanceController::class);
Route::any('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
#Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::post('/attendance/paidsalary', [AttendanceController::class, 'paidsalary'])->name('attendance.paidsalary');
// Attendance Reports
Route::get('attendace_report', [AttendanceReportController::class, 'index'])->name('attendance.report.index');
Route::get('/send_follow_up_email', [AttendanceController::class, 'sendFollowUpEmail'])->name('send.followUpEmail');


// Loan Interest Setting
Route::get('/loan_interests', [LoanInterestController::class, 'index'])->name('loan_interests.index');
Route::get('/loan_interests/create', [LoanInterestController::class, 'create'])->name('loan_interests.create');
Route::post('/loan_interests', [LoanInterestController::class, 'store'])->name('loan_interests.store');


// Loan Management



Route::any('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
Route::any('/loans/approval', [LoanController::class, 'approval'])->name('loans.approval');


Route::any('/loans/dispatch', [LoanController::class, 'dispatch'])->name('loans.approval');



Route::post('/loans/store', [LoanController::class, 'store'])->name('loans.store');
Route::get('/loans/{loan}', [LoanController::class, 'show'])->name('loans.show');

Route::get('/loans/approvalview/{loan_number}', [LoanController::class, 'approvalView'])->name('loans.approvalview');
Route::get('/loans/dispatchview/{loan_number}', [LoanController::class, 'dispatchview'])->name('loans.dispatchview');

// Loan Release

Route::post('/release-loan', [LoanController::class, 'releaseLoan'])->name('release-loan');
Route::get('/release-letter/{id}', [LoanController::class, 'releaseLetter'])->name('release-letter');
Route::post('/revoke-loan', [LoanController::class, 'revokeLoan'])->name('revoke.loan');




//Route::get('/loans', [LoanManagement::class, 'index'])->name('loans');
Route::get('/generate-loan-number/{locationId}', [LoanController::class, 'generateLoanNumber']);


Route::post('/fetch-interest-details', [LoanController::class, 'fetchInterestDetails'])->name('fetchInterestDetails');

Route::post('/fetch-loan-details', [LoanController::class, 'fetchLoanDetails'])->name('fetchLoanDetails');
Route::post('/calculate-loan-amounts', [LoanController::class, 'calculateLoanAmounts'])->name('calculateLoanAmounts');

Route::get('/customer-info', [LoanController::class, 'getCustomerInfo'])->name('customer.info');
Route::any('/customer_details', [LoanController::class, 'customer_details'])->name('customer_details');
Route::post('/save-loan', [LoanController::class, 'saveLoan']);
Route::post('/update-loan-status', [LoanController::class, 'updateLoanStatus'])->name('updateLoanStatus');
Route::post('/update-dispatch-loan-status', [LoanController::class, 'updateLoanDispatchStatus'])->name('updateLoanDispatchStatus');
Route::any('/interest-payment', [LoanInterestController::class, 'store'])->name('interest.payment.store');


Route::any('/interstlist/{locationId}', [InterestPayment::class, 'index'])->name('loans.customer_interest_list');

Route::any('/interst_invoice/{loan_id}', [InterestPayment::class, 'interest_invoice'])->name('loans.interest_invoice');


// Salary Routes
Route::resource('employee_salaries', EmployeeSalaryController::class);

//Tele Caller Route
Route::get('telecaller_report', [TeleCallerController::class, 'index'])->name('telecaller.index');
Route::post('/telecaller/store', [TelecallerFollowController::class, 'store'])->name('telecaller.store');
Route::get('/telecaller/follow-up', [TelecallerFollowController::class, 'showFollowUpModal'])->name('telecaller.showFollowUpModal');


// Funds Routes

Route::resource('funds', FundController::class);
Route::any('/funds', [FundController::class, 'index'])->name('funds.index');
Route::post('/funds/store', [FundController::class, 'store'])->name('funds.store');
Route::delete('/funds/softDelete/{id}', [FundController::class, 'destroy'])->name('funds.softDelete');


// Other Bank Loan
Route::resource('other_loans', OtherBankLoanController::class);
Route::any('/other_loans', [OtherBankLoanController::class, 'index'])->name('other_loans.index');
Route::get('/other_loans/create', [OtherBankLoanController::class, 'create'])->name('other_loans.create');
Route::get('/other_loans/get-loan-numbers/{customer_id}', [OtherBankLoanController::class, 'getLoanNumbers'])->name('other_loans.get-loan-numbers');
Route::post('/other-bank-save-loan', [OtherBankLoanController::class, 'store'])->name('other_loans.store');
Route::any('/other-bank-interest', [OtherBankLoanController::class, 'interestReminder'])->name('other_loans.interestReminder');


//Today Business Report
Route::resource('today_business', TodayBusinessReport::class);
Route::any('/today_business_custom', [TodayBusinessReport::class, 'index'])->name('today_business_custom.index');



//Loan Reports
Route::resource('loan_report', LoanReport::class);
Route::any('/loan_report', [LoanReport::class, 'index'])->name('today_business.index');

Route::resource('loan_action', LoanActionController::class);
Route::get('loan_action/{loan_number}', [LoanActionController::class, 'showInterestForm'])->name('loans.customer_interest_list');
Route::post('loan_action/{loan_number}', [LoanActionController::class, 'storeInterestAction']);
Route::post('action_customer', [LoanActionController::class, 'ActionCustomer'])->name('loans.action_customer');


//Loan Report

Route::get('loan_report', [LoanReport::class, 'index'])->name('loan_report.index');

Route::get('sh_loan_report', [LoanReport::class, 'sh_loan_report'])->name('loan_report.sh_loan_report');


//Trending Routes

Route::get('loan-trends', [LoanController::class, 'loanTrends'])->name('loan.trends');
Route::get('/loan-chart-data', [LoanController::class, 'getLoanChartData'])->name('loan.chart.data');
Route::get('/loan-wave-chart', [LoanController::class, 'getLoanWaveData'])->name('loan.wave.data');


//Branch List



Route::resource('branch', BranchController::class);
Route::any('/branch', [BranchController::class, 'index'])->name('branch.index');
Route::delete('/branch/softDelete/{id}', [BranchController::class, 'softDelete'])->name('branch.softDelete');
Route::any('branch/create', [BranchController::class, 'create'])->name('branch.create');
Route::any('branch/store', [BranchController::class, 'store'])->name('branch.store');
//Route::any('/branch/update', [BranchController::class, 'update'])->name('branch.update');

Route::post('/branch/{branch}', [BranchController::class, 'update'])->name('branch.update');
