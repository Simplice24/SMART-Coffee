<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\OfficialsController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\ReportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});   

Route::get('/', function () {
    if(session()->has('user')){
        return redirect('Home');
    }
    return view('index');
});

Route::get('login',function(){
    if(session()->has('user')){
        return redirect('Home');
    }
    return View('login');
});


// user's routes

Route::group(['middleware'=>["auth"]],function(){

    Route::get('Home',[UserController::class,'Dashboard']);

    Route::get('analytics',[UserController::class,'analytics']);

    Route::get('Manager/Home',[UserController::class,'ManagerDashboard']);

    Route::get('logout',[UserController::class,'logout']);
    
    Route::get('registerNewUser',[UserController::class,'UserRegistrationPage']);
    
    Route::get('viewsystemuser',[UserController::class,'SystemUsers']);
    
    Route::post('registerNewUser', [UserController::class, 'UserRegistration']);

    Route::get('userProfile',[UserController::class,'UserProfilePage']);

    Route::put('userProfileUpdate/{id}',[UserController::class,'userProfileUpdate']);

    Route::put('profilePicUpdate/{id}',[UserController::class,'profilePicUpdate']);

    Route::put('userPasswordUpdate/{id}',[UserController::class,'userPasswordUpdate']);

    Route::get("profile/{id}",[UserController::class,'userdetails']);

    Route::get("deleteuser/{id}",[UserController::class,'deleteuser']);

    Route::put('updateUser/{id}',[UserController::class,'updateSystemUser']);

    Route::get("profile/profileUpdate/{id}",[UserController::class,'profileupdatepage']);

    Route::get("CooperativeSales",[UserController::class,'CooperativeSales']);

    
});

    Route::post('login',[UserController::class,'Login'])->name('login');


//farmer's routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('viewfarmers',[FarmerController::class,'SystemFarmers']);

Route::get('registerNewFarmer', [FarmerController::class, 'FarmerRegistrationPage']);

Route::post('registerNewFarmer',[FarmerController::class,'FarmerRegistration']);

Route::get("Farmerprofile/{id}",[FarmerController::class,'FarmerProfilePage']);

Route::get('CooperativeFarmers',[FarmerController::class,'CooperativeFarmers']);

Route::get("Farmerprofile/farmerUpdate/{id}",[FarmerController::class,'FarmerUpdatePage']);

Route::put("updateFarmer/{id}",[FarmerController::class,'UpdateFarmer']);

Route::get('deletefarmer/{id}',[FarmerController::class,'DeleteFarmer']);

Route::get('Register-Farmer',[FarmerController::class,'FarmerRegistrationPage_Manager']);

Route::post('Register-Farmer',[FarmerController::class,'ManagerFarmerRegistration']);

Route::get('CooperativeFarmerprofile/{id}',[FarmerController::class,'CooperativeFarmerprofile']);

Route::get('CooperativeFarmerprofile/CooperativeFarmerUpdatePage/{id}',[FarmerController::class,'CooperativeFarmerUpdatePage']);

Route::put('CooperativeFarmerUpdate/{id}',[FarmerController::class,'CooperativeFarmerUpdate']);

Route::get('DeleteCooperativeFarmer/{id}',[FarmerController::class,'DeleteCooperativeFarmer']);


});


//Reporter's routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('reportPrevilege/{id}',[ReporterController::class,'ReportPrevilegePage']);

Route::post('reportPrevilege/Grant-previlege',[ReporterController::class,'GrantPrevilege']);

});

// diseases' routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('viewdiseases',[DiseaseController::class,'SystemDiseases']);

Route::get('registerNewDisease',[DiseaseController::class,'DiseaseRegistrationPage']); 

Route::get('CooperativeDiseases',[DiseaseController::class,'CooperativeDiseases']);

Route::post('registerNewDisease',[DiseaseController::class, 'DiseaseRegistration']);

Route::get("diseaseDetails/{id}",[DiseaseController::class,'DiseaseDetailsPage']);

Route::get("diseaseDetails/updateDisease/{id}",[DiseaseController::class,'DiseaseUpdatePage']);

Route::put("updateDis/{id}",[DiseaseController::class,'DiseaseUpdate']);

Route::get('deletedisease/{id}',[UserController::class,'DeleteDisease']); 

Route::get('CooperativeDiseaseDetails/{id}',[DiseaseController::class,'CooperativeDiseaseDetails']);

Route::get('CooperativeDiseaseDetails/ReportingDisease/{id}',[DiseaseController::class,'ReportingDisease']);

Route::get('deleteReportedDisease/{id}',[DiseaseController::class,'deleteReportedDisease']);

});



// cooperative's routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('viewcooperatives',[CooperativeController::class, 'SystemCooperatives']); 

