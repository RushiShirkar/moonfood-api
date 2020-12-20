@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet register')
@section('content')
                <form id="createpassword_form" class="white">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                        <h2>Fashio<span class="green">street</span></h2>
                        <h3>Create password</h3>
                    </center><br/>
                    <h5 class="green" style="font-size:16px;">
                        Create your password to access your <span class="white">fashiostreet</span> account : <span id="mobile_txt" data-value="{{ $_GET['mobile'] }}" class="white"><b>{{ $_GET['mobile'] }}</b></span>
                    </h5><br/>
                    <div id="error" class="error">
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
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-fashio">Create password</button>
                </form><br/>
                <center>
                    <p><a href="login" style="font-size:16px;" class="link white">Already have account</a></p>
                </center>
@endsection