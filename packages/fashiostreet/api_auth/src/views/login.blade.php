@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet login')
@section('content')


                <form id="login_form" class="white" action="/action_page.php">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                    <h2>Fashio<span class="green">street</span></h2>
                        <h3>Login</h3>
                    </center>
                    <div id="error" class="error">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="white">Mobile number(+91):</label>
                        <input type="number" class="form-control" placeholder="Enter Mobile Number" id="mobile_txt" required>
                    </div>
                    <label for="pwd1" class="white">Password:</label>
                    <div class="input-group">
                        <input type="password" placeholder="Enter password" class="form-control" id="pwd1" required>
                        <span class="input-group-btn">
                            <button data-btn="pwd1" class="btn btn-default show_password" type="button">show</button>
                        </span>
                    </div><br/>
                    <div>
                        <a style="float:right" class="link white" href="forgetpassword">Forget password</a>
                    </div><br/><br/>
                    <button type="submit" class="btn btn-fashio">Login</button>
                </form><br/>
                <center><p><a href="register" style="font-size:16px;" class="link white">Create New Acoount</a></p></center>

@endsection