Route::get('registerNewCooperative',[CooperativeController::class,'CooperativeRegistrationPage']);

Route::post('registerNewCooperative',[CooperativeController::class, 'CooperativeRegistration']);

Route::get("updateCooperative/{id}",[CooperativeController::class,'CooperativeViewPage']);

Route::get("updateCooperative/CooperativeUpdate/{id}",[CooperativeController::class,'Cooperativeupdatepage']);

Route::put("CooperativeUpdate/{id}",[CooperativeController::class,'UpdateSystemCooperative']);

Route::get('deletecooperative/{id}',[CooperativeController::class,'DeleteCooperative']);

Route::get('updateCooperativeSales/{id}',[CooperativeController::class,'updateCooperativeSales']);

Route::get('updateCooperativeStock/{id}',[CooperativeController::class,'updateCooperativeStock']);

});



// roles and permissions route

Route::group(['middleware'=>["auth"]],function(){

    Route::get('Allroles',[RoleController::class, 'SystemRoles']);

    Route::get('Allpermissions',[RoleController::class, 'SystemPermissions']);
    
    Route::get('Addnewrole',[RoleController::class, 'RegisterRolePage']);
    
    Route::get('Addnewpermission',[RoleController::class, 'RegisterPermissionPage']);
    
    Route::post('storeRole',[RoleController::class, 'storeRole']);
    
    Route::post('storePermission',[RoleController::class, 'storePermission']);   
    
    Route::get('Roledetails/{id}',[RoleController::class,'Roledetails']);

    Route::get('Roledetails/RoleUpdate/{id}',[RoleController::class,'RoleUpdatePage']);

    Route::put('Roleupdate/{id}',[RoleController::class,'RoleUpdate']);

    Route::get('deleterole/{id}',[RoleController::class,'deleterole']);

    Route::get('editpermission/{id}',[RoleController::class,'PermissionUpdatePage']);

    Route::get('editpermission/permissionUpdate/{id}',[RoleController::class,'PermissionUpdate']);

    Route::put('Permissionupdate/{id}',[RoleController::class,'Updatepermission']);

    Route::get('deletepermission/{id}',[RoleController::class,'deletepermission']);

});

//Sales routes

Route::group(['middleware'=>["auth"]],function(){

Route::post('SalesRecording',[SalesController::class,'SalesRecording']);

Route::put('SalesUpdate/{id}',[SalesController::class,'SalesUpdate']);

});

//Stock routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('StockDetails',[StockController::class,'StockDetails']); 

Route::post('StockRecording',[StockController::class,'StockRecording']);

Route::put('StockUpdate/{id}',[StockController::class,'StockUpdate']);
    
});

//Location routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('/getDistricts',[DropdownController::class,'getDistricts']);    

Route::get('/getSectors',[DropdownController::class,'getSectors']);

Route::get('/getCells',[DropdownController::class,'getCells']);

});

//Officials routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('Official/Home',[OfficialsController::class,'OfficialsDashboard']);

Route::get('Official/Official/Home',[OfficialsController::class,'OfficialsDashboard']);

Route::get('Official/Managers',[OfficialsController::class,'getManagers']);

Route::get('Official/Cooperatives',[OfficialsController::class,'getCooperatives']);

Route::get('Official/Farmers',[OfficialsController::class,'getFarmers']);

Route::get('Official/Diseases',[OfficialsController::class,'getDiseases']);

Route::get('Official/Analytics',[OfficialsController::class,'getAnalytics']);

Route::get('Official/ManagerProfile/{id}',[OfficialsController::class,'ManagerProfile']);

Route::get('Official/Cooperative-details/{id}',[OfficialsController::class,'OfficialCooperativeView']);

Route::get('Official/Farmer-profile/{id}',[OfficialsController::class,'OfficialFarmerView']);

Route::get("Official/diseaseDetails/{id}",[OfficialsController::class,'DiseaseDetailsPage']);

    
});


//Report routes

Route::group(['middleware'=>["auth"]],function(){

Route::get('StockReportDuration',[ReportController::class,'DurationForm']);

Route::get('FarmersReportDuration',[ReportController::class,'FarmersReportDuration']);

Route::get('SalesReportDuration',[ReportController::class,'SalesDurationForm']);

Route::post('ReportGeneration',[ReportController::class,'StockReportGeneration']);

Route::post('SalesReportGeneration',[ReportController::class,'SalesReportGeneration']);

Route::post('FarmerReportGeneration',[ReportController::class,'FarmerReportGeneration']);

Route::get('PDFGeneration',[ReportController::class,'generatePDF']);

Route::get('SalesPDFGeneration',[ReportController::class,'SalesGeneratePDF']);

Route::get('FarmersPDFGeneration',[ReportController::class,'FarmersPDFGeneration']);

});

