@extends('auth.layout.auth')
@section('auth_content')
    <div>
        <section class="login_content">
            <form>
                <h1>Create Account</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <a class="btn btn-default submit btn btn-primary pr-3 pl-3" href="index.html">Submit</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator text-center">
                    <p class=" d-flex justify-content-center align-items-center gap-2 ">
                        <span class="mt-2 mr-2">Already a member ?</span>
                        <a href="" class=" btn btn-info pr-3 pl-3"> Log in </a>
                    </p>

                </div>
            </form>
        </section>
    </div>
@endsection
