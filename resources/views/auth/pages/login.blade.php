@extends('auth.layout.auth')
@section('auth_content')
    <div class="animate form login_form " >
        <section class="login_content">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <h1>Login</h1>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach

                @endif
                <div>
                    <input type="text" class="form-control" placeholder="Email" required="" name="email"/>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                </div>
                <div class="form-check m-3 text-left">
                    <input class="form-check-input " type="checkbox" value="1" name="remember" id="flexCheckDefault">
                    <label class="form-check-label mt-1" for="flexCheckDefault">
                       Məni xatırla
                    </label>
                </div>
                <div>
                    <button class="btn btn-primary submit pl-3 pr-3" type="submit">Giriş</button>
                    <button class=" btn btn-warning pl-3 pr-3" >Parolu xatırlamırsınız ?</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">


                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-laptop"></i> </h1>
                        <p></p>
                    </div>
                </div>
            </form>
        </section>
    </div>

@endsection
