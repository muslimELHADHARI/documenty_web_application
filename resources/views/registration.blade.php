@extends('layout')
@section('title', 'Register')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login_style.css') }}">

<div class="d-flex flex-column min-vh-100">
  <section class="flex-grow-1 gradient-form" style="background-color: #f0f4f8;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10">
          <div class="card rounded-4 shadow-lg text-black">
            <div class="row g-0">

              <!-- Left Section (Form) -->
              <div class="col-lg-6">
                <div class="card-body p-md-4 mx-md-3">
                  <div class="text-center mb-4">
                    <img src="{{ asset('images/book.png') }}" alt="Documenty" style="width: 80px;">
                    <h4 class="mt-2 mb-4">Documenty</h4>
                  </div>

                  <!-- Display Errors & Messages -->
                  <div class="mt-3">
                    @if($errors->any())
                    <div class="alert alert-danger">
                      @foreach($errors->all() as $error)
                      <div>{{ $error }}</div>
                      @endforeach
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                  </div>

                  <!-- Registration Form -->
                  <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="mb-3 text-center">Create your new account</p>

                    <div class="form-outline mb-3">
                      <label for="file" class="form-label">Profile Picture</label>
                      <input type="file" class="form-control" id="file" name="profile" accept=".png,.jpeg,.jpg" required />
                    </div>

                    <div class="form-outline mb-3">
                      <label for="form2Example11" class="form-label">Username</label>
                      <input type="text" name="name" id="form2Example11" class="form-control" placeholder="Your name" required />
                    </div>

                    <div class="form-outline mb-3">
                      <label for="form2Example11" class="form-label">Email</label>
                      <input type="email" name="uid" id="form2Example11" class="form-control" placeholder="Email address" required />
                    </div>

                    <div class="form-outline mb-3">
                      <label for="form2Example22" class="form-label">Password</label>
                      <input type="password" name="pwd" id="form2Example22" class="form-control" required />
                    </div>

                    <!-- Register Button -->
                    <div class="text-center pt-1 mb-3">
                      <button class="btn btn-primary w-100" type="submit">Register</button>
                    </div>

                    <!-- Switch to Login Link -->
                    <div class="d-flex align-items-center justify-content-center pb-3">
                      <p class="mb-0 me-2">Already have an account?</p>
                      <a href="{{ route('login') }}">
                        <button type="button" class="btn btn-outline-primary btn-sm">Login</button>
                      </a>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Right Section (Info) -->
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">What is Documenty?</h4>
                  <p class="small mb-0">
                    Documenty هي تطبيق ويب مصمّم باش يسهّل التعليم ويعطي للمستخدمين إمكانية الوصول إلى مجموعة كبيرة من الوثائق والكتب. يوفر المنصة طريقة منظمة وسهلة باش يكتشفوا المواد في مجالات مختلفة، ويبحثوا على مواضيع معينة، ويعملوا حفظ للموارد اللي يحبوا يرجعوا ليها وقت ما يحبوا. مع واجهته السهلة في الاستعمال، الهدف متاعه هو توصيل المعرفة بطريقة مبسطة، ويدعم النمو الأكاديمي والشخصي من خلال تجربة مكتبة رقمية سلسة.            </p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
</div>
@endsection
