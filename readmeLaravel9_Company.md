# Laravel Project Problem Solving Sequence 

-> View -> Routing -> Controller -> Model
Or,
-> Model & Migration -> View -> Routing -> Controller with db operation


# Upload Laravel Project On Live Server 
# -----------------------------------------

- Clearing view, config, cache with command 

     - php artisan view:clear
     - php artisan config:clear
     - php artisan cache:clear
     - php artisan route:clear

- Project zipping
- Database exporting from xampp 'localhost/phpmyadmin'
- Go to host seller website, login and go to cpanel
- On cpanel "Select PHP Version" (Respect of Framework support)
- Database creating on cpanel 'mysql database'
     - Database name creation
     - Database user creation
     - Database user selecting and giving power in 'managing user privileges' on cpanel
- Go to domain(public_html) / created subdomain(inside subdomain) in cpanel  
- Upload created zip file(project) on domain/subdomain 
- If unable to see .env file: setting(right corner) -> click on 'Show Hidden Files (dotfiles)' -> Save 
- Edit .env file with db name, user name, password (perfectly)
- Took 'index.php' from Project 'public' folder's to root (Also images and all assets like css,js)
- Edit 'index.php' :
     - require __DIR__.'/vendor/autoload.php';
     - $app = require_once __DIR__.'/bootstrap/app.php';
- Config-> app.php ->  'asset_url' =>"https://course.answeringlibrary.com/", (put your own site url) 


# Laravel9_Breeze_Auth
# ---------------------------------------------------------------------------------

# Link
# ---------------------------------------------------------------------------------
https://www.udemy.com/course/laravel-advance-ecommerce-project/ ( Service Website Project with Blog )
 
# ---------------------------------------------------------------------------------

Section 3: Laravel 9 Breeze Authentication
# ---------------------------------------------------------------------------------
19. Laravel 9 Breeze Authentication install
     - composer require laravel/breeze --dev
     - php artisan breeze:install
     - npm install 
     - npm run dev
     - create database "Laravel9_Breeze_Auth"
     - php artisan migrate
     - run the app : "php artisan serve"  

20. Discuss on Laravel Breeze File Structure
     - See Auth folder on controller, view, route 
     - See all default route: "php artisan r:l"
     - Use of Auth middleware and 
     - Relation of auth middleware and its related route from routes(auth.php,web.php)
     ---Ex:---
     Route::middleware('auth')->group(function () { 
          Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
          Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
          Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                         ->name('logout');
     });
     ---------
 
21. Forgot Password & Password Reset
     - using mailtrip for fake smtp server (https://mailtrap.io)
          - configuring .env file after selecting framework in mailtrip 
          - "  MAIL_MAILER=smtp
               MAIL_HOST=smtp.mailtrap.io
               MAIL_PORT=2525
               MAIL_USERNAME=e7bb2f12328b01
               MAIL_PASSWORD=376bfdcdfc61a3
               MAIL_ENCRYPTION=tls
               MAIL_FROM_ADDRESS="support@laravel9_Service.com"
               MAIL_FROM_NAME="${APP_NAME}" 
            "
          - See mailtrip inbox and get the reset link 
     - Reset Password 

22. Email Verify in Laravel
     - Varify Email
          - see Middleware-> karnel.php -> 
          "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,"
          - route -> web.php -> add a middleware on route "middleware(['auth','verified'])"
          - Model -> User.php -> "use Illuminate\Contracts\Auth\MustVerifyEmail;"
          - Model -> User.php -> add "implements MustVerifyEmail" with extends Authenticatable class
          - Then reg and login to acc. and face the email varification
          - Verify email from email(Here: from mailtrip fake server by getting mail)

     - Varify Email - extra functionality setting 
          - see Requests -> Auth -> LoginRequest.php 
               - wrong information login attenmpts
                    ----Ex----
                         public function ensureIsNotRateLimited()
                         {
                              // { // 4/5/ or more
                              if (! RateLimiter::tooManyAttempts($this->throttleKey(), 4)) {
                                   return;
                              }

                              event(new Lockout($this));

                              $seconds = RateLimiter::availableIn($this->throttleKey());

                              throw ValidationException::withMessages([
                                   'email' => trans('auth.throttle', [
                                        'seconds' => $seconds,
                                        'minutes' => ceil($seconds / 60),
                                   ]),
                              ]);
                         }
                    ----------

23. Changing our Logo Component
     - see views -> componets -> application-logo.blade.php 
          - Here, " <im/g src="{{ asset('//logo/RMIT.jpg')}}" width="100px"> </im/g> " // remove '/' from im/g

24. Logging in with Username
     - Edit Register
          - see migration and add "$table->string('username')->unique();" // no need to "php artisan migrate"
          - add database field "username" after 'password' field ( make 'username' unique )
          - use "php artisan r:l" to see all default routes and get the delails of routes
          - Find out the 'register.blade.php' and edit it  
          - Edit the controller and send data to model 
               "'email' => ['required', 'string', 'max:255', 'unique:users'],"
               &
               "$user = User::create([ 
                    'username' => $request->username,
                    ]);" 
          - Edit User.php  " 'username', "

     - Edit Login
          - See login.blade.php and edit for getting username field 
          - see Requests -> Auth -> LoginRequest.php
               - Edit and Change 'email' to 'username'
                    - In  rules() ->" 'username' => ['required', 'string'] ",
                    - In authenticate() -> 
                    "Auth::attempt($this->only('username', 'password')"
                    - In authenticate() -> 'username' => trans('auth.failed'),
                    - In ensureIsNotRateLimited() -> 'username' => trans('auth.throttle', [
                    - In  throttleKey() -> return Str::lower($this->input('username')).'|'.$this->ip();

23. Project All Themes
     - download and see All Themes

24. Admin Panel Setup Part 1
25. Admin Panel Setup Part 2
26. Admin Panel Setup Part 3
     - admin_master.blade.php 
     - index.blade.php 
     - putting index.html 's code into 'admin_master.blade.php'

     - 'backend' folder in public 
     - putting 'all assets' into 'backend' folder

     - edit link/file/scripts/ path's with {{assets('backend/)}}
     - mastering all file folder 
     - route setup dashboard  

