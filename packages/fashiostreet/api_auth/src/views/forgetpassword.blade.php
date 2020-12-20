@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet forgetpassword')
@section('content')

                <form id="forgetpassword_form" class="white" action="/action_page.php">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                        <h2>Fashio<span class="green">street</span></h2>
                        <h3>Forget password</h3>
                    </center><br/>
                    <div id="error" class="error">

                    </div>
                    <div class="form-group">
                        <label for="mobile_txt" class="white">Mobile number(+91):</label>
                        <input type="number" class="form-control" id="mobile_txt" placeholder="Mobile number">
                    </div>
                    <button type="submit" class="btn btn-fashio">Next</button>
                </form><br/>
                <center>
                    <p><a href="login" style="font-size:16px;" class="link white">Already have account</a></p>
                    <p><a href="register" style="font-size:16px;" class="link white">Create New Acoount</a></p>
                </center>

@endsection