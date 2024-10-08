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
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->name('users/create');
#Route::post('/users/store', [UserController::class, 'store'])->name('users/store');
Route::resource('users', UserController::class);
Route::delete('/users/softDelete/{id}', [UserController::class, 'softDelete'])->name('users.softDelete');
Route::get('/get-location-count', [UserController::class, 'getLocationCount']);
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Customer management
Route::resource('customers', CustomerManagement::class);
Route::get('/customers', [CustomerManagement::class, 'index'])->name('customers');
Route::get('/customers/show/{id}', [CustomerManagement::class, 'show'])->name('customers/show');
Route::get('/customers/create', [CustomerManagement::class, 'create'])->name('customers/create');
Route::delete('/customers/softDelete/{id}', [CustomerManagement::class, 'softDelete'])->name('customers.softDelete');
Route::get('/customers/{id}/edit', [CustomerManagement::class, 'edit'])->name('customers.edit');


//Loan
// Customer management

Route::get('/customers/show/{id}', [CustomerManagement::class, 'show'])->name('customers/show');
Route::get('/customers/create', [CustomerManagement::class, 'create'])->name('customers/create');

// Leave Management
Route::resource('leaves', LeaveController::class);


Route::post('/leave/approve/{id}', [LeaveController::class, 'approve'])->name('leave.approve');
Route::post('/leave/cancel/{id}', [LeaveController::class, 'cancel'])->name('leave.cancel');
Route::post('/leave/withdraw/{id}', [LeaveController::class, 'withdraw'])->name('leave.withdraw');
Route::post('/leave/remove/{id}', [LeaveController::class, 'remove'])->name('leave.remove');

// Expensses
Route::resource('expenses', ExpenseController::class);
// routes/web.php
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::put('/expenses/{id}', [ExpenseController::class, 'update'])->name('expenses.update');

//Attendace

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::post('/attendance/paidsalary', [AttendanceController::class, 'paidsalary'])->name('attendance.paidsalary');


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