27. Admin Logout Option 
     - php artisan r:l
     - href="{{route('admin.logout')}}"
     - php artisan make:controller AdminAuth
     - use Illuminate\Support\Facades\Auth;  in AdminAuth
     - copy destroy method and make 'admin_destroy' method in AdminAuth and edit 'redirect(admin/login)'
     - use App\Http\Controllers\AdminAuth;  on web.php 
     - Route::controller(AdminAuth::class)->group(function () {
               Route::get('/admin/logout', 'destroy')->name('admin.logout');
       });

28. Customize Register Page
     - auth-regiaster.html code to register.blade.php
     - {{ asset('backend/assets/css/app.min.css') }}
     - checking form (id, type, name, placeholder)
     - Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
     - Route::post('/admin/register', [RegisteredUserController::class, 'store']);

     - Route::controller(AdminAuth::class)->group(function () {
          // ------------------ Registration ------------------
          Route::get('/admin/register','create_registration')->name('admin.register');
          Route::post('/admin/register', 'store_registration');
       }
     - create_registration(), store_registration(Request $request) method on AdminAuth.php
     - register.blade.php , all route name checking 

29. Customize Login Page
     - login.blade.php page setup 
     - Route::controller(AdminAuth::class)->group(function () {
          // ------------------ Login --------------------
          Route::get('admin/login', 'create_login')->name('admin.login');
          Route::post('admin/login', 'store_login');
       }
     - create_login(), store_login(Request $request) method on AdminAuth.php
     - register.blade.php , all route name checking 

30. Customize Forget Password Page
     - forgot-password.blade.php page setup 
     - no need to change on Forget Password route

31. Admin Profile & Image Update Part 1
     - {{route('admin.profile')}}" in header.blade.php 
     - admin_profile_view.blade.php
     - php artisan make:controller AdminController
     - // ------------------ Profile --------------------
     Route::controller(AdminController::class)->group(function () {
          Route::get('/admin/profile', 'Profile')->name('admin.profile');
         });
     });
     - Profile() method in AdminController.php

32. Admin Profile & Image Update Part 2
     - {{route('edit.profile')}}" for Edit Profile in admin_profile_view.blade.php
     - admin_profile_edit.blade.php 
     - Route::controller(AdminController::class)->group(function () {
          Route::get('admin/edit/profile', 'EditProfile')->name('edit.profile');
         });
     });
     - EditProfile() method in AdminController.php  

33. Admin Profile & Image Update Part 3
     - <scr ipt sr c="htt ps://ajax.goo gleapis.com/ajax/libs/jqu ery/3.5.1/jquery.min.js"></scr ipt>
     - 
          <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image </label>
                <div class="col-sm-10">
                    <input name="profile_image" class="form-control" type="file"  id="image">
                </div>
          </div>
     - 
          <div class="row mb-3">
               <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
               <div class="col-sm-10">
               <img id="showImage" class="rounded avatar-lg" src="{{ asset('backend/assets/images/riyadPic.png') }}" alt="Card image cap">
               </div>
          </div>
     - 
     $(document).ready(function(){
          $('#image').change(function(e){
               var reader = new FileReader();
               reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
               }
               reader.readAsDataURL(e.target.files['0']);
          });
     });

     - 

