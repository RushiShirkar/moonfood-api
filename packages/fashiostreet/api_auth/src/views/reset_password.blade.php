@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet mobile number verification')
@section('content')
    @php
        if(!isset($_GET['mobile'])){
            abort(404,'invalid url found');
        }

    @endphp
    <form id="reset_password_form" class="white" action="/action_page.php">
        <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
            <h2>Fashio<span class="green">street</span></h2>
            <h3>Reset-Password</h3>
        </center><br/>
        <h5 class="green" style="font-size:16px;">
            OTP already Send to your mobile number : <span id="mobile_txt" data-value="{{ $_GET['mobile'] }}" class="white">{{ $_GET['mobile'] }}</span>
        </h5><br/>
        <div id="error" class="error">
        </div>
        <div class="form-group">
            <label for="OTP" class="white">Enter OTP:</label>
            <input type="number" class="form-control" id="OTP_txt" placeholder="Enter OTP" required>
        </div>
        <button type="button" class="btn btn-default" id="resendOTP_btn">Resend OTP</button>
        <br/><br/><label for="createpassword_pwd1" class="white">Password:</label>
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
        <br/><button type="submit" class="btn btn-fashio">Reset-Password</button>
    </form><br/>
    <center>
        <p><a href="login" style="font-size:16px;" class="link white">Already have account? Signin </a></p>
    </center>
	<script>
					$(document).ready(function(){
						$('#resendOTP_btn').click(function(){
							var mobile = {{ $_GET['mobile'] }};
							var data = {
								'email' : mobile
							};
							$.ajax({
								type:'POST',
								url:'/api/auth/forget-password/resendOTP',
								dataType:'json',
								data:data,
								success:function (response) {
									$('#error').show().html(response);
								},
								error:function (request, status, error) {
									if(request.status == 401)
									{
										window.location.href = '/Auth/login';
									}
									$('#error').show().html(request.responseText);
								}
							});
						});
					});
				</script>
@endsection