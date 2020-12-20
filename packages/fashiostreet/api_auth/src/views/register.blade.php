@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet register')
@section('content')

                <form id="register_form" class="white" action="/action_page.php">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                        <h2>Fashio<span class="green">street</span></h2>
                        <h3>Register New User</h3>
                    </center><br/>
                    <div id="error" class="error">
                    </div>
                    <div class="form-group">
                        <label for="mobile_txt" class="white">Mobile number(+91):</label>
                        <input type="number" class="form-control" id="mobile_txt" placeholder="Mobile number">
                    </div>
                    <label for="createpassword_pwd1" class="white">Password:</label>
                    <div class="input-group">
                        <input type="password" placeholder="Enter password" class="form-control" id="createpassword_pwd1" required>
                        <span class="input-group-btn">
                            <button data-btn="createpassword_pwd1" class="btn btn-default show_password" type="button">show</button>
                        </span>
                    </div><br/>
                    <label for="createpassword_pwd2" class="white">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" placeholder="Re-Enter password" class="form-control" id="createpassword_pwd2" required>
                        <span class="input-group-btn">
                            <button data-btn="createpassword_pwd2" class="btn btn-default show_password" type="button">show</button>
                        </span>
                    </div><br/>
                    <button type="submit" class="btn btn-fashio">Create Account</button>
                </form><br/>
                <center><p><a href="login" style="font-size:16px;" class="link white">Already have account</a></p></center>

@endsection