34. Admin Profile & Image Update Part 4
     - 
     - enctype="multipart/form-data" in admin_profile_edit.blade.php
     - action="{{route('store.profile')}}" in admin_profile_edit.blade.php
     - Route::post('admin/store/profile', 'StoreProfile')->name('store.profile');
     - StoreProfile() in AdminController.php with creating folder 'upload/admin_images'
     - try to edit profile with image 

35. Admin Profile & Image Update Part 5
     - no-image.jpg putting on upload folder
     - src="{{ asset((!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg')) }}" in admin_profile_view.blade.php
     - src="{{ asset((!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg')) }}" in admin_profile_edit.blade.php
     - src="{{ asset((!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg')) }}" in header.blade.php

36. Adding Toster In For View Message
     - In  admin_master.blade.php :
     <scr.ipt typ.e="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     - In StoreProfile() of AdminController.php :
     $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'success'
        );
     - return redirect()->route('admin.profile')->with($notification); 
     - 
     <script>
     @if(Session::has('message'))
          var type = "{{ Session::get('alert-type','info') }}"

          switch(type){
               case 'info':
               toastr.info(" {{ Session::get('message') }} ");
               break;

               case 'success':
               toastr.success(" {{ Session::get('message') }} ");
               break;

               case 'warning':
               toastr.warning(" {{ Session::get('message') }} ");
               break;

               case 'error':
               toastr.error(" {{ Session::get('message') }} ");
               break; 
          }
     @endif 
     </script>
     - check toastr is working or not 

37. Display Toster Message in Login and Logout
     - In  login.blade.php :
     <scr.ipt typ.e="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     - In store_login() of AdminAuth.php :
        $notification = array(
            'message' => 'User LoggedIn Successfully', 
            'alert-type' => 'success'
        );
     - return redirect()->intended(RouteServiceProvider::HOME)->with($notification);  
     - In admin_destroy() of AdminAuth.php :
        $notification = array(
            'message' => 'User Logout Successfully', 
            'alert-type' => 'success'
        );
     - return redirect('admin/login')->with($notification);
     - 
     <script>
     @if(Session::has('message'))
          var type = "{{ Session::get('alert-type','info') }}"

          switch(type){
               case 'info':
               toastr.info(" {{ Session::get('message') }} ");
               break;

               case 'success':
               toastr.success(" {{ Session::get('message') }} ");
               break;

               case 'warning':
               toastr.warning(" {{ Session::get('message') }} ");
               break;

               case 'error':
               toastr.error(" {{ Session::get('message') }} ");
               break; 
          }
     @endif 
     </script>
     - check toastr is working or not 

38. Admin Profile Change Password Part 1
39. Admin Profile Change Password Part 2
     - In header.blade.php  route( 'change.password' ) 
     - admin_change_password.blade.php 
     - Route::get('admin/change-password', 'ChangePassword')->name('change.password');
     - ChangePassword() in AdminAuth.php 

     - route('update.password') in admin_change_password.blade.php
     - Route::post('admin/update-password', 'UpdatePassword')->name('update.password');
     - UpdatePassword() in AdminAuth.php 
     - 
          @if(count($errors))
               @foreach ($errors->all() as $error)
               <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
               @endforeach
          @endif
     - See detail code from controller Auth/NewPasswordController.php


42. Frontend Template Setup Part 1
43. Frontend Template Setup Part 2
     - We will use welcome page route as frontend
     - In public create folder 'frontend' and put all assets of frontend theme 
     - frontend view mastering ( 'frontend' folder then 'body' folder and mastering blade file)
     - mastering( with header, footer and index blade)
     - 
          Route::get('/', function () {
               return view('frontend/index');
          });


44. Backend Home Page Slider Option Part 1
     - php artisan make:model HomeSlider -m 
     - preparing migration for HomeSlider 

        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('short_title')->nullable();
            $table->string('home_slide')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        }); 

     - HomeSlider.php 

     protected $guarded = [];

     // protected $fillable = [
     //     'title',
     //     'short_title',
     //     'home_slide',
     //     'video_url',
     // ];

     - php artisan migrate
     - inserting a sample data in db 

45. Backend Home Page Slider Option Part 2