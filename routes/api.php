<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingFeatureController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchitecturalThemeController;
use App\Http\Controllers\FeatureController;
use App\Http\Middleware\CheckApiToken;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyCodeController;
use App\Http\Controllers\DevelopmentTypeController;
use App\Http\Controllers\RoomPlannerController;
use App\Http\Controllers\SetAppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubmitPropertyController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Http;
 use App\Http\Controllers\TestimonialController;
// routes/api.php

// In routes/api.php
Route::post('/admin/appointment/accept/{id}', [SetAppointmentController::class, 'accept']);
Route::post('/admin/appointment/decline/{id}', [SetAppointmentController::class, 'decline']);
Route::middleware(['auth-token'])->group(function () {
    Route::get('/admin/countproperties', [PropertyController::class, 'countProperties']);
    Route::get('/admin/countotherbuildings', [BuildingController::class, 'countOtherBuildings']);
    Route::get('/admin/countcondominiums', [BuildingController::class, 'countCondominiums']);
    Route::get('/admin/countlocations', [PropertyController::class, 'countLocations']);
    Route::get('/count-properties-monthly', [SubmitPropertyController::class, 'countPropertiesMonthly']);
    Route::get('/count-request-viewing', [SetAppointmentController::class, 'countRequestViewing']);
    Route::get('/count-property-inquiry', [SetAppointmentController::class, 'countPropertyInquiry']);

    Route::get('/admin/development-types', [DevelopmentTypeController::class, 'getAll']);
    Route::get('/admin/area', [AreaController::class, 'getAll']);
    Route::get('/admin/architectural-themes', [ArchitecturalThemeController::class, 'getAll']);
Route::get('/admin/status', [StatusController::class, 'getAll']);


Route::get('/admin/getChatbot', [ChatbotController::class, 'index']);


Route::delete('/admin/deleteChatbot/{id}', [ChatbotController::class, 'deleteChatbot']);
Route::delete('/admin/delete-development-type/{id}', [DevelopmentTypeController::class, 'delete']);
Route::delete('/admin/delete-architectural-theme/{id}', [ArchitecturalThemeController::class, 'delete']);
Route::delete('/admin/delete-status/{id}', [StatusController::class, 'delete']);
Route::delete('/admin/delete-location/{id}', [AreaController::class, 'delete']);

Route::post('/admin/add-development-type', [DevelopmentTypeController::class, 'store']);
Route::post('/admin/add-architectural-theme', [ArchitecturalThemeController::class, 'store']);
Route::post('/admin/add-status', [StatusController::class, 'store']);
Route::post('/admin/add-area', [AreaController::class, 'store']);
Route::post('/admin/addChatbot', [ChatbotController::class, 'addChatbot']);
Route::post('/admin/addproperty', [PropertyController::class, 'store']);    

Route::delete('/admin/deleteproperty', [AdminController::class, 'deleteProperty']);
Route::delete('/admin/deletebuilding', [AdminController::class, 'deleteBuilding']);
Route::delete('/admin/deletefeature', [AdminController::class, 'deleteFeature']);
Route::delete('/admin/deletefacility', [AdminController::class, 'deleteFacility']);

Route::post('/admin/update-properties', [AdminController::class, 'updateProperties']);
Route::post('/admin/update-buildings', [AdminController::class, 'updateBuildings']);
Route::post('/admin/update-features', [FeatureController::class, 'uploadImage']);
Route::post('/admin/update-facilities', [AdminController::class, 'updateFacilities']);

Route::post('/admin/addFacilities', [AdminController::class, 'addFacilities']);
Route::post('/admin/addFeature', [FeatureController::class, 'addFeature']);
Route::post('/admin/addBuildings', [BuildingController::class, 'addBuildings']);

Route::get('/buildings/id/{id}', [BuildingController::class, 'getBuildingById']);
Route::get('/facilities/id/{id}', [BuildingFeatureController::class, 'getFacilitiesbyID']);

Route::get('/admin/properties', [PropertyController::class, 'properties']);
Route::get('/admin/buildings', [BuildingController::class, 'buildings']);
Route::get('/admin/facilities', [BuildingFeatureController::class, 'facilities']);
Route::get('/admin/features', [PropertyController::class, 'features']);

Route::get('testimonials', [TestimonialController::class, 'index']); // Get all testimonials
Route::post('testimonials', [TestimonialController::class, 'store']); // Store a new testimonial
Route::get('testimonials/{id}', [TestimonialController::class, 'show']); // Get a specific testimonial
Route::put('testimonials/{id}', [TestimonialController::class, 'update']); // Update a testimonial
Route::delete('testimonials/{id}', [TestimonialController::class, 'destroy']); // Delete a testimonial
});
Route::post('testimonials_user', [TestimonialController::class, 'store']); // Store a new testimonial
Route::middleware('auth:sanctum')->post('/logoutAll', [AuthController::class, 'logoutAll']);
// Route::middleware(['web'])->get('/csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// });
Route::get('testimonials_user', [TestimonialController::class, 'index']); // Get all testimonials
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/searchProperty', [PropertyController::class, 'index']);
Route::get('/allproperty', [PropertyController::class, 'properties']);
Route::get('/getbuildings', [BuildingController::class, 'index']);
Route::get('/property/id/{id}', [PropertyController::class, 'showById']);
Route::get('/facilities_user/id/{id}', [BuildingFeatureController::class, 'getFacilitiesbyID']);
Route::get('/buildings_user/id/{id}', [BuildingController::class, 'getBuildingById']);

Route::get('/properties', [PropertyController::class, 'properties']);

Route::post('/appointments', [SetAppointmentController::class, 'request']);
Route::post('/admin/submit-property', [SubmitPropertyController::class, 'store']);
Route::get('/getArchitectural', [PropertyController::class, 'getAllArchitectural']);
Route::get('/propertiesChatbot', [PropertyController::class, 'getProperties']);
Route::post('/chatbot/get-answer', [ChatbotController::class, 'getAnswer']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// routes/api.php
Route::get('/roomplanner', [RoomPlannerController::class, 'index']);
// routes/api.php
Route::get('/admin/{user}/{password}/{status}/{code}/{is_active}', [AuthController::class, 'storeCompanyCode']);
// Route for registering company code via URL
Route::post('/companycode/{code}', [CompanyCodeController::class, 'storeCode']);


    Route::get('/admin/area_user', [AreaController::class, 'getAll']);

// Route to get property details by ID


Route::get('/buildingfeatures', [BuildingFeatureController::class, 'index']);
Route::get('/locations', [PropertyController::class, 'getAllLocations']);

Route::get('/searchlocation', [LocationController::class, 'search']);


// Contact Us
Route::post('/contact', [ContactController::class, 'store']);





Route::get('/buildings', [BuildingController::class, 'getBuildingsByProperty']);

// Add this route to handle fetching property details by name
Route::get('/properties/name/{name}', [PropertyController::class, 'getPropertyByName']);

// Define the API route for buildings

// In your routes/api.php
    Route::get('/blog/{slug}', [PropertyController::class, 'show']);


// routes/api.php



// Add these routes to your api.php file

Route::post('/admin/update-location', [AdminController::class, 'updateLocation']);
Route::post('/admin/update-properties', [AdminController::class, 'updateProperties']);


Route::post('/admin/addlocation', [LocationController::class, 'storeLocation']);


// Development Type


// Area 


Route::get('/areas', [AreaController::class, 'get']);
Route::get('/areas/{slug}', [AreaController::class, 'show']);

//Set Appointment
Route::post('/set-appointment', [SetAppointmentController::class, 'store']);

Route::get('/admin/appointments', [SetAppointmentController::class, 'getAll']);
//Submit Property

Route::get('/admin/submitted-properties', [SubmitPropertyController::class, 'getAll']);
Route::post('/admin/submitted-properties/update', [SubmitPropertyController::class, 'update']